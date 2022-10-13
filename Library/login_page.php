<?php
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
$conn = mysqli_connect('localhost','root','','library');
if(! $conn)
{
    echo mysqli_connect_error();
    exit;
}

$email = $_POST['Username'];
$password = $_POST['pass'];

$query = "SELECT * FROM `users` WHERE `Email` = '".$email."' LIMIT 1";

$resul = mysqli_query($conn,$query);
session_start();

if($row = mysqli_fetch_assoc($resul))
{
    $_SESSION['ID'] = $row['ID'];
    $_SESSION['Email'] = $row['Email'];
    $_SESSION['name'] = $row['Name'];
    if(password_verify($password,$row['Password']))
    {
        if($row['Admin'] == 1)
        {
            header("location:List.php");
            exit;
        }
    header("location:pageHome.php");
    }
}else
{
    $error = "Invalid Email or password";
    
}
mysqli_free_result($resul);
mysqli_close($conn);
}
?>

<html>
    <head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Aboreto&family=Barlow&display=swap" rel="stylesheet">
        <link rel = "stylesheet" href="login_page.css">
        <title>
            Login page
            </title>
        </head>
        <body>
            <form id = "login" method = "POST">
            <span style = "margin-bottom:5px; color:red;"><?php if(isset($error)) echo $error; ?></span>
                <label for = "Username"> Enter your E-mail :</label>
                <input type = "text" name = "Username" class="txtbx" placeholder="E-mail"> 
                <br>
                <label for = "pass"> Enter your password :</label>
                <input type = "password" name = "pass" class="txtbx" placeholder="password">
                <br>
                <input type = "submit" value = "Login " id = "submit">
                <span style = "margin-top:10px;">Don't have an account ? <a href = "Register_page.php"> Sign-up </a></span>
            </form>
            
        </body>
</html>
