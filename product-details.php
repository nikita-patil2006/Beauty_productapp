<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .navbar {
            background-color: #333;
            overflow: hidden;
        }

        .navbar a {
            float: left;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
        }

        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center; /* Center content horizontally */
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        #product-image {
            width: 300px;
            height: 300px;
            object-fit: cover;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        #product-details {
            text-align: center;
        }

        #product-details h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        #product-details p {
            font-size: 16px;
            margin-bottom: 10px;
        }

        #product-details button {
            padding: 10px 20px;
            background-color: #e91e63;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
            margin-top: 10px;
        }

        #product-details button:hover {
            background-color: #c2185b;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <a href="index.php">Home</a>
        <a href="product.php">Products</a>
        <a href="cart.php">Cart</a>
        <a href="login.php">Login</a>
    </nav>

    <div class="container">
        <?php
            // Get the product name from the query string
            $productName = isset($_GET['product']) ? $_GET['product'] : '';

            // In a real application, you would retrieve the product details from a database
            // based on the product name.  For this example, we'll just use a switch statement
            // to provide some sample data.
            switch ($productName) {
                case 'Glow Serum':
                    $productImage = 'assets/images/skincare.jpg'; // ADJUST IF NEEDED
                    $productTitle = 'Glow Serum';
                    $productDescription = 'A luxurious serum that will make your skin glow.';
                    $productPrice = '₹599';
                    break;
                case 'Matte Lipstick':
                    $productImage = 'assets/images/makeup.jpg'; // ADJUST IF NEEDED
                    $productTitle = 'Matte Lipstick';
                    $productDescription = 'A long-lasting, matte lipstick in a variety of shades.';
                    $productPrice = '₹399';
                    break;
                case 'Argan Shampoo':
                    $productImage = 'assets/images/haircare.jpg'; // ADJUST IF NEEDED
                    $productTitle = 'Argan Shampoo';
                    $productDescription = 'A nourishing shampoo infused with argan oil.';
                    $productPrice = '₹699';
                    break;
                case 'Fresh Mist Perfume':
                    $productImage = 'assets/images/fragrance.jpg'; // ADJUST IF NEEDED
                    $productTitle = 'Fresh Mist Perfume';
                    $productDescription = 'A refreshing and invigorating perfume.';
                    $productPrice = '₹899';
                    break;
                case 'Rose Body Wash':
                    $productImage = 'assets/images/bath.jpg'; // ADJUST IF NEEDED
                    $productTitle = 'Rose Body Wash';
                    $productDescription = 'A gentle body wash with the delicate scent of roses.';
                    $productPrice = '₹499';
                    break;
                case 'Skin Glow Gummies':
                    $productImage = 'assets/images/wellness.jpg'; // ADJUST IF NEEDED
                    $productTitle = 'Skin Glow Gummies';
                    $productDescription = 'Delicious gummies that promote healthy, glowing skin.';
                    $productPrice = '₹799';
                    break;
                case 'Matte Nail Polish':
                    $productImage = 'assets/images/nails.jpg'; // ADJUST IF NEEDED
                    $productTitle = 'Matte Nail Polish';
                    $productDescription = 'A trendy, matte nail polish in various colors.';
                    $productPrice = '₹199';
                    break;
                case 'Pro Brush Kit':
                    $productImage = 'assets/images/tools.jpg'; // ADJUST IF NEEDED
                    $productTitle = 'Pro Brush Kit';
                    $productDescription = 'A set of professional-quality brushes for makeup application.';
                    $productPrice = '₹999';
                    break;
                case 'Top Seller Face Cream':
                    $productImage = 'assets/images/best.jpg'; // ADJUST IF NEEDED
                    $productTitle = 'Top Seller Face Cream';
                    $productDescription = 'Our best-selling face cream for all skin types.';
                    $productPrice = '₹649';
                    break;
                default:
                    $productImage = '';
                    $productTitle = 'Product Not Found';
                    $productDescription = 'Sorry, the product you are looking for could not be found.';
                    $productPrice = '';
            }
        ?>

        <img id="product-image" src="<?php echo $productImage; ?>" alt="<?php echo $productTitle; ?>">
        <div id="product-details">
            <h2><?php echo $productTitle; ?></h2>
            <p><?php echo $productDescription; ?></p>
            <p>Price: <?php echo $productPrice; ?></p>
            <button>Add to Cart</button>
        </div>
    </div>
</body>
</html>