<?php
require_once 'login.php';

// handle form submission
$results = [];
if (isset($_POST["search_query"])) {
    try {
        $pdo = new PDO("mysql:unix_socket=/var/run/mysqld/mysqld.sock;dbname=$database;charset=utf8mb4", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $search_query = "%" . $_POST["search_query"] . "%";
        $stmt = $pdo->prepare("SELECT accession, protein_name, species, broad_taxon, length FROM Proteins WHERE (accession LIKE ? OR protein_name LIKE ? OR species LIKE ?) AND broad_taxon = 'Aves'");
        $stmt->execute([$search_query, $search_query, $search_query]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        echo "<p>Error: Database error: " . $e->getMessage() . "</p>";
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<form method="post">
    Enter keyword or partial word: <input type="text" name="search_query" required>
    <input type="submit" class="menu-button" value="Search">
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
        <br>
    <?php else: ?>
        <p>No results found matching your query.</p>
    <?php endif; ?>
<?php endif; ?>
</body>
</html>

