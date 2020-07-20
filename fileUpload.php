<?php

session_start();

$cfg = require 'configuration.php';
$cfgbdd = require('config.php');
$group = $_POST["file_type"];

$rh=0;
$net=0;
$acc=0;
$dev=0;
$pro=0;
$erreur=0;

	if($_POST['file_type'] == "RH"){
			 $rh=1;
	}
	if($_POST['file_type'] == "NetworkTeam"){
			 $net=1;
	}
	if($_POST['file_type']== "Accounting"){
			 $acc=1;
	}
	if($_POST['file_type'] == "Developers"){
			 $dev=1;
	}
	if($_POST['file_type'] == "Project"){
			 $pro=1;
	}
	
if ($_FILES['myFile']['size'] == 0) {
	require("isAdmin.php");
	echo "Veuillez insérer un fichier";
	exit();
}
if ($_FILES['myFile']['error'] > 0) $erreur = "Erreur lors du transfert";
if ($_FILES['myFile']['size'] > $cfg['maxsize']) $erreur = "Le fichier est trop gros";
if($erreur) echo $erreur;


$info = pathinfo($_FILES['myFile']['name']);
print($info['extension']);



if (in_array($info['extension'], $cfg['valid_extensions'])) {
	echo "Extension validée";
	$con = new PDO("mysql:host=".$cfgbdd['database']['host'].";dbname=".$cfgbdd['database']['dbname'].";charset=utf8",$cfgbdd['database']['user'],$cfgbdd['database']['password']);

	$query = $con->prepare("INSERT INTO files(f_filename, f_filesize, f_date, f_type,RH,NetworkTeam,Accounting,Developers,Project) values(:f_filename, :f_filesize, NOW(), :f_type,:rh,:net,:acc,:dev,:pro);");
	$query->bindValue(':f_filename', $_FILES['myFile']['name'], PDO::PARAM_STR);
	$query->bindValue(':f_filesize',$_FILES['myFile']['size'], PDO::PARAM_STR);
	$query->bindValue(':rh',$rh, PDO::PARAM_STR);
	$query->bindValue(':net',$net, PDO::PARAM_STR);
	$query->bindValue(':acc',$acc, PDO::PARAM_STR);
	$query->bindValue(':dev',$dev, PDO::PARAM_STR);
	$query->bindValue(':pro',$pro, PDO::PARAM_STR);
	$query->bindValue(':f_type', $info['extension'], PDO::PARAM_STR);
	$ok = $query->execute();
	if(!$ok) {
		print_r($query->errorInfo());
		exit;
	}
	$query->closeCursor(); 


	// attention au extension de fichier php/html/js etc : rajouter une autre ext a coté

	$dir = "groups/";
	$path = $dir . $group . '/';
	$nom = $path.basename($_FILES['myFile']['name']);
	$res = move_uploaded_file($_FILES['myFile']['tmp_name'], $nom);
	if ($res) {
		echo "Upload réussi";
		header("location:".  $_SERVER['HTTP_REFERER']);
		exit();
		}
}
// else echo "Veuillez insérer un fichier compatible."

?>