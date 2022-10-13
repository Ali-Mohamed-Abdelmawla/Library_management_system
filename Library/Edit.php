<?php
$error_fields = array();

$conn = mysqli_connect('localhost','root','','library');
if(!$conn)
{
    echo mysqli_connect_error();
    exit;
}

$id = filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT);
$select = "SELECT * FROM `users` WHERE `users`.`ID`=".$id." LIMIT 1";
$result = mysqli_query($conn,$select);
$row = mysqli_fetch_assoc($result);

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

$id =  filter_input(INPUT_POST,'id',FILTER_SANITIZE_NUMBER_INT);
$name = mysqli_escape_string($conn,trim($_POST['Username']));
$email = mysqli_escape_string($conn,trim($_POST['Email']));

$gender = mysqli_escape_string($conn,$_POST['gender']);
$Admin = (isset($_POST['Admin'])) ? 1 : 0;

$query = "UPDATE `users` SET `Name` = '".$name."',`Admin` = '".$Admin."',`Email` = '".$email."',`Gender` = '".$gender."' WHERE `users`.`ID` = '".$id."' ";

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
        <link rel = "stylesheet" href = "Edit.css">
    <title> Edit a User</title>
    </head>
    <body>
    <form id = "signup" method = "post">
                <label for = "Username"> Enter a name :</label>
                <input type = "hidden" name = "id" id = "id" value = "<?=(isset($row['ID'])) ? $row['ID'] : ''  ?>">
                <br>
                <input type = "text" name = "Username" class="txtbx" placeholder="User-name" value = "<?= (isset($row['Name'])) ? $row['Name'] : '' ?>"/> 
                <?php 
                if(in_array("name",$error_fields))
                {
                    echo "<br><span style = 'color:red;'>* please enter a valid Username</span>";
                }
                ?>
                <br>
                <label for = "Email"> Enter an E-mail :</label>
                <br>
                <input type = "text" name = "Email" class="txtbx" placeholder="Email" value = "<?= (isset($row['Email'])) ? $row['Email'] : '' ?>">
                <?php 
                                 
                                if(in_array("email",$error_fields))
                                {
                                    echo "<br><span style = 'color:red;'>* please enter a valid E-mail</span>";
                                }
                                
                ?>
                <br>

                Choose a gender :
                <br>
                <br>                
                <div id = "male">

                        <label for = "gender"> Male </label>   <input type = "radio" name = "gender" value = "M" <?= ($row['Gender']=='M') ? 'checked' : '' ?>> 
                                </div>
                                <br>
                                <div id = "Female">
                        <label for = "gender"> Female </label>   <input type = "radio" name = "gender" value = "F" <?= ($row['Gender']=='F') ? 'checked' : '' ?>> 
                                </div>
                                <?php 
                                 
                                 if(in_array("gender",$error_fields))
                                 {
                                     echo "<br><span style = 'color:red;'>* please choose a gender</span>";
                                 }
                                 
                 ?>
                                <br>
                        <label for = "Admin"> Admin ? </label>   <input type = "checkbox" id = "admn" name = "Admin" <?= ($row['Admin']) ? 'checked' : ''?>> 
                        <Span style = "font-size:12px; font-style:italic;">(Make sure to specify if the user is admin or not)</Span> 
                            </div>
                <br>
                <input type = "submit" value = "Edit this user" id = "submit">
    </body>    
</html>