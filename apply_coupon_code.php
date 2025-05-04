<?php
session_start();

// --- DATABASE CONNECTION ---
$servername = "localhost";
$username = "root";
$password = "";
$database = "soidhaga-products";

// Create DB connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    echo json_encode(['status' => 'error', 'message' => 'Database connection failed.']);
    exit;
}

// --- CHECK IF DISCOUNT IS STORED IN SESSION ---
if (!isset($_SESSION['coupon_discount'])) {
    echo json_encode(['status' => 'error', 'message' => 'No discount found in session.']);
    exit;
}

$discount = floatval($_SESSION['coupon_discount']);

// --- APPLY DISCOUNT TO ALL CART ITEMS ---
$updateSql = "UPDATE cart SET total_price = total_price * (1 - ? / 100)";
$updateStmt = $conn->prepare($updateSql);

// Check if the statement was prepared successfully
if ($updateStmt === false) {
    echo json_encode(['status' => 'error', 'message' => 'Error preparing update query.']);
    exit;
}

// Bind the discount parameter and execute the update
$updateStmt->bind_param("d", $discount); // "d" means double
if ($updateStmt->execute()) {
    // After successfully applying the discount, redirect back to checkout.php
    header("Location: checkout.php");
    exit();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to update cart total prices.']);
    exit();
}
?>
