<?php
session_start();
$host = "localhost";
$user = "root";
$password = "";
$database = "soidhaga-products";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "Added to cart"; // Default

if (isset($_POST['code']) && isset($_POST['quantity']) && isset($_POST['size'])) {
    $product_code = $_POST['code'];
    $quantity = (int) $_POST['quantity'];
    $size = $_POST['size'];
    $session_id = session_id();

    $stmt = $conn->prepare("SELECT price FROM products WHERE code = ?");
    $stmt->bind_param("s", $product_code);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $price = (int)$row['price'];
        $total_price = $price * $quantity;

        $check_cart = $conn->prepare("SELECT * FROM cart WHERE session_id = ? AND product_code = ? AND size = ?");
        $check_cart->bind_param("sss", $session_id, $product_code, $size);
        $check_cart->execute();
        $check_result = $check_cart->get_result();

        if ($check_result->num_rows > 0) {
            $message = "Product already in cart with this size!";
        } else {
            $insert = $conn->prepare("INSERT INTO cart (product_code, price, quantity, total_price, size, session_id) VALUES (?, ?, ?, ?, ?, ?)");
            $insert->bind_param("siisss", $product_code, $price, $quantity, $total_price, $size, $session_id);
            $insert->execute();
            $message = "Added to cart";
        }
    }
}

// Return plain text message only
echo $message;
?>
