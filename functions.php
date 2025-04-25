<?php
// functions.php
session_start();
include 'db_connect.php'; // Include your database connection

function get_product_name($product_id) {
    global $conn;
    $sql = "SELECT name FROM products WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $product_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($result)) {
        return $row['name'];
    } else {
        return 'Unknown Product';
    }
    mysqli_stmt_close($stmt);
}

function add_to_cart($product_id) {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    $found = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['product_id'] == $product_id) {
            $item['quantity']++;
            $found = true;
            break;
        }
    }
    if (!$found) {
        $_SESSION['cart'][] = ['product_id' => $product_id, 'quantity' => 1];
    }
}

function get_cart_items() {
    return $_SESSION['cart'] ?? [];
}

function clear_cart() {
    $_SESSION['cart'] = [];
}

function remove_from_cart($product_id) {
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $key => $item) {
            if ($item['product_id'] == $product_id) {
                unset($_SESSION['cart'][$key]);
                $_SESSION['cart'] = array_values($_SESSION['cart']);
                break;
            }
        }
    }
}

function update_quantity($product_id, $quantity) {
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['product_id'] == $product_id) {
                $item['quantity'] = $quantity;
                if ($item['quantity'] <= 0) {
                    remove_from_cart($product_id);
                }
                break;
            }
        }
    }
}

function get_product_price($product_id) {
    global $conn;
    $sql = "SELECT price FROM products WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $product_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($result)) {
        return $row['price'];
    } else {
        return 0;
    }
    mysqli_stmt_close($stmt);
}

function get_product_image($product_id) {
    global $conn;
    $sql = "SELECT image FROM products WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $product_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($result)) {
        return $row['image'];
    } else {
        return 'default.jpg';
    }
    mysqli_stmt_close($stmt);
}
?>
