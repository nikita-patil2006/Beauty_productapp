<?php
ob_start();
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection details
$host = "localhost";
$db_username = "root"; // Assuming your username is root
$db_password = "";       // Assuming you have no password (empty string)
$db_name = "beauty_store";

// Establish database connection
$conn = mysqli_connect($host, $db_username, $db_password, $db_name);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

echo "<pre>Session at the very start of process_login.php:</pre>";
print_r($_SESSION);
echo "</pre>";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare SQL statement to fetch user data
    // Assuming you have 'username' and 'password' columns in your 'users' table
    $sql = "SELECT id, username, password FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            // Verify password - REPLACE WITH YOUR SECURE PASSWORD VERIFICATION
            if ($password == $user['password']) {
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $user['username'];
                $_SESSION['user_id'] = $user['id'];

                echo "<pre>Session after successful login in process_login.php:</pre>";
                print_r($_SESSION);
                echo "</pre>";

                header("Location: /checkout.php");
                exit();
            } else {
                // Incorrect password
                header("Location: login.php?error=Invalid username or password");
                exit();
            }
        } else {
            // User not found
            header("Location: login.php?error=Invalid username or password");
            exit();
        }
        mysqli_stmt_close($stmt);
    } else {
        // Error preparing statement
        header("Location: login.php?error=Database error");
        exit();
    }
} else {
    header("Location: login.php");
    exit();
}

mysqli_close($conn);
ob_end_flush();
?>
