<meta charset="utf-8" />

<?php

$domain = "mydir";
$upload_dir = "saestor://" . $domain . "/taskTitle/";

$taskTitle_dir = "taskTitle";
deldir($taskTitle_dir);


if (empty($_FILES['file']['tmp_name'])){
    return;
}

//类型为application/octet-stream（zip压缩文件），大小<50M
if (($_FILES["file"]["type"] == "application/octet-stream")&&($_FILES["file"]["size"] < 50000000)){

	if ($_FILES["file"]["error"] > 0){
      	echo "Error: " . $_FILES["file"]["error"] . "<br />";
    }else{
        
     	if(move_uploaded_file($_FILES["file"]["tmp_name"],$upload_dir . $_FILES["file"]['name'])){
            $fileInfo = $_FILES["file"]["name"]."/".($_FILES["file"]["size"] / 1024) . " Kb";
            echo "<script>alert('附件上传成功！[$fileInfo]');</script>";
        }   
    }
    
}else{
	echo "<script>alert('上传失败，请确保为zip压缩文件类型，且大小不超过50M！');location.href='teacher.php';</script>";
}

 
?>