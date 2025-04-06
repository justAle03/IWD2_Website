<?php
// alignment_embed.php: Embeds the alignment content for display.
$file = 'temp_output/example_alignment.aln';

if (file_exists($file)) {
    $content = file_get_contents($file);
    echo "<pre class='embedded-content'>" . htmlspecialchars($content) . "</pre>";
} else {
    echo "<p style='color: red;'>Alignment file not found.</p>";
}
?>

