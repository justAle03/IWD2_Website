<?php
include 'header.php';
if (!isset($_SESSION['user_fasta']) || !file_exists($_SESSION['user_fasta'])) {
    echo "<p style='color:red;'>❌ Error: No FASTA file found. Please start from the custom query.</p>";
    echo "<p><a href='custom_query.php'>🔙 Back to Start</a></p>";
    include 'footer.php';
    exit;
}

$fasta_file = $_SESSION['user_fasta'];
$timestamp = time();
$aligned_file = "temp_output/user_aligned_$timestamp.aln";

$command = "./perform_alignment.sh " . escapeshellarg($fasta_file) . " " . escapeshellarg($aligned_file);
$output = shell_exec($command);

echo "<h2>Performing Sequence Alignment...</h2>";
echo "<pre>$command\n$output</pre>";

if (file_exists($aligned_file)) {
    $_SESSION['aligned_file'] = $aligned_file;
    echo "<p>✅ Alignment completed.</p>";
    echo "<a href='$aligned_file' download>📥 Download Alignment File</a>";
    echo "<p><a href='custom_conservation.php'>➡️ Continue to Conservation Plot</a></p>";
} else {
    echo "<p style='color:red;'>❌ Alignment failed. Please check the input sequences or try again with fewer sequences.</p>";
}

include 'footer.php';
?>

