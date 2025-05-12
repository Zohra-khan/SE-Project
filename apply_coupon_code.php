<?php
session_start();

// --- DATABASE CONNECTION ---
$servername = "localhost";
$username = "root";
$password = "";
$database = "soidhaga-products";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    echo json_encode(['status' => 'error', 'message' => 'Database connection failed.']);
    exit;
}

// --- CHECK IF COUPON CODE IS SET ---
if (!isset($_SESSION['coupon_code'])) {
    echo json_encode(['status' => 'error', 'message' => 'No coupon code found in session.']);
    exit;
}

$couponCode = $_SESSION['coupon_code'];

// --- FETCH DISCOUNT FROM COUPONS TABLE ---
$couponSql = "SELECT discount FROM coupons WHERE coupon_code = ?";
$couponStmt = $conn->prepare($couponSql);
$couponStmt->bind_param("s", $couponCode);
$couponStmt->execute();
$couponResult = $couponStmt->get_result();

if ($couponResult->num_rows === 0) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid coupon code.']);
    exit;
}

$couponRow = $couponResult->fetch_assoc();
$discount = floatval($couponRow['discount']); 

$_SESSION['coupon_discount'] = $discount;

// --- APPLY DISCOUNT TO CART FOR THIS SESSION ---
$session_id = session_id();
$updateSql = "UPDATE cart SET total_price = total_price * (1 - ?) WHERE session_id = ?";
$updateStmt = $conn->prepare($updateSql);

if ($updateStmt === false) {
    echo json_encode(['status' => 'error', 'message' => 'Failed to prepare cart update query.']);
    exit;
}

$updateStmt->bind_param("ds", $discount, $session_id);
if ($updateStmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'Coupon applied to cart successfully.']);
    exit;
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to apply discount.']);
    exit;
}
?>
