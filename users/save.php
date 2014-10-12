<?php
require_once '../inc/db.php';
require_once '../inc/common.php';

$name = trim($_POST['name']);
if($_POST['password'] == $_POST['password2']){
	$query = $db->prepare('select * from users where name = :name');
	$query->bindParam(':name',$name,PDO::PARAM_STR);		
	$query->execute();
	if($query->fetchObject()){		
		redirect_to('new.php?notice=用户名已存在！');
	}else{
		$pwd = hash_hmac('sha256', $_POST['password'], 'xxxxxxx234dsf@sdf'); 
		$created_at = date('Y-m-d H:i:s');	//CURRENT_TIMESTAMP

		$sql = "insert into users(name,password,created_at) values(:name, :password,:created_at);" ;	
		$query = $db->prepare($sql);
		$query->bindParam(':name',$name,PDO::PARAM_STR);
		$query->bindParam(':password',$pwd,PDO::PARAM_STR);
		$query->bindParam(':created_at',$created_at,PDO::PARAM_STR);
		
		if (!$query->execute()) {	
			print_r($query->errorInfo());
		}else{
			redirect_to("./");
		};
	}
}else{
	redirect_to('new.php?notice=两次密码输入不一致！');	
}


?> 
	




