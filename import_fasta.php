<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'login.php';

// Retrieve the job ID from the session.
$jobID = isset($_SESSION['jobID']) ? $_SESSION['jobID'] : null;
if (!$jobID) {
    echo "<p>Error: Job ID not found in session.</p>";
    return;
}

// Retrieve the FASTA file path from GET (as passed by fetch_protein_custom.php)
$fasta_file = isset($_GET['fasta']) ? $_GET['fasta'] : null;
if (!$fasta_file || !file_exists($fasta_file)) {
    echo "<p>Error: FASTA file not found.</p>";
    return;
}

$handle = fopen($fasta_file, "r");
if (!$handle) {
    echo "<p>Error: Unable to open FASTA file.</p>";
    return;
}

$pdo = new PDO("mysql:unix_socket=/var/run/mysqld/mysqld.sock;dbname=$database;charset=utf8mb4", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Updated SQL: Added job_id column before source.
$sql = "INSERT INTO Proteins (accession, protein_name, sequence, species, taxonomy, length, job_id, source, broad_taxon)
        VALUES (?, ?, ?, ?, ?, ?, ?, 'user', NULL)";
$stmt = $pdo->prepare($sql);

$sequence = $accession = $protein_name = $species = "";
$totalInserted = 0;

while (($line = fgets($handle)) !== false) {
    $line = trim($line);
    if (substr($line, 0, 1) === ">") {
        if (!empty($sequence)) {
            $length = strlen($sequence);
            // Insert with job_id
            $stmt->execute([$accession, $protein_name, $sequence, $species, $species, $length, $jobID]);
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
    $stmt->execute([$accession, $protein_name, $sequence, $species, $species, $length, $jobID]);
    $totalInserted++;
}
fclose($handle);

echo "<p>✅ Imported <strong>$totalInserted</strong> user protein records successfully.</p>";
?>

