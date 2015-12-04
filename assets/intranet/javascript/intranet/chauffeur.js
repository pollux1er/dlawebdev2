	function load_rw( data, Ac )
	{
		
		// alert(data);
		// $(Ac).html("");
		var nodes = data.getElementsByTagName('item');
		
		// alert("aaaa");
		var content = [];
		
		if( nodes.length != 0 )
		{
			var ind_id = nodes[0].attributes[0].value;
			// $('#id1').val(ind_id);
			for( var i = 0 ; i < nodes.length ; i++ )
			{
				content.push('<tr class="altcol" onclick="modifier(this)" >');
				var tds = nodes[i].attributes;
				for ( var j = 0; j < tds.length; j++ )
				{
					content.push('<td align="center" ');
					if( (j == 0) || ( j == 4 ) || ( j == 6 ) || ( j == 7 ) || ( j == 8 ) || ( j == 9 ) )
					{
						content.push(' style="display:none" ');
					}
					
					content.push('>'+(tds[j].nodeValue)+'</td>');
				}
				
				content.push('</tr>')
			}
			
			var cont = content.join("");
			content = null;		
			
			$(Ac).html( cont );
			
			$(Ac.getElementsByTagName('tr')[0]).trigger('click');
		} else {
			content.push('<tr class="" ><td colspan="5" align="center"> Aucun enregistrement </td></tr>');
			
			var cont = content.join("");
			content = null;	
			$(Ac).html( cont );
		}
	}
	
	function post_els( id, limit, b )
	{
		// reintialisation à 0 des elts de recherche... 
		$('#r_nm').val( "" );
		$('#r_prnm').val( "" );
		$('#r_cat').val( "" );
		
		var param = [
						{ "name":"id", value: id },
						{ "name":"limit", value: limit },
						{ "name":"sort", value: $('#sort').val() },
						{ "name":"order", value: $('#order').val() }
					]
		
		$.post('chauffeur/refresh_ch', param, function(data) {
			if (data) {
				// alert(data);
				var target = document.getElementById('showf');
				load_rw( data, target);
				
				var line = data.getElementsByTagName('line')[0];
				var nblin = parseInt(line.attributes[0].nodeValue);
				// alert(nblin);
				if( b == "yes" )
				{ 
					$(target.getElementsByTagName('tr')[nblin]).trigger('click');
				}
				
				var tr_id = target.getElementsByTagName('tr')[nblin].getElementsByTagName('td')[0].innerHTML;
				$('#id').val(trim(tr_id));
				
				var nbr = data.getElementsByTagName('nbre')[0];
				$('#num_rows').val(nbr.attributes[0].nodeValue);
				
				var stp = data.getElementsByTagName('step')[0];
				$('#step').val(stp.attributes[0].nodeValue);
				
				$('.navig_nb_record').html( nbr.attributes[0].nodeValue+" &eacute;l&eacute;ment(s)" );
				
				var nom = $('#module').val();
				var _nom = "";
				var end = 0; 
				if(nom[nom.length-1] == 's')
				{
					end = nom.length-1;
				}else{
					end = nom.length;
				}

				for( var i = 0; i < end; i++ )
				{
					_nom += nom[i];
				}
				
				var nav_target = document.getElementById('page_1');
				var limit = parseInt($('#limit').val());
				var step = parseInt(stp.attributes[0].nodeValue);
				var num = parseInt(nbr.attributes[0].nodeValue);
				// alert( "limit : "+limit+" step : "+step+" num : "+num );
				$(nav_target).html("");
				
				load_range(nav_target, limit, step, num, _nom.toLowerCase());
			}
		}, "xml");
	}
	
	var message = $('#message');
	var txt_m = $('#mess_text');
	$('#messcontent').css('position','absolute');

	function cr_pop( data )
	{
		var msg = data.split('@');
						
		var pop = $('#pop');
		
		if( pop.length == 0 )
		{
			// $('#messcontent').attr('align','center');
			$('#messcontent').append('<div id="pop" style="background-color:white;"></div>');
			$('#pop').css('left','3%');
			$('#pop').append(msg[0]);
		}else{
			pop.html('');
			pop.append(msg[0]);
			pop.fadeIn();
		}
		
		window.setTimeout(function(){ $('#pop').fadeOut() }, 2000);
		
		if( msg[1] == "OK" )
		{
			post_els( msg[2], msg[3], "yes" );
			window.setTimeout(function(){ $('#ex_mess').click() }, 2000);
		}
	}

	function call_form(act, a, b)
	{
		
		txt_m.html("");
		if($('#pop').length != 0)
		{
			$('#pop').hide();
		}
		$('#messcontent').css('left','20%');
		message.show();
		var content = [];
		var chg = "";
		if( act == "Modifier" )
		{
			chg = "Modification";
		}else{
			chg = "Ajout nouveau";
		}
		
		content.push('<div class="title"> '+chg+' Chauffeur </div>');
		content.push('<div style="display:inline-block; background-color:#ffffff; padding-top:10px; padding-bottom:10px; width:500px;">');
			// content.push('<form id="form_chf">');
				content.push('<table id="tab_ch" style="margin:10px; border: 1px solid lightgray; width:90%; display:inline-block;">');
				
				if( act == "Modifier" )
				{
					content.push('<tr style="display:none;"><td style="padding:10px;"></td><td><input id="pid" type="text" class="input_type"/></td></tr>');
				}
				
				var names = [];
				var ths = document.getElementById("tck_list").getElementsByTagName('thead')[0].getElementsByTagName('th');
				for( var i = 1; i < ths.length-1; i++ )
				{
					names.push( trim(ths[i].getElementsByTagName('a')[0].innerHTML) );
					if( i != 4 )
					{
						content.push('<tr><td style="padding:10px; padding-left:30px;" align="left"><b> '+trim(ths[i].getElementsByTagName('a')[0].innerHTML)+' : </b></td><td><input id="fr_'+ths[i].getElementsByTagName('input')[0].name+'" type="text" class="input_type" /></td></tr>');
					}
				}
				content.push('</table>');
			// content.push('</form><br>');
		content.push('</div>');
		
		var selA = "";
		var selB = "";
		var selBE = "";
		var selC = "";
		var selCE = "";
		var selD = "";
		var selDE = "";
		var selE = "";
		var va_dat = "";
		var va_num_per = "";
		var _dvs_pr = "";
		
		if ( act == "Modifier" ) 
		{
			var trs1 = document.getElementById('tab_permis').getElementsByTagName('tr');
			if( trs1.length > 1 )
			{
				var tds12 = trs1[1].getElementsByTagName('td')[1];
					va_dat = trim(tds12.innerHTML);
				var tds22 = trs1[2].getElementsByTagName('td')[1];
					va_num_per = trim(tds22.innerHTML);
				var tds32 = trs1[3].getElementsByTagName('td')[1];
					_dvs_pr = tds32.getElementsByTagName('div');
						
				for( var i = 0; i < _dvs_pr.length; i++ )
				{
					if( trim(_dvs_pr[i].innerHTML) == "A" )
					{
						selA = 'checked';
					} else if( trim(_dvs_pr[i].innerHTML) == "B" )
					{
						selB = 'checked';
					} else if( trim(_dvs_pr[i].innerHTML) == "BE" )
					{
						selBE = 'checked';
					} else if( trim(_dvs_pr[i].innerHTML) == "C" )
					{
						selC = 'checked';
					} else if( trim(_dvs_pr[i].innerHTML) == "CE" )
					{
						selCE = 'checked';
					} else if( trim(_dvs_pr[i].innerHTML) == "D" )
					{
						selD = 'checked';
					} else if( trim(_dvs_pr[i].innerHTML) == "DE" )
					{
						selDE = 'checked';
					} else if( trim(_dvs_pr[i].innerHTML) == "E" )
					{
						selE = 'checked';
					}
				}
			}		
		}
		
		content.push('<div style="display:inline-block; background-color:#ffffff; padding-top:10px; padding-bottom:10px; width:500px;">');
			content.push('<table id="tab_perm_cdre" style="margin:10px; border:1px solid lightgray; width:80%; display:inline-block;">');
				content.push('<tr style=""><th colspan="2" align="center" style="height:25px; background-color:#B3C8E5;"> Permis de conduire </th></tr>');
				content.push('<tr style="display:none;"><td></td><td> <input id="id_perm" type="hidden" /> </td></tr>');
				content.push('<tr style=""><td style="padding:10px; padding-left:30px;" align="left"><b> Date de d&eacute;livrance </td><td style="padding-left:30px;" align="left"> <input id="datedel" type="text" class="input_type" value="'+va_dat+'" /> </td></tr>');
				content.push('<tr style=""><td style="padding:10px; padding-left:30px;" align="left"><b>  Num&eacute;ro de permis </td><td style="padding-left:30px;" align="left"> <input id="num_perm" type="text" class="input_type"  value="'+va_num_per+'" /> </td></tr>');
				content.push('<tr style=""><td align="left" style="vertical-align:top; padding:10px; padding-left:30px;"><b> Cat&eacute;gories </b></td><td align="left" style="padding-left:30px;">');
					content.push(' <input id="A" type="checkbox" style="vertical-align:middle" '+selA+' /> &nbsp;&nbsp; <b>A</b> <br>');
					content.push(' <input id="B" type="checkbox" style="vertical-align:middle" '+selB+' /> &nbsp;&nbsp; <b>B</b> <br>');
					content.push(' <input id="BE" type="checkbox" style="vertical-align:middle" '+selBE+' /> &nbsp;&nbsp; <b>BE</b> <br>');
					content.push(' <input id="C" type="checkbox" style="vertical-align:middle" '+selC+' /> &nbsp;&nbsp; <b>C</b> <br>');
					content.push(' <input id="CE" type="checkbox" style="vertical-align:middle" '+selCE+' /> &nbsp;&nbsp; <b>CE</b> <br>');
					content.push(' <input id="D" type="checkbox" style="vertical-align:middle" '+selD+' /> &nbsp;&nbsp; <b>D</b> <br>');
					content.push(' <input id="DE" type="checkbox" style="vertical-align:middle" '+selDE+' /> &nbsp;&nbsp; <b>DE</b> <br>');
					content.push(' <input id="E" type="checkbox" style="vertical-align:middle" '+selD+' /> &nbsp;&nbsp; <b>E</b> ');
				content.push('</td></tr>');

				content.push('</table>');
		content.push('</div>');
		
		content.push('<div><input id="val" type="button" class="tpl_button_insert" value="'+act+'" />&nbsp;&nbsp;&nbsp;<input id="ann" type="button" class="button_action_ann" value="Annuler" /><br>')
		content.push('<div  style="height:50px; visibility:visible;"><div id="mess_res" style="overflow:hidden; display:none;"><p>Veuillez changer le statut de la réservation avant de valider...</p></div></div></div>');

		
		var add_cont = content.join("");
		content = null;

		// $.post('chauffeur/all_type', function(data) {
			// if (data) {
				
				// $(data).find('item').each(function(){
				
					// $('#type').append('<option value="'+this.attributes[0].nodeValue+'">'+this.attributes[1].nodeValue+'</option>');
				// }); 
			// }
		// }, "xml");
		
		txt_m.append(add_cont);
		
		$('#datedel').datepick();
		$('#fr_datedelcni').datepick();
		$('#fr_datenaiss').datepick();
		$('#fr_drvisit').datepick();
		
		$('#ann').click(function(){
			$('#ex_mess').trigger('click');
		});
		
		if( act == "Modifier" )
		{
			var trs = document.getElementById('tck_list').getElementsByTagName('tbody')[0].getElementsByTagName('tr');
			// alert( trs[0].getElementsByTagName('td').length );
			// for( var i = 0; i < trs.length; i++ )
			// {
				// var it = trs[i];
				// if( it.getElementsByTagName('td')[0].innerHTML == b )
				// {
					// var tr = trs[i];
					// break;
				// }
			// }
			var num = [];
			var tr = '';
			$(trs).each(function(){
				if(trim(this.getElementsByTagName('td')[0].innerHTML) == a)
				{
					tr = this;	
				}
			});
				
			var tds = tr.getElementsByTagName('td');
			
			var table = $("#tab_ch"); 
			var inps = $("#tab_ch input");
			var sels = $("#tab_ch select");
			var j = 0;
			var k = 0;
			
			for (var i = 0; i < tds.length-1; i++)
			{
				if( (i != 4)  )
				{
					inps[j].value = trim(tds[i].innerHTML);
					j++;
				}
			}
			
		}
		
		$('#val').click(function(){
			
			var pop = $('#pop');
		
			if( pop.length == 0 )
			{
				$('#messcontent').append('<div id="pop" style="background-color:white;"></div>');
				$('#pop').css('left','3%');
				$('#pop').append('<img src="'+$('#imgurl').val()+'29.gif'+'"/>');
			}else{
				pop.html('<img src="'+$('#imgurl').val()+'29.gif'+'"/>');
				$('#pop').css('left','3%');
				pop.fadeIn();
			}
			
			var A = ( ($('#A').attr('checked')) ? 1 : 0 );
			var B = ( ($('#B').attr('checked')) ? 1 : 0 );
			var BE = ( ($('#BE').attr('checked')) ? 1 : 0 );
			var C = ( ($('#C').attr('checked')) ? 1 : 0 );
			var CE = ( ($('#CE').attr('checked')) ? 1 : 0 );
			var D = ( ($('#D').attr('checked')) ? 1 : 0 );
			var DE = ( ($('#DE').attr('checked')) ? 1 : 0 );
			var E = ( ($('#E').attr('checked')) ? 1 : 0 );
			// if ( (A == 0) && (B == 0) && (BE == 0) && (C == 0) && (CE == 0) && (D == 0) && (DE == 0) && (E == 0) )
			// {
				// var pop = $('#pop');
		
				// if( pop.length == 0 )
				// {
					// $('#messcontent').append('<div id="pop" style="background-color:white;"></div>');
					// $('#pop').css('left','3%');
					// $('#pop').append('<p>Veuillez choisir au moins une catégorie de permis</p>');
				// }else{
					// pop.html('<p>Veuillez choisir au moins une catégorie de permis</p>');
					// $('#pop').css('left','3%');
					// pop.fadeIn();
				// }
				
				// window.setTimeout(function(){ $('#pop').fadeOut() }, 2000);
			// }else{
				var param = [	
								{ "name":"pid", value: $('#pid').val() },
								{ "name":"nom", value: $('#fr_nomch').val() },
								{ "name":"pre", value: $('#fr_prenomch').val() }, 
								{ "name":"tel", value: $('#fr_telephone').val() },
								{ "name":"datn", value: $('#fr_datenaiss').val() }, 
								{ "name":"empl", value: $('#fr_employeur').val() },
								{ "name":"ncni", value: $('#fr_cni').val() },
								{ "name":"datd", value: $('#fr_datedelcni').val() }, 
								{ "name":"dernv", value: $('#fr_drvisit').val() },
								{ "name":"id_perm", value: $('#id_perm').val() },
								{ "name":"datedel", value: $('#datedel').val() },
								{ "name":"num_perm", value: $('#num_perm').val() },
								{ "name":"A", value: A },
								{ "name":"B", value: B },
								{ "name":"BE", value: BE },
								{ "name":"C", value: C },
								{ "name":"CE", value: CE },
								{ "name":"D", value: D },
								{ "name":"DE", value: DE },
								{ "name":"E", value: E },
								{ "name":"action", value: act },
								{ "name":"limit", value: $('#limit').val() }
							]
				
				$.post('chauffeur/insert_ch', param, function(data) {
					if (data) {
						cr_pop(data);
					}
				}, "text");
			// }
			
		});
		
	}


	function supp_chf( a )
	{
		var check = confirm("Voulez-vous vraiment supprimer cet enregistrement?");
		
		if( check == true )
		{
			$('#mess_text').html('<img src="'+$('#imgurl').val()+'29.gif'+'"/>');
			$('#ex_mess').hide();
			$('#message').show();
			var param = [
							{ "name":"pid", value: a },
							{ "name":"step", value: parseInt( $('#step').val()) },
							{ "name":"limit", value: parseInt($('#limit').val()) },
							{ "name":"sort", value: $('#sort').val() },
							{ "name":"order", value: $('#order').val() }
						];
			
			$.post('chauffeur/supp_chf', param, function(data) {
				if (data) {
					
					var target = document.getElementById('showf');
					load_rw( data, target );
						
					var nbr = data.getElementsByTagName('nbre')[0];
					$('#num_rows').val(nbr.attributes[0].nodeValue);
					
					var stp = data.getElementsByTagName('step')[0];
					$('#step').val(stp.attributes[0].nodeValue);
					
					$('.navig_nb_record').html( nbr.attributes[0].nodeValue+" &eacute;l&eacute;ment(s)" );
					
					var nom = $('#module').val();
					var _nom = "";
					var end = 0; 
					if(nom[nom.length-1] == 's')
					{
						end = nom.length-1;
					}else{
						end = nom.length;
					}

					for( var i = 0; i < end; i++ )
					{
						_nom += nom[i];
					}
					
					var nav_target = document.getElementById('page_1');
					var limit = parseInt($('#limit').val());
					var step = parseInt(stp.attributes[0].nodeValue);
					var num = parseInt(nbr.attributes[0].nodeValue);
					// alert( "limit : "+limit+" step : "+step+" num : "+num );
					$(nav_target).html("");
					
					load_range(nav_target, limit, step, num, _nom.toLowerCase());
					
					var mess = data.getElementsByTagName('message')[0].attributes[0].nodeValue;
					$('#mess_text').html('<p>'+mess+'</p>');
					window.setTimeout(function(){ $('#message').hide(); }, 1500);
				}
			}, "xml");
		}
	}

	function info_permis( id )
	{
		var param = [ { name:'id', value:trim(id) } ];
		
		$.post('chauffeur/inf_perm', param, function (data) {
			
			var t_infs = data.getElementsByTagName('item');
			
			var content = [];
			
			if( t_infs.length != 0 )
			{
				var infs = t_infs[0].attributes;
				
				var libs = [ '', 'Date de d&eacute;livrance', 'Num&eacute;ro de permis', 'Cat&eacute;gories'];

				for( var i = 0; i < infs.length; i++ )
				{
					if( i == 0 )
					{
						content.push('<tr style="display:none;"><td>'+infs[i].nodeValue+'</td></tr>');
					}else{
						if( (i > 0) && (i < 3) )
						{
							content.push('<tr><td class=\'label\' align=\'right\'>'+libs[i]+'</td><td  style=\'padding-left:30px;\' align=\'left\'>'+infs[i].nodeValue+'</td></tr>');
						}else if( i == 3 ){
							content.push('<tr><td class=\'label\' align=\'right\' style="vertical-align:top;">'+libs[i]+'</td><td style=" padding:5px 0px 0px 30px;" align="left">');
							if (infs[i].nodeValue != 0)
							{
								content.push('<div name="prm" align="center" style="font-weight:bold;  border:1px solid black; width:30px; margin: 0px 5px 5px 0px;">A</div>');
							}	
						}else{
							if (( i == 4 ) && (infs[i].nodeValue != 0) )
							{
								content.push('<div name="prm" align="center" style="font-weight:bold;  border:1px solid black; width:30px; margin: 0px 5px 5px 0px;">B</div>');
							} else if (( i == 5 ) && (infs[i].nodeValue != 0) )
							{
								content.push('<div name="prm" align="center" style="font-weight:bold;  border:1px solid black; width:30px; margin: 0px 5px 5px 0px;">BE</div>');
							} else if (( i == 6 ) && (infs[i].nodeValue != 0) )
							{
								content.push('<div name="prm" align="center" style="font-weight:bold;  border:1px solid black; width:30px; margin: 0px 5px 5px 0px;">C</div>');
							} else if (( i == 7 ) && (infs[i].nodeValue != 0) )
							{
								content.push('<div name="prm" align="center" style="font-weight:bold;  border:1px solid black; width:30px; margin: 0px 5px 5px 0px;">CE</div>');
							} else if (( i == 8 ) && (infs[i].nodeValue != 0) )
							{
								content.push('<div name="prm" align="center" style="font-weight:bold;  border:1px solid black; width:30px; margin: 0px 5px 5px 0px;">D</div>');
							} else if (( i == 9 ) && (infs[i].nodeValue != 0) )
							{
								content.push('<div name="prm" align="center" style="font-weight:bold;  border:1px solid black; width:30px; margin: 0px 5px 5px 0px;">DE</div>');
							} 
							else if (( i == 10 ) && (infs[i].nodeValue != 0) )
							{
								content.push('<div name="prm" align="center" style="font-weight:bold;  border:1px solid black; width:30px; margin: 0px 5px 5px 0px;">E</div>');
							} 
						}
					}
				}
				content.push('</td></tr>');
			}else{
				content.push('<tr><td colspan="2" align="center"> Aucun permis enregistr&eacute; </td></tr>');
			}
			
			var tab_cont = content.join("");
			
			$("#tab_permis").html( tab_cont );
		}, 'xml');
	}

	function modifier(aA)
	{
		line_color(aA, 'tck_list');
		//Modification de la partie visu de module
			//--> Info sur le chauffeur
			$('#sh').html("");
			
			var tds = aA.getElementsByTagName('td');
			var td0 = trim(aA.getElementsByTagName('td')[0].innerHTML);
			$('#id').val(td0);
			
			var content = [];
			content.push("<div class='title'> Infos Chauffeur </div>");
			// var avatar = "";
			
			if( trim(tds[4].innerHTML) == "" )
			{
				avatar = $('#imgurl').val()+"photo/empty_id.jpg";
			}else{
				avatar = $('#imgurl').val()+"photo/"+tds[4].innerHTML;
			}
			
			content.push("<div align='left'>");
				content.push("<div id='p_profil' style='margin:5px 0 0 5px; padding:3px; width:105px; background-color:white; display:inline-block;'>");
				content.push("<img style='border:padding:5px; border:1px solid gray; display:inline-block;' src='"+avatar+"' /></div>");
				
				content.push("<div id='load_avatar' style='padding-left:20px; color:balck; display:inline-block;'>");
					content.push("<form action=\"chauffeur\" method=\"post\" enctype=\"multipart/form-data\" id=\"upload\">");
						content.push("<input name='h_id' type='hidden' value='"+trim(tds[0].innerHTML)+"' />");
						content.push("<input name='h_limit' type='hidden' value='"+$('#limit').val()+"' />");
						content.push("<input name='h_order' type='hidden' value='"+$('#order').val()+"' />");
						content.push("<input name='h_sort' type='hidden' value='"+$('#sort').val()+"' />");
						content.push("<input name='form' type='hidden' value='' />");
						content.push("<p style='margin:0 0 10px 10px;'><u>Charger une photo</u></p><input id='myfile' name='myfile' type='file' accept='image/*' class='input_type' style='vertical-align:middle; margin: 0 0 10px 10px;'/>");
					content.push("</form>");
				content.push("</div>");
			content.push("</div>");
			
			content.push("<br><div id='prf_body' style='border:1px solid lightgray; margin-left:8px; margin-right:8px;'>");
			content.push("<table id='int_tab' class='form'><colgroup><col width ='35%'><col width='65%'></colgroup>");
			
			
			var label = new Array('Code','Nom','Prénom','Numéro de Téléphone','photo', 'Date de naissance', 'Employeur', 'N° CNI', 'Date de délivrance CNI', 'Dernière Visite Médicale', 'En règle');
			for( var i = 0; i < 10; i++ )
			{
				var hide = "";
				if( (i == 0) || (i == 9) )
				{
					hide = "style='display:none;'";
					content.push("<tr "+hide+" ><td class='label' align='right'>"+label[i]+"</td><td style='padding-left:30px;' align='left'>"+tds[i].innerHTML+"</td></tr>");
				}else if( (i != 4) && (i != 0) && (i != 9) )
				{
					content.push("<tr "+hide+" ><td class='label' align='right'>"+label[i]+"</td><td style='padding-left:30px;' align='left'>"+tds[i].innerHTML+"</td></tr>");
				}
				
				
			}
			
			content.push("</table><br>");
			content.push("<table class='ticket_list' style='border:1px solid #A9A9A9'><colgroup><col width ='35%'><col width='65%'></colgroup><thead><tr><th colspan='2' align='left' style='padding-left:30px;'>Permis de conduire</th></tr></thead><tbody id='tab_permis'><tr><td colspan='2'><div align='center'><img src='"+$('#imgurl').val()+"29.gif"+"' ></div></td></tr></tbody></table>");
			content.push("<br><div align=\"center\">"); 
			content.push("<input id=\"mod_butt\" class=\"button_action_ann button_action_mod\" type=\"button\" value=\"Modifier\" onclick=\"call_form('Modifier', "+trim(tds[0].innerHTML)+", '')\" /> &nbsp;&nbsp; ");
			content.push("<input id=\"ann_butt\" class=\"tpl_button_delete\" type=\"button\" value=\"Supprimer\" onclick=\"supp_chf("+trim(tds[0].innerHTML)+")\"/> </div>");
			content.push("<br></div>");
			
			var visu_content = content.join("");
			content = null;
			
			$('#sh').html(visu_content);
			
			$('#myfile').change(function(){
				if( this.value == "" ) { alert("Veuillez choisir une image..."); return false; }
				$('#upload').submit();
			});
			
			info_permis(tds[0].innerHTML);
	}

	var tr1 = document.getElementById("tck_list").getElementsByTagName('tbody')[0].getElementsByTagName('tr')[0];
	$(tr1).trigger('click');

	$('#add').click(function(){ call_form("Valider", "", "") });

	$(document).ready(function()
	{

	});	
	
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
		// alert(name)
		// alert(label)
		var param = [
						{ "name":"limit", value: $('#limit').val() },
						{ "name":"sort", value: $('#sort').val() },
						{ "name":"order", value: $('#order').val() },
						{ "name":"nom", value:$('#r_nm').val() },
						{ "name":"prenom", value:$('#r_prnm').val() },
						{ "name":"cat", value:$('#r_cat').val() },
						{ "name":"champs", value:name },
						{ "name":"label", value:label }
					]
		$.post( "chauffeur/extract", param, function(data){
			if(data)
			{
				// alert(data);
				window.open(data); 
			}
		}, "text");
	}
	
	function find()
	{
		// initialisation des champs hidden contenant les parametres de recherche...
			$('#r_nm').val( $('#f_nom').val() );
			$('#r_prnm').val( $('#f_prn').val() );
			$('#r_cat').val( $('#f_cat').val() );
		//==========================================================================
		
		var param = [
						{ "name":"limit", value: $('#limit').val() },
						{ "name":"sort", value: $('#sort').val() },
						{ "name":"order", value: $('#order').val() },
						{ "name":"nom", value:$('#f_nom').val() },
						{ "name":"prenom", value:$('#f_prn').val() },
						{ "name":"cat", value:$('#f_cat').val() }
					]
					
		// alert($('#f_cat').val())			
		$.post( "chauffeur/refresh_ch", param, function(data){
			if(data)
			{
				// alert(data);
				var target = document.getElementById('showf');
				load_rw( data, target );
				
				var nbr = data.getElementsByTagName('nbre')[0];
				$('#num_rows').val(nbr.attributes[0].nodeValue);
				
				var stp = data.getElementsByTagName('step')[0];
				$('#step').val(stp.attributes[0].nodeValue);
				
				$('.navig_nb_record').html( nbr.attributes[0].nodeValue+" &eacute;l&eacute;ment(s)" );
				
				var nom = $('#module').val();
				var _nom = "";
				var end = 0; 
				if(nom[nom.length-1] == 's')
				{
					end = nom.length-1;
				}else{
					end = nom.length;
				}

				for( var i = 0; i < end; i++ )
				{
					_nom += nom[i];
				}
				
				var nav_target = document.getElementById('page_1');
				var limit = parseInt($('#limit').val());
				var step = parseInt(stp.attributes[0].nodeValue);
				var num = parseInt(nbr.attributes[0].nodeValue);
				// alert( "limit : "+limit+" step : "+step+" num : "+num );
				$(nav_target).html("");
				
				load_range(nav_target, limit, step, num, _nom.toLowerCase());
			}
		}, "xml");
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
			cont.push("<tr><td align='left' class='label' style='padding-left:10px;'> Nom : </td><td align='left' style='padding-left:20px;'><input id='f_nom' type='text' class='input_type'/></td></tr>");
			cont.push("<tr><td align='left' class='label' style='padding-left:10px;'> Prenom : </td><td align='left' style='padding-left:20px;'><input id='f_prn' type='text' class='input_type'/></td></tr>");
			cont.push("<tr><td align='left' class='label' style='padding-left:10px;'> Categorie : </td><td align='left' style='padding-left:20px;'><select id='f_cat' class='input_type'>");
				cont.push("<option></option>");
				cont.push("<option value='a'>A</option>");
				cont.push("<option value='b'>B</option>");
				cont.push("<option value='be'>BE</option>");
				cont.push("<option value='c'>C</option>");
				cont.push("<option value='ce'>CE</option>");
				cont.push("<option value='d'>D</option>");
				cont.push("<option value='de'>DE</option>");
				cont.push("<option value='e'>E</option>");
			cont.push("</select></td></tr>");
			cont.push("<tr><td colspan='2' align='center'> <input type='button' value='Chercher' class='tpl_button_neutral' onclick='find();'/>&nbsp;&nbsp;<input type='button' value='Fermer' class='tpl_button_neutral' onclick='close_spl();'/> </td></tr>");
		cont.push("</table>");
		
		var content = cont.join("");
		
		$('#div_spl').html(content);
		
	}
	
	function get_csv(a)
	{
		var names = [];
		var input_names = [];
		var ths = document.getElementById('tck_list').getElementsByTagName('thead')[0].getElementsByTagName('th');
		
		for( var i = 0; i < ths.length; i++ )
		{
			names.push( ths[i].getElementsByTagName('a')[0].innerHTML );
			input_names.push( ths[i].getElementsByTagName('input')[0].name );
		}
		
		names.push("Date Délivrance Permis");
		names.push("Numéro de permis");
		names.push("Catégories");
		input_names.push("datedel");
		input_names.push("nump");
		input_names.push("cat");
		
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
	
	if( $('#id1').val() != "" )  
	{
		post_els( $('#id1').val(), $('#limit').val(), "yes" );
	}
	
	setInterval(function(){ 
		post_els( $('#id').val(), $('#limit').val(), "yes" );
	},30000);