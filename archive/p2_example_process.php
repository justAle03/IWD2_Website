<?php
include 'header.php';
require_once 'login.php';

try {
    $pdo = new PDO("mysql:unix_socket=/var/run/mysqld/mysqld.sock;dbname=$database;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "%" . $_POST['search_query'] . "%";
    $stmt = $pdo->prepare("SELECT accession, protein_name, species, broad_taxon, length FROM Example_Proteins WHERE accession LIKE ? OR protein_name LIKE ?");
    $stmt->execute([$query, $query]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "<p>Error: " . $e->getMessage() . "</p>";
    include 'footer.php';
    exit();
}
?>

<h2>Example Dataset Results</h2>

<?php if ($results): ?>
    <table border="1">
        <tr><th>Accession</th><th>Protein Name</th><th>Species</th><th>Taxon</th><th>Length</th></tr>
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
<?php else: ?>
    <p>No matches found.</p>
<?php endif; ?>

<p><a href='p2_example.php'>Search again</a></p>

<?php include 'footer.php'; ?>

