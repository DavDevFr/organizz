$(document).ready(
	function () { // on verifie que la page est chargée
		// on lance l'ajax sur la page php avec certains paramètres
		$.get("../php/get_categories.php", "",
			function(data){
			    $("#Categories").html("");//vider avant d'ajouter
				jQuery("<ul>", {
					    id: "ListeGenerale"
					    }).appendTo("#Categories");								
				var lignes = data.split('\n');
				var contenu = '';
				for(var i=0; i<lignes.length; i++) {				
					var colonnes = lignes[i].split(';');
					var unecateg = jQuery("<li>", {
					    id: "categ"+colonnes[0]
					    });					
					if (colonnes[2] == 0) {
						unecateg.appendTo("ul#ListeGenerale");					
					}
					else {
						unecateg.appendTo("ul#Liste"+colonnes[2]);
					}

					jQuery("<div>", {
					    id: "divcateg"+colonnes[0],
					    text : colonnes[1],
					    /*css: {
					        height: "50px",
					        width: "50px",
					        color: "blue",
					        backgroundColor: "#ccc"
					    },*/
						click: function() {
					       $.get("../php/get_adresses.php", "",
							function(data){
								$("#Contenu").html(data)
							})
					    }}).appendTo("li#categ"+colonnes[0]);
					    
					jQuery("<ul>", {
					    id: "Liste"+colonnes[0]
					    }).appendTo("li#categ"+colonnes[0]);					
				}
				 
			}
		)
});