<?php
session_start();
if(!isset($_SESSION['user'])) {
    header('location:log.php');
}

try {
    require "dbcon.php";
    $mysqli = new mysqli($hn, $un, $pw, $db);
    $mysqli->begin_transaction();

    if ($mysqli->connect_error) {
        die("Fatal Error");
    }

    if(isset($_POST['add'])) {
        $from = $_POST['from'];
        $to = $_POST['to'];
        $date = $_POST['date'];
        $note = $_POST['note'];
        $amount_transfer = $_POST['Amount_tranfer'];
        $id = $_SESSION['id'];

        $sql = "SELECT * FROM category WHERE category_name = '$from'";
        $result_from = $mysqli->query($sql);
        $sql = "SELECT * FROM category WHERE category_name = '$to'";
        $result_to = $mysqli->query($sql);

        if ($result_from->num_rows > 0 && $result_to->num_rows > 0) {
            $from_category = mysqli_fetch_assoc($result_from);
            $to_category = mysqli_fetch_assoc($result_to);

    if ($from_category['category_name'] === $from && $to_category['category_name'] === $to) {
                $amount_from = $from_category['Amount'];
                $amount_to = $to_category['Amount'];
                $from_category_id = $from_category['category_id'];
                $to_category_id = $to_category['category_id'];
            }
        }
        if ($amount_transfer > 0 && $amount_transfer <= $amount_from) {
            $new_amount_from = $amount_from - $amount_transfer;
            $new_amount_to = $amount_to + $amount_transfer;
            $sql = "UPDATE category SET amount = $new_amount_from WHERE category_id = $from_category_id";
            $stmt = $mysqli->query($sql);
            $sql = "UPDATE category SET amount = $new_amount_to WHERE category_id = $to_category_id";
            $stmt = $mysqli->query($sql);
            $sql = "INSERT INTO transfer (category_from,category_to,date,comment,price,user_id)
             VALUES ('$from', '$to', '$date',' $note','$amount_transfer','$id')";
            $stmt = $mysqli->query($sql);

            $mysqli->commit();
        } else {
            echo "Invalid amount or category";
        }

        $mysqli->close();
    }
} catch (mysqli_sql_exception $exception) {
    echo 'Transaction Failed!!';
    $mysqli->rollback();

    if($mysqli!=null) {
        $mysqli->close();
    }

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
    <li> <a href="transfer.php">Transfer </a></li>
    <li> <a href="review.php">review</a></li>
    </nav>
    <button  class="button1" type="button"> <a href="logout.php">Log out</a></button>
</ul> 
      
    </header>
    <main>
       <form action="transfer.php" method="post">
            <h1 class="color">Add transfer</h1>
                <input type="text" placeholder="from Category" name="from"><br>
                <input type="text" placeholder="to category" name="to"><br>
                <input type="date" placeholder="date" name="date"><br>
                <input type="text" placeholder="note" name="note"><br>
                <input type="text" placeholder="Amount" name="Amount_tranfer"><br>
        <input type="submit"value="Add" name="add"><br>  
    </main>
     <p id="test33">
        <?php
		  	//echo 'user name : ' . $_SESSION['user'];
   			?> 
    <footer>
      <!-- Footer -->
 <section id="footer">
   <div class="brand">
     <h1><span>E</span>xpense<span>T</span>racker</h1>
     <p class="copt">Expense Tracker © 2023</p>  
     <p>218-0000000</p>
 </footer>
</body>
</html>