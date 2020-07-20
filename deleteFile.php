<?php
	session_start();
	
	$cfg = require ('config.php');
	$con = new PDO("mysql:host=".$cfg['database']['host'].";dbname=".$cfg['database']['dbname'].";charset=utf8",$cfg['database']['user'],$cfg['database']['password']);
	//Suppression coté interface
	$file = $_POST["file_name"];
	$type = $_POST["file_type"];
	$id=$_POST["id"];
	$filepath = "groups/" . $type. "/" . $file;
	
	$query = "DELETE from files where f_id=:id";
	$query = $con->prepare($query);
	$query->bindValue(':id', $id, PDO::PARAM_STR);
	$query->execute();
	$query->closeCursor(); 
	if (file_exists($filepath)) {
		unlink($filepath);
		//Suppression coté BDD						
	}
	else 
		echo "Fichier ". $filepath. " introuvable";
	header("location:".  $_SERVER['HTTP_REFERER']);
	exit();
?>