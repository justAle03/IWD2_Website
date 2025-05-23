<?php
session_start();
include 'header.php';
require_once 'login.php';

// Establish PDO connection.
$pdo = new PDO("mysql:unix_socket=/var/run/mysqld/mysqld.sock;dbname=$database;charset=utf8mb4", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Retrieve the search query from the form.
$search_query = "%" . $_POST["search_query"] . "%";
$_SESSION['search_query'] = $_POST["search_query"];

// Use the example dataset: source = "example".
// (Assuming that your example dataset records in the Proteins table have source = "example")
$stmt = $pdo->prepare("SELECT accession, protein_name, species, sequence, broad_taxon, length 
                       FROM Proteins 
                       WHERE source = 'example' AND (accession LIKE ? OR protein_name LIKE ? OR species LIKE ?)");
$stmt->execute([$search_query, $search_query, $search_query]);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Interactive Example Dataset Search</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h2>Search Within Example Dataset</h2>
<form method="post">
    Enter keyword or partial word: <input type="text" name="search_query" required>
    <input type="submit" value="Search" class="menu-button">
</form>

<?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
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
                    <td><?= htmlspecialchars($row['accession']) ?></td>
                    <td><?= htmlspecialchars($row['protein_name']) ?></td>
                    <td><?= htmlspecialchars($row['species']) ?></td>
                    <td><?= htmlspecialchars($row['broad_taxon']) ?></td>
                    <td><?= htmlspecialchars($row['length']) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <?php
            // Generate a subset FASTA file from the search results.
            $subsetFasta = "temp_output/example_subset.fasta";
            $fastaContent = "";
            foreach ($results as $row) {
                $fastaContent .= ">" . $row['accession'] . " " . $row['protein_name'] . " [" . $row['species'] . "]\n";
                $fastaContent .= $row['sequence'] . "\n";
            }
            file_put_contents($subsetFasta, $fastaContent);
            $_SESSION['subset_fasta'] = $subsetFasta;
        ?>
        <br>
        <a href="custom_download.php" class="menu-button">Download search results as FASTA</a>
        <br><br>
        <a href="interactive_search.php" class="menu-button">Search again</a>
        &nbsp;&nbsp;
        <a href="interactive_alignment.php" class="menu-button">Continue to alignment (uses full dataset)</a> 
    <?php else: ?>
        <p>No results found matching your query.</p>
        <a href="interactive_search.php" class="menu-button">Search Again</a>
    <?php endif; ?>
<?php endif; ?>
</body>
</html>
<?php include 'footer.php'; ?>

