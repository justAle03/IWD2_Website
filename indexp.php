<?php
include 'header.php';
?>
<h2>Welcome, <?php echo $_SESSION['first_name'] . " " . $_SESSION['last_name']; ?>!</h2>
<p>This website allows you to search and analyze protein sequence data.</p>
<?php include 'footer.php'; ?>

