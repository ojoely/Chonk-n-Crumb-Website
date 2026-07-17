<?php
include 'connect.php';

$id = $_GET['id'];
$sql = "SELECT * FROM orders WHERE id = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student Record</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h1>Edit Customer Details</h1>

    <form action="update.php" method="POST" class="form-box">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

        <label>Full Name</label>
        <input type="text" name="full_name" value="<?php echo $row['full_name']; ?>" required>

        <label>Contact Number</label>
        <input type="text" name="contact_number" value="<?php echo $row['contact_number']; ?>" required>

        <label>Address</label>
        <input type="text" name="address" value="<?php echo $row['address']; ?>" required>

        <label>Delivery Option</label>
<select name="delivery_option" required>

    <option value="Delivery" <?php if($row['delivery_option']=="Delivery") echo "selected"; ?>>
        Delivery
    </option>

    <option value="Pickup" <?php if($row['delivery_option']=="Pickup") echo "selected"; ?>>
        Pickup
    </option>

</select>

        <label>Date & Time</label>
        <input type="datetime-local" name="order_datetime" value="<?php echo $row['order_datetime']; ?>" required>

        <button type="submit">Update Record</button>
        <a href="index.php" class="back-btn">Back</a>
    </form>
</div>

</body>
</html>