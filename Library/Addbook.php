<?php
   $error_fields = array();
   if($_SERVER['REQUEST_METHOD'] == 'POST')
   {
   if(! (isset($_POST['Bookname']) && !empty($_POST['Bookname'] )))
   {
       $error_fields[] = "name";
   }
   if(! (isset($_POST['Author']) && !empty($_POST['Author'])))
   {
       $error_fields[] = "Author";
   }
   if(! (isset($_POST['Language']) && !empty($_POST['Language'])))
   {
       $error_fields[] = "lang";
   }
   if(! (isset($_POST['price']) && !empty($_POST['price'])))
   {
       $error_fields[] = "cost";
   }
   if(! (isset($_POST['Length']) && !empty($_POST['Length'])))
   {
       $error_fields[] = "len";
   }
   if(! (isset($_POST['Category']) && !empty($_POST['Category'])))
   {
       $error_fields[] = "cate";
   }
   if(! (isset($_POST['Booknum']) && !empty($_POST['Booknum'])))
   {
       $error_fields[] = "number";
   }
   
   if(!$error_fields)
   {
       $conn = mysqli_connect('localhost','root','','library');
       if(! $conn)
       {
           echo mysqli_connect_error();
           exit;
       }
   
   $name = mysqli_escape_string($conn,trim($_POST['Bookname']));
   $number = mysqli_escape_string($conn,trim($_POST['Booknum']));
   $author = mysqli_escape_string($conn,trim($_POST['Author']));
   $language = mysqli_escape_string($conn,trim($_POST['Language']));
   $price = mysqli_escape_string($conn,trim($_POST['price']));
   $length = mysqli_escape_string($conn,trim($_POST['Length']));
   $category = mysqli_escape_string($conn,trim($_POST['Category']));
   
   $query = "INSERT INTO `books` (`BName`,`Bnum`,`Author`,`Language`,`Price`,`Length`,`Category`) VALUES ('".$name."','".$number."','".$author."','".$language."','".$price."','".$length."','".$category."')";
   
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
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Aboreto&family=Barlow&display=swap" rel="stylesheet">
      <link rel = "stylesheet" href = "Addbook.css">
      <title> Add a User</title>
   </head>
   <body>
      <form id = "signup" method = "post" enctype="multipart/form-data">
         <label for = "Bookname"> Enter a name :</label>
         <input type = "text" name = "Bookname" placeholder="Book-Name" class = "txtbx"> 
         <?php 
            if(in_array("name",$error_fields))
            {
                echo "<span style = 'color:red;'>* please enter the book's name</span>";
            }
            ?>
         <br>
         <label for = "Booknum"> Enter a number :</label>
         <input type = "text" name = "Booknum" placeholder="Book-Number" class = "txtbx"> 
         <?php 
            if(in_array("number",$error_fields))
            {
                echo "<span style = 'color:red;'>* please enter the book's number</span>";
            }
            ?>
         <br>
         <label for = "Author"> Enter the Author's name :</label>
         <input type = "text" name = "Author" placeholder="Author-Name" class = "txtbx">
         <?php 
            if(in_array("Author",$error_fields))
            {
                echo "<span style = 'color:red;'>* please enter the author's name</span>";
            }
            
            ?>
         <br>
         <label for = "language"> language :</label>
         <input type = "text" name = "Language" placeholder = "language" class = "txtbx">
         <?php 
            if(in_array("lang",$error_fields))
            {
                echo "<span style = 'color:red;'>* please enter the language of the book</span>";
            }
            
            ?>
         <br>
         <label for = "price"> Price :</label>
         <input type = "text" name = "price" placeholder = "Price" class = "txtbx">
         <?php 
            if(in_array("cost",$error_fields))
            {
                echo "<span style = 'color:red;'>* please enter the book's cost </span>";
            }
            
            ?>
         <br>
         <label for = "Length"> Number of pages :</label>
         <input type = "text" name = "Length" placeholder = "Length" class = "txtbx">
         <?php 
            if(in_array("len",$error_fields))
            {
                echo "<span style = 'color:red;'>* please enter the number of pages in the book</span>";
            }
            
            ?>
         <br>
         <label for = "Category"> Category :</label>
         <input type = "text" name = "Category" placeholder = "category" class = "txtbx">
         <?php 
            if(in_array("cate",$error_fields))
            {
                echo "<span style = 'color:red;'>* please specify the book's category </span>";
            }
            
            ?>
         <br>
         <input type = "submit" value = "Add this book" id = "submit">
         <Span style = "font-size:12px; font-style:italic; margin-right:5px;">(Make sure you filled every textarea)</Span> 
      </form>
   </body>
</html>