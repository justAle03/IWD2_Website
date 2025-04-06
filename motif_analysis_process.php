<?php
session_start();
include 'header.php';
require_once 'login.php';

// Use the FASTA file passed from the form; default to example if not provided.
$inputFasta = isset($_POST['fasta_file']) ? $_POST['fasta_file'] : "temp_output/example_proteins.fasta";
$timestamp = time();
$finalReport = "temp_output/{$_SESSION['jobID']}_motif_result_final_{$timestamp}.txt";

$cmd = "./motif_analysis.sh " . escapeshellarg($inputFasta) . " " . escapeshellarg($finalReport) . " 2>&1";
$cmdOutput = shell_exec($cmd);

// Uncomment for debugging if needed:
// echo "<pre>Command: $cmd\nOutput:\n$cmdOutput</pre>";

if (!file_exists($finalReport)) {
    echo "<p style='color:red;'>Error: Motif analysis failed. Please try again later.</p>";
    include 'footer.php';
    exit;
}

$reportContent = file_get_contents($finalReport);
?>
<div style="max-height:600px; overflow:auto; border:1px solid #ccc; padding:10px; background-color:#f9f9f9;">
    <pre><?php echo htmlspecialchars($reportContent); ?></pre>
</div>
<p><a href="<?php echo $finalReport; ?>" download>Download Motif Analysis Report</a></p>
<?php include 'footer.php'; ?>

