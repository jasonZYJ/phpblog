<?php 

mysql_connect('localhost','demo','demo') or die('can`t work');
mysql_query("SET NAMES utf8");    
mysql_select_db('phpdemo');

$id = $_POST['id'];
$sql = "update posts set title = '{$_POST['title']}', body = '{$_POST['body']}' where id = {$_POST['id']};" ;	
if (!mysql_query($sql)) {
	echo mysql_error();	
	echo '<br>' .  $sql;
};


?>