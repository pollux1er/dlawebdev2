var formulaire=document.getElementById('form_insert');
var resultats=document.getElementById('results');
var toptable=document.getElementById('resultstete');
var annuler=document.getElementById('annuler');
var entity=document.getElementById('tab_entity');
var reset=document.getElementById('reset');
var valider=document.getElementById('but_val');
var legend=document.getElementById('legend');
var titre=document.getElementById('div_eqp_equipment_title');
// var legendvalue= legend.innerHTML;
// var checkbox = resultats.getElementsByTagName('input');
var portV = document.getElementById("port_val");
var portVmat = document.getElementById("port_vmat");
var meth = document.getElementById("methode_action");
var supp = document.getElementById("supp");
 // resultats.onclick = function(){showDetail()}	;
var liste = document.getElementById('div_liste');
var ajouter =  document.getElementById('ajouter');
var sms = document.getElementById('reponse');
// var img_src =document.getElementById('img_plusminus').src;
var action = document.getElementById('act');
var module = document.getElementById('nom_module').value;
var form = document.getElementById('all_form');
var imgbz = document.getElementById('imgurl').value;
var liens = document.getElementById('hidden_link').value.split('-');

var act_lib = "";
var as = [];
as = document.getElementsByTagName('a');


	if ((module == 'Action')){
		for (var i=0; i<as.length; i++){
			if (as[i].title =='Gestion des actions'){
				as[i].className = "level2selected";
			}
		}
	}else if ((module == 'Menu')){
		for (var i=0; i<as.length; i++){
			if (as[i].title =='Gestion des menus'){
				as[i].className = "level2selected";
			}
		}
	}else if ((module == 'Groupe')){
		for (var i=0; i<as.length; i++){
			if (as[i].title =='Gestion des groupes'){
				as[i].className = "level2selected";
			}
		}
	}else if ((module == 'Droit')){
		for (var i=0; i<as.length; i++){
			if (as[i].title =='Gestion des droits'){
				as[i].className = "level2selected";
			}
		}
	}else if ((module == 'User')){
		for (var i=0; i<as.length; i++){
			if (as[i].title =='Gestion des users'){
				as[i].className = "level2selected";
			}
		}
	}else if ((module == 'Client')){
		for (var i=0; i<as.length; i++){
			if (as[i].title =='Gestion des clients'){
				as[i].className = "level2selected";
			}
		}
	}else if ((module == 'Commande')){
		for (var i=0; i<as.length; i++){
			if (as[i].title =='Gestion des commandes'){
				as[i].className = "level2selected";
			}
		}
	}else if ((module == 'Fournisseur')){
		for (var i=0; i<as.length; i++){
			if (as[i].title =='Gestion des fournisseurs'){
				as[i].className = "level3selected";
			}
		}
	}else if ((module == 'Localisation')){
		
		for (var i=0; i<as.length; i++){
			if (as[i].title =='Gestion des localisations'){
				as[i].className = "level2selected";
			}
		}
	}else if ((module == 'Batiment')){

		for (var i=0; i<as.length; i++){
			if (as[i].title =='Gestion des batiments'){
				as[i].className = "level3selected";
			}
		}
	}else if ((module == 'Site')){
		for (var i=0; i<as.length; i++){
			if (as[i].title =='Gestion des sites'){
				as[i].className = "level3selected";
			}
		}
	}else if ((module == 'Departement')){
		for (var i=0; i<as.length; i++){
			if (as[i].title =='Gestion des departements'){
				as[i].className = "level3selected";
			}
		}
	}else if ((module == 'Direction')){
		for (var i=0; i<as.length; i++){
			if (as[i].title =='Gestion des directions'){
				as[i].className = "level3selected";
			}
		}
	}else if ((module == 'Materiel')){
		for (var i=0; i<as.length; i++){
			if (as[i].title =='Gestion du materiel'){
				as[i].className = "level2selected";
			}
		}
	}else if ((module == 'Type')){
		for (var i=0; i<as.length; i++){
			if (as[i].title =='Gestion des types'){
				as[i].className = "level3selected";
			}	
		}
	}else if ((module == 'Statut')){
		for (var i=0; i<as.length; i++){
			if (as[i].title =='Gestion des statuts'){
				as[i].className = "level3selected";
			}
		}
	}


tabimg = document.getElementById('tab_entity').getElementsByTagName('img');


function reset_names(t){
	var parent = t.parentElement;
	parent.getElementsByTagName('input')[0].value = "";
}


inputs = document.getElementById('tab_entity').getElementsByTagName('input');
ths = toptable.getElementsByTagName('th');


var names = [];
  var a = 0;  
for (var i = 0 ; i < ths.length-1; i++) {
	var pt = ths[i].getElementsByTagName('a')[0];
	names.push(trim($(pt).text()));
	
	if (ths[i].style.display == "none"){ 
		continue;
	} else { a++;}
}



function research(){
meth.value='rechercher';
document.getElementById('form_rech').submit();

}

 var mot;
function modifier(ligne) {
	if ((meth.value =='') || (meth.value=='Ajouter '+module)){
		for(var i=1; i<names.length; i++){
			
			mot = names[i];
			// alert(mot);
			document.getElementById(mot).disabled="disabled";
		}
		reset.style.display = 'none'; 
		annuler.style.display = 'none';
		valider.value = 'Nouveau '+module;
		for(var i=0; i<tabimg.length; i++){
			tabimg[i].style.display = 'none';
		}
	}
	
	tds = ligne.getElementsByTagName('td');
	portV.value = $(tds[0]).text();
	$('#Code').val(tds[0].innerHTML);
	
	for(var i=1; i<tds.length-1; i++){
		document.getElementById(names[i]).value = $(tds[i]).text();
	}
	
	if(module == "User")
	{
		maj_priv($(tds[0]).text(), 'mod_body');
		$('#pass_recup').val($('#Password').val());
	}
}


function resetMethod(){
		meth.value = "";
}

function formulaire(){
	alert("formulaire "); 
	document.getElementsByName("id")[0].value = "";
}

function showAjout(){
	 	if (reset.style.display == 'none') {
			annuler.style.display = '';
			valider.style.display = ''; 
			reset.style.display = '';
			}
	valider.value = "Ajouter "+module;
    for(var i=0; i<tabimg.length; i++){
			tabimg[i].style.display = '';
		}
		
	for(var i=1; i<names.length; i++){
		document.getElementById(names[i]).disabled = '';
	}
}
	
function showMod(){
	
	if (reset.style.display == '') {
			reset.style.display = 'none';
		}
	if (valider.style.display == 'none'){
		valider.style.display = '';
	}
	
	annuler.style.display = '';
	valider.value = "Modifier "+module;
	
     for(var i=0; i<tabimg.length; i++){
			tabimg[i].style.display = '';
		}
		
	for(var i=1; i<names.length; i++){
	
		document.getElementById(names[i]).disabled = '';
	}
	
}

function showSupp(){
	 if ( !(reset.style.display == 'none')) {
       reset.style.display = 'none';
	   }
	if (valider.style.display==''){
	   annuler.style.display = 'none'; 
	   $(valider).css('visibility','hidden'); 
		}
	
	
	for(var i=0; i<tabimg.length; i++){
			tabimg[i].style.display = 'none';
		}
		for(var i=1; i<names.length-1; i++){
			document.getElementById(names[i]).disabled = 'disabled';
			
		}
}


function resetAjout(){
	for(var i=1; i<names.length; i++){
			document.getElementById(names[i]).value = '';
		}
}


function supprimer_form(ligne){
	Pparent = (ligne.parentElement).parentElement; 
	modifier(Pparent);
	meth.value = "supprimer";
	showSupp();
	Check = confirm("Vous etes sur le point d'effectuer une suppression! Etes vous sur de vouloir continuer ?"); 
	if(Check == false){
		valider.value = "Nouveau "+module;
		alert("Suppression annulee");
		$(valider).css('visibility','visible');
	} else {
		$('#but_val').val("Supprimer "+module);
		$('#but_val').trigger('click');
	}
}

function page_info( act){
	tab = [];
	tab[0] = portV.value;
	tab[1] = portVmat.value;

	var InfoWin = window.open ("info_just/" + tab[0]+"-"+tab[1]+"-"+act, "Info de justification", config='height=700px, width=500px, toolbar=no, menubar=no, scrollbars=no, resizable=no, location=no, directories=no, status=no');

}


function ajouter_form(){
	
	// sms.style.display= 'none';
	// if ((entity.style.display == 'none')){
		// entity.style.display = 'block';
	// }
	
	resetAjout();
	meth.value = "ajouter";
	// alert(meth.value);
	// titre.innerHTML = "Ajouter "+module;

	showAjout();
}

function modifier_form(){
	
	meth.value = "modifier";
	showMod();
		
}

function annuler_form(){
	meth.value = '';
	$(reset).hide();
	// resetAjout();
	for(var i=1; i<names.length; i++){
			document.getElementById(names[i]).disabled="disabled";
		}
		
	for(var i=0; i<tabimg.length; i++){
			tabimg[i].style.display = 'none';
		}
	$('#but_val').val('Nouveau '+module);
	$('#annuler').hide();
	
	if(module == "User")
	{
		$('#mod_body input:checkbox').each(function(){
			this.checked = false;
		});
	}
	
	// alert();
}

function valider_form(){
	if ((module == "Materiel") && (meth.value == "modifier")){
		
		if((document.getElementById("Statut : ").value != "Spare")){
			Check1 = prompt("Il s'agit d'une modification de statut. Veuillez entrer le numero de ticket : ","")
				if ((Check1 != "") && (Check1 != null)){
					document.getElementById('hidden_ticket').value = Check1;
					document.getElementById('form_insert').submit();
					return false;
				}else {
					alert(Check1+"Operation annulée (Mauvaise entree ou annulation volontaire)");
					location.reload();
				}
		}else{
			document.getElementById('form_insert').submit();
			return false;
		}
	}else{
		document.getElementById('form_insert').submit();
		return false;
	}
}

/****************/
/**Tris --- filtre **/
/****************/

 var filtre_val = document.getElementById('tri');
 if ((module =="Action") || (module =="Groupe") || (module =="Menu") ){
	document.getElementById('tri_el').style.display = "none";
	document.getElementById('rech_el').style.display = "none";
 }else  

 
if (document.getElementsByName('reponse').length > 1){
	if (document.getElementsByName('reponse')[1].style.display == "block"){
		document.getElementById('tri_rech').style.display = "none";
	}
}


 // filtre_val.onchange = function(){document.getElementById('form_tri').submit();}
/****************/

// showDetail();
// alert(meth.value);