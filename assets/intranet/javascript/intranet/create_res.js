function post_els( f, r, b )
{
	var param = 	[ 
						{ "name":"sort" , value: $('#sort').val() },
						{ "name":"order" , value: $('#order').val() },
						{ "name":"limit" , value: $('#limit').val() },
						{ "name":"step" , value: $('#step').val() },
						{ "name":"id" , value: f}
					]
					
	$.post("reservation/rgform", param, function(data){
		if(data){
			
			var target = document.getElementById('showf');
			load_rw( data, target);
			
			var line = data.getElementsByTagName('line')[0];
			
			if( line.length != 0 )
			{
				var nblin = parseInt(line.attributes[0].nodeValue);
			
				if( (b == "yes") && ( ($('#new_form').css("visibility") == "hidden") || ($('#new_form').attr("style") == "visibility:hidden;") ) )
				{
					$(target.getElementsByTagName('tr')[nblin]).trigger('click');
				}
				
				var id = target.getElementsByTagName('tr')[nblin].getElementsByTagName('td')[0].innerHTML;
				$('#id').val(trim(id));
			}
			
			var stp = data.getElementsByTagName('step')[0];
			$('#step').val(stp.attributes[0].nodeValue);
			var step = parseInt(stp.attributes[0].nodeValue);
			
			var gDiv = target.parentElement.parentElement;
			var cDiv = gDiv.getElementsByTagName('div')[1].getElementsByTagName('div')[0];
			
			var nbr = data.getElementsByTagName('nbre')[0];
			$('#num_rows').val(nbr.attributes[0].nodeValue);
			$(cDiv).html( nbr.attributes[0].nodeValue+" &eacute;l&eacute;ment(s)" );
			var num = parseInt(nbr.attributes[0].nodeValue);
			var nav_target = gDiv.getElementsByTagName('div')[1].getElementsByTagName('div')[1];
			var limit = parseInt($('#limit').val());
						
			$(nav_target).html("");
					
			load_range(nav_target, limit, step, num, 'reservation_rgform');
		}
	}, "xml");
	
	
	var param1 = 	[ 
						{ "name":"sort1" , value: $('#sort1').val() },
						{ "name":"order1" , value: $('#order1').val() },
						{ "name":"limit1" , value: $('#limit1').val() },
						{ "name":"step1" , value: $('#step1').val() },
						{ "name":"id1" , value: r}
					]

	$.post("reservation/rgres", param1, function(Adata){
		if(Adata){
			
			var target = document.getElementById('show_res');
			load_rw( Adata, target);
			
			var line = Adata.getElementsByTagName('line')[0];
			var nblin = parseInt(line.attributes[0].nodeValue);
			
			if( ($('#id_res').val() != "") && ( !(isNaN($('#id_res').val()) ) ) )
			{
				$(target.getElementsByTagName('tr')[nblin]).attr('class','l_selected');
				
				window.setTimeout(function(){
					$(target.getElementsByTagName('tr')[nblin]).attr('class','altcol cmd');
				}, 30000);
			}
			
			var id = target.getElementsByTagName('tr')[0].getElementsByTagName('td')[0].innerHTML;
			$('#id1').val(trim(id));
			
			var nbr = Adata.getElementsByTagName('nbre')[0];
			$('#num_rows1').val(nbr.attributes[0].nodeValue);
			
			var stp = Adata.getElementsByTagName('step')[0];
			$('#step1').val(stp.attributes[0].nodeValue);
			
			var gDiv = target.parentElement.parentElement;
			var cDiv = gDiv.getElementsByTagName('div')[1].getElementsByTagName('div')[0];
			$(cDiv).html( nbr.attributes[0].nodeValue+" &eacute;l&eacute;ment(s)" );
			
			var nav_target = gDiv.getElementsByTagName('div')[1].getElementsByTagName('div')[1];
			var limit = parseInt($('#limit1').val());
			var step = parseInt(stp.attributes[0].nodeValue);
			var num = parseInt(nbr.attributes[0].nodeValue);
						
			$(nav_target).html("");
					
			load_range(nav_target, limit, step, num, 'reservation_rgres');
		}
	}, "xml");
}

function send_ok(a, b)
{
	// alert(a+" "+b);
	var xhr = getXMLHttpRequest();
	
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			if( xhr.responseText == "OK" )
			{
				$('#mess_text').html("<p>R&eacute;servation effectu&eacute;e avec succ&egrave;s</p>");
				window.setTimeout( function(){ $('#ex_mess').trigger('click'); }, 2000 );
			}
		}else{
			$('ex_mess').hide();
			$('#mess_text').html('<p>Envoi de la notification...</p><img src="'+$('#imgurl').val()+'24.gif'+'" />');
			$('#message').show();
		}
	};
		
	xhr.open("POST", "reservation/send_ok", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("0="+a+"&1="+b);
}

function create_res(a, b, c, d, e)
{
	var xhr = getXMLHttpRequest();
	
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			// alert(xhr.responseText);
			maj_reserv(xhr.responseXML);
		}else{
			$('#ex_mess').hide();
			if( e == "change")
			{
				$('#mess_text').html('<p>Mise &agrave; jour de la r&eacute;servation</p><img src="'+$('#imgurl').val()+'24.gif'+'">');
			}else{
				$('#mess_text').html('<p>Cr&eacute;ation d\'une r&eacute;servation</p><img src="'+$('#imgurl').val()+'24.gif'+'">');
			}
			
		}
	};
		
	xhr.open("POST", "reservation/createRes", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("0="+a+"&1="+b+"&2="+c+"&3="+d+"&4="+e);
}

function maj_reserv(edata)
{
	// alert(edata);
	
	var mess = edata.getElementsByTagName('message');
	var at = mess[0].attributes[0].nodeValue;
	var mailto = mess[0].attributes[1].nodeValue;
	var res = mess[0].attributes[2].nodeValue;
	var form = mess[0].attributes[3].nodeValue;
	
	if( (at != "OK") && (at != "maj") )
	{
		$('#mess_text').html("<p>"+at+"</p>");
		window.setTimeout( function(){ $('#ex_mess').trigger('click'); }, 2000 );
	}else{
		
		post_els( form, res, "yes" )
		
		if (at == "OK")
		{
			send_ok( mailto, res );
		}else if(at == "maj"){
			$('#mess_text').html("<p>Mise &agrave; jour effectu&eacute;e avec succ&egrave;s</p>");
			// $('#message').show()
			window.setTimeout( function(){ $('#ex_mess').trigger('click'); }, 2000 );
		}
	}
}

post_els( $('#id').val(), $('#id1').val(), "yes" )