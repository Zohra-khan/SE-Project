<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "soidhaga-products";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Send response
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['response'], $_POST['complaint_id'])) {
    $id = $_POST['complaint_id'];
    $response = $_POST['response'];
    
    // Fetch customer email
    $stmt = $conn->prepare("SELECT email FROM customer_care WHERE complaint_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $email = ($result && $result->num_rows > 0) ? $result->fetch_assoc()['email'] : null;
    

    if ($email) {
        $mail = new PHPMailer(true);
        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'rahilaiqbal161@gmail.com';        // ✅ Your Gmail
            $mail->Password = 'bhzwretrnhugfstx';          
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Recipients
            $mail->setFrom('rahilaiqbal161@gmail.com', 'SoiDhaga Support');
            $mail->addAddress($email);

            // Content
            $mail->Subject = "Response to your complaint - SoiDhaga";
            $mail->Body    = $response;

            $mail->send();

            // Update database
            $stmt = $conn->prepare("UPDATE customer_care SET response=?, responded_at=NOW() WHERE complaint_id=?");
            $stmt->bind_param("si", $response, $id);
            $stmt->execute();

            echo "<p style='color:green;'>Response sent successfully to $email</p>";
        } catch (Exception $e) {
            echo "<p style='color:red;'>Email could not be sent. Mailer Error: {$mail->ErrorInfo}</p>";
        }
    } else {
        echo "<p style='color:red;'>Email not found.</p>";
    }
}

// Fetch complaints
$results = $conn->query("SELECT * FROM customer_care ORDER BY complaint_id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel - Customer Complaints</title>
    <style>
    header {
      background-color: #f8f8f8;
      border-bottom: 2px solid pink;
      padding: 16px 0;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .logo img {
      height: 100px;
      width: 200px;
    }

        body { font-family: Arial; padding: 20px; background-color: #f9f9f9; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ccc; padding: 10px; }
        form { margin: 0; }
        textarea { width: 100%; height: 80px; }
        .responded { background-color: #e0ffe0; }
    </style>
</head>
<body>
  <header>
    <div class="logo">
      <img src="SoiDhaga1.png" alt="SoiDhaga Logo">
    </div>
  </header>
    <h2>Customer Complaints</h2>
    <table>
        <tr>
            <th>ID</th><th>Name</th><th>Email</th><th>Complaint</th><th>Response</th><th>Respond</th>
        </tr>
        <?php while ($row = $results->fetch_assoc()): ?>
        <tr class="<?= $row['response'] ? 'responded' : '' ?>">
            <td><?= $row['complaint_id'] ?></td>
            <td><?= htmlspecialchars($row['first_name'] . ' ' . $row['last_name']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td><?= htmlspecialchars($row['complaint']) ?></td>
            <td><?= nl2br(htmlspecialchars($row['response'])) ?></td>
            <td>
                <?php if (!$row['response']): ?>
                    <a href="https://mail.google.com/mail/?view=cm&fs=1&to=<?= urlencode($row['email']) ?>&su=Response to your complaint - SoiDhaga&body=Dear <?= urlencode($row['first_name']) ?>,%0D%0A%0D%0A" target="_blank">
    Respond via Gmail
</a>

                <?php else: ?>
                <small>Responded on <?= $row['responded_at'] ?></small>
                <?php endif; ?>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
  <footer style="background-color: #f8f8f8; border-top: 2px solid pink; padding: 15px 0; font-family: Arial, sans-serif;">
    <div style="max-width: 1200px; margin: auto; display: flex; flex-wrap: wrap; justify-content: space-between; font-size: 13px; line-height: 1.5;">
  
      <!-- Logo & Socials -->
      <div style="flex: 1 1 220px; text-align: left; padding: 10px;">
        <img src="SoiDhaga1.png" alt="SoiDhaga Logo" style="height: 60px; width: 120px;">
        <div style="margin-top: 8px;">
          <a href="https://www.instagram.com/zohrakhansep" target="_blank" style="margin-right: 8px; color: black;"><i class="fab fa-instagram fa-sm"></i></a>
          <a href="https://www.youtube.com/watch?v=xvFZjo5PgG0" target="_blank" style="margin-right: 8px; color: black;"><i class="fab fa-youtube fa-sm"></i></a>
          <a href="https://www.linkedin.com/in/zohra-khan-781860362" target="_blank" style="color: black;"><i class="fab fa-linkedin fa-sm"></i></a>
        </div>
      </div>
  
      <!-- Branches -->
      <div style="flex: 1 1 150px; padding: 10px;">
        <strong style="color: maroon;">📍 Locations</strong>
        <ul style="list-style: none; padding-left: 0; margin: 8px 0 0 0;">
          <li>Lahore</li>
          <li>Islamabad</li>
          <li>Karachi</li>
          <li>London</li>
        </ul>
      </div>
  
      <!-- Suppliers -->
      <div style="flex: 1 1 150px; padding: 10px;">
        <strong style="color: maroon;">🔗 Suppliers</strong>
        <ul style="list-style: none; padding-left: 0; margin: 8px 0 0 0;">
          <li>Siddiq Textile</li>
          <li>Al-Raheem</li>
          <li>Nishat Group</li>
          <li>Kohinoor</li>
        </ul>
      </div>
  
      <!-- Contact + Partners -->
      <div style="flex: 1 1 220px; padding: 10px;">
        <strong style="color: maroon;">📞 Contact</strong>
        <div style="margin-top: 6px;">
          <div><img src="mailfooter.png" alt="Email" style="height: 14px; vertical-align: middle;"> soiDhaga@gmail.com</div>
          <div style="margin-top: 4px;"><img src="phonefooter.png" alt="Phone" style="height: 14px; vertical-align: middle;"> 111-222-333</div>
        </div>
        <div style="margin-top: 10px;">
          <strong style="color: maroon;">🤝 Partners</strong><br>
          <img src="visa.png" alt="Visa" style="height: 20px; margin-right: 5px;">
          <img src="masterCard.png" alt="MC" style="height: 20px; margin-right: 5px;">
          <img src="payPal.png" alt="PayPal" style="height: 20px;">
        </div>
      </div>
    </div>
    <div style="text-align: center; margin-top: 10px; font-size: 12px; color: #555;">
      &copy; 2025 SoiDhaga. All rights reserved.
    </div>
  </footer>

</html>

<?php $conn->close(); ?>
