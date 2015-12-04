function sup_cmd(po) {
	var xhr = getXMLHttpRequest();
	
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			sup(xhr.responseText);
		}
	};
	
	
	xhr.open("POST", "commande/ajax_sup_cmd", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("numeropo="+po/*+"&nbres="+nbres+"&types="+types*/);
}

function sup(data)
{
	$('#mess_text').html(data);
	$('#message').css('display','block');
	$('#ex_mess').hide();
	$('#idcomd').val('asc');
	$('#a_idcomd').trigger('click');
	window.setTimeout(function(){
		$('#message').fadeOut(); 
		$('#saisie input:text, #saisie select').val(""); 
		$('#det_comd input:text, #det_comd select').val(""); 
		$('#det_comd').fadeOut(); 
	}, 2000);
	load_mat($('.a_mat'));
}