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
        body { font-family: Arial; padding: 20px; background-color: #f9f9f9; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ccc; padding: 10px; }
        form { margin: 0; }
        textarea { width: 100%; height: 80px; }
        .responded { background-color: #e0ffe0; }
    </style>
</head>
<body>
    <iframe src="header.html" style="width:100%; height:150px; border:none;" scrolling="no"></iframe>
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
    <iframe src="footer.html" style="width: 100%; height: 340px; border: none;" scrolling="no"></iframe>
</body>
</html>

<?php $conn->close(); ?>
