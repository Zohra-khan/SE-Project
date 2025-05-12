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

// Ensure the 'wishlist_id' is present in the POST data
if (isset($_POST['wishlist_id'])) {
    // Get the wishlist ID from the form
    $wishlist_id = $_POST['wishlist_id'];

    // Remove the item from the wishlist
    $sql = "DELETE FROM wishlist WHERE wishlist_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $wishlist_id); 
    if ($stmt->execute()) {
        $_SESSION['wishlist_message'] = "Item removed from wishlist.";
    } else {
        $_SESSION['wishlist_message'] = "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
} else {
    $_SESSION['wishlist_message'] = "Error: Wishlist ID is missing.";
}

// Close the database connection
$conn->close();

// Redirect back to wishlist page
header("Location: wishlist.php");
exit;
?>
