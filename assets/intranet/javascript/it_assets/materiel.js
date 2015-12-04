var type = document.getElementById('Type : ');
var module = document.getElementById('nom_module').value;
var imgstat = document.getElementById("img_statut");
var stat = document.getElementById('Statut : ');
var imgbz = document.getElementById('imgurl');
var client = document.getElementById('Nom Client : ');
var other = document.getElementById('other_clt');
var toptable=document.getElementById('resultstete');

client.onchange = function(){show_hide_autre();}

type.onchange = function(){set_name_mat();}

function show_hide_autre(){
	if ((client.value == "autre")){
		Check = confirm("S'agit-il d'un nouveau client (nouvel employé)");
		other.style.display = "";
		if (Check == true){ 
			stat.value = '';
			imgstat.src =imgbz.value+"it_assets/notif.png";
			imgstat.title = 'Faites un choix';
			stat.value = 'Déclassé';
			imgstat.src =imgbz.value+"it_assets/circle_grey.png";
			imgstat.title = '';
		}
	}else if (client.value == "Laboratoire "){
		stat.value = '';
		imgstat.src =imgbz.value+"it_assets/notif.png";
		imgstat.title = 'Faites un choix';
	}else if (client.value != "autre"){
		if (other.style.display == ""){
			other.value = "";
			other.style.display = "none";
		}
		if  ((stat.value != "Production") && (stat.value != "Emprunt")){
			stat.value = '';
			imgstat.src =imgbz.value+"it_assets/notif.png";
			imgstat.title = 'Faites un choix';
		}
		
	}
}

ths = toptable.getElementsByTagName('thead')[0].getElementsByTagName('th');



var names = [];
    
for (var i = 0 ; i < ths.length; i++) {
	names.push(ths[i].innerHTML);
}

var nbrlgs = (document.getElementById('content').value)-1;

if(nbrlgs >= 0){ 
	var result = document.getElementById('results');
	var lastligne = result.getElementsByTagName('tbody')[0].getElementsByTagName('tr')[nbrlgs].getElementsByTagName('td')[0].innerHTML;
}else{}
		
var nbr = document.getElementById('nbr_el');
var compt = document.getElementById('content');

document.getElementById("gene_mat").onclick = function(){generer_nom_mat();};

function generer_nom_mat(){
	Check = confirm("Voulez-vous genere un nom de materiel ?");
	if (Check == true) set_name_mat();
}

function show_statut(){
	
	refresh_status();
	if (stat.value == "Production"){
		if ((client.value == "Laboratoire ") || (client.value == "autre")){
			client.value = '';
		
		}
		
		if  ((client.value != "autre")) other.style.display = "none";
		if ((document.getElementById("Nom Materiel : ").value.substr(0,7) == "inconnu")){
				// alert("gaga");
				generer_nom_mat();
			}
		
		for (var i = 0; i<labels.length; i++){
			if ((labels[i].innerHTML == 'Date Emprunt : ') || (labels[i].innerHTML == 'Date Retour : ')){
				labels[i].parentElement.parentElement.style.display = 'none';
			}
		}	
		
		} else 
	if (stat.value == "Emprunt"){
		if ((client.value == "Laboratoire ") || (client.value == "autre")){
			client.value = '';
		}
		
		labels = document.getElementsByTagName('label');
		for (var i = 0; i<labels.length; i++){
			if ((labels[i].innerHTML == 'Date Emprunt : ') || (labels[i].innerHTML == 'Date Retour : ')){
				labels[i].parentElement.parentElement.style.display = '';
			}
		}	
		
		document.getElementById('Date Emprunt : ').value = '';
		document.getElementById('Date Retour : ').value = '';
			
		if ((document.getElementById("Nom Materiel : ").value.substr(0,7) == "inconnu")){
			generer_nom_mat();
		}
		
		
		
	}else
	if((stat.value == "En panne") || (stat.value == "Déclassé")){
		client.value = 'Laboratoire ';
		if  ((client.value != "autre")) other.style.display = "none";
		for (var i = 0; i<labels.length; i++){
			if ((labels[i].innerHTML == 'Date Emprunt : ') || (labels[i].innerHTML == 'Date Retour : ')){
				labels[i].parentElement.parentElement.style.display = 'none';
			}
		}	
	}else
	if(stat.value == "Mis En Rebut"){
		client.value = 'autre';
		document.getElementById("Nom Materiel : ").value = "";
		other.style.display = "";
		for (var i = 0; i<labels.length; i++){
			if ((labels[i].innerHTML == 'Date Emprunt : ') || (labels[i].innerHTML == 'Date Retour : ')){
				labels[i].parentElement.parentElement.style.display = 'none';
			}
		}	
	}else
	if (stat.value == "Spare"){
		client.value = 'Laboratoire ';
		if  ((client.value != "autre")) other.style.display = "none";
		for (var i = 0; i<labels.length; i++){
			if ((labels[i].innerHTML == 'Date Emprunt : ') || (labels[i].innerHTML == 'Date Retour : ')){
				labels[i].parentElement.parentElement.style.display = 'none';
			}
		}	
	}
}

//Fonction de rafraichissemet des icone de statuts....
function refresh_status(){
	if(stat.value == "Production"){
		imgstat.src =imgbz.value+"it_assets/circle_green.png";
		imgstat.title = '';
		
	}else
	if(stat.value == "En panne"){
		imgstat.src =imgbz.value+"it_assets/circle_red.png";
		imgstat.title = '';
	}else
	if(stat.value == "Déclassé"){
		imgstat.src =imgbz.value+"it_assets/circle_orange.png";
		imgstat.title = '';
	}else
	if(stat.value == "Mis En Rebut"){
		imgstat.src =imgbz.value+"it_assets/circle_grey.png";
		imgstat.title = '';
		
	}else
	if(stat.value == "Emprunt"){
		imgstat.src =imgbz.value+"it_assets/circle_blue.png";
		imgstat.title = '';
		
	}else
	if (stat.value == "Spare"){
		imgstat.src =imgbz.value+"it_assets/circle_yellow.png";
		imgstat.title = '';
	}else 
	if (stat.value == ''){
		imgstat.src =imgbz.value+"it_assets/notif.png";
		imgstat.title = 'Faites un choix';
	}
	if (imgstat.style.display == "none"){
		imgstat.style.display ="";
		if ((client.value == "Laboratoire ") || (client.value == "autre")){
			client.value = '';
		}
	}
}

stat.onchange = function(){show_statut();}

//génération automatique des noms de machine
function set_name_mat(){
	if(document.getElementById('methode_action').value == 'ajouter'){
		$('Nom Materiel : ').value = "";
	}else{
	
				var find = false;
				var init =0;
				if ((type.value == "UNITE CENTRALE") || (type.value == "LAPTOP") || (type.value == "WORKSTATION")){var cut = "DLAPC", id =5;}
				if (type.value == "ECRAN TFT 17P"){var cut = "ECR17P", id =6;}
				if (type.value == "ECRAN TFT 19P"){var cut = "ECR19P", id =6;}
				if (type.value == "ECRAN TFT 21P"){var cut = "ECR21P", id =6;}
				if (type.value == "ECRAN TFT 22P"){var cut = "ECR22P", id =6;}
				if (type.value == "ECRAN TFT 23P"){var cut = "ECR23P", id =6;}
				if (type.value == "IMPRIMANTE A JET D'ENCRE") {var cut = "IMPJE", d =5;}
				if (type.value == "ECRAN CATHODIQUE"){var cut = "IMPCA", id =5;}
				if (type.value == "IMPRIMANTE LASER"){var cut = "IMPLA", id =5;}
				if (type.value == "IMPRIMANTE MATRICIELLE"){var cut = "IMPMA", id =5;}
				if (type.value == "IMPRIMANTE PORTATIVE"){var cut = "IMPPO", id = 5;}
				if (type.value == "VIDEOPROJECTEUR"){var cut = "VDP", id =3; }
				if (type.value == "MULTIFONCTION"){var cut = "MFN", id =3; }
				if (type.value == "COPIEUR"){var cut = "COPR", id =4;}
				
				if (compt.value != 0){
					while (find == false)
					{
						init++
						for (i=0; i<compt.value; i++){
							if (result.getElementsByTagName('tbody')[0].getElementsByTagName('tr')[i].getElementsByTagName('td')[3].innerHTML.substr(0,id)==cut){
								// alert(cut);
								// alert(result.getElementsByTagName('tbody')[0].getElementsByTagName('tr')[i].getElementsByTagName('td')[3].innerHTML.substr(0,id));
								var num = parseInt(result.getElementsByTagName('tbody')[0].getElementsByTagName('tr')[i].getElementsByTagName('td')[3].innerHTML.substr(id));
								if (init == num){
									break;
								}else 
								if ((i == compt.value-1) && (init != num)){
										find = true;
										break;
									}
							} else {
							if (i==compt.value - 1){
									find = true;
									break;
								}
							continue;}
						}
					}
					
						num = init;
						num2 = '000' + num;
						num2 = num2.substr(num2.length - 3);
						$('Nom Materiel : ').value = cut+num2;
					
					
				}else{
						$('Nom Materiel : ').value = cut+"001";

				}
			
	
	}
}




// alert(compt.value);
