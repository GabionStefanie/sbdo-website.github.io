<!DOCTYPE html>
<html>

<head>
  <title>Payment Details Form</title>
  <link rel="stylesheet" type="text/css" href="css/payments-css.css">
  <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js" defer></script>
  <script src="jscript/payments-validation.js" defer></script>
  <style>
    <?php include '../header-footer/header-footer.css' ?>
  </style>
</head>

<body>
  <?php include '../header-footer/header.php' ?>
  <div class="wrapper">
    <div class="payment-form">
      <h2>Payment Details Form</h2>
      <p>Please pay a downpayment of P500 to the GCash Account provided below. Upload your proof of payment below.</p>
      <form method="post" action="backend/process_payment.php" enctype="multipart/form-data" id="payments-html" novalidate>
        <div>
          <div>
            <label>Reference Number:</label><br>
          </div>
          <div>
            <input type="text" id="referenceNo" name="referenceNo" required><br><br>
          </div>
        </div>
        <label>Amount: P500 </label><br>
        
        <label for="qrCode">QR Code:</label><br>
        <img src="images/GCashQR.jpg" alt="qrCode" id="qrCode"><br><br>

        <div>
          <div>
            <div>
              <label>Proof of Payment (Receipt):</label><br>
            </div>
            <input type="file" id="proofOfPayment" name="proofOfPayment" required><br><br>
          </div>
        </div>

        <input type="submit" value="Submit">
      </form>
    </div>
  </div>
  <?php include '../header-footer/footer.php' ?>
</body>

</html>
