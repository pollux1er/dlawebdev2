var msg_info = document.getElementById('reponse');
if (msg_info.innerHTML == ""){
		msg_info.style.display = 'none';
	}


var act = document.getElementById('id_act').value;	

if (act == "ok"){
		window.close();
}
	
function ajouter_trac_form(){
	if (document.getElementById('val_info').value == ""){

		document.getElementById('val_info').value = 'valider';
	}
	document.getElementById('form_info').submit();
}

function hide_msg_info(){
	if (msg_info.innerHTML != ""){
		document.getElementById('reponse').style.display = 'none';
	}
}
document.getElementsByTagName('textarea')[0].innerHTML = document.getElementById('sup').value;
// document.write(act);