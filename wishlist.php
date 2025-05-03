<?php
session_start();
$session_id = session_id(); // Get the current session ID

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

// Fetch wishlist items for the current session
$sql = "SELECT p.name, p.price, p.url1, p.code, w.wishlist_id
        FROM wishlist w 
        JOIN products p ON w.product_id = p.code
        WHERE w.session_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $session_id); // Bind session ID to the query
$stmt->execute();
$result = $stmt->get_result();

// If no items are in the wishlist
if ($result->num_rows === 0) {
    header("Location: empty-wishlist.html");
    exit; // Ensure no further code is executed
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Wish List</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f8f8f8;
      margin: 0;
      padding: 20px;
    }

    .container {
      width: 50%;
      max-width: 1200px;
      margin: 0 auto;
    }

    .wishlist-heading {
      color: maroon;
      font-weight: bold;
      font-size: 28px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 10px;
    }

    .wishlist-heading i {
      color: pink;
      margin-left: 10px;
      font-size: 26px;
    }

    .wishlist-line {
      border-top: 2px solid grey;
      margin: 10px 0 20px 0;
    }

    .wishlist-item {
      display: flex;
      align-items: center;
      background-color: white;
      padding: 15px;
      border-radius: 10px;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
      margin-bottom: 20px;
    }

    .wishlist-item img {
      height: 100px;
      width: auto;
      border-radius: 5px;
    }

    .item-details {
      margin-left: 20px;
      margin-right: 20px;
      flex-grow: 1;
    }

    .item-details p {
      margin: 5px 0;
      color: #333;
    }

    .item-price {
      font-weight: bold;
      margin-right: 50px;
      min-width: 100px;
      text-align: center;
    }

    .add-to-cart-btn {
      background-color: #d63384;
      color: white;
      border: none;
      padding: 10px 15px;
      border-radius: 5px;
      cursor: pointer;
      font-size: 14px;
    }

    .add-to-cart-btn:hover {
      background-color: black;
    }
.remove-item-btn {
      background-color: #f8d7da;
      color: #721c24;
      border: none;
      padding: 5px 10px;
      border-radius: 5px;
      cursor: pointer;
      margin-bottom: 10px;
    }

    .remove-item-btn:hover {
      background-color: #f5c6cb;
    }

    .go-to-cart-btn {
      display: block;
      width: 200px;
      margin: 30px auto;
      padding: 12px;
      background-color: #d63384;
      color: white;
      text-align: center;
      font-size: 18px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      text-decoration: none;
    }

    .go-to-cart-btn:hover {
      background-color: black;
    }
  </style>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

 <iframe src="header.html" style="width:100%; height:150px; border:none;" scrolling="no"></iframe>

 <div class="container">
    <!-- Heading -->
    <div class="wishlist-heading">
      WISH LIST
      <i class="fa-regular fa-heart"></i>
    </div>

  <div class="wishlist-container">
    <?php while ($item = $result->fetch_assoc()): ?>
      <div class="wishlist-item">
        <img src="<?= htmlspecialchars($item['url1']) ?>" alt="<?= htmlspecialchars($item['name']) ?>">
        <div class="item-details">
          <h3><?= htmlspecialchars($item['name']) ?></h3>
          <p>Price: Rs <?= number_format($item['price']) ?></p>
        </div>
        <!-- Add to Cart Button Form -->
        <form method="POST" action="add_to_cart.php">
          <input type="hidden" name="product_id" value="<?= $item['code'] ?>">
          <button type="submit" class="add-to-cart-btn">Add to Cart</button>
        </form>
        <!-- Remove from Wishlist Button Form -->
        <div class="item-actions">
<!-- Remove from Wishlist Button Form -->
<form method="POST" action="remove_from_wishlist.php">
    <input type="hidden" name="wishlist_id" value="<?= htmlspecialchars($item['wishlist_id']) ?>"> <!-- Pass the wishlist_id -->
    <button class="remove-item-btn" type="submit">Remove</button>
</form>
      </div>
    <?php endwhile; ?>
  </div>

    <!-- Go to Cart Button -->
    <a href="cart.php" class="go-to-cart-btn">Go to Cart</a>

    <iframe src="newsletter.html" style="width:100%; border:none; margin-top:40px;" height="350"></iframe>
  </div>

  <iframe src="footer.html" style="width: 100%; height: 340px; border: none;" scrolling="no"></iframe>

</body>
</html>
