// Chargement de la base user et affichage des elements de la selection
	function refresh( _param )
	{
		$.post( "user/ref_user", _param, function(data){
			alert("refresh"+data);
			if(data)
			{
				var target = document.getElementById('showf');
				load_rw( data, target );
				
				var nbr = data.nbre;
				$('#num_rows').val(nbr);
				
				var stp = data.step;
				$('#step').val(stp);
				
				$('.navig_nb_record').html( nbr+" &eacute;l&eacute;ment(s)" );
				
				var nav_target = document.getElementById('page_1');
				var limit = parseInt($('#limit').val());
				var step = parseInt(stp);
				var num = parseInt(nbr);
				
				$(nav_target).html("");
				
				load_range(nav_target, limit, step, num, "user");
			}
		}, "json");
	}

	$('body').click(function(){ $('#prop_user').fadeOut(); });
	
	function charger(li, ch)
	{
		if( isNaN(li.length))
		{
			var data = li.getElementsByTagName('input')[0].value; 
			$('#selected_user').val( data );
			var dt = data.split('@@');
			dt.push('');
		}else{
			var dt = li;
		}
		var content = [];
		// alert(dt[9]);
		content.push("<table class='form' style='width:90%;'><colgroup><col width=50%/><col width=50%/></colgroup><tbody>");
			content.push("<tr>");
				content.push("<td><b>Code user : "+dt[0]+"   </b></td><td ><b> NOM :   "+dt[1]+" "+dt[2]+" </b></td>")
			content.push("</tr>");
			content.push("<tr>");
				content.push("<td><b>D&Eacute;PARTEMENT : "+dt[3]+"   </b></td><td><b> FONCTION : "+dt[4]+"   </b></td>")
			content.push("</tr>");
			content.push("<tr>");
				content.push("<td><b>EMAIL :  "+dt[5]+"</b></td><td></td>")
			content.push("</tr>");
			content.push("<tr>");
				content.push("<td><b> Line Id :  "+dt[6]+" </b></td><td><b> RESPONSABLE :  "+dt[7]+" </b></td>");
			content.push("</tr>");
			content.push("<tr>");
				content.push("<td colspan='2' align='left'><b>VALIDEUR </b> &nbsp;&nbsp; <input id='vald' class='input_type' type='checkbox' "+( ( (dt[8] != "") && (dt[8] != "Non Valideur") ) ? "checked = true" : "" )+" /> </td>");
			content.push("</tr>");
			content.push("<tr>");
				content.push("<td colspan='2' align='left'><b>GESTIONNAIRE </b> &nbsp;&nbsp; <input id='gest' class='input_type' type='checkbox' "+( ( (dt[9] != "") && (dt[9] != "Non Gestionnaire") ) ? "checked = true" : "" )+" /> </td>");
			content.push("</tr>");
			content.push("<tr>");
				content.push("<td colspan='2' align='left'>");
					content.push("<input id='demd' class='input_type' type='radio' name='admin' style='margin:0px 0px 0px 0px;' checked/> <b>Demandeur</b>");
					content.push("<input id='gls' class='input_type' type='radio' name='admin' style='margin:0px 0px 0px 15px;' /> <b>Gestionnaire LS</b>");
					content.push("<input id='gestn' class='input_type' type='radio' name='admin' style='margin:0px 0px 0px 15px;' /> <b>Gestionnaire</b>");
					content.push("<input id='admn' class='input_type' type='radio' name='admin' style='margin:0px 0px 0px 15px;' /> <b>Administrateur</b>");
				content.push("</td>");
			content.push("</tr>");
			content.push("<tr>");
				content.push("<td colspan='2' align='right'><input id=\"insert_user\" class=\"tpl_button_insert\" type=\"button\" value=\""+ch+"\"/>&nbsp;&nbsp;<input id=\"ann_user\" class=\"button_action_ann\" type=\"button\" value=\"Annuler\" /></td>");
			content.push("</tr>");

		content.push('</tbody></table>');
		
		var cont = content.join("");
		
		$('#tab_chrg_info').html(cont);	
			
		$('#insert_user').click(function(){
			var mod = this.value; 
			
			var param = [];
			
			var data = $('#selected_user').val().split('@@');
			
			trs = document.getElementById('mod_body').getElementsByTagName('tr');
						
			mods_params = "";
			noeud = "";
			for(var i = 0; i < trs.length; i++)
			{
				tds = trs[i].getElementsByTagName('td');
				
				if( mod == "Modifier" )
				{
					mods_params += tds[0].getElementsByTagName('input')[2].value+',';
					mods_params += tds[0].getElementsByTagName('input')[1].value+',';
				}else{
					mods_params += tds[0].getElementsByTagName('input')[2].value+',';
				}
				
				if(tds[1].getElementsByTagName('input')[0].checked == true)
				{
					noeud = 1;
				}else{
					noeud = 0;
				}
				mods_params += noeud+',';
				
				if(tds[2].getElementsByTagName('input')[0].checked == true)
				{
					noeud = 1;
				}else{
					noeud = 0;
				}
				mods_params += noeud+'@';
			}
			
			// alert(mod);
			// alert(mods_params);
			// alert(data);
			
			param = [
						{"name": "id", value : $('#id').val() },
						{"name": "data", value : data},
						{"name": "mods", value : mods_params},
						{"name": "mod", value : mod },
						{"name": "valid", value : ( ( $('#vald').attr('checked') == true ) ? 1 : 0 )},
						{"name": "gest", value : ( ( $('#gest').attr('checked') == true ) ? 1 : 0 )}
					];
			
			$.post("user/ajax_check", param, function(Adata){
				if(Adata)
				{
					// alert(Adata);
					$('#mess_text').html(Adata);
					$('#message').css('display','block');
					$('#ex_mess').hide();
					window.setTimeout(function(){$('#message').fadeOut();} , 1500);
					
					var param1 = [
									{ "name":"limit", value: $('#limit').val() },
									{ "name":"sort", value: $('#sort').val() },
									{ "name":"order", value: $('#order').val() },
									{ "name":"id", value: $('#id').val() }
								]
					
					refresh( param1 );
				}
			}, "text");
		});
		
		$('#ann_user').click(function(){
			$('#tab_chrg_info').html('<p style="font-weight:bold;">Tapez le nom et/ou prénom de celui/celle que vous souhaitez ajouter à l\'application...</p>');
			$('#id').val("");
			$('#mod_body [name=first], #mod_body [name=second]').each(function(){
				$(this).attr('checked', false);
			});
		});
		
		$("#demd").click(function(){
			var trs = document.getElementById('mod_body').getElementsByTagName('tr');
			for( var i=0; i<trs.length; i++ )
			{
				if( trs[i].getElementsByTagName('td')[0].getElementsByTagName('input')[3].value == "reservation/MAD" )
				{
					$(trs[i].getElementsByTagName('td')[1].getElementsByTagName('input')[0]).attr('checked', true);
					$(trs[i].getElementsByTagName('td')[2].getElementsByTagName('input')[0]).attr('checked', true);
				}else{
					$(trs[i].getElementsByTagName('td')[1].getElementsByTagName('input')[0]).removeAttr('checked');
					$(trs[i].getElementsByTagName('td')[2].getElementsByTagName('input')[0]).removeAttr('checked');
				}
			}
		});
		
		$("#gls").click(function(){
			var trs = document.getElementById('mod_body').getElementsByTagName('tr');
			for( var i=0; i<trs.length; i++ )
			{
				if( trs[i].getElementsByTagName('td')[0].getElementsByTagName('input')[3].value != "user" )
				{
					$(trs[i].getElementsByTagName('td')[1].getElementsByTagName('input')[0]).removeAttr('checked');
					$(trs[i].getElementsByTagName('td')[2].getElementsByTagName('input')[0]).attr('checked', true);
				}else{
					$(trs[i].getElementsByTagName('td')[1].getElementsByTagName('input')[0]).removeAttr('checked');
					$(trs[i].getElementsByTagName('td')[2].getElementsByTagName('input')[0]).removeAttr('checked');
				}
			}
		});
		
		$("#gestn").click(function(){
			var trs = document.getElementById('mod_body').getElementsByTagName('tr');
			for( var i=0; i<trs.length; i++ )
			{
				if( trs[i].getElementsByTagName('td')[0].getElementsByTagName('input')[3].value != "user" )
				{
					$(trs[i].getElementsByTagName('td')[1].getElementsByTagName('input')[0]).attr('checked', true);
					$(trs[i].getElementsByTagName('td')[2].getElementsByTagName('input')[0]).attr('checked', true);
				}else{
					$(trs[i].getElementsByTagName('td')[1].getElementsByTagName('input')[0]).removeAttr('checked');
					$(trs[i].getElementsByTagName('td')[2].getElementsByTagName('input')[0]).removeAttr('checked');
				}
			}
		});
		
		$("#admn").click(function(){
			var inputs = document.getElementById('mod_body').getElementsByTagName('input');
			
			var check = [];
			for( var i = 0; i < inputs.length; i++ )
			{
				if( inputs[i].type == "checkbox" )
				{
					$(inputs[i]).attr( "checked", true);
				}
			}
		});
	}
	
	$('#name_user').keyup(function(){
		var a = this;
		var Pos = $(a).offset();
				
		if( $('#prop_user').length == 0 )
		{
			$("#body_content").append("<div id='prop_user' style='' ><div align='center' style='padding:10px;'><img src='"+$('#imgurl').val()+"23.gif' /></div></div>");
			$("#prop_user").css('display','block').css('left',Pos.left).css('top',Pos.top+20);
		}else{
			$('#prop_user').html("<div align='center' style='padding:10px;'><img src='"+$('#imgurl').val()+"23.gif' /></div>");
			$('#prop_user').fadeIn();
		}
			var param = [{'name': "name_user", value: a.value }];
		$.post( "user/staff_user", param, function(data){
			// alert(data);
			if(data)
			{
				var lin = data.getElementsByTagName('item');
				
				if( lin.length != 0 )
				{
					var ul = document.createElement('ul');
					ul.setAttribute('id','cont_li');
					
					for( var i = 0; i < lin.length; i++ )
					{
						var li = document.createElement('li');
							li.setAttribute("align","left");
							li.setAttribute("onclick","charger(this, \"Ajouter\");")
						
						var a = document.createElement('a');
							a.setAttribute("align","left");
							
						var span = document.createElement('span');
							span.setAttribute("align","left");
							
						var text = document.createTextNode(lin[i].attributes[1].nodeValue+" "+lin[i].attributes[2].nodeValue);
						var inp = document.createElement('input');
							inp.setAttribute("id","user_"+i);
							inp.setAttribute("type","hidden");
							inp.setAttribute("value",lin[i].attributes[0].nodeValue+"@@"+lin[i].attributes[1].nodeValue+"@@"+lin[i].attributes[2].nodeValue+"@@"+lin[i].attributes[3].nodeValue+"@@"+lin[i].attributes[4].nodeValue+"@@"+lin[i].attributes[5].nodeValue+"@@"+lin[i].attributes[6].nodeValue+"@@"+lin[i].attributes[7].nodeValue);
							
							span.appendChild(text);
							a.appendChild(span);
							a.appendChild(inp);
							li.appendChild(a);
							
							ul.appendChild(li);
					}
					
					$('#prop_user').html(ul);
					
				}else{
					$('#prop_user').fadeOut();
				}
			}
		}, "xml");
	});
	
//--->fin section

function load_rw( data, Ac )
{
	// alert("load_rw"+data);
	$(Ac).html("<tr><td colspan='8' align='center'> <img src='"+$('#imgurl').val()+"12.gif' > </td></tr>");
	var nodes = data.results;
	
	var content = [];
	if( data.success )
	{
		var ind_id = nodes[0][0];
		$('#id').val(ind_id);
		for( var i = 0 ; i < nodes.length ; i++ )
		{
			content.push('<tr class="altcol" onclick="modifier(this)" >');
			var tds = nodes[i];
			for ( var j = 0; j < tds.length; j++ )
			{
				content.push('<td align="center" ');
				if( (j == 0) || (j == 1) || (j == 2) || (j == 3) ||(j == 9) )
				{
					content.push(' style="display:none;" ');
				}
				
				content.push('>'+(tds[j])+'</td>');
			}
			content.push(" 	<td align='center' name=\"act_butt\" style=\"background-color:lightgray;\">"+
								"<img class=\"\" title=\"Supprimer\" src=\""+$('#imgurl').val()+('auto/supprimer_icone.png')+"\" border=\"\" name=\""+tds[0]+"\" onclick=\"supprimer_form("+tds[0]+"); return false;\" >"+   
							"</td>"
						);
			content.push('</tr>')
		}
		
		var cont = content.join("");
		content = null;		
		
		$(Ac).html( cont );
		
		$(Ac.getElementsByTagName('tr')[0]).trigger('click');
	} else {
		content.push('<tr class="" ><td colspan="8" align="center"> Aucun enregistrement </td></tr>');
		
		var cont = content.join("");
		content = null;	
		$(Ac).html( cont );
	}
}

function close_spl()
{
	$("#div_spl").fadeOut();
	$('.filtre').removeAttr('style');
	$('.excel').removeAttr('style');
}

function extract(a)
{
	var td = a.parentElement;
	
	var tr = td.parentElement;
	
	var tbody = tr.parentElement;
	
	var chkbx = tbody.getElementsByTagName('input');
	var name = "";
	var label = "";
	for( var i = 0; i < chkbx.length; i++ )
	{
		if( chkbx[i].type == "checkbox" )
		{
			if( chkbx[i].checked )
			{				
				name += chkbx[i].name+";";
				label += chkbx[i].value+";";
			}	
		}
	}
	
	var param = [
					{ "name":"limit", value: $('#limit').val() },
					{ "name":"sort", value: $('#sort').val() },
					{ "name":"order", value: $('#order').val() },
					{ "name":"nom", value:$('#r_nm').val() },
					{ "name":"dep", value:$('#r_dep').val() },
					{ "name":"champs", value:name },
					{ "name":"label", value:label }
				]
	$.post( "user/extract", param, function(data){
		if(data)
		{
			// alert(data);
			window.open(data); 
		}
	}, "text");
}

function find()
{
	// alert();	
	// initialisation des champs hidden contenant les parametres de recherche...
		// alert( $('#dep').val() );
		$('#r_nm').val( $('#f_nom').val() );
		$('#r_dep').val( $('#dep').val() );
	//==========================================================================
	
	var param = [
					{ "name":"limit", value: $('#limit').val() },
					{ "name":"sort", value: $('#sort').val() },
					{ "name":"order", value: $('#order').val() },
					{ "name":"nom", value:$('#f_nom').val() },
					{ "name":"dep", value:$('#dep').val() }
				]
	
	refresh( param );	
	window.setTimeout(function(){ $('#ex_mess').click() }, 2000);
}

function filtre(a)
{
	if( $('#div_spl').length == 0 )
	{
		$('#body_content').append("<div id='div_spl' align='center'></div>");
	}
	
	$(a).attr("style","background-color:gray; color:white; ");
	$('.excel').removeAttr('style');
	var pos = $(a.parentElement).offset();
	
	
	$('#div_spl').css('top',pos.top+20).css('left',pos.left).fadeIn('slow');
	
	var cont = [];
	cont.push( "<table class='form' style='margin:20px; max-width:300px;'><colgroup><col width='30%' /><col width='70%' /></colgroup>" );
		cont.push("<tr><td align='left' class='label' style='padding-left:10px;'> User : </td><td align='left' style='padding-left:20px;'><input id='f_nom' type='text' class='input_type'/></td></tr>");
		cont.push("<tr><td align='left' class='label' style='padding-left:10px;'> Département : </td><td align='left' style='padding-left:20px;'><select id='dep' class='input_type'>");
			cont.push("<option></option>");
		cont.push("</select></td></tr>");
		cont.push("<tr><td colspan='2' align='center'> <input type='button' value='Chercher' class='tpl_button_neutral' onclick='find();'/>&nbsp;&nbsp;<input type='button' value='Fermer' class='tpl_button_neutral' onclick='close_spl();'/> </td></tr>");
	cont.push("</table>");
	
	var content = cont.join("");
	
	$('#div_spl').html(content);
	
	$.post('user/dept',[],function(data){
		if(data)
		{
			var items = data.getElementsByTagName('item');
			
			for( var i = 0; i<items.length-1; i++ )
			{
				$('#dep').append("<option value='"+items[i].attributes[0].value+"' > "+items[i].attributes[1].value+" </option>");
			}
		}
	}, "xml");
}

function get_csv(a)
{
	var names = [];
	var input_names = [];
	var ths = document.getElementById('tck_list').getElementsByTagName('thead')[0].getElementsByTagName('th');
	
	for( var i = 0; i < ths.length-1; i++ )
	{
		names.push( ths[i].getElementsByTagName('a')[0].innerHTML );
		input_names.push( ths[i].getElementsByTagName('input')[0].name );
	}

	
	if( $('#div_spl').length == 0 )
	{
		$('#body_content').append("<div id='div_spl' align='center'></div>");
	}
	
	$(a).attr("style","background-color:gray; color:white; ");
	$('.filtre').removeAttr('style');
	var pos = $(a.parentElement).offset();
	
	
	$('#div_spl').css('top',pos.top+20).css('left',pos.left).fadeIn('slow');
	
	var cont = [];
	cont.push( "<table class='form' style='margin:20px; max-width:500px;'><colgroup><col width='50%' /><col width='50%' /></colgroup>" );
		var j = 0;
		for(var i = 0; i<names.length; i++)
		{
			if( j == 2 )
			{
				j = 0;
				cont.push("</tr><tr>");
			}
			
			cont.push("<td class='label' align='left' style='padding-left:20px; vertical-align:middle;'> <input style='vertical-align:middle; margin-right:15px;' type='checkbox' name='"+input_names[i]+"' value='"+names[i]+"'/> "+names[i]+" </td>");
			
			if( i == names.length-1 )
			{
				cont.push("</tr>");
			}
			
			j++;
		}
		cont.push("<tr><td colspan='2' align='center'> <input type='button' value='Extraire' class='tpl_button_neutral' onclick='extract(this)'/>&nbsp;&nbsp;<input type='button' value='Fermer' class='tpl_button_neutral' onclick='close_spl();'/> </td></tr>");
	cont.push("</table>");
	
	var content = cont.join("");
	
	$('#div_spl').html(content);
}

function maj(data, oCible)
{
	// if( isNaN(li.length))
	// {
	
	// }
	
	// alert(isNaN(data.length));
	var trs = document.getElementById(oCible).getElementsByTagName('tr');
	
	var nodes = data.getElementsByTagName("item");
	
	for(var j=0; j<nodes.length; j++)
	{
		mod_intels = nodes[j].attributes[0].nodeValue; 
		els = mod_intels.split('-');
		nom = els[1];
		
		for(var i=0; i<trs.length; i++)
		{
			var tds = trs[i].getElementsByTagName('td');
			if(tds[0].getElementsByTagName('input')[2].value == nom)
			{
				tds[0].getElementsByTagName('input')[1].value = nodes[j].attributes[1].nodeValue;
				
				if(nodes[j].attributes[2].nodeValue != '0')
				{
					tds[1].getElementsByTagName('input')[0].checked = true;
				}else{
					tds[1].getElementsByTagName('input')[0].checked = false;
				}
				
				if(nodes[j].attributes[3].nodeValue != '0')
				{
					tds[2].getElementsByTagName('input')[0].checked = true;
				}else{
					tds[2].getElementsByTagName('input')[0].checked = false;
				}
			}
		}
	}
}

function refresh_mod ( r_data )
{
	$.post("user/maj_priv", r_data, function(Adata){
		if(Adata)
		{
			maj( Adata, "mod_body" );
		}
	}, "xml");
}

function modifier( line )
{
	$('#mod_body [name=first], #mod_body [name=second]').each(function(){
		$(this).attr('checked', false);
	});
	line_color(line, 'tck_list');
	var l = line.getElementsByTagName("td");
	$('#id').val(l[0].innerHTML);
	var data = [];
	
	data[0] = l[1].innerHTML;
	data[1] = l[4].innerHTML;
	data[2] = l[5].innerHTML;
	data[3] = l[6].innerHTML;
	data[4] = l[7].innerHTML;
	data[5] = l[8].innerHTML;
	data[6] = l[9].innerHTML;
	data[7] = l[10].innerHTML;
	data[8] = l[11].innerHTML;
	data[9] = l[12].innerHTML;
	
	$('#selected_user').val(data);

	charger( data, "Modifier" );
	
	var param = [ { "name": "0" , value: $("#id").val()} ];
	refresh_mod ( param );
}

function supprimer_form( el )
{
	var check = confirm('Voulez vous vraiment supprimer cet utilisateur ?');
	
	var param = [
					{"name": "id", value : el },
					{"name": "mod", value : "Supprimer" }
				];
		
	$.post("user/ajax_check", param, function(Adata){
		if(Adata)
		{
			$('#mess_text').html(Adata);
			$('#message').css('display','block');
			$('#ex_mess').hide();
			// window.setTimeout(function(){$('#message').fadeOut();} , 1500);
			
			var param1 = [
							{ "name":"limit", value: $('#limit').val() },
							{ "name":"sort", value: $('#sort').val() },
							{ "name":"order", value: $('#order').val() }
						]
			
			refresh( param1 );
		}
	}, "text");
	
	return false;
}

// Section gestion des modules //

// section cocher modification et lecture //
	
	function val_mod_1(entity, data, g)
	{
		var post = "entity="+entity+"&";
		
		// alert(data.length);
		for (var i = 0; i < data.length; i++)
		{
			post += i+"="+data[i]+'&';
		}
		post = post+'val='+g;
		
		var xhr = getXMLHttpRequest();
		
		xhr.onreadystatechange = function() {
			if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
				mod_1(xhr.responseText); //recupération de la reponse sous forme texte et envoi en parametre à la fonction de test de validité
			}
		};
		// alert(post);
		xhr.open("POST", "user/ajax_module", true);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.send(post);
	}

	function mod_1(Qdata)
	{	
		var param = [];
		if(Qdata == "1")
		{
			$('#mess_text').html("<p>Ajout effectu&eacute; avec succ&egrave;s</p>");
			$('#message').css('display','block');
			$('#ex_mess').hide();
			window.setTimeout(function(){$('#message').fadeOut();} , 1500);
			window.location.reload(); 
		}else if(Qdata == "2")
		{
			$('#mess_text').html("<p>Modification effectu&eacute;e avec succ&egrave;s</p>");
			$('#message').css('display','block');
			$('#ex_mess').hide();
			window.setTimeout(function(){$('#message').fadeOut();} , 1500);
			window.location.reload(); 
		}else if(Qdata == "3")
		{
			$('#mess_text').html("<p>Suppression effectu&eacute;e avec succ&egrave;s</p>");
			$('#message').css('display','block');
			$('#ex_mess').hide();
			window.setTimeout(function(){$('#message').fadeOut();} , 1500);
			window.location.reload(); 
		}else
		{
			$('#mess_text').html(Qdata);
			$('#message').css('display','block');
			$('#ex_mess').show();
		}
	}
	
	function first_(e){
		second = e.parentElement.parentElement.getElementsByTagName('td')[2].getElementsByTagName('input')[0];
		if(e.checked == true)
		{
			second.checked = true;
		}else{
			second.checked = false;
		}
	};

	function second_(e){
		first = e.parentElement.parentElement.getElementsByTagName('td')[1].getElementsByTagName('input')[0];
		if(e.checked == false)
		{
			first.checked = false;
		}
	};
	
	function move(a)
	{
		Pos = $(a).offset();
		$('#option_mod').css('display','block').css('left',Pos.left+22).css('top',Pos.top-2);
		inputs = (a.parentElement).parentElement.getElementsByTagName('input');
		inputs1 = document.getElementById('Module').getElementsByTagName('tbody')[0].getElementsByTagName('input');
		var data = [];
		for(i = 0; i< inputs.length; i++)
		{
			if( i < 1 )
			{
				data.push(inputs[i].value);
				inputs1[i].value = inputs[i].value;
				inputs1[i].disabled = true;
			}else if( i > 1 ){
				data.push(inputs[i].value);
				inputs1[i-1].value = inputs[i].value;
				inputs1[i-1].disabled = true;
			}
		}
		document.getElementById('Module').getElementsByTagName('tfoot')[0].getElementsByTagName('input')[0].value = "Nouveau";
		$('#mod_data').val(data);
	}
	
	function mod_mod()
	{
		inputs1 = document.getElementById('Module').getElementsByTagName('tbody')[0].getElementsByTagName('input');
		for(i = 0; i< inputs1.length; i++)
		{
			inputs1[i].disabled = false;
		}
		document.getElementById('Module').getElementsByTagName('tfoot')[0].getElementsByTagName('input')[0].value = "Modifier";
		$(document.getElementById('Module').getElementsByTagName('tfoot')[0].getElementsByTagName('input')[1]).show();
		$('#option_mod').css('display','none')
	}
	
	function sup_mod()
	{
		$('methode_action').val("supprimer");
		$(document.getElementById('Module').getElementsByTagName('tfoot')[0].getElementsByTagName('tr')[0].getElementsByTagName('input')[0]).css('visibility','hidden');
		$(document.getElementById('Module').getElementsByTagName('tfoot')[0].getElementsByTagName('tr')[0].getElementsByTagName('input')[1]).css('display','none');
		
		Check = confirm("Vous etes sur le point d'effectuer une suppression! Etes vous sur de vouloir continuer ?"); 
		if(Check == false){
			$(document.getElementById('Module').getElementsByTagName('tfoot')[0].getElementsByTagName('tr')[0].getElementsByTagName('input')[0]).css('visibility','visible');
			$(document.getElementById('Module').getElementsByTagName('tfoot')[0].getElementsByTagName('tr')[0].getElementsByTagName('input')[0]).val('Nouveau');
			alert("Suppression annulee");
		} else {
			
			d = $('#mod_data').val().split(',');
			var data1 = [];
			
			for(i = 0; i < d.length; i++)
			{
				data1.push(d[i]);
			}
			val_mod_1('Module', data1,"Supprimer");
		}
	}
	
	$('[name = valider]').each(function(){
		
		$(this).click(function(){
			form = this.parentElement.parentElement.parentElement.parentElement;
			inputs = form.getElementsByTagName('tr')[0].getElementsByTagName('input');
			selects = form.getElementsByTagName('tr')[0].getElementsByTagName('select');
			entity = form.getAttribute('id','false');
			if (this.value == "Nouveau")
			{
				for(var i = 0 ; i < inputs.length; i++)
				{
					inputs[i].disabled = false;
					inputs[i].value = "";
				}
				
				for(var i = 0 ; i < selects.length; i++)
				{
					selects[i].disabled = false;
					selects[i].value = "";
				}
				
				$(this.parentElement.getElementsByTagName('input')[0]).val('Ajouter');
				
			} else {
				
				$('#mess_text').html("<img src='"+$('#imgurl').val()+'12.gif'+"'/>");
				$('#message').show();
				$('#ex_mess').hide();
				
				if(this.value == "Ajouter")
				{
					$('#methode_action').val('Ajouter');
				}else{
					$('#methode_action').val('Modifier');
				}
				
				
				var cmps = $('#'+entity+' tbody input:hidden, #'+entity+' tbody input:text, #'+entity+' tbody select');
				var data = [];
				
				$(cmps).each(function(){
					data.push(this.value);
				});
				
				val_mod_1(entity, data, $(this).val());
			}
		});
	});

	$('[name = annuler]').each(function(){
		$(this).click(function(){
			form = this.parentElement.parentElement.parentElement.parentElement;
			inputs = form.getElementsByTagName('tr')[0].getElementsByTagName('input');
			selects = form.getElementsByTagName('tr')[0].getElementsByTagName('select');
			
			$(this).hide();
			$('#methode_action').val('');
			
			for(var i = 0 ; i < inputs.length; i++)
			{
				inputs[i].value = "";
			}
			
			for(var i = 0 ; i < selects.length; i++)
			{
				selects[i].value = "";
			}
			
			this.parentElement.getElementsByTagName('input')[0].value = "Ajouter"; 
		});
	});
	
	
// ====================================== //





























