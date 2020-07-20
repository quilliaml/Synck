<?php
	session_start();
	$cfg = require ('config.php');

	$con = new PDO("mysql:host=".$cfg['database']['host'].";dbname=".$cfg['database']['dbname'].";charset=utf8",$cfg['database']['user'],$cfg['database']['password']);

	$pseudo = $_POST['pseudo'];
	$id = $_POST['id'];

	$query=$con->prepare("SELECT COUNT(*) AS nbr FROM users WHERE pseudo =:pseudo");
	$query->bindValue(':pseudo',$pseudo, PDO::PARAM_STR);
	$query->execute();
	$pseudo_free=($query->fetchColumn()==0);
	$query->closeCursor();
	
	if(!ctype_alnum($pseudo)){
		$_SESSION['emptyfield']=false;
		header('Location: manageUser.php');
	} 
	elseif(!$pseudo_free) {
		$_SESSION['pseudouse']=false;
		header('Location: manageUser.php');	
	} 
	else {	
		$query=$con->prepare("UPDATE users SET pseudo=:pseudo WHERE id=:id");
		$query->bindValue(':pseudo',$pseudo, PDO::PARAM_STR);
		$query->bindValue(':id',$id, PDO::PARAM_STR);
		$query->execute();
		$query->closeCursor();

		header("location:".  $_SERVER['HTTP_REFERER']);
		exit();
	}
?>