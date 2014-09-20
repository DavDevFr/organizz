<?php
require 'favorisCollection.class.php';

class Categorie {
	private $_CategoriesCollect;
	private $_FavorisCollect;
	private $_bdd;
	private $_toutesPages; 
	//private $_idParentCategorie;
	//private $_parent;
	private static $_compteur = 0;

	//protected static $__LastId = 0;

	protected $_id;
	protected $_nom;
	protected $_niveau;
	protected $_dateCreation;
	protected $_dateModif;
	protected $_dateSuppression;

	private function filterCateg($var)
	{
		return ($var["IdCategorie"] == $this->_id);
		
	}
	
	public function __construct (PDO $bdd, $toutesPages, $donnees, $piNivel)//, $piCategParent/*, $psTitle, $poParent*/)
	{
		self::$_compteur++;
		
		$this->_bdd = $bdd;
		$this->_toutesPages = $toutesPages;
		$this->_niveau = $piNivel;
		$this->hydrate($donnees);
		//$this->_CategoriesCollect = new CategoriesCollection($this->_bdd, $toutesPages, $piNivel, $this->_id);//$piCategParent
		$lesPages = array_filter($toutesPages, array($this, 'filterCateg'));//Filtre les éléments d'un tableau grâce à une fonction utilisateur
			//var_dump($lesPages);
			//echo "<hr/><br/>";
		$this->_FavorisCollect = new FavorisCollection($this->_bdd, $lesPages, $piNivel, $this->_id);//$piCategParent
				//$this->_nom = $psTitle;
		//print "<br/>Create Categ ".$this->_nom." Niv ".$this->_niveau." --".$this->_id;
		//Categorie::$__LastId++;
		//$this->_id = Categorie::$__LastId;

		/*if (($piNivel > 0) && (!isset($poParent))) {
			print "&nbsp;&nbsp;&nbsp;poParent <strong>NOK</strong><br/>";
		}
		else {
			$this->_parent = $poParent;
			//print "<br/>";
		}*/
	}
	
	public static function getCompteur()
	{
		return self::$_compteur;
	}
	        
	public function getId()
	{
		return $this->_id;
	}

	public function getNom()
	{
		return $this->_nom;
	}

	private function setId($id)
	{
		if (is_string($id))
		{
			$this->_id = $id;
		}
	}

	public function setNom($nom)
	{
		if (is_string($nom))
		{
			$this->_nom = $nom;
		}
	}

   public function getCategCollection() {
		return $this->_CategoriesCollect;
	}

	public function hydrate(array $donnees)
	{
		//echo "<br/>"."-Hydrate Categ";
		foreach ($donnees as $key => $value)
		{ // On récupère le nom du setter correspondant à l'attribut.
			//echo "<br/>".$key."-".$value;
			$method = 'set'.ucfirst($key);
			// Si le setter correspondant existe.
			if (method_exists($this, $method))
			{ // On appelle le setter.
				$this -> $method ( $value );
			}
		}
	}

	public function __tostring() {
//		$decalStr = str_repeat("&nbsp;", 4*$this->_niveau);
		//$retour = /*$decalStr.*/$this->_id.";".$this->_niveau.";".$this->_nom.";".$this->_nbrSubCategories.";".$this->_nbrFavoris."#\n";
		/*if (isset($this->_parent->_id)) //Si pas root
		{
			$retour = $this->_id.";".$this->_parent->_id.";".$this->_nom."#";
		}
		else
		{
			//$retour = $this->_id.";".";".$this->_nom."#";
			$retour = "";
		}*/
		
/*		if ($this->_niveau < 2) {
			for ($i = 0; $i <= $this->_nbrCategories-1; $i++) {
				$retour = $retour."".$this->_tabCategories[$i]->__toString();
			}
		}	
*/
		/*for ($i = 0; $i <= $this->_nbrFavoris-1; $i++) {
	    	$retour = $retour."".$this->_tabFavoris[$i]->__toString();
	 	}*/
      $retour = $this->_id.";"."2;".$this->_nom;
		return $retour;
	}

	public function Debug() {
		print "Debug Categorie:";
		print $this->_niveau.";".$this->_nom.";".$this->_nbrSubCategories."<br/>";
		$retour = "";
		for ($i = 0; $i <= $this->_nbrSubCategories-1; $i++) {
	    	$retour = $retour."".$this->_tabSubCategories[$i]->Debug();
	 	}
		print $retour;
	}

	public function getFavoris() {
		return $this->_FavorisCollect->getFavoris();
	}
	
	/*public function GetParent() {
	    if (!isset($this->_parent)) {
			//print "&nbsp;&nbsp;&nbsp;oTmpCategorie <strong>NOK</strong><br/>";
		    $oTmpCategorie = $this;
		}
		else
		    $oTmpCategorie = $this->_parent;
		return $oTmpCategorie;
	}*/

}
?>