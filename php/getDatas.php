<?php 
require 'organiz.class.php';
$zeOrganiz = new Organiz();
//echo serialize($zeOrganiz);
//echo "<br/>";

if (isset($_GET['type'])) {
	$type = (int)$_GET['type'];
		
	switch ($type) // on indique sur quelle variable on travaille
	{ 
	    case 0: // dans le cas où $note vaut 0
	        echo "Tu es vraiment un gros Zér0 !!!";
	    break;
	    
	    case 1: 
			if (isset($_GET['categ'])) {
				$_GET['categ'] = (int)$_GET['categ'];
				echo $zeOrganiz->getCategories($_GET['categ']);
			}
			else {
				echo $zeOrganiz->getCategories(0);
			}
	    break;	
	
	    case 2: 
			if (isset($_GET['categ'])) {
				$_GET['categ'] = (int)$_GET['categ'];
				echo $zeOrganiz->getPagesFromCateg($_GET['categ']);
			}
	    break;
		
	    case 3: 
			//$zeOrganiz->importChromeBkm("favoris_28_04_14.html");
	    break;
	    
			
	}	 
}
?>