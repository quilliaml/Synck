<?php
	session_start();

	$cfg = require ('config.php');
	$id = $_POST['id'];
	$con = new PDO("mysql:host=".$cfg['database']['host'].";dbname=".$cfg['database']['dbname'].";charset=utf8",$cfg['database']['user'],$cfg['database']['password']);

	$query=$con->prepare("DELETE FROM users WHERE id=:id");
	$query->bindValue(':id',$id, PDO::PARAM_STR);
	$query->execute();
	$query->closeCursor();

	header("location:".  $_SERVER['HTTP_REFERER']);
	exit();
?>