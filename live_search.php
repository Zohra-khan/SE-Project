<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "soidhaga-products";

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$results = [];

if (isset($_GET['q'])) {
    $query = "%" . $_GET['q'] . "%";
    $stmt = $conn->prepare("SELECT name, code FROM products WHERE name LIKE ? OR code LIKE ?");
    $stmt->bind_param("ss", $query, $query);
    $stmt->execute();
    $res = $stmt->get_result();

    while ($row = $res->fetch_assoc()) {
        // Use the 'name' field to construct the URL
        $row['url'] = "http://localhost/soidhaga/product.php?name=" . urlencode($row['name']);
        $results[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($results);
?>
