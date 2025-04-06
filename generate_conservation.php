<?php
include 'header.php';

// Run the plotcon script
$output = shell_exec('./conservation_plot.sh 2>&1');
echo "<pre>$output</pre>";

$plotPath = "temp_output/conservation_plot.png";

if (file_exists($plotPath)) {
    echo "<h3>Conservation Plot</h3>";
    echo "<img src='$plotPath' alt='Conservation Plot' style='max-width: 100%;'>";
} else {
    echo "<p>Error: Conservation plot not generated.</p>";
}

include 'footer.php';
?>

