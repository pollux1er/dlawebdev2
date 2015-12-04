function open_form_space( id )
{
	var param = [ { "name": "id", value: id } ];
	var check = confirm ("Voulez-vous modifier votre demande?");

	if( check == true )
	{
		$.post('./modifier_form', param, function(data){
			if( data )
			{
				// alert(data);
				window.location.assign(data);
				// window.open(data);
			}
		}, "text");
	}
}

function my_reqs()
{
	$.post( './my_reqs', [], function(data){
		if( data )
		{
			$('#show_my_req').html("");
			var nbr = data.nbre;
			var forms = data.forms;
			var grp_stat = data.grp_stat;
			
			if( !(isNaN(nbr)) )
			{
				$('#show_my_req').append('<tr><td colspan="" valign="middle" align="left" style="font-weight:bold; background-color:lightgray; height:50px; padding-left:40px;" class=\"\"> '+nbr+' Demande(s) </td></tr>');
				$('#show_my_req').append("<tr><td colspan=\"2\" style='background-color:black; height:1px'></td></tr>");
				$('#show_my_req').append('<tr><td align="center"  class="label" style="height:50px;" > Statut(s) </td><td align="center" class="label"> Formulaire(s) </td></tr>');
				$('#show_my_req').append("<tr><td colspan=\"2\" style='background-color:black; height:1px'></td></tr>");
				
				if( parseInt(nbr) != 0 )
				{
					for( var i = 0 ; i < grp_stat.length; i++ )
					{
						var cont = [];
							cont.push("<tr id='"+grp_stat[i]+"'>");
								var stat = grp_stat[i].stat.charAt(0).toUpperCase() + grp_stat[i].stat.substring(1).toLowerCase();
								cont.push("<td align=\"center\" class=\"label\" valign=\"middle\" style=\"border:1px solid gray;\"> "+stat+" ("+grp_stat[i].nbre+") </td>");
								cont.push("<td>");
									cont.push('<div style="max-height:250px; overflow-y:scroll; overflow-x:hidden;"><ul id=form_'+grp_stat[i].stat+i+'>');
									for(var j = 0; j < forms[i].length; j++)
									{
										cont.push("<li onclick=\" open_form_space("+forms[i][j].id+"); \"> <span><b><u>Formulaire</u> N.</b>"+forms[i][j].id+"</span>&nbsp;&nbsp;<span><b> <u>Date Cr&eacute;ation :</u> </b>"+forms[i][j].datef	+"</span>&nbsp;&nbsp;<span><b> <u>D&eacute;part :</u> </b>"+forms[i][j].go+"</span>&nbsp;&nbsp;<span><b> <u>Arriv&eacute;e :</u> </b>"+forms[i][j].back+"</span></li>");
									}
									cont.push("</ul></div>");
								cont.push("</td>");
							cont.push("</tr>");
							cont.push("<tr><td colspan=\"2\" style='background-color:gray; height:1px'></td></tr>");
						
						var content = cont.join('');
						$('#show_my_req').append( content );
						
					}
				}else if (parseInt(nbr) == 0){
					// alert('zzz');
					$('#show_my_req').append('<tr><td colspan="2" align="center" style="height:50px;"><b> Aucun Demande </b></td></tr>');
				}
			}else{
				$('#show_my_req').append('<tr><td colspan="2" align="center" style="height:50px;"><b> Aucun Demande </b></td></tr>');
			}
			
		}else{
			$('#show_my_req').html("<td colspan='2'align=\"center\" style=\"height:50px;\"><b> Aucun Demande </b></td>");
		}
	}, "json");
}
 
my_reqs();
 
setInterval(function(){
	my_reqs();
}, 30000);