<?php

session_start();

?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Synck - Accueil</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	
	<body class="is-preload">
		<div id="page-wrapper">
			<div id="wrapper">
				<section class="panel banner right">
					<div class="content color0 span-3-75" id="first">
						<h1 class="major">Bienvenue<br />
						Synck</h1>
						<p>Bienvenue dans la GED de votre entreprise.</p>
					</div>
				</section>
				<section class="panel color1" id="second">
					<div class="intro">
						<h2 class="major">Ton espace perso !</h2>
						<p>Accédez à votre espace personnel ici.</p>
						<div class="button-form"><button data-target="mydialog" class="modal-button">Connexion</button> </div>
					</div>
				</section>
				<section class="panel spotlight medium right color4-alt" id="first">
					<div class="content span-9">
						<h2 class="major">Pourquoi Synck ?</h2>
						<p>Synck est la première GED entièrement penser pour les entreprises. Il peut être facilement adapté en fonction de vos besoins.</p>
						<ul class="actions">
							<li><a href="#third" class="button primary color1 circle icon fa-angle-right">Next</a></li>
						</ul>
						<ul class="actions">
							<li><a href="#first" class="button primary color1 circle icon fa-angle-left">Next</a></li>
						</ul>
					</div>
					<div class="image filtered tinted" data-position="top left">
						<img src="images/pic02.jpg" alt="" />
					</div>
				</section>									   
				<section class="panel color4-alt">
					<div class="intro color2">
						<h2 class="major">Contact</h2>
						<p>Vous pouvez nous joindre sur tous nos réseaux sociaux dès que vous le souhaitez.</p>
					</div>
					<div class="inner columns divided" id="third">
						<div class="span-1-5">
							<ul class="contact-icons color1">
								<li class="icon fa-twitter"><a href="#">@Synck</a></li>
								<li class="icon fa-facebook"><a href="#">facebook.com/Synck</a></li>
								<li class="icon fa-instagram"><a href="#">@Synck</a></li>
							</ul>
						</div>
					</div>
				</section>
				<div class="copyright">&copy; Synck.</div>
			</div>
		</div>
		<p id="promptCompat">Votre navigateur ne pend pas en charge les balises <code><dialog></code></p> 
		<dialog id="mydialog" close> 
			Log Toi! 
			<br/>
			<br/>
			<div>           
				<form method="post" action="login_process.php">
					<p> 
						<label for="pseudo">Pseudo :<label>
						<input type="text" name="pseudo" required="required" />
						<label for="password">Mot de passe :<label>
						<input type="password" name="password" required="required" />						
						<div class="button-form">
							<input type="submit" value="Envoyer" />
							<input type="button" class="button-close" value="Fermer" />
						</div>
					</p>
				</form>
			</div> 	 
		</dialog>
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/browser.min.js"></script>
		<script src="assets/js/breakpoints.min.js"></script>
		<script src="assets/js/main.js"></script>

		<?php 
			if(isset($_SESSION['passworderr']) && $_SESSION['passworderr']===false){ 
		?>
		<script>
			alert('Wrong password');
		</script>
		<?php 
			} 
			unset($_SESSION['passworderr']);
		?>
		<?php 
			if(isset($_SESSION['pseudoerr']) && $_SESSION['pseudoerr']===false){ 
		?>
		<script>
			alert('Wrong pseudo, it doesn\'t exist');
		</script>
		<?php 
			} 
			unset($_SESSION['pseudoerr']);
		?>

	</body>
</html>