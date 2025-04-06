<?php include 'header.php'; ?>
<h2>User Protein Search</h2>

<p><strong>Note:</strong> Searches on user-defined queries can take some time depending on the number of results.</p>

<form action="p2_process.php" method="post">
    Enter protein accession or keyword: <input type="text" name="search_query" required><br>
    <input type="submit" value="Search">
</form>

<?php include 'footer.php'; ?>


