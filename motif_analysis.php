<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['first_name']) || !isset($_SESSION['last_name'])) {
    header("Location: complib.php");
    exit;
}
include 'header.php';

// Use the FASTA file from the custom query; if not set, default to the example dataset.
$jobID = isset($_SESSION['jobID']) ? $_SESSION['jobID'] : 'example';
$fastaFile = "temp_output/{$jobID}.fasta";
?>
<h2>Motif Analysis</h2>
<p>
    Run motif analysis on the entire retrieved dataset.
</p>
<form action="motif_analysis_process.php" method="post">
    <!-- Pass the dynamic FASTA file directly -->
    <input type="hidden" name="fasta_file" value="<?php echo htmlspecialchars($fastaFile); ?>">
    <input type="submit" value="Run Motif Analysis" class="menu-button">
</form>
<?php include 'footer.php'; ?>

