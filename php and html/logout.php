<?php
//اريج ياسر المغربي
//  login  تسجيل الخروج  من الموقع وتقوم ب البعث الي صفحه 
session_start();
unset($_SESSION["user"]);
header("Location:log.php");
?>