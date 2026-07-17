<?php include 'connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Customer Order System</title>

<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="stylecookie.css">

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">

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


<div class="fade">

<!-- NAV -->
<ul>
    <li id="logoone">
    <a href="admin_login.php" style="text-decoration:none; color:#000;">
        CNC
    </a>
</li>
    <li><a href="cookie.html">Home</a></li>
    <li><a href="about.html">About</a></li>

    <li class="dropdown">
        <a href="#" class="dropbtn">Gallery</a>
        <div class="dropdown-content">
            <a href="products.html">Products & Menu</a>
            <a href="orders.html">Orders</a>
            <a href="achieve.html">Achievements</a>
        </div>
    </li>

    <li><a href="index.php" class="active">Order Now</a></li>
</ul>

<div class="container">

<!-- CUSTOMER DETAILS -->
<div class="title">Customer Details</div>

<form action="save.php" method="POST" class="form-box">

<div class="form-grid">

<div>
<label>Full Name</label>
<input type="text" name="full_name" placeholder="Enter full name" required>
</div>

<div>
<label>Contact Number</label>
<input type="text" name="contact_number" placeholder="09XXXXXXXXX" required>
</div>

<div>
<label>Email</label>
<input type="email" name="email" placeholder="example@email.com" required>
</div>

<div>
<label>Address</label>
<input type="text" name="address" placeholder="Complete address" required>
</div>

</div>

<label>Mode of Payment</label>
<select name="mode_of_payment" required>
<option value="" disabled selected>Select</option>
<option value="GCash">GCash</option>
<option value="Cash">Cash</option>
<option value="Bank Transfer">Bank Transfer</option>
</select>

<label>Delivery Option</label>
<select name="delivery_option" required>
<option value="" disabled selected>Select</option>
<option value="Delivery">Delivery</option>
<option value="Pickup">Pickup</option>
</select>

<!-- DATE -->
<label>Date & Time</label>
<input type="datetime-local" id="order_datetime" name="order_datetime" required>

<small id="date-warning" style="color:red;font-weight:bold;"></small>

<script>
const input = document.getElementById("order_datetime");
const warning = document.getElementById("date-warning");

const now = new Date();
now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
input.min = now.toISOString().slice(0,16);

input.addEventListener("change", function () {

    const selected = new Date(this.value);
    const day = selected.getDay();
    const hours = selected.getHours();

    if (day === 0) {
        warning.textContent = "Closed on Sundays.";
        this.value = "";
        return;
    }

    if (hours < 8 || hours >= 17) {
        warning.textContent = "Only 8AM–5PM allowed.";
        this.value = "";
        return;
    }

    warning.textContent = "";
});
</script>

<!-- ORDER -->
<div class="title">Place Order</div>

<div class="order-grid">

<div><label>OG Chonk</label><input type="number" name="items[OG Chonk]" value="0" min="0"></div>
<div><label>Red Velvet</label><input type="number" name="items[Red Velvet]" value="0" min="0"></div>
<div><label>Matcha Dream</label><input type="number" name="items[Matcha Dream]" value="0" min="0"></div>
<div><label>Mocha Chonk</label><input type="number" name="items[Mocha Chonk]" value="0" min="0"></div>
<div><label>Midnight Choco</label><input type="number" name="items[Midnight Choco]" value="0" min="0"></div>
<div><label>Walchonk</label><input type="number" name="items[Walchonk]" value="0" min="0"></div>
<div><label>Cheezy Crumb</label><input type="number" name="items[Cheezy Crumb]" value="0" min="0"></div>
<div><label>All Crumbs Set</label><input type="number" name="items[All Crumbs Set]" value="0" min="0"></div>



</div>

<button type="submit">Place Order</button>

</form>

<!-- SEARCH -->
<div class="title">Saved Details</div>

<form method="GET" class="search-box">

<input type="text" name="search" placeholder="Search data..."
value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">

<button type="submit">Search</button>

<a href="index.php" class="reset-btn">Reset</a>

</form>

<!-- TABLE -->
<div class="table-container">
<table>

<tr>
<th>ID</th>
<th>Full Name</th>
<th>Contact</th>
<th>Email</th>
<th>Address</th>
<th>Payment</th>
<th>Delivery</th>
<th>Date & Time</th>
<th>Items</th>
<th>Actions</th>
</tr>

<?php

$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

$sql = ($search != "")
? "SELECT * FROM orders WHERE full_name LIKE '%$search%' OR contact_number LIKE '%$search%' OR email LIKE '%$search%' OR address LIKE '%$search%' OR mode_of_payment LIKE '%$search%' OR delivery_option LIKE '%$search%' OR order_datetime LIKE '%$search%' ORDER BY id DESC"
: "SELECT * FROM orders ORDER BY id DESC";

$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
?>

<tr>

<td><?= $row['id'] ?></td>
<td><?= $row['full_name'] ?></td>
<td><?= $row['contact_number'] ?></td>
<td><?= $row['email'] ?></td>
<td><?= $row['address'] ?></td>
<td><?= $row['mode_of_payment'] ?></td>
<td><?= $row['delivery_option'] ?></td>
<td><?= $row['order_datetime'] ?></td>

<td>
<?php
$items = json_decode($row['items'], true);
if (!empty($items)) {
    foreach ($items as $name => $qty) {
        if ($qty > 0) {
            echo $name . " - " . $qty . "<br>";
        }
    }
} else {
    echo "No items";
}
?>
</td>

<td>
<a class="edit-box" href="edit.php?id=<?= $row['id'] ?>">Edit</a>
</td>

</tr>

<?php } ?>

</table>
</div>

</div>
</div>

</body>
</html>