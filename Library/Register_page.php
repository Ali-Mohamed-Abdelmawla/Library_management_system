<?php
    $error_arr=array();
    if(isset($_GET['error_fields']))
    {
        $error_arr = explode(",",$_GET['error_fields']);
    }
?>
<html>
    <head>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Aboreto&family=Barlow&display=swap" rel="stylesheet">
        <link rel = "stylesheet" href="Register_page.css">
        <title>
            Register 
            </title>
        </head>
        <body>
            <h1 style = "color : black; font-size:50px;"> Sign up with us ! </h1>
            <form id = "signup" action = "redirection.php" method = "post">
                <label for = "Username" class = "lbl"> Enter your name :</label>
                <input type = "text" name = "Username" class="txtbx" placeholder="User-name"> 
                <?php 
                if(in_array("name",$error_arr))
                {
                    echo "<br>* please enter a valid Username";
                }
                ?>
                <br>
                <label for = "Email" class = "lbl"> Enter your E-mail :</label>
                <input type = "text" name = "Email" class="txtbx" placeholder="Email">
                <?php 
                                 
                                if(in_array("email",$error_arr))
                                {
                                    echo "<br>* please enter a valid E-mail";
                                }
                                
                ?>
                <br>
                <label for = "pass" class = "lbl"> Enter your password :</label>
                <input type = "password" name = "pass" class="txtbx" placeholder="password">
                <?php 
                                if(in_array("password",$error_arr))
                                {
                                     echo "<br>* please enter a valid Password";
                                 }
                ?>
                <br>
                Choose your gender :
                <br>
                <br>
                <div id = "male">
                        <label for = "gender"> Male </label>   <input type = "radio" name = "gender" value = "M"> 
                                </div>
                                <br>
                                <div id = "Female">
                        <label for = "gender"> Female </label>   <input type = "radio" name = "gender" value = "F"> 
                                </div>
                                <br>
                            </div>
                <input type = "submit" value = "sign-up" id = "submit">
            </form>
        </body>
</html>