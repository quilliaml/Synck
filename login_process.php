<?php

	session_start();
	$cfg = require ('config.php');
	$con = new PDO("mysql:host=".$cfg['database']['host'].";dbname=".$cfg['database']['dbname'].";charset=utf8",$cfg['database']['user'],$cfg['database']['password']);

	$query=$con->prepare('SELECT * FROM users WHERE pseudo = :pseudo');
	$query->bindValue(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);
	$query->execute();

	if($query->rowCount() == 0){
		header('Location: home.php');
		$_SESSION['pseudoerr']=false;
		exit;
	} 

	$data = $query->fetch();
	
	if(!password_verify($_POST['password'], $data['password'])){
		header('Location: home.php');
		$_SESSION['passworderr']=false;
		exit;
	}
	else{
	    if($data['admin']==0){
        	$_SESSION['pseudo'] = $data['pseudo'];
        	$_SESSION['last_name'] = $data['last_name'];
        	$_SESSION['first_name'] = $data['first_name'];
        	$_SESSION['email'] = $data['email'];
			$_SESSION['admin'] = $data['admin'];
        
        	header('Location: personal_workspace.php');
        	exit();
	    }
	    else{
	        $_SESSION['pseudo'] = $data['pseudo'];
	        $_SESSION['last_name'] = $data['last_name'];
	        $_SESSION['first_name'] = $data['first_name'];
	        $_SESSION['email'] = $data['email'];
			$_SESSION['admin'] = $data['admin'];
	        
	        header('Location: personal_workspace_admin.php');
	        exit();
	    }
	}
?>