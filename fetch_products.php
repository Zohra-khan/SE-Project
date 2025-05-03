<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "soidhaga-products";

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$category = $_GET['category'] ?? '';

$sql = "SELECT name, price, URL1, details FROM products WHERE category = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $category);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #f8f8f8;
    }

    .product-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 2rem;
      padding: 2rem;
      box-sizing: border-box;
    }

    .card {
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      text-align: center;
      overflow: hidden;
      display: flex;
      flex-direction: column;
    }

    .card img {
      width: 100%;
      height: 380px;
      object-fit: cover;
      border-radius: 8px 8px 0 0;
      display: block;
    }

    .card-title {
      font-weight: bold;
      margin: 0.5rem 0 0.2rem;
    }

    .price {
      color: #333;
      margin-bottom: 1rem;
    }

    a {
      text-decoration: none;
      color: inherit;
    }
  </style>
</head>
<body>

<div class="product-grid">
<?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $name = htmlspecialchars($row["name"]);
        $price = number_format($row["price"]);
        $img = htmlspecialchars($row["URL1"]);
        $alt = htmlspecialchars($row["details"]);
        $link = strtolower(str_replace(" ", "", $name)) . ".html";

        echo "<div class='card'>
                <a href='$link' >
                    <img src='$img' alt='$alt'>
                    <div class='card-title'>$name</div>
                    <div class='price'>PKR $price</div>
                </a>
              </div>";
    }
} else {
    echo "<p style='padding: 2rem;'>No LawnKari products found.</p>";
}
?>
</div>

</body>
</html>

<?php
$conn->close();
?>
