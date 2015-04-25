<?php ob_start(); ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>教师个人空间</title>

<script type="text/javascript" src="../static/js/jquery-1.8.2.min.js"></script>

<link rel="stylesheet" type="text/css" href="../static/css/base.css" />
<link rel="stylesheet" type="text/css" href="../static/css/teacher.css" />
<style type="text/css">


</style>
</head>
<body>
    
    <?php 
        session_start();
        $teaLoginFlag = null;
        if(isset($_SESSION["teaLoginFlag"])){
            $teaLoginFlag = $_SESSION["teaLoginFlag"];
        }
        
        if($teaLoginFlag != "success"){	
            echo "<script>alert('对不起，您还未登录或者当前页面已过期！');location.href='../index.html';</script>";
            exit();
        }
    ?>
    
    <?php 
		$tid = $_SESSION["tid"];
		$tname = $_SESSION["tname"];
	?>
	
	<div class="head">
		<a href="../index.html"><img class="icon home" src="../static/img/home.png"></a>
		<div class="head_inner">
			<p>
				<span>您好！<?php echo $tname ?>【教师】/ <?php echo $tid ?></span>
			</p>
		</div>
		<a href="teacherQuit.php"><img class="icon quit" src="../static/img/quit.png"></a>
	</div>

	<div id="giveTaskPanel">
		<p class="title">布置作业</p>
		<form action="TreatGiveTask.php" enctype="multipart/form-data" method="post" onsubmit="return check();">
			<textarea name="message" id="message"></textarea>
			<p><input type="file" name="file" id="file" class="file"></p>
			<p>
                <input type="submit" value="布置作业">
                <input type="button" value="取  消" id="cancel">
            </p>
		</form>
	</div>
    
    <?php include("ConnectDB.php") ?>
    
    <?php 
      	$sql = "SELECT sid,name,score FROM student_tb ORDER BY score DESC";
		$result = mysql_query($sql);  
    ?>    

	<div id="rankPanel">
		<p class="title">本次作业排名</p>
		<div class="content">
			<table>
				<tr>
					<th>学号</th>
					<th>姓名</th>
					<th>分数</th>
				</tr>
                
                <?php while($row = mysql_fetch_array($result)){ ?>
                    <tr>
                        <td><?php echo $row["sid"] ?></td>
                        <td><?php echo $row["name"] ?></td>
                        <td>
                            <?php 
                                if($row["score"] == 0){
                                	echo "未批改";
                                }else{
                                    echo $row["score"]."分";
                                }
                            ?>
                        </td>
                    </tr>
				<?php } ?>
                
			</table>
		</div>
		<p class="tc"><input type="button" value="关   闭" id="cancel2"></p>
	</div>

	<div id="uploadMaterialPanel">
		<p class="title">上传资料</p>
		<form action="TreatUploadMaterial.php" enctype="multipart/form-data" method="post" onsubmit="return check3();">
			<p><input type="file" name="file" id="materialfile" class="file"></p>
			<p>
                <input type="submit" name="submit" value="上传">
                <input type="button" value="取  消" id="cancel3">
            </p>
		</form>
	</div>

	<div class="main">
		<div class="main_left">
			<iframe src="task.php"></iframe>
		</div>
		<div class="main_middle">
			<p><a href="handleTask.php">批改作业</a></p>
			<p><a id="giveTask">布置作业</a></p>
			<p><a id="rank">查看作业状况</a></p>
			<p><a id="uploadMaterial">上传资料</a></p>
		</div>
		<div class="main_right">
			<iframe src="material.php"></iframe>
		</div>
		<div class="cb"></div>
	</div>

	<iframe class="foot" src="footer.html"></iframe>

<script type="text/javascript">

$("#giveTask").click(function(){
	$("#giveTaskPanel").show();
	var mydiv = $("#giveTaskPanel");
	mydiv.animate({"top": "300px"},1000);
	mydiv.animate({"top": "250px"},300);
});

$("#cancel").click(function(){
	$("#message").val("");
	$("#file").val("");
	var mydiv = $("#giveTaskPanel");
	mydiv.animate({"top": "300px"},300);
	mydiv.animate({"top": "-100px"},1000);
	setTimeout('$("#giveTaskPanel").hide()',1300);
});

///////////////////////////////////////////

$("#rank").click(function(){
	$("#rankPanel").show();
	var mydiv = $("#rankPanel");
	mydiv.animate({"top": "200px"},1000);
	mydiv.animate({"top": "150px"},300);
});

$("#cancel2").click(function(){
	var mydiv = $("#rankPanel");
	mydiv.animate({"top": "200px"},300);
	mydiv.animate({"top": "-300px"},1000);
	setTimeout('$("#rankPanel").hide()',1300);
});

///////////////////////////////////////////

$("#uploadMaterial").click(function(){
	$("#uploadMaterialPanel").show();
	var mydiv = $("#uploadMaterialPanel");
	mydiv.animate({"top": "300px"},1000);
	mydiv.animate({"top": "250px"},300);
});

$("#cancel3").click(function(){
	$("#materialfile").val("");
	var mydiv = $("#uploadMaterialPanel");
	mydiv.animate({"top": "300px"},300);
	mydiv.animate({"top": "-300px"},1000);
	setTimeout('$("#uploadMaterialPanel").hide()',1300);
});

</script>

</body>
</html>