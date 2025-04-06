<?php include 'header.php'; ?>
<h2>🔎 Search Your Retrieved Sequences</h2>
<!-- (The search functionality should work on the dataset stored in $_SESSION['user_fasta']) -->
<form action="custom_search_results.php" method="post">
    Enter accession or keyword: <input type="text" name="search_query" required>
    <input type="submit" value="Search">
</form>
<?php include 'footer.php'; ?>

