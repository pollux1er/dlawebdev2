$(function(){

	$('#val_dtl').click(function(){
		valider_dtls($('#numpo').val(), $('#DMTS').val(), $('#datcom').val(), $('#etat').val(), $('#datliv').val(), $('#designation').val(), $('#init').val(), $('#val_cmd').val(), $('#sh_cmd'));
	});
});

function valider_dtls(o1, o2, o3, o4, o5, target)
{
	var xhr1 = getXMLHttpRequest();
	xhr1.onreadystatechange = function() {
		if (xhr1.readyState == 4 && (xhr1.status == 200 || xhr1.status == 0)) {
			charger_comd2(xhr1.responseText, target, o1);
		}
	};
	
	xhr1.open("POST", "commande/ajax_check_dtl", true);
	xhr1.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr1.send("0="+o0+"1="+o1+"&2="+o2+"&3="+o3+"&4="+o4+"&5="+o5);
}