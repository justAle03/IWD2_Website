<?php
require_once 'redir.php';
include 'header.php';
?>
<h2>Full Analysis Workflow</h2>
<p>
    This workflow fetches protein sequences from NCBI and processes them through multiple analysis steps.
    Each step works on the FASTA file generated from your custom query, identified by a unique Job ID.
</p>

<!-- Custom Query Form -->
<form action="fetch_protein_custom.php" method="post">
    <label>Protein Family:</label>
    <input type="text" name="protein_family" required><br>
    <label>Taxonomic Group:</label>
    <input type="text" name="taxonomic_group" required><br>
    <input type="submit" value="Retrieve Sequences" class="menu-button">
</form>
<p><small>This step fetches sequences from NCBI and may take a few moments.</small></p>

<?php include 'footer.php'; ?>

