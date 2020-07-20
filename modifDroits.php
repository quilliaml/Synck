<?php
	session_start();
	$cfg = require ('config.php');

	$con = new PDO("mysql:host=".$cfg['database']['host'].";dbname=".$cfg['database']['dbname'].";charset=utf8",$cfg['database']['user'],$cfg['database']['password']);

	$write = $_POST['write'];
	$id = $_POST['id'];
	
	$query=$con->prepare("UPDATE `users` SET `write`=:write WHERE `id`=:id");
	$query->bindValue(':write',$write, PDO::PARAM_STR);
	$query->bindValue(':id',$id, PDO::PARAM_STR);
	$query->execute();
	$query->closeCursor();

	header("location:".  $_SERVER['HTTP_REFERER']);
	exit();
?>