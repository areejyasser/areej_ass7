<?php
//اريج ياسر المغري
// idتقول الصفحه بتعديل اسم الفئه عن طريق ادخال ال 
session_start();

	if(!isset($_SESSION['user'] )){
		header('location:log.php');
	}
  require "dbcon.php";
  $conn = new mysqli($hn, $un, $pw, $db);
   if ($conn->connect_error)
    {
    die("Fatal Error");
    }
    if(isset($_POST['update']))
    {
      $name = $_POST['category_name'];
      $number = $_POST['category_number'];
      
      $sql = "UPDATE Category SET category_name='$name' WHERE category_id='$number'";
      if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
      } else {
        echo "Error updating record: " . $conn->error;
      }
      
      $conn->close();
      }
?>
<!-- 'UPDATE catagory SET catagory_name = $name WHERE catagory_id = $id;  -->


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
    <nav>
    <li>  <a href="index1.php">Home</a></li>
    <li>  <a href="#">About us</a></li>
    <li> <a href="add.php">Add category </a></li>
    <li> <a href="#">Reports</a></li>
    </nav>

</ul> 
        <!-- log out button -->
        <button  class="button1" type="button"> <a href="logout.php">Log out</a></button>
    </header>
    <main>
    <p id="test33">
        <?php
         echo 'user name : ' . $_SESSION['user'];
          ?>
       </p> 
       <form action="edit.php" method="post" class="box">
        <div class="form-wrap">
            <h1>Edit category</h1>
        <input type="text" placeholder="category name"  name="category_name">
        <input type="text" placeholder="category_number"  name="category_number">
        <input type="submit"value="update" name="update"><br>


    </main>
    <footer>
      <!-- Footer -->
 <section id="footer">
   <div class="brand">
     <h1><span>E</span>xpense<span>T</span>racker</h1>
     <p class="copt">Expense Tracker © 2023</p>  
     <p>218-0000000</p>

   </div>

     <div class="social-fa">
       <a href="#"><img src="../صور/areej-01.png"width="30"></a>
     </div>
     <div class="social-tw">
       <a href="#"><img src="../صور/areej-02.png" width="30px"/></a>
     </div>
     <div class="social-gn">
       <a href="#"><img src="../صور/areej-03.png" width="30px"/></a>
     </div>
 </footer>
 
</body>
</html>