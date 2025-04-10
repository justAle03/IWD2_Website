<?php
session_start();
include 'header.php';

// For the interactive demo, we assume the motif analysis report is pre‑stored.
$_SESSION['jobID'] = 'example';
$fastaFile = 'temp_output/example_proteins.fasta'; // not really used here
$motifReport = 'temp_output/example_motif_report.txt';
?>
<h2>Interactive Motif Analysis Report</h2>
<?php if (file_exists($motifReport)): ?>
    <pre><?php echo htmlspecialchars(file_get_contents($motifReport)); ?></pre>
    <p><a href="<?php echo $motifReport; ?>" class="menu-button" download>Download Motif Analysis Report</a></p>
<?php else: ?>
    <p style="color:red;">Motif analysis report not found.</p>
<?php endif; ?>
<p><a href="interactive_tutorial.php" class="menu-button">Return to Tutorial</a></p>
<?php include 'footer.php'; ?>

