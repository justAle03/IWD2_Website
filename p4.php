<?php
include 'header.php';

echo "<h2>Conservation Analysis (Example Dataset)</h2>";

$plot_file = "temp_output/example_conservation_plot.png";

// Check if plot file exists
if (file_exists($plot_file)) {
    echo "<p>This conservation plot of <b>glucose-6-phosphatase proteins (Aves)</b> was precomputed using <b>EMBOSS plotcon</b>.</p>";

    echo "<h3>Conservation Plot</h3>";
    echo "<img src='$plot_file' alt='Conservation Plot' style='max-width: 100%; height: auto; border: 1px solid #ccc;'>";

    // Reliable download link
    echo "<p><a href='$plot_file' download>Download Conservation Plot (PNG)</a></p>";

} else {
    echo "<p style='color:red;'>Conservation plot file is missing. Please contact site administrator.</p>";
}

include 'footer.php';
?>

