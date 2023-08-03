<?php

session_start();

	if(!isset($_SESSION['user'] )){
		header('location:log.php');}
try{
  require "dbcon.php";
  $mysqli = new mysqli($hn, $un, $pw, $db);
  $mysqli->begin_transaction();
   if ($mysqli->connect_error)
    {
    die("Fatal Error");
    }
    if(isset($_POST['add']))
    {

      $note = $_POST['note'];
      $date = $_POST['date'];
      $Amount_expense = $_POST['Amount_expense'];
      $payment = $_POST['payment'];
      $category_name = $_POST['category_name'];
      $id = $_SESSION['id'];

      $sql = "SELECT * FROM category WHERE category_name = '$category_name'";
      $result = $mysqli->query($sql);
      if ($result->num_rows > 0) {
        $k = mysqli_fetch_assoc($result);
        if ($k['category_name'] === $category_name) 
        {
           $_SESSION['name'] = $k['category_name'];
          $_SESSION['category'] = $k['category_id'];
             $_SESSION['Amount']=$k['Amount'];
        }
      }
        if ($category_name ===  $_SESSION['name'] )
        {
          if ($Amount_expense <= $_SESSION['Amount']) 
          {
            $category_id = $_SESSION['category'];
            $sql = "INSERT INTO expense (user_id, price, payment, data_exp, category_id) VALUES ('$id', '$Amount_expense', '$payment', '$date', '$category_id')";
            $stmt = $mysqli->query($sql);
               header('location: show.php');
            $sql ="UPDATE category SET Amount=Amount-$Amount_expense WHERE category_id=$category_id";
            $stmt = $mysqli->query($sql);
            $mysqli->commit();
          }
        }
       else {
        echo "Category not found or amount is not enough";
       }
      $mysqli->close();
    }
  }
  catch (mysqli_sql_exception $exception) {
    echo 'Transaction Failed!!';

    $mysqli->rollback();
    if($mysqli!=null)
        $mysqli -> close();
    $mysqli=null;
    echo'<br>';
    echo $exception->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="../صور/images.png" type="image/jpg" >
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <div >
            <img src="../صور/images.png"alt=" photo expense t "width="40px">
        </div>
        <div class="pp">
        <p>ET</p>
        </div>
 <ul>
 <button  class="button1" type="button"> <a href="logout.php">Log out</a></button>

    <nav>
    <li>  <a href="index1.php">Home</a></li>
    <li>  <a href="#">About us</a></li>
    <li> <a href="add.php">Add category </a></li>
    </nav>
    <button  class="button1" type="button"> <a href="logout.php">Log out</a></button>
</ul> 
      
    </header>
    <main>
    <form action="search.php" method="post">
        <input type="date" placeholder="search" name="searchtype">
        <input type="submit"value="search" name="search">
    </form>
       <form action="expense.php" method="post" class="sig">
        <div class="form-wrap">
            <h1>Add expense</h1>
                <input type="date" placeholder="date" name="date">
                <input type="text" placeholder="note" name="note">
                <input type="text" placeholder="Amount" name="Amount_expense">
                <input type="text" placeholder="payment" name="payment">
                <input type="text" placeholder="Category name" name="category_name">
        <input type="submit"value="Add New category" name="add">
    </main>
    <p id="test33">
        <?php
		  	echo 'user name : ' . $_SESSION['user'];
   			?>
    <footer>
      <!-- Footer -->
 <section id="footer">
   <div class="brand">
     <h1><span>E</span>xpense<span>T</span>racker</h1>
     <p class="copt">Expense Tracker © 2023</p>  
     <p>218-0000000</p>

   </div>

     <div class="social-fa3">
       <a href="#"><img src="../صور/areej-01.png"width="30"></a>
     </div>
     <div class="social-tw3">
       <a href="#"><img src="../صور/areej-02.png" width="30px"/></a>
     </div>
     <div class="social-gn3">
       <a href="#"><img src="../صور/areej-03.png" width="30px"/></a>
     </div>
 </footer>
 
</body>
</html>