<?php ob_start(); ?>
<meta charset="utf-8">

<?php include("ConnectDB.php") ?>

<?php 

	$loginID = $_POST["loginID"];
	$password = $_POST["password"];
	$role = $_POST["role"];
	if(!isset($loginID)||!isset($password)||!isset($role)){
		echo "<script>location.href='../index.html';</script>";
		exit();
	}

	//

	if($role == "student"){
		$sql = "SELECT name,password,score FROM student_tb WHERE sid='$loginID'";
		$res = mysql_query($sql);

		if(!mysql_affected_rows()){
			echo "<script>alert('登录失败！请检查学号和密码是否正确');location.href='../index.html';</script>";
			exit();
		}

		$row = mysql_fetch_array($res);
        $name = $row["name"];
		$passw = $row["password"];
        $score = $row["score"];

		if($password == $passw){
			session_start();
			$_SESSION["stuLoginFlag"] = "success";
			$_SESSION["sid"] = $loginID;
            $_SESSION["sname"] = $name;
            $_SESSION["score"] = $score;
			$url = "student.php";
			header("Location: $url"); 
		}else{
            echo "<script>alert('登录失败！请检查学号和密码是否正确');location.href='../index.html';</script>";
		}
	}else if($role == "teacher"){
		$sql = "SELECT name,password FROM teacher_tb WHERE tid='$loginID'";
		$res = mysql_query($sql);

		if(!mysql_affected_rows()){
			echo "<script>alert('登录失败！请检查工号和密码是否正确');location.href='../index.html';</script>";
			exit();
		}

		$row = mysql_fetch_array($res);
        $name = $row["name"];
		$passw = $row["password"];

		if($password == $passw){
			session_start();
			$_SESSION["teaLoginFlag"] = "success";
			$_SESSION["tid"] = $loginID;
            $_SESSION["tname"] = $name;
			$url = "teacher.php";
			header("Location: $url"); 
		}else{
	        echo "<script>alert('登录失败！请检查工号和密码是否正确');location.href='../index.html';</script>";
		}
	}


	
?>

<?php mysql_close($conn); ?>






