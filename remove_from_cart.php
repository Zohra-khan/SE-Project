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

// Check if the product_code (or cart_id) is provided
if (isset($_POST['product_code'])) {
    $product_code = $_POST['product_code'];
    $session_id = session_id();

    // Remove the item from the database
    $deleteQuery = "DELETE FROM cart WHERE product_code = ? AND session_id = ?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("ss", $product_code, $session_id);
    $stmt->execute();

    // Check if the query was successful
    if ($stmt->affected_rows > 0) {
        // Successfully removed from the database, now remove from the session as well
        if (isset($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $index => $item) {
                if ($item['product_code'] == $product_code) {
                    unset($_SESSION['cart'][$index]); // Remove item from session
                    break;
                }
            }
            // Re-index the session array to prevent gaps
            $_SESSION['cart'] = array_values($_SESSION['cart']);
        }
        // Redirect to the cart page after removal
        header("Location: cart.php");
        exit;
    } else {
        echo "Failed to remove product from the cart.";
    }
} else {
    echo "Invalid request.";
}

// Close the database connection
$conn->close();
?>
