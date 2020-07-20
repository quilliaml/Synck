<?php

	session_start();
	$_SESSION['group'] = "";
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Synck - Espace Perso</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	
	<style>
	a{
		border-bottom:none;
	}
	</style>
	<body>
		<div id="page-wrapper">
			<div id="wrapper">
				<section class="panel banner">
					<div class="content color0 span-3-75" id="first">
						<h1> Espace Perso - User !! </h1> 
						<p> 
							Vous vous êtes connecté<br>
						</p>
						<p>
							Pseudo :
							<?php echo $_SESSION['pseudo']; ?> 
						</p>
						<p>
							Nom :
							<?php echo $_SESSION['last_name']; ?> 
						</p>
						<p>
							Prenom :
							<?php echo $_SESSION['first_name']; ?> 
						</p>
						<p>
							E-Mail :
							<?php echo $_SESSION['email']; ?> 
						</p>
						<form method="post" action="logoff_process.php">
							<p> 						
								<input type="submit" value="Deconnexion" />
							</p>
						</form>						
					</div>
					
				<section style="display:none;">
				</section>
				<section class="panel color1">
					<div class="content span-5">
						<h2 class="major">Tes fichiers !</h2>
							<?php 
							$pseudo = $_SESSION['pseudo']; 
	
							$cfg = require ('config.php');
							$con = new PDO("mysql:host=".$cfg['database']['host'].";dbname=".$cfg['database']['dbname'].";charset=utf8",$cfg['database']['user'],$cfg['database']['password']);
							
							
								$query = "select RH, NetworkTeam,Accounting,Developers,Project from users where pseudo=:pseudo";
								$query = $con->prepare($query);
								$query->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
								$query->execute();
								$data = $query->fetchAll();

							foreach($data as $row){
							
							if($row["RH"] ==1){
								?><a href="page_rh.php"><div class="button-form"><button class="modal-button" style="width:200px;">RH</button></a></div>
							<?php
							}
							if($row["NetworkTeam"] == 1){
							?><div class="button-form"><a href="page_net.php"><button class="modal-button"style="width:200px;">Network Team</button></a> </div>
							<?php
							}
							if($row["Accounting"] == 1){
								?><div class="button-form"><a href="page_acc.php"><button class="modal-button"style="width:200px;">Accounting</button></a></div>
							<?php
							}
							if($row["Developers"] == 1){
								?><div class="button-form"><a href="page_dev.php"><button class="modal-button"style="width:200px;">Developers</button></a></div>
							<?php
							}
							if($row["Project"] == 1){
								?><div class="button-form"><a href="page_project.php"><button class="modal-button"style="width:200px;">Project</button></a> </div>
							<?php
							}
							}
							
												
							?>
							<div style = >
							<ul class="actions">
							<li><a href="#first" class="button primary color1 circle icon fa-angle-left">Next</a></li>
							<li style="margin-left:82%;"><a href="#second" class="button primary color1 circle icon fa-angle-right">Next</a></li>
						</ul>
						</div>
                    </div>
                  
                </section>
				<section class="panel color1" id="second">
					<div class="intro">
						<h2 class="major">Gère ton espace perso</h2>
						<div class="button-form"><button data-target="mydialog" class="modal-button">Modifier mot de passe</button> </div>
					</div>
			
				  </div>
			</div>
		
		<p id="promptCompat">Votre navigateur ne pend pas en charge les balises <code><dialog></code></p> 
		
		
		<dialog id="mydialog" close> 
			Changez votre mot de passe ! 
			<br/>
			<br/>
			<div>
			
			
			<form method="post" action="modifPassword.php">
				<input type="text" style="display:none;" name="pseudo" value="<?php echo $pseudo;?>"/>
				<p> 
					<label for="password">Nouveau mot de passe :<label>
					<input type="password" name="password" required="required" />
					<label for="password_bis">Vérification :<label>
					<input type="password" name="password_bis" required="required"/>
					</div>
					<div class="button-form">
						<input type="submit" value="Envoyer" />
						<input type="button" class="button-close" value="Fermer" />
					</div> 
				</p>
			</form>
		 
		</dialog>
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/browser.min.js"></script>
		<script src="assets/js/breakpoints.min.js"></script>
		<script src="assets/js/main.js"></script>
				
		<?php 
			if(isset($_SESSION['passworddiff']) && $_SESSION['passworddiff']===false){ 
		?>
		<script>
			alert('Passwords are differents');
		</script>
		<?php 
			} 
			unset($_SESSION['passworddiff']);
		?>
		<?php 
			if(isset($_SESSION['emptyfield']) && $_SESSION['emptyfield']===false){ 
		?>
		<script>
			alert('All fields must be completed');
		</script>
		<?php 
			} 
			unset($_SESSION['emptyfield']);
		?>

	</body>
</html>