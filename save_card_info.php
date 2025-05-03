<?php
$host = "localhost";
$username = "root"; 
$password = "";    
$dbname = "soidhaga-products";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$cardholder_name = $_POST['cardholder_name'];
$card_number = $_POST['card_number'];
$expiry_month = $_POST['expiry_month'];
$expiry_year = $_POST['expiry_year'];
$security_code = $_POST['security_code'];
$postal_code = $_POST['postal_code'];

$sql = "INSERT INTO card_info (cardholder_name, card_number, expiry_month, expiry_year, security_code, postal_code)
        VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss", $cardholder_name, $card_number, $expiry_month, $expiry_year, $security_code, $postal_code);

if ($stmt->execute()) {
  header("Location: successfulPurchase.php");
  exit();
} else {
  echo "Error: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
