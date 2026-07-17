<?php
$total = $_GET['total'];
$method = $_GET['method'];
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
 <style>
body {
    background-image: url("BG-ALL.jpg");
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
}
</style>

</head>
<body class="cookie-all">

<div class="qr-container">

    <h2>Pay via <?= $method ?></h2>

    <div class="qr-total">Total: ₱<?= $total ?></div>

    <img src="gcash-qr.jpg" alt="QR Code">

    <p>Scan the QR code to pay.</p>
<p>
  Send proof of payment 
  <a href="https://www.instagram.com/chonk.crumb" target="_blank" style="color: black;">
    <b>@chonk.crumb</b>
  </a>
  in IG after transaction.
</p>
    <a href="index.php" class="back-btn">Back to Home</a>

</div>

</body>
</html>