<?php

class Temp {

	//$db = mysql_connect('localhost', 'daviddev', 'Spid6136o', 'daviddev_fav'); // on se connecte à MySQL
	/*$db = mysql_connect('localhost', 'root', '', 'daviddev_fav'); // on se connecte à MySQL
	mysql_select_db('daviddev_fav',$db); // on sélectionne la base
	if (mysqli_connect_errno()) { //Vérification de la connexion
		printf("Échec de la connexion : %s\n", mysqli_connect_error());
		exit();
	}*/

/*	$reponse = $bdd->query('SELECT * FROM mini_chat ORDER BY DateHeure DESC');

	setlocale(LC_TIME, 'fra_fra');
	while ($donnees = $reponse->fetch())
	{
		echo '<p>[' . strftime('%A %d %B %Y, %H:%M:%S', strtotime($donnees['DateHeure'])) . '] <strong>' . htmlspecialchars($donnees['Nom']) . '</strong> : ' . htmlspecialchars($donnees['Message']) . '</p>';
	}

	$reponse->closeCursor();
	$bdd = null;
*/


//mysql_query('SET NAMES UTF8') or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());


	//mysql_query('TRUNCATE TABLE Sites') or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
	//mysql_query('TRUNCATE TABLE Adresses') or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
	//mysql_query('DELETE FROM Adresses') or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
	//mysql_query('ALTER TABLE Adresses AUTO_INCREMENT=0') or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());

	//mysql_query('DELETE FROM Categorie') or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());// WHERE Id > 90
	//mysql_query('ALTER TABLE Categorie AUTO_INCREMENT=1') or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());


} //class
/*$db = mysql_connect('localhost', 'daviddev', 'Spid6136o'); // on se connecte à MySQL
mysql_select_db('daviddev_fav',$db); // on sélectionne la base 

$sql ="SELECT Id, Nom, IdCategorieSub, IdLogo, DateCreation, DateModif, DateSuppression FROM Categorie ORDER BY Id, IdCategorieSub";//WHERE IdCategorieSub IS NULL';
$result = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error()); 
$num_results = mysql_num_rows($result);
$catalogue_csv = "";

//if ($num_results) {
 
	//for ($i = 0; $i < $num_results; $i++) {
 		while ($row = mysql_fetch_array($result)) {
		//effacer les espaces inutiles au début et la fin du champs ainsi que les possibles retours de ligne à l'intérieur
		//$produit_description = trim(preg_replace("/\s+/", " ", $row["Description"]));
 
		//remplacer les virgules par un simple espace blanc
		//$produit_description = str_replace(",", " ", $produit_description);
		$catalogue_csv .= ''.$row['Id'].';'.$row['Nom'].';'.$row['IdCategorieSub']."\n";
	}
//}

// on ferme la connexion à mysql 
mysql_close(); 

//$catalogue_csv = mb_convert_encoding($catalogue_csv, 'ISO-8859-1', 'UTF-8');

$nom_fichier = "Categories-" . date("Y-m-d", time());
header('Content-Type: text/html; charset=utf-8'); 
//header("Content-type: application/vnd.ms-excel");
//header("Content-disposition: csv" . date("Y-m-d") . ".csv");
//header("Content-disposition: filename=" . $nom_fichier . ".csv");
print $catalogue_csv;
exit;*/
function chargerClasse($classe)
{
	require $classe.'.class.php';
}

spl_autoload_register('chargerClasse')
?>