<?php
	session_start();
	
	$cfg = require ('config.php');
	$con = new PDO("mysql:host=".$cfg['database']['host'].";dbname=".$cfg['database']['dbname'].";charset=utf8",$cfg['database']['user'],$cfg['database']['password']);
	
	$id=$_POST['id'];
	$rh=0;
	$net=0;
	$acc=0;
	$dev=0;
	$pro=0;
	
	if(isset($_POST['group0'])){
			 $rh=1;
	}
	if(isset($_POST['group1'])){
			 $net=1;
	}
	if(isset($_POST['group2'])){
			 $acc=1;
	}
	if(isset($_POST['group3'])){
			 $dev=1;
	}
	if(isset($_POST['group4'])){
			 $pro=1;
	}
	
	$query=$con->prepare("UPDATE users SET RH=:rh, NetworkTeam=:net,Accounting=:acc,Developers=:dev,Project=:pro WHERE id=:id");
	$query->bindValue(':rh',$rh, PDO::PARAM_STR);
	$query->bindValue(':net',$net, PDO::PARAM_STR);
	$query->bindValue(':acc',$acc, PDO::PARAM_STR);
	$query->bindValue(':dev',$dev, PDO::PARAM_STR);
	$query->bindValue(':pro',$pro, PDO::PARAM_STR);
	$query->bindValue(':id',$id, PDO::PARAM_STR);
	$query->execute();
	$pseudo_free=($query->fetchColumn()==0);
	$query->closeCursor();
	
	header("location:".  $_SERVER['HTTP_REFERER']);
	exit();
?>