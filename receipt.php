<?php
$total = $_GET['total'];
$name = $_GET['name'];
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

<div class="receipt-container">

    <h2>Order Receipt</h2>

    <p>Name: <?= $name ?></p>

    <p class="receipt-total">Total: ₱<?= $total ?></p>

    <p>Payment: Cash on Delivery</p>
    <p>Please prepare exact amount upon delivery.</p>

    <a href="index.php" class="back-btn">Back to Home</a>

</div>

</body>
</html>