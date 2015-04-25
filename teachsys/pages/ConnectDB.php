<?php 

$host = "w.rdc.sae.sina.com.cn:3307";
$name = "ylj05kx3mj";
$password = "4lh0li2jy3lx3w1ly1zijj50254ji5l03052h03x";
$dbname = "app_teachsys";

$conn = mysql_connect($host, $name, $password);
if (!$conn){
  	die("Connect Fail");
}

mysql_select_db($dbname, $conn);

?>

