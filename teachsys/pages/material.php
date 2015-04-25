<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>作业</title>
<link rel="stylesheet" type="text/css" href="../static/css/base.css">
<style type="text/css">


.head .title {
	background: #ddd;
	font: 25px/200% "Microsoft YaHei";
	padding-left: 15px;
}

.head .content {
	height: 420px;
	overflow-y: scroll;
	font: 16px/150% "Microsoft YaHei";
	padding: 10px;
}

.content a {
	text-decoration: none;
	display: block;
	font: 16px/150% "Microsoft YaHei";
	margin: 10px auto;
	padding: 5px;
	background: #ddd;
	color: #000;
	border-radius: 10px;
	transition: all 200ms ease;
}

.content a:hover {
	background: #ccc;
}

</style>
</head>
<body>
	
	<div class="head">
		<p class="title">所有资料</p>
		<div class="content">
			<ul>
                
                <?php
                    $storage = new SaeStorage();
                    $domain = 'mydir';
                    $path = 'material';
                    $num = 0;
                    $ret = $storage->getListByPath($domain, $path, 1000, $num );
                    
                    $fileNum = $ret[fileNum];
                    echo "<p>资料库共有 $fileNum 个文件：</p>";
                    
                    $files = $ret[files];?>
                    
               <?php 
                    foreach($files as $file){
                        $filename = $file[Name];
                        $filefull = $file[fullName];
                        $url = $storage->getUrl($domain,$filefull);
                		echo "<li><a href='$url'>$filename</a></li>";
               }?>
                
			</ul>
		</div>
	</div>

</body>
</html>