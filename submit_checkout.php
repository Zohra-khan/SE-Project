<?php
$servername = "localhost";
$username = "root";    
$password = "";        
$dbname = "soidhaga-products"; 

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Sanitize and fetch POST data
$first_name     = $_POST['first_name'];
$last_name      = $_POST['last_name'];
$phone_number   = $_POST['phone_number'];
$email          = $_POST['email'];
$street_address = $_POST['street_address'];
$country        = $_POST['country'];
$city           = $_POST['city'];
$state          = $_POST['state'];
$zip            = $_POST['zip'];
$payment_method = $_POST['payment_method'];
$coupon_code    = !empty($_POST['coupon_code']) ? $_POST['coupon_code'] : NULL;

// Prepare the SQL statement
$sql = "INSERT INTO customers (
    first_name, last_name, phone_number, email,
    street_address, country, city, state, zip,
    payment_method, coupon_code
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "sssssssssss",
    $first_name, $last_name, $phone_number, $email,
    $street_address, $country, $city, $state, $zip,
    $payment_method, $coupon_code
);

if ($stmt->execute()) {
    if ($payment_method === 'credit card') {
        header("Location: cardInfo.html");
    } else {
        header("Location: successfulPurchase.php");
    }
    exit;
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
