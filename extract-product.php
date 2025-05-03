<?php
// Database connection
$conn = mysqli_connect("localhost", "root", "", "soidhaga-products");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch products
$sql = "SELECT * FROM products";
$result = mysqli_query($conn, $sql);

// Start HTML
echo "<!DOCTYPE html>
<html>
<head>
    <title>Product List</title>
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Product List</h2>";

if (mysqli_num_rows($result) > 0) {
    echo "<table>
            <tr>
                <th>Name</th>
                <th>Code</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Category</th>
                <th>Type</th>
                <th>Image 1</th>
                <th>Image 2</th>
                <th>Image 3</th>
                <th>Image 4</th>
                <th>Details</th>
            </tr>";
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>{$row['name']}</td>
                <td>{$row['code']}</td>
                <td>{$row['quantity']}</td>
                <td>{$row['price']}</td>
                <td>{$row['category']}</td>
                <td>{$row['type']}</td>
                <td><img src='{$row['URL1']}' width='50'></td>
                <td><img src='{$row['URL2']}' width='50'></td>
                <td><img src='{$row['URL3']}' width='50'></td>
                <td><img src='{$row['URL4']}' width='50'></td>
                <td>{$row['details']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p>No products found.</p>";
}

echo "</body></html>";

// Close connection
mysqli_close($conn);
?>
