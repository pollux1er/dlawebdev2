var tpl_move_delay = 7500; // ms
var tpl_move_shade = 2500; // ms

function display_info_top(version_ie){
	
	
	var cpt_list = 0;
	
	$$('.tpl_info_top_list').each(function(el) { 
 	
	 	//affiche l'info
	 	fade_show_info_top.delay(tpl_move_shade*cpt_list, 'myelement', Array(el,version_ie)); 
	 	
	 	cpt_list = cpt_list + 2;
	 	
	 	
	 	//cache l'info
	 	fade_hidden_info_top.delay(tpl_move_shade*cpt_list, 'myelement', Array(el,version_ie)); 
	 		 	
	 	cpt_list = cpt_list + 1;
	 	
	 });
	
}


function fade_hidden_info_top(elem,version_ie){
	
	
	if(elem){
		if(version_ie > 7){		//test ie8
			elem.fade( 'hide' );	//element caché imédiatement
		}else{
			elem.fade( 0 );		//element caché avec un dégradé, c'est plus jolie
		}
	}	
	
}


function fade_show_info_top(elem,version_ie){	
	

	if(elem){
		if(version_ie > 7){		//test ie8
			elem.fade( 'show' );	//element visible imédiatement
		}else{
			elem.fade( 1 );		//element visible avec un dégradé, c'est plus jolie
		}
	}
	
}


//retourne la version d'IE
function test_version_ie(){
	
	var rv = -1; // non IE
	if (navigator.appName == 'Microsoft Internet Explorer') {
		
		var ua = navigator.userAgent;		
		var re = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");		
		if (re.exec(ua) != null){		
			rv = parseFloat(RegExp.$1);
		}
	
	}
	
	return rv;
		
}



/* window.addEvent('domready', function(){

	cpt = 0;
	$$('.tpl_info_top_list').each(function(el) { 
		cpt = cpt + 1;
	});
	var move_delay_tmp = tpl_move_delay * cpt;
	
	
	//Attentino, dans IE 8, un bug gènère des trouble sur les textarea avec cette focntion d'information (mais aussi avec l'ancien scrolling)
	var version_ie = test_version_ie();
	
	
	//tout de suite et tout les X temps, on lance la fonction qui affiche les infos du haut de la page
	display_info_top(version_ie);
	tpl_left_time = setInterval( 'display_info_top('+version_ie+')', move_delay_tmp );

}); */


