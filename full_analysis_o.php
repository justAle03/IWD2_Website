<?php
include 'header.php';
?>
<h2>Full Analysis Workflow</h2>
<p>
    Use this workflow to perform a full analysis by fetching sequences from NCBI and processing them through alignment and conservation plotting. Note that large queries might take longer and are capped for performance.
</p>

<!-- Custom Query Form -->
<form action="fetch_protein_custom.php" method="post">
    <label>Protein Family:</label>
    <input type="text" name="protein_family" required><br>
    <label>Taxonomic Group:</label>
    <input type="text" name="taxonomic_group" required><br>
    <input type="submit" value="Retrieve Sequences" class="button-link">
</form>
<p><small>This step fetches sequences from NCBI and may take a few moments.</small></p>

<!-- Next steps for workflow -->
<ul>
    <li><a href="custom_search.php" class="button-link">Search Fetched Data</a></li>
    <li><a href="custom_alignment.php" class="button-link">Perform Sequence Alignment</a></li>
    <li><a href="custom_conservation.php" class="button-link">Generate Conservation Plot</a></li>
    <li><a href="custom_download.php" class="button-link">Download Results</a></li>
</ul>

<?php include 'footer.php'; ?>

