<?php
session_start();
include 'header.php';

if (!isset($_SESSION['jobID'])) {
    echo "<p style='color:red;'>❌ Error: No job ID found. Please start from the custom query.</p>";
    echo "<p><a class='menu-button' href='custom_query.php'>🔙 Back to Start</a></p>";
    include 'footer.php';
    exit;
}

$jobID = $_SESSION['jobID'];
$fullFasta = "temp_output/{$jobID}.fasta";

// Get all subset FASTA files using glob and sort them.
$subsetFiles = glob("temp_output/{$jobID}_subset*.fasta");
if (is_array($subsetFiles)) {
    sort($subsetFiles);
} else {
    $subsetFiles = [];
}

if (isset($_GET['alignment_file']) && file_exists($_GET['alignment_file'])) {
    $fasta_file = $_GET['alignment_file'];
} else {
    echo "<h2>Select FASTA File for Alignment</h2>";
    echo "<p>Please choose one of the following options for alignment:</p>";
    echo "<ul style='list-style:none; padding:0;'>";

    // Option for the full dataset.
    if (file_exists($fullFasta)) {
        echo "<li><a href='custom_alignment.php?alignment_file=" . urlencode($fullFasta) . "' class='menu-button'>Align Full Dataset</a></li>";
    }

    // Options for each subset file.
    if (count($subsetFiles) > 0) {
        foreach ($subsetFiles as $index => $subsetFile) {
            $label = "Align Subset " . ($index + 1);
            echo "<li><a href='custom_alignment.php?alignment_file=" . urlencode($subsetFile) . "' class='menu-button'>$label</a></li>";
        }
    }
    
    echo "</ul>";
    echo "<p><a href='custom_search.php' class='menu-button'>Go back to Search</a></p>";
    include 'footer.php';
    exit;
}

// At this point, $fasta_file is the chosen file.
//echo "<p><em>Aligning file: " . htmlspecialchars($fasta_file) . "</em></p>";

$timestamp = time();
$aligned_file = "temp_output/{$jobID}_aligned_$timestamp.aln";

$command = "./perform_alignment.sh " . escapeshellarg($fasta_file) . " " . escapeshellarg($aligned_file);
$output = shell_exec($command);

echo "<h2>Performing Sequence Alignment...</h2>";
// (Optional) Debug output: echo "<pre>$command\n$output</pre>";

if (file_exists($aligned_file)) {
    $_SESSION['aligned_file'] = $aligned_file;
    echo "<p>✅ Alignment completed.</p>";
    echo "<p><a href='$aligned_file' class='menu-button' download>📥 Download Alignment File</a></p>";
    echo "<p><a href='custom_conservation.php' class='menu-button'>➡️ Continue to Conservation Plot</a></p>";
} else {
    echo "<p style='color:red;'>❌ Alignment failed. Please check the input sequences or try again with fewer sequences.</p>";
}

echo "<p><a href='custom_search.php' class='menu-button'>Search Again</a></p>";

include 'footer.php';

