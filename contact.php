<?php
// Start a session to enable session variables to be used
session_start();

// Include database configuration file to access database
require_once 'config/dbconfig.php';

// Check if the form has been submitted using POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form fields
    $name = $_POST['name']; // Get the value of the 'name' input field
    $email = $_POST['email']; // Get the value of the 'email' input field
    $message = $_POST['message']; // Get the value of the 'message' textarea field
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
</head>
<body>
    <div id="container">
        <header id="banner">
            <h1>Contact Us</h1>
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
            <h2>Contact Us</h2>
            <!-- Form to allow users to submit their contact information -->
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <label>Name:</label><br>
                <input type="text" name="name" required><br><br>
                <label>Email:</label><br>
                <input type="email" name="email" required><br><br>
                <label>Message:</label><br>
                <textarea name="message" rows="5" required></textarea><br><br>
                <input type="submit" value="Send"> <!-- Submit button to send the form data -->
            </form>
        </div>
        <footer>Developed By: Group 2</footer>
    </div>
</body>
</html>
