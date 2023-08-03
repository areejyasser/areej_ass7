<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="../صور/images.png" type="image/jpg" >
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div >
<img src="../صور/images.png"alt=" photo expense t "width="40px">
 </div>
 <div class="pp">
 <p>ET</p>
 </div>
 <ul>
    <nav>
    <li>  <a href="index1.php">Home</a></li>
    <li>  <a href="#">About us</a></li>
    <li> <a href="add.php">Add category </a></li>
    <li> <a href="expense.php">expense</a></li>
    </nav>

</ul> 
<button  class="button1" type="button"> <a href="logout.php">Log out</a></button>

<?php

session_start();

	if(!isset($_SESSION['user'] )){
		header('location:log.php');}

  require "dbcon.php";
  $conn = new mysqli($hn, $un, $pw, $db);
   if ($conn->connect_error)
    {
    die("Fatal Error");
    }
    $id = $_SESSION['id'];
// Select all the data from the table
$sql = "SELECT * FROM expense WHERE user_id = $id " ;
$result = mysqli_query($conn, $sql);

//Fetch each row of data from the result set
echo"<table>";
while ($row = mysqli_fetch_assoc($result)) {

    // Output the data in a table
    echo "<tr>";
    foreach ($row as $key => $value)
     {
        if($value ===  $_SESSION['category'] )
        {
            $n = $_SESSION['name'];
            echo "<td >$n </td>";  
        }
        else
        {
            echo "<td >$value</td>";  
        }
        
    }
    echo '<td ""><a href="edit_expense.php?id='.$row['expense_id'].'">Edit</a></td>';
    echo '<td><a href="delete_expense.php?id='.$row['expense_id'].'">Delete</a></td>';
    echo "</tr><br>";

}
echo"</table>";
//Close the connection
mysqli_close($conn);
?>
</body>
<p id="test33">
        <?php
		  	echo 'user name : ' . $_SESSION['user'];
   			?>
</html>