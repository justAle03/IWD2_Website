<?php
session_start();
$fasta_file = $_SESSION['user_fasta'];

if (file_exists($fasta_file)) {
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="user_dataset.fasta"');
    readfile($fasta_file);
} else {
    echo "Error: File not found.";
}
?>

