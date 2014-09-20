<?php
require 'favori.class.php';

class FavorisCollection {
	private $_tabFavoris = array();
	private $_nbrFavoris;


	public function __construct (PDO $bdd, $lesPages/*, $poParent*/)
	{
		$this->_bdd = $bdd;
		$this->_nbrFavoris = 0;
		if (sizeof($lesPages) > 0) {
			foreach ($lesPages as $laPage) {
				$this->newFavori($laPage);
			}
		}
	}

	public function newFavori($pDonnees) {
		$newFavori = new Favori($this->_bdd, $pDonnees);
		$this->_tabFavoris[$this->_nbrFavoris++] = $newFavori;
		return $newFavori;
	}

	public function getFavoris() {
		$retour = "";
		for ($i = 0; $i <= $this->_nbrFavoris-1; $i++) {
			//echo "<br/>".$i."--";
			//print_r($this->_tabFavoris[$i]);
			$retour = $retour."".$this->_tabFavoris[$i]->__toString()."#";
		}
		//echo $retour;
      return $retour;
	}

}
?>