<?php
//اريج ياسر المغرب
//عندما نقوم بتسجيل الدخول الي الموقع هادي الصفحه التي تفتح ويطلع اسم المستخدم
session_start();

	 if(!isset($_SESSION['user'] )){
	 	header('location:log.php');
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Expense Tracker</title>
    <link rel="icon" href="../صور/images.png" type="image/jpg" >
    <meta name="keyword"conter="Expense Tracker,ET">
    <meta name="desciption"content="">
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
    <li> <a href="expense.php">expense</a></li>
    <li> <a href="transfer.php">Transfer</a></li>
    <li> <a href="review.php">review</a></li>
    </nav>

</ul> 
<button  class="button1" type="button"> <a href="logout.php">Log out</a></button>

</header>
    <main>
   <p style="text-align: right" >
   <div id="image_container">
<img src="../صور/photo_2023-06-09_03-58-26.jpg"alt=" photo expense tracker" class="image"> </div>
</div>
<p id="test33">
        <?php
		  	echo 'user name : ' . $_SESSION['user'];
   			?>
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
          <a href="#"><img src="../صور/areej-01.png" width="30px"/></a>
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