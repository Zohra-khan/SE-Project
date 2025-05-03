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

if (isset($_POST['product_id']) && isset($_POST['quantity']) && isset($_POST['size'])) {
    $product_code = $_POST['product_id'];
    $quantity = (int) $_POST['quantity'];
    $size = $_POST['size'];
    $session_id = session_id();

    $stmt = $conn->prepare("SELECT price FROM products WHERE code = ?");
    $stmt->bind_param("s", $product_code);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $price = (int) $row['price'];
        $total_price = $price * $quantity;

        // Check if already in cart with same size
        $check = $conn->prepare("SELECT * FROM cart WHERE session_id = ? AND product_code = ? AND size = ?");
        $check->bind_param("sss", $session_id, $product_code, $size);
        $check->execute();
        $check_result = $check->get_result();

        if ($check_result->num_rows === 0) {
            // Not in cart yet, insert
            $insert = $conn->prepare("INSERT INTO cart (product_code, price, quantity, total_price, size, session_id) VALUES (?, ?, ?, ?, ?, ?)");
            $insert->bind_param("siisss", $product_code, $price, $quantity, $total_price, $size, $session_id);
            $insert->execute();
        }

        // Redirect to cart or checkout
        header("Location: cart.php");
        exit;
    }
}
echo "Invalid request.";
?>
