

function load_rw( data, Ac )
{
	// alert(data);
	var nodes = data.getElementsByTagName('item');
	if(nodes.length != 0)
	{
		$('#div_show').show();
		$('#empty').hide();
		
		var att = data.getElementsByTagName('nbre')[0].attributes[0].nodeValue;
		$('#record').html(att+" El&eacute;ment(s)" );
		
		var content = [];
		for( var i = 0 ; i < nodes.length ; i++ )
		{
			content.push('<tr class="altcol cmd" onclick="modifier_res(this)" >');
			var tds = nodes[i].attributes;
			for ( var j = 0; j < tds.length; j++ )
			{
				content.push('<td class="align_center" valign="middle" ');
				if( (j == 0) )
				{
					content.push(' style="display:none; height:35px;" >'+tds[j].nodeValue+'</td>');
				}else{
					if( j == 1)
					{
						var cont = tds[j].nodeValue.split('-');
						var style="";
						
						if(cont[1] == "STAND BY")
						{
							style = "height:35px; background-color: white; color:black; border: 1px solid black;";
						}else if(cont[1] == "DEPART"){
							style = "height:35px; background-color: darkgreen; color:white; border: 1px solid black;";
						}else if(cont[1] == "RETOUR"){
							style = "height:35px; background-color: darkred; color:white; border: 1px solid black;";
						}else{
							style = "height:35px; background-color: yellow; color:black; border: 1px solid black;";
						}
						
						content.push( 'style = "'+style+'"><input type="hidden" value="'+cont[0]+'"><b>'+cont[1]+'</b></td>');
					}else if ((j == 6) || (j == 9) ){
						var cont = tds[j].nodeValue.split('-');
						content.push('><input id="cd_dem" type="hidden" value="'+cont[0]+'" />'+(cont[1])+'</td>');
					}else{
						content.push('>'+tds[j].nodeValue+'</td>');
					}
					
				}
			}
			
			content.push('</tr>')
		}
		
		var cont = content.join("");
		content = null;		
		
		$(Ac).html( cont );
		
		pagination('tck_list1', 8, '#page_1', '1');
	}else{
		$('#div_show').hide();
		$('#empty p').html("<< ... Aucun r&eacute;sultat pour cette recherche ... >>").show();
	}
	
}


$('#trajet').html('');

function _rech()
{
	
}

var stat = 	function(){
				var a = "";
				$('[name="statut"]').each(function(){
					if( this.checked == true ) 
					{
						a = this.value;
					}
				});
				return a
			}
			
$(function(){
	$( "#div_r" ).scroll(function() {
		// alert($('#resultstete').css('display'));
	});
	
	$('#h1').datepick();
	$('#h2').datepick();
	
	$('#rech_glob').click(function(){

		var statut = stat();
		
		$('#h_dem').val($('#dem').val());
		$('#h_dest').val($('#dest').val());
		$('#h_resp').val($('#resp').val());
		$('#h_h1').val($('#h1').val());
		$('#h_hr1').val($('#hr_deb').val());
		$('#h_h2').val($('#h2').val());
		$('#h_hr2').val($('#hr_fin').val());
		$('#h_statut').val(statut);
		$('#h_traj').val($('#trajet').val());
		$('#h_chf').val($('#chfr').val());
		$('#h_veh').val($('#veh').val());

		
		// alert(statut);
		var param = [
						{ "name":"dem", value: $('#dem').val() },
						{ "name":"dest", value: $('#dest').val() },
						{ "name":"resp", value: $('#resp').val() },
						{ "name":"h1", value: $('#h1').val() },
						{ "name":"hr_deb", value: $('#hr_deb').val() },
						{ "name":"h2", value: $('#h2').val() },
						{ "name":"hr_fin", value: $('#hr_fin').val() },
						{ "name":"statut", value: statut },
						{ "name":"trajet", value: $('#trajet').val() },
						{ "name":"chfr", value: $('#chfr').val() },
						{ "name":"veh", value: $('#veh').val() },
						{ "name":"sort", value: $('#sort').val() },
						{ "name":"order", value: $('#order').val() },
						{ "name":"limit", value: $('#limit').val() },
						{ "name":"mode", value: "global" }
					]
		$.post('recherche/glob', param, function(data) {
			if (data) {
				var tbod = document.getElementById('show_res');
				// alert(data);
				load_rw( data, tbod );
			}
		}, "xml");
	});
});

