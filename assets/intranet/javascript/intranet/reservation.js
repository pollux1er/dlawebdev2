function color_lign(a)
	{
		var trs = document.getElementById(a).getElementsByTagName('tbody')[0].getElementsByTagName('tr');
		
		if( trs[0].getElementsByTagName('td').length > 2 )
		{
			for( var i = 0; i < trs.length; i++ )
			{
				if( trim(trs[i].getElementsByTagName('td')[11].innerHTML) == 'DEPART' )
				{
					$(trs[i]).removeAttr('class');
					$(trs[i]).attr('class','depart');
				}else{
					$(trs[i]).removeAttr('class');
					$(trs[i]).attr('class','arrivee');
				}
			}
		}
	}
	
	
	var a = 'tck_list';
	var n = 10;
	var nv = '#page_1.navig_list_page';
	var aa = '1';
	pagination(a, n, nv, aa);
	
	var a = 'tck_list1';
	var n = 5;
	var nv = '#page_2.navig_list_page';
	var aa = '1';
	pagination(a, n, nv, aa);
	
	var f_line = document.getElementById('tck_list').getElementsByTagName('tbody')[0].getElementsByTagName('tr')[0];
	var message = $('#message');
	var m_txt = $('#mess_text');
	
	
	/////////////////////////////////////////////////////////////////////////////////////////////
	//																						   //		
	//   création de reservation : fonction de chargement des champs véhicules et chauffeurs;  //
	//																						   //
	/////////////////////////////////////////////////////////////////////////////////////////////
	//--> Begin
			
			function load_car_chf( a )
			{
				var xhr = getXMLHttpRequest();
				xhr.onreadystatechange = function() {
					if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
						$('#mess_text').html('');
						$('#ex_mess').show();
						l_c_c(xhr.responseXML, a);
					}else{
						$('#ex_mess').hide();
						$('#mess_text').html('<img src="'+$('#imgurl').val()+'24.gif'+'">');
					}
				};
				
				xhr.open("POST", "reservation/load_car_chf", true);
				xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				xhr.send(null);
			}
			
			function l_c_c(Ddata, Aa)
			{
				// alert(Ddata)
				var content = []
				content.push('<div style=" min-width:500px; background-color: white;">');
				content.push('<div class="title">Choix Vehicule - Chauffeur</div>')
				content.push('<table id="tab_ch" style="margin:10px; border: 1px solid lightgray; width:90%"><tr><td align="left" style="padding:10px;">');
				
				//-- partie voiture
				
					content.push('<b>Voitures disponibles : </b></td>');
					
					var cars = Ddata.getElementsByTagName("cars");
					// var attrs1 = cars[0].attributes;
					
					if( cars.length == 0 )
					{
						content.push('<td align="left"><p> Pas de véhicule disponible... </p></td></tr>');
					}else{
						content.push('<td align="left"><select id="ch_vtr" class="input_type">')
						content.push('<option></option>');
						for( var i = 0; i<cars.length; i++ )
						{
							content.push('<option value="'+cars[i].attributes[0].nodeValue+'-'+cars[i].attributes[2].nodeValue+'" > '+cars[i].attributes[1].nodeValue+" "+cars[i].attributes[3].nodeValue+' </option>');
						}
						
						content.push('</select></td></tr>');
					}
						
						
				if( Aa == "OUI"){	
					//-- partie chauffeur
					
					content.push('<tr><td align="left" style="padding:10px;"><b>Chauffeurs disponibles : </b></td>');
					
					var drvs = Ddata.getElementsByTagName("chfs");
				
					if( drvs.length == 0 )
					{
						content.push('<td align="left"><p> Pas de chauffeur disponible... </p></td></tr>');
					}else{
						content.push('<td align="left"><select id="ch_chr" class="input_type">')
						content.push('<option></option>');
						for( var i = 0; i<drvs.length; i++ )
						{
							content.push('<option value="'+drvs[i].attributes[0].nodeValue+'" > '+drvs[i].attributes[1].nodeValue+" "+drvs[i].attributes[2].nodeValue+' ('+drvs[i].attributes[3].nodeValue+') </option>');
						}
						
						content.push('</select></td></tr>');
					}
					
				}
				
				
				content.push('<tr><td align="left" style="padding:10px;"><b>Kilométrage : </b></td><td align="left"><input id="kilom" type="text" class="input_type"/></td></tr>');
					
				
				content.push('</table>');
				if(( Aa == "OUI" )  &&  ( drvs.length != 0 ) && (  cars.length != 0  )){
					content.push('<div style="padding-bottom:10px;"><input id="val_ch" class="tpl_button_insert" type="button" value="OK" onclick="_ok(this);">&nbsp;&nbsp;<input id="an_ch" class="button_action_ann" type="button" value="Annuler" onclick="_annuler();"></div>');
				}
				
				if(( Aa == "NON" ) && (  cars.length != 0  )){
					content.push('<div style="padding-bottom:10px;"><input id="val_ch" class="tpl_button_insert" type="button" value="OK" onclick="_ok(this);">&nbsp;&nbsp;<input id="an_ch" class="button_action_ann" type="button" value="Annuler" onclick="_annuler();"></div>');
				}
				
				content.push('<br></div>');
				var div_res = content.join("");
				
				var mess = $('#mess_text');
				mess.append(div_res);
				$('#date').datepick();
			}
			
		//--> End
	
	
	///////////////////////////
	//  Choix du formulaire  //
	///////////////////////////
	
	function modifier(a)
	{
		var tds = a.getElementsByTagName('td');
		var names = [];
		var visu = $('#visu');
		
		visu.html("");
		var check_rsrv = false;
		
		var content = [];
		
		var ths = document.getElementById('tck_list').getElementsByTagName('thead')[0].getElementsByTagName('th');
		for(var i = 0; i < ths.length; i++)
		{
			names.push(trim(ths[i].getElementsByTagName('a')[0].innerHTML));
		}
		
		for( var i=0; i<names.length-1; i++)
		{
			if( i == 0 )
			{
				content.push('<div id="t_div"> Fourmulaire N°');
				content.push(trim(tds[i].innerHTML)+'</div><div style="height:310px; max-height:350px; overflow-y:scroll; " ><table id="tab_visu" class="form" style="width:80%; margin:20px;"> <colgroup><col width ="35%"><col width="65%"></colgroup><tr style="display:none"><td align="left" class="label" style="height:25px;">');
				content.push(names[i]+'</td><td align="left">');
				content.push(trim(tds[i].innerHTML)+'</td></tr><tr><td align="left" class="label" style="height:25px;">');
			}else if((i > 0) && (i < names.length-6)){
				content.push(names[i]+'</td><td align="left">');
				content.push(trim(tds[i].innerHTML)+'</td></tr><tr><td align="left" class="label" style="height:25px;">');
			}else{
				// alert(names[i]);
				if( names[i] == "Chauffeur" )
				{
					content.push(names[i]+'</td><td align="left">');
					var chfr = ""
					if(trim(tds[i].innerHTML) == '1')
					{
						chfr = "OUI";
					}else{
						chfr = "NON";
					}
					content.push(chfr+'</td></tr>');
				}

				if( (names[i] == "Semaine") && (trim(tds[i].innerHTML) == '1') ){
					check_rsrv = true;
					content.push('<tr><td align="center" colspan="2" style="background-color:darkred; font-weight:bold; color:white; height:25px" > Réservé toute la semaine </td></tr>')
				}
				
				if( (names[i] == "Mois") && (trim(tds[i].innerHTML) == '1') ){
					check_rsrv = true;
					content.push('<tr><td align="center" colspan="2" style="background-color:darkred; font-weight:bold; color:white; height:25px" > Réservé tout le mois </td></tr>')
				}

				if( (names[i] == "alld") && (trim(tds[i].innerHTML) == '1') ){
					check_rsrv = true;
					content.push('<tr><td align="center" colspan="2" style="background-color:darkred; font-weight:bold; color:white; height:25px" > Réservé toute la journée </td></tr>')
				}
			}
		}
		content.push('<tr style="display:none;")><td id="valider" colspan="2">'+tds[names.length-1].innerHTML+'</td></tr>');
		content.push('</table></div><br>');
		var contentHTML = content.join("");
		content = null;
		
		visu.append(contentHTML);
		
		
		var valider = trim($('#valider').html());
		
		if(valider != '1')
		{
			if(check_rsrv == false)
			{
				visu.append('<input id="mod_res" value="Modifier réservation"  type="button" class="button_action_eqp_rubber"> &nbsp;&nbsp; ');
			}
			visu.append('<input id="cr_res"  value="Créer réservation" type="button" class="tpl_button_insert" /> &nbsp;&nbsp; '); 
			visu.append('<input id="an_res" value="Annuler réservation" type="button" class="button_action_ann"/> &nbsp;&nbsp;');
		}else{
			visu.append('<b>Réservation créée</b>');
		}
		
		visu.append('<input id="ann" value="Annuler" type="button" style="display:none;" class="button_action_ann"/>');
		
		var mod_res = $('#mod_res');
		var cr_res = $('#cr_res');
		var an_res = $('#an_res');
		var ann = $('#ann');
		
		var tab_visu = document.getElementById('tab_visu');
		
		var trs = tab_visu.getElementsByTagName('tr');
		
		var d1 = trim(trs[3].getElementsByTagName('td')[1].innerHTML);
		var d2 = trim(trs[4].getElementsByTagName('td')[1].innerHTML);
		var d3 = trim(trs[0].getElementsByTagName('td')[1].innerHTML);
		
		// les lignes de date-heure depart et date-heure retour
		var date_hr = trs[4].getElementsByTagName('td')[1];
		var date_hr_1 = trs[5].getElementsByTagName('td')[1];
		
		
		
		///////////////////////////////////////////////
		//  Modification d'un formulaire de demande  //
		///////////////////////////////////////////////
		
		mod_res.click(function(){
			var d1 = trim(trs[4].getElementsByTagName('td')[1].innerHTML);
			var d2 = trim(trs[5].getElementsByTagName('td')[1].innerHTML);
			var d3 = trim(trs[0].getElementsByTagName('td')[1].innerHTML);
			
			if( this.value == "Modifier réservation" ){
				cr_res.hide();
				an_res.hide();
				ann.show();
				mod_res.val("Envoyer Proposition");
				mod_res.attr("class","tpl_button_insert");
			
			
				date_hr.innerHTML = "";
				date_hr_1.innerHTML = "";
				
				var heures = [];
				var hs = [];
				for(var i = 0; i < 24; i++)
				{
					if(i < 10)
					{
						hs.push('0'+i);
					}else
					{
						hs.push(i);
					}
				}
				
				for(var i = 0; i < hs.length; i++)
				{
					heures.push(hs[i]+":00:00");
					heures.push(hs[i]+":30:00");
				}
				
				content = [];
				content.push('<option></option>');
				for(var i = 0; i < heures.length; i++)
				{
					content.push('<option value="'+heures[i]+'">'+heures[i]+'</option>');
				}
				var date = content.join("");
				content = null;
				
				//--- creation du input date 1 et 2
				
				//1
				$(date_hr).append('Date : <input id="dd"/>&nbsp;&nbsp; heure : <select id="hr_dep"></select>');
				$('#dd').datepick();
				
				//2
				$(date_hr_1).append('Date : <input id="dr"/>&nbsp;&nbsp; heure : <select id="hr_fin"></select>');
				$('#dr').datepick();
				
				//--- creation du select heure 1 et 2
				var hrd = $('#hr_dep');
				var hrf = $('#hr_fin');
				
				//1
				d1 = d1.split(' ');
				$('#dd').val(d1[0]);
				hrd.append(date);
				hrd.val(d1[1]);
				hrd.change(function(){
					if((this.value != "") && (hrf.val() != "") && ($('#dd').val() == $('#dr').val()))
					{
						if(this.value > hrf.val())
						{
							$('#mess_text').html("<p>Entrer une heure de depart inférieure à l'heure de retour... </p>");
							$('#message').show();
							$(this).val("");
							// $(this).focus();
						}
					}else if($('#dd').val() > $('#dr').val())
					{
						$('#mess_text').html("<p>Entrer une date de depart inférieure à la date de retour... <p>");
						$('message').show();
					}
				});
				
				//2
				d2 = d2.split(' ');
				$('#dr').val(d2[0]);
				hrf.append(date);
				hrf.val(d2[1]);
				hrf.change(function(){
					if((this.value != "") && (hrd.val() != "") && ($('#dd').val() == $('#dr').val()))
					{
						if(this.value < hrd.val())
						{
							$('#mess_text').html("<p>Entrer une heure de depart inférieure à l'heure de retour... </p>");
							$('#message').show();
							$(this).val("");
							// $(this).focus();
						}
					}else if($('#dd').val() > $('#dr').val())
					{
						$('#mess_text').html("<p>Entrer une date de depart inférieure à la date de retour... <p>");
						$('message').show();
					}
				});
			}else{
				send_mod(d3, $('#dd').val(), $('#hr_dep').val(), $('#dr').val(), $('#hr_fin').val());
				// mod_hr(d3, $('#dd').val(), $('#hr_dep').val(), $('#dr').val(), $('#hr_fin').val(), $('#showf'));
			}
		});
		
		
		
		
		/////////////////////////////////////////////////
		//  Annulation d'un formulaire de réservation  //
		/////////////////////////////////////////////////
		
		ann.click(function(){
			cr_res.show();
			an_res.show();
			ann.hide();
			mod_res.val("Modifier réservation");
			mod_res.attr("class","button_action_eqp_rubber");
			date_hr.innerHTML = d1;
			date_hr_1.innerHTML = d2;
		});
		
		var alt = trim(document.getElementById('tab_visu').getElementsByTagName('tr')[9].getElementsByTagName('td')[1].innerHTML);
		
		
		
		//////////////////////////////////
		//  Création d'une réservation  //
		//////////////////////////////////
			
		cr_res.click(function(){
			load_car_chf( alt );
			var message = $('#message');
			message.show();
			
			$('#date').datepick();
		});
		
		line_color(a, "tck_list");
	}
	
	
	
	function ctrl_kil(){
		if($('#ch_vtr').val() == '')
		{
			alert("Veuillez d'abord choisir le véhicule affacté SVP...");
			$('#kilom').focus();
		}else if (isNaN($('#kilom').val()) == true)
		{
			alert('Veuillez entrer une valeur numérique');
			$('#kilom').val("");
		}
	}
	
	function _ok(){
		
		var vtr = $('#ch_vtr').val();
		var k = vtr.split('-');
		if( isNaN($('#kilom').val()) == true ) 
		{
			alert('Veuillez entrer une valeur numérique');
			$('#kilom').val("");
			return false;
		} else if(parseInt(k[1]) > parseInt($('#kilom').val()))
		{
			alert('Veuillez entrer un nombre supérieur ou égal au kilométrage actuel du véhicule...');
			return false;
		}
		
		if( ($('#kilom').val() == "") || ($('#ch_vtr').val() == "") || ($('#ch_chr').val() == "") )
		{
			alert("Veuillez remplir tous les champs...");
			return false;
		}
	
		
		var param1 = trim(document.getElementById('tab_visu').getElementsByTagName('tr')[0].getElementsByTagName('td')[1].innerHTML);
		var param2 = $('#ch_vtr').val();
		var param3 = "";
		
		if( $('#ch_chr').length != 0 )
		{
			param3 = $('#ch_chr').val();
		}
		
		create_res(param1, param2, param3, $('#kilom').val(), "OK");
	}
	
	function _annuler(){
		$('#ex_mess').trigger('click');
	}
	
	$(f_line).trigger('click');
	
	/////////////////////////////////
	//   Fais disparaitre les div  //
	/////////////////////////////////
	
	function remove_p(el)
	{
		var parent = $(el).parent();
		$(parent).remove();
	}
	
	////////////////////////////////////////////////////////////////////////////
	//   Chargement des véhicules uniquement from fonction modifier_res()...  //
	////////////////////////////////////////////////////////////////////////////
	
	// ----> Debut
		function load_v()
		{
			var xhr = getXMLHttpRequest();
			xhr.onreadystatechange = function() {
				if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
					// $('#mess_text').html('');
					// $('#ex_mess').show();
					l_v(xhr.responseXML);
				}else{
					// $('#ex_mess').hide();
					// $('#mess_text').html('<img src="'+$('#imgurl').val()+'24.gif'+'">');
				}
			};
			
			xhr.open("POST", "reservation/load_car_chf", true);
			xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			xhr.send(null);
		}
		
		function l_v(Ddata)
		{
			
			var content = []
			if( $("#div_v").length == 0 )
			{
				content.push('<div id="div_v" style="background-color: white;">');
				content.push('<div class="img_clk" onclick="remove_p(this);" style="right:30px;" ><img src="'+$('#imgurl').val()+'exit_mini.png'+'" style="vertical-align:middle;" /> &nbsp; Fermer</div><div class="title"> Changer Véhicule </div>')
				
				content.push('<br><p><b>Voitures disponibles : &nbsp;&nbsp;&nbsp;</b>');
					
					var cars = Ddata.getElementsByTagName("cars");
					// var attrs1 = cars[0].attributes;
					
					if( cars.length == 0 )
					{
						content.push('<p> Pas de véhicule disponible... </p></tr>');
					}else{
						content.push('<td><select id="ch_vtr" class="input_type">')
						content.push('<option></option>');
						for( var i = 0; i<cars.length; i++ )
						{
							content.push('<option value="'+cars[i].attributes[0].nodeValue+'-'+cars[i].attributes[2].nodeValue+'" > '+cars[i].attributes[1].nodeValue+" "+cars[i].attributes[3].nodeValue+' </option>');
						}
						
						content.push('</select></p><input style="margin-bottom:20px;" type="button" class="tpl_button_insert" onclick="_ref_ch();" value="Changer"/></div>');
					}

				
				var cont = content.join("");
				$('#mess_text').append(cont);
			}
		}
	// ----> fin
	
	
	////////////////////////////////////////////////////////////////////////////
	//   Chargement des chauffeurs uniquement from fonction modifier_res()...  //
	////////////////////////////////////////////////////////////////////////////
	
	// ----> Debut
		function load_c()
		{
			var xhr = getXMLHttpRequest();
			xhr.onreadystatechange = function() {
				if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
					// $('#mess_text').html('');
					// $('#ex_mess').show();
					l_c(xhr.responseXML);
				}else{
					// $('#ex_mess').hide();
					// $('#mess_text').html('<img src="'+$('#imgurl').val()+'24.gif'+'">');
				}
			};
			
			xhr.open("POST", "reservation/load_car_chf", true);
			xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			xhr.send(null);
		}
		
		function l_c(Ddata)
		{
			if( $("#div_ch").length == 0 )
			{
				var content = []
				content.push('<div id="div_ch" style="background-color: white;">');
				content.push('<div class="img_clk" onclick="remove_p(this);" style="right:30px;" ><img src="'+$('#imgurl').val()+'exit_mini.png'+'" style="vertical-align:middle;" /> &nbsp; Fermer</div><div class="title"> Changer Chauffeur </div>')
				
				content.push('<br><p><b>Chauffeurs disponibles : &nbsp;&nbsp;&nbsp;</b>');
					
					var drvs = Ddata.getElementsByTagName("chfs");
					
					if( drvs.length == 0 )
					{
						content.push('<p> Pas de Chauffeur disponible... </p></tr>');
					}else{
						content.push('<td><select id="ch_vtr" class="input_type">')
						content.push('<option></option>');
						for( var i = 0; i<drvs.length; i++ )
						{
							content.push('<option value="'+drvs[i].attributes[0].nodeValue+'" > '+drvs[i].attributes[1].nodeValue+" "+drvs[i].attributes[2].nodeValue+' ('+drvs[i].attributes[3].nodeValue+') </option>');
						}
						
						content.push('</select></p><input style="margin-bottom:20px;" type="button" class="tpl_button_insert" onclick="_ref_ch();" value="Changer"/></div>');
					}

				
				var cont = content.join("");
				$('#mess_text').append(cont);
			}
		}
	// ----> fin
	
	///////////////////////////////////////////////////////
	//  Contrôle des statuts aves les champs conceernés  //
	///////////////////////////////////////////////////////
	
	//---> debut
	function _ch_st(){
		
		var ch_st = document.getElementById('ch_st');
		var lb_st = document.getElementById('lb_st');
		var newdate = document.getElementById('newdate');
		var trs_ch = document.getElementById('tab_modres').getElementsByTagName('tr');
		var newkilo = document.getElementById('newkilo');
		var new_int = document.getElementById('new_int');
		var lien = $(ch_st).css('background-image').split('/');
		
		var t = lien.length-1;
		
		if((lien[t] == "right.png\")") || (lien[t] == "right.png)"))
		{
			
			$(ch_st).hide();
			
			if(trim($(lb_st).text()) == "STAND BY")
			{
				$(lb_st).text("DEPART");
				$(lb_st).attr('style','display:inline-block; width:70px;; border-radius:10px 10px 10px 10px; background-color:darkgreen; color:white; vertical-align:top; padding:5px; border: 1px solid black;');
				trs_ch[6].getElementsByTagName('td')[0].innerHTML = "<b>heure de départ : </b>";
				trs_ch[7].getElementsByTagName('td')[0].innerHTML= "<b>kilometrage départ : </b>";
				trs_ch[6].style.display = "";
				trs_ch[7].style.display = "";
				
			}else if(trim($(lb_st).text()) == "DEPART") {
				$(lb_st).text("RETOUR");
				$(lb_st).attr('style','display:inline-block; width:70px;; border-radius:10px 10px 10px 10px; background-color:darkred ; color:white; vertical-align:top; padding:5px; border: 1px solid black;');
				trs_ch[6].getElementsByTagName('td')[0].innerHTML = "<b>heure d'arrivée : </b>";
				trs_ch[7].getElementsByTagName('td')[0].innerHTML= "<b>kilometrage arrivée : </b>";
				trs_ch[6].style.display = "";
				trs_ch[7].style.display = "";
			}
			
		}
	}
	//---> fin
	
	////////////////////////////////////////////////////
	///  Déclenché par le clic sur une réservation   ///
	////////////////////////////////////////////////////
	
	function modifier_res(a){
		message.show();
		$('#messcontent').css('position','absolute');
		m_txt.html("");
		var tds = a.getElementsByTagName('td');
		
		//date format courant
		
		var date = trim(tds[2].innerHTML).split('-');
		var mois = new Array("Janvier", "Fevrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Decembre");
		
		var cur_date = trim(date[2]+' '+mois[parseInt(date[1])-1]+' '+date[0]);
		var butt_c = "";
		var butt_v = "";
		
		if(tds[1].innerText != "RETOUR")
		{
			var butt_c = '<span onclick="load_c()" style="float:right" ><img style="vertical-align:middle;" class="img_clk" src="'+$('#imgurl').val()+'edit.png'+'" /></span>';
			var butt_v = '<span onclick="load_v()" style="float:right" ><img style="vertical-align:middle;" class="img_clk" src="'+$('#imgurl').val()+'edit.png'+'" /></span>';
			
			
		}
		
		var content = [];
		content.push('<div id="ctrl_res">');
		
		//--- contenu ------//
		content.push('<div align="center" class="title">Réservation N°'+tds[0].innerHTML+' du '+cur_date+'</div><br>');
		content.push('<table id="tab_modres" style="margin-left:30px; width:80%"><tr>');
		content.push('<td align="left"><b>Demandeur : </b></td><td align="left">');
		content.push(tds[5].innerHTML+'</td></tr><tr>');
		content.push('<td align="left"><b>Depart prévu le : </b></td><td align="left">');
		content.push(tds[3].innerHTML+'</td></tr><tr>');
		content.push('<td align="left"><b>Retour prévu le : </b></td><td align="left">');
		content.push(tds[4].innerHTML+'</td></tr><tr>');
		content.push('<td align="left"><b>Chauffeur : </b></td><td align="left"><input type="hidden" id="cd_dem" value="');
		content.push(tds[9].getElementsByTagName('input')[0].value+'">');
		content.push(tds[9].innerHTML+butt_c+'</td></tr><tr>');
		content.push('<td align="left"><b>Avec le véhicule : </b></td><td align="left"><input type="hidden" id="cd_dem" value="');
		content.push(tds[6].getElementsByTagName('input')[0].value+'">');
		content.push(tds[6].innerText+' &nbsp;&nbsp;&nbsp; <b>( Marque-Modèle : </b>'+tds[7].innerHTML+'<b>)</b>'+butt_v+'</td></tr><tr>');
		
		if(tds[1].innerText == "STAND BY")
		{
			content.push('<td><b> Statut : </b></td><td td align="left"><div id="lb_st" align="center" style="display:inline-block; width:70px; height:35px;  background-color:#fff; color:black; border-radius:10px 10px 10px 10px; vertical-align:top; padding:5px; border: 1px solid black;">');
		}else if(tds[1].innerText == "DEPART"){
			content.push('<td><b> Statut : </b></td><td td align="left"><div id="lb_st" align="center" style="display:inline-block; width:70px; height:35px;  background-color: darkgreen; color:white; border-radius:10px 10px 10px 10px; vertical-align:top; padding:5px; border: 1px solid black;">');
		}else{
			content.push('<td><b> Statut : </b></td><td td align="left"><div id="lb_st" align="center" style="display:inline-block; width:70px; height:35px;  background-color: darkred; color:white; border-radius:10px 10px 10px 10px; vertical-align:top; padding:5px; border: 1px solid black;">');
		}
		
		content.push(tds[1].innerHTML+'</div> &nbsp;&nbsp;&nbsp; ');
		
		if(tds[1].innerText != "RETOUR")
		{
			content.push('<div style="display:inline-block; margin-top:5px;" onclick="_ch_st();"><input id="ch_st" type="button" class="arrow rightimg"> </div>');
		}
		content.push('</td></tr>');
		content.push('<tr style="display:none;"><td align="left"></td><td align="left"> <select id="newdate" class="input_type">');
			var heures = [];
				var hs = [];
				for(var i = 0; i < 24; i++)
				{
					if(i < 10)
					{
						hs.push('0'+i);
					}else
					{
						hs.push(i);
					}
				}
				
				for(var i = 0; i < hs.length; i++)
				{
					heures.push(hs[i]+":00:00");
					heures.push(hs[i]+":30:00");
				}
				
				content.push('<option></option>');
				for(var i = 0; i < heures.length; i++)
				{
					content.push('<option value="'+heures[i]+'">'+heures[i]+'</option>');
				}
		content.push('</select></td></tr> <tr style="display:none;"><td align="left"></td><td align="left"><input id="newkilo" type="text" class="input_type"></td></tr></table>');
		if(tds[1].innerText != "RETOUR")
		{
			content.push('<br><div> <input id="val_mod" class="tpl_button_insert" type="button" value="OK"></div>');				
		}

		content.push('<div  style="height:25px; visibility:visible;"><div id="mess_res" style="display:none;"><p>Veuillez changer le statut de la réservation avant de valider...</p></div></div>');
		content.push('</div>');
		
		var ctrl_res = content.join("");
		
		m_txt.append(ctrl_res);				
		
		var val_mod = $('#val_mod');
		val_mod.click(function(){
			var stat = trim(trs_ch[5].getElementsByTagName('td')[1].getElementsByTagName('div')[0].innerText);
			var check = false;
			var mess_res = $('#mess_res');
			if(trim(tds[1].innerText) == stat)
			{
				var mess_res = $('#mess_res');
				mess_res.html('<p>Veuillez changer le statut de la réservation avant de valider...</p>');
				mess_res.fadeIn();
				window.setTimeout(function(){mess_res.fadeOut();}, 5000);
				check = true;
			}
			
			if((stat == "DEPART") && ($(newdate).val() == ""))
			{
				mess_res.html('<p>Veuillez remplir tous le champs ...</p>');
				mess_res.fadeIn();
				window.setTimeout(function(){mess_res.fadeOut();}, 3000);
				check = true;
			}else if ((stat == "RETOUR") && (($(newdate).val() == "") || ($(newkilo).val() == ""))){
				mess_res.html('<p>Veuillez remplir tous les champs...</p>');
				mess_res.fadeIn();
				window.setTimeout(function(){mess_res.fadeOut();}, 3000);
				check = true;
			}
			
			if(check == false){
			
				var num = trim(tds[0].innerHTML);
				var nkilo = $('#newkilo').val();
				var ndate = $('#newdate').val();
				create_res(num, stat, nkilo, ndate, "change");
			}
		});
		
		var ch_veh = $('#ch_veh');
		ch_veh.click(function(){
			
		});
	}
	