$(document).ready(
	function () { // on verifie que la page est chargée
		console.log("Page chargée !");
		// on lance l'ajax sur la page php avec certains paramètres
		$.ajax({
			type : "GET",
			url : "php/getDatas.php",
			data : "type=1", 
			success : CreateCategs
		});
	}
);

function CreateCategs(data){
	$("#Categories").html("");//vider avant d'ajouter
	jQuery("<ul>", {
			id: "ListeCategories"
			}).appendTo("#Categories");								
	var lignes = data.split('#');
	var contenu = '';
	for(var i=0; i<lignes.length-1; i++) {
		if (lignes[i] != "") {
			var colonnes = lignes[i].split(';');
			var unecateg = jQuery("<li>", {
				id: "categ"+colonnes[0]
			});
			//if (parseInt(colonnes[1]) == 2) {
				unecateg.appendTo("ul#ListeCategories");
			/*}
			else {
				unecateg.appendTo("ul#Liste"+colonnes[1]);
			}*/
			
			jQuery("<a>", {
				id: "liencateg"+colonnes[0],
				text : /*colonnes[0]+"+"+colonnes[1]+"+"+*/colonnes[2],
				click: function() {
					text = $(this).attr("id");
					text = text.replace("liencateg", "");					
					$.ajax({
						type : "GET",
						url : "php/getDatas.php",
						data : "type=1&categ="+text, 
						success : CreateDoms
					});//"\""++"\""
				}
			}).appendTo("li#categ"+colonnes[0]);
		
			/*jQuery("<ul>", {
				id: "Liste"+colonnes[0]
				}).appendTo("li#categ"+colonnes[0]);*/
		}
	}
};

function CreateDoms(data){
	$("#Domaines").html("");
	jQuery("<ul>", {
		id: "ListeDomaines"
	}).appendTo("#Domaines");								
	var lignes = data.split('#');
	var contenu = '';
	for(var i=0; i<lignes.length-1; i++) {
		if (lignes[i] != "") {
			var colonnes = lignes[i].split(';');
			var unecateg = jQuery("<li>", {
				id: "dom"+colonnes[0]
			});
			unecateg.appendTo("ul#ListeDomaines");
			jQuery("<a>", {
				id: "liendom"+colonnes[0],
				text : colonnes[2],
				click: function() {
					text = $(this).attr("id");
					text = text.replace("liendom", "");					
					$.get("php/get_adresses.php", {categ:text}, CreateSites);//"\""++"\""
				}
			}).appendTo("li#dom"+colonnes[0]);
		}
	}
};
function CreateSites(data){
	$("#Contenu").html("");
	var lignes = data.split('#');
	var contenu = '';
	for(var i=0; i<lignes.length-1; i++) {
		if (lignes[i] != "") {
			var colonnes = lignes[i].split(';');

			jQuery("<article>", {
				id: "Article"+colonnes[0]
			}).appendTo("#Contenu");								

			var unepage = jQuery("<p>", {
				text: colonnes[1],
				id: "Page"+colonnes[0]
			});
			unepage.appendTo("#"+"Article"+colonnes[0]);//"ul#ListeDomaines");
			/*jQuery("<a>", {
				id: "liendom"+colonnes[0],
				text : colonnes[2],
				click: function() {
					text = $(this).attr("id");
					text = text.replace("liendom", "");					
					$.get("php/get_adresses.php", {categ:text}, CreateSites);//"\""++"\""
				}
			}).appendTo("li#dom"+colonnes[0]);*/
		}
	}
};