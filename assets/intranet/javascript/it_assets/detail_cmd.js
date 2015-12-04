function details(numeropo, target) {
	//alert(numeropo);
	
	$('#recup_po').val(numeropo);
	var xhr = getXMLHttpRequest();
	
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			charger_detail(xhr.responseXML, target,numeropo);
		}else if (xhr.readyState < 4) {
			img = document.createElement('img');
			img.setAttribute('src',$('#img_path').val()+'5.gif');
            $(target).html(img);
        } 
	};
	
	xhr.open("GET", "commande/ajax_det_com?numeropo=" + numeropo, true);
	xhr.send(null);
}

function charger_detail(data, target, num) {
	//alert(data);
	//as = $('#tck_list td a').length
	
	//-----------------> création du tableau d'affichage des détails:
		//---> récupération du code XML
			$(target).html("");
			var nodes = data.getElementsByTagName("item"); //récupération du nombre de balise "item" de la liste d'éléménts crées
			
			var spc = document.createElement('div');
			var a1 = document.createElement('input');
			var a2 = document.createElement('input');
			var iDiv = document.createElement('div');			
			
			a1.setAttribute('class','button_action_fermer');
			a1.setAttribute('onclick',' decolor('+num+'), $("#term_dtl").trigger("click")');
			a1.setAttribute('type','button');
			a1.setAttribute('value','Fermer');
			
			a2.setAttribute('class','tpl_button_insert')
			a2.setAttribute('onclick','ajouter_dtl()');
			a2.setAttribute('type','button');
			a2.setAttribute('value','Ajouter');
			
			iDiv.setAttribute('id','ex_show_dtl');
			iDiv.setAttribute('style','padding:10px;')
			iDiv.setAttribute('align','right')
			
			spc.setAttribute('style','display:inline-block;width:15px');
			
			iDiv.appendChild(a2);
			// iDiv.appendChild(spc);
			// iDiv.appendChild(a1);
			
			if(nodes.length == 0)
			{
				$(target).html("<div class='title'>Detail de commande du PO N. "+num+"</div><table class='ticket_list'><tr class='altcol'><td class='align_center' style='width:100%' colspan='7'>Pas de r&eacute;sultat. Aucun enregistrement pour cette commande...</td></tr></table>");
				$(target).append(iDiv);
				color();
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
				
					
					tDiv.setAttribute('class','title');//parametrage de l'attribut classe de l'élément HTML tDiv (balise div contenant le titre du tableau)
					inner = document.createTextNode('Detail de commande du PO N. '+num);//création du texte à écrire à l'intérieur de tDiv
				
					tDiv.appendChild(inner);//ajout du texte dans le div tDiv
					oDiv.setAttribute('style','width:100%');
					oDiv.appendChild(tDiv);
				var th, tr, inner, Dinner;
			
				var tab = [];
				
			//---> définition des noms des en-tête de tableau
				tab[0] = "N."; tab[1] = "Marque - Modele"; tab[2] = "Quantite"; tab[3] = "Type"; tab[4] = "Fournisseur";
		
				//---> création de l'en-tête
				for(var i=0; i<attrs.length; i++)
				{
					th = document.createElement("th");
					if(i==attrs.length)
					{
						lgn.appendChild(th);
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
					tr.setAttribute('class','altcol');
					if($('#act').val() == '1') { tr.setAttribute('onclick','modifier_dtl(this)'); }
					
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
						}else if(i==attrs.length)
						{
							
						} 
						else {
							
							inner = document.createTextNode(nodes[j].attributes[i].nodeValue);
							td.appendChild(inner);
						}
						
						
						tr.appendChild(td);
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
				
				if($('#act').val() == '1') { $(target).append(iDiv); }
				
			}
			
			
			
			var i = 0;
			
			function color()
			{
				$('#tck_list td a').each(function(){
				if($(this).html() == num)
				{
					$(this).css('font-weight','bold').css('color','#f90');
				}else
				{
					$(this).css('font-weight','').css('color','');
				}
			});
			}
			color();

			if($(target).css('display') == 'none')
			$(target).slideDown(1000);
			
			// pagination('tck_list',10,'.navig_list_page','1');
			load_mat($('.a_mat'));

}