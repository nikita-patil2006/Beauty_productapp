<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <h1>Register</h1>
    <form action="process_register.php" method="post">
        <p>Name: <input type="text" name="name"></p>
        <p>Email: <input type="email" name="email"></p>
        <p>Password: <input type="password" name="password"></p>
        <p><button type="submit">Register</button></p>
    </form>
    <p><a href="login.php">Login</a></p>
    <p><a href="index.php">Back to Home</a></p>
    <script src="assets/js/script.js"></script>
</body>
</html>