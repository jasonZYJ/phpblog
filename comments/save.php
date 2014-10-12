<?php 

require_once '../inc/db.php';
require_once '../inc/common.php';

$sql = "insert into comments(title,body,created_at,post_id) values(:title, :body,:created_at,:post_id);" ;  
$query = $db->prepare($sql);
$query->bindParam(':title',$_POST['title'],PDO::PARAM_STR);
$query->bindParam(':body',$_POST['body'],PDO::PARAM_STR);
$query->bindParam(':created_at',$created_at,PDO::PARAM_STR);
$query->bindParam(':post_id',$_POST['post_id'],PDO::PARAM_INT);

$created_at = date('Y-m-d H:i:s');  //CURRENT_TIMESTAMP
if (!$query->execute()) { 
  print_r($query->errorInfo());
}else{
  redirect_to("/posts/show.php?id=" . $_POST['post_id']);
};

?>