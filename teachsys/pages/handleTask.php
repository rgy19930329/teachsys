<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>批改作业</title>

<script type="text/javascript" src="../static/js/jquery-1.8.2.min.js"></script>

<link rel="stylesheet" type="text/css" href="../static/css/base.css">
    <link rel="stylesheet" type="text/css" href="../static/css/common.css">
<link rel="stylesheet" type="text/css" href="../static/css/handleTask.css">
<style type="text/css">


</style>
</head>
<body>
	
	<div class="head">
		<a href="teacher.php"><img class="icon goback" src="../static/img/prev.png"></a>
		<div class="head_inner">
			<p>
				<span>作业批改</span>
			</p>
		</div>
		<a href="userQuit.php"><img class="icon quit" src="../static/img/quit.png"></a>
	</div>

	<div id="uploadPanel">
		<p class="title">上传批改</p>
		<form action="TreatCorrectTask.php" enctype="multipart/form-data" method="post" onsubmit="return check();">
            
            <p>请为<em class="name">张三</em>打分</p>
           	<p><input type="text" name="score" id="score" placeholder="打分"></p>
            <p><input type="hidden" name="sid" id="sid"></p>
            <p><input type="hidden" name="sname" id="sname"></p>
            <hr />
            
            <p><input type="file" name="file" id="file" class="file"></p>
			<p>
                <input type="submit" value="上   传">
                <input type="button" value="取   消" id="cancel">
            </p>
		</form>
	</div>
    
    <?php include("ConnectDB.php") ?>

	<div class="main">
		<div class="middle">
            <?php
                $storage = new SaeStorage();
                $domain = 'mydir';
                $path = 'newTask';
                $num = 0;
                $ret = $storage->getListByPath($domain, $path, 1000, $num );
                
                $fileNum = $ret[fileNum];
                $files = $ret[files];?>
            
			<h1>“作业批改”/ 一共收到<span><?php echo $fileNum ?></span>份作业</h1>
			<ul>
                
                <?php 
                    foreach($files as $file){
                        $filename = $file[Name];
                        $filefull = $file[fullName];
                        $url = $storage->getUrl($domain,$filefull);?>
               	
                <?php
                    $sid = (int)substr($filename,0,8);
                    $sql = "SELECT score FROM student_tb WHERE sid='$sid'";
					$result = mysql_query($sql);
                    $row = mysql_fetch_array($result);
                    $score = $row["score"];
                ?>
                
				<li>
					<div class="top_div">
                        <?php
                            if($score != 0){
                                echo "<b>$score</b>";
                            }
                    	?>
						<img src="../static/img/word.png" />
					</div>
					<div class="bottom_div">
                        <p><a class="taskname" href=<?php echo $url ?> ><?php echo $filename ?></a></p>
						<p><a class="upload">上传批改</a></p>
					</div>
				</li>
                
               <?php }?>
                

				<div class="cb"></div>
			</ul>
		</div>
	</div>

	<iframe class="foot" src="footer.html"></iframe>

<script type="text/javascript">

$(".upload").click(function(){
	$("#uploadPanel").show();
    var taskname = $(this).parent().prev("p").children("a").html();
    var sid = taskname.match(/\d{8}/);
    var sname = taskname.match(/[\u4e00-\u9fa5]{1,4}/);
    $(".name").html(sname);
    
    $("#sid").val(sid);
    $("#sname").val(sname);
    
	var mydiv = $("#uploadPanel");
	mydiv.animate({"top": "300px"},1000);
	mydiv.animate({"top": "250px"},300);
});

$("#cancel").click(function(){
    $("#score").val("");
	$("#file").val("");
	var mydiv = $("#uploadPanel");
	mydiv.animate({"top": "300px"},300);
	mydiv.animate({"top": "-100px"},1000);
	setTimeout('$("#uploadPanel").hide()',1300);
});
    

</script>

</body>
</html>