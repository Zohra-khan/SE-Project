<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkout</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f8f8f8;
      margin: 0;
      padding: 20px;
      overflow-x: hidden;
    }

    .checkout-heading {
      color: maroon;
      font-weight: bold;
      font-size: 28px;
      text-align: center;
      margin-bottom: 20px;
    }

    .checkout-container {
      display: flex;
      flex-direction: column;
      align-items: center; /* center horizontally */
    }

    .checkout-box {
      background-color: white;
      padding: 20px;
      margin: 0 0 20px 0;
      border: 1px solid grey;
      border-radius: 8px;
      width: 750px; /* increased width */
      max-width: 95%; /* optional: allow better fit on mobile */
      box-sizing: border-box;
    }

    .box-title {
      font-weight: bold;
      color: black;
      margin-bottom: 10px;
      text-align: center;
    }

    .checkout-row {
      display: flex;
      align-items: center;
      margin-bottom: 15px;
    }

    .checkout-row label {
      width: 150px;
      font-weight: bold;
      margin-right: 10px;
    }

    .checkout-row input {
      flex: 1;
      padding: 8px;
      border: 1px solid #ddd;
      border-radius: 5px;
      max-width: 300px;
    }

    .checkout-row-inline {
      display: block;
    }

    .payment-method input[type="radio"] {
      margin-right: 10px;
    }

.apply-coupon button {
    background-color: #d63384;
    color: white;
    padding: 6px 12px;  /* Reduced padding for a smaller button */
    margin-right: 10px;
    cursor: pointer;
    border-radius: 5px;
    white-space: nowrap; /* keep "Apply" label on one line */
    font-size: 14px; /* Optionally, you can reduce the font size */
}

.apply-coupon button:hover {
    background-color: black;
}
.apply-coupon input {
    flex: 1;
    padding: 12px;  /* Increase padding for a larger input */
    border: 1px solid #ddd;
    border-radius: 5px;
    max-width: 400px; /* Increase the max width for a wider input box */
    font-size: 16px;  /* Increase font size for better readability */
}

.place-order-button {
  background-color: #d63384; /* pink */
  color: white;
  padding: 15px 30px;
  border: none;
  border-radius: 8px;
  font-size: 18px;
  cursor: pointer;
  margin-top: 20px;
  width: 100%; /* make the button full width */
  max-width: 600px; /* ensure it doesn't get too wide on large screens */
  margin-left: auto;  /* Centering the button horizontally */
  margin-right: auto; /* Centering the button horizontally */
  transition: background-color 0.3s ease;
}

    .place-order-button:hover {
      background-color: black; /* darker pink on hover */
    }

    .payment-method {
      display: flex;
      flex-direction: column;
      gap: 10px;
      margin-top: 10px;
    }

    .payment-option {
      display: flex;
      align-items: center;
      padding: 15px;
      border: 1px solid #ddd;
      border-radius: 8px;
      background-color: #fafafa;
      box-shadow: 0px 2px 5px rgba(0,0,0,0.1); /* soft shadow */
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .payment-option:hover {
      background-color: #f0f0f0;
    }

    .payment-option input[type="radio"] {
      margin-right: 15px;
    }
  </style>
</head>
<body>

  <iframe src="header.html" style="width:100%; height:150px; border:none;" scrolling="no"></iframe>


  <!-- Checkout Heading -->
  <div class="checkout-heading">
    Check Out
  </div>

  <div class="checkout-container">
    <form action="submit_checkout.php" method="POST">

      <!-- Contact Information Box -->
      <div class="checkout-box">
        <div class="box-title">Contact Information</div>
        <div class="checkout-row">
          <label for="first-name">First Name</label>
<input type="text" id="first-name" name="first_name" required>
        </div>
        <div class="checkout-row">
          <label for="last-name">Last Name</label>
<input type="text" name="last_name" required>
        </div>
        <div class="checkout-row">
          <label for="phone-number">Phone Number</label>
<input type="tel" name="phone_number" required>
        </div>
        <div class="checkout-row">
          <label for="email-address">Email Address</label>
<input type="email" name="email" required>
        </div>
      </div>

      <!-- Shipping Address Box -->
      <div class="checkout-box">
        <div class="box-title">Shipping Address</div>
        <div class="checkout-row">
          <label for="street-address">Street Address</label>
<input type="text" name="street_address" required>
        </div>
        <div class="checkout-row">
          <label for="country">Country</label>
<input type="text" name="country" required>
        </div>
        <div class="checkout-row">
          <label for="city">Town/City</label>
<input type="text" name="city" required>
        </div>
        <div class="checkout-row">
          <label for="state">State</label>
<input type="text" name="state" required>
        </div>
        <div class="checkout-row">
          <label for="zip-code">Zip Code</label>
<input type="text" name="zip" required>
        </div>
      </div>

      <!-- Payment Method Box -->
      <div class="checkout-box">
        <div class="box-title">Payment Method</div>
        <div class="payment-method">
          <div class="payment-option">
<input type="radio" name="payment_method" value="credit card">
            <label for="credit-card">Pay by Credit Card</label>
          </div>
          <div class="payment-option">
<input type="radio" name="payment_method" value="paypal">
            <label for="paypal">Paypal</label>
          </div>
          <div class="payment-option">
<input type="radio" name="payment_method" value="cod">
            <label for="cash-on-delivery">Cash on Delivery</label>
          </div>
        </div>
      </div>

<!-- Coupon Box -->
<div class="checkout-box">
  <div class="box-title">Have a Coupon?</div>
  <div class="checkout-row">
    <p>Add your code for an instant cart discount.</p>
  </div>
  <div class="apply-coupon">
    <input type="text" name="coupon_code" id="coupon-code" placeholder="Enter coupon code">
    <button class="apply-coupon-button" type="button" id="apply-coupon">Apply</button> <!-- Button to apply coupon -->
  </div>
</div>


<button class="place-order-button" type="submit">Place Order</button>
</form>
  </div>

  <iframe src="newsletter.html" style="width:100%; border:none; margin-top:40px;" height="350"></iframe>

  <iframe src="footer.html" style="width: 100%; height: 340px; border: none;" scrolling="no"></iframe>

  <script>
    function placeOrder() {
const paymentMethod = document.querySelector('input[name="payment_method"]:checked');

      if (!paymentMethod) {
        alert("Please select a payment method.");
        return;
      }
    }
  </script>
<script>
document.getElementById('apply-coupon').addEventListener('click', function() {
    const couponCode = document.getElementById('coupon-code').value.trim();

    // Check if coupon code is entered
    if (!couponCode) {
        alert("Please enter a coupon code.");
        return;
    }

    // Prepare data for AJAX request
    const formData = new FormData();
    formData.append('coupon_code', couponCode);

    // Make the AJAX request to validate the coupon code
    fetch('validate_coupon.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())  // Parse the response as JSON
    .then(data => {
        if (data.status === 'valid') {
            alert(data.message);  // Coupon applied successfully
        } else {
            alert(data.message);  // Invalid coupon
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert("An error occurred while verifying the coupon code.");
    });
});

document.getElementById('checkout-form').addEventListener('submit', function(event) {
        const couponCode = document.getElementById('coupon-code').value.trim();

        // Check if a coupon is applied before submitting the form
        if (couponCode) {
            event.preventDefault();  // Prevent form submission if coupon code is entered

            // Trigger the coupon validation logic
            document.getElementById('apply-coupon').click();
        } else {
            // If no coupon is applied, proceed with regular form submission
            alert("Proceeding without coupon.");
        }
    });
</script>



</body>
</html>