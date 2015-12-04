var formulaire=document.getElementById('insertion');
var resultats=document.getElementById('results');
var toptable=document.getElementById('resultstete');
//var annuler=document.getElementById('annuler');
var entity=document.getElementById('tab_entity');
var reset=document.getElementById('reset');
var valider=document.getElementById('valider');
var legend=document.getElementById('legend');
var titre=document.getElementById('div_eqp_equipment_title');
//var legendvalue= legend.innerHTML;
//var checkbox = resultats.getElementsByTagName('input');
var portV = document.getElementById("port_val");
var meth = document.getElementById("methode_action");
var fermer = document.getElementById("annuler");
var supp = document.getElementById("supp");
 //resultats.onclick = function(){showDetail()}	;
var liste = document.getElementById('div_liste');
var ajouter =  document.getElementById('ajouter');
var sms = document.getElementById('reponse');
var img_src =document.getElementById('img_plusminus').src;
var action = document.getElementById('act');

 if (!(action.value == 'action')){
	document.getElementById('tab_action').style.display = 'none'
 }
 
var url= img_src.split("/");
	var base = "";
	for (var i=0; i<7;i++){
		base= base+url[i]+'/';
	}
	
	var plus = base+'b_plus.png';
	var minus= base+'b_minus.png';

 function img_switch()
{
	if( $('action_sup').style.display == 'none' )
	{
		$('action_sup').style.display = ''; 
		$('img_plusminus').src=minus;
	}
	else
	{
		$('action_sup').style.display = 'none'; 	
		$('img_plusminus').src=plus;
	}
}
 
 function showDetail(){
	if (!(formulaire.style.display == 'block')) {
        //formulaire.style.display = 'none'; 
        formulaire.style.display = 'block'; }
		
	if (!(valider.style.display == 'none')) {
		reset.style.display = 'none'; 
		valider.style.display = 'none'; 
    } 
	
	resetAjout();
	// if (!(entity.style.display == 'none')) {
		// entity.style.display = 'none';
	// }	
	if (sms.innerHTML == ""){
		sms.style.display = 'none';
	}
    
	
	for(var i=1; i<names.length-1; i++){
			document.getElementById(names[i]).disabled = 'disabled';
			//alert('toti');
		}
	
	//legend.innerHTML = 'Détails';
	//titre.innerHTML = 'Détails';
}

function reset_names(t){
	var parent = t.parentElement;
	alert(parent.getElementsByTagName('input')[0].name);
	parent.getElementsByTagName('input')[0].value = "";
}

 function show_date(t)
 {
	var parent = t.parentElement;
	alert(parent.getElementsByTagName('input')[0].name);
 }
inputs = document.getElementById('tab_entity').getElementsByTagName('input');
ths = toptable.getElementsByTagName('thead')[0].getElementsByTagName('th');

var names = [];
    
for (var i = 0 ; i < ths.length; i++) {
	names.push(ths[i].innerHTML);
}



function name_focus1(){
	alert(document.getElementById(names[1]).name, document.getElementById(names[1]).value);
	document.getElementById(names[1]).focus();
	
}

function modifier(ligne) {
		entity.style.display='block';
		if (fermer.style.display='none'){
		fermer.style.display='block';
		}
		if (meth.value=='ajouter'){
			for(var i=1; i<names.length-1; i++){
			document.getElementById(names[i]).disabled = 'disabled';
			reset.style.display = 'none'; 
			valider.style.display = 'none'; 
			}
		}
		sms.style.display= 'none';
		tds = ligne.getElementsByTagName('td');
		for(var i=0; i<tds.length-1; i++){
			document.getElementById(names[i]).value = tds[i].innerHTML;
		}
		portV.value = tds[0].innerHTML;
	
}

function resetMethod(){
		meth.value = "";
}

function formulaire(){
	alert("formulaire "); 
	document.getElementsByName("id")[0].value = "";
}

function showAjout(){
	
	if (!(formulaire.style.display == 'block')) {
        formulaire.style.display = 'block';
		
     }
	 if (reset.style.display == 'none'/*annuler.style.display == 'none'*/) {
       /*annuler.style.display = 'submit';*/
	   reset.style.display = 'block';
	   valider.style.display = 'block'; 
    } 
	
		for(var i=0; i<names.length-2; i++){
			document.getElementById(names[i+1]).disabled = '';
			
		}
	
	//titre.innerHTML = "Ajouter client";
	// resetAjout();
}

function showSupp(){
	if (!(formulaire.style.display == 'block')) {
        formulaire.style.display = 'block';
     }
	 if ( reset.style.display = 'none'/*annuler.style.display == 'none'*/) {
       /*annuler.style.display = 'block';*/ 
	   valider.style.display = 'block'; 
    } 
	
		for(var i=1; i<names.length-1; i++){
			document.getElementById(names[i]).disabled = 'disabled';
			//alert('toti');
		}
	
	;

}


function closeAjout(){
	if (formulaire.style.display == 'block') {
        formulaire.style.display = 'none'; 
    } else {
        //formulaire.style.display = 'block'; 
    }
	
}

function resetAjout(){
	for(var i=0; i<names.length-1; i++){
			document.getElementById(names[i]).value = '';
		}
}

function test(name){
	var hid = document.getElementById("test");
	hid.value = name;
	alert(name);
}

function supprimer_form(){
	if (fermer.style.display='none'){
		fermer.style.display='block';
	}
	sms.style.display= 'none';
	if ((entity.style.display == 'none')){
		entity.style.display = 'block';
	}
	meth.value = "supprimer";
	titre.innerHTML = "Supprimer "+document.getElementById('nom_module').value;
	
	showSupp();
	
}

function b_annuler(){
	
	document.getElementById('tab_entity').style.display='none';
	if (!(valider.style.display == 'none')) {
		reset.style.display = 'none'; 
		valider.style.display = 'none'; 
	}
	sms.style.display= 'none';
	fermer.style.display='none';
}
function ajouter_form(){
	if (fermer.style.display='none'){
		fermer.style.display='block';
	}
	sms.style.display= 'none';
	if ((entity.style.display == 'none')){
		entity.style.display = 'block';
	}
	
	resetAjout();
	
	
	meth.value = "ajouter";
	titre.innerHTML = "Ajouter "+document.getElementById('nom_module').value;
	showAjout();

}

function modifier_form(){
	if (fermer.style.display='none'){
		fermer.style.display='block';
	}
	sms.style.display= 'none';
	if ((entity.style.display == 'none')){
		entity.style.display = 'block';
	}
	
	meth.value = "modifier";
	titre.innerHTML = "Modifier "+document.getElementById('nom_module').value;
	
	showAjout();
}

function annuler_form(){
	meth.value = "annuler";
	var input = document.getElementById("insertion").getElementsByTagName("input");
	for(var i=0; i<input.length; i++){
		input[i].disabled = "disabled";
	}
	var select = document.getElementById("insertion").getElementsByTagName("select");
	for(var i=0; i<select.length; i++){
		select[i].disabled = "disabled";
	}
	document.getElementById("form_insert").reset();
}

function selectAll(l1) {
  
  for (idx = 0 ; idx < l1.options.length ; idx++) {
    
    l1.options[idx].selected = true;  
  }
}

function check(check1){
if (check1.checked== true){
check1.checked= false;
}
	// ligne.style.background = "#e5f2f1";
// else
	// ligne.style.background = "#ccccff";
else{
	check1.checked= true;
	
	}
}

// partie réservée au calandrier
showDetail();
