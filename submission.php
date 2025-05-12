<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Thank You - SoiDhaga</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background-color: #f8f8f8;
      color: #000;
    }

    header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px;
      border-bottom: 1px solid #eee;
    }

    header img.logo {
      height: 40px;
    }

    .search-bar input {
      padding: 8px;
      width: 200px;
      border-radius: 20px;
      border: 1px solid #ccc;
    }

    .icons {
      display: flex;
      gap: 10px;
    }

    .main-section {
      text-align: center;
      padding: 40px 20px;
    }

    .thank-you-img {
      width: 100%;
      max-height: 400px;
      object-fit: cover;
    }

    h1 {
      font-size: 2.5em;
      margin: 30px 0 10px;
    }

    .btn-back {
      background-color: #d63384;
      color: white;
      padding: 12px 20px;
      text-decoration: none;
      border-radius: 4px;
      margin-top: 20px;
      display: inline-block;
    }
.btn-back:hover {
      background-color: black;
      color: white;
      padding: 12px 20px;
      text-decoration: none;
      border-radius: 4px;
      margin-top: 20px;
      display: inline-block;
    }
    .testimonials {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      padding: 40px 20px;
      gap: 20px;
    }

    .testimonial {
      background-color: #f9f9f9;
      padding: 20px;
      border-radius: 10px;
      width: 300px;
      box-shadow: 0 0 8px rgba(0,0,0,0.1);
    }

    .testimonial .stars {
      color: #f39c12;
    }

    footer {
      background-color: #f5f5f5;
      padding: 40px 20px;
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
      font-size: 14px;
    }

    footer div {
      flex: 1;
      min-width: 200px;
      margin: 10px;
    }

    footer .footer-logo img {
      height: 40px;
    }

    footer .social-icons img {
      width: 24px;
      margin-right: 10px;
    }

    .newsletter input[type="email"] {
      padding: 10px;
      width: 250px;
      border-radius: 4px;
      border: 1px solid #ccc;
    }

    .newsletter button {
      padding: 10px 16px;
      background-color: black;
      color: white;
      border: none;
      border-radius: 4px;
      margin-left: 5px;
    }

  </style>
</head>
<body>

<?php include 'header.php'; ?>
  <div class="main-section">
    <img src="thankyou.png" alt="Thank You Image" class="thank-you-img">
    <h1>Thank you!<br>Visit us Again Soon!</h1>
    <a href="main.html" class="btn-back">Return To Home Page</a>
  </div>

  <div class="testimonials">
    <div class="testimonial">
      <div class="stars">★★★★★</div>
      <strong>Sarah M.</strong>
      <p>The quality and detail in each outfit is what sets SohDhaga apart. Will definitely shop again!</p>
    </div>
    <div class="testimonial">
      <div class="stars">★★★★★</div>
      <strong>Alex K.</strong>
      <p>I was blown away by the comfort and style. It’s rare to find both at this price. Highly recommended!</p>
    </div>
    <div class="testimonial">
      <div class="stars">★★★★★</div>
      <strong>James L.</strong>
      <p>Shopping at SohDhaga has changed my wardrobe game completely. Thank you for the great experience!</p>
    </div>

  </div>

    <iframe src="footer.html" style="width: 100%; height: 340px; border: none;" scrolling="no"></iframe>

</body>
</html>
