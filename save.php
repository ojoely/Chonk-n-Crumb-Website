<?php

include 'connect.php';

$full_name = $_POST['full_name'];
$contact_number = $_POST['contact_number'];
$email = $_POST['email'];
$address = $_POST['address'];
$mode_of_payment = $_POST['mode_of_payment'];
$delivery_option = $_POST['delivery_option'];
$order_datetime = $_POST['order_datetime'];

/* ITEMS */
$items = [];

if(isset($_POST['items'])) {

    foreach($_POST['items'] as $name => $qty) {

        if($qty > 0) {
            $items[$name] = $qty;
        }
    }
}

$items_json = json_encode($items);

$prices = [
    "OG Chonk" => 50,
    "Red Velvet" => 55,
    "Matcha Dream" => 55,
    "Mocha Chonk" => 55,
    "Midnight Choco" => 60,
    "Walchonk" => 60,
    "Cheezy Crumb" => 60,
    "All Crumbs Set" => 279
];

$total = 0;

foreach ($items as $name => $qty) {
    if ($qty > 0 && isset($prices[$name])) {
        $total += $prices[$name] * $qty;
    }
}

/* INSERT */
$sql = "INSERT INTO orders
(
    full_name,
    contact_number,
    email,
    address,
    mode_of_payment,
    delivery_option,
    order_datetime,
    items
)

VALUES
(
    '$full_name',
    '$contact_number',
    '$email',
    '$address',
    '$mode_of_payment',
    '$delivery_option',
    '$order_datetime',
    '$items_json'
)";

if (mysqli_query($conn, $sql)) {

    // 💵 CASH / COD FLOW
    if ($mode_of_payment == "Cash") {

        header("Location: receipt.php?total=$total&name=" . urlencode($full_name));
        exit();
    }

    // 📱 GCASH / BANK FLOW
    if ($mode_of_payment == "GCash" || $mode_of_payment == "Bank Transfer") {

        header("Location: qr.php?total=$total&method=$mode_of_payment");
        exit();
    }

} else {

    echo 'Error: ' . mysqli_error($conn);
}