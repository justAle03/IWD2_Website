<?php
session_start();
include 'header.php';

// Fixed values for interactive demo.
$_SESSION['jobID'] = 'example';
$_SESSION['user_fasta'] = 'temp_output/example_proteins.fasta';
$jobID = 'example';
$fullFasta = 'temp_output/example_proteins.fasta';

// Check if a subset FASTA was generated.
$subsetFile = isset($_SESSION['subset_fasta']) ? $_SESSION['subset_fasta'] : null;

if (isset($_GET['alignment_file']) && file_exists($_GET['alignment_file'])) {
    $fasta_file = $_GET['alignment_file'];
} else {
    echo "<h2>Select FASTA File for Alignment (Example)</h2>";
    echo "<p>Please choose one of the following options:</p>";
    echo "<ul style='list-style:none; padding:0;'>";
    if (file_exists($fullFasta)) {
        echo "<li><a href='interactive_alignment.php?alignment_file=" . urlencode($fullFasta) . "' class='button-link'>Align Full Dataset</a></li>";
    }
    echo "</ul>";
    echo "<p><a href='interactive_search.php' class='button-link'>Go back to Search</a></p>";
    include 'footer.php';
    exit;
}

//echo "<p><em>Aligning file: " . htmlspecialchars($fasta_file) . "</em></p>";
// For demo, we simply display the pre‑stored alignment file.
$aligned_file = 'temp_output/example_alignment.aln';
?>
<h2>Example Alignment</h2>
<?php if (file_exists($aligned_file)): ?>
    <p>Below is the pre‑stored example alignment:</p>
    <pre><?php echo htmlspecialchars(file_get_contents($aligned_file)); ?></pre>
    <p><a href="<?php echo $aligned_file; ?>" class="button-link" download>Download Alignment File</a></p>
<?php else: ?>
    <p style="color:red;">Example alignment file not found.</p>
<?php endif; ?>
<p><a href="interactive_conservation.php" class="button-link">Continue to Conservation Plot</a></p>
<p><a href="interactive_search.php" class="button-link">Search Again</a></p>
<?php include 'footer.php'; ?>

