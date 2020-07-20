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
			ont-family: sans-serif;

		}
.topnav .search-container {
  float: right;
}



		</style>

	<body>
		
		<div id="page-wrapper">
			<div id="wrapper">
				<section class="panel banner">
					<div class="content color0 span-3-75" id="first">
						<h1> Espace Developers </h1> 
						
						<p> 
							Vous vous êtes connecté sur votre espace Developers<br>
						</p>

						<form method="post" action="isAdmin.php">
							<p> 						
								<input type="submit" value="RETOUR ESPACE PERSO"/>
							</p>
						</form>						
					</div>
				<section style="display:none;">
				</section>

				<section class="panel color1">
				<div class="content span-5">
						<?php 
							$user = $_SESSION['email'];
							$_SESSION['group'] = "Developers";
							$fname = $_GET['search'];
							
							
							/* if ($handle = opendir('users/'.$user)) {
								$thelist = array();
								while (false !== ($file = readdir($handle))) {
												if ($file != "." && $file != "..") {
													$thelist[] = $file;
												}
										}
								closedir($handle);
							}
							*/
							echo '<div class="displayFiles">';

							if (!$thelist = glob('groups/Developers/*', GLOB_NOSORT)) {
								echo "Impossible de retrouver du contenu dans le dossier utilisateur";
							}
							if($fname == ""){
								// à modifier
								header("location:isGrp.php");
							}
					
							$cfgbdd = require('config.php');
								$db = new PDO("mysql:host=".$cfgbdd['database']['host'].";dbname=".$cfgbdd['database']['dbname'].";charset=utf8",$cfgbdd['database']['user'],$cfgbdd['database']['password']);
								$query = "select * from files where f_filename like :fname and Developers=1 ORDER BY f_type";
								$query = $db->prepare($query);
							

								$query->bindValue(':fname', '%'.$fname.'%', PDO::PARAM_STR);
								$query->execute();
								$data = $query->fetchAll();
								if(count($data)== 0){
									echo "aucun résultat lié à votre recherche";
									echo '<form method="post" action="isGrp.php">
							<p> 						
								<input type="submit" value="RETOUR"/>
							</p>
						</form>';
									// echo $_SESSION['group'];
								}else{
								echo "Voici les resultats pour la recherche '".$fname."'";
								echo "<table class=\"table table-hover\">";
								echo "<th>id</th><th>Nom</th><th>Taille</th><th>Date</th><th>Type</th><th>Download</th><th>Supprimer</th>";
								foreach ($data as $row) {
									$id=$row['f_id'];
									echo "<tr>";
									echo "<td>" . $row["f_id"] . "</td>";
									echo "<td>" . $row["f_filename"] . "</td>";
									echo "<td>" . $row["f_filesize"] . "</td>"; 
									echo "<td>" . $row["f_date"] . "</td>"; 
									echo "<td>" . $row["f_type"] . "</td>"; 
								
						?>
								<td style="align:center;"><form method="post" action="fileDownload.php">
									<input type="text" style="display:none;" name="id" value="<?php echo $row["f_filename"];?>"/>
									<input type="submit" style="height:2.5rem;float:left;" value="DOWNLOAD" />
								</form>	</td>
								<td style="align:center;"><form method="post" action="deleteFile.php">
									<input type="text" style="display:none;" name="id" value="<?php echo $id;?>"/>
									<input type="text" style="display:none;" name="file_type" value="<?php echo $_SESSION['group'];?>"/>
									<input type="text" style="display:none;" name="file_name" value="<?php echo $row["f_filename"];?>"/>
									<input type="submit" style="height:2.5rem;float:left;" value="Supprimer" />
								</form>	</td>
								
					
							<?php
								}
								echo '</table>';
							?>
							</div>
							<div style="display:flex;">
						<form method="post" action="isGrp.php">
							<p> 						
								<input type="submit" value="RETOUR"/>
							</p>
						</form>	
						</div>
								<?php }?>
						</div>   

                   
				
                </section>
				 </div>
				 </div>
				
			<script>
			document.getElementById('myFile').onchange = function () {
			document.getElementById('file_sel').innerHTML = "Selected file " + this.value.substr(12);
		
			};
			</script>
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
	    
</html>