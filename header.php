<?php
// header.php: Common header for all pages.
// Start session only if one is not already active.
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Protein Analysis Website</title>
    <!-- Link to the global stylesheet -->
    <link rel="stylesheet" type="text/css" href="style.css">
    <!-- You can link additional external JS libraries here if needed -->
</head>
<body>
    <header>
        <h1>Protein Analysis Website</h1>
    </header>
    <nav>
        <?php include 'menuf.php'; ?>
    </nav>
    <main>

