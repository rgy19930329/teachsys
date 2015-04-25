<?php ob_start(); ?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>作业</title>
<link rel="stylesheet" type="text/css" href="../static/css/base.css">
<style type="text/css">


.head .title {
  position: fixed;
  top: 0;
  width: 100%;
  background: #ddd;
  font: 25px/200% "Microsoft YaHei";
  padding-left: 15px;
}

.head .content {
  height: 250px;
  margin-top: 55px;
  overflow-y: scroll;
  font: 16px/150% "Microsoft YaHei";
  padding: 10px;
}

.foot {
  position: fixed;
  bottom: 0;
  width: 100%;
  background: #ddd;
  font: 16px/200% "Microsoft YaHei";
  text-align: center;
}

</style>
</head>
<body>
    
    <?php include("ConnectDB.php") ?>
    
    <?php 
    	session_start();
//$tid = $_SESSION["tid"];
      	$sql = "SELECT message FROM teacher_tb WHERE tid=10001234";
		$result = mysql_query($sql);  
		$row = mysql_fetch_array($result);
		$message = $row["message"];
        if($message == ""){
            $message = "目前暂无作业";
        }
    ?> 
	
	<div class="head">
		<p class="title">作业公告</p>
		<p class="content"><?php echo $message ?></p>
	</div>
    
    <?php
        $storage = new SaeStorage();
        $domain = 'mydir';
        $path = 'taskTitle';
        $num = 0;
        $ret = $storage->getListByPath($domain, $path, 1000, $num );
        
        $fileNum = $ret[fileNum];
        
        $files = $ret[files];?>

	<div class="foot">
		<ul>
            <?php 
                foreach($files as $file){
                    $filename = $file[Name];
                    $filefull = $file[fullName];
                    $url = $storage->getUrl($domain,$filefull);
                    echo "<li><a href='$url'>附件：$filename</a></li>";
            } ?>
		</ul>
	</div>

</body>
</html>