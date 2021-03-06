<?php

	session_start();

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
table {
border: medium solid #726193;
border-collapse: collapse;
width: 50%;
}
th {
font-family: monospace;
border: thin solid #6495ed;
width: 50%;
padding: 5px;
background-color: #7755bf;
background-image: url(sky.jpg);
}
td {
font-family: sans-serif;
border: thin solid #726193;
width: 50%;
padding: 5px;
text-align: center;
font-size:10px;
background-color:#726193;
}
caption {
font-family: sans-serif;

}
form{
	margin:unset;
}
	#promptCompat{ 
		display: none; 
	} 

	#promptCompat.no_dialog{ 
		box-shadow: 0 0 5px 2px red; 
		padding: 10px; 
		display: block; 
		text-align: center; 
		font-weight: bold; 
	} 

	.button-form{ 
		padding: 10px; 
	} 

	dialog{ 
		border-radius: 10px; 
		box-shadow: 0 3px 7px rgba(0, 0, 0, 0.3); 
	} 

	dialog::backdrop{ 
		background-color: rgba(0, 0, 0, 0.6); 
	} 

	.mydialog{
		background-color: #353865;
		background-image: url("../../images/overlay.png"), linear-gradient(135deg, rgba(114, 97, 147, 0.25) 25%, rgba(227, 123, 124, 0.25) 50%, rgba(255, 228, 180, 0.25));
		background-size: 128px 128px, auto;
		border : none;
		color: rgba(255, 255, 255, 0.75);
		font : inherit;
		font-family: "Source Sans Pro", Helvetica, sans-serif;
		font-size: 1rem;
		font-weight: 300;
		line-height: 1.65;
		position : fixed;
		
	}

	.mydialog .button-form, .button-form{
		text-align : center;
	}

	.file-box{
		display: inline-block;
		text-align: center;
		margin: 0 15px;
	}
</style>
	<body>
		<div id="page-wrapper">
			<div id="wrapper">
				<section class="panel banner">
					<div class="content color0 span-3-75">
						<h1> Gestion utilisateur </h1> 
						
						<p> 
							Ici, vous pouvez administrer vos groupes<br>
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
				<section class="panel color1">
				
					<div class="content span-5" style="">
					<h1 style="height:10px;margin-bottom:100px;">Vos groupes</h1>
						<div id="displayUsers" style="">
						<?php 
						$cfgbdd = require('config.php');
						$db = new PDO("mysql:host=".$cfgbdd['database']['host'].";dbname=".$cfgbdd['database']['dbname'].";charset=utf8",$cfgbdd['database']['user'],$cfgbdd['database']['password']);
						$page = (!empty($_GET['page']) ? $_GET['page'] : 1);
						$limit = 5;
						$debut = ($page - 1) * $limit;
						$resultFoundRows = $db->query('SELECT count(id) FROM users');
						/* On doit extraire le nombre du jeu de résultat */
						$nombredElementsTotal = $resultFoundRows->fetchColumn();

						$debut = ($page - 1) * $limit;
						$nombreDePages = ceil($nombredElementsTotal / $limit);
						
							
							$query = "select * from users LIMIT :limit OFFSET :debut";
							$query = $db->prepare($query);
							$query->bindValue('limit', $limit, PDO::PARAM_INT);
							$query->bindValue('debut', $debut, PDO::PARAM_INT);
							$query->execute();
							$data = $query->fetchAll();
							echo "<table class=\"table table-hover\">";
							echo "<th>Pseudo</th><th>RH</th><th>Network</th><th>Accounting</th><th>Dev</th><th>Project</th>";
							$a=1;
							$b=6;
							$c=12;
								foreach ($data as $row) {
									
									$id=$row['id'];
								?>
	
								<td><button data-target="mydialog<?php echo $id?>" id = "<?php echo $id?>"class="modal-button">Modifier</button></td>
								<dialog id="mydialog<?php echo $id?>" class="mydialog" draggable=true close>

								
								<form method="post" action="modifGroup.php">
								 <input type="text" style="display:none;" name="id" value="<?php echo $id;?>"/>
								<label for="write">Groupe actuel: <?php if($row["write"] == 1){echo "lecture et écriture";}else{echo "lecture seule";}?></label>
						
                                <input type="checkbox" id="<?php echo $a+1;?>" name="vehicle1" value="Bike"/>
								<label for="<?php echo $a+1;?>"> I have a bike</label><br>
								<input type="checkbox" id="<?php echo $b+1;?>" name="vehicle2" value="Car"/>
								<label for="<?php echo $b+1;?>"> I have a car</label><br>
								<input type="checkbox" id="<?php echo $c+1;?>" name="vehicle3" value="Boat">
								<label for="<?php echo $c+1;?>"> I have a boat</label><br>
								<input type="submit" value="Envoyer" />
								<input type="button" class="button-close" value="Fermer" />
								</form>
								</dialog>
									<?php 
								
									
									++$a;
									++$b;
									++$c;
								}
								?>
								
				

									

		 
								
							
								<?php
								
								
								// echo "</tr>";
							
							
								
							
								
							
							echo "</table>";
							if ($page > 1):
						?>
						<a href="?page=<?php echo $page - 1; ?>">Page précédente</a><?php endif;
						for ($i = 1; $i <= $nombreDePages; $i++):?>
						<a href="?page=<?php echo $i;?>"></a><?php
						endfor;
						if ($page < $nombreDePages):
						
						?>	<a href="?page=<?php echo $page + 1; ?>">Page suivante</a><?php
						endif;
						?>					
			</div>
						
					
					<div class="button-form"  ><a href ="personal_workspace_admin.php" style="border-bottom:none;margin-left:45%;"><button class="modal-button">RETOUR</button></a> </div>	        
                    </div>
				
                </section>
				
				
				
			
				
			</div>
                </div>
						<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
	    
</html>