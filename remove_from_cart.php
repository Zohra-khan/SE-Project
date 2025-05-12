<?php
session_start();

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

// Check if the product_code is provided
if (isset($_POST['product_code'])) {
    $product_code = $_POST['product_code'];
    $session_id = session_id();

    // Remove the item from the database
    $deleteQuery = "DELETE FROM cart WHERE product_code = ? AND session_id = ?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("ss", $product_code, $session_id);
    
    if ($stmt->execute()) {
        // Also remove from the session cart array
        if (isset($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $index => $item) {
                if ($item['product_code'] == $product_code) {
                    unset($_SESSION['cart'][$index]);
                    break;
                }
            }
            $_SESSION['cart'] = array_values($_SESSION['cart']); // Re-index
        }

        $_SESSION['cart_message'] = "Item removed from cart.";
    } else {
        $_SESSION['cart_message'] = "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    $_SESSION['cart_message'] = "Error: Product code is missing.";
}

// Close the database connection
$conn->close();

// Redirect back to cart page
header("Location: cart.php");
exit;
?>
