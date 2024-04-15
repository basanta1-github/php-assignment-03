<?php
// Start a session to enable session variables to be used
session_start();

// Check if the user is not logged in; if not, redirect them to the index page
if (!isset($_SESSION['user_email'])) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Page</title>
</head>
<body>
    <div id="container">
        <header id="banner">
            <!-- Display a welcome message with the user's first name, last name, and email -->
            <h1>Welcome, <?php echo $_SESSION['user_first_name'] . ' ' . $_SESSION['user_last_name']; ?>!</h1>
            <h3>Email: <?php echo $_SESSION['user_email']; ?></h3>
        </header>
        <div id="nav">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="member.php">Member</a></li>
                <li><a href="register.php">Register</a></li>
                <li><a href="logout.php">Logout</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </div>
        <div class="main-content">
            <!-- Display a message indicating that the user is logged in -->
            <p>This is the member page. You are logged in!</p>
        </div>
        <footer>Developed By: Group 2</footer>
    </div>
</body>
</html>
