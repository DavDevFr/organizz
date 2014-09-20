<?php
require 'categoriesCollection.class.php';
#require 'categorie.class.php';

class Organiz {
	private $_CategoriesCollect;
	private $_bdd;

	const CONSTANTE1 = 1;

	public function __construct()
	{
		header( "Content-Type: text/html; charset=utf8" );
		setlocale (LC_ALL, 'fr_FR.utf8');
		date_default_timezone_set('Europe/Paris');
		mb_internal_encoding("UTF-8");// indique d'utiliser l'encodage UTF-8

		/*$db = mysql_connect('localhost', 'daviddev', 'Spid6136o'); // on se connecte à MySQL
		$dbh = new PDO('mysql:host=localhost;dbname=daviddev_fav', $user, $pass);
		$dbh = new PDO('mysql:host=localhost;dbname=daviddev_fav', $user, $pass, array(
			PDO::ATTR_PERSISTENT => true
		));*/
	
		try
		{
			$this->_bdd = new PDO('mysql:host=localhost;dbname=daviddev_fav', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		} catch(Exception $e)
		{
			die('N° : '.$e->getCode().'-Erreur : '.$e->getMessage());
		}	
		$this->_bdd->query('SET NAMES UTF8');
	    //print "Create Organiz<br/>";
		
		/*$reponse = $this->_bdd->query('SELECT * FROM pays ORDER BY ISO3166_1_numeric');
		//setlocale(LC_TIME, 'fra_fra');
		while ($donnees = $reponse->fetch())
		{
			//echo '[' . $donnees['ISO3166_1_alpha2'] . '] <strong>' . $donnees['Nom'] . '</strong> : ' . $donnees['Continent'] . '<br/>';
		}
		$reponse->closeCursor();*/	
		

		$touteCategs =  array();
		$reponse = $this->_bdd->query('SELECT Id, Nom, IdLogo, DateCreation, DateModif, DateSuppression, bTmp 
			FROM categorie 
			ORDER BY Id');//
		while ($uneCateg = $reponse->fetch())
		{
			$touteCategs[] = $uneCateg;				
		}
		$reponse->closeCursor();

		$toutePages =  array();
		$reponse = $this->_bdd->query('SELECT pages.Nom As Nom, CONCAT("http://", sites.URL, pages.URL) as URL, pages.Params, pages.Ancre, 
			categorie2site.IdSite, categorie2site.IdCategorie, categorie.Nom As NomCateg, pages.Id,
			pages.DateLastVisite, pages.DateCreation, pages.DateModif, pages.DateSuppression
			FROM pages 
			INNER JOIN page4user On pages.Id = page4user.IdPage 
			INNER JOIN categorie2site On categorie2site.IdSite = pages.Id
			INNER JOIN categorie On categorie.Id = categorie2site.IdCategorie
			INNER JOIN sites On pages.IdSite = sites.Id
			WHERE (page4user.IdUtilisateur = 1) OR (page4user.IdUtilisateur = 3)
			ORDER BY pages.Id');//
		while ($unePage = $reponse->fetch())
		{
			$toutePages[] = $unePage;				
		}
		$reponse->closeCursor();
			
		$this->_CategoriesCollect = new CategoriesCollection($this->_bdd, $touteCategs, $toutePages);
	}
	
	public function __destruct()
	{
		$this->_CategoriesCollect = null;
		$this->_bdd = null;
	}

	public function getCategories($parentId) {
		return "".$this->_CategoriesCollect->getCategories($parentId);
	}

	public function getPagesFromCateg($categId) {
		return "".$this->_CategoriesCollect->getPagesFromCateg($categId);
	}

	public function  Debug() {
		//echo $_id.’;’.$_nom.’;’.$_idParentCategorie;
		print "Debug Organiz:<br/>";
		$this->_CategoriesCollect->Debug();
	}

	private function AddCategorie($pTitle) {
	    /*$pNivel = $this->_CurrentCategorie->_niveau;
	    print "Add Categ: ".$pTitle." - Niveau ".$pNivel." in categ :";
		print "".$this->_CurrentCategorie->_nom."<br/>";*/

		$oTmpCateg = $this->_CurrentCategorie->NewCategorie($pTitle);
		if (!isset($oTmpCateg)) {
			print "AddCategorie <strong>NOK</strong><br/>";
		}
		return $oTmpCateg;
	}

	private function AddFavori($pTitle, $pURL, $pDate) {
		//print "Add Fav: ".$pTitle." (".$pURL.")<br/>";
		$this->_CurrentCategorie->NewFavori($pTitle, $pURL, $pDate);
	}

	private function DownCategorie() {
	    //print "<strong>DOWN</strong> Categ: "."";
		if ($this->_CurrentCategorie->_nbrSubCategories > 0) {
			$this->_CurrentCategorie = $this->_CurrentCategorie->GetLastAddedCateg();
			//print " :: ".$_CurrentCategorie->_nom."<br/>";
		    /*if (!isset($this->_CurrentCategorie)) {
				print "DC _CurrentCategorie <strong>NOK</strong><br/>";
			    $this->_CurrentCategorie = $oTmpCategorie;
			}*/
		}
		//print " CC=".$this->_CurrentCategorie->_nom."<br/>";
	}

	private function UpCategorie() {
	    //print "<strong>UP</strong> Categ: "."";
//		$this->_CurrentCategorie = $this->_CurrentCategorie->GetParent();
		//print " CC=".$this->_CurrentCategorie->_nom."<br/>";
	}

	public function importChromeBkm($sFileName)
	{
		$i = 1;
		$a_file = file($sFileName);
		foreach ( $a_file as $k=>$v ) {
			if (preg_match("/<h3.+?add_date=\"(.+?)\".+?last_modified=\"(.+?)\".*?>(.+?)<\/h3>/i", $v, $a)) { //Si ligne correspond à ça, == répertoire de favori chrome
				if ($a[3][0] == "_")
					$title = substr($a[3], 1);//Suppression du _ si premier caractère (tmp?)
				else
					$title = $a[3];

			    $this->AddCategorie($title);
			}
			else
				if (preg_match("/<a.+?href=\"(.+?)\".+?add_date=\"(.+?)\".+?>(.+?)<\/a>/i", $v, $a))
				{
				    $this->AddFavori($a[3], $a[1], $a[2]);
					unset($a);
				}
				else
					if (preg_match("/<dl>/i", $v, $a)) {
				    	$this->DownCategorie();
					}
					else
						if (preg_match("/<\/dl>/i", $v, $a)) {
	          				$this->UpCategorie();
					}
		}//foreach
		//echo var_dump($this->_RootCategorie);
	} //function importChromeBkm
}
?>
