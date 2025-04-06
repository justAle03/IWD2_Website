<?php
require_once 'login.php';
session_start();

if (!isset($_POST['search_query'])) {
    die("No search query provided.");
}

$search = "%" . $_POST['search_query'] . "%";
$pdo = new PDO("mysql:unix_socket=/var/run/mysqld/mysqld.sock;dbname=$database;charset=utf8mb4", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $pdo->prepare("SELECT accession, protein_name, species, sequence FROM Proteins WHERE source = 'user' AND (accession LIKE ? OR protein_name LIKE ? OR species LIKE ?)");
$stmt->execute([$search, $search, $search]);

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($results) === 0) {
    echo "<p style='color:red;'>❌ No sequences found for alignment subset.</p>";
    exit;
}

$timestamp = time();
$fasta_file = "temp_output/alignment_subset_$timestamp.fasta";
$fh = fopen($fasta_file, "w");

foreach ($results as $row) {
    fwrite($fh, ">" . $row['accession'] . " " . $row['protein_name'] . " [" . $row['species'] . "]\n");
    fwrite($fh, wordwrap($row['sequence'], 70, "\n", true) . "\n");
}
fclose($fh);

// Store in session and redirect
$_SESSION['user_fasta'] = $fasta_file;
header("Location: custom_alignment.php");
exit;
?>

