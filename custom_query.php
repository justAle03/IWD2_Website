<?php include 'header.php'; ?>
<h2>🔍 Start Your Custom Protein Query</h2>
<form action="fetch_protein_custom.php" method="post">
    Protein Family: <input type="text" name="protein_family" required><br>
    Taxonomic Group: <input type="text" name="taxonomic_group" required><br>
    <input type="submit" value="Retrieve Sequences">
</form>
<p><small>This step fetches sequences from NCBI, it might take a few moments.</small></p>
<?php include 'footer.php'; ?>

