var result = document.getElementById('content_tab_result');
var data = document.getElementById('content_result');
var target_tr = data.getElementsByTagName('tr');
var imgbz = document.getElementById('imgurl');
var bodytab=document.getElementById('results');


var liens = document.getElementById('hidden_link').value.split('-');

as1 = document.getElementById('left_men').getElementsByTagName('a');
as2 = document.getElementById('top_menu').getElementsByTagName('a');

//gestion des droits à la vue sur le menu de haut
var check = false
for (var j = 0; j < as2.length; j++){
	for (var i = 0; i < (liens.length - 1); i++){
		if (as2[j].title == liens[i]){
			check = true;
		}
	}  
	
	if (check == false){
		as2[j].parentElement.style.display = "none";
	}
}

//gestion des droits à la vue sur le menu de droite
var check = false
for (var j = 0; j < as1.length; j++){
	for (var i = 0; i < (liens.length - 1); i++){
		if (as1[j].title == liens[i]){
			check = true;
		}
	}  
	
	if (check == false){
		as1[j].parentElement.style.display = "none";
	}
}

var as = [];
as = document.getElementsByTagName('a');
for (var i=0; i<as.length; i++){
	if (as[i].title =='Historique'){
		as[i].className = "level2selected";
	}
}

var imgbz = document.getElementById('imgurl').value;
function showhide_criteria_more()
{
	if( document.getElementById('tr_criteria_more').style.display == 'none' )
	{
		 document.getElementById('tr_criteria_more').style.display = ''; 
		 document.getElementById('img_plusminus_criteria_more').src=imgbz+"b_minus.png";
	}
	else
	{
		 document.getElementById('tr_criteria_more').style.display = 'none'; 	
		 document.getElementById('img_plusminus_criteria_more').src=imgbz+"b_plus.png";
	}
}

// alert(document.getElementById('trouver').name);

var trs = document.getElementById('results').getElementsByTagName('tr');

if (document.getElementById('trouver').value == 'oui'){
	//document.getElementById('content_result').style.display = '';
	result.style.display = '';
	document.getElementById('nbr_el').innerHTML = trs.length+" &eacute;l&eacute;ment(s)";
}
//contenu de Info Materiel



function load_data(ligne){
	tds = ligne.getElementsByTagName('td');//recupere toute les cellules qui constituent la ligne selectionnée
	//alert(tds.length);
	var lgn_els = [];//liste d'elements relatifs a un materiel
	for (var i=1;i<13;i++){
		lgn_els.push(tds[i].innerHTML);
	}
//--> changement de CSS	
	if (result.className = "tab_result1"){
		result.className = "tab_result2";
		document.getElementById("resultstete").className = "tab_manip_ext tab_entet_rech_head";
		data.style.display = "";
	}
	var tab_matos = []; //liste d'elements à charger dans le tableau Info Materiel...
	var  list= document.getElementById('recherche_materiel').getElementsByTagName('input');
	for (var i=10;i<22;i++){
		tab_matos.push(list[i]);
	}

	for (var i = 0; i<12 ; i++){
		tab_matos[i].value=lgn_els[i];
	}

	for (var j = 0, i = 1; i<11 ; i++,j++){
		target_tr[i].getElementsByTagName('td')[1].innerHTML = tab_matos[j].value;
		
	}
	var image =  imgbz.value+tab_matos[11].value;
	image = image.split(" ");
	image = image[0]+image[1];
	
	//alert(image);
	document.getElementById('info_div').getElementsByTagName('img')[0].src = image;
	document.getElementById('info_div').getElementsByTagName('label')[0].innerHTML = tab_matos[10].value;

}

// alert(list[0]);
// alert(list[10]);
// alert(tab_matos.length);
// var list =  tab_matos[0].split (" ");
// for(var i; i<tab_matos.length;i++){
	// document.write(tab_matos[i]);
// }
