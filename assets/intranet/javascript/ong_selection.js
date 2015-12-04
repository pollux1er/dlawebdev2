if($('#module').val() == 'Logs')
{
	$('#left_menu a').each(function(){
		if($(this).text() == "Logs")
		{
			$(this).removeAttr('class');
			$(this).attr('class','level2selected');
			$(this).html('');
			$(this).append('<span style="display:inline-block"> » Logs </span><div class="a_mat"></div>');
		}
	});
} else if($('#module').val() == 'Chauffeurs')
{
	$('#left_menu a').each(function(){
		if($(this).text() == "Chauffeurs")
		{
			$(this).removeAttr('class');
			$(this).attr('class','level2selected');
			$(this).html('');
			$(this).append('<span style="display:inline-block"> » Chauffeurs </span><div class="a_mat"></div>');
		}
	});
} else if($('#module').val() == 'Vehicules/Dest.')
{
	$('#left_menu a').each(function(){
		if($(this).text() == "Véhicules/Destinations")
		{
			$(this).removeAttr('class');
			$(this).attr('class','level2selected');
			$(this).html('');
			$(this).append('<span> » Véhicules/Destinations </span>');
		}
	});
}else if($('#module').val() == 'Reservation')
{
	$('#left_menu a').each(function(){
		if($(this).text() == "Réservations")
		{
			$(this).removeAttr('class');
			$(this).attr('class','level2selected');
			$(this).html('');
			$(this).append('<span> » Réservations </span>');
		}
	});
}else if($('#module').val() == 'Mouvements')
{
	$('#left_menu a').each(function(){
		if($(this).text() == "Mouvements")
		{
			$(this).removeAttr('class');
			$(this).attr('class','level2selected');
			$(this).html('');
			$(this).append('<span> » Mouvement </span>');
		}
	});
}else if($('#nom_module').val() == 'User') //ok
{
	$('#left_menu a').each(function(){
		if($(this).text() == "Users")
		{
			$(this).removeAttr('class');
			$(this).attr('class','level2selected');
			$(this).html('');
			$(this).append('<span> » Users </span>');
		}
	});
}else if($('#nom_module').val() == 'Mon espace')
{
	$('#left_menu a').each(function(){
		if($(this).text() == "Mon espace")
		{
			$(this).removeAttr('class');
			$(this).attr('class','level2selected');
			$(this).html('');
			$(this).append('<span> » Mon espace </span>');
		}
	});
}else if($('#module').val() == 'Demandeurs')
{
	$('#left_menu a').each(function(){
		if($(this).text() == "Demandeurs")
		{
			$(this).removeAttr('class');
			$(this).attr('class','level2selected');
			$(this).html('');
			$(this).append('<span> » Demandeurs </span>');
		}
	});
}else if($('#module').val() == 'MAD')
{
	$('#left_menu a').each(function(){
		if($(this).text() == "Demande de véhicule")
		{
			$(this).removeAttr('class');
			$(this).attr('class','level2selected');
			$(this).html('');
			$(this).append('<span> » Demande de véhicule </span>');
		}
	});
}else if($('#module').val() == 'board')
{
	$('#left_menu a').each(function(){
		if($(this).text() == "Tableau De Bord")
		{
			$(this).removeAttr('class');
			$(this).attr('class','level2selected');
			$(this).html('');
			$(this).append('<span> » Tableau De Bord </span>');
		}
	});
}else if($('#module').val() == 'Recherche')
{
	$('#left_menu a').each(function(){
		if($(this).text() == "Recherche")
		{
			$(this).removeAttr('class');
			$(this).attr('class','level2selected');
			$(this).html('');
			$(this).append('<span> » Recherche </span>');
		}
	});
}