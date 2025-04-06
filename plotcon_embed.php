<?php
$file = 'temp_output/example_conservation_plot.png';
if (file_exists($file)) {
    echo "<img src='$file' alt='Conservation Plot' style='max-width:100%; height:auto; border:1px solid #ccc;'>";
} else {
    echo "Conservation plot not found.";
}
?>

