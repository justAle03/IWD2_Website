<?php
include 'header.php';
require_once 'login.php';

// Ensure session is started.
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$pdo = new PDO("mysql:unix_socket=/var/run/mysqld/mysqld.sock;dbname=$database;charset=utf8mb4", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Retrieve the search query and wrap with wildcards.
$search_query = "%" . $_POST["search_query"] . "%";
$_SESSION['search_query'] = $_POST["search_query"];  // Store for later use

// Retrieve the current job ID from the session.
$currentJobID = isset($_SESSION['jobID']) ? $_SESSION['jobID'] : '';

$stmt = $pdo->prepare("SELECT accession, protein_name, species, sequence 
    FROM Proteins 
    WHERE source = 'user' 
      AND job_id = ? 
      AND (accession LIKE ? OR protein_name LIKE ? OR species LIKE ?)");
$stmt->execute([$currentJobID, $search_query, $search_query, $search_query]);
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
    
    <?php
    // Generate a subset FASTA file from the search results.
    $baseSubset = "temp_output/{$currentJobID}_subset";
    $extension = ".fasta";
    $counter = 1;
    $subsetFasta = $baseSubset . $counter . $extension;
    // Increment counter until a non-existing filename is found.
    while(file_exists($subsetFasta)){
        $counter++;
        $subsetFasta = $baseSubset . $counter . $extension;
    }
    
    $fastaContent = "";
    foreach ($results as $row) {
        // Format a FASTA record: >accession protein_name [species]
        $fastaContent .= ">" . $row['accession'] . " " . $row['protein_name'] . " [" . $row['species'] . "]\n";
        $fastaContent .= $row['sequence'] . "\n";
    }
    file_put_contents($subsetFasta, $fastaContent);
    // Store the last generated subset file.
    $_SESSION['subset_fasta'] = $subsetFasta;
    ?>
    
    <p>
        <a href="custom_download.php" class="button-link">Download as FASTA (Subset)</a>
    </p>
    <br>
    <!-- Links at the bottom -->
    <p>
        <a href="custom_search.php" class="button-link">Search Again</a>
        &nbsp;&nbsp;
        <a href="custom_alignment.php" class="button-link">Align subset (based on search)</a>
    </p>
<?php else: ?>
    <p>No results found.</p>
    <p>
        <a href="fetch_protein_custom.php" class="button-link">Go back to Custom Query</a>
        &nbsp;&nbsp;
        <a href="custom_search.php" class="button-link">Search Again</a>
    </p>
<?php endif; ?>

<?php include 'footer.php'; ?>

