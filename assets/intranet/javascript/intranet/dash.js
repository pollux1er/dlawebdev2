$(function(){
	function refresh ( a )
	{
		
		var param = [ { name : "see" , value : a } ];
		
		$.post( "dash/launch", param, function(data){ 
			if(data)
			{
				// alert( data );
				var forms = data.getElementsByTagName('item');
					var tt1 = data.getElementsByTagName('nbr1');
				var rsrvs = data.getElementsByTagName('item1');
					var tt2 = data.getElementsByTagName('nbr2');
				var chfrs = data.getElementsByTagName('item2');
					var tt3 = data.getElementsByTagName('nbr3');
				var vehcs = data.getElementsByTagName('item3');
					var tt4 = data.getElementsByTagName('nbr4');
				
				var content0 = [];
				var content1 = [];
				var content2 = [];
				var content3 = [];
				
				if( forms.length != 0 )
				{
					$('#nb_formulaire').html( "<p>"+tt1[0].attributes[0].value+" Demande(s) de v&eacute;hicule </p>" );
					for( var i = 0; i < forms.length; i++ )
					{
						var attrs = forms[i].attributes;
						var st = "";
						if( attrs[1].value == "VALIDEE" )
						{
							st = "circle_green.png";
						} else if( attrs[1].value == "MODIFIEE" )
						{
							st = "circle_blue.png";
						} else if( attrs[1].value == "ANNULEE" )
						{
							st = "circle_yellow.png";
						}else if( attrs[1].value == "NOUVELLE" )
						{
							st = "new-text.png";
						}else if( attrs[1].value == "EXPIREE" )
						{
							st = "auto/stand_by.png";
						}else if( attrs[1].value == "RESERVEE" )
						{
							st = "flag_green.png";
						}
						content0.push('<tr class="see">');
							content0.push('<td align="center"><img src="'+$('#img_path').val()+st+'" /></td>');
							content0.push('<td align="left" style="padding-left:20px;">'+attrs[1].value+'</td>');
							content0.push('<td align="center">'+attrs[0].value+'</td>');
						content0.push('</tr>');
					}
					
					var ct0 = content0.join("");
					
					$('#tb_formulaire').html(ct0);
				}
				
				if( rsrvs.length != 0 )
				{
					$('#nb_reservation').html( "<p>"+tt2[0].attributes[0].value+" R&eacute;servation(s) </p>" );
					for( var i = 0; i < rsrvs.length; i++ )
					{
						var attrs = rsrvs[i].attributes;
						var st = "";
						if( attrs[1].value == "STAND BY" )
						{
							st = "circle_grey.png";
						} else if( attrs[1].value == "DEPART" )
						{
							st = "circle_green.png";
						} else if( attrs[1].value == "ANNULEE" )
						{
							st = "circle_yellow.png";
						} else if( attrs[1].value == "RETOUR" )
						{
							st = "circle_red.png";
						}
						content1.push('<tr class="see">');
							content1.push('<td align="center"><img src="'+$('#img_path').val()+st+'" /></td>');
							content1.push('<td align="left" style="padding-left:20px;">'+attrs[1].value+'</td>');
							content1.push('<td align="center">'+attrs[0].value+'</td>');
						content1.push('</tr>');
					}
					
					var ct1 = content1.join("");
					
					$('#tb_reservation').html(ct1);
				}
				
				if( chfrs.length != 0 )
				{
					$('#nb_chauffeur').html( "<p>"+tt3[0].attributes[0].value+" Chauffeur(s) </p>" );
					for( var i = 0; i < chfrs.length; i++ )
					{
						var attrs = chfrs[i].attributes;
						var st = "";
						if( attrs[1].value == "EN REGLE" )
						{
							st = "circle_green.png";
						} else if( attrs[1].value == "PAS EN REGLE" )
						{
							st = "circle_red.png";
						}
						content2.push('<tr class="see">');
							content2.push('<td align="center"><img src="'+$('#img_path').val()+st+'" /></td>');
							content2.push('<td align="left" style="padding-left:20px;">'+attrs[1].value+'</td>');
							content2.push('<td align="center">'+attrs[0].value+'</td>');
						content2.push('</tr>');
					}
					
					var ct2 = content2.join("");
					
					$('#tb_chauffeur').html(ct2);
				}
				
				if( vehcs.length != 0 )
				{
					$('#nb_vehicule').html( "<p>"+tt4[0].attributes[0].value+" V&eacute;hicule(s) </p>" );
					for( var i = 0; i < vehcs.length; i++ )
					{
						var attrs = vehcs[i].attributes;
						var st = "";
						if( attrs[1].value == "OK" )
						{
							st = "circle_green.png";
						} else if( attrs[1].value == "PANNE" )
						{
							st = "circle_red.png";
						} else if( attrs[1].value == "VISITE TECHNIQUE" )
						{
							st = "circle_black.png";
						} else if( attrs[1].value == "PAS EN REGLE" )
						{
							st = "circle_orange.png";
						} else if( attrs[1].value == "HORS SERVICE" )
						{
							st = "circle_grey.png";
						} 
						content3.push('<tr class="see">');
							content3.push('<td align="center"><img src="'+$('#img_path').val()+st+'" /></td>');
							content3.push('<td align="left" style="padding-left:20px;">'+attrs[1].value+'</td>');
							content3.push('<td align="center">'+attrs[0].value+'</td>');
						content3.push('</tr>');
					}
					
					var ct3 = content3.join("");
					
					$('#tb_vehicule').html(ct3);
				}
			}
		}, "xml");
	}
	
	refresh( "all" ); 
	
	$('#affich').change(function(){
		if($(this).val() == '1'){
			$('#1').show();
			$('#2').hide();
			
		}else{
			$('#1').hide();
			$('#2').show();
			gen_stat();
			
		}
	});
	
	$('#affich').trigger('change');
	
	function gen_stat()
	{	
		var ann = ( ( $('#ANNULER').attr("checked")  ) ? "ANNULEE" : "" );
		var dep = ( ( $('#DEPART').attr("checked")  ) ? "DEPART" : "" );
		var ret = ( ( $('#RETOUR').attr("checked")  ) ? "RETOUR" : "" );
		var stdb = ( ( $('#STAND_BY').attr("checked")  ) ? "STAND BY" : "" );
		
		var months = ['Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Decembre' ];
		var jours =  [ 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
		
		var param = [
						{ "name":"dem", value: $('#dem').val() },
						{ "name":"ben", value: $('#des').val() },
						{ "name":"beg", value: $('#beg').val() },
						{ "name":"fin", value: $('#end').val() },
						{ "name":"veh", value: $('#immat').val() },
						{ "name":"mark", value: $('#markmod').val() },
						{ "name":"ANNULER", value: ann },
						{ "name":"DEPART", value: dep },
						{ "name":"RETOUR", value: ret },
						{ "name":"STAND_BY", value: stdb },
						{ "name":"limit", value : $('#limit').val()},
						{ "name":"step", value : $('#step').val()}
					];
		
		$.post("dash/gen_date_table", param, function(data){
			
			if(data)
			{
				var compt = 0;
				
				// construction calendrier
					var per = data.getElementsByTagName('period');
					var cal = data.getElementsByTagName('calander');
					var mnt = cal[0].getElementsByTagName('month');
					var vehs = data.getElementsByTagName('vehicule');
					// var res = data.getElementsByTagName('reservation');
					// alert( res.length );	
					var nbre = parseInt(data.getElementsByTagName('period')[0].attributes[0].value);
					var suit = (data.getElementsByTagName('suit')[0].attributes[0].value).split(',');
					var ent_m = [];
					// en-tete Mois
						
						ent_m.push("<thead><tr class=\"header\">");
							ent_m.push("<td class=\"month\"></td>");
							for( var i = 0; i < mnt.length; i++ )
							{
								ent_m.push("<td colspan=\""+mnt[i].getElementsByTagName('day').length+"\" class=\"month\" style=\"text-align: center;\" >"+months[ parseInt( mnt[i].attributes[0].value ) ]+" "+mnt[i].attributes[0].value+"</td>")	
							}
							
						ent_m.push("</tr></thead>");
						
						var ent1 = ent_m.join("");
						ent_m = null;
						
					// en-tete nom jour
						ent_m = [];
						ent_m.push("<thead><tr class=\"header\">");
							ent_m.push("<td class=\"dayW\"></td>");
							for( var i = 0; i < mnt.length; i++ )
							{	
								var jrs = mnt[i].getElementsByTagName("day");
								for (var j = 0; j < jrs.length; j++)
								{	
									ent_m.push("<td class=\"dayW\" >"+jours[ parseInt( jrs[j].attributes[1].value )-1 ]+"</td>");
								}
							}
							
						ent_m.push("</tr></thead>");
						
						var ent2 = ent_m.join("");
						ent_m = null;
						
					// en-tete num jour
						ent_m = [];
						ent_m.push("<thead><tr class=\"header\">");
							ent_m.push("<td class=\"day\"></td>");
							for( var i = 0; i < mnt.length; i++ )
							{	
								var jrs = mnt[i].getElementsByTagName("day");
								for (var j = 0; j < jrs.length; j++)
								{
									ent_m.push( "<td class=\"day\" >"+ jrs[j].attributes[2].value+"</td>" );
								}
							}
							
						ent_m.push("</tr></thead>");
						
						var ent3 = ent_m.join("");
						ent_m = null;
						
					// Les vehicules
						ent_m = [];
						ent_m.push("<tbody>");
							for( var i = 0; i < vehs.length; i++ )
							{
								ent_m.push("<tr id=\"v"+vehs[i].attributes[0].value+"\" class=\"user_line\" >");
									ent_m.push("<td class=\"user\" ref=\""+vehs[i].attributes[0].value+"\" ><a href=\"./vehicule?id="+vehs[i].attributes[0].value+"\">"+vehs[i].attributes[1].value+"</td>");
									
									for (var j = 0; j < nbre+1; j++)
									{	
										var res = vehs[i].getElementsByTagName('reservation');
								
										ent_m.push("<td name=\"day\" id=\""+vehs[i].attributes[0].value+":"+(j+1)+"\" class=\""+suit[j]+"\" style=\"min-width:1200px;\" >");
											ent_m.push("<table cellspacing=\"0\" cellpadding=\"0\" ><tr>");
												var style="";
												
												var nb = "";
												var border = "";
												for( var a = 0; a < 24 ; a++ )
												{
													// var cont = a
													if( a <= 9 )
													{
														nb = "0"+(a);
													}else{
														nb = (a);
													}
													
													
													
													for( var b = 0; b < 60 ; b++ )
													{
														if( b <= 9 )
														{
															nbb = "0"+(b);
														}else{
															nbb = (b);
														}
														
														var style="";
														
														var id = vehs[i].attributes[0].value+":"+(j+1)+":"+nb+":"+nbb;
														var inner = "";
														var size = "";
														var border = "none";
														if ( ( a != 0 ) && ( (( a ) % 2) == 0) && ( nbb == "00" ) )
														{
															border = "1px dotted lightgray";
														}
														
														if( (nbb == "00") && ( (( a ) % 2) == 0) )
														{
															inner = nb;
															size = "6pt";
														}
														
														style = "font-size:"+size+"; font-weight:bold; width:1px; padding-top:5px; border-right:none; border-top:none; border-bottom:none; border-left:"+border+"; display:inline-block; height:25px;";
														var colnum = "lightgray";
														
														
														var input = "";
														
														if( res.length != 0 )
														{
															for ( var k = 0; k < res.length; k++ )
															{
																if( ( id >= res[k].attributes[2].value) && ( id <= res[k].attributes[3].value) )
																{
																	colnum = "black";
																	var datas = "";
																	datas = res[k].attributes[0].value+"__"+res[k].attributes[1].value+"__"+res[k].attributes[2].value+"__"+res[k].attributes[3].value+"__"+res[k].attributes[4].value+"__"+res[k].attributes[5].value+"__"+res[k].attributes[6].value+"__"+res[k].attributes[7].value+"__"+res[k].attributes[8].value+"__"+res[k].attributes[9].value+"__"+res[k].attributes[10].value+"__"+res[k].attributes[11].value;
																	input += "<input type=\"hidden\" value=\""+datas+"\" />";																	
																	
																	if( id == res[k].attributes[2].value )
																	{
																		style = "font-size:"+size+"; font-weight:bold; width:1px; padding-top:5px; border-right:none; border-top: none; border-bottom: none; border-left:"+border+"; display:inline-block; height:25px; background-color: black;";
																	} else	if( id == res[k].attributes[3].value )
																	{
																		style = "font-size:"+size+"; font-weight:bold; width:1px; padding-top:5px; border-right:none; border-top: none; border-bottom: none; border-left:"+border+"; display:inline-block; height:25px; background-color: black;";
																	} 
																	
																	if( ( id != res[k].attributes[2].value ) && ( id != res[k].attributes[3].value ) )
																	{
																		if( res[k].attributes[7].value == "DEPART" )
																		{
																			style += "background-color: green;";
																		}else if( res[k].attributes[7].value == "RETOUR" )
																		{
																			style += "background-color: red;";
																		}else if( res[k].attributes[7].value == "ANNULEE" )
																		{
																			style += "background-color: yellow;";
																		}else if( res[k].attributes[7].value == "STAND BY" )
																		{
																			style += "background-color: white;";
																		}
																	}
																}
															}
														}
														
														ent_m.push("<td id=\""+id+"\" name=\"time\" style=\""+style+"\" align='left' >");
															ent_m.push(input);
															ent_m.push("<span style='position:relative; display:inline-block; color:"+colnum+";'>"+inner+"</span>");
														ent_m.push("</td>");
														
														style = "font-size:"+size+"; font-weight:bold; width:1px; padding-top:5px; border-right:none; border-top:none; border-bottom:none; border-left:"+border+"; display:inline-block; height:25px;";
														
														nbb++;
													}
														
													nb++;
												}
											ent_m.push("</tr></table>");
										ent_m.push("</td>" );
									}
									
								ent_m.push("</tr>");
							}
						ent_m.push("</tbody>");
						
						var ent4 = ent_m.join("");
						ent_m = null;
						
						if( vehs.length != 0 )
						{
							$('#planning').html( ent1+ent2+ent3+ent4 );
							
							var nbr = data.getElementsByTagName('nbre')[0];
							$('#num_rows').val(nbr.attributes[0].value);
							
							var stp = data.getElementsByTagName('step')[0];
							$('#step').val(stp.attributes[0].value);
							
							$('.navig_nb_record').html( nbr.attributes[0].value+" &eacute;l&eacute;ment(s)" );
							
							var nav_target = document.getElementById('page_1');
							var limit = parseInt($('#limit').val());
							var step = parseInt(stp.attributes[0].value);
							var num = parseInt(nbr.attributes[0].value);
							
							$(nav_target).html("");
							
							load_range(nav_target, limit, step, num, "dash");
							
						}else{
							$('#planning').html( "<div align=\"center\" style=\"padding:20px; font-size:15pt; background-color:white;\"> >> Aucune r&eacute;servation effectu&eacute;e pour cette p&eacute;riode << </div>" );
						}
					
				// fin construction 
				
				// Parcourir les reservations
					
					$("td[name='time']").each( function(){
						
						$(this).mouseover(function(e){
							
							if( this.getElementsByTagName('input').length != 0 )
							{	
								var content = ""; cont = []; var style = ""; var stat = "";
								var _h = this.getAttribute('id').split(':');
								var heure = _h[2]+":"+_h[3];
								var inputs = this.getElementsByTagName('input');
								for( var i = 0; i < inputs.length; i++ )
								{
									var val = inputs[i].value.split('__');
									
									if( val[7] == "DEPART" )
									{
										style = "background-color: green;";
										stat = val[7];
									}else if( val[7] == "RETOUR" )
									{
										style = "background-color: red;";
										stat = val[7];
									}else if( val[7] == "ANNULEE" )
									{
										style = "background-color: yellow;";
										stat = val[7];
									}else if( val[7] == "STAND BY" )
									{
										style = "background-color: white;";
										stat = val[7];
									}
									
									cont.push('<table class="form" width="">');
										cont.push('<tr>');
											cont.push('<td style="'+style+'" align="left">');
												cont.push( "Reservation N. "+val[0]+" ("+stat+")" );
											cont.push('</td>');
											cont.push('<td style="'+style+'" align="left">'+heure+'</td>');
										cont.push('</tr>');	
										cont.push('<tr>');
											cont.push('<td class="label" align="left" align="left"> Periode : </td>');
											cont.push('<td style="padding:5px;" align="left">');
												cont.push( "Du "+val[4]+" <br> Au "+val[5] );
											cont.push('</td>');
										cont.push('</tr>');	
										cont.push('<tr>');
											cont.push('<td class="label" align="left" align="left"> D&eacute;part effectif : </td>');
											cont.push('<td style="padding:5px;" align="left">');
												cont.push( val[10] );
											cont.push('</td>');
										cont.push('</tr>');
										cont.push('<tr>');
											cont.push('<td class="label" align="left" align="left"> Retour effectif : </td>');
											cont.push('<td style="padding:5px;" align="left">');
												cont.push( val[11] );
											cont.push('</td>');
										cont.push('</tr>');
										cont.push('<tr>');
											cont.push('<td class="label" align="left" align="left"> Chaffeur : </td>');
											cont.push('<td style="padding:5px;" align="left">');
												cont.push( val[8] );
											cont.push('</td>');
										cont.push('</tr>');
										cont.push('<tr>');
											cont.push('<td class="label" align="left" align="left"> V&eacute;hicule : </td>');
											cont.push('<td style="padding:5px;" align="left">');
												cont.push( val[9] );
											cont.push('</td>');
										cont.push('</tr>');
									cont.push('</table>');
									
									content += cont.join("");
								}
								
								var Wwidth = parseInt(window.innerWidth)/2;
								
								var x = parseInt(e.pageX);
								
								if( e.pageX > Wwidth )
								{
									x = x - 400;
								}
								
								$('#bubble').css("left", x ).css("top", e.pageY );
								$('#bubble').html(content);
								$('#bubble').show();
							}
							
						});
					});
					
					$("td[name='time']").each( function(){
						$(this).mouseout( function(){
							
							$('#bubble').hide();
						});
					});
					
				//fin Chargement
			}
		}, "xml");
	}
	
	$('#end').datepick();
	$('#beg').datepick();
	
	$('#rech').click(function(){
		gen_stat();
		$('#planning').html( "<tr><td align='center'><div style='padding:20px; color:white;'>Chargement...</div></td></tr>" );
	});
	
	function date_check()
	{
		var param = [
						{ "name":"deb", value: $('#beg').val() },
						{ "name":"fin", value: $('#end').val() }
					];
		
		$.post("dash/date_check", param, function(data){
			if(data)
			{
				$('#beg').val( data.deb );
				$('#end').val( data.fin );
			}
		}, "json");
	}
	
	// setInterval( function(){
		// date_check();
	// }, 10000 );
	
	$('#markmod').attr('disabled', true).attr('class', "disabled");
	
	$('#mrk').click(function(){
		$('#markmod').attr('disabled', false).attr('class', "input_type");
		$('#immat').attr('disabled', true).attr('class', "disabled").val("");
	});
	
	$('#im').click(function(){
		$('#markmod').attr('disabled', true).attr('class', "disabled").val("");
		$('#immat').attr('disabled', false).attr('class', "input_type");
	});
	
	$("#bubble").hide();
	// alert(window.innerWidth);
});

