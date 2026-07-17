<?php
include 'connect.php';

$id = $_POST['id'];
$full_name = $_POST['full_name'];
$contact_number = $_POST['contact_number'];
$address = $_POST['address'];
$mode_of_payment = $_POST['mode_of_payment'];
$delivery_option = $_POST['delivery_option'];
$order_datetime = $_POST['order_datetime'];

$sql = "UPDATE orders SET
        full_name='$full_name',
        contact_number='$contact_number',
        address='$address',
        mode_of_payment='$mode_of_payment',
        delivery_option='$delivery_option',
        order_datetime='$order_datetime'
        WHERE id=$id";

if (mysqli_query($conn, $sql)) {
    header("Location: index.php");
    exit();
} else {
    echo "Error updating record: " . mysqli_error($conn);
}
?>

 

