<?php
include 'header.php';
require_once 'login.php';

$pdo = new PDO("mysql:unix_socket=/var/run/mysqld/mysqld.sock;dbname=$database;charset=utf8mb4", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$search_query = "%" . $_POST["search_query"] . "%";
$_SESSION['search_query'] = $_POST["search_query"];  // Store for alignment

$stmt = $pdo->prepare("SELECT accession, protein_name, species FROM Proteins WHERE source = 'user' AND (accession LIKE ? OR protein_name LIKE ? OR species LIKE ?)");
$stmt->execute([$search_query, $search_query, $search_query]);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Your Search Results</h2>
<?php if (count($results) > 0): ?>
    <table border="1">
        <tr>
            <th>Accession</th>
            <th>Protein Name</th>
            <th>Species</th>
        </tr>
        <?php foreach ($results as $row): ?>
        <tr>
            <td><?= htmlspecialchars($row['accession']) ?></td>
            <td><?= htmlspecialchars($row['protein_name']) ?></td>
            <td><?= htmlspecialchars($row['species']) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <a href="custom_download.php">Download as FASTA</a>
    <br><br>
    <form action="export_alignment_fasta.php" method="post">
        <input type="hidden" name="search_query" value="<?= htmlspecialchars($_POST['search_query']) ?>">
        <input type="submit" value="⚙️ Align Subset (Based on Search)">
    </form>
<?php else: ?>
    <p>No results found.</p>
<?php endif; ?>
<?php include 'footer.php'; ?>

