<?php
session_start();
include('db_connect.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$orderPlaced = false;
$deliveryDate = date('Y-m-d', strtotime('2025-01-15')); // Set a fixed delivery date
$errorMessage = null;

if (isset($_POST['place_order'])) {
    $userId = $_SESSION['user_id'];
    $customerName = mysqli_real_escape_string($conn, $_POST['customer_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $zip = mysqli_real_escape_string($conn, $_POST['zip']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);

    // 1. Insert into the 'orders' table
    $orderQuery = "INSERT INTO orders (user_id, customer_name, email, address, city, state, zip, phone, order_date)
                   VALUES ('$userId', '$customerName', '$email', '$address', '$city', '$state', '$zip', '$phone', NOW())";

    if (mysqli_query($conn, $orderQuery)) {
        $orderId = mysqli_insert_id($conn);
        $totalAmount = 0;
        $orderItemsInserted = true;

        // 2. Insert into 'order_items'
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $item) {
                $productId = $item['product_id'];
                $quantity = $item['quantity'];

                // Fetch product price from the database
                $priceQuery = "SELECT price FROM products WHERE id = '$productId'";
                $priceResult = mysqli_query($conn, $priceQuery);
                if ($priceResult && $row = mysqli_fetch_assoc($priceResult)) {
                    $itemPrice = $row['price'];
                    $totalAmount += $itemPrice * $quantity;

                    $orderItemQuery = "INSERT INTO order_items (order_id, product_id, quantity, price, product_name)
                                       SELECT '$orderId', '$productId', '$quantity', '$itemPrice', name
                                       FROM products WHERE id = '$productId'";
                    if (!mysqli_query($conn, $orderItemQuery)) {
                        $errorMessage = "Error adding item to order: " . mysqli_error($conn);
                        $orderItemsInserted = false;
                        break; // Stop if there's an error adding an item
                    }
                } else {
                    $errorMessage = "Error fetching product price.";
                    $orderItemsInserted = false;
                    break; // Stop if there's an error fetching price
                }
            }

            // 3. Update the 'orders' table with the total amount if items were inserted successfully
            if ($orderItemsInserted) {
                $updateOrderQuery = "UPDATE orders SET total_amount = '$totalAmount' WHERE id = '$orderId'";
                if (!mysqli_query($conn, $updateOrderQuery)) {
                    $errorMessage = "Error updating order total: " . mysqli_error($conn);
                } else {
                    // 4. Clear the cart
                    unset($_SESSION['cart']);
                    $orderPlaced = true;
                }
            } else {
                // If there was an error inserting order items, you might want to delete the order record
                $deleteOrderQuery = "DELETE FROM orders WHERE id = '$orderId'";
                mysqli_query($conn, $deleteOrderQuery);
                $errorMessage = "Error placing order. Please try again.";
            }

        } else {
            $errorMessage = "Your cart is empty.";
        }

    } else {
        $errorMessage = "Error creating order: " . mysqli_error($conn);
    }
}

$userShippingAddress = '';
$userName = '';
$userEmail = '';
$userQuery = "SELECT username, shipping_address FROM users WHERE id = '{$_SESSION['user_id']}'";
$userResult = mysqli_query($conn, $userQuery);
if ($userResult && mysqli_num_rows($userResult) > 0) {
    $userData = mysqli_fetch_assoc($userResult);
    $userShippingAddress = $userData['shipping_address'];
    $userName = $userData['username'];
    $userEmail = $userData['username'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comely - Checkout</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Basic styling remains */
        body { font-family: 'Arial', sans-serif; background-color: #f8f9fa; margin: 0; padding: 0; display: flex; flex-direction: column; align-items: center; padding-top: 60px; }
        .navbar { background-color: #343a40; color: white; padding: 15px 0; text-align: center; margin-bottom: 30px; width: 100%; position: fixed; top: 0; left: 0; z-index: 1000; }
        .navbar .logo { font-size: 24px; font-weight: bold; }
        .navbar .nav-links { list-style: none; padding: 0; margin: 10px 0 0; }
        .navbar .nav-links li { display: inline; margin: 0 15px; }
        .navbar .nav-links li a { color: white; text-decoration: none; transition: color 0.3s ease; }
        .navbar .nav-links li a:hover { color: #f8f9fa; }
        .checkout-container { background-color: #ffffff; padding: 40px; border-radius: 8px; box-shadow: 0 0 20px rgba(0, 0, 0, 0.1); width: 90%; max-width: 960px; margin-top: 20px; display: flex; flex-direction: column; align-items: center; }
        h2 { color: #e44d26; text-align: center; margin-bottom: 25px; }
        label { display: block; margin-bottom: 10px; color: #495057; font-weight: bold; }
        input[type="text"], input[type="email"], input[type="tel"], textarea { width: 100%; padding: 12px; margin-bottom: 20px; border: 1px solid #ced4da; border-radius: 4px; box-sizing: border-box; font-size: 16px; }
        button[type="submit"] { background-color: #e44d26; color: white; padding: 15px 30px; border: none; border-radius: 6px; cursor: pointer; font-size: 18px; transition: background-color 0.3s ease; width: 100%; }
        button[type="submit"]:hover { background-color: #c0392b; }
        .order-confirmation { background-color: #d4edda; color: #155724; padding: 20px; border-radius: 6px; margin-top: 20px; text-align: center; border: 1px solid #c3e6cb; }
        .order-confirmation h2 { color: #28a745; margin-bottom: 15px; }
        .order-confirmation p { font-size: 16px; margin-bottom: 10px; }
        .order-confirmation a { color: #e44d26; text-decoration: none; font-weight: bold; }
        .order-confirmation a:hover { text-decoration: underline; }
        .empty-cart { text-align: center; padding: 20px; color: #777; }
        .cart-summary { display: none; } /* Hide cart summary */
        .total-amount { display: none; } /* Hide total amount */
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="logo">Comely</div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="products.php">Products</a></li>
            <li><a href="cart.php">Cart</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <div class="checkout-container">
        <h2>Checkout</h2>

        <?php if (isset($errorMessage)): ?>
            <p style="color: red;"><?php echo $errorMessage; ?></p>
        <?php endif; ?>

        <?php if (!$orderPlaced): ?>
            <p>Please enter your shipping details:</p>
            <form method="POST" action="checkout.php">
                <label for="customer_name">Name:</label>
                <input type="text" id="customer_name" name="customer_name" value="<?php echo htmlspecialchars($userName); ?>" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($userEmail); ?>" required>

                <label for="address">Detailed Address:</label>
                <textarea id="address" name="address" rows="3" required><?php echo htmlspecialchars($userShippingAddress); ?></textarea>

                <label for="city">City:</label>
                <input type="text" id="city" name="city" required>

                <label for="state">State/Province:</label>
                <input type="text" id="state" name="state" required>

                <label for="zip">PIN Code:</label>
                <input type="text" id="zip" name="zip" required>

                <label for="phone">Phone Number:</label>
                <input type="tel" id="phone" name="phone" required>

                <button type="submit" name="place_order">Place Order</button>
            </form>
        <?php else: ?>
            <div class="order-confirmation">
                <h2 style="color: #28a745;">Order Placed Successfully!</h2>
                <p>Thank you for your order, <?php echo htmlspecialchars($_POST['customer_name']); ?>!</p>
                <p>Your order will be delivered on: <strong>January 15, 2025</strong></p>
                <p><a href="index.php">Continue Shopping</a></p>
            </div>
        <?php endif; ?>
    </div>

</body>
</html>
