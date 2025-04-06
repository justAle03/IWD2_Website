<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Protein Analysis Website</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <header>
        <h1>Protein Analysis Website</h1>
    </header>
    <nav>
    <?php include 'menuf.php'; ?>
    </nav>
    <main>
        <h2>Welcome!</h2>
        <p>Please enter your details to begin.</p>
        <form action="complib_process.php" method="post">
            First Name: <input type="text" name="first_name" required><br>
            Last Name:  <input type="text" name="last_name" required><br>
            <input type="submit" value="Enter">
        </form>
    </main>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Your Name</p>
    </footer>
</body>
</html>

