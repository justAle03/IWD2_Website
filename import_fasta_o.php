<?php
require_once 'login.php';

if (!isset($_GET['fasta'])) {
    echo "<p>Error: No FASTA file specified for import.</p>";
    return;
}

$fasta_file = $_GET['fasta'];
if (!file_exists($fasta_file)) {
    echo "<p>Error: Specified FASTA file does not exist.</p>";
    return;
}

$handle = fopen($fasta_file, "r");
if (!$handle) {
    echo "<p>Error: Unable to open FASTA file.</p>";
    return;
}

$pdo = new PDO("mysql:unix_socket=/var/run/mysqld/mysqld.sock;dbname=$database;charset=utf8mb4", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "INSERT INTO Proteins (accession, protein_name, sequence, species, taxonomy, length, source, broad_taxon)
        VALUES (?, ?, ?, ?, ?, ?, 'user', NULL)";
$stmt = $pdo->prepare($sql);

$sequence = $accession = $protein_name = $species = "";
$totalInserted = 0;

while (($line = fgets($handle)) !== false) {
    $line = trim($line);
    if (substr($line, 0, 1) === ">") {
        if (!empty($sequence)) {
            $length = strlen($sequence);
            $stmt->execute([$accession, $protein_name, $sequence, $species, $species, $length]);
            $totalInserted++;
            $sequence = "";
        }

        if (preg_match('/^>(\S+)\s+(.*?)\s*\[(.+)\]/', $line, $matches)) {
            $accession = $matches[1];
            $protein_name = $matches[2];
            $species = $matches[3];
        } else {
            $header = substr($line, 1);
            $parts = preg_split('/\s+/', $header);
            $accession = $parts[0];
            $protein_name = implode(" ", array_slice($parts, 1));
            $species = "unknown";
        }
    } else {
        $sequence .= $line;
    }
}

if (!empty($sequence)) {
    $length = strlen($sequence);
    $stmt->execute([$accession, $protein_name, $sequence, $species, $species, $length]);
    $totalInserted++;
}
fclose($handle);

echo "<p>✅ Imported <strong>$totalInserted</strong> user protein records successfully.</p>";
?>

