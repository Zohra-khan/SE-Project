<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Card Information</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f8f8f8;
      margin: 0;
      padding: 20px;
      text-align: center;
      max-width: 1200px;
      margin-left: auto;
      margin-right: auto;
    }

    /* Heading Styles */
    .card-heading {
      color: maroon;
      font-weight: bold;
      font-size: 28px;
      margin-bottom: 20px;
margin-top: 50px
    }

    /* Form Styles */
    .form-container {
      background-color: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 400px;
      margin-left: auto;
      margin-right: auto;
    }

    .form-container label {
      font-weight: bold;
      color: #333;
      margin-top: 15px;
      display: block;
      text-align: left;
    }

    .form-container input,
    .form-container select {
      width: 100%;
      padding: 10px;
      margin: 5px 0 20px 0;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 16px;
    }

    .expiry-container {
      display: flex;
      justify-content: space-between;
      gap: 10px;
    }

    .expiry-container select {
      width: 48%;
    }

    .pay-button {
      background-color: #d63384;
      color: white;
      padding: 15px 30px;
      border-radius: 8px;
      font-size: 18px;
      cursor: pointer;
      width: 100%;
      max-width: 400px;
      transition: background-color 0.3s ease;
      margin-top: 20px;
      border: none;
    }

    .pay-button:hover {
      background-color: black;
    }

  </style>
</head>
<body>

<?php include 'header.php'; ?>
  <!-- Heading -->
  <div class="card-heading">
    Card Information
  </div>

  <!-- Card Information Form -->
  <div class="form-container">
    <!-- Card Holder's Name -->
    <form action="save_card_info.php" method="POST">
      <label for="cardholder-name">Card Holder's Name</label>
      <input type="text" name="cardholder_name" id="cardholder-name" placeholder="Enter your name" pattern="[A-Za-z\s]+" title="Card Holder's Name must contain only letters and spaces" required>

      <!-- Card Number -->
      <label for="card-number">Card Number</label>
      <input type="text" name="card_number" id="card-number" placeholder="Enter your card number" pattern="^\d{15,16}$" title="Card number must be 15 or 16 digits" required>

      <!-- Expiry Date -->
      <label>Expiry Date</label>
      <div class="expiry-container">
        <!-- Month Dropdown -->
        <select name="expiry_month" id="expiry-month" required>
          <option value="">Month</option>
          <option value="01">January</option>
          <option value="02">February</option>
          <option value="03">March</option>
          <option value="04">April</option>
          <option value="05">May</option>
          <option value="06">June</option>
          <option value="07">July</option>
          <option value="08">August</option>
          <option value="09">September</option>
          <option value="10">October</option>
          <option value="11">November</option>
          <option value="12">December</option>
        </select>

        <!-- Year Dropdown with options starting from 2025 -->
        <select name="expiry_year" id="expiry-year" required>
          <option value="">Year</option>
          <script>
            let currentYear = new Date().getFullYear();
            for (let i = 2025; i <= currentYear + 10; i++) {
              let option = document.createElement("option");
              option.value = i;
              option.textContent = i;
              document.getElementById("expiry-year").appendChild(option);
            }
          </script>
        </select>
      </div>

      <!-- Security Code -->
      <label for="security-code">Security Code (CVV)</label>
      <input type="text" name="security_code" id="security-code" placeholder="Enter CVV" pattern="^\d{3,4}$" title="CVV must be 3 or 4 digits" required>

      <!-- Postal/Zip Code -->
      <label for="postal-code">Postal/Zip Code</label>
      <input type="text" name="postal_code" id="postal-code" placeholder="Enter Postal/Zip Code" pattern="\d+" title="Postal/Zip Code must contain numbers only" required>

      <!-- Pay Button -->
      <button type="submit" class="pay-button">Pay Amount</button>
    </form>
  </div>

  <iframe src="footer.html" style="width: 100%; height: 340px; border: none;" scrolling="no"></iframe>

</body>
</html>
