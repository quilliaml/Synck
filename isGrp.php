<?php
session_start();
if($_SESSION['group'] == "RH"){
	header("location:page_rh.php");
}
if($_SESSION['group'] == "Accounting"){
	header("location:page_acc.php");
}

if($_SESSION['group'] == "NetworkTeam"){
	header("location:page_net.php");
}
if($_SESSION['group'] == "Project"){
	header("location:page_project.php");
}

if($_SESSION['group'] == "Developers"){
	header("location:page_dev.php");
}


?>