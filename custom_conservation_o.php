<?php
include 'header.php';

echo "<h2>🧬 Conservation Plot (Custom Dataset)</h2>";

// ✅ Check if alignment file is available
if (!isset($_SESSION['aligned_file']) || !file_exists($_SESSION['aligned_file'])) {
    echo "<p style='color:red;'>❌ Error: No alignment file found. Please run the alignment first.</p>";
    include 'footer.php';
    exit;
}

$aligned_file = $_SESSION['aligned_file'];
$timestamp = time();  // Used only as unique ID
$plot_file = "temp_output/{$timestamp}_plot.png";

// ✅ Run the plot script with filename and ID separately
$output = shell_exec("./conservation_plot.sh $aligned_file $timestamp");

if (file_exists($plot_file)) {
    echo "<p>✅ Conservation plot generated.</p>";
    echo "<img src='$plot_file' alt='Conservation Plot' style='max-width:100%;'><br>";
    echo "<p><a href='$plot_file' download>📥 Download Plot</a></p>";
} else {
    echo "<p style='color:red;'>❌ Plot generation failed.</p>";
    echo "<pre>$output</pre>";  // Show output for debugging
}

include 'footer.php';
?>

