<?php
include 'redir.php';
require_once 'login.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['protein_family'], $_POST['taxonomic_group'])) {
    echo "<h3>⛔ This page must be accessed via the form on p1.php.</h3>";
    exit;
}

$protein_family = escapeshellarg($_POST['protein_family']);
$taxonomic_group = escapeshellarg($_POST['taxonomic_group']);

// Step 1: Fetch proteins
$timestamp = time();
$fasta_file = "temp_output/user_proteins_$timestamp.fasta";
$command = "./fetch_sequences.sh $protein_family $taxonomic_group $fasta_file 2>&1";
$output = shell_exec($command);

echo "<h2>Fetching Protein Sequences</h2>";
echo "<pre>Running: $command\n\nOutput:\n$output</pre>";

if (!file_exists($fasta_file) || filesize($fasta_file) === 0) {
    echo "<p style='color:red;'>❌ Error: No sequences retrieved. Please check your search terms.</p>";
    echo "<p><a href='p1.php'>🔙 Back to Query Form</a></p>";
    exit;
}

echo "<p>✅ Sequences retrieved! <a href='$fasta_file' download>Download FASTA</a></p>";

// Step 2: Align sequences
$aligned_file = "temp_output/aligned_$timestamp.aln";
$align_cmd = "./perform_alignment.sh $fasta_file $aligned_file 2>&1";
$align_output = shell_exec($align_cmd);
echo "<h3>Performing Sequence Alignment...</h3>";
echo "<pre>$align_output</pre>";

// Step 3: Conservation Plot
$plot_cmd = "./conservation_plot.sh $aligned_file $timestamp 2>&1";
$plot_output = shell_exec("./conservation_plot.sh $aligned_file $timestamp 2>&1");
echo "<h3>Generating Conservation Plot...</h3>";
echo "<pre>$plot_output</pre>";

$plot_file = "temp_output/aligned_{$timestamp}_plot.png";
if (file_exists($plot_file)) {
    echo "<img src='$plot_file' alt='Conservation Plot' style='max-width:100%;'>";
    echo "<p><a href='$plot_file' download>📥 Download Plot</a></p>";
} else {
    echo "<p style='color:red;'>❌ Plot generation failed.</p>";
}

echo "<p><a href='p1.php'>🔙 Back to Query Form</a></p>";
?>

