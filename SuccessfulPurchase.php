<?php
// Database connection
$host = "localhost";
$username = "root";
$password = "";   
$dbname = "soidhaga-products";

$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Assuming you have the session started to track cart for the current user
session_start();

// Fetch the total price from the cart table for the current session
$session_id = session_id();  // Get the session ID
$sql = "SELECT SUM(total_price) AS total_price FROM cart WHERE session_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $session_id);
$stmt->execute();
$stmt->bind_result($total_price);
$stmt->fetch();

// Free the result of the first query
$stmt->free_result();

// Fetch product images from the product table using the product_code from cart
$product_sql = "SELECT p.URL1 FROM cart c 
                JOIN products p ON c.product_code = p.code
                WHERE c.session_id = ?";
$product_stmt = $conn->prepare($product_sql);
$product_stmt->bind_param("s", $session_id);
$product_stmt->execute();
$product_stmt->bind_result($image_url);

// Store product images in an array for later use
$product_images = [];
while ($product_stmt->fetch()) {
    $product_images[] = $image_url;
}

// Close the statement and connection
$stmt->close();
$product_stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Thank You | SoiDhaga</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color:  #f8f8f8;
      color: #333;
    }

    .banner {
      text-align: center;
      padding-top: 40px;
      background-color:  #f8f8f8;
    }

    .banner h1 {
      color: #800000;
      font-size: 32px;
      margin-bottom: 20px;
    }

    .banner img {
      width: 100%;
      max-height: 500px;
      object-fit: cover;
    }

    .btn-home {
      background-color: #800000;
      color: white;
      padding: 10px 20px;
      margin-top: 20px;
      border: none;
      border-radius: 6px;
      font-size: 20px;
      cursor: pointer;
    }

    .confirmation-box {
      max-width: 600px;
      margin: 50px auto;
      padding: 40px;
      background-color:  #f8f8f8;
      border-radius: 12px;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
      text-align: center;
    }

    .confirmation-box h2 {
      color: #800000;
      margin-bottom: 10px;
    }

    .confirmation-box p {
      font-size: 16px;
      margin: 10px 0;
    }

    .product-list {
      display: flex;
      justify-content: center;
      gap: 15px;
      margin: 20px 0;
    }

    .product-list img {
      width: 80px;
      height: 100px;
      object-fit: cover;
      border-radius: 8px;
      border: 1px solid #eee;
    }

    .order-details {
      margin-top: 20px;
      text-align: left;
    }

    .order-details p {
      margin: 6px 0;
      font-size: 15px;
    }

    .order-details span {
      font-weight: bold;
      color: #444;
    }
    .image-wrapper {
  position: relative;
  width: 100%;
  max-height: 500px;
  overflow: hidden;
}

.image-wrapper img {
  width: 100%;
  height: auto;
  display: flex;
  object-fit: cover;
}

.overlay-text {
  position: absolute;
  top: 80%; /* move closer to the top */
  left: 50%;
  transform: translateX(-50%); /* only horizontal centering */
  color: #f8f8f8;
  font-size: 36px;
  font-weight: bold;
  text-align: center;
  z-index: 2;
}


.btn-home {
  background-color: #800000;
  color:  #fffaf8;
  padding: 10px 20px;
  margin: 30px auto;
  display: block;
  border: none;
  border-radius: 6px;
  font-size: 20px;
  cursor: pointer;
}

    @media (max-width: 600px) {
      .product-list {
        flex-direction: column;
        align-items: center;
      }
    }
  </style>
</head>
<body>

  <!-- Header -->
  <iframe src="header.html" height="180" scrolling="no" style="width:100%; border:none;"></iframe>

<!-- Banner with overlay text -->
 <h1 style="text-align: center;color:#800000">Success,Thank You For Purchasing!</h1>
<div class="banner">
    <div class="image-wrapper">
      <img src="enddd.jpg" alt="Thank You Outfit" />
    </div>
    <button class="btn-home" onclick="window.location.href='main.html'">Return To Home Page</button>
  </div>
  

  <!-- Confirmation Section -->
  <div class="confirmation-box">
    <h2>Complete! 🎉</h2>
    <p>Your order has been received</p>

    <div class="product-list">
    <?php
    foreach ($product_images as $image_url) {
        echo '<img src="' . $image_url . '" alt="Product Image" />';
    }
    ?>
  </div>

    <div class="order-details">
      <p><span>Order ID:</span> #335465465454526</p>
      <p><span>Date:</span> April 27, 2025</p>
<p><span>Total:</span> Rs. <?php echo number_format($total_price, 2); ?></p>
      <p><span>Tracking ID:</span> #2567899876543</p>
    </div>
  </div>

  <!-- Newsletter -->
  <iframe src="newsletter.html" height="350" style="width:100%; border:none;"></iframe>

  <!-- Footer -->
  <iframe src="footer.html" height="340" scrolling="no" style="width:100%; border:none;"></iframe>

</body>
</html>
