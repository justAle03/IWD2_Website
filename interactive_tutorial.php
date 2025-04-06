<?php
session_start();
$_SESSION['jobID'] = 'example';
$_SESSION['user_fasta'] = 'temp_output/example_proteins.fasta';
include 'header.php';
?>
<h2>Interactive Tutorial</h2>
<p>
    This tutorial demonstrates how our website works using a pre‑stored example dataset. You can view the example dataset,
    see a sample alignment, motif analysis report, and conservation plot.
</p>
<p>
    <a href="view_example.php" class="button-link">View Example Dataset</a>
</p>
<p>
    <a href="interactive_alignment.php" class="button-link">View Example Alignment</a>
</p>
<p>
    <a href="interactive_motif_analysis.php" class="button-link">View Example Motif Analysis Report</a>
</p>
<p>
    <a href="interactive_conservation.php" class="button-link">View Example Conservation Plot</a>
</p>
<?php include 'footer.php'; ?>

