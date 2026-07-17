<?php

session_start();

if(!isset($_SESSION['admin'])){

    header("Location: admin_login.php");
    exit();
}

include 'connect.php';

?>

<!DOCTYPE html>
<html>

<head>
 


<title>Admin Orders</title>

<style>

body{
    font-family: Arial;
    padding: 20px;

    background-image: url("BG-ALL.jpg");
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    background-attachment: fixed;
}

/* DARK OVERLAY */
body::before{
    content: "";
    position: fixed;
    top: 0;
    left: 0;

    width: 100%;
    height: 100%;

    background: rgba(0,0,0,0.35);

    z-index: -1;
}

table{
    width: 100%;
    border-collapse: collapse;
    background: rgba(255,255,255,0.92);
}

th, td{
    border: 1px solid #ccc;
    padding: 10px;
    text-align: center;
}

th{
    background: #cf5eb1;
    color: white;
}

.title{
    font-size: 35px;
    margin-bottom: 20px;
    font-weight: bold;
    color: white;
    text-shadow: 2px 2px 8px black;
}

.search-box{
    margin-bottom: 20px;
}

input[type=text]{
    padding: 10px;
    width: 300px;
}

button{
    padding: 10px 15px;
    cursor: pointer;
}

a{
    text-decoration: none;
}

.edit-box{
    background: blue;
    color: white;
    padding: 6px 12px;
    border-radius: 5px;
}

.delete-box{
    background: red;
    color: white;
    padding: 6px 12px;
    border-radius: 5px;
}

.logout-btn{
    background: black;
    color: white;
    padding: 10px 20px;
    border-radius: 5px;
    float: right;
    margin-bottom: 20px;
}

</style>

</head>

<body class="cookie-all">


<a href="cookie.html" class="logout-btn">
Logout Admin
</a>

<!-- SEARCH -->
<form method="GET" class="search-box">

<input type="text"
name="search"
placeholder="Search orders..."
value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">

<button type="submit">Search</button>

</form>

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

$search = "";

if(isset($_GET['search'])){
    $search = mysqli_real_escape_string($conn, $_GET['search']);
}

if($search != ""){

    $sql = "SELECT * FROM orders
            WHERE full_name LIKE '%$search%'
            OR email LIKE '%$search%'
            OR contact_number LIKE '%$search%'
            ORDER BY id DESC";

}else{

    $sql = "SELECT * FROM orders ORDER BY id DESC";
}

$result = mysqli_query($conn, $sql);

if(!$result){
    die("SQL ERROR: " . mysqli_error($conn));
}

while($row = mysqli_fetch_assoc($result)){

?>

<tr>

<td><?php echo $row['id']; ?></td>
<td><?php echo $row['full_name']; ?></td>
<td><?php echo $row['contact_number']; ?></td>
<td><?php echo $row['email']; ?></td>
<td><?php echo $row['address']; ?></td>
<td><?php echo $row['mode_of_payment']; ?></td>
<td><?php echo $row['delivery_option']; ?></td>
<td><?php echo $row['order_datetime']; ?></td>

<td>

<?php

$items = json_decode($row['items'], true);

if(!empty($items)){

    foreach($items as $name => $qty){

        echo $name . " x " . $qty . "<br>";
    }

}else{

    echo "No items";
}

?>

</td>

<td>



<a class="delete-box"
href="delete.php?id=<?php echo $row['id']; ?>"
onclick="return confirm('Delete this order?')">
Delete
</a>

</td>

</tr>

<?php } ?>

</table>

</body>
</html>