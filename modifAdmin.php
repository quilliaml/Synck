<?php
	session_start();
	$cfg = require ('config.php');

	$con = new PDO("mysql:host=".$cfg['database']['host'].";dbname=".$cfg['database']['dbname'].";charset=utf8",$cfg['database']['user'],$cfg['database']['password']);

	$isAdmin = $_POST['isAdmin'];
	$id = $_POST['id'];
	
	$query=$con->prepare("UPDATE users SET admin=:isAdmin WHERE id=:id");
	$query->bindValue(':isAdmin',$isAdmin, PDO::PARAM_STR);
	$query->bindValue(':id',$id, PDO::PARAM_STR);
	$query->execute();
	$query->closeCursor();

	header("location:".  $_SERVER['HTTP_REFERER']);
	exit();
?>