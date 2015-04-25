<?php ob_start(); ?>
<meta charset="utf-8"> 

<?php 
	session_start();
	unset($_SESSION["stuLoginFlag"]);
	echo "<script>alert('已经退出登录');location.href='../index.html';</script>";
?>