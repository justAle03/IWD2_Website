<?php
include 'header.php';

echo "<h2>Sequence Alignment (Example Dataset)</h2>";

$alignment_file = "temp_output/example_alignment.aln";

// Check if alignment file exists
if (file_exists($alignment_file)) {
    echo "<p>The alignment of <b>glucose-6-phosphatase proteins (Aves)</b> has been precomputed using <b>Clustal Omega</b>.</p>";
    echo "<h3>Alignment Preview</h3>";

    // Display alignment content neatly (scrollable)
    echo "<pre style='max-height:400px; overflow:auto; border:1px solid #ddd; padding:10px; background-color:#f9f9f9;'>";
    echo htmlspecialchars(file_get_contents($alignment_file));
    echo "</pre>";

    // Reliable download link
    echo "<p><a href='$alignment_file' download>Download Alignment (Clustal format)</a></p>";

} else {
    echo "<p style='color:red;'>Alignment file is missing. Please contact site administrator.</p>";
}

include 'footer.php';
?>

