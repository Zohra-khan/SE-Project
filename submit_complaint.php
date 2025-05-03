<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "soidhaga-products";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch form data
$first_name = $_POST['first_name'];
$last_name  = $_POST['last_name'];
$email      = $_POST['email'];
$complaint  = $_POST['complaint'];

// Prepare the SQL query
$sql = "INSERT INTO customer_care (first_name, last_name, email, complaint) 
        VALUES (?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $first_name, $last_name, $email, $complaint);

if ($stmt->execute()) {
    // Redirect on success
    header("Location: submission.html");
    exit(); // always call exit after header redirect
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
