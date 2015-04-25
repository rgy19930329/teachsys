<meta charset="utf-8" />

<?php
 
$domain = "mydir";
$upload_dir = "saestor://" . $domain . "/material/";

 
//大小<5M
if (($_FILES["file"]["size"] < 5000000)){

	if ($_FILES["file"]["error"] > 0){
      	echo "Error: " . $_FILES["file"]["error"] . "<br />";
    }else{
      	echo "Upload: " . $_FILES["file"]["name"] . "<br />";
      	echo "Type: " . $_FILES["file"]["type"] . "<br />";
      	echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
    }
    
    if(move_uploaded_file($_FILES["file"]["tmp_name"],$upload_dir . $_FILES["file"]['name'])){
       	echo 'ok';
    }

    
}else{
	echo "<script>alert('上传失败，大小不超过5M！');location.href='../teacher.php';</script>";
}

 
?>