function maj_pwd (a, b)
{
	var xhr = getXMLHttpRequest();
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			maj_p(xhr.responseText);
		}
	};

	xhr.open("POST", "ajax_maj_pass", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("id="+b+"&pswd="+a);
}

function maj_p(data)
{
	$('#mess_text').html(data);
	$('#message').show();
	$('#ex_mess').hide();
	window.setTimeout(function(){ $('#message').hide();}, 1500);
	window.setTimeout(function(){ $('#form_insert').submit();}, 2000);
}

