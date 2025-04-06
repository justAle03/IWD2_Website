<?php
require_once 'login.php';

$query = '%' . $_GET['query'] . '%';

try {
    $pdo = new PDO("mysql:host=$hostname;dbname=$database;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("SELECT accession, protein_name, species, sequence 
                           FROM Proteins 
                           WHERE accession LIKE ? OR protein_name LIKE ? OR species LIKE ?");
    $stmt->execute([$query, $query, $query]);

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    header('Content-Type: text/plain');
    header('Content-Disposition: attachment; filename="results.fasta"');

    foreach ($results as $row) {
        echo ">" . $row['accession'] . " " . $row['protein_name'] . " [" . $row['species'] . "]\n";
        echo wordwrap($row['sequence'], 70, "\n", true) . "\n";
    }

} catch (PDOException $e) {
    echo "Error exporting data: " . $e->getMessage();
}
?>

