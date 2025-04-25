<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form was submitted using the POST method

    // Retrieve the form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // For now, let's just display the submitted data
    echo "<h2>Registration Details:</h2>";
    echo "<p>Name: " . htmlspecialchars($name) . "</p>";
    echo "<p>Email: " . htmlspecialchars($email) . "</p>";
    echo "<p>Password: " . htmlspecialchars($password) . "</p>";

    // In a real application, you would do the following:
    // 1. Validate the input data (e.g., check for empty fields, valid email format, password strength).
    // 2. Sanitize the input data to prevent security risks (e.g., using filter_var()).
    // 3. Connect to your database.
    // 4. Check if the email address is already registered.
    // 5. Hash the password securely before storing it in the database.
    // 6. Insert the user's information into the database.
    // 7. Redirect the user to a login success page or log them in.

} else {
    // If the page is accessed directly (not via form submission),
    // you might want to redirect the user back to the registration form.
    header("Location: register.php");
    exit();
}
?>