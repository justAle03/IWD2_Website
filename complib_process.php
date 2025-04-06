<?php
session_start();
if(isset($_POST['first_name']) && isset($_POST['last_name'])) {
    $_SESSION['first_name'] = $_POST['first_name'];
    $_SESSION['last_name'] = $_POST['last_name'];
    // Set any other default session variables if needed
    header("Location: indexp.php");
    exit();
} else {
    echo "Please provide both first and last names.";
}
?>

