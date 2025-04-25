<?php
session_start();

$response = array();

if (isset($_POST['action']) && $_POST['action'] === 'add_to_cart' && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Check if the product is already in the cart (as a product ID string)
    $found_string = array_search($product_id, $_SESSION['cart']);
    if ($found_string !== false) {
        // If found as a string, update it to the array format with quantity 1
        $_SESSION['cart'][$found_string] = ['product_id' => $product_id, 'quantity' => 1];
    } else {
        // Check if the product is already in the cart (as an array)
        $found_array = false;
        foreach ($_SESSION['cart'] as &$item) {
            if (isset($item['product_id']) && $item['product_id'] == $product_id) {
                $item['quantity'] = (isset($item['quantity']) ? $item['quantity'] + 1 : 1);
                $found_array = true;
                break;
            }
        }
        // If not found in either format, add it as a new array
        if (!$found_array) {
            $_SESSION['cart'][] = ['product_id' => $product_id, 'quantity' => 1];
        }
    }

    error_log("Cart contents after adding " . $product_id . ": " . print_r($_SESSION['cart'], true)); // Debugging

    $response['status'] = 'success';
    $response['message'] = 'Product added to cart.';
    $response['cart_contents'] = $_SESSION['cart']; // Include cart contents for debugging

} else {
    $response['status'] = 'error';
    $response['message'] = 'Failed to add product to cart. Missing product ID or invalid action.';
}

// Set the content type to application/json
header('Content-Type: application/json');

// Encode the response array as JSON and echo it
echo json_encode($response);
?>
