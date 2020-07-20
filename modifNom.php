<?php
	session_start();
	$cfg = require ('config.php');

	$con = new PDO("mysql:host=".$cfg['database']['host'].";dbname=".$cfg['database']['dbname'].";charset=utf8",$cfg['database']['user'],$cfg['database']['password']);

	$nom = $_POST['nom'];
	$id = $_POST['id'];

	if(!ctype_alnum($nom)){
		$_SESSION['emptyfield']=false;
		header('Location: manageUser.php');
	} 
	else {	
		$query=$con->prepare("UPDATE users SET first_name=:nom WHERE id=:id");
		$query->bindValue(':nom',$nom, PDO::PARAM_STR);
		$query->bindValue(':id',$id, PDO::PARAM_STR);
		$query->execute();
		$query->closeCursor();

		header("location:".  $_SERVER['HTTP_REFERER']);
		exit();
	}
?>