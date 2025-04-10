<?php
// redir.php: Redirect to the login page if the user is not logged in.
// Ensure that no output is sent before this block.
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['first_name']) || !isset($_SESSION['last_name'])) {
    // Store a message in the session that will be shown on the login page.
    $_SESSION['complib_msg'] = "Please insert your first and last name to continue accessing this functionality, thank you. You can freely access the interactive tutorial and interactive demo as well as the credits and help pages.";
    header("Location: complib.php");
    exit();
}
?>

