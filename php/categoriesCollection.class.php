<?php
require 'categorie.class.php';

class CategoriesCollection {
	private $_bdd;
	private $_LastAddedCategorie;
	private $_CurrentCategorie;
	private $_toutesPages; 

	protected $_niveau;
	protected $_tabCategories = array();
	protected $_nbrCategories;
	//protected $_categParent;

	public function __construct(PDO $bdd, $toutesCategs, $toutesPages)//, $piNivel = 0, $piCategParent = 0)
	{
		$this->_bdd = $bdd;
		$this->_toutesPages = $toutesPages;
		$this->_toutesCategs = $toutesCategs;
		//$this->_niveau = $piNivel;

		$this->_LastAddedCategorie = null;
		$this->_CurrentCategorie = null;
		$this->_nbrCategories = 0;
		//$this->_tabCategories[$this->_nbrCategories] = NULL;
		//$this->_categParent = $piCategParent;
		//echo $piCategParent."##".$this->_categParent."<br/>";

		$nok = False;
		/*if ($piNivel == 0) {
			$reponse = $bdd->query('SELECT Id, Nom, IdLogo, DateCreation, DateModif, DateSuppression, bTmp FROM categorie WHERE IdCategorieParent is NULL ORDER BY Id');//
		}
		elseif ($piNivel > 0) {
			//echo $piNivel.">>".$this->_categParent."<br/>";
			$reponse = $bdd->query("SELECT Id, Nom, IdLogo, DateCreation, DateModif, DateSuppression, bTmp FROM categorie WHERE IdCategorieParent = '".$piCategParent."' ORDER BY Id");//
		}
		else {
			$nok = True;
		}*/

		if (!$nok) {
			setlocale(LC_TIME, 'fra_fra');
			//while ($donnees = $reponse->fetch())
			foreach ($toutesCategs as $uneCateg) {
				$this->add($uneCateg);
	        	//print_r($donnees);
				//echo "<br/>";
				//echo '<p>[' . strftime('%A %d %B %Y, %H:%M:%S', strtotime($donnees['DateHeure'])) . '] <strong>' . htmlspecialchars($donnees['Nom']) . '</strong> : ' . htmlspecialchars($donnees['Message']) . '</p>';
			}
		}
	}

	public function __destruct()
	{
		//$this->_CategoriesCollect = null;
		//delete each categ?
	}

	public function getCategories($parentId) {
		$retour = "";
		if ($parentId == 0) {
			for ($i = 0; $i <= $this->_nbrCategories-1; $i++) {
				//echo "<br/>".$i."--";
				//print_r($this->_tabCategories[$i]);
				$retour = $retour."".$this->_tabCategories[$i]->__toString()."#";
			}
		}
		else {
			//echo "Parent:".$parentId;
			/*$categParent = $this->getCategById($parentId);
			if ($categParent != null) {
				//echo "Nom:".$categParent->getNom();
				$categCollectionTmp = $categParent->getCategCollection();
            $retour = $categCollectionTmp->getCategories(0);
			}
			else {*/
				echo "Pas parent";
			//}
		}
		/*foreach ($this->_tabCategories as $value) {
			$retour = $retour."".$value->__tostring().";";
		}*/
      return $retour;
	}

	public function getCategById($categId) {
		$retour = null;
		if ($categId > 0) {
			$i = 1;
				//echo $categId."-C<br/>";
			while (($i <= $this->_nbrCategories) and ($retour == null)) {
				if ($this->_tabCategories[$i]->getId() == $categId) {
						//echo $i.">>".$this->_tabCategories[$i]->getId()."<br/>";
     				$retour = $this->_tabCategories[$i];
				}
				else {
            		//$retour = $this->_tabCategories[$i]->getCategCollection()->getCategById($categId);
            		$i++;
				}
			}
		}
   	return $retour;
	}

	public function getPagesFromCateg($categId) {
		$retour = "";
		$categ = $this->getCategById($categId);
		if ($categ != null) {
			$retour = $categ->getFavoris();
			//echo $retour;
		}
      return $retour;
	}

	public function niveau()
	{
		return $this->_niveau;
	}

	/*public function tabSubCategories()
	{
		return this->tabSubCategories;
	}
	public function nbrSubCategories()
	{
		return this->nbrSubCategories;
	}*/

	public function add($donnees) {
//echo "--".$this->_categParent."<br/>";
		$newCategorie = new Categorie($this->_bdd, $this->_toutesPages, $donnees, $this->_niveau + 1);//, $this->_categParent);
		//print "**NewCategorie() :".$pTitle." niv:".$this->_niveau."<br/>";
		//print " nbr:".$this->_nbrSubCategories."<br/>";
		$this->_tabCategories[/*$this->_nbrCategories++*/] = $newCategorie;
		$this->_nbrCategories++;
		//$newCategorie->hy();
		return $newCategorie;

		/*if ($nivel > 0) {  // fonction Get... dans class categ
			$sql = 'SELECT Id FROM Categorie WHERE (IdCategorieSub = '.$nivel_id[$nivel].') AND (Nom = (\''.$nivel_title[$nivel].'\'))';
			print($sql);
			print("<br />\n\r");
			$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
			$data = mysql_fetch_array($req);
			if ($data["Id"] == "")  {
				$subnivelid = 0;
				$subnivelid = $nivel_id[$nivel - 1];
				if ($nivel > 1) {   // fonction Set... dans class categ
					$sql = 'INSERT INTO Categorie (Nom, IdCategorieSub, bTmp) VALUES (\''.$nivel_title[$nivel].'\', \''.$subnivelid.'\', 1)';
					print($sql);
					mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
					$sql = 'SELECT LAST_INSERT_ID() as Id FROM  Categorie;';
					$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
					$data = mysql_fetch_array($req);
				}
				//print("<br />\n\r");
			}
			$nivel_id[$nivel] = $data["Id"];
			print(' : ##'.$nivel_id[$nivel].'##');
			print("<br />\n\r");
		}*/
	}

	public function GetLastAddedCateg() {
		//print "GetLastAddedCateg() : ".$this->_nbrSubCategories."";
	    $oTmpCategorie = $this->_tabCategories[$this->_nbrCategories-1];
		//print " :: ".$oTmpCategorie->_nom."<br/>";
	    if (!isset($oTmpCategorie)) {
			print "&nbsp;&nbsp;&nbsp;oTmpCategorie <strong>NOK</strong><br/>";
		}
		return $oTmpCategorie;
	}


	//	Algorithmes
	//	www.scriptol.fr
	//	Recherche dichotomique récursive
	//	Retourne l'index d'une valeur dans un tableau
	//	ou -1 si la valeur ne peut être trouvée.
	//	Le contenu du tableau doit être classé en ordre ascendant
	function binarySearch($tab, $value, $starting, $ending)
	{
		if($ending < $starting)
		{
			return -1;
		}
		$mid = intVal(($starting + $ending) / 2);
	   
		$_I1 = $tab[$mid];
		if($_I1 === $value)
		{
			return $mid;
		}
		else
		{
			if($_I1 > $value)
			{
				$ending = $mid - 1;
			}
			else
			{
				if($_I1 < $value)
				{
					$starting = $mid + 1;
				}
			}
		}
		return binarySearch($tab, $value, $starting, $ending);
	}
}
?>