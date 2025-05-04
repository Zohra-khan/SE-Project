<?php
session_start();
$session_id = session_id();

// Database connection
$host = "localhost";
$user = "root";
$password = "";
$database = "soidhaga-products";
$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch wishlist items
$sql = "SELECT p.name, p.price, p.url1, p.code, w.wishlist_id
        FROM wishlist w 
        JOIN products p ON w.product_id = p.code
        WHERE w.session_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $session_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header("Location: empty-wishlist.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Wish List</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f8f8f8;
      margin: 0;
      padding: 20px;
    }

    .container {
      max-width: 1200px;
      margin: 0 auto;
      text-align: center;
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
      max-width: 600px;
      margin-left: auto;
      margin-right: auto;
      justify-content: space-between;
      gap: 20px;
    }

    .wishlist-item img {
      height: 100px;
      width: 100px;
      object-fit: cover;
      border-radius: 5px;
    }

    .item-details {
      text-align: left;
      flex-grow: 1;
      max-width: 160px;
      margin-left: 20px;
    }

    .item-details p {
      margin: 5px 0;
      color: #333;
    }

    .item-price {
      font-weight: bold;
      font-size: 18px;
      margin-top: 10px;
    }

    .item-actions {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: flex-end;
      margin-right: 10px;
    }

    .add-to-cart-btn,
    .remove-item-btn {
      background-color: #d63384;
      color: white;
      border: none;
      padding: 8px 12px;
      border-radius: 5px;
      cursor: pointer;
      margin-bottom: 10px;
      font-size: 14px;
    }

    .add-to-cart-btn:hover,
    .remove-item-btn:hover {
      background-color: black;
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
.remove-item-btn {
  background-color: #f8d7da;
  color: #721c24;
  border: none;
  padding: 5px 10px;
  border-radius: 5px;
  cursor: pointer;
  font-size: 14px;
}

.remove-item-btn:hover {
  background-color: #f5c6cb;
}

    iframe {
      display: block;
      width: 100%;
      border: none;
    }
  </style>
</head>
<body>

<iframe src="header.html" style="height:150px;" scrolling="no"></iframe>

<div class="container">
  <div class="wishlist-heading">
    Wish List
    <i class="fa-regular fa-heart"></i>
  </div>

  <div class="wishlist-line"></div>

  <?php while ($item = $result->fetch_assoc()): ?>
    <div class="wishlist-item">
      <img src="<?= htmlspecialchars($item['url1']) ?>" alt="<?= htmlspecialchars($item['name']) ?>">
      <div class="item-details">
        <p><strong><?= htmlspecialchars($item['name']) ?></strong></p>
        <div class="item-price">Rs <?= number_format($item['price']) ?></div>
      </div>
      <div class="item-actions">
        <!-- Add to Cart -->
        <form method="POST" action="add_to_cart.php">
          <input type="hidden" name="product_id" value="<?= $item['code'] ?>">
          <button class="add-to-cart-btn" type="submit">Add to Cart</button>
        </form>

        <!-- Remove from Wishlist -->
<form method="POST" action="remove_from_wishlist.php">
  <input type="hidden" name="wishlist_id" value="<?= htmlspecialchars($item['wishlist_id']) ?>">
  <button class="remove-item-btn" type="submit">Remove</button>
</form>
      </div>
    </div>
  <?php endwhile; ?>

  <a href="cart.php" class="go-to-cart-btn">Go to Cart</a>

  <iframe src="newsletter.html" style="height:350px; margin-top:40px;"></iframe>
</div>

<iframe src="footer.html" style="height:340px;" scrolling="no"></iframe>

</body>
</html>
