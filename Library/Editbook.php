<?php
$error_fields = array();

$conn = mysqli_connect('localhost','root','','library');
if(!$conn)
{
    echo mysqli_connect_error();
    exit;
}

$id = filter_input(INPUT_GET,'id2',FILTER_SANITIZE_NUMBER_INT);
$select = "SELECT * FROM `books` WHERE `books`.`Index`='".$id."' LIMIT 1";
$result = mysqli_query($conn,$select);
$row = mysqli_fetch_assoc($result);

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
if(! (isset($_POST['Bookname']) && !empty($_POST['Bookname'])))
{
    $error_fields[] = "name";
}
if(! (isset($_POST['author']) && !empty($_POST['author'])))
{
    $error_fields[] = "author";
}
if(! (isset($_POST['language']) && !empty($_POST['language'])))
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
    if(!$conn)
    {
        echo mysqli_connect_error();
        exit;
    }
    
    $id = filter_input(INPUT_GET,'id2',FILTER_SANITIZE_NUMBER_INT);

$name = mysqli_escape_string($conn,trim($_POST['Bookname']));
$number = mysqli_escape_string($conn,trim($_POST['Booknum']));
$author = mysqli_escape_string($conn,trim($_POST['author']));
$language = mysqli_escape_string($conn,trim($_POST['language']));
$price = mysqli_escape_string($conn,trim($_POST['price']));
$length = mysqli_escape_string($conn,trim($_POST['Length']));
$category = mysqli_escape_string($conn,trim($_POST['Category']));

$queryb = "UPDATE `books` SET `BName` = '".$name."',`Bnum` = '".$number."',`Author` = '".$author."',`Language` = '".$language."',`Price` = '".$price."',`Length` = '".$length."',`Category` = '".$category."' WHERE `books`.`Index` = '".$id."' ";

if(mysqli_query($conn,$queryb))
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

        <link rel = "stylesheet" href = "Editbook.css">
    <title> Edit a Book</title>
    </head>
    <body>
    <form id = "signup" method = "post">
                <label for = "Bookname"> Enter a name :</label>
                
                <input type = "hidden" name = "id2" id = "id" value = "<?=(isset($row['Index'])) ? $row['Index'] : ''  ?>">
                <input type = "text" name = "Bookname" class = "txtbx" placeholder="Book-name" value = "<?= (isset($row['BName'])) ? $row['BName'] : '' ?>"> 
                    <?php 
                            if(in_array("name",$error_fields))
                            {       
                                echo "<span style = 'color:red;'>* please enter a name for the book</span>";
                            }
                    ?>
                <br>
                <label for = "Booknum"> Enter a number :</label>
         <input type = "text" name = "Booknum" placeholder="Book-Number" class = "txtbx" value = "<?= (isset($row['Bnum'])) ? $row['Bnum'] : '' ?>"> 
         <?php 
            if(in_array("number",$error_fields))
            {
                echo "<span style = 'color:red;'>* please enter the book's number</span>";
            }
            ?>
         <br>
                <label for = "author"> Enter the author's name :</label>
                
                <input type = "text" name = "author" class = "txtbx" placeholder="Author" value = "<?= (isset($row['Author'])) ? $row['Author'] : '' ?>">
                    <?php 
                                 
                            if(in_array("author",$error_fields))
                            {
                                echo "<span style = 'color:red;'>* please enter the name of the author</span>";
                            }
                                
                    ?>
                <br>
                <label for = "language"> Language :</label>
                
                <input type = "text" class = "txtbx" name = "language"  placeholder="Language" value = "<?= (isset($row['Language'])) ? $row['Language'] : '' ?>">
                <?php 
                                 
                                 if(in_array("lang",$error_fields))
                                 {
                                     echo "<span style = 'color:red;'>* please enter the language of the book</span>";
                                 }
                                     
                         ?>
                
                <br>
                <label for = "price"> Price :</label>
                
                <input type = "text" class = "txtbx" name = "price" placeholder = "Price" value = "<?= (isset($row['Price'])) ? $row['Price'] : '' ?>">
                <?php 
                                 
                                 if(in_array("cost",$error_fields))
                                 {
                                     echo "<span style = 'color:red;'>* please enter the book's cost</span>";
                                 }
                                     
                         ?>
                
                <br>
                <label for = "Length"> Number of pages :</label>
                
                <input type = "text" class = "txtbx" name = "Length" placeholder = "Length" value = "<?= (isset($row['Length'])) ? $row['Length'] : '' ?>">
                <?php 
                                 
                                 if(in_array("len",$error_fields))
                                 {
                                     echo "<span style = 'color:red;'>* please enter the number of pages in the book</span>";
                                 }
                                     
                         ?>
                <br>
                <label for = "Category"> Category :</label>
                
                <input type = "text" class = "txtbx" name = "Category" placeholder = "Category" value = "<?= (isset($row['Category'])) ? $row['Category'] : '' ?>">
                <?php 
                                 
                                 if(in_array("cate",$error_fields))
                                 {
                                     echo "<span style = 'color:red;'>* please specify the book's category </span>";
                                 }
                                     
                         ?>
                <br> 
                <input type = "submit" value = "Edit this book" id = "submit">
                <Span style = "font-size:12px; font-style:italic; margin-right:5px;">(Make sure you filled every textarea)</Span> 

    </body>    
</html>