<?php
// redir.php: Redirect to the login page if the user is not logged in.
// Ensure there is no whitespace or output before this block.
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['first_name']) || !isset($_SESSION['last_name'])) {
    header("Location: complib.php");
    exit();
}
?>

