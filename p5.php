<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Exit</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>You have been logged out.</h2>
    <p>Sad to see you leaving, glad you have been here! If you change your mind:</p>
    <p><a class="menu-button" href="complib.php">Login again</a></p>
</body>
</html>

