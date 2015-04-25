
<meta charset="utf-8" />

<?php include("ConnectDB.php") ?>

<?php include("TreatUploadCorrectTask.php") ?>

<?php
	    
    
?>

<?php
	
    $sid = $_POST["sid"];
	$sname = $_POST["sname"];
    $score = $_POST["score"];
    $sql = "UPDATE student_tb SET score='$score' WHERE sid='$sid'";
	mysql_query($sql);
	
    $tip = "打分完成，".$sname."的作业已批改！";
    echo "<script>alert('$tip');location.href='handleTask.php';</script>";
    
?>

