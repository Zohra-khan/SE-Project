<?php
// Database connection
$conn = mysqli_connect("localhost", "root", "", "soidhaga-products");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Function to delete a product
function delete($conn, $sql) {
    if ($conn->query($sql) === TRUE) {
        // Optional: echo "Product deleted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Check if form data was submitted
if (!empty($_POST)) {
    // Retrieve form field
    $product_code = $_POST['product_code'];

    // Build SQL to delete product
    $sql = "DELETE FROM products WHERE code = '$product_code'";

    // Delete from database
    delete($conn, $sql);

    // Redirect or show message
    echo "<script>alert('Product deleted successfully!'); window.location.href='admin_main.html';</script>";
}

// Fetch all products for dropdown
$result = mysqli_query($conn, "SELECT code, name FROM products");

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin - Delete Product</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 40px;
      background-color: #f2f2f2;
    }

    h1 {
      color: #800000;
    }

    form {
      background-color: white;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      max-width: 500px;
      margin: auto;
    }

    label {
      display: block;
      margin-bottom: 8px;
      font-weight: bold;
    }

    input, select {
      width: 100%;
      padding: 10px;
      margin-bottom: 16px;
      border: 2px solid #ccc;
      border-radius: 6px;
    }

    button {
      background-color: #800000;
      color: white;
      padding: 12px 20px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
    }

    button:hover {
      background-color: #a52a2a;
    }
  </style>
</head>
<body>

<h1>Delete Product</h1>

<form method="POST" action="">
  <label for="product_code">Select Product (by Product Code):</label>
  <select name="product_code" id="product_code" required>
    <option value="">-- Choose Product --</option>
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
      <option value="<?= htmlspecialchars($row['code']) ?>">
        <?= htmlspecialchars($row['code']) ?> - <?= htmlspecialchars($row['name']) ?>
      </option>
    <?php endwhile; ?>
  </select>

  <button type="submit" onclick="return confirm('Are you sure you want to delete this product?');">Delete</button>
</form>

</body>
</html>


<?php
// Close connection
$conn->close();
?>
