<?php
	session_start();
	
	$cfg = require ('config.php');
	$con = new PDO("mysql:host=".$cfg['database']['host'].";dbname=".$cfg['database']['dbname'].";charset=utf8",$cfg['database']['user'],$cfg['database']['password']);

	$pseudo = $_POST['pseudo'];
	$last_name = $_POST['last_name'];
	$first_name = $_POST['first_name'];
	$password = $_POST['password'];
	$password_bis = $_POST['password_bis'];
	$email = $_POST['email'];
	$passwordhash = password_hash($password, PASSWORD_BCRYPT);
	$isAdmin = $_POST['isAdmin'];
	$write = $_POST['write'];

	$query=$con->prepare("SELECT COUNT(*) AS nbr FROM users WHERE pseudo =:pseudo");
	$query->bindValue(':pseudo',$pseudo, PDO::PARAM_STR);
	$query->execute();
	$pseudo_free=($query->fetchColumn()==0);
	$query->closeCursor();

	$query=$con->prepare("SELECT COUNT(*) AS nbr FROM users WHERE email =:email");
	$query->bindValue(':email',$email, PDO::PARAM_STR);
	$query->execute();
	$email_free=($query->fetchColumn()==0);
	$query->closeCursor();

	if(!ctype_alnum($pseudo) || !ctype_alnum($last_name) || !ctype_alnum($first_name)){
		$_SESSION['emptyfield']=false;
		header('Location: personal_workspace_admin.php');
	}
	elseif($password != $password_bis){
		header('Location: personal_workspace_admin');
		$_SESSION['passworddiff']=false;
	} 
	elseif(!$pseudo_free){
		header('Location: personal_workspace_admin');
		$_SESSION['pseudouse']=false;
	} 
	elseif(!$email_free) {
		header('Location: personal_workspace_admin');
		$_SESSION['emailuse']=false;
	} 
	else{	
		$query=$con->prepare("INSERT INTO `users` (`id`, `pseudo`, `first_name`, `last_name`, `password`, `email`, `admin`, `write`) VALUES (NULL, :pseudo, :last_name, :first_name, :passwordhash, :email,:isAdmin,:write);");
		$query->bindValue(':pseudo',$pseudo, PDO::PARAM_STR);
		$query->bindValue(':last_name',$last_name, PDO::PARAM_STR);
		$query->bindValue(':first_name',$last_name, PDO::PARAM_STR);
		$query->bindValue(':passwordhash',$passwordhash, PDO::PARAM_STR);
		$query->bindValue(':email',$email, PDO::PARAM_STR);
		$query->bindValue(':isAdmin',$isAdmin, PDO::PARAM_STR);
		$query->bindValue(':write',$write, PDO::PARAM_STR);
		$query->execute();
		$query->closeCursor();

		header("location:".  $_SERVER['HTTP_REFERER']);
		exit();
	}
?>