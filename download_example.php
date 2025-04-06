<?php
// download_example.php
require_once 'login.php';
header('Content-Type: text/plain');
header('Content-Disposition: attachment; filename="example_proteins.fasta"');

$dsn = "mysql:host=127.0.0.1;dbname=$database;charset=utf8mb4";
$pdo = new PDO($dsn, $username, $password);
$sql = "SELECT accession, protein_name, sequence FROM Proteins WHERE source='example' ";
foreach ($pdo->query($sql) as $row) {
    echo ">" . $row['accession'] . " " . $row['protein_name'] . "\n";
    echo $row['sequence'] . "\n";
}
?>

