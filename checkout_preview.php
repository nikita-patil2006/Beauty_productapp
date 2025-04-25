<?php
session_start();

// For this example, we'll assume the user is logged in if they are here.
if (!isset($_SESSION['user_logged_in'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit();
}

// Dummy product data (replace with database retrieval later)
$products = [
    '1' => ['name' => 'Comely Luxe Lipstick', 'price' => 15.99],
    '2' => ['name' => 'Comely Hydrating Cream', 'price' => 22.50],
    // Add more product details as needed
];

// Calculate subtotal
$subtotal = 0;
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $product_id) {
        if (isset($products[$product_id])) {
            $subtotal += $products[$product_id]['price'];
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Preview</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <h1>Checkout</h1>

    <h2>Your Cart Items:</h2>
    <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
        <ul>
            <?php
            $item_counts = array_count_values($_SESSION['cart']);
            foreach ($item_counts as $product_id => $quantity):
                if (isset($products[$product_id])):
                    $product = $products[$product_id];
                    $total_price = $product['price'] * $quantity;
                    echo "<li>" . htmlspecialchars($product['name']) . " (Quantity: " . $quantity . ") - ₹" . number_format($total_price, 2) . "</li>";
                endif;
            endforeach;
            ?>
        </ul>
        <p><strong>Subtotal: ₹<?php echo number_format($subtotal, 2); ?></strong></p>

        <h2>Delivery Address:</h2>
        <form action="place_order.php" method="post">
            <p>Name: <input type="text" name="delivery_name" required></p>
            <p>Address: <textarea name="delivery_address" rows="4" cols="30" required></textarea></p>
            <p>City: <input type="text" name="delivery_city" required></p>
            <p>Pincode: <input type="text" name="delivery_pincode" required></p>
            <button type="submit">Submit Order</button>
        </form>
    <?php else: ?>
        <p>Your cart is empty. <a href="product.php">Continue Shopping</a></p>
    <?php endif; ?>

    <p><a href="cart.php">Back to Cart</a></p>
</body>
</html>
