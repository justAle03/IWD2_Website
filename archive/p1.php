<?php
include 'header.php';
?>
<h2>Select Protein Family and Taxonomic Group</h2>
<form action="fetch_protein.php" method="post">
    Protein Family: <input type="text" name="protein_family" required><br>
    Taxonomic Group: <input type="text" name="taxonomic_group" required><br>
    <input type="submit" value="Retrieve Sequences">
</form>
<?php include 'footer.php'; ?>

