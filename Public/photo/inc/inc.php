<?php
$con=mysql_connect("localhost","root","123456");
if(!$con) {
	echo "连接失败!";exit;
}
mysql_select_db("hh505",$con);
?>