<?php
session_start();
include 'header.php';

$_SESSION['jobID'] = 'example';
$conservationPlot = 'temp_output/example_conservation_plot.png';
?>
<h2>Interactive Conservation Plot</h2>
<?php if (file_exists($conservationPlot)): ?>
    <img src="<?php echo $conservationPlot; ?>" alt="Conservation Plot" style="max-width:100%;"><br>
    <p><a href="<?php echo $conservationPlot; ?>" class="button-link" download>Download Conservation Plot</a></p>
<?php else: ?>
    <p style="color:red;">Conservation plot not found.</p>
<?php endif; ?>
<p><a href="interactive_alignment.php" class="button-link">Return to Alignment</a></p>
<?php include 'footer.php'; ?>

