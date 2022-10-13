<?php
$error_fields = array();
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
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
if(! (isset($_POST['gender'])) )
{
    $error_fields[] = "gender";
}

if(!$error_fields)
{
    $conn = mysqli_connect('localhost','root','','library');
    if(! $conn)
    {
        echo mysqli_connect_error();
        exit;
    }

$name = mysqli_escape_string($conn,trim($_POST['Username']));
$email = mysqli_escape_string($conn,trim($_POST['Email']));
$pass = $_POST['pass'];
$password = password_hash($pass,PASSWORD_DEFAULT); 
$gender = mysqli_escape_string($conn,$_POST['gender']);
$Admin = (isset($_POST['Admin'])) ? 1 : 0;

$query = "INSERT INTO `users` (`Name`,`Email`,`Password`,`Gender`,`Admin`) VALUES ('".$name."','".$email."','".$password."','".$gender."','".$Admin."')";

if(mysqli_query($conn,$query))
{
    header("location:list.php");
    exit;
}
else
{
    echo mysqli_error($conn);
}
mysqli_close($conn);
}
}
?>
<html>
    <head>
        <link rel = "stylesheet" href = "Add.css">
    <title> Add a User</title>
    </head>
    <body>
    <form id = "signup" method = "post" enctype="multipart/form-data">
                <label for = "Username"> Enter a name :</label>
                <br>
                <input type = "text" class = "txtbx" name = "Username" class="input" placeholder="User-name"> 
                <?php 
                if(in_array("name",$error_fields))
                {
                    echo "<br><span style = 'color:red;'>* please enter a valid Username</span>";
                }
                ?>
                <br>
                <label for = "Email"> Enter a E-mail :</label>
                <br>
                <input type = "text" class = "txtbx" name = "Email" class="input" placeholder="Email">
                <?php 
                                 
                                if(in_array("email",$error_fields))
                                {
                                    echo "<br><span style = 'color:red;'>* please enter a valid E-mail</span>";
                                }
                                
                ?>
                
                <br>
                <label for = "pass"> Enter a password :</label>
                <br>
                <input type = "password" class = "txtbx" name = "pass" class="input" placeholder="password">
                <?php 
                                if(in_array("password",$error_fields))
                                {
                                     echo "<br><span style = 'color:red;'>* please enter a valid Password</span>";
                                 }
                ?>
                <br>
                <div id = "male">
                        <label for = "gender"> Male </label>   <input type = "radio" name = "gender" value = "M"> 
                                </div>
                                <br>
                                <div id = "Female">
                        <label for = "gender"> Female </label>   <input type = "radio" name = "gender" value = "F"> 
                                </div>
                                <?php 
                                 
                                 if(in_array("gender",$error_fields))
                                 {
                                     echo "<br><span style = 'color:red;'>* please choose a gender</span>";
                                 }
                                 
                 ?>

                                <br>
                        <label for = "Admin"> Admin ? </label>   <input type = "checkbox" id = "admn" name = "Admin" <?= (isset($_POST['Admin'])) ? 'checked' : '' ?>/> 
                        <Span style = "font-size:12px; font-style:italic;">(Make sure to specify if the user is admin or not)</Span> 

                <br>
                <input type = "submit" value = "Add this user" id = "submit">
    </body>    
</html>