<?php
	session_start();
	$cfg = require ('config.php');

	$con = new PDO("mysql:host=".$cfg['database']['host'].";dbname=".$cfg['database']['dbname'].";charset=utf8",$cfg['database']['user'],$cfg['database']['password']);

	$password = $_POST['password'];
	$password_bis = $_POST['password_bis'];
	$pseudo = $_POST['pseudo'];
	$passwordhash = password_hash($password, PASSWORD_BCRYPT);
	
	if($password != $password_bis) {
		header('Location: personal_workspace.php');
		$_SESSION['passworddiff']=false;
	}
	elseif ($password == ""){
		header('Location: personal_workspace.php');
		$_SESSION['emptyfield']=false;			
	}
	else{	

		$query=$con->prepare("UPDATE users SET password=:password WHERE pseudo=:pseudo");
		$query->bindValue(':password',$passwordhash, PDO::PARAM_STR);
		$query->bindValue(':pseudo',$pseudo, PDO::PARAM_STR);
		$query->execute();
		$query->closeCursor();

		header("location:".  $_SERVER['HTTP_REFERER']);
		exit();
	}
?>