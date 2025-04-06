<?php
// motif_analysis.php
require_once 'redir.php';
include 'header.php';

// Check if the user is logged in by verifying session variables (this could be more elaborate)
if (!isset($_SESSION['first_name']) || !isset($_SESSION['last_name'])) {
    header("Location: complib.php");
    exit;
}
?>

<h2>Motif Analysis</h2>
<p>
    Enter a protein accession to search for known motifs using PROSITE data.
    (Leave blank to use the entire example dataset.)
</p>

<form action="motif_analysis_process.php" method="post">
    Protein Accession (optional): <input type="text" name="accession"><br>
    <!-- You can add more options if needed, e.g., select a motif type -->
    <input type="submit" value="Run Motif Analysis">
</form>

<?php include 'footer.php'; ?>

