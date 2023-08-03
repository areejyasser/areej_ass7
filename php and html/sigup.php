 <?php
  //اريج ياسر المغربي 
 //صفحه تسجيل الدخول اضافه مستخدم  الي قاعده البيانات
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
require_once'dbcon.php';
if(isset($_POST['Sign'])){

	$Name = $_POST['name'];
    $Email = $_POST['Email'];
    $Password = $_POST['password'];
   $Copassword = $_POST['copassword'];
	if($Password != $Copassword )
	{	echo "<p>the password and confirm password aren't the same, try again</p>";}
   $name=strlen($Name);
if($name<10 || $name>15)
{echo "<p>(Incorrect user name) The user name  must contain at least 10-15 character</p>";}
   $pass=strlen($Password);
if($pass<10 || $pass>14)
{echo "<p>(Incorrect pasword) The pasword must contain at least 10-14 characters</p>";}

	else
	{
		$conn = new mysqli($hn, $un, $pw, $db);
		if ($conn->connect_error)
		{die("Fatal Error");}
		else
		{	
      $sql = "SELECT * FROM user WHERE email = '$Email'";
      $result = $conn->query($sql);
      if($result->num_rows > 0 )
      {
        echo "<p>the Email already exist, try to use another one</p>.";
        $conn -> close();
        }
      else
      {

      
			$query = "INSERT INTO user (user_name, password, email) VALUES('$Name',$Password,'$Email')" ;

			$result = $conn->query($query);

			if (!$result)
			{
			echo "<p>Unable to execute the query.</p> ". $conn -> error;
			}
			else {
				echo "<p>Successfully added .</p>";
			}	
			$conn->commit();
			$conn -> close();
			echo '<p>new user added</p>';
    }
			}
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
<button  class="button1" type="button"> <a href="log.php">Log in</a></button>

    </header>
   <main>
 
     <form action="sigup.php" method="post" class="sig">
        <div class="form-wrap">
                <h1>SIGN <span>UP</span></h1>
               <h6>Welcome to Expense Tracker</h6>
               <input type="text" placeholder="Enter Name" required name=" name" ><br>

               <input type="email" placeholder="Enter Email" required name="Email"><br>
                <input type="password" placeholder="Enter password"required  name="password"><br>
                <input type="password" placeholder="Confirm Password"required name="copassword"><br>
                <input type="checkbox" name="accepts_tos" value="yes" required > I agree to the
                <a href="#">terms of service</a><br><br>
                <input type="submit"value="Sign UP" name="Sign"><br>
        </div>
        </div>
        <span class="sign-up-with">Or sign up with</span>
        <div class="social-logo">
            <a href="#" title="Facebook">
                <img src="../صور/facebook.jpg" alt="Facebook">
            </a>
            <a href="#" title="Google">
                <img src="../صور/google.jpg" alt="Google">
            </a>
            <a href="#" title="Twitter">
                <img src="../صور/twitter.jpg" alt="Twitter">
            </a>
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

        <div class="social-fa2">
          <a href="#"><img src="../صور/areej-01.png" width="30px"/></a>
        </div>
        <div class="social-tw2">
          <a href="#"><img src="../صور/areej-02.png" width="30px"/></a>
        </div>
        <div class="social-gn2">
          <a href="#"><img src="../صور/areej-03.png" width="30px"/></a>
        </div>
    </footer>
    
</footer>