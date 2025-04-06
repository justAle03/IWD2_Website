<?php
require_once 'login.php';

try {
    // Connect to your MySQL database
    $pdo = new PDO("mysql:unix_socket=/var/run/mysqld/mysqld.sock;dbname=$database;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch all proteins from the Proteins table (example dataset)
    $stmt = $pdo->prepare("SELECT accession, protein_name, species, sequence FROM Proteins");
    $stmt->execute();
    $proteins = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Path for example FASTA file
    $output_file = "temp_output/example_proteins.fasta";

    // Open file for writing
    $handle = fopen($output_file, 'w');

    // Write each protein record in FASTA format
    foreach ($proteins as $protein) {
        fwrite($handle, ">" . $protein['accession'] . " " . $protein['protein_name'] . " [" . $protein['species'] . "]\n");
        fwrite($handle, chunk_split($protein['sequence'], 60, "\n"));
    }

    fclose($handle);
    echo "FASTA file created successfully: <a href='$output_file'>Download example FASTA</a>";

} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}
?>

