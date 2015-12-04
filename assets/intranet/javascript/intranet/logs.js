
function refresh_log()
{
	$('#tb_solution').html("<td colspan=\"5\" align=\"center\" style=\"height:30px;\"> <p> <b> <img src='"+$('#imgurl').val()+"12.gif' /> </b> </p> </td>");
	var param = [{ "name":"test", value:"" }];
	
	var check = false;
	var param = [];
	
		if( $('#name_user').val() != "" )
		{
			var n_id = $('#name_user').attr('name').split('_');
			param.push( { "name": "name_user", value: n_id[2] } );
		}
		
		if( $('#Formulaire').attr('checked') == true )
		{
			param.push( { "name": "form", value: 1 } );
		}
		
		if( $('#Reservation').attr('checked') == true )
		{
			param.push( { "name": "res", value: 1 } );
		}
		
		if( $('#Logs').attr('checked') == true )
		{
			param.push( { "name": "log", value: 1 } );
		}
		
		if( $('#Chauffeurs').attr('checked') == true )
		{
			param.push( { "name": "chf", value: 1 } );
		}
		
		if( $('#Vehicules').attr('checked') == true )
		{
			param.push( { "name": "veh", value: 1 } );
		}
		
		if( $('#begin').val() != "" )
		{
			param.push( { "name": "beg", value: $('#begin').val() } );
		}
		
		if( $('#end').val() != "" )
		{
			param.push( { "name": "end", value: $('#end').val() } );
		}
		
	$.post('refresh_logs', param, function(data){
		if(data)
		{
			// alert( data.results.length);
			$('#tb_solution').html("");
			for( var i = 0; i < data.results.length; i++ )
			{
				var text = "";
				var js = "";
				var tr = document.createElement('tr');
				// style=\"visibility: visible; display: table-row;\" class=\"".$class."\"
				tr.setAttribute("style", "visibility: visible; display: table-row;");
				
				if( i % 2 == 0 )
				{
					var rclass = "altcol row_sol";
				}else{
					var rclass = "row_sol";
				}
				
				tr.setAttribute("class", rclass);
				// alert(data.results[i].length);
				
					var td = document.createElement('td');
					td.setAttribute("style","height:20px; padding-top:10px; overflow:hidden;");
					td.setAttribute("class","solution_title align_center");
					td.appendChild( document.createTextNode( "# "+data.results[i].id ) );
					tr.appendChild(td);
				
					var td = document.createElement('td');
					td.setAttribute("style","height:20px; padding-top:10px; overflow:hidden; border-left: 1px dotted lightgray;");
					td.setAttribute("class", "solution_title align_center");
						var div = document.createElement('div');
						div.setAttribute("class", "solution_title");
						div.appendChild( document.createTextNode( data.results[i].date ) );
					td.appendChild(div);
					tr.appendChild(td);
					
					var td = document.createElement('td');
					td.setAttribute("style","height:20px; padding-top:10px; overflow:hidden; border-left: 1px dotted lightgray;");
					td.setAttribute("class", "solution_title align_center");
						// alert(data.results[i].targ);
						if( data.results[i].targ != null )
						{
							var target = ( data.results[i].targ ).split('_');
							var a = document.createElement("a");
							a.setAttribute("style","text-decoration:none;");
							var check_ = false;
							if( target[0] == "formulaire")
							{
								text = "Formulaire N. "+target[1];
								js = "open_form("+target[1]+")";
								check_ = true;
							}else if( target[0] == "reservation")
							{
								text = Utf8.decode("Réservation N. ")+target[1];
								js = "open_res("+target[1]+")";
								check_ = true;
							}else if( target[0] == "chauffeur")
							{
								text = "Chauffeur N. "+target[1];
								js = "open_chf("+target[1]+")";
								check_ = true;
							}else if( target[0] == "vehicule")
							{
								text = Utf8.decode("Véhicule N. ")+target[1];
								js = "open_veh("+target[1]+")";
								check_ = true;
							}
							
							if( check_ == true )
							{
								a.setAttribute("href","javascript:"+js);
								a.appendChild( document.createTextNode( text ) );
							}else{
								a = document.createTextNode( "--------" );
							}
							
							
							td.appendChild( a );
						}else{
							td.appendChild(  document.createTextNode( "--------" ) );
						}	
					
					// document.createTextNode( data.results[i].targ ) );
					tr.appendChild(td);
				
					var td = document.createElement('td');
					td.setAttribute("style","height:20px; padding-top:10px; overflow:hidden; border-left: 1px dotted lightgray;");
					td.setAttribute("valign","top");
						var div = document.createElement('div');
						div.setAttribute("class", "solution_title");
						div.appendChild( document.createTextNode( data.results[i].lib ) );
					td.appendChild( div );
					tr.appendChild(td);
					
					var td = document.createElement('td');
					td.setAttribute("style","height:20px; padding-top:10px; overflow:hidden; border-left: 1px dotted lightgray;");
					td.setAttribute("class","solution_title align_center");
						var div = document.createElement('span');
						div.setAttribute("class", "people");
						div.appendChild( document.createTextNode( ( data.results[i].Acteur != "" ) ? data.results[i].Acteur : "SYSTEM" ) );
					td.appendChild( div );
					tr.appendChild(td);
					
					// var td = document.createElement('td');
					// td.setAttribute("style","height:20px; padding-top:10px;");
					// td.appendChild(  data.results[i].id );
					// tr.appendChild(td);
					
					// var td = document.createElement('td');
					// td.setAttribute("style","height:20px; padding-top:10px;");
					// td.appendChild(  data.results[i].id );
					// tr.appendChild(td);
				
				$('#tb_solution').append(tr);
			}
			
		}
	}, "json");	
}

// setInterval( function(){
	// refresh_log();
// }, 30000 );

$('#begin').datepick();
$('#end').datepick();
