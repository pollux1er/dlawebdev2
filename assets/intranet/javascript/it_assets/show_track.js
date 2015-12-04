function show_track(o0, o1, target) {
	var xhr = getXMLHttpRequest();
	// alert(o0+' '+o1)
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			show(xhr.responseXML, target, o0, o1); //recupération de la reponse sous forme texte et envoi en parametre à la fonction de test de validité
		}
	};
	
	xhr.open("POST", "materiel/ajax_track", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("0="+o0);

}

function show(data, target, o0, o1)
{
	//alert(data);
	$(target).html("")
	var nodes = data.getElementsByTagName("item"); //récupération du nombre de balise "item" de la liste d'éléménts crées
	
	var spc = document.createElement('div');
	var spc1 = document.createElement('div');
	var a1 = document.createElement('input');
	var a2 = document.createElement('input');
	var iDiv = document.createElement('div');			
	
	$('#title_3').html('Historique de l\'&Eacute;quipement '+o0+' ('+o1+')');
	
	if(nodes.length == 0)
	{
		
		pagination('tck_list',10,'.navig_list_page','1');
		$(target).html("<table class='ticket_list'><tr class='altcol'><td class='align_center' style='width:100%' colspan='7'>Pas de r&eacute;sultat. Aucun mouvement enregistr&eacute;...</td></tr></table>");
		//$(target).append(iDiv);
		//color();
	}else{
		
		
		var attrs = nodes[0].attributes;//Récupération du nobre d'attribut par ligne
		
	//---> Création des éléments du tableau

		var br = document.createElement('br');
		var table = document.createElement("table");
		var tete = document.createElement("thead");
		var corps = document.createElement("tbody");
		var lgn = document.createElement("tr");
		var oDiv = document.createElement("div");
		var tDiv = document.createElement("div");
		var th, tr, inner, Dinner;

		var tab = [];
		
	//---> définition des noms des en-tête de tableau
		tab[0] = "N."; tab[1] = "Date d'affectation";/* tab[2] = "Quantite"; */tab[2] = "Nom Materiel"; tab[3] = "N. Ticket"; tab[4] = "Statut"; tab[5] = "Destination"; tab[6] = "Observation";

		//---> création de l'en-tête
		for(var i=0; i<attrs.length; i++)
		{
			th = document.createElement("th");
			if(i==7)
			{
				//lgn.appendChild(th);
			}else {
				inner = document.createTextNode(tab[i]);
				th.appendChild(inner);//injection du texte dans le th
				lgn.appendChild(th);//injection des th dans la ligne (tr)
			}
		}
		
		tete.appendChild(lgn);//injection de la ligne dans le thead
		table.setAttribute('class','ticket_list');
		table.setAttribute('id','tab_dtl')
		table.appendChild(tete);//injection du thead dans la table
		
		var k = 1;
		//---> création des lignes du tableau
		for(var j=0; j<nodes.length; j++)
		{
			tr = document.createElement("tr");
			
			if((k % 2) != 0){
				tr.setAttribute('class','altcol');
			}else{
				tr.setAttribute('class','cmd');
			}
			
			tr.setAttribute('onclick','modifier_dtl(this)');
			for(var i=0; i<attrs.length; i++)
			{
				td = document.createElement("td");
				td.setAttribute('class','align_center');
				if (i==0)
				{	
					inner = document.createTextNode(j+1);
					hid = document.createElement('input');
					hid.setAttribute('type','hidden');
					hid.setAttribute('value',nodes[j].attributes[i].nodeValue);
					td.appendChild(inner);
					td.appendChild(hid);
				}else if(i==4)
				{
					//<div class="div_del" align="left"><img style="" src="http://localhost/it_assets/assets/images/it_assets/circle_orange.png"></div>
					var div_ico = document.createElement('div');
					div_ico.setAttribute('class','div_del');
					div_ico.setAttribute('align','left');
					img = document.createElement('img');
					img.setAttribute('src',$('#img_path').val()+nodes[j].attributes[i+1].nodeValue);
					img.setAttribute('style','padding:0px; margin:0px;');
					div_ico.appendChild(img);
					inner = document.createTextNode(nodes[j].attributes[i].nodeValue);
					span = document.createElement('span');
					span.appendChild(inner);
					td.appendChild(span);
					td.appendChild(div_ico);
				} 
				else if(i!=5){
					
					inner = document.createTextNode(nodes[j].attributes[i].nodeValue);
					td.appendChild(inner);
				}
				
				if(i!=5){
					tr.appendChild(td);
				}
			}
			corps.appendChild(tr);
			k++;
		}
		
		table.appendChild(corps);//injection du tbody dans la table
		
		oDiv.appendChild(table);//injection de la table dans oDiv
		oDiv.appendChild(br);
		oDiv.setAttribute('style','width:auto;');
		
		
		
		$(target).append(oDiv);//insertion de tout le div dans la cible
		//$(target).css('display','none');
		$(target).append(iDiv);
		
		//if($(target).css('display') == 'none')
		//$(target).slideDown(1000)
		// pagination('tck_list',10,'.navig_list_page','1');
		//load_mat($('.a_mat'));
	}
}