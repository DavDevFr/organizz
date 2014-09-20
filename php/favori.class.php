<?php

class Favori {
	private $_id;
	protected $_nom;
	private $_url;
	private $_date1;

	protected $_cptVisite;
	protected $_dateLastVisite;
	protected $_dateCreation;
	protected $_dateModif;
	protected $_dateSuppression;

	public function getId()
	{
		return $this->_id;
	}

	public function getNom()
	{
		return $this->_nom;
	}

	public function getUrl()
	{
		return $this->_url;
	}

	public function getCptVisite()
	{
		return $this->_cptVisite;
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

	public function setUrl($url)
	{
		if (is_string($url))
		{
			$this->_url = $url;
		}
	}

	public function setCptVisite($cptVisite)
	{
		$cptVisite = (int)$cptVisite;
		if ($cptVisite >= 0)
		{
			$this->_cptVisite = $cptVisite;
		}
	}

	public function hydrate(array $donnees)
	{
		foreach ($donnees as $key => $value)
		{ // On récupère le nom du setter correspondant à l'attribut.
			$method = 'set'.ucfirst($key);
			// Si le setter correspondant existe.
			if (method_exists($this, $method))
			{ // On appelle le setter.
				$this->$method ( $value );
			}
		}
	}

	public function __construct (PDO $bdd, $donnees)
    {
      $this->_bdd = $bdd;
	  //print_r($donnees);
	  $this->hydrate($donnees);
		/*$this->_id = $pId;
		$this->_nom = $psTitle;
		$this->_url = $pURL;*/
		$this->_date1 = getdate();
		/*$chaine = ''.$title.';'.$href.';'.$date;
		for ($i=2; $i < $nivel; $i++) {
		    $chaine .= ';'.$nivel_title[$i];
		}*/
		$urltab = parse_url($this->_url);
		//$serveur = $urltab["scheme"]."://".$urltab["host"];
		//echo $this->_url." - ";
		//var_dump($urltab);
		//echo "<br/>";
		//print($serveur);

		/*$sql = 'SELECT Id FROM Sites WHERE Nom = (\''.$urltab["host"].'\')';
		//print($sql);
		$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
		$data = mysql_fetch_array($req);

		if ($data["Id"] == "") {
			//print($serveur." : <br/>");
			$sql = 'INSERT INTO Sites (Nom, URL) VALUES (\''.$urltab["host"].'\', \''.$serveur.'\')';
			mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
			$sql = 'UPDATE Sites SET DateCreation = now(), DateModif = NULL WHERE Id = LAST_INSERT_ID();';
			mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
			$sql = 'SELECT LAST_INSERT_ID() as Id FROM  Sites;';
			$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
			$data = mysql_fetch_array($req);
		}

		$urlAdresse = $urltab["path"];
		if ($urltab["query"] != "") {
			$urlAdresse .= '?'.$urltab["query"];
		}
		if ($urltab["fragment"] != "") {
			$urlAdresse .= '#'.$urltab["fragment"];
		}
		$urlAdresse = str_replace("'", "\'", $urlAdresse);

		if ((strlen($urlAdresse) > 1) && ($urlAdresse != "/#")) {
			//print($urlAdresse);
			//print("<br />\n\r");
			//print($href);
			//print("<br />\n\r");
			//print($serveur.$urlAdresse);
			//print("<br /><br />\n\r")}
			$sql = 'INSERT INTO Adresses (IdSite, Nom, URL) VALUES ('.$data["Id"].', \''.$title.'\', \''.$urlAdresse.'\')';
			mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
			$sql = 'UPDATE Adresses SET DateCreation = now(), DateModif = NULL WHERE Id = LAST_INSERT_ID();';
			mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
		}*/
		/*if ($urltab["query"] != "") { //"user"  "pass"  "fragment"
			print($href."<br />\n\r");
			print_r($urltab);
			print("<br /><br />\n\r");
		}*/
    }

	public function __tostring() {
		return $this->_id.";".$this->_nom.";".$this->_url."";
	}

	private function getPageTitle($url) // Ajouter un champ titre dans la table sites
	{
		if( !($data = file_get_contents($url)) )
			return false;

		if( preg_match("#<title>(.+)<\/title>#iU", $data, $t))  {
			return trim($t[1]);
		} else {
			return false;
		}
		/* Exemple: */
		//echo get_page_title("http://www.developpez.com/"."<br />\n\r");
	}

	private function getPageFavicon($url){
	}
}
?>