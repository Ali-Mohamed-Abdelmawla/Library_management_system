<?php
$conn = mysqli_connect('localhost','root','','library');
if(!$conn)
{
    echo mysqli_connect_error();
    exit;
}


$query = "SELECT * FROM `users`";
$query2 = "SELECT * FROM `books`";


if(isset($_GET['search']))
{
    $search = mysqli_escape_string($conn,$_GET['search']);
    $query .= "WHERE `users`.`Name` LIKE '%".$search."%' OR `users`.`Email` LIKE '%".$search."%'";
}
if(isset($_GET['search2']))
{
    $search2 = mysqli_escape_string($conn,$_GET['search2']);
    $query2 .= "WHERE `books`.`BName` LIKE '%".$search2."%' OR `books`.`Author` LIKE '%".$search2."%'";
}
$result = mysqli_query($conn,$query);
$result2 = mysqli_query($conn,$query2);
?>
<html>
    <head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Aboreto&family=Barlow&display=swap" rel="stylesheet">
        <link rel = "stylesheet" href = "List.css">


        <title>
            Users list
        </title>
    </head>
    <body>

    <h1> Books list </h1>
        <form method = "GET">
            <input type = "text" placeholder="Search by Book-Name or Author" name = "search2" style = "width:20%;">
            <input type  = "Submit" value = "Search">
        </form>
        <table class = "table">

            <thead>
                <th> Number </th>
                <th> Name</th>
                <th> Author </th>
                <th> Submission-date </th>
                <th> Language </th>
                <th> Price </th>
                <th> Length </th>
                <th> Category </th>
                <th> Actions </th>
            </thead>
            <tbody>
            <?php
            while($row = mysqli_fetch_assoc($result2))
            {
            ?>
            <tr>
                <td><?= $row['Bnum'] ?> </td>
                <td><?= $row['BName'] ?> </td>
                <td><?= $row['Author'] ?> </td>
                <td><?= $row['Submission-date'] ?> </td>
                <td><?= $row['Language'] ?> </td>
                <td><?= $row['Price'] ?>$ </td>
                <td><?= $row['Length'] ?> </td>
                <td><?= $row['Category'] ?> </td>
            
                <td>  
                    <a  id = "edit"  href = "Editbook.php?id2=<?= $row['Index'] ?>" style = "text-decoration:none; color:rgb(219, 133, 99);"> Edit </a> | 
                    <a  href = '
                    javascript:
    swal({
  title: "Delete selected item?",
  text: "Unrecoverable Data",
  icon: "warning",
  buttons: true,
  dangerMode: "true",
})
.then((willDelete) => {
  if (willDelete) {
   swal({ title: "Delete Data Successfully",
 icon: "success"}).then(okay => {
   if (okay) {
    window.location.href = "Deletebook.php?id=<?= $row['Index'] ?>";
  }
});
    
  } else {
    swal({
    title: "Data Not Deleted",
     icon: "error",
    
    });
  }
});' 
                    style = "text-decoration:none; color:rgb(219, 133, 99);" id = "dltbok"> Delete 
                </a> 
               </td>
            </tr>
            <?php } ?>
            </tbody>
            <tfoot>
                <td colspan="3" style = "text-align: center; color:#673ab7;">
                    <?= mysqli_num_rows($result2) ?> Books
                </td>
                <td colspan = "6"style = "text-align: center">
                    <a href = "Addbook.php"  style = "text-decoration:none; color:rgb(219, 133, 99);"> Add a book </a>
                </td>

            </tfoot>

        </table>
    
    
<hr>    
            <!-- boooooooooooooooooooooooooooooooooook listtttttttttttt     -->
    
    <h1> Users list </h1>
        <form method = "GET">
            <input type = "text" placeholder="Search by name or E-mail" name = "search">
            <input type  = "Submit" value = "Search">
        </form>
        <table class = "table">
            <thead>
                <th> ID </th>
                <th> Name</th>
                <th> Email </th>
                <th> Gender </th>
                <th> Admin </th>
                <th> Actions </th>
            </thead>
            <tbody>
            <?php
            while($row = mysqli_fetch_assoc($result))
            {
            ?>
            <tr>
                <td><?= $row['ID'] ?> </td>
                <td><?= $row['Name'] ?> </td>
                <td><?= $row['Email'] ?> </td>
                <td><?= $row['Gender'] ?> </td>
                <td><?= ($row['Admin']) ? 'Yes' : 'No' ?> </td>
                <td>  <a href = "edit.php?id=<?= $row['ID'] ?>"  style = "text-decoration:none; color:rgb(219, 133, 99);"> Edit </a> | 
                      <a href = '
                    javascript:
    swal({
  title: "Delete selected item?",
  text: "Unrecoverable Data",
  icon: "warning",
  buttons: true,
  dangerMode: "true",
})
.then((willDelete) => {
  if (willDelete) {
   swal({ title: "Delete Data Successfully",
 icon: "success"}).then(okay => {
   if (okay) {
    window.location.href = "Delete.php?id=<?= $row['ID'] ?>";
  }
});
    
  } else {
    swal({
    title: "Data Not Deleted",
     icon: "error",
    
    });
  }
});'   style = "text-decoration:none; color:rgb(219, 133, 99);"> Delete </a> 

                     </script>
               </td>
            </tr>
            <?php } ?>
            </tbody>
            <tfoot>
                <td colspan="2" style = "text-align: center;  color:#673ab7;">
                    <?= mysqli_num_rows($result) ?> Users
                </td>
                <td colspan = "4"style = "text-align: center">
                    <a href = "Add.php"  style = "text-decoration:none; color:rgb(219, 133, 99);"> Add a User </a>
                </td>

            </tfoot>

        </table>
        <input type = "Submit" value = "Home-page" onclick = "Gotohome()" id = "home">
        <script src = "listscript.js"> </script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


    </body>


</html>
<?php
mysqli_free_result($result);
mysqli_free_result($result2);
mysqli_close($conn);
?>
