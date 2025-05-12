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
margin-top:50px
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
    border: none; /* Remove the border */
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
  margin-left: 50px;  /* Centering the button horizontally */
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

<?php include 'header.php'; ?>

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
  <input type="text" id="first-name" name="first_name" pattern="[A-Za-z]+" title="First name must contain letters only" required>
</div>
<div class="checkout-row">
  <label for="last-name">Last Name</label>
  <input type="text" name="last_name" pattern="[A-Za-z]+" title="Last name must contain letters only" required>
</div>
        <div class="checkout-row">
          <label for="phone-number">Phone Number</label>
<input type="tel" name="phone_number" pattern="\d{11}" maxlength="11" title="Phone number must be exactly 11 digits" required>
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
<input type="text" name="country" pattern="[A-Za-z]+" title="Country must contain letters only" required>
        </div>

        <div class="checkout-row">
          <label for="city">Town/City</label>
<input type="text" name="city" pattern="[A-Za-z]+" title="City must contain letters only" required>
        </div>

        <div class="checkout-row">
          <label for="state">State</label>
<input type="text" name="state" pattern="[A-Za-z]+" title="State must contain letters only" required>
        </div>
        <div class="checkout-row">
  <label for="zip-code">Zip Code</label>
  <input type="text" name="zip" pattern="\d+" title="Zip code must contain only numbers" required>
</div>


  <div class="checkout-box">
  <div class="box-title">Payment Method</div>
  <div class="payment-method">
    <div class="payment-option">
      <input type="radio" name="payment_method" value="credit card" required>
      <label for="credit-card">Pay by Credit Card</label>
    </div>
    <div class="payment-option">
      <input type="radio" name="payment_method" value="paypal" required>
      <label for="paypal">Paypal</label>
    </div>
    <div class="payment-option">
      <input type="radio" name="payment_method" value="cod" required>
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
document.getElementById('apply-coupon').addEventListener('click', function () {
    const couponCode = document.getElementById('coupon-code').value.trim();

    if (!couponCode) {
        alert("Please enter a coupon code.");
        return;
    }

    const formData = new FormData();
    formData.append('coupon_code', couponCode);

    // Step 1: Validate the coupon
    fetch('validate_coupon.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'valid') {
            alert(data.message);

            // ✅ Step 2: Apply the coupon to cart (update total_price in DB)
            return fetch('apply_coupon_code.php')
                .then(res => res.json())
                .then(applyData => {
                    if (applyData.status === 'error') {
                        console.error(applyData.message);
                        alert("Failed to apply coupon to cart.");
                    } else {
                        console.log("Coupon applied to cart.");
                        // Optionally update total display here
                    }
                });
        } else {
            alert(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert("An error occurred while applying the coupon.");
    });
});
</script>


</body>
</html>
