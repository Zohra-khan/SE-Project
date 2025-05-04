<?php
session_start();

// --- DB CONNECTION ---
$servername = "localhost";
$username = "root"; 
$password = "";  
$database = "soidhaga-products";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// --- GET THE COUPON CODE ---
if (isset($_POST['coupon_code'])) {
    $coupon_code = trim($_POST['coupon_code']);

    // Query to check if the coupon code exists in the database
    $stmt = $conn->prepare("SELECT discount FROM coupons WHERE coupon_code = ?");
    $stmt->bind_param("s", $coupon_code);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // Coupon code is valid, return the discount
        $_SESSION['coupon_code'] = $coupon_code;  // Store coupon in session
        $_SESSION['coupon_discount'] = $row['discount']; // Store discount in session
        
        echo json_encode([
            'status' => 'valid',
            'discount' => $row['discount'],
            'message' => "Coupon code $coupon_code applied! You get " . $row['discount'] . "% off!"
        ]);
    } else {
        // Coupon code is invalid
        echo json_encode([
            'status' => 'invalid',
            'message' => 'Invalid coupon code.'
        ]);
    }
} else {
    // No coupon code submitted
    echo json_encode([
        'status' => 'error',
        'message' => 'No coupon code provided.'
    ]);
}

$conn->close();
?>
