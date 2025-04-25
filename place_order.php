<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $delivery_name = $_POST['delivery_name'];
    $delivery_address = $_POST['delivery_address'];
    $delivery_city = $_POST['delivery_city'];
    $delivery_pincode = $_POST['delivery_pincode'];

    // For now, let's just display the confirmation
    echo "<!DOCTYPE html>";
    echo "<html lang='en'>";
    echo "<head>";
    echo "    <meta charset='UTF-8'>";
    echo "    <meta name='viewport' content='width=device-width, initial-scale=1.0'>";
    echo "    <title>Order Confirmation</title>";
    echo "    <link rel='stylesheet' href='assets/css/style.css'>";
    echo "</head>";
    echo "<body>";
    echo "    <h1>Order Confirmation</h1>";
    echo "    <p>Thank you for your order, " . htmlspecialchars($delivery_name) . "!</p>";
    echo "    <p>Your products will be delivered to the following address:</p>";
    echo "    <address>";
    echo "        " . nl2br(htmlspecialchars($delivery_address)) . "<br>";
    echo "        " . htmlspecialchars($delivery_city) . ", " . htmlspecialchars($delivery_pincode);
    echo "    </address>";
    echo "    <p>Your order will be delivered within 3-5 business days.</p>"; // Dummy delivery timeframe
    echo "    <p><a href='index.php'>Back to Homepage</a></p>";
    echo "</body>";
    echo "</html>";

    // In a real application, you would:
    // 1. Save the order details to the database (including user, cart items, and delivery address).
    // 2. Clear the user's cart from the session (unset($_SESSION['cart']);).
    // 3. Potentially send confirmation emails to the user and the store.

} else {
    // If accessed directly, redirect back to the checkout preview page
    header("Location: checkout_preview.php");
    exit();
}
?>
