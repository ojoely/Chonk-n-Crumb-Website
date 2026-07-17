<?php
session_start();

$error = "";

if(isset($_POST['password'])){

    $password = $_POST['password'];

    if($password == "chonk.crumb123!"){

        $_SESSION['admin'] = true;

        header("Location: admin.php");
        exit();

    }else{

        $error = "Wrong password!";
    }
}
?>

<!DOCTYPE html>
<html>

<head>

<title>Admin Login</title>

<style>

body{
    font-family: Arial;
    background-image: url("BG-ALL.jpg");
    background-size: cover;
    background-position: center;

    display: flex;
    justify-content: center;
    align-items: center;

    height: 100vh;
}

.login-box{

    background: rgba(255,255,255,0.9);

    padding: 40px;

    border-radius: 15px;

    text-align: center;

    width: 300px;
}

input{

    width: 100%;
    padding: 12px;
    margin-top: 15px;
}

button{

    margin-top: 20px;
    padding: 12px;
    width: 100%;

    background: black;
    color: white;

    border: none;

    cursor: pointer;
}

.error{

    color: red;
    margin-top: 10px;
}

</style>

</head>

<body>

<div class="login-box">

<h2>Admin Login</h2>

<form method="POST" autocomplete="off">

<input
type="password"
name="password"
placeholder="Enter admin password"
required
autocomplete="new-password">

<button type="submit">
Login
</button>

</form>

<div class="error">
<?php echo $error; ?>
</div>

</div>

</body>
</html>