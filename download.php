<?php
require 'login.php';

if (!isset($_GET['query'])) {
    exit("No query provided.");
}

$search_query = "%" . $_GET['query'] . "%";

try {
    $pdo = new PDO("mysql:unix_socket=/var/run/mysqld/mysqld.sock;dbname=$database;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("
        SELECT accession, protein_name, sequence 
        FROM Proteins 
        WHERE accession LIKE ? OR protein_name LIKE ? OR species LIKE ?
    ");
    $stmt->execute([$search_query, $search_query, $search_query]);
    $proteins = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!$proteins) {
        exit("No matching proteins found.");
    }

    header('Content-Type: text/plain');
    header('Content-Disposition: attachment; filename="search_results.fasta"');

    foreach ($proteins as $protein) {
        echo ">" . $protein['accession'] . " " . $protein['protein_name'] . "\n";
        echo wordwrap($protein['sequence'], 70, "\n", true) . "\n";
    }

} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}
?>


