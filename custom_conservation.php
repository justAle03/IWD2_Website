<?php
session_start();
include 'header.php';

echo "<h2>🧬 Conservation Plot </h2>";

// Ensure the alignment file exists.
if (!isset($_SESSION['aligned_file']) || !file_exists($_SESSION['aligned_file'])) {
    echo "<p style='color:red;'>❌ Error: No alignment file found. Please run the alignment first.</p>";
    include 'footer.php';
    exit;
}

$aligned_file = $_SESSION['aligned_file'];
$jobID = isset($_SESSION['jobID']) ? $_SESSION['jobID'] : "unknown";
$timestamp = time(); // Use current time for uniqueness

// Call conservation_plot.sh and capture both stdout and stderr.
$output = shell_exec("./conservation_plot.sh " . escapeshellarg($aligned_file) . " " . escapeshellarg($timestamp) . " " . escapeshellarg($jobID) . " 2>&1");

// Ensure $output is a string.
if (is_null($output)) {
    $output = "";
}

$plot_file = trim($output);

// Debug: output the returned filename or error messages.
//echo "<pre>DEBUG: conservation_plot.sh returned:\n$plot_file</pre>";

// Check if the file exists.
if (!empty($plot_file) && file_exists($plot_file)) {
    echo "<p>✅ Conservation plot generated.</p>";
    echo "<img src='$plot_file' alt='Conservation Plot' style='max-width:100%;'><br>";
    echo "<p><a class='menu-button' href='$plot_file' download>📥 Download Plot</a></p>";
} else {
    echo "<p style='color:red;'>❌ Plot generation failed.</p>";
    echo "<pre>$output</pre>";
}

include 'footer.php';
?>

