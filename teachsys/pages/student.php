<?php ob_start(); ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>学生个人空间</title>

<script type="text/javascript" src="../static/js/jquery-1.8.2.min.js"></script>

<link rel="stylesheet" type="text/css" href="../static/css/base.css" />
<link rel="stylesheet" type="text/css" href="../static/css/student.css" />

<style type="text/css">


</style>
</head>
<body>
    
    <?php 
        session_start();
        $stuLoginFlag = null;
        if(isset($_SESSION["stuLoginFlag"])){
            $stuLoginFlag = $_SESSION["stuLoginFlag"];
        }
        
        if($stuLoginFlag != "success"){	
            echo "<script>alert('对不起，您还未登录或者当前页面已过期！');location.href='../index.html';</script>";
            exit();
        }
    ?>
    
    <?php 
		$sid = $_SESSION["sid"];
		$sname = $_SESSION["sname"];
		$score = $_SESSION["score"];
        if($score == 0){
            $score = "暂无";
        }

	?>
	
	<div class="head">
		<a href="../index.html"><img class="icon home" src="../static/img/home.png"></a>
		<div class="head_inner">
			<p>
                <span>您好！<?php echo $sname ?>【学生】/ <?php echo $sid ?>/分数：<?php echo $score ?></span>
			</p>
		</div>
		<a href="studentQuit.php"><img class="icon quit" src="../static/img/quit.png"></a>
	</div>

	<div id="handInPanel">
		<p class="title">交作业</p>
		<form action="TreatHandInTask.php" enctype="multipart/form-data" method="post" onsubmit="return check();">
			<p><input type="file" name="file" id="file" class="file"></p>
			<p><input type="submit" value="上   传"><input type="button" value="取  消" id="cancel"></p>
		</form>
	</div>
    
    <?php include("ConnectDB.php") ?>
    
    <?php 
      	$sql = "SELECT sid,name,score FROM student_tb";
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
                                	echo "暂无";
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

	<div class="main">
		<div class="main_left">
			<iframe src="task.php"></iframe>
		</div>
		<div class="main_middle">
			<p><a id="rank">查看排名和分数</a></p>
			<p><a id="handIn">交作业</a></p>
            <p><a id="bbs" href="">论坛bbs入口</a></p>
			<p><a id="exam" href="">在线考试系统入口</a></p>
		</div>
		<div class="main_right">
			<iframe src="material.php"></iframe>
		</div>
		<div class="cb"></div>
	</div>

	<iframe class="foot" src="footer.html"></iframe>
    
    

<script type="text/javascript">
     

$("#handIn").click(function(){
	$("#handInPanel").show();
	var mydiv = $("#handInPanel");
	mydiv.animate({"top": "300px"},1000);
	mydiv.animate({"top": "250px"},300);
});

$("#cancel").click(function(){
	$("#file").val("");
	var mydiv = $("#handInPanel");
	mydiv.animate({"top": "300px"},300);
	mydiv.animate({"top": "-100px"},1000);
	setTimeout('$("#handInPanel").hide()',1300);
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
    
function check(){
    
    var taskName = $("#file").val();
    var reg = /\d{8}[\u4e00-\u9fa5]{1,4}/;
    var result = reg.test(taskName);

    if(!result){
    	alert("文件名不规范，请重新命名！例：20123664张三");
     	return false;
    }

    return true;
}   
    

</script>	

</body>
</html>