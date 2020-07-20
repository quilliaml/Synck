<?php
	session_start();
	$cfg = require ('config.php');

	$con = new PDO("mysql:host=".$cfg['database']['host'].";dbname=".$cfg['database']['dbname'].";charset=utf8",$cfg['database']['user'],$cfg['database']['password']);

	$prenom = $_POST['prenom'];
	$id = $_POST['id'];

	if(!ctype_alnum($prenom)){
		$_SESSION['emptyfield']=false;
		header('Location: manageUser.php');
	} 
	else {	
		$query=$con->prepare("UPDATE users SET last_name=:prenom WHERE id=:id");
		$query->bindValue(':prenom',$prenom, PDO::PARAM_STR);
		$query->bindValue(':id',$id, PDO::PARAM_STR);
		$query->execute();
		$query->closeCursor();

		header("location:".  $_SERVER['HTTP_REFERER']);
		exit();
	}
?>