<?php
session_start();
$session_id = session_id();

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

// Fetch cart items for the current session
$sql = "SELECT c.product_code, p.name, c.price, c.quantity, c.total_price, p.url1 
        FROM cart c 
        JOIN products p ON c.product_code = p.code 
        WHERE c.session_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $session_id); // Bind session ID to the query
$stmt->execute();
$result = $stmt->get_result();

// If the cart is empty, redirect to the empty cart page
if ($result->num_rows === 0) {
    header("Location: empty-cart.html");
    exit; // Always call exit after header redirection to stop further script execution
}

// Initialize subtotal for cart summary
$subtotal = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Cart</title>
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

    .cart-heading {
      color: maroon;
      font-weight: bold;
      font-size: 28px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 10px;
    }

    .cart-heading i {
      color: pink;
      margin-left: 10px;
      font-size: 26px;
    }

    .cart-line {
      border-top: 2px solid grey;
      margin: 10px 0 20px 0;
    }

    /* Cart Item Styles */
    .cart-item {
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

    .cart-item img {
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

    /* Button Container */
    .item-actions {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: flex-end;
      margin-right: 10px;
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
.qty-input {
  width: 40px;
  text-align: center;
  font-size: 16px;
  border: 1px solid #ddd;
  padding: 4px;
  border-radius: 4px;
}

    .item-quantity {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .item-quantity input {
      width: 40px;
      text-align: center;
      font-size: 16px;
      border: 1px solid #ddd;
    }

    /* Cart Summary Box */
    .cart-summary-box {
      background-color: #f8d7da;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
      margin-top: 40px;
      width: 100%;
      max-width: 600px;
      text-align: left;
      margin-left: auto;
      margin-right: auto;
    }

    .cart-summary-box .line {
      border-top: 2px solid pink;
      margin-top: 10px;
      margin-bottom: 15px;
    }

    .cart-summary-box .summary-details {
      display: flex;
      justify-content: space-between;
      font-size: 18px;
      font-weight: bold;
    }

    .cart-summary-box .amount {
      color: #d63384;
      font-size: 24px;
      font-weight: bold;
    }

    /* Button Styles */
.proceed-btn, .continue-shopping-btn {
  background-color: #d63384;
  color: white;
  border: none;
  padding: 12px 25px;  /* Adjust padding to make buttons smaller */
  border-radius: 8px;
  font-size: 18px;
  cursor: pointer;
  width: 70%;  /* Set width to 70% of the container */
  max-width: 400px; /* Set max-width to make the button size smaller */
  transition: background-color 0.3s ease;
  margin-top: 20px;
  text-decoration: none; /* Remove underline from links */
  display: inline-block;
  text-align: center; /* Center align text */
}

.proceed-btn:hover, .continue-shopping-btn:hover {
  background-color: black;
}


    .button-container {
      display: flex;
      justify-content: center;
      flex-direction: column;
      align-items: center;
      margin-top: 30px;
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
  <!-- Heading -->
  <div class="cart-heading">
    Cart
    <i class="fas fa-cart-shopping" style="color: pink; font-size: 30px;"></i>
  </div>

  <?php while ($item = $result->fetch_assoc()): 
    // Add the total_price for the current item to the subtotal
    $subtotal += $item['total_price']; 
  ?>
  <div class="cart-item">
    <!-- Display the product image -->
    <img src="<?= htmlspecialchars($item['url1']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" style="height:100px;width:100px;">
    <div class="item-details">
      <p><strong><?= htmlspecialchars($item['name']) ?></strong></p>
      <div class="item-price">Rs <?= number_format($item['total_price']) ?></div>
    </div>
    <div class="item-actions">
      <!-- Remove button can later be wired to a PHP action -->
      <form method="POST" action="remove_from_cart.php">
        <input type="hidden" name="product_code" value="<?= htmlspecialchars($item['product_code']) ?>">
        <button class="remove-item-btn" type="submit">Remove</button>
      </form>

      <!-- Update Quantity Form -->
      <form method="POST" action="update_quantity.php">
  <input type="hidden" name="product_code" value="<?= htmlspecialchars($item['product_code']) ?>">
  <input type="number" name="quantity" value="<?= $item['quantity'] ?>" min="1" required class="qty-input">
  <button class="remove-item-btn" type="submit">Update Quantity</button>
</form>

    </div>
  </div>
  <?php endwhile; ?>

  <!-- Cart Summary Box -->
  <div class="cart-summary-box">
    <p><strong>Cart Summary</strong></p>
    <div class="line"></div>
    <div class="summary-details">
      <p>Sub-total</p>
      <p>Rs <?= number_format($subtotal) ?></p>
    </div>
    <div class="button-container">
      <a href="checkOut.php" class="proceed-btn">Proceed to Checkout</a>
      <a href="main.html" class="continue-shopping-btn">Continue Shopping</a>
    </div>
  </div>
</div>


  <iframe src="newsletter.html" style="margin-top:40px;" height="350"></iframe>

  <iframe src="footer.html" style="height:340px;" scrolling="no"></iframe>

</body>
</html>
