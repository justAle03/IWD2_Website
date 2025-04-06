<?php
// motif_analysis_process.php: Runs the motif analysis on the example dataset and displays the report.
include 'header.php';
require_once 'login.php';

echo "<h2>Motif Analysis Results (Example Dataset)</h2>";

// Define the input FASTA file (example dataset)
$inputFasta = "temp_output/example_proteins.fasta";

// Generate a unique filename for the final motif analysis report using the current timestamp.
$timestamp = time();
$finalReport = "temp_output/motif_result_final_{$timestamp}.txt";

// Build the command to run motif_analysis.sh.
// (Make sure the paths to the script and input file are correct.)
$cmd = "./motif_analysis.sh " . escapeshellarg($inputFasta) . " " . escapeshellarg($finalReport) . " 2>&1";
$cmdOutput = shell_exec($cmd);

// Optionally, uncomment the next line to debug the command output:
// echo "<pre>Command: $cmd\nOutput:\n$cmdOutput</pre>";

// Check if the final report file was generated.
if (!file_exists($finalReport)) {
    echo "<p style='color:red;'>Error: Motif analysis failed. Please try again later.</p>";
    include 'footer.php';
    exit;
}

// Read the final report content.
$reportContent = file_get_contents($finalReport);
?>
<div style="max-height:600px; overflow:auto; border:1px solid #ccc; padding:10px; background-color:#f9f9f9;">
    <pre><?php echo htmlspecialchars($reportContent); ?></pre>
</div>
<p><a href="<?php echo $finalReport; ?>" download>Download Motif Analysis Report</a></p>
<?php include 'footer.php'; ?>

