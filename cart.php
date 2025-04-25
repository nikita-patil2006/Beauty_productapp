<?php
// Include the functions.php file.
include 'functions.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comely - Cart</title>
    <style>
        /* Basic CSS styling for the cart page (as before) */
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', sans-serif; }
        body { background-color: #fff5f8; }
        .navbar { background-color: #fff; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .logo { font-size: 28px; font-weight: bold; color: #e91e63; }
        .nav-links { list-style: none; display: flex; gap: 20px; }
        .nav-links li a { text-decoration: none; color: #333; font-weight: 500; }
        .nav-links li a.active { color: #e91e63; }
        .cart-container { padding: 30px; }
        .cart-item { display: flex; align-items: center; justify-content: space-between; background-color: #fff; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); margin-bottom: 20px; padding: 15px; }
        .cart-item img { width: 100px; height: 100px; object-fit: cover; border-radius: 10px; }
        .cart-item-details { flex-grow: 1; margin-left: 20px; }
        .cart-item-details h4 { font-size: 18px; color: #444; }
        .cart-item-details p { color: #888; margin: 5px 0; }
        .cart-item-details .quantity { display: flex; align-items: center; gap: 10px; }
        .cart-item-details .quantity input { width: 40px; padding: 5px; text-align: center; border-radius: 5px; border: 1px solid #ccc; }
        .cart-item-details .remove-btn { color: #e91e63; cursor: pointer; font-weight: 500; text-decoration: none; }
        .cart-total { display: flex; justify-content: flex-end; align-items: center; background-color: #fff; padding: 20px; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); margin-top: 30px; }
        .cart-total h3 { margin-right: 30px; color: #444; }
        .cart-total p { font-size: 20px; color: #e91e63; }
        .checkout-btn { background-color: #e91e63; color: #fff; border: none; padding: 12px 30px; border-radius: 25px; cursor: pointer; transition: 0.3s; }
        .checkout-btn:hover { background-color: #c2185b; }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="logo">Comely</div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="product.php">Products</a></li>
            <li><a href="cart.php" class="active">Cart</a></li>
            <li><a href="login.php">Login</a></li>
        </ul>
    </nav>

    <div class="cart-container">

        <?php
        $cart_items = get_cart_items();

        if (!empty($cart_items)):
        ?>
            <div id="cart-items-container">
            <?php
            $total_amount = 0;
            foreach ($cart_items as $item):
                $product_id = $item['product_id'];
                $quantity = $item['quantity'];

                $product_name = get_product_name($product_id);
                $product_price = get_product_price($product_id);
                $product_image = get_product_image($product_id); // Get the image filename

                // Debugging line (keep this for now)
                var_dump($product_image); echo "<br>";

                $total_amount += $product_price * $quantity;
            ?>
                <div class="cart-item" data-product-id="<?php echo $product_id; ?>">
                    <img src="/assets/images/<?php echo $product_image; ?>" alt="<?php echo htmlspecialchars($product_name); ?>">
                    <div class="cart-item-details">
                        <h4><?php echo htmlspecialchars($product_name); ?></h4>
                        <p>₹<?php echo number_format($product_price, 2); ?></p>
                        <div class="quantity">
                            <button class="quantity-btn minus">-</button>
                            <input type="text" value="<?php echo $quantity; ?>" class="quantity-input">
                            <button class="quantity-btn plus">+</button>
                        </div>
                        <a href="#" class="remove-btn" data-product-id="<?php echo $product_id; ?>">Remove</a>
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
            <div class="cart-total">
                <h3>Total:</h3>
                <p>₹<span id="total-amount"><?php echo number_format($total_amount, 2); ?></span></p>
            </div>

            <div class="cart-total">
                <button class="checkout-btn" onclick="window.location.href='login.php?redirect=checkout.php'">Proceed to Checkout</button>
            </div>

        <?php else: ?>
            <p>Your cart is currently empty.</p>
        <?php endif; ?>

    </div>

    <script>
        // JavaScript for quantity updates and item removal (as before)
        const quantityBtns = document.querySelectorAll('.quantity-btn');
        quantityBtns.forEach(btn => {
            btn.addEventListener('click', (e) => {
                const cartItem = e.target.closest('.cart-item');
                const productId = cartItem.dataset.productId;
                const inputField = cartItem.querySelector('.quantity-input');
                let currentValue = parseInt(inputField.value);
                if (e.target.classList.contains('plus')) { currentValue++; } else if (e.target.classList.contains('minus') && currentValue > 1) { currentValue--; }
                inputField.value = currentValue;
                updateQuantity(productId, currentValue);
            });
        });

        const quantityInputs = document.querySelectorAll('.quantity-input');
        quantityInputs.forEach(input => {
            input.addEventListener('change', (e) => {
                const cartItem = e.target.closest('.cart-item');
                const productId = cartItem.dataset.productId;
                let newValue = parseInt(e.target.value);
                if (isNaN(newValue) || newValue < 1) { newValue = 1; e.target.value = newValue; }
                updateQuantity(productId, newValue);
            });
        });

        function updateQuantity(productId, quantity) {
            fetch('cart_handler.php?action=update_quantity&product_id=' + productId, {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded', },
                body: 'quantity=' + quantity,
            })
            .then(response => { if (!response.ok) { throw new Error('Failed to update quantity'); } return response.json(); })
            .then(data => { console.log(data); updateTotalAmount(); })
            .catch(error => { console.error('Error:', error); alert('Failed to update quantity. Please try again.'); });
        }

        const removeBtns = document.querySelectorAll('.remove-btn');
        removeBtns.forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                const cartItem = e.target.closest('.cart-item');
                const productId = e.target.dataset.productId;
                fetch('cart_handler.php?action=remove_from_cart&product_id=' + productId)
                    .then(response => { if (!response.ok) { throw new Error('Failed to remove item'); } return response.json(); })
                    .then(data => { console.log(data); cartItem.remove(); updateTotalAmount(); if (document.querySelectorAll('.cart-item').length === 0) { const cartContainer = document.querySelector('.cart-container'); cartContainer.innerHTML = '<p>Your cart is currently empty.</p>'; } })
                    .catch(error => { console.error('Error:', error); alert('Failed to remove item. Please try again.'); });
            });
        });

        function updateTotalAmount() {
            const cartItems = document.querySelectorAll('.cart-item');
            let totalAmount = 0;
            cartItems.forEach(item => {
                const price = parseFloat(item.querySelector('p').textContent.replace('₹', ''));
                const quantity = parseInt(item.querySelector('.quantity input').value);
                totalAmount += price * quantity;
            });
            document.getElementById('total-amount').textContent = totalAmount.toFixed(2);
        }
    </script>
</body>
</html>
