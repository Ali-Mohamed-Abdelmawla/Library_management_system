<?php
$error_fields = array();
if(! (isset($_POST['Username']) && !empty($_POST['Username'])))
{
    $error_fields[] = "name";
}
if(! (isset($_POST['Email']) && filter_input(INPUT_POST,'Email',FILTER_VALIDATE_EMAIL)))
{
    $error_fields[] = "email";
}
if(! (isset($_POST['pass']) && strlen($_POST['pass'])>5))
{
    $error_fields[] = "password";
}
if($error_fields)
{
    header("location: Register_page.php?error_fields=".implode(",", $error_fields));
    exit;
}
//connection
$conn = mysqli_connect('localhost','root','','library');
if(!$conn)
{
   echo mysqli_connect_error();
   exit;
} 

$name = mysqli_escape_string($conn,$_POST['Username']);
$email = mysqli_escape_string($conn,$_POST['Email']);
$pass = $_POST['pass'];
$password = password_hash($pass,PASSWORD_DEFAULT);
$gender = mysqli_escape_string($conn,$_POST['gender']);

$query = "INSERT INTO `users` (`Name`,`Email`,`Password`,`Gender`) VALUES ('".$name."','".$email."','".$password."','".$gender."')";
if(mysqli_query($conn,$query))
{
    ?><html>
        <head> </head>
        <body> <script> alert('Thank you,your data is saved'); </script></body>
    </html>
    
    <?php

    header("location:login_page.php");
}
else
{
    echo $query;
    echo mysqli_error($conn);
}
mysqli_close($conn);