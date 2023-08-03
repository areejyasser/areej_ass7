<?php
//اريج ياسر المغربي
//صفحه دخول الي الموقع تقوم الصفحه ب البحث عن اسم المستخدم في الداتا بيز ولو كان موجود تتم دخول الي الموقع
session_start();
require "dbcon.php";
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error)
{
die("Fatal Error");
}
if(isset($_POST['login']))
{
  $Name = $_POST['name'];
  $password = $_POST['password'];
   $sql = "SELECT * FROM user WHERE user_name = '$Name' AND password = '$password'";
	$result = $conn->query($sql);
	if($result->num_rows > 0 )
	{
		$k = mysqli_fetch_assoc($result);
		if($k['user_name']===$Name && $k['password']===$password)
		{
			$_SESSION['user'] = $k['user_name'];
      $_SESSION['id'] = $k['user_id'];
			header('Location: index1.php');
		}
	}
	else{
		echo "there is a problem with log in, please try again.";
	}
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
<button  class="button1" type="button"> <a href="sigup.php">sign up</a></button>
        </div>
    </header>
    <main>
       <form action="log.php" method="post" class="box">
        <div class="form-wrap">
            <h1>Log <span>In</span></h1>
        <input type="text" placeholder="Enter Name" required name="name"><br>
        <input type="password" placeholder="Enter password"required name="password"><br>
        <input type="checkbox">Remembeme <br>
        <input type="submit"value="login" name="login"><br>
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

<?php 
/*

$var_password = $_POST['password'];
$var_userName =$_POST['name'];
$password = array("Admin_2023","Cs314_2023","System_admin1");
$users    = array("admin_2023","cs314_2023","system_admin");

if(empty($var_userName) || empty($var_password)) echo "User OR Password is Empty ";
else if(strlen($var_password) <= 8) echo "Password is Short "; 
else 
{
 $ok = false;
 for($i = 0 ; $i<3 ; $i++)
 {
  if(checkUser($var_userName , $users[$i]) && checkPassword($var_password , $password[$i]))
  {
    echo "Done Login User ",$var_userName;
    $ok = true;
    header("Location:index.html");
    break;
  }
 }
 if(!$ok) echo "No Done Login ";
}

function checkUser($user , $userArray)
{
  return $user === $userArray ;
}

function checkPassword($password , $passwordArray)
{
   return $password === $passwordArray; 
}
?>*/
