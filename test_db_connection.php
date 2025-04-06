<?php
// Include login credentials
require_once 'login.php';

try {
    // Attempt to establish connection
    $pdo = new PDO($hostname, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Select the database explicitly
    $pdo->exec("USE `$database`");

    // Perform a simple, guaranteed-to-succeed query (assuming Proteins table exists)
    $query = "SELECT accession, protein_name FROM Proteins LIMIT 5";
    $stmt = $pdo->query($query);
    
    // Fetch the results
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($results) > 0) {
        echo "<h3>Connection Successful! Here are some example proteins:</h3>";
        echo "<ul>";
        foreach ($results as $row) {
            echo "<li><b>" . htmlspecialchars($row['accession']) . "</b>: " . htmlspecialchars($row['protein_name']) . "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>No data found in Proteins table!</p>";
    }

} catch (PDOException $e) {
    echo "<p><b>Error:</b> Database connection failed: " . htmlspecialchars($e->getMessage()) . "</p>";
}
?>

