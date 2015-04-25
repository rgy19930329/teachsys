<?php

$domain = "mydir";
$upload_dir = "saestor://" . $domain . "/oldTask/";//已经批改过了

if (empty($_FILES['file']['tmp_name'])){
    return;
}

//application/msword类型  大小<10M
if (($_FILES["file"]["type"] == "application/msword")&&($_FILES["file"]["size"] < 10000000)){

	if ($_FILES["file"]["error"] > 0){
      	echo "Error: " . $_FILES["file"]["error"] . "<br />";
    }else{
        
     	if(move_uploaded_file($_FILES["file"]["tmp_name"],$upload_dir . $_FILES["file"]['name'])){
            $fileInfo = $_FILES["file"]["name"]."/".($_FILES["file"]["size"] / 1024) . " Kb";
            echo "<script>alert('批改作业上传成功！[$fileInfo]');</script>";
        }   
    }
    
}else{
	echo "<script>alert('上传失败，请保证文件类型为.doc,大小不超过10M！');location.href='handleTask.php';</script>";
}

?>