<?php
session_start();

// Include database configuration
require_once 'config/dbconfig.php';

// Check if user is already logged in
if (isset($_SESSION['user_email'])) {
    header("Location: member.php");
    exit;
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate input
    if (empty($email) || empty($password)) {
        $error = "Both email and password are required.";
    } else {
        // Prepare and execute SQL query to check user credentials
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email AND password = :password");
        $stmt->execute(['email' => $email, 'password' => $password]);
        $user = $stmt->fetch();

        // Check if user exists
        if ($user) {
            // Store user data in session
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_first_name'] = $user['first_name'];
            $_SESSION['user_last_name'] = $user['last_name'];
            // Redirect to member page
            header("Location: member.php");
            exit;
        } else {
            // Display error message if user not found
            $error = "Invalid email or password.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Final Assignment</title>
</head>
<body>
    <div id="container">
        <header id="banner">
            <h1>Final Assignment</h1>
            <h3>Users' Info Using PHP with MySQL</h3>
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
            <h2>Welcome to our website!</h2>
            <?php if (isset($error)) { ?>
                <p><?php echo $error; ?></p>
            <?php } ?>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <label>Email:</label><br>
                <input type="email" name="email" required><br><br>
                <label>Password:</label><br>
                <input type="password" name="password" required><br><br>
                <input type="submit" value="Login">
            </form>
        </div>
        <footer>Developed By: Group 2</footer>
    </div>
</body>
</html>
