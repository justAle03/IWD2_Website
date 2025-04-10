<?php
require_once 'login.php';

try {
    $pdo = new PDO("mysql:unix_socket=/var/run/mysqld/mysqld.sock;dbname=$database;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("SELECT accession, protein_name, species, broad_taxon, length FROM Proteins WHERE broad_taxon = 'Aves'");
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
</head>
<body>
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
</body>
</html>

