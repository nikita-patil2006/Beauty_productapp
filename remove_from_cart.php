<?php
session_start();
include 'db_connect.php'; // Database connection

// Check if product ID is set and valid
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Check if cart session exists
    if (isset($_SESSION['cart'])) {
        // Remove product from the cart
        $key = array_search($product_id, $_SESSION['cart']);
        if ($key !== false) {
            unset($_SESSION['cart'][$key]);
        }
    }
}

// Redirect to cart page
header("Location: cart.php");
?>
