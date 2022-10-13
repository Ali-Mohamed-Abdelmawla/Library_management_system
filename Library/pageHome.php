<?php
$conn = mysqli_connect('localhost','root','','library');
if(!$conn)
{
    echo mysqli_connect_error();
    exit;
}

$query = "SELECT * FROM `books`";

if(isset($_GET['searchbar']))
{
    $search = mysqli_escape_string($conn,$_GET['searchbar']);
    $query .= "WHERE `books`.`Bname` LIKE '%".$search."%' OR `books`.`Author` LIKE '%".$search."%' ";
}
$result = mysqli_query($conn,$query);
?>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Aboreto&display=swap" rel="stylesheet">
    <script src ="script.js"> </script>
    <link rel = "stylesheet" href = "Home.css">
<title>
    New_page
</title>
</head>
<body>  

<nav>
<div class = "logo"><img src = "bookshelf.png" > <b style = "color:red;">My</b> library </div>
    <div class = "search_bar">
        <form method="get">
        <input type = "text" placeholder="Search" name = "searchbar" id = "bar">
        <input type = "submit" value = "Search" id = "srchsbmt">
        </form>
    </div>
    <div class = "inner"> 
    <div>
    <?php 
    session_start();
if(isset($_SESSION['ID']))
{
    echo '<pre style = "color:black;"> <ul> <li>Welcome, '.$_SESSION['name'].'<br><a href = "logout.php">Logout</a>?</li></ul></pre>';
}else
{
    header("Location:login_page.php");
}
 ?>
    </div>
    <div id = "log">
    <div id = "reglog" >
    <ul id = "ul1">
        <li><input type = "submit" value ="Register" class = "btn" onclick="Gotoregister()"></li> 
        <li><input type = "submit" value = "Login" class = "btn" onclick = "Gotolog()"></li>
    </ul>
</div>
</div>
</div>
</nav>
        
<br>
<br>
<br>    
<br>   
<br>           
<div class = "row">  
    <div class = "container column12">
        <?php
        while($row = mysqli_fetch_assoc($result))
        {
        ?>
        <div class = "card ">         
                            <span class = "def">    Name: </span>   <?= $row['BName'] ?> 
                    <br>    <span class = "def">    Author:  </span>        <?= $row['Author'] ?>
                    <?php 
                    
                    $arr = $row['Submission-date'];
                    $pieces = explode(" ",$arr);                    
                    ?> 
                    <br>    <span class = "def">    Date-submitted: </span>         <?= $pieces[0] ?>
                    <br>    <span class = "def">    Time-submitted: </span>         <?= $pieces[1] ?>
                    <br>    <span class = "def">    Language:  </span>        <?= $row['Language']  ?> 
                    <br>    <span class = "def">    Price:   </span>       <?= $row['Price'] ?>$
                    <br>    <span class = "def">    Length: </span>         <?= $row['Length'] ?>
                    <br>    <span class = "def">    Category:  </span>        <?= $row['Category'] ?>
        </div> 
        <?php } ?>
    
    
    </div> 
</div>
</body>

</html>