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

// Sanitize and validate form data
$first_name = trim($_POST['first_name']);
$last_name  = trim($_POST['last_name']);
$email      = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
$complaint  = trim($_POST['complaint']);

if (!$email) {
    die("Invalid email address.");
}

// Insert into table
$sql = "INSERT INTO customer_care (first_name, last_name, email, complaint) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $first_name, $last_name, $email, $complaint);

if ($stmt->execute()) {
    header("Location: submission.html");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
