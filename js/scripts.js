$(document).ready(
	function () { // on verifie que la page est chargée
		// on lance l'ajax sur la page php avec certains paramètres
		$.get("php/FavsChrome.php", "",
			function(data){
			    $("#Categories").html("");//vider avant d'ajouter
				jQuery("<ul>", {
					    id: "ListeGenerale"
					    }).appendTo("#Categories");								
				//var lignes = data.split('\n');
				var lignes = data.split('#');
				var contenu = '';
				for(var i=0; i<lignes.length-0; i++) {
				//for(var i=0; i<16; i++) {
					var colonnes = lignes[i].split(';');
					if (parseInt(colonnes[0]) > 1) {
						//alert(colonnes[0]);
						var unecateg = jQuery("<li>", {
						    id: "categ"+colonnes[0]
						    });
						if (parseInt(colonnes[1]) == 2) {
							unecateg.appendTo("ul#ListeGenerale");
						}
						else {
							unecateg.appendTo("ul#Liste"+colonnes[1]);
						}

						jQuery("<div>", {
						    id: "divcateg"+colonnes[0],
						    text : /*colonnes[0]+"+"+colonnes[1]+"+"+*/colonnes[2]/*,
							click: function() {
						       $.get("../php/get_adresses.php", "",
								function(data){
									$("#Contenu").html(data)
								})
						    }*/}).appendTo("li#categ"+colonnes[0]);

						jQuery("<ul>", {
						    id: "Liste"+colonnes[0]
						    }).appendTo("li#categ"+colonnes[0]);

					}
				}
			}
		)
});