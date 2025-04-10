<?php
session_start();
$_SESSION['jobID'] = 'example';
$_SESSION['user_fasta'] = 'temp_output/example_proteins.fasta';
include 'header.php';
?>
<h2>Interactive Search</h2>
<form action="interactive_search_results.php" method="post">
    Enter accession or keyword: <input type="text" name="search_query" required>
    <input type="submit" value="Search" class="menu-button">
</form>
<?php include 'footer.php'; ?>

