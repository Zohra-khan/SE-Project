<?php
session_start();
$session_id = session_id();

// Database connection parameters
$host = "localhost";
$user = "root";
$password = "";
$database = "soidhaga-products";

// Create a new connection to the database
$conn = new mysqli($host, $user, $password, $database);

// Check for connection error
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if quantity is set and valid
if (isset($_POST['quantity']) && isset($_POST['product_code']) && is_numeric($_POST['quantity'])) {
    $product_code = $_POST['product_code'];
    $quantity = (int) $_POST['quantity'];

    // Update the quantity in the cart
    $sql = "UPDATE cart SET quantity = ?, total_price = price * ? WHERE session_id = ? AND product_code = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiis", $quantity, $quantity, $session_id, $product_code);
    $stmt->execute();

    // Redirect back to the cart page
    header("Location: cart.php");
    exit;
} else {
    // Invalid input or quantity not set, redirect to the cart page
    header("Location: cart.php");
    exit;
}
?>
