<?php
require_once 'redir.php';
include 'header.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['protein_family'], $_POST['taxonomic_group'])) {
    echo "<h3>⛔ This page must be accessed via the form on custom_query.php.</h3>";
    exit;
}

$protein_family = trim($_POST['protein_family']);
$taxonomic_group = trim($_POST['taxonomic_group']);
$query = "{$protein_family}[Title] AND {$taxonomic_group}[Organism]";

// Step 1: Preview count
$count_cmd = "/home/s2746547/edirect/esearch -db protein -query " . escapeshellarg($query) . " | grep -oP '(?<=<Count>)[0-9]+'";
$sequence_count = (int) shell_exec($count_cmd);

// Display results
echo "<h2>Fetching Protein Sequences</h2>";
echo "<p><strong>Query:</strong> $query</p>";
echo "<p><strong>Number of sequences found:</strong> $sequence_count</p>";

if ($sequence_count === 0) {
    echo "<p style='color:red;'>❌ No sequences found for your query.</p>";
    echo "<p><a href='custom_query.php'>🔙 Back to query form</a></p>";
    exit;
}

if ($sequence_count > 500 && !isset($_POST['confirmed'])) {
    echo "<p style='color:orange;'>⚠️ Your query returned over 500 sequences. This may take over 10 minutes.</p>";
    echo "<form method='post' action='fetch_protein_custom.php'>
            <input type='hidden' name='protein_family' value='" . htmlspecialchars($protein_family) . "'>
            <input type='hidden' name='taxonomic_group' value='" . htmlspecialchars($taxonomic_group) . "'>
            <input type='hidden' name='confirmed' value='1'>
            <input type='submit' value='⚠️ Proceed Anyway'>
          </form>
          <p><a href='custom_query.php'>❌ Cancel and revise query</a></p>";
    exit;
}

// Step 2: Fetch and import
// Generate a unique Job ID using timestamp and uniqid()
$jobID = 'job_' . time() . '_' . uniqid();
$output_fasta = "temp_output/{$jobID}.fasta";

// Store the Job ID and the FASTA file path in the session
$_SESSION['jobID'] = $jobID;
$_SESSION['user_fasta'] = $output_fasta;
$escaped_protein = escapeshellarg($protein_family);
$escaped_taxon = escapeshellarg($taxonomic_group);
$fetch_cmd = "./fetch_sequences.sh $escaped_protein $escaped_taxon $output_fasta";
$fetch_output = shell_exec($fetch_cmd);

// Store path in session
$_SESSION['user_fasta'] = $output_fasta;

echo "<pre>Command: $fetch_cmd\n\nOutput:\n$fetch_output</pre>";

if (file_exists($output_fasta) && filesize($output_fasta) > 0) {
    // Step 3: Import
    $_GET['fasta'] = $output_fasta;
    include 'import_fasta.php';

    echo "<p>✅ Sequences retrieved! <a href='$output_fasta' download>Download FASTA</a></p>";
    echo "<p><a href='custom_search.php'>➡️ Proceed to Search Your Dataset</a></p>";
    echo "<p><a href='custom_alignment.php'>➡️ Continue to Alignment and Plot</a></p>";
} else {
    echo "<p style='color:red;'>❌ Retrieval failed or file is empty.</p>";
    echo "<p><a href='custom_query.php'>🔙 Back to query form</a></p>";
}
?>

