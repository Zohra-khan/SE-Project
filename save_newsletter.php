<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "soidhaga-products";

// Connect to DB
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get email from POST
$email = $_POST['email'];

// Prepare and execute insert (preventing duplicates with IGNORE)
$sql = "INSERT IGNORE INTO newsletter (email) VALUES (?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);

if ($stmt->execute()) {
    echo "<script>window.parent.location.href = 'submission.html';</script>";
    exit();
}
else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>