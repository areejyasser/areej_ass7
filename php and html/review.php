<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
session_start();

if (!isset($_SESSION['user'])) {
    header('location:log.php');
}

try {
    require "dbcon.php";
    $mysqli = new mysqli($hn, $un, $pw, $db);
    if ($mysqli->connect_error) {
        die("Fatal Error");
    }

    if (isset($_POST['review'])) {
        $note = $_POST['note'];
        $number = $_POST['number'];
        $id = $_SESSION['id'];

        // Check if the user has already submitted a review
        $checkQuery = "SELECT * FROM review WHERE user_id = '$id'";
        $checkResult = $mysqli->query($checkQuery);

        if ($checkResult->num_rows > 0) {
            echo "You have already submitted a review. You can only submit one review.";
        } else {
            $sql = "INSERT INTO review (user_id, number, comment) VALUES ('$id', '$number', '$note')";
            $stmt = $mysqli->query($sql);

            if ($stmt === TRUE) {
                echo "Record added successfully";
            } else {
                echo "Error adding record: " . $mysqli->error;
            }
        }
        $mysqli->close();
    }
} catch (mysqli_sql_exception $exception) {
    echo 'Transaction Failed!!';

    $mysqli->rollback();
    if ($mysqli != null)
        $mysqli->close();
    $mysqli = null;
    echo '<br>';
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
</ul> 
<button  class="button1" type="button"> <a href="logout.php">Log out</a></button>

        </div>
    </header>
    <main>
       <form action="review.php" method="post" class="box">
        <div class="form-wrap">
            <h1>Rev <span>iew</span></h1>
        <input type="text" placeholder="note" required name="note"><br>
        <label>number</label>
     <input type="number"required name="number" min="0" max="5" step="1" name="number">
        <input type="submit"value="review" name="review"><br>
        </div>
       </form>
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
