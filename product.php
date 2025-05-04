<?php
session_start();
// Get product name from URL
$name = $_GET['name'] ?? '';

// Connect to database
$conn = mysqli_connect("localhost", "root", "", "soidhaga-products");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query using product name
$sql = "SELECT * FROM products WHERE name = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $name);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Check if product is found
if (mysqli_num_rows($result) === 0) {
    die("Product not found");
}

$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>SoiDhaga -  <?php echo $row['category']; ?>2025</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f8f8f8;
    }
    header {
      display: flex;
      justify-content: flex-start;
      align-items: center;
      padding: 12px 24px;
      background-color: #f8f8f8;
      border-bottom: none;
    }
    .logo img {
      height: 100px;
      width: 150px;
    }
    .header-right {
      display: flex;
      align-items: center;
      gap: 20px;
      margin-left: auto;
    }
    .search-bar input {
      padding: 7px 14px;
      border: 2px solid pink;
      border-radius: 20px;
      width: 220px;
      color: #d63384;
    }
    .search-bar input::placeholder {
      color: #d63384;
      opacity: 0.6;
    }
    .icon {
      font-size: 22px;
      cursor: pointer;
      color: #d63384;
    }
    .menu-button {
      background-color: white;
      color: #d63384;
      padding: 10px 22px;
      border: 2px solid #d63384;
      border-radius: 12px;
      font-weight: bold;
      cursor: pointer;
      font-size: 16px;
    }
    .menu-button:hover {
      background-color: #f8f8f8;
    }
    .sidebar {
      height: 100%;
      width: 0;
      position: fixed;
      top: 0;
      right: -50px;
      background-color: white;
      box-shadow: -2px 0px 5px rgba(0, 0, 0, 0.1);
      overflow-x: hidden;
      transition: 0.5s;
      padding-top: 60px;
      z-index: 1000;
    }
    .sidebar a {
      padding: 15px 25px;
      text-decoration: none;
      font-size: 24px;
      color: black;
      display: block;
      transition: 0.3s;
      font-weight: bold;
    }
    .sidebar a:hover {
      background-color: #f1f1f1;
    }
    .closebtn {
      position: absolute;
      top: 10px;
      right: 10px;
      font-size: 36px;
      cursor: pointer;
      color: black;
    }
    .sidebar hr {
      border: 0;
      border-top: 2px solid pink;
      margin: 10px 0;
    }
    .dark-background {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      display: none;
      z-index: 999;
    }
    .container {
      max-width: 1200px;
      margin: 40px auto;
      padding: 0 20px;
    }
    .gallery {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
    }
    .gallery img {
      width: 48%;
      border-radius: 8px;
      cursor: pointer;
    }
    .gallery img.selected {
      border: 3px solid #d63384;
    }
    .product-info {
      margin-top: 20px;
    }
    .product-grid {
      display: flex;
      gap: 40px;
      flex-wrap: wrap;
    }
    button {
      padding: 10px 16px;
      margin: 5px 5px 5px 0;
      cursor: pointer;
    }
    .btn-primary {
      background-color: #d63384;
      color: white;
      border: none;
      border-radius: 5px;
    }
    .btn-secondary {
      background-color: #800000;
      color: white;
      border: none;
      border-radius: 5px;
    }
    .scrollable {
      display: flex;
      overflow-x: auto;
      gap: 20px;
      padding: 10px;
      scroll-behavior: smooth;
    }
    .scrollable::-webkit-scrollbar {
      height: 5px;
    }
    .scrollable::-webkit-scrollbar-thumb {
      background: #92084f;
      border-radius: 4px;
    }
    .scrollable img {
      width: 300px;
      border-radius: 8px;
    }
    .scrollable p {
      text-align: center;
      font-size: 12px;
      color: #555;
    }
    .content-container {
  display: flex;
  gap: 40px; /* Space between table and care instructions */
  align-items: flex-start; /* Align them at the top */
}

.table-container {
  flex: 1; /* Take up needed space */
}

.care-instructions {
  flex: 1; /* Take up needed space */
  font-size: 15px;
}

/* Your original table styles */
table {
  width: 100%;
  border-collapse: collapse;
  font-size: 13px;
}

table th, table td {
  padding: 10px;
  border: 1px solid #9a0707;
  text-align: center;
}

table th {
  background-color: #ebe5e7;
  color: #800000;
}


    #gallery-popup {
      display: none;
      position: fixed;
      top: 0; left: 0;
      width: 100vw;
      height: 100vh;
      background: rgba(0,0,0,0.85);
      justify-content: center;
      align-items: center;
      z-index: 9999;
      cursor: zoom-out;
    }

    #gallery-popup img {
  max-width: 90vw;
  max-height: 90vh;
  border-radius: 12px;
  box-shadow: 0 0 20px rgba(0,0,0,0.4);
  transition: transform 0.3s ease-out; /* Smooth zoom transition */
}


    @keyframes zoomIn {
      from { transform: scale(0.8); opacity: 0; }
      to   { transform: scale(1); opacity: 1; }
    }
    #gallery-popup-controls {
      position: absolute;
      top: 20px;
      right: 20px;
      display: flex;
      gap: 10px;
    }

    #gallery-popup-controls button {
      background-color: #fff;
      border: 2px solid #d63384;
      color: #d63384;
      font-size: 20px;
      width: 40px;
      height: 40px;
      border-radius: 50%;
      font-weight: bold;
      cursor: pointer;
    }
    .scroll-animate {
      opacity: 0;
      transform: translateY(30px);
      transition: opacity 0.6s ease-out, transform 0.6s ease-out;
    }

    .scroll-animate.visible {
      opacity: 1;
      transform: translateY(0);
    }
    .size-btn {
  padding: 8px 16px;
  margin: 5px;
  cursor: pointer;
  border: 2px solid #d63384;
  border-radius: 5px;
  background-color: white;
  color: #d63384;
  transition: background-color 0.3s, color 0.3s;
}

.size-btn:focus {
  background-color: #d63384;
  color: white;
  border-color: #d63384;
  outline: none;  /* Remove the outline that browsers add */
}

.size-btn:active {
  background-color: #d63384;
  color: white;
  border-color: #d63384;
}
.newsletter {
      text-align: center;
      margin-top: 4rem;
    }

    .newsletter input {
      padding: 0.5rem;
      margin-right: 0.5rem;
    }

    .newsletter button {
      padding: 0.5rem 1rem;
      background-color: #c45c5c;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    footer {
      flex-direction: column;
      text-align: center;
      font-size: 0.9rem;
      padding: 2rem;
    }

    .footer-sections {
      display: flex;
      justify-content: space-around;
      flex-wrap: wrap;
      margin-top: 1rem;
    }

    .footer-sections div {
      margin: 1rem;
    }

    .social img {
      height: 24px;
      margin: 0 0.5rem;
    }

    .footer-logo img {
      height: 100px;
      width: auto;
    }

     iframe {
      width: 100%;
      border: none;
    }
  </style>
</head>
<body>

  <!-- Header -->
  <iframe src="header.html" style="height: auto;"scrolling="no"></iframe>


  <!-- Main Content -->
  <div class="container">
    <h2 style="color: #800000;">SoiDhaga | <?php echo $row['category']; ?>-2025 | <?php echo $row['name']; ?></h2>
    <div class="product-grid">

      <!-- Image Gallery -->
      <div style="flex: 1; min-width: 250px;">
    <div class="gallery">
        <!-- Dynamically display images from the database columns -->
        <img src="<?php echo $row['URL1']; ?>" alt="Model 1" onclick="openGalleryPopup(this.src)">
        <img src="<?php echo $row['URL2']; ?>" alt="Model 2" onclick="openGalleryPopup(this.src)">
        <img src="<?php echo $row['URL3']; ?>" alt="Model 3" onclick="openGalleryPopup(this.src)">
        <img src="<?php echo $row['URL4']; ?>" alt="Detail" onclick="openGalleryPopup(this.src)">
    </div>
</div>



      <!-- Product Info -->
      <div style="flex: 1; min-width: 300px;">
      <h3 style="color: #800000;"><?php echo $row['name']; ?></h3> <!-- Updated to use fetched product name -->
        <p style="color: gray;"><?php echo $row['code']; ?></p>
        <p><strong style="color: green;">AVAILABILITY:</strong> In Stock</p>
        <p style="font-size: 24px; color: #d63384; font-weight: bold;">RS.<?php echo $row['price']; ?></p>
        <p style="font-size: 12px; color: #080860;">*Prices are inclusive of GST</p>
<button type="button" class="wishlist-btn add-to-wishlist-btn"
        style="background: none; border: none; color: #d63384; font-size: 16px; cursor: pointer;"
        onclick="addToWishlist('<?= $row['code'] ?>')">
  <i class="far fa-heart"></i> Add to Wishlist
</button>


        <div style="margin: 15px 0;">
          <label for="quantity">Quantity:</label>
          <input type="number" id="quantity" min="1" value="1" style="width: 60px; margin-left: 10px; padding: 4px;">
        </div>
       <div>
  <span><strong>Size:</strong></span><br>
  <button class="size-btn" data-size="XS"><strong>XS</strong></button>
  <button class="size-btn" data-size="S"><strong>S</strong></button>
  <button class="size-btn" data-size="M"><strong>M</strong></button>
  <button class="size-btn" data-size="L"><strong>L</strong></button>
  <button class="size-btn" data-size="XL"><strong>XL</strong></button>
</div>
          

        <div style="margin-top: 20px;">
<form method="POST" action="buy_now.php" style="display: inline;">
  <input type="hidden" name="product_id" value="<?= $row['code'] ?>">
  <input type="hidden" name="quantity" value="1"> <!-- or let user choose -->
  <input type="hidden" name="size" value="M">     <!-- or use selected size -->

  <button type="submit" class="buy-now-btn"
          style="background-color: #28a745; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
    Buy Now
  </button>
</form><form method="POST" action="add_to_cart.php">
  <input type="hidden" name="name" value="<?php echo $row['name']; ?>">
  <input type="hidden" name="code" value="<?php echo $row['code']; ?>">
  <input type="hidden" name="price" value="<?php echo $row['price']; ?>">
  <input type="hidden" name="image" value="<?php echo $row['URL1']; ?>">
  <input type="hidden" name="category" value="<?php echo $row['category']; ?>">
  <input type="hidden" name="quantity" id="cart-quantity" value="1">
  <input type="hidden" name="size" id="selected-size" value="">
  
  <button type="submit" class="btn-secondary" onclick="addToCart(event)">Add To Cart</button>

</form>
        </div>
        <div>
          <p><strong>Fabric Type:</strong><br><br><?php echo nl2br($row['type']); ?></p>
          <p><strong>Fit Type:</strong><br><br> Tailored Fit</p>
        </div>

        <h4 style="color: #800000;"><strong>Product Details:</strong></h4>
<p class="product-info">
  <?php echo nl2br($row['details']); ?>
  <br><br>
  <strong>CONTACT US FOR A MORE TAILORED FIT AT 111-222-333</strong><br>
</p>


      </div>
    </div>
    <div class="content-container">
      <div class="table-container">
        <table>
          <thead>
            <tr>
              <th>Size</th>
              <th>Chest (in)</th>
              <th>Waist (in)</th>
              <th>Hip (in)</th>
              <th>Shoulder Width (in)</th>
              <th>Sleeve Length (in)</th>
              <th>Dress Length (in)</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>XS</td><td>32</td><td>26</td><td>34</td><td>13</td><td>22</td><td>34</td>
            </tr>
            <tr>
              <td>S</td><td>34</td><td>28</td><td>36</td><td>13.5</td><td>22.5</td><td>34.5</td>
            </tr>
            <tr>
              <td>M</td><td>36</td><td>30</td><td>38</td><td>14</td><td>23</td><td>35</td>
            </tr>
            <tr>
              <td>L</td><td>38</td><td>32</td><td>40</td><td>14.5</td><td>23.5</td><td>35.5</td>
            </tr>
            <tr>
              <td>XL</td><td>40</td><td>34</td><td>42</td><td>15</td><td>24</td><td>36</td>
            </tr>
          </tbody>
        </table>
      </div>
    
      <div class="care-instructions">
        <h3 style="color:#800000;font-size: 15px;"><strong>Care Instructions:</strong></h3>
        <p>Wash and soak colored and white fabrics separately<br>
        Iron at moderate temperature.<br>
        Do not over expose damp fabric to strong sunlight.<br>
        Do not use any type of bleach or stain removing chemicals.</p>
      </div>
    </div>

    <h2 style="margin-top: 70px; font-family: 'Times New Roman'; color: maroon; text-align: center;">Customers Also Like</h2>

<!-- Products Section -->
<div class="scrollable scroll-animate" id="customers-scroll">
    <?php
        // Database connection
        $conn = mysqli_connect("localhost", "root", "", "soidhaga-products");

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Get the total number of products in the table
        $countSql = "SELECT COUNT(*) FROM products";
        $countResult = mysqli_query($conn, $countSql);
        $countRow = mysqli_fetch_row($countResult);
        $totalProducts = $countRow[0];

        // Calculate the OFFSET to get the last 4 products
        $offset = $totalProducts - 4;

        // Fetch the last 4 products from the database
        $sql = "SELECT * FROM products LIMIT 4 OFFSET $offset";
        $result = mysqli_query($conn, $sql);

        // Check if there are any products
        if (mysqli_num_rows($result) > 0) {
            // Loop through each product and display the image and name with a link
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div>';
                // Display the product image and link to the product page
                echo '<a href="product.php?name=' . urlencode($row['name']) . '">';
                echo '<img src="' . $row['URL1'] . '" alt="' . $row['name'] . '" style="width: 300px; height: auto; border-radius: 8px;">';
                echo '</a>';
                // Display the product name with a link to the product page
                echo '<p style="text-align: center; font-weight: bold;">';
                echo '<a href="product.php?name=' . urlencode($row['name']) . '" class="link">' . $row['name'] . '</a>';
                echo '</p>';
                echo '</div>';
            }
        } else {
            echo 'No products found.';
        }

        // Close the database connection
        mysqli_close($conn);
    ?>
</div>


    </div>

  <iframe src="newsletter.html" style="width:100%; border:none; margin-top:40px;" height="350"></iframe>

  <iframe src="footer.html" style="width: 100%; height: 340px; border: none;" scrolling="no"></iframe>

  <!-- Popup for Zoom -->
<div id="gallery-popup" onclick="closeGalleryPopup(event)">
    <img id="gallery-popup-img" src="" alt="Zoomed View">
  </div>
  

  <script>
let currentZoom = 1;

function openGalleryPopup(src) {
  const popup = document.getElementById('gallery-popup');
  const img = document.getElementById('gallery-popup-img');
  currentZoom = 1; // Reset zoom level to 1 on opening the image
  img.style.transform = "scale(1)";
  img.style.transition = 'none'; // Disable transition for initial zoom
  img.src = src;
  popup.style.display = 'flex';
}

function closeGalleryPopup(event) {
  if (event.target.id === "gallery-popup" || event.target === event.currentTarget) {
    document.getElementById('gallery-popup').style.display = 'none';
  }
}

function zoomImage(factor) {
  const img = document.getElementById('gallery-popup-img');
  currentZoom *= factor; // Adjust the zoom factor
  currentZoom = Math.max(0.5, Math.min(currentZoom, 5)); // Set boundaries for zoom level (0.5 to 5x zoom)
  img.style.transform = `scale(${currentZoom})`; // Apply the zoom
  img.style.transition = 'transform 0.3s ease-out'; // Smooth zoom effect
}

function handleMouseMove(event) {
  const img = document.getElementById('gallery-popup-img');
  const rect = img.getBoundingClientRect();
  const offsetX = event.clientX - rect.left;  // X position inside the image
  const offsetY = event.clientY - rect.top;   // Y position inside the image

  img.style.transformOrigin = `${(offsetX / rect.width) * 100}% ${(offsetY / rect.height) * 100}%`;
}

function startZoom() {
  const img = document.getElementById('gallery-popup-img');
  img.addEventListener('mousemove', handleMouseMove); // Activate zoom behavior on hover
}

function stopZoom() {
  const img = document.getElementById('gallery-popup-img');
  img.removeEventListener('mousemove', handleMouseMove); // Disable zoom behavior on exit
  img.style.transform = "scale(1)"; // Reset zoom when cursor leaves
  img.style.transition = 'transform 0.3s ease-out'; // Smooth transition
}

// Set up event listeners
const img = document.getElementById('gallery-popup-img');
img.addEventListener('mouseenter', startZoom);
img.addEventListener('mouseleave', stopZoom);

img.addEventListener('dblclick', () => {
  const zoomFactor = (currentZoom === 1) ? 2 : 1; // Toggle zoom between 1 and 2
  zoomImage(zoomFactor);
});

  </script>
  <script>
    // Show animation when "Customers Also Like" is in view
    window.addEventListener('scroll', () => {
      const section = document.getElementById('customers-scroll');
      const rect = section.getBoundingClientRect();
      if (rect.top < window.innerHeight - 100) {
        section.classList.add('visible');
      }
    });
  </script>
<script>
    document.getElementById("quantity").addEventListener("input", function() {
      document.getElementById("cart-quantity").value = this.value;
    });
  </script>
<script>
  // Add event listeners to the size buttons
  const sizeButtons = document.querySelectorAll('.size-btn');
  sizeButtons.forEach(button => {
    button.addEventListener('click', function() {
      // Get the selected size from the data-size attribute
      const size = this.getAttribute('data-size');
      
      // Update the hidden input with the selected size
      document.getElementById('selected-size').value = size;
    });
  });
</script>
<script>
function addToCart(event) {
    event.preventDefault(); // Prevent form from navigating

    const form = event.target.closest("form");

    const formData = new FormData(form);

    fetch("add_to_cart.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.text())
    .then(message => {
        alert(message); // Show message returned by PHP
    })
    .catch(err => {
        alert("Error adding to cart!");
    });
}
</script>
<script>
function addToWishlist(productCode) {
    const formData = new FormData();
    formData.append("product_id", productCode);

    fetch("add_to_wishlist.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.text())
    .then(message => {
        alert(message); // Simple confirmation dialog
    })
    .catch(err => {
        alert("Error adding to wishlist.");
        console.error(err);
    });
}
</script>


</body>
</html>