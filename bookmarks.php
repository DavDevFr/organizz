<!DOCTYPE html>
<html lang="fr">
	<head>
		<?php require('head.php'); ?>
		<link rel="stylesheet" href="css/bookmarks.css" type="text/css" />

		<title>Organizz - Bookmarks tmp</title>
	</head>
<body>
	<?php require('header.php'); ?>

	<div id="middle">
		<section id="latGauche" class="lateraux">
			<div id="BlocCategories" class="blocs blocsLeft">
				<h2>
					CATEGORIES
				</h2>
				<nav id="Categories">
					&nbsp;
				</nav>
			</div>
			<div id="BlocSsCategories" class="blocs blocsLeft">
				<!--h2>
					SOUS-CATEGORIES
				</h2-->
				<h2>
					DOMAINES-
				</h2>
				<nav id="Domaines">
					&nbsp;
				</nav>
			</div>
			<div id="BlocEtiquettes" class="blocs blocsLeft">
				<h2>
					ETIQUETTES
				</h2>
				<nav id="Etiquettes">
					&nbsp;
				</nav>
			</div>
		</section>
		<section id="Contenu">
			<article>
				<p>&nbsp;</p>
			</article>
		</section>
		<aside id="latDroite" class="lateraux">
			<div id="BlocInfos" class="blocs blocsRight">
				<h2>
					INFORMATIONS
				</h2>
				<nav id="Infos">
					<span id="getPays">Pays</label><br />
					<span id="getLangue">Langue</label><br />
					<span id="getLastVisit">Last Visite</label> || 
					<span id="getNbrVisit">nbr Visites</label><br />
					<label for="getCommentaire">Commentaire</label>
					<input type="text" name="getCommentaire" id="getCommentaire" /><br />
				</nav>
			</div>
			<div id="BlocConfigs" class="blocs blocsRight">
				<h2>
					CONFIGURATIONS
				</h2>
				<nav id="Configs">
					<label for="AVoir">A Voir</label>
					<select name="AVoir">
						<option value="0">
							-
						</option>
						<option value="1">
							Très vite
						</option>
						<option value="2">
							Bientôt
						</option>
						<option value="3">
							Plus Tard
						</option>
						<option value="4">
							Ne Pas Oublier
						</option>
					</select>
					
					<label for="Cyclique">Cyclique</label>
					<select name="Cyclique">
						<option value="0">
							-
						</option>
						<option value="1">
							Heures
						</option>
						<option value="2">
							Jours
						</option>
						<option value="3">
							Semaines
						</option>
						<option value="4">
							Mois
						</option>
					</select>
					
					<label for="ADate">Quand ?</label>
					<input name="ADate" id="ADate" type="date"/>
					
					<label for="message">Message</label>
					<input type="text" name="message" id="message" /><br />
					
				</nav>
			</div>
		</aside>
	</div>
	<?php require('footer.php'); ?>
</body>

<script type="text/javascript" src="../jquery/jquery.js"></script><!--2.1.1-->
<!--script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js" /-->  
<script type="text/javascript" src="js/bookmarks.js"></script>

</html>