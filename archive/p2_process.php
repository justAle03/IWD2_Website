<?php
include 'header.php';
require_once 'login.php';

$search_query = '%' . $_POST['search_query'] . '%';

// Connect to the database
try {
    $pdo = new PDO($hostname, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("USE `$database`");

    $search_query = "%" .$_POST["search_query"] . "%";

    // Prepare query to search across multiple relevant columns
    $stmt = $pdo->prepare("SELECT accession, protein_name, species, broad_taxon, length 
                           FROM Proteins 
                           WHERE accession LIKE ? OR protein_name LIKE ? OR species LIKE ?");
    $stmt->execute([$search_query, $search_query, $search_query]);

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "<p>Error: Database connection failed: " . $e->getMessage() . "</p>";
    include 'footer.php';
    exit();
}
?>

<h2>Search Results</h2>

<?php if (count($results) > 0): ?>
    <table border="1">
        <tr>
            <th>Accession</th>
            <th>Protein Name</th>
            <th>Species</th>
            <th>Broad Taxon</th>
            <th>Length</th>
        </tr>
        <?php foreach ($results as $row): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['accession']); ?></td>
            <td><?php echo htmlspecialchars($row['protein_name']); ?></td>
            <td><?php echo htmlspecialchars($row['species']); ?></td>
            <td><?php echo htmlspecialchars($row['broad_taxon']); ?></td>
            <td><?php echo htmlspecialchars($row['length']); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <a href="download.php?query=<?php echo urlencode($_POST['search_query']); ?>">Download Search Results as FASTA</a>
<?php else: ?>
    <p>No results found matching your query.</p>
<?php endif; ?>

<p><a href='p2.php'>Perform another search</a></p>

<?php include 'footer.php'; ?>

