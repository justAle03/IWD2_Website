<?php
session_start();

// Check for subset FASTA file first.
if (isset($_SESSION['subset_fasta']) && file_exists($_SESSION['subset_fasta'])) {
    $fileToDownload = $_SESSION['subset_fasta'];
} elseif (isset($_SESSION['user_fasta']) && file_exists($_SESSION['user_fasta'])) {
    $fileToDownload = $_SESSION['user_fasta'];
} else {
    echo "Error: File not found.";
    exit;
}

header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . basename($fileToDownload) . '"');
readfile($fileToDownload);
?>

