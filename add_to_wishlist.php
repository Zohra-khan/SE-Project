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

$message = "Error adding to wishlist";

if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    $session_id = session_id();

    // Check if item is already in wishlist
    $check = $conn->prepare("SELECT * FROM wishlist WHERE session_id = ? AND product_id = ?");
    $check->bind_param("ss", $session_id, $product_id);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        $message = "Already in wishlist!";
    } else {
        $insert = $conn->prepare("INSERT INTO wishlist (product_id, session_id) VALUES (?, ?)");
        $insert->bind_param("ss", $product_id, $session_id);
        if ($insert->execute()) {
            $message = "Added to wishlist";
        }
    }
}

echo $message;
?>
