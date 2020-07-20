<?php
	session_start();
	$cfg = require ('config.php');

	$con = new PDO("mysql:host=".$cfg['database']['host'].";dbname=".$cfg['database']['dbname'].";charset=utf8",$cfg['database']['user'],$cfg['database']['password']);

	$email = $_POST['email'];
	$id = $_POST['id'];

	$query=$con->prepare("SELECT COUNT(*) AS nbr FROM users WHERE email =:email");
	$query->bindValue(':email',$email, PDO::PARAM_STR);
	$query->execute();
	$email_free=($query->fetchColumn()==0);
	$query->closeCursor();
	 
	if(!$email_free){
		$_SESSION['emailuse']=false;
		exit("email deja utilisé");

	} 
	else{	
		$query=$con->prepare("UPDATE users SET email=:email WHERE id=:id");
		$query->bindValue(':email',$email, PDO::PARAM_STR);
		$query->bindValue(':id',$id, PDO::PARAM_STR);
		$query->execute();
		$query->closeCursor();

		header("location:".  $_SERVER['HTTP_REFERER']);
		exit();
	}
?>