<?php
// db_connect.php
$conn = mysqli_connect("localhost", "root", "", "beauty_store");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

