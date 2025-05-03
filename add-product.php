<?php
// Database connection
$conn = mysqli_connect("localhost", "root", "", "soidhaga-products");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Function to insert data
function insert($conn, $sql) {
    if ($conn->query($sql) === TRUE) {
        // Optional: echo "Product inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Check if form data was submitted
if (!empty($_POST)) {
    // Retrieve form fields
    $name     = $_POST['name'];
    $code     = $_POST['code'];
    $quantity = $_POST['quantity'];
    $price    = $_POST['price'];
    $category = $_POST['category'];
    $type     = $_POST['type'];
    $url1     = $_POST['image1'];
    $url2     = $_POST['image2'];
    $url3     = $_POST['image3'];
    $url4     = $_POST['image4'];
    $details  = $_POST['details'];

    // Build SQL
    $sql = "INSERT INTO products (name, code, quantity, price, category, type, URL1, URL2, URL3, URL4, details) 
            VALUES ('$name', '$code', '$quantity', '$price', '$category', '$type', '$url1', '$url2', '$url3', '$url4', '$details')";

    // Insert into database
    insert($conn, $sql);

    // Redirect or show message
    echo "<script>alert('Product added successfully!'); window.location.href='admin.html';</script>";
} else {
    echo "No data received.";
}

// Close connection
$conn->close();
?>