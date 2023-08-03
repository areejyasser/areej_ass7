<!DOCTYPE html>
<html>
<head>
  <title>search</title>
</head>
<body>
  <h1> Search Results</h1>
  <?php

try{

    if(isset($_POST['search']))
    {
       // create short variable names
    $searchtype=$_POST['searchtype'];

    if (!$searchtype) {
       echo '<p>You have not entered search details.<br/>
       Please go back and try again.</p>';
       exit;
    }
   
    
    require_once 'dbcon.php';
    $connection = new mysqli($hn, $un, $pw, $db);

    if ($connection->connect_error) {
       echo '<p>Error: Could not connect to database.<br/>
       Please try again later.<br/></p>';
       echo $connection -> error;
       exit;
    }

    $query = "SELECT  price, data_exp, payment FROM expense WHERE data_exp Like  '%$searchtype%'  ";
    $result = $connection->query($query);
    if (!$result) 
    {
        echo "<p>Unable to execute the query.</p> ";
        die ($connection -> error);
    }

    echo "<p>Number of expenses found: ".$result->num_rows."</p>";
    $rows = $result->num_rows;
    for ($j = 0 ; $j < $rows ; ++$j)
    {
        $row = $result->fetch_array(MYSQLI_ASSOC);
        echo " <p>price: ". number_format($row['price'],2) ." LYD </p>";
        echo "<p>date: " .  $row['data_exp'] . "</p>";
        echo "<p> payment: ".$row['payment']." </p>: " ;
   
    }

    $connection->close();
  }
}
    catch (mysqli_sql_exception $exception) {
      echo 'Transaction Failed!!';
  
      if($mysqli!=null)
          $mysqli -> close();
          $mysqli=null;
          echo'<br>';
          echo $exception->getMessage();
  }
  ?>
</body>
</html>
