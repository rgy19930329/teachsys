<?php ob_start(); ?>
<meta charset="utf-8" />

<?php include("ConnectDB.php") ?>

<?php include("FileUtils.php") ?>

<?php include("TreatUploadTaskTitle.php") ?>

<?php 
    $oldTask_dir = "oldTask";
	$newTask_dir = "newTask";
	deldir($oldTask_dir);    
 	deldir($newTask_dir);    
?>

<?php
    session_start();
    $tid = $_SESSION["tid"];
    $message = $_POST["message"];
    $sql = "UPDATE teacher_tb SET message='$message' WHERE tid='$tid'";
	mysql_query($sql);
	$sql = "UPDATE student_tb SET score=0";
	mysql_query($sql);
    
    echo "<script>alert('新任务已发布！');location.href='teacher.php';</script>";
    
?>