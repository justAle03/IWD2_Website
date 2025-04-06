<?php
include 'header.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Retrieve POST data
$protein_family = isset($_POST['protein_family']) ? $_POST['protein_family'] : '';
$taxonomic_group = isset($_POST['taxonomic_group']) ? $_POST['taxonomic_group'] : '';

// Debug: Print received parameters
//echo "<pre>DEBUG: protein_family = " . htmlspecialchars($protein_family) . "\n";
//echo "DEBUG: taxonomic_group = " . htmlspecialchars($taxonomic_group) . "\n</pre>";

if (empty($protein_family) || empty($taxonomic_group)) {
    echo "<p style='color:red;'>❌ Missing query parameters.</p>";
    exit;
}

// Use count_sequences.sh to count sequences.
$count_cmd = "./count_sequences.sh " . escapeshellarg($protein_family) . " " . escapeshellarg($taxonomic_group);
$sequence_count = trim(shell_exec($count_cmd));

//echo "<pre>DEBUG: Number of sequences found = $sequence_count</pre>";

echo "<h2>Fetching Protein Sequences</h2>";
echo "<p><strong>Query:</strong> " . htmlspecialchars($protein_family) . ", " . htmlspecialchars($taxonomic_group) . "</p>";
echo "<p><strong>Number of sequences found:</strong> $sequence_count</p>";

if ($sequence_count === "0" || intval($sequence_count) === 0) {
    echo "<p style='color:red;'>❌ No sequences found for your query.</p>";
    echo "<p><a href='custom_query.php'>🔙 Back to query form</a></p>";
    exit;
}

if (intval($sequence_count) > 500 && !isset($_POST['confirmed'])) {
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

// Check if temp_output directory is writable
if (!is_writable("temp_output/")) {
    echo "<pre>DEBUG: temp_output/ directory is NOT writable. Please change its permissions to 777 or 755</pre>";
} else {
   // echo "<pre>DEBUG: temp_output/ directory is writable.</pre>";
}

// Generate a unique Job ID and create the FASTA file name.
$jobID = 'job_' . time() . '_' . uniqid();
$output_fasta = "temp_output/{$jobID}.fasta";

// Store Job ID and FASTA path in the session.
$_SESSION['jobID'] = $jobID;
$_SESSION['user_fasta'] = $output_fasta;

// Set a limit for testing (e.g., 10 sequences)
$limit = 50;

$escaped_protein = escapeshellarg($protein_family);
$escaped_taxon = escapeshellarg($taxonomic_group);
$escaped_output = escapeshellarg($output_fasta);
$fetch_cmd = "./fetch_sequences.sh $escaped_protein $escaped_taxon $escaped_output $limit";

// Debug: Print the full command that will be executed.
//echo "<pre>DEBUG: Command: $fetch_cmd</pre>";

$fetch_output = shell_exec($fetch_cmd);

// Debug: Print the command output.
//echo "<pre>DEBUG: fetch_output:\n$fetch_output</pre>";

// Check if the output file exists and print its size.
if (file_exists($output_fasta)) {
    $size = filesize($output_fasta);
   // echo "<pre>DEBUG: Output file exists. Size: $size bytes.</pre>";
} else {
    //echo "<pre>DEBUG: Output file does not exist.</pre>";
}

if (file_exists($output_fasta) && filesize($output_fasta) > 0) {
    // Optionally import the FASTA file.
    $_GET['fasta'] = $output_fasta;
    include 'import_fasta.php';

    echo "<p>✅ Sequences retrieved! <a href='$output_fasta' download>Download FASTA</a></p>";
    echo "<p>Your Job ID is: " . htmlspecialchars($jobID) . "</p>";
    echo "<p><a href='custom_search.php'>➡️ Proceed to Search Your Dataset</a></p>";
    echo "<p><a href='custom_alignment.php'>➡️ Continue to Alignment and Plot</a></p>";
    echo "<p/><a href='motif_analysis.php'>➡️ Run Motif Analysis on Dataset</a></p>";
} else {
    echo "<p style='color:red;'>❌ Retrieval failed or file is empty.</p>";
    echo "<p><a href='custom_query.php'>🔙 Back to query form</a></p>";
}
?>

