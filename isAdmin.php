<?php 
session_start();

if( $_SESSION['admin'] == 1){
	 header('Location: personal_workspace_admin.php');
	 exit();
}else{
	 header('Location: personal_workspace.php');
	 exit();
}
?>