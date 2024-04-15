<?php
// Start a session to enable session variables to be used
session_start();

// Check if the user is already logged in; if so, redirect to the member page
if (isset($_SESSION['user_email'])) {
    header("Location: member.php");
    exit;
}

// Include database configuration file to access database
require_once 'config/dbconfig.php';

// Check if the form has been submitted using POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form fields
    $first_name = $_POST['first_name']; // Get the value of the 'first_name' input field
    $last_name = $_POST['last_name']; // Get the value of the 'last_name' input field
    $email = $_POST['email']; // Get the value of the 'email' input field
    $password = $_POST['password']; // Get the value of the 'password' input field

    // Validate input fields
    if (empty($first_name) || empty($last_name) || empty($email) || empty($password)) {
        $error = "All fields are required."; // Set an error message if any field is empty
    } else {
        // Check if the email already exists in the database
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        if ($stmt->rowCount() > 0) {
            $error = "Email already exists. Please choose a different email."; // Set an error message if the email already exists
        } else {
            // Insert new user into the database
            $stmt = $pdo->prepare("INSERT INTO users (first_name, last_name, email, password) VALUES (:first_name, :last_name, :email, :password)");
            $stmt->execute(['first_name' => $first_name, 'last_name' => $last_name, 'email' => $email, 'password' => $password]);
            // Store user data in session variables
            $_SESSION['user_email'] = $email;
            $_SESSION['user_first_name'] = $first_name;
            $_SESSION['user_last_name'] = $last_name;
            // Redirect to the member page after successful registration
            header("Location: member.php");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <div id="container">
        <header id="banner">
            <h1>Registration</h1>
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
            <h2>Register</h2>
            <?php if (isset($error)) { ?>
                <p><?php echo $error; ?></p>
            <?php } ?>
            <!-- Form to allow users to register with their information -->
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <label>First Name:</label><br>
                <input type="text" name="first_name" required><br><br>
                <label>Last Name:</label><br>
                <input type="text" name="last_name" required><br><br>
                <label>Email:</label><br>
                <input type="email" name="email" required><br><br>
                <label>Password:</label><br>
                <input type="password" name="password" required><br><br>
                <input type="submit" value="Register"> <!-- Submit button to register -->
            </form>
        </div>
        <footer>Developed By: Group 2</footer>
    </div>
</body>
</html>
