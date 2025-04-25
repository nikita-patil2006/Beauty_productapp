<?php
echo "product.php: Before session_start()<br>";
session_start();
echo "product.php: After session_start()<br>";

include('db_connect.php'); // Include your database connection

// Fetch product IDs and names from the database
$sql = "SELECT id, name FROM products";
$result = mysqli_query($conn, $sql);
$productIds = [];
while ($row = mysqli_fetch_assoc($result)) {
    $productIds[$row['name']] = $row['id'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comely - Products</title>
    <style>
        /* Your CSS styles here */
        h1{
            font-family: Arial, Helvetica, sans-serif;
        }
        h2{
            padding: 25px;
            font-family: Arial, Helvetica, sans-serif;
        }


        /* product list css */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            display: flex;
            gap: 20px;
        }

        .sidebar {
            width: 25%;
            background-color: #f4f4f4;
            padding: 20px;
        }

        .sidebar h3 {
            margin-bottom: 10px;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar ul li {
            padding: 10px;
            border-bottom: 1px solid #ccc;
        }

        .sidebar ul li a {
            text-decoration: none;
            color: #333;
        }

        .products {
            width: 75%;
        }

        .products h2 {
            margin-bottom: 20px;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .product-card {
            border: 1px solid #ccc;
            padding: 15px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .product-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            margin-bottom: 10px;
        }

        .product-card h4 {
            margin-bottom: 5px;
        }

        .product-card p {
            margin-bottom: 10px;
            font-weight: bold;
        }

        .product-card button {
            padding: 10px;
            background-color: #e91e63;
            color: white;
            border: none;
            cursor: pointer;
            margin: 5px;
        }
        .product-card button:hover {
            background-color: #c2185b;
        }

        .category-label{
            background-color: #f0f4c3;
            padding: 5px;
            border-radius: 5px;
            font-size: 12px;
            color: #689f38;
        }

    </style>
</head>
<body>

    <nav class="navbar">
        <div class="logo">Comely</div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="product.php" class="active">Products</a></li>
            <li><a href="cart.php">Cart</a></li>
            <li><a href="login.php">Login</a></li>
        </ul>
    </nav>

    <div class="container">

        <aside class="sidebar">
            <h3>Categories</h3>
            <ul>
                <li><a href="#">Haircare</a></li>
                <li><a href="#">Skincare</a></li>
                <li><a href="#">Makeup</a></li>
                <li><a href="#">Fragrance</a></li>
                <li><a href="#">Bath & Body</a></li>
                <li><a href="#">Wellness</a></li>
                <li><a href="#">Nail Care</a></li>
                <li><a href="#">Beauty Tools</a></li>
                <li><a href="#">Trending</a></li>
                <li><a href="#">Best Sellers</a></li>
            </ul>
        </aside>

        <section class="products">
            <h2>Our Best Picks</h2>
            <div class="product-grid">

                <div class="product-card">
                    <span class="category-label">Skincare</span>
                    <img src="assets/images/skincare.jpg" alt="Skincare Product">
                    <h4>Glow Serum</h4>
                    <p>₹599</p>
                    <button onclick="addToCart(<?php echo isset($productIds['Glow Serum']) ? $productIds['Glow Serum'] : ''; ?>)">Add to Cart</button>
                    <button onclick="viewProductDetails('Glow Serum')">View Details</button>
                </div>

                <div class="product-card">
                    <span class="category-label">Makeup</span>
                    <img src="assets/images/makeup.jpg" alt="Makeup Product">
                    <h4>Matte Lipstick</h4>
                    <p>₹399</p>
                    <button onclick="addToCart(<?php echo isset($productIds['Matte Lipstick']) ? $productIds['Matte Lipstick'] : ''; ?>)">Add to Cart</button>
                    <button onclick="viewProductDetails('Matte Lipstick')">View Details</button>
                </div>

                <div class="product-card">
                    <span class="category-label">Haircare</span>
                    <img src="assets/images/haircare.jpg" alt="Haircare Product">
                    <h4>Argan Shampoo</h4>
                    <p>₹699</p>
                    <button onclick="addToCart(<?php echo isset($productIds['Argan Shampoo']) ? $productIds['Argan Shampoo'] : ''; ?>)">Add to Cart</button>
                    <button onclick="viewProductDetails('Argan Shampoo')">View Details</button>
                </div>

                <div class="product-card">
                    <span class="category-label">Fragrance</span>
                    <img src="assets/images/fragrance.jpg" alt="Perfume">
                    <h4>Fresh Mist Perfume</h4>
                    <p>₹899</p>
                    <button onclick="addToCart(<?php echo isset($productIds['Fresh Mist Perfume']) ? $productIds['Fresh Mist Perfume'] : ''; ?>)">Add to Cart</button>
                    <button onclick="viewProductDetails('Fresh Mist Perfume')">View Details</button>
                </div>

                <div class="product-card">
                    <span class="category-label">Bath & Body</span>
                    <img src="assets/images/bath.jpg" alt="Body Wash">
                    <h4>Rose Body Wash</h4>
                    <p>₹499</p>
                    <button onclick="addToCart(<?php echo isset($productIds['Rose Body Wash']) ? $productIds['Rose Body Wash'] : ''; ?>)">Add to Cart</button>
                    <button onclick="viewProductDetails('Rose Body Wash')">View Details</button>
                </div>

                <div class="product-card">
                    <span class="category-label">Wellness</span>
                    <img src="assets/images/wellness.jpg" alt="Vitamins">
                    <h4>Skin Glow Gummies</h4>
                    <p>₹799</p>
                    <button onclick="addToCart(<?php echo isset($productIds['Skin Glow Gummies']) ? $productIds['Skin Glow Gummies'] : ''; ?>)">Add to Cart</button>
                    <button onclick="viewProductDetails('Skin Glow Gummies')">View Details</button>
                </div>

                <div class="product-card">
                    <span class="category-label">Nail Care</span>
                    <img src="assets/images/nails.jpg" alt="Nail Paint">
                    <h4>Matte Nail Polish</h4>
                    <p>₹199</p>
                    <button onclick="addToCart(<?php echo isset($productIds['Matte Nail Polish']) ? $productIds['Matte Nail Polish'] : ''; ?>)">Add to Cart</button>
                    <button onclick="viewProductDetails('Matte Nail Polish')">View Details</button>
                </div>

                <div class="product-card">
                    <span class="category-label">Beauty Tools</span>
                    <img src="assets/images/tools.jpg" alt="Brush Set">
                    <h4>Pro Brush Kit</h4>
                    <p>₹999</p>
                    <button onclick="addToCart(<?php echo isset($productIds['Pro Brush Kit']) ? $productIds['Pro Brush Kit'] : ''; ?>)">Add to Cart</button>
                    <button onclick="viewProductDetails('Pro Brush Kit')">View Details</button>
                </div>

                <div class="product-card">
                    <span class="category-label">Best Sellers</span>
                    <img src="assets/images/best.jpg" alt="Top Seller">
                    <h4>Top Seller Face Cream</h4>
                    <p>₹649</p>
                    <button onclick="addToCart(<?php echo isset($productIds['Top Seller Face Cream']) ? $productIds['Top Seller Face Cream'] : ''; ?>)">Add to Cart</button>
                    <button onclick="viewProductDetails('Top Seller Face Cream')">View Details</button>
                </div>

            </div>
        </section>

    </div>
    <script>
        function viewProductDetails(productName) {
            window.location.href = "product-details.php?product=" + productName;
        }

        function addToCart(productId) { // Now receives productId
            console.log("addToCart called with productId:", productId);
            fetch('cart_handler.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'action=add_to_cart&product_id=' + productId, // Sending productId
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to add to cart');
                }
                return response.json();
            })
            .then(data => {
                console.log(data);
                alert(data.message);
                // window.location.href='cart.php'; //removed
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to add product to cart. Please try again.');
            });
        }
    </script>
</body>
</html>
<?php
mysqli_close($conn);
?>