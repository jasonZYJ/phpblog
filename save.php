<?php 

require_once './inc/db.php';
require_once './inc/common.php';

$created_at = date('Y-m-d H:i:s');	//CURRENT_TIMESTAMP
$sql = 	"insert into posts(title,body,created_at) values('{$_POST['title']}', '{$_POST['body']}','{$created_at}' ) ;" ;	
if (!mysql_query($sql)) {
	echo mysql_error();	
	echo '<br>' .  $sql;
}else{
	redirect_to("/");
};

?>