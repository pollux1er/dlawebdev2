	var lien = $('#base').val()+"reservation/";
	
	function open_res( res )
	{
		if( isNaN(res) )
		{
			var r_id1 = res.getElementsByTagName('a')[0].getElementsByTagName('input')[0].value;
		}else{
			var r_id1 = res;
		}
		
		var param = [
						{ 'name': 'id', value: r_id1},
						{ 'name': 'field', value: "idreservation"},
						{ 'name': 'table', value: "Reservation"}
					];
		
		$.post( lien+'id_exist', param, function(data){
			if(data)
			{
				if( data.exist == true )
				{
					if( $('#module').val() == "Reservation" )
					{
						
						$('#id_res').val( r_id1 );
						$('#id1').val( r_id1 );
						$('#show_res').html(" <tr><td colspan='10' align='center'> <img src='"+$('#imgurl').val()+"12.gif' > </td></tr> ")
						
						post_els( $('#id').val(), r_id1, "yes" );
						
					}else{
						if( $('#module').val() == 'Logs' )
						{
							window.location.assign("../reservation?id_res="+r_id1);
						}else{
							window.location.assign("./reservation?id_res="+r_id1);
						}
					}
				}else{
					$('#mess_text').html( "<p>Cet &eacute;l&eacute;ment n'existe plus (Il pourrait avoir &eacute;t&eacute; supprim&eacute;...)</p>" );
					$('#message').show();
					window.setTimeout( function(){
						$('#message').fadeOut();
					}, 2000);
				}
				
			}
		}, 'json' );
			
	}
	
	function open_form( form )
	{
		if( isNaN(form) )
		{
			var r_id = form.getElementsByTagName('a')[0].getElementsByTagName('input')[0].value;
		} else {
			var r_id = form;
		}
		
		var param = [
						{ 'name': 'id', value: r_id},
						{ 'name': 'field', value: "idformulaire"},
						{ 'name': 'table', value: "Formulaire"}
					];
		
		$.post( lien+'id_exist', param, function(data){
			if(data)
			{
				if( data.exist == true )
				{
					var assign = "";
					
					if( $('#module').val() == "Reservation" )
					{
						if( data.cible == "showf" )
						{
							if( $('#new_form').css('visibility') == 'visible' )
							{
								$('#ex_des').trigger('click');
							}
							post_els( r_id, $('#id1').val(), "yes" );
						}else{
							$('#new_form').css('visibility','visible');
							$('#n_val').val("n_form_show"); 
							$('#n_form_show').html(" <tr><td colspan='4' align='center'> <img src='"+$('#imgurl').val()+"12.gif' > </td></tr> ");
							charg_folder(r_id);
						}
						
					} else {
					
						if( data.cible == "showf" )
						{
							assign = "reservation?id=";
						}else{
							assign = "reservation?id2=";
						}
						
						if( $('#module').val() == 'Logs' )
						{
							window.location.assign("../"+assign+r_id);
						} else {
							window.location.assign("./"+assign+r_id);
						}
					}
				}else{
					$('#mess_text').html( "<p>Cet &eacute;l&eacute;ment n'existe plus (Il pourrait avoir &eacute;t&eacute; supprim&eacute;...)</p>" );
					$('#message').show();
					window.setTimeout( function(){
						$('#message').fadeOut();
					}, 2000);
				}
			}
		}, 'json' );
	}	
	
	function open_chf( chf )
	{
		var param = [
						{ 'name': 'id', value: chf},
						{ 'name': 'field', value: "idchauffeur"},
						{ 'name': 'table', value: "Chauffeur"}
					];
		
		$.post( lien+'id_exist', param, function(data){
			if(data)
			{
				if( data.exist == true )
				{
					window.location.assign("../chauffeur?id="+chf);
				}else{
					$('#mess_text').html( "<p>Cet &eacute;l&eacute;ment n'existe plus (Il pourrait avoir &eacute;t&eacute; supprim&eacute;...)</p>" );
					$('#message').show();
					window.setTimeout( function(){
						$('#message').fadeOut();
					}, 2000);
				}
			}
		}, 'json' );
	}
	
	function open_veh( veh )
	{
		var param = [
						{ 'name': 'id', value: veh},
						{ 'name': 'field', value: "idvehicule"},
						{ 'name': 'table', value: "Vehicule"}
					];
		
		$.post( lien+'id_exist', param, function(data){
			if(data)
			{
				if( data.exist == true )
				{
					window.location.assign("../vehicule?id="+veh);
				}else{
					$('#mess_text').html( "<p>Cet &eacute;l&eacute;ment n'existe plus (Il pourrait avoir &eacute;t&eacute; supprim&eacute;...)</p>" );
					$('#message').show();
					window.setTimeout( function(){
						$('#message').fadeOut();
					}, 2000);
				}
			}
		}, 'json' );
	}
	
	// Ouverture du tableau des resevations à distance (Au chargement de la page)
	
	if( ( $("#module").val() == "Reservation") )
	{
		if( ( $('#id2').val() != "" ) && ( !isNaN($('#id2').val()) )  )
		{
			open_form( $('#id2').val() );
		}
		
		if( ( $('#id_res').val() != "" ) && ( !isNaN($('#id_res').val()) )  )
		{
			open_res( $('#id_res').val() );
		}
	}
	
	function charg_alert( n )
	{
		var param = [];
		
		var past_num = parseInt( (( $('#past_num1').val() == "") ? 0 : $('#past_num1').val() ) );
		
		$.post("reservation/alert", param, function (data_ret) {
			if( data_ret )
			{
				var lin = data_ret.getElementsByTagName('message');
				var num = data_ret.getElementsByTagName('num');
				
				var current_num = parseInt(num[0].attributes[0].nodeValue);
				
				if( current_num != 0 )
				{
				
					$(n).html( current_num );
					$(n).show();
					if( past_num < current_num )
					{
						// $("#bip").html("<embed src=\""+$('#sonurl').val()+"bip1.mp3\" loop=\"false\" hidden=\"true\" volume=\"5\" autostart=\"true\" />");
						if( $('#new_form').css('visibility') == "visible" )
						{
							charg_folder( $('#id2').val() );
						}
					}
					
					$('#past_num1').val( current_num );
					
				} else {
					$(n).hide();
				}
				// var as = $("#retard a");
				
				if(( $("#body_al").length != 0 ) && ($("#a_num_al").css("left") == "-25px"))
				{
					if( lin.length != 0 )
					{
						var ul = document.createElement('ul');
						ul.setAttribute('id','cont_li');
						ul.setAttribute("align","left");
						
						for( var i = 0; i < lin.length; i++ )
						{
							var li = document.createElement('li');
								li.setAttribute("align","left");
								li.setAttribute("onclick","open_form(this);")
							
							var a = document.createElement('a');
								a.setAttribute("align","left");
								
							var span = document.createElement('span');
								span.setAttribute("align","left");
								span.setAttribute("style","padding-left:20px;")
								
							var text = document.createTextNode( (i+1)+")  Formulaire N. "+lin[i].attributes[0].nodeValue+" "+lin[i].attributes[1].nodeValue);
							var inp = document.createElement('input');
								inp.setAttribute("id","form_"+i);
								inp.setAttribute("type","hidden");
								inp.setAttribute("value",lin[i].attributes[0].nodeValue);
								
								span.appendChild(text);
								a.appendChild(span);
								a.appendChild(inp);
								li.appendChild(a);
								
								ul.appendChild(li);
						}
						$("#body_al").attr("align","left");
						$("#body_al").html(ul);
						$('#corn_img').hide();
					} else {
						$("#body_al").attr("align","center");
						$("#body_al").html("<div style='background-color:white;'> Aucune Alerte enregistree... </div>");
						$('#corn_img').hide();
					}
				}
			}
		}, "xml");
	}
	
	function charg_late( n )
	{
		var param = [];
		
		var past_num = parseInt( (( $('#past_num').val() == "") ? 0 : $('#past_num').val() ) );
		
		$.post("reservation/retard", param, function(data_ret) {
			if( data_ret )
			{
				var lin = data_ret.getElementsByTagName('message');
				var num = data_ret.getElementsByTagName('num');
				
				var current_num = parseInt(num[0].attributes[0].nodeValue);
				
				if( current_num != 0 )
				{
					// alert( current_num );
					$(n).html( current_num );
					$(n).show();
					if( past_num < current_num )
					{
						// $("#bip").html("<embed src=\""+$('#sonurl').val()+"bip1.mp3\" loop=\"false\" hidden=\"true\" volume=\"5\" autostart=\"true\" />");
					}
					
					$('#past_num').val( current_num );
					
				} else {
					$(n).hide();
				}
				// var as = $("#retard a");
				
				if(( $("#body_al").length != 0 ) && ($("#a_num_ret").css("left") == "-25px"))
				{
					if( lin.length != 0 )
					{
						var ul = document.createElement('ul');
						ul.setAttribute('id','cont_li');
						ul.setAttribute("align","left");
						
						for( var i = 0; i < lin.length; i++ )
						{
							var li = document.createElement('li');
								li.setAttribute("align","left");
								li.setAttribute("onclick","open_res(this);")
							
							var a = document.createElement('a');
								a.setAttribute("align","left");
								
							var span = document.createElement('span');
								span.setAttribute("align","left");
								span.setAttribute("style","padding-left:20px;")
								
							var text = document.createTextNode( (i+1)+")  Reservation N. "+lin[i].attributes[0].nodeValue+" "+lin[i].attributes[1].nodeValue);
							var inp = document.createElement('input');
								inp.setAttribute("id","res_"+i);
								inp.setAttribute("type","hidden");
								inp.setAttribute("value",lin[i].attributes[0].nodeValue);
								
								span.appendChild(text);
								a.appendChild(span);
								a.appendChild(inp);
								li.appendChild(a);
								
								ul.appendChild(li);
						}
						$("#body_al").attr("align","left");
						$("#body_al").html(ul);
						$('#corn_img').hide();
					} else {
						$("#body_al").attr("align","center");
						$("#body_al").html("<div style='background-color:white;'> Aucune Alerte enregistree... </div>");
						$('#corn_img').hide();
					}
				}
			}
		}, "xml" );
	}
	
	function gen_alert( IdTyp )
	{
		var type = $(IdTyp).attr('id');
		var title = "";
		if(type == "alert")
		{
			var cl1 = "suit1";
			title = "Alertes";
			// var cl3 = "";
		} else {
			var cl1 = "suit2";
			title = "Retards";
			// var cl3 = "";
		}
		
		var pos = $(IdTyp).offset();
		var cont = "";
		if( $("#show_al").length == 0 ) 
		{
			var cont = "<div id='show_al' class='"+cl1+"' style=' left:"+parseInt(pos.left)+"px; top:"+(parseInt(pos.top) + 70 )+"px; '><div id='title_al' class='' align='center'> "+title+" </div><div id='body_al' align='center' class=''> <img style='margin-top:25px;' src='"+$('#imgurl').val()+"12.gif"+"'/> </div><div style='height:10px; background-color:lightgray; border-radius: 0 0 10px 0; border:1px solid gray;'>  </div></div>";
		}else{
			$("#show_al").attr("class", cl1).attr("style", "left:"+parseInt(pos.left)+"px; top:"+(parseInt(pos.top) + 70 )+"px;");
			$('#title_al span').html( title );
		}
		
		return cont;
	}
	
	$( "#div_alert .alert a" ).click(function() {
		var pdiv = this.parentElement;
		var b_pdiv = pdiv.parentElement;
		var div = pdiv.getElementsByTagName('div')[0];
		
		if( $(this).css("left") == "-125px" )
		{	
			if( $("#show_al").length != 0 )
			{
				$("#show_al").hide();
			}
			
			$( this ).animate({
				left: "+=100"
			}, 500, function() {
				$(this).css("z-index","10");
				$("#body_content").append( gen_alert( pdiv ) );
				if( $(pdiv).attr("id") == "retard" )
				{
					$("#body_al").html( charg_late( div ) );
				}else{
					$("#body_al").html( charg_alert( div ) );
				}	
			});
			
			$( div ).animate({
				left: "+=100"
			}, 500, function() {
				$(this).css("z-index","11");
			});
		} else if( $(this).css("left") == "-25px" )
		{
			$("#show_al").hide();
			$('#body_al').html("<img style='margin-top:25px;' src='"+$('#imgurl').val()+"12.gif"+"'/>");
			$( this ).animate({
				left: "-=100"
			}, 500, function() {
				$(this).css("z-index","5");
			});
			
			$( div ).animate({
				left: "-=100"
			}, 500, function() {
				$(this).css("z-index","6");
			});
		}
		
		if( $(pdiv).attr("id") == "alert" )
		{
			var a = $("#retard a");
			if( $(a[0]).css("left") != "-125px" )
			{
				$(a[0]).trigger("click");
			}
		}else{
			var a = $("#alert a");
			if( $(a[0]).css("left") != "-125px" )
			{
				$(a[0]).trigger("click");
			}
		}
	});
	
	function check_rel()
	{
		var param = [];
		
		$.post('reservation/check_relance', param, function(_data){
			if(_data)
			{
				var data = _data.split('@@');
				
				if( data.length == 2 )
				{
					if( !(isNaN(data[0])) )
					{
						var param = [ { "name":"id", value:data[0] }, { "name":"ids", value:data[1] } ];
						$.post('reservation/send_mail', param, function(data1){
							if(data1)
							{	
							}
						}, "text");
					}else{
						// alert("dd");
						var param = [ { "name":"form", value:data[1] } ];
						$.post('reservation/val_gest', param, function(data1){
							if(data1)
							{	
							}
						}, "text");
					}
					
				}else if( data.length == 1 ){
					//apres la restructuration de table User (id_line, line, valideur);
					if( !(isNaN(data[0])) )
					{
						var param = [ { "name":"id", value:data[0] } ];
						$.post('reservation/send_mail', param, function(data1){
							if(data1)
							{
							}
						}, "text");
					}
				}
			}
		}, "text");
	}
	
	charg_late( $('#num_ret') );
	charg_alert( $('#num_al') );
	
	setInterval(function(){ 
		// $("#body_al").attr("align","center");
		if( $("#body_al").html() == "" )
		{
			$('#body_al').html("<img style='margin-top:25px;' src='"+$('#imgurl').val()+"12.gif"+"'/>");
		}else{
			$('#corn_img').show();
		}
		
		check_rel();
		
		
		
		charg_late( $('#num_ret') );
		charg_alert( $('#num_al') );
		
	}, 5000);
	
	setInterval(function(){ 
			if( $('#new_form').css('visibility') == "visible" )
			{
				charg_folder( $('#id2').val() );
			}
		}, 15000);
	