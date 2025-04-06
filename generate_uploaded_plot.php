<?php
include 'header.php';

$upload_dir = "temp_output/";
$timestamp = time();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["alignment_file"])) {
    $tmp_file = $_FILES["alignment_file"]["tmp_name"];
    $original_name = basename($_FILES["alignment_file"]["name"]);

    // Sanitize and build final filename
    $uploaded_aln = $upload_dir . "uploaded_alignment_{$timestamp}.aln";
    move_uploaded_file($tmp_file, $uploaded_aln);

    if (file_exists($uploaded_aln)) {
        // Generate plot
        $plot_output = shell_exec("./conservation_plot.sh $uploaded_aln $timestamp 2>&1");
        $plot_file = "temp_output/{$timestamp}_plot.png";

        echo "<h2>🧬 Conservation Plot from Uploaded Alignment</h2>";
        echo "<p><strong>File:</strong> $original_name</p>";
        echo "<pre>$plot_output</pre>";

        if (file_exists($plot_file)) {
            echo "<img src='$plot_file' alt='Conservation Plot' style='max-width:100%;'>";
            echo "<p><a href='$plot_file' download>📥 Download Plot</a></p>";
        } else {
            echo "<p style='color:red;'>❌ Plot generation failed.</p>";
        }
    } else {
        echo "<p style='color:red;'>❌ File upload failed.</p>";
    }
} else {
    echo "<p style='color:red;'>❌ No file was uploaded.</p>";
}

include 'footer.php';
?>

