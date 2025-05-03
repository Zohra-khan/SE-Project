<?php
// Database connection details
$host = 'localhost'; // Usually localhost
$dbname = 'your_database_name'; // Replace with your database name
$username = 'root'; // Default XAMPP MySQL username
$password = ''; // Default XAMPP MySQL password (empty)

// Create a connection to the database
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Capture user input from the form
$first_name = $_POST['first-name'];
$last_name = $_POST['last-name'];
$phone_number = $_POST['phone-number'];
$email = $_POST['email-address'];
$street_address = $_POST['street-address'];
$country = $_POST['country'];
$city = $_POST['city'];
$state = $_POST['state'];
$zip = $_POST['zip-code'];
$payment_method = $_POST['payment-method'];
$coupon = isset($_POST['coupon-code']) ? $_POST['coupon-code'] : NULL;

// Prepare the SQL query
$sql = "INSERT INTO customer_details 
    (first_name, last_name, phone_number, email, street_address, country, city, state, zip, payment_method, coupon)
    VALUES 
    (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

// Use prepared statement to prevent SQL injection
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssssssss", $first_name, $last_name, $phone_number, $email, $street_address, $country, $city, $state, $zip, $payment_method, $coupon);

// Execute the query
if ($stmt->execute()) {
    echo "Order placed successfully.";
    // Redirect or display confirmation message
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
