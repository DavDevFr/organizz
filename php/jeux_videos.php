<?php
$bdd = new PDO('mysql:host=localhost;dbname=test', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$reponse = $bdd->query('SELECT * FROM jeux_video');
while($donnees = $reponse->fetch())
{
	echo '<p>' . $donnees['nom'] . '</p>';
}
?>