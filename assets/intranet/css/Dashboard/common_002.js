
function fCompareDate(pDateRef,pDateCheck) 
{
	var DureeRef = Date.parse(pDateRef);
	var DureeCheck = Date.parse(pDateCheck);
	
	var iComparaison= DureeCheck - DureeRef;
	
	return iComparaison;
} 


function nl2br(str) {
    // nl2br version js
    return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1<br>$2');
}


/**
 * Fonction de changement de l'onglet en cours.
 */
var log_are_loaded = false;
function switchTab( section_name )
{
	var d = document;
	var list_section = Array(  'sites', 'locus' );

	// Masquage de tous les onglets.
	for( var i = 0; i<list_section.length; i++ )
	{
		$( 'menu_li_' + list_section[i] ).removeClass( 'current' );
		$( 'tab_' + list_section[i] ).setStyle( 'display', 'none' );
	}

	// Affichage de l'onglet sélectionné.
	$( 'menu_li_' + section_name ).addClass( 'current' );
	$( 'tab_' + section_name ).setStyle( 'display', 'block' );

	// affectation de la valeur de l'onglet courant 
	$('tab').value = section_name;
		
	// Récupération des logs en ajax à la première demande.
	if( section_name == 'log'
		&& !log_are_loaded )
	{
		log_are_loaded = true;
		getLog( $('id_prim_key').value , $('log_table').value );
	}
	
}


/**
 * Fonction de changement de l'onglet en cours EQUIPMENT CARD
 */
var status_are_loaded 		= false;
var lastconf_are_loaded 	= false;
var credential_are_loaded 	= false;
var eqp_credential_are_loaded 	= false;
var smtp_relay_are_loaded 	= false;
var procedures_are_loaded 	= false;
var comments_are_loaded 	= false;
var services_are_loaded 	= false;
var schedule_are_loaded 	= false;
var server_credential_are_loaded 	= false;
var logs_are_loaded 		= false;
var monitor_are_loaded 		= false;

function switchTabCard( section_name, todo_mode )
{
	var d = document;
	//var list_section = Array( 'common', 'specific', 'parts', 'sla', 'credential', 'status', 'attach', 'logs' );
	var list_section = Array( 'common', 'esx', 'procedures', 'comments', 'credential', 'eqp_credential', 'smtp_relay', 'status', 'lastconf', 'logs', 'monitor' ); // 'services', 'specific','schedule',  'server_credential',
	
	// set onglet courrant 
	$('name_tab_selected').value = section_name;

	// Masquage de tous les onglets.
	for( var i = 0; i<list_section.length; i++ )
	{
		if( $( 'menu_li_' + list_section[i] ) )
		{
			$( 'menu_li_' + list_section[i] ).removeClass( 'current' );
		}
		$( 'tab_' + list_section[i] ).setStyle( 'display', 'none' );
	}

	// Affichage de l'onglet sélectionné.
	$( 'menu_li_' + section_name ).addClass( 'current' );
	$( 'tab_' + section_name ).setStyle( 'display', 'block' );
	
	
	// Récupération des données de l'onglet en ajax 
	if( section_name == 'status' 
		&& !status_are_loaded )
	{
		var str_request = '?todo='+todo_mode+'&id_eqp=' + $('id_eqp_selected').value + '&tab=' + section_name + '&timeZoneOffset=' + $('timeZoneOffset').value;
		call_ajax_page( 'get_equipment_card_tab.php' + str_request , 'tab_' + section_name , call_ajax_post_eqp_tab );	
	}	
	else if( section_name == 'lastconf' 
		&& !lastconf_are_loaded )
	{
		// Récupération en ajax à la première demande.
		//lastconf_are_loaded = true;
		
		var str_request = '?todo='+todo_mode+'&id_eqp=' + $('id_eqp_selected').value + '&tab=' + section_name;
		call_ajax_page( 'get_equipment_card_tab.php' + str_request , 'tab_' + section_name , call_ajax_post_eqp_tab );	
	}	
	else if( section_name == 'credential' 
		&& !credential_are_loaded )
	{
		// Récupération en ajax à la première demande.
		//credential_are_loaded = true;
		
		var str_request = '?todo='+todo_mode+'&id_eqp=' + $('id_eqp_selected').value + '&tab=' + section_name;
		call_ajax_page( 'get_equipment_card_tab.php' + str_request , 'tab_' + section_name , call_ajax_post_eqp_tab );	
	}	
	else if( section_name == 'eqp_credential' 
		&& !eqp_credential_are_loaded )
	{
		// Récupération en ajax à la première demande.
		//eqp_credential_are_loaded = true;
		
		var str_request = '?todo='+todo_mode+'&id_eqp=' + $('id_eqp_selected').value + '&tab=' + section_name;
		call_ajax_page( 'get_equipment_card_tab.php' + str_request , 'tab_' + section_name , call_ajax_post_eqp_tab );	
	}	
	else if( section_name == 'smtp_relay' 
		&& !smtp_relay_are_loaded )
	{
		// Récupération en ajax à la première demande.
		//eqp_credential_are_loaded = true;
		
		var str_request = '?todo='+todo_mode+'&id_eqp=' + $('id_eqp_selected').value + '&tab=' + section_name;
		call_ajax_page( 'get_equipment_card_tab.php' + str_request , 'tab_' + section_name , call_ajax_post_eqp_tab );	
	}	
	else if( section_name == 'services' 
		&& !services_are_loaded )
	{
		// Récupération en ajax à la première demande.
		//services_are_loaded = true;
		
		var str_request = '?todo='+todo_mode+'&id_eqp=' + $('id_eqp_selected').value + '&tab=' + section_name;
		call_ajax_page( 'get_equipment_card_tab.php' + str_request , 'tab_' + section_name , call_ajax_post_eqp_tab );	
	}
	/*
	else if( section_name == 'schedule' 
		&& !schedule_are_loaded )
	{
		// Récupération en ajax à la première demande.
		//schedule_are_loaded = true;
		
		var str_request = '?todo='+todo_mode+'&id_eqp=' + $('id_eqp_selected').value + '&tab=' + section_name;
		call_ajax_page( 'get_equipment_card_tab.php' + str_request , 'tab_' + section_name , call_ajax_post_eqp_tab );	
	}
	*/		
	else if( section_name == 'procedures' 
		&& !procedures_are_loaded )
	{
		// Récupération en ajax à la première demande.
		//procedures_are_loaded = true;
		
		var str_request = '?todo='+todo_mode+'&id_eqp=' + $('id_eqp_selected').value + '&tab=' + section_name;
		call_ajax_page( 'get_equipment_card_tab.php' + str_request , 'tab_' + section_name , call_ajax_post_eqp_tab );	
	}
	else if( section_name == 'comments' 
		&& !comments_are_loaded )
	{
		// Récupération en ajax à la première demande.
		//comments_are_loaded = true;
		
		var str_request = '?todo='+todo_mode+'&id_eqp=' + $('id_eqp_selected').value + '&tab=' + section_name;
		call_ajax_page( 'get_equipment_card_tab.php' + str_request , 'tab_' + section_name , call_ajax_post_eqp_tab );	
	}
	/*	
	else if( section_name == 'server_credential' 
		&& !server_credential_are_loaded )
	{
		// Récupération en ajax à la première demande.
		//server_credential_are_loaded = true;
		
		var str_request = '?todo='+todo_mode+'&id_eqp=' + $('id_eqp_selected').value + '&tab=' + section_name;
		call_ajax_page( 'get_equipment_card_tab.php' + str_request , 'tab_' + section_name , call_ajax_post_eqp_tab );	
	}
	*/			
	else if( section_name == 'logs' 
		&& !logs_are_loaded )
	{
		// Récupération en ajax à la première demande.
		//logs_are_loaded = true;
		
		var str_request = '?todo='+todo_mode+'&id_eqp=' + $('id_eqp_selected').value + '&tab=' + section_name;
		call_ajax_page( 'get_equipment_card_tab.php' + str_request , 'tab_' + section_name , call_ajax_post_eqp_tab );	
	}	
	else if( section_name == 'monitor' 
		&& !monitor_are_loaded )
	{
		// Récupération en ajax à la première demande.
		//logs_are_loaded = true;
		
		var str_request = '?todo='+todo_mode+'&id_eqp=' + $('id_eqp_selected').value + '&tab=' + section_name;
		call_ajax_page( 'get_equipment_card_tab.php' + str_request , 'tab_' + section_name , call_ajax_post_eqp_tab );	
	}
		
	
}


/**
 * Fonction de changement de l'onglet en cours ADMIN - PRIVILEGES
 */
function switchTabPrivilege( section_name )
{
	var d = document;
	var list_section = Array( 'ref', 'cmd', 'tpl', 'assoc' );
	
	// Masquage de tous les onglets.
	for( var i = 0; i<list_section.length; i++ )
	{
		if( $( 'menu_li_' + list_section[i] ) )
		{
			$( 'menu_li_' + list_section[i] ).removeClass( 'current' );
		}
		$( 'tab_' + list_section[i] ).setStyle( 'display', 'none' );
	}

	// Affichage de l'onglet sélectionné.
	$( 'menu_li_' + section_name ).addClass( 'current' );
	$( 'tab_' + section_name ).setStyle( 'display', 'block' );
	
	// TODO: créer les appels AJAX au fur et à mesure. ----------------------------------------------------------------------
	
	// Récupération en ajax
	if( section_name == 'ref' )
	{
		call_ajax_page( 'get_list_privileges.php?todo=list_ref' , 'tab_content_list_ref', call_ajax_post_js );
	}	
	else if( section_name == 'cmd' )
	{
		call_ajax_page( 'get_list_privileges.php?todo=list_cmd' 	, 'tab_content_list_cmd'	, call_ajax_post_js );
		call_ajax_page( 'get_list_privileges.php?todo=list_mode' 	, 'tab_content_list_mode'	, call_ajax_post_js );
	}	
	else if( section_name == 'tpl' )
	{
		call_ajax_page( 'get_list_privileges.php?todo=list_tpl' 	, 'tab_content_list_tpl'	, call_ajax_post_js );
	}	
	else if( section_name == 'assoc' )
	{
		call_ajax_page( 'get_list_privileges.php?todo=list_assoc' 	, 'tab_content_list_assoc'	, call_ajax_post_js );	
	}	

}




/**
 * Fonction ajax de récupération des logs.
 */
function getLog( id_prim_key , log_table )
{
	if( !id_prim_key )
	{
		return false;
	}
	var url = '/module/it_equipment/ajax/php/log.php?id_prim_key=' + id_prim_key + '&log_table=' + log_table;
	//prompt( '', url );
	var ajaxRequest = new Request( {	'url': url,
  										method: 'get',
  										encoding: 'iso-8859-1',
  										onComplete: function( request, requestXML ) {
  											getBackLog( request );
  										} } ).send( ); 
}


/**
 * Fonction ajax de callback après récupération des logs.
 */
function getBackLog( request )
{
	var tab_log = $( 'tab_log_content' );
	tab_log.innerHTML = request;
}


/**
 * Fonction ajax de récupération d'une action.
 */
function call_ajax_action( page_called, callback_fct, args )
{
	if( page_called == '' )
	{
		return false;
	}
	//prompt('page appelee', page_called);
	/*
	if( div_content != '' )
	{
		document.getElementById(div_content).innerHTML = '<img src="/img/sb_loading.gif" title="Loading" alt="Loading" />';
	}
	*/
	var url = '/module/it_equipment/ajax/php/' + page_called ;
	//prompt( '', url );
	var ajaxRequest = new Request( {	'url': url,
  										method: 'get',
  										encoding: 'iso-8859-1', 
  										async: false, 
  										onComplete: function( request, requestXML ) {
  										
											var element = requestXML.getElementsByTagName('res_id').item(0);
											
											if(requestXML.getElementsByTagName('supplement')) {
												var supplement = requestXML.getElementsByTagName('supplement');
												callback_fct( element.firstChild.data, args, supplement);
											}
											else {
												callback_fct( element.firstChild.data, args );
											}

  										} } ).send( ); 

}


/**
 * Fonction ajax de récupération d'une page.
 */
function call_ajax_page( page_called, div_content, callback_fct )
{
	if( page_called == '' || div_content == '' )
	{
		return false;
	}
	
	// OPACITY 
	//$(div_content).set('style', 'filter:alpha(opacity=50);opacity: 0.5;-moz-opacity:0.5;');
	
	// SPINNER 
	//document.getElementById(div_content).innerHTML = '<img src="/module/image/legacy/spinner.gif" title="Loading" alt="Loading" style="vertical-align:middle;" class="img_loading" />&nbsp;&nbsp;<span style="vertical-align:middle;font-weight:normal;"><small><em>Loading...</em></small></font>';
	
	
	document.getElementById(div_content).innerHTML =  '<div style="position: relative;" onclick="return false;">'
													+ '<div style="filter:alpha(opacity=50);opacity: 0.5;-moz-opacity:0.5;">' + document.getElementById(div_content).innerHTML + '</div>' 
													+ '<div class="div_loading"><img src="/module/image/general/waiting_blue.gif" title="Loading" alt="Loading" style="vertical-align:middle;" class="img_loading" /></div>' 
													+ '</div>';
		
	// OLD: --- document.getElementById(div_content).innerHTML = '<img src="/img/sb_loading.gif" title="Loading" alt="Loading" />';
	// OLD: --- document.getElementById(div_content).innerHTML = '<div class="loader"><div class="faceplate"></div><div class="progress"></div></div>';
			
	// check if SESSION still exists
	call_ajax_action( 'check_session_alive.php', callback_session_alive, '' );

	var url = '/module/it_equipment/ajax/php/' + page_called ;
	//prompt( '', url );
	var ajaxRequest = new Request( {	'url': url,
  										method: 'get',
  										encoding: 'iso-8859-1',
  										onComplete: function( request, requestXML ) {
  										getBackAjaxContent( request, div_content, callback_fct );
  										} } ).send( ); 					
  	return true;
}

function callback_session_alive( res_action, args )
{
	if( res_action == 0 )
	{
		alert('Your Intranet Session is no longer available.\nPlease reconnect.');
		
		var str_location_href = window.location.href;
		
		if( str_location_href.charAt(str_location_href.length-1) == '#' )
		{
			str_location_href = str_location_href.substring(0,str_location_href.length-1);
		} 		
		
		str_location_href = str_location_href + '&reload=1';
		
		window.location.href = str_location_href;
		return true;
	}
	else
	{
		return true;
	}
}


/**
 * Fonction ajax de callback après récupération d'une page.
 */
function getBackAjaxContent( request, div_content, callback_fct )
{
	// on injecte le contenu de la page dans la Div correspondante de la page mère   
	var tab_ajax_content = document.getElementById(div_content);
	tab_ajax_content.innerHTML = request;

	// on force la fermeture d'éventuelles infobulles rémanentes
	nd();
	
	// REMOVE OPACITY
	//$(div_content).set('style', 'filter:alpha(opacity=100);opacity:1;-moz-opacity:1;'); 

	// on appelle la fonction js de callback passée en parametre
	if( typeof(	callback_fct ) == 'function' )
	{
		callback_fct();
	}	
	
	return true;
}


function edit_data_eqp_card(tr_name)
{
	$('flag_edit_'+tr_name).value = '1';
	$('edit_'+tr_name).innerHTML = '<img src="/module/image/legacy/b_save.png" title="Save modification" onclick="save_data_card(\''+tr_name+'\');return false;" style="cursor:pointer;" />&nbsp;<img src="/module/image/general/undo_16.png" title="Cancel modification" onclick="show_data_card_icon(\''+tr_name+'\');return false;" style="cursor:pointer;" />';
	
	return false;
}


function show_data_card_icon(tr_name)
{
     if( document.getElementById( 'edit_' + tr_name ) )
     {
     		$('edit_' + tr_name).innerHTML = '<img src="/module/image/legacy/sc_dsbeditdoc.gif" title="Edit this data" onclick="edit_data_eqp_card(\''+tr_name+'\');return false;" />';
     		$('edit_' + tr_name).style.visibility = 'visible';
     		$('flag_edit_'+tr_name).value = '0';
     }
}


/*
 * Fonctionnalités FICHE Equipment ********************************************************************** 
 */

/*
 * Affichage Initial de la Fiche d'un Equipement donné 
 * (avec lock de l'équipement en édition si nécessaire)
 */
function display_equipments(id_eqp_cur, tab_name, display_mode)
{
	
	if( document.getElementById('card_id_eqp') )
	{
		if( $('card_id_eqp').value != 0 )
		{
			// unlock de la fiche Equipment affichée en mode EDITION (  $('card_id_eqp').value != 0 )
			// avant remplacement par la nouvelle
			eqp_unlock($('card_id_eqp').value);
		}
	}

	if(id_eqp_cur != 0)
	{

		
		
		$$( '.tr_survol' ).each( function( el ) {
									        
									        
									        el.style.cursor = 'pointer'; 
											/*el.style.backgroundColor = '#FFFFFF';*/
											
											if( el.hasClass('tr_selected') )
											{ 
												el.removeClass('tr_selected'); 
											} 
											
											$('lock_' + el.id).value = '0';
											
												});
												
		if( document.getElementById('lock_tr_site_' + id_eqp_cur) )
		{	
			$('lock_tr_site_' + id_eqp_cur).value = '1'; 
		}	
		
		// -- -- -------------------------------------------------
		// -- -- -------------------------------------------------
	     $$( '.tr_survol' ).each( function( el ) {
	
	                 el.addEvents({
	
				
	
	                            mouseenter: function( e ) {
	
									if( $('lock_' + el.id).value == '0' )
									{
	                                   this.style.cursor = 'pointer';
		       	                       /*this.style.backgroundColor = '#D4DDEE';*/
		       	                        this.addClass('tr_selected');  
	                				}         
					
	                            },
	
	                            mouseleave: function( e ) {  
	                            
	                            	if( $('lock_' + el.id).value == '0' )
									{
	                            		this.style.cursor = 'default';
	                            		/*this.style.backgroundColor = '#FFFFFF';*/
	                            		  this.removeClass('tr_selected'); 
	                            		
	                            	}
	
	                            }    
	                            
	      
	                                                       
	
	
	                 });
	                 
	     });		
		// -- -- -------------------------------------------------
		// -- -- -------------------------------------------------



		if( document.getElementById('lock_tr_site_' + id_eqp_cur) )
		{		
	    	$('tr_site_' + id_eqp_cur).style.cursor = 'default';
			/*$('tr_site_' + id_eqp_cur).style.backgroundColor = '#D4DDEE';*/
			$('tr_site_' + id_eqp_cur).addClass('tr_selected');
		}	
 			

	}
	
	var maximize_flag = '0';
	//alert($('content_equipment_card').style.width);
	if( $('content_equipment_card').style.width == '100%' )
	{
		maximize_flag = '1';
	}
	
	var str_request = '?todo=' + display_mode +  
					  '&id_eqp=' + id_eqp_cur + 
					  '&tab=' + tab_name +
					  '&maximize_flag=' + maximize_flag;
				
	//prompt('', str_request);
	call_ajax_page( 'get_equipment_card.php' + str_request , 'content_equipment_card', call_ajax_post_eqp_card );
	
	if( 	document.getElementById('content_list_equipments') 
		&& 	document.getElementById('content_list_equipments').style.display == '' )
	{
		minimize_eqp_list();
	}
	if( id_eqp_cur == 0 )
	{
		show_new_eqp_notice();
	}
}


/*
 * Actions effectuées après chargement INITIAL de la fiche Equipement
 * => PAR EXEMPLE: 
 *			. appel de l'affichage d'un onglet Ajax 
 *  		. appel/chargement de l'onglet en MODE EDITION si celui-ci est disponible dans ce mode 
 */
function call_ajax_post_eqp_card()
{
	// ------------------------------------------------------------------ //
	//si mode "EDITION", alors on lance le timer pour le temps d'edition
	// ------------------------------------------------------------------ //
	if( $('card_id_eqp').value != 0 && $('card_id_eqp').value != '' )
	{
		//check_lock_ok( $('card_id_eqp').value );
		decrease_countdown_timer();
		
		// si tab "esx" selectionné et MODE EDITION
		if( $('name_tab_selected').value == 'esx' )
		{  
			// alors on redirige vers l'onglet "common" 
			var todo_mode = $('todo_value').value;
			switchTabCard('common', todo_mode);
		}		
		else if( $('name_tab_selected').value == 'monitor' )
		{  
			// si tab "monitoring" selectionné et MODE EDITION 
			// alors on redirige vers l'onglet "common" 
			var todo_mode = $('todo_value').value;
			switchTabCard('common', todo_mode);
		}		
	}
	
	
	// ------------------------------------------------------------------- //
	// si affichage de l'EQP CARD en VIEW au sein de la page NEW EQUIPMENT //
	// alors on cache les controles d'editions/agrandissement/fermeture    //
	// ------------------------------------------------------------------- //
	if( $('eqp_code_page') && $('eqp_code_page').value == 'eqp_new' )
	{
		//if( $('eqp_card_button_edit') )
		//{
		//	$('eqp_card_button_edit').style.display = 'none';
		//}
		
		if( $('eqp_card_button_popup') )
		{
			$('eqp_card_button_popup').style.display = 'none';
		}
		
		if( $('img_eqp_card_maximize') )
		{
			$('img_eqp_card_maximize').style.display = 'none';
		}
		
		if( $('img_action_close') )
		{		
			$('img_action_close').style.display = 'none';
		}
	
	}
	
	
	// ------------------------------------------------------------------ //
	// appel de l'affichage d'un onglet donné 
	// (si l'onglet était précedemment affiché 
	//  ** exemple: dans le cas du basculement 
	//     d'un mode d'édition à un autre ** ) 
	// ------------------------------------------------------------------ //
	if( $('name_tab_selected').value == 'credential' )
	{ 
		var todo_mode = $('todo_value').value;
		switchTabCard('credential', todo_mode);
	}
	else if( $('name_tab_selected').value == 'eqp_credential' )
	{ 
		var todo_mode = $('todo_value').value;
		switchTabCard('eqp_credential', todo_mode);
	}
	else if( $('name_tab_selected').value == 'smtp_relay' )
	{ 
		var todo_mode = $('todo_value').value;
		switchTabCard('smtp_relay', todo_mode);
	}
	else if( $('name_tab_selected').value == 'procedures' )
	{ 
		var todo_mode = $('todo_value').value;
		switchTabCard('procedures', todo_mode);
	} 
	else if( $('name_tab_selected').value == 'comments' )
	{ 
		var todo_mode = $('todo_value').value;
		switchTabCard('comments', todo_mode);
	} 
	else if( $('name_tab_selected').value == 'services' )
	{ 
		var todo_mode = $('todo_value').value;
		switchTabCard('services', todo_mode);
	} 
	else if( $('name_tab_selected').value == 'logs' )
	{ 
		var todo_mode = $('todo_value').value;
		switchTabCard('logs', todo_mode);
	}

	// -- //
	refresh_eqp_card();
	return false;
}


function show_new_eqp_notice()
{
	return false;
}


/*
 * RAZ des critères de recherche pour écran Equipments List
 */
function reset_search_criteria()
{
	//var list_inputs = $('form_critere').getElements('input');
	$$('.input_criteria').each( function(el) {

	        el.value = '';
     });
     
    // reset
    ip_addr_search_change();
     
    if( $('is_virtual_all') ) {
    	$('is_virtual_all').click();
    }
    
    $$('.status_deployment_checkbox').each( function(el) {

	        el.set('checked', false); 
     });
    
    if( $('status_deployment_all') ) {
    	$('status_deployment_all').set('checked', true);
    }
     
    $$('.status_monitoring_checkbox').each( function(el) {

        el.set('checked', false); 
    });
    
    if( $('status_monitoring_all') ) {
    	$('status_monitoring_all').set('checked', true);
    }
    
    //$('location_type_perenco').checked="checked";
    if( $('owner_type_all') ) {
    	$('owner_type_all').click();
    }

    if($('is_dev_all')) {
    	$('is_dev_all').click();
    }

    change_criteria_area('');
     
	if( $('ip_address_search') && $('ip_address_search').hasClass('input_type_wrong') )
	{ 
		$('ip_address_search').removeClass('input_type_wrong'); 
	}		
	
}


/*
 * 	Appel du mode d'EDITION d'une FICHE Equipment
 */
function edit_eqp_card(id_eqp, tab_name, is_popup)
{
	//on recupere l'onglet courant 
	tab_name = $('name_tab_selected').value;
	if( tab_name == 'status' )
	{
		// on ne peut pas éditer les status (onglet inexistant en mode edit)
		// on redirige vers l'onglet principal
		tab_name = 'common';
	}
	if( tab_name == 'lastconf' )
	{
		// on ne peut pas éditer les status (onglet inexistant en mode edit)
		// on redirige vers l'onglet principal
		tab_name = 'common';
	}	
	
	if( is_popup == 1 )
	{
		//alert('TODO: is_popup == 1 | common.js->edit_eqp_card(id_eqp, tab_name, is_popup)');
		window.location.href ='?todo=edit&id_eqp='+id_eqp+'&popup='+is_popup+'&tab='+tab_name; 
		return false;
	}
	else
	{
		// la page est appelée en Ajax.
		display_equipments(id_eqp, tab_name, 'edit');
		// on force la fin de l'affichage d'un éventuel "tips" persistant
		nd();
	} 
}

/*
 * 	Appel du mode de VIEW d'une FICHE Equipment
 */
function cancel_edit_eqp_card(id_eqp, tab_name, is_popup)
{
	// TODO: recuperer onglet courant
	tab_name = $('name_tab_selected').value;	
	
	if(id_eqp != 0)
	{
		// unlock de la fiche Equipment
		eqp_unlock(id_eqp);
	}
	
	if( is_popup == 1 )
	{
		//alert('TODO: is_popup == 1 | common.js->cancel_edit_eqp_card(id_eqp, tab_name, is_popup)');
		window.location.href ='?todo=view&id_eqp='+id_eqp+'&popup='+is_popup+'&tab='+tab_name; 
		return false;
	}
	else
	{
		// la page est appelée en Ajax.
		display_equipments(id_eqp, tab_name, 'view');
		// on force la fin de l'affichage d'un éventuel "tips" persistant
		nd();
	} 
}



/*
 * 	Appel du CLONE d'une FICHE Equipment ( = MODE D'EDITION SPECIFIQUE )
 */
function clone_eqp_card(id_eqp, tab_name, is_popup)
{
	//on force l'onglet courant à common
	tab_name = 'common';

	if( is_popup == 1 )
	{
		//alert('TODO: is_popup == 1 | common.js->edit_eqp_card(id_eqp, tab_name, is_popup)');
		window.location.href ='?todo=edit&id_eqp='+id_eqp+'&popup='+is_popup+'&is_clone=1&tab='+tab_name; 
		return false;
	}
	else
	{
		// la page est appelée en Ajax.
		display_equipments(id_eqp, tab_name, 'clone');
		// on force la fin de l'affichage d'un éventuel "tips" persistant
		nd();
	} 
}

/*
 * 	SAUVEGARDE des modifications d'une FICHE Equipment
 */
function save_edit_eqp_card(id_eqp, tab_name, is_popup)
{
	if( !confirm('Your modifications will be saved. Are you sure?') )
	{
		return false;
	}	
		
		
		
		if( $('card_name_eqp').value == '' || $('card_name_eqp_is_valid').value == 0 )
		{	
			if( !$('card_name_eqp').hasClass('input_type_wrong') )
			{ 
				$('card_name_eqp').addClass('input_type_wrong'); 
			} 	
			
			alert('Please, enter valid Equipment Name.');
			return false;
		}
		else
		{
			if( $('card_name_eqp').hasClass('input_type_wrong') )
			{ 
				$('card_name_eqp').removeClass('input_type_wrong'); 
			}
		}
		
		if( $('id_domain').value == '' )
		{
			if( !$('id_domain').hasClass('input_type_wrong') )
			{ 
				$('id_domain').addClass('input_type_wrong'); 
			} 			
		
			alert('Please, select a Domain Name.');
			return false;
		}
		else
		{
			if( $('id_domain').hasClass('input_type_wrong') )
			{ 
				$('id_domain').removeClass('input_type_wrong'); 
			} 	
		}
		/*
		if( $('descript_eqp').value == '' )
		{
			alert('Please, enter a short description for this Equipment.');
			return false;
		}
		*/
		
		var owner_type = 'perenco';
		if( $('eqp_card_owner_other').checked )
		{
			owner_type = 'other';
		}

		if( $('eqp_id_eqp_type').value == '' )
		{
		
			if( !$('eqp_id_eqp_type').hasClass('input_type_wrong') )
			{ 
				$('eqp_id_eqp_type').addClass('input_type_wrong'); 
			} 			
		
			alert('Please, select an Equipment Type.');
			return false;
		}
		else
		{
			if( $('eqp_id_eqp_type').hasClass('input_type_wrong') )
			{ 
				$('eqp_id_eqp_type').removeClass('input_type_wrong'); 
			} 	
		}		
		
		var is_virtual = 0;
		if( $('eqp_is_virtual_yes').checked )
		{
			is_virtual = 1;
		}		
				
		if( $('eqp_id_os_version').value == '' )
		{
			if( !$('eqp_id_os_version').hasClass('input_type_wrong') )
			{ 
				$('eqp_id_os_version').addClass('input_type_wrong'); 
			} 	
			
			alert('Please, select an OS Version.');
			return false;
		}
		else
		{
			if( $('eqp_id_os_version').hasClass('input_type_wrong') )
			{ 
				$('eqp_id_os_version').removeClass('input_type_wrong'); 
			} 	
		}	
		
		
		if( $('id_eqp_site').value == '' || $('id_eqp_site').value == '0' )
		{
			if( !$('id_eqp_site').hasClass('input_type_wrong') )
			{ 
				$('id_eqp_site').addClass('input_type_wrong'); 
			} 			
			
			alert('Please, select a Location Site for this Equipment.');
			return false;
		}
		else
		{
			if( $('id_eqp_site').hasClass('input_type_wrong') )
			{ 
				$('id_eqp_site').removeClass('input_type_wrong'); 
			} 	
		}
		
		
		if( $('eqp_id_remote_protocol').value == '' )
		{
			if( !$('eqp_id_remote_protocol').hasClass('input_type_wrong') )
			{ 
				$('eqp_id_remote_protocol').addClass('input_type_wrong'); 
			} 			
		
			alert('Please, select a Remote Protocol.');
			return false;
		}	
		else
		{
			if( $('eqp_id_remote_protocol').hasClass('input_type_wrong') )
			{ 
				$('eqp_id_remote_protocol').removeClass('input_type_wrong'); 
			} 	
		}			

		//var t_list_services = new Array();
		//$$('.eqp_card_service').each ( function(el){ t_list_services[el.value] = el.value; } );
		
		var is_non_valid_ip_addr = 0;
		var nbr_ip_addr = 0;
		$$('.is_valid_ip_addr').each ( 
										function(el){ 
														nbr_ip_addr++;
														if(el.value == '0')
														{
														is_non_valid_ip_addr++;
														} 
													} 
									  );
		if(nbr_ip_addr > 0 && is_non_valid_ip_addr > 0)
		{
			if( is_non_valid_ip_addr > 1 )
			{
				alert('There are ' + is_non_valid_ip_addr + ' non valid IP addresses.\nPlease, enter valid IP addresses for this Equipment.');
			}
			else
			{
				alert('There is ' + is_non_valid_ip_addr + ' non valid IP address.\nPlease, enter valid IP addresses for this Equipment.');
			}
			return false;		
		}
		
		


		var str_request = 	  '?todo=' + $('action_card_type').value 
							+ '&id_eqp=' + $('card_id_eqp').value 
							+ '&name_eqp=' + $('card_name_eqp').value 
							+ '&name_eqp_old=' + $('card_name_eqp_old').value 
							+ '&id_domain=' + $('id_domain').value 
							+ '&monitoring_objid=' + $('eqp_monitoring_objid').value 
							+ '&monitoring_srv_id_monitor=' + $('eqp_monitoring_srv_id_monitor').value 
							+ '&descript_eqp=' + encodeURI($('descript_eqp').value) 
							+ '&is_virtual=' + is_virtual 
							+ '&eqp_owner=' + owner_type  
							+ '&id_locus=' + $('id_eqp_locus').value 
							+ '&id_site=' + $('id_eqp_site').value 
							+ '&id_sub=' + $('id_eqp_sub').value 
							+ '&id_eqp_type=' + $('eqp_id_eqp_type').value 
							+ '&id_os_version=' + $('eqp_id_os_version').value 
							+ '&id_remote_protocol=' + $('eqp_id_remote_protocol').value ;
			
			
		// Monitoring Credential DATA			
		if( $('eqp_monitoring_api_user') && $('eqp_monitoring_api_passhash') )
		{
			str_request = str_request 	+ '&id_monitor=' + $('eqp_monitoring_id_monitor').value 
										+ '&monitoring_api_user=' + $('eqp_monitoring_api_user').value 
										+ '&monitoring_api_passhash=' + $('eqp_monitoring_api_passhash').value ;	
		}
		
		
		$$('.eqp_card_no_script').each( 
						function(el){ 
										if(el.checked)
										{
											str_request = str_request + '&status_deployment=' + el.value; 
										}	
									}
										);
						
		$$('.eqp_card_is_dev').each( 
						function(el){ 
							if(el.checked)
							{
								str_request = str_request + '&is_dev=' + el.value; 
							}	
						}
		);
						
						
		$$('.eqp_card_service').each ( 
						function(el){ str_request = str_request + '&id_service[]=' + el.value; }
									 );
		
		var has_main_ip = 0;
		$$('.input_ip_addr_is_main').each ( 
						function(el){
										var val_checked = 0;
										if( el.checked )
										{
											val_checked = 1;
											has_main_ip = 1;
										} 
										str_request = str_request + '&ip_addr_is_main[]=' + val_checked; 
									}
									 );			
		
		if( nbr_ip_addr > 0 && has_main_ip != 1 )
		{
			alert('Please, select one main IP address for this Equipment.');
			return false;				
		}	
		
		var test_cat = true;
		$$('.select_ip_cat').each(
			function(el){
				if(!el.get('disabled')) {
					if( el.value === '0' && test_cat) {
						test_cat = false;
					}
					else {
						str_request = str_request + '&ip_category[]=' + el.value;
					}
				}
			}
		 );
		
		if(!test_cat) {
			alert('Please, select one category on IP address for this Equipment.');
			return false;
		}

		$$('.input_ip_addr_id').each ( 
						function(el){ str_request = str_request + '&ip_addr_id[]=' + el.value; }
									 );		
	
		$$('.input_ip_addr').each ( 
						function(el){ str_request = str_request + '&ip_addr_value[]=' + el.value; }
									 );		
		
		var flag_ip_mask = true;
		$$('.input_ip_addr_mask').each ( 
				function(el){ 
							str_request = str_request + '&ip_mask_value[]=' + el.value; 
								if( el.value == '' || parseInt( el.value, 10 ) <= 0 || parseInt( el.value, 10 ) >= 33 )
								{
									flag_ip_mask = false;
								}
							}
							 );		
		
		if( !flag_ip_mask )
		{
			alert('IP Mask must be >0 and <33.\nPlease check and correct invalid mask(s).');
			return false;
		}
		
		$$('.input_ip_addr_name').each ( 
						function(el){ str_request = str_request + '&ip_addr_name[]=' + el.value; }
									 );			
		
		
		// IT Contacts 
		$$( '.selected_eqp_contact' ).each( 
						function( el ) {  str_request = str_request + '&id_eqp_contact[]=' + el.value; }
									);		
				
		
		// Alias(es) --- traitements --- //
		// -- alias déjà associé et toujours présents dans la fiche
		$$( '.input_eqp_alias_id_assoc' ).each( 
				function( el ) { 
									if( el.value != 0 )
									{
									 str_request = str_request + '&id_alias_assoc[]=' + el.value; 
									}
								}
							);	
							
		// -- alias existants mais nouvellement associés à l'equipement 
		$$( '.input_eqp_alias_id_new_link' ).each( 
				function( el ) { 
									if( el.value != 0 )
									{
									 	str_request = str_request + '&id_alias_new_link[]=' + el.value; 
									}
							   }
							);			
	
						
		// -- nouveaux alias à créer, puis à associer à l'equipement 
		/*
		$$( '.input_eqp_alias_name_new_create' ).each( 
				function( el ) {  
									if( el.value != '' )
									{
										str_request = str_request + '&name_alias_new_create[]=' + el.value; 
									}
								}
							);					
		*/
		
		// Network Credentials --- traitements --- //
		// Traitement des eventuels credentials à modifier
		$$('.input_netlogin_change_id').each ( 
						function(el){ str_request = str_request + '&netlogin_change_id[]=' + el.value; }
									 );			
		
		// encodeURIComponent() traite les caractères tels que #, ? etc... dans les mots de passes 
		$$('.input_netlogin_change_pwd').each ( 
						function(el){ str_request = str_request + '&netlogin_change_pwd[]=' + encodeURIComponent(el.value); }
									 );			
			
		
		
		// traitement des données éditées dans l'onglet Procédures 
		// si nécessaire ( = si l'onglet a déjà été chargé en edition auparavant)
		/*
 		if( document.getElementById("opened_tab_procedures") && document.getElementById("opened_tab_procedures").value == 1 )
 		{
 			str_request = str_request + '&tab_procedures=1';
 			
 			$$('.txt_wysiwyg').each ( 
				function(el)
				{ 
					var el_data = CKEDITOR.instances[el.id].getData();
					str_request = str_request + '&txt_procedures['+ el.get('rel') +']=' + encodeURIComponent(el_data); 
				}
			 );		

 		} 
 		*/		
		
		// // // //
		//prompt('', 'actions_equipment_card.php' + str_request);
		//return false;
		// // // //
				
		var tab_args = new Array();
		tab_args[0] = id_eqp;
		tab_args[1] = tab_name;
		tab_args[2] = is_popup;
		
		call_ajax_action( 'actions_equipment_card.php' + str_request , callback_update_card, tab_args );

}

function callback_update_card( res_action, tab_args )
{

	id_eqp = tab_args[0];
	tab_name = tab_args[1];
	is_popup = tab_args[2];
	
	if( res_action == 0 )
	{
		alert('Error while saving this Equipment.'); 
	}
		
		if( is_popup == 1 )
		{
			// cas du pop-up
			//alert('TODO: is_popup == 1 | common.js->save_edit_eqp_card(id_eqp, tab_name, is_popup)');
			
			window.location.href ='?todo=view&id_eqp='+id_eqp+'&popup='+is_popup+'&tab='+tab_name; 
			return false;
		}
		else
		{
			// la page est appelée en Ajax.
			//display_equipments(id_eqp, tab_name, 'view');
			//alert('TODO: is_popup == 0 | common.js->save_edit_eqp_card(id_eqp, tab_name, is_popup)');
			
			if( id_eqp == 0 )
			{
				// cas d'un insert
				id_eqp = res_action; // on récupère l' id_eqp généré par l'insert 

				// on se trouve dans la page New Equipment : on condamne l'acces au bouton Create New Equipment
				//$('div_btn_create_equipment').innerHTML = '&nbsp;';
				//$('div_btn_create_equipment').style.display = 'none';
			}
			
			//on unlock la fiche equipement
			eqp_unlock(id_eqp);
			
			// la page view est appelée en Ajax.
			display_equipments(id_eqp, tab_name, 'view');
			
			
			if( $('eqp_code_page') && $('eqp_code_page').value == 'eqp_new' )
			{
				// si page new_equipment
			}
			else
			{
				// si page eqp_equipments List classique
				refresh_search_equipment(); // fonction définie dans "eqp_equipments.js" uniquement
			}
			
			return false;
		} 

}

/*
 * Suppression d'un Equipement (FLAG deleted = 1) ainsi que de toutes les données associées
 * dans les différentes tables de l'application 
 */
function delete_eqp(id_eqp)
{
	//alert('TODO: common.js->delete_eqp(id_eqp)');
	if( confirm('[ ! ]  WARNING  [ ! ]\n\nThis Equipment and all corresponding data will be deleted.\n\nAre you sure to delete this Equipment?') )
	{
		var str_request = '?todo=delete&id_eqp=' + id_eqp;	
	
		call_ajax_action( 'actions_equipment_card.php' + str_request , callback_delete_eqp, id_eqp );
	}
	
	return false; 
}

/*
 * Fonction de callback après suppression d'un Equipement
 */
function callback_delete_eqp(res_action, args)
{
	if( res_action == 1 )
	{
		alert('This Equipment (and all corresponding data) has been successfully deleted.');
		if( $('eqp_code_page') && $('eqp_code_page').value == 'eqp_new' )
		{
	 		window.location.href  =  'index.php';
		}
		else
		{
			// si page eqp_equipments List classique
			close_eqp_card_maximize_list('0');
			//call_search_equipment();
			refresh_search_equipment(); // fonction définie dans "eqp_equipments.js" uniquement
		}
	}
	else
	{
		alert('An ERROR occured while deleting this Equipment (or associated data).');
	}
	
	return false;
}



function eqp_unlock(id_eqp)
{
	if( id_eqp != 0 )
	{	
		str_request = '?todo=unlock&id_eqp=' + id_eqp;
		call_ajax_action( 'actions_equipment_card.php' + str_request , callback_eqp_unlock, 0 );
	}
}

function callback_eqp_unlock(res_action, args)
{
	return false;
}


function show_hide_permalink()
{
	if( document.getElementById('tr_card_permalink') )
	{
		if( $('tr_card_permalink').style.display == 'none' )
		{
			$('tr_card_permalink').style.display = ''; 
			$('txt_card_permalink').select();
		}
		else
		{
			$('tr_card_permalink').style.display = 'none';
		}
	}
}

/*
 * Appel lors d'un onchange sur une liste de areas de la FICHE EQUIPMENT
 */
function change_card_area( id_area )
{
	$('div_card_select_site').innerHTML = '<input type="hidden" value="0" id="id_eqp_site" name="id_eqp_site" /><span style="color:red;font-style:italic;">Please, select a subsidiary...</span>';
	$('div_card_select_locus').innerHTML = '<input type="hidden" value="0" id="id_eqp_locus" name="id_eqp_locus" /><span style="color:red;font-style:italic;">Please, select a site...</span>';
	
	get_select_sub_site( 'list_sub', 'div_card_select_sub', 0, id_area, 'id_eqp_sub', 'id_eqp_sub', 'change_card_sub(this.value);return false;', 'width:180px;', 'Select one...', 'input_type'  );
	return false;
}

/*
 * Appel lors d'un onchange sur une liste de sub de la FICHE EQUIPMENT
 */
function change_card_sub( id_sub )
{
	$('div_card_select_locus').innerHTML = '<input type="hidden" value="0" id="id_eqp_locus" name="id_eqp_locus" /><span style="color:red;font-style:italic;">Please, select a site...</span>';
	
	if( id_sub == 0 )
	{
		$('div_card_select_site').innerHTML = '<input type="hidden" value="0" id="id_eqp_site" name="id_eqp_site" /><span style="color:red;font-style:italic;">Please, select a subsidiary...</span>';
		return false;
	}
	
	get_select_sub_site( 'list_site', 'div_card_select_site', id_sub, 0, 'id_eqp_site', 'id_eqp_site', 'change_card_site(this.value);return false;', 'width:180px;', 'Select one...', 'input_type'  );
	return false;
}

/*
 * Appel lors d'un onchange sur une liste de sub de la FICHE EQUIPMENT
 */
function change_card_site( id_site )
{
	if( id_site == 0 )
	{
		$('div_card_select_locus').innerHTML = '<input type="hidden" value="0" id="id_eqp_locus" name="id_eqp_locus" /><span style="color:red;font-style:italic;">Please, select a site...</span>';
		return false;
	}

	get_select_locus( 'list_locus', 'div_card_select_locus', id_site, 0, 'id_eqp_locus', 'id_eqp_locus', '', 'width:180px;', 'Select one...', 'input_type'  );
	return false;
}


/*
 * Recuperation en AJAX d'un SELECT populé de la liste des Subsidiaries ou des Sites correspondants
 */
function get_select_sub_site( todo_action, div_destination, id_sub, id_area, name_select, id_select, js_action, str_styles, str_first_item, str_class  )
{


	var str_request = '?todo=' + todo_action + 
					  '&id_sub=' + id_sub + 
					  '&id_area=' + id_area + 
					  '&name_select=' + name_select +
					  '&id_select=' + id_select +
					  '&js_action=' + js_action +
					  '&str_styles=' + str_styles + 
					  '&str_class=' + str_class + 
					  '&str_first_item=' + str_first_item; 
	
	if($('no_limit')) {
		str_request += '&no_limit=1'; 
	}
	
	//prompt('', str_request);
	
	if( id_sub == 0 )
	{
		// si id_sub == 0 :
		// => alors affichage de la liste des SUB => fonction de callback (on génère directement la liste des sites correspondants)  
		// ===========================================

		if( div_destination == 'div_card_select_sub')
		{
			call_ajax_page( 'get_select_sub_sites.php' + str_request , div_destination, callback_get_select_sub_site_card );
		}
		else
		{
			call_ajax_page( 'get_select_sub_sites.php' + str_request , div_destination, callback_get_select_sub_site );
		}
	}
	else
	{
		// si id_sub != 0 :
		// => alors affichage de la liste des SITES => SURTOUT PAS DE FONCTION DE CALLBACK 
		//   SINON recursivité avec boucle sans fin  
		// 	(car la meme fonction js utilisée pour génération de la liste des SUB et la liste des SITES)
		// ===========================================
		
		//call_ajax_page( 'get_select_sub_sites.php' + str_request , div_destination, 0 );
		
		// on rajoute fonction callback pour générer la liste des LOCUS 
		call_ajax_page( 'get_select_sub_sites.php' + str_request , div_destination, callback_get_select_site_locus_card );
		
	}

}

/*
 * function de callback permettant la re-génération de la liste des sites 
 * suivant la subsidiary selectionnée 
 */ 
function callback_get_select_sub_site()
{
	if( document.getElementById('div_criteria_select_site') && document.getElementById('id_sub') )
	{
		change_criteria_sub($('id_sub').value);
	}
}

function callback_get_select_sub_site_card()
{
	if( document.getElementById('div_card_select_sub') && document.getElementById('id_eqp_sub') )
	{
		change_card_sub($('id_eqp_sub').value);
	}
}

/*
function callback_get_select_site_locus()
{
	if( document.getElementById('div_criteria_select_locus') && document.getElementById('id_site') )
	{
		change_criteria_site($('id_site').value);
	}
}
*/

function callback_get_select_site_locus_card()
{
	if( document.getElementById('div_card_select_site') && document.getElementById('id_eqp_site') )
	{
		change_card_site($('id_eqp_site').value);
	}
}

/*
 * Recuperation en AJAX d'un SELECT populé de la liste des Locus correspondants
 */
function get_select_locus( todo_action, div_destination, id_site, id_sub, name_select, id_select, js_action, str_styles, str_first_item, str_class  )
{


	var str_request = '?todo=' + todo_action + 
					  '&id_site=' + id_site + 
					  '&id_sub=' + id_sub + 
					  '&name_select=' + name_select +
					  '&id_select=' + id_select +
					  '&js_action=' + js_action +
					  '&str_styles=' + str_styles + 
					  '&str_class=' + str_class + 
					  '&str_first_item=' + str_first_item; 
	//prompt('', str_request);
	
	if( id_site == 0 )
	{
		// si id_site == 0 :
		// pas d'affichage
	}
	else
	{
		// si id_site != 0 :
		// => alors affichage de la liste des LOCUS => SURTOUT PAS DE FONCTION DE CALLBACK 
		//   SINON recursivité avec boucle sans fin  
		// ===========================================
		
		call_ajax_page( 'get_select_sub_sites.php' + str_request , div_destination, 0 );
	}

}



/*
 * Recuperation en AJAX d'un SELECT populé de la liste des Privileges 
 * correspondant à l'EQP Type de l'equipement passé en paramètre 
 */
function get_select_privileges( todo_action, div_destination, id_eqp, name_select, id_select, js_action, str_styles, str_first_item, str_class  )
{ 
	var str_request = '?todo=' + todo_action + 
					  '&id_eqp=' + id_eqp + 
					  '&name_select=' + name_select +
					  '&id_select=' + id_select +
					  '&js_action=' + js_action +
					  '&str_styles=' + str_styles + 
					  '&str_class=' + str_class + 
					  '&str_first_item=' + str_first_item; 
	//prompt('', str_request);
	call_ajax_page( 'get_select_privileges.php' + str_request , div_destination, 0 );

}






/*
 * Appel lors d'un onchange sur une liste des OS TYPES de la FICHE EQUIPMENT 
 */
function change_card_os_type( id_os_type )
{
	if( id_os_type == 0 )
	{
		$('div_card_select_os_version').innerHTML = '<input type="hidden" value="" id="eqp_id_os_version" name="eqp_id_os_version" /><span style="color:red;font-style:italic;">Please, select an OS Type..</font>';
		return false;
	}

	get_select_os_version( 'div_card_select_os_version', id_os_type, 'eqp_id_os_version', 'eqp_id_os_version', '', 'width:150px;', 'Select one...', 'input_type'  );
	return false;
}

/*
 * Recuperation en AJAX d'un SELECT populé de la liste des VERSION d'OS correspondants au TYPE passé en paramètre
 */
function get_select_os_version( div_destination, id_os_type, name_select, id_select, js_action, str_styles, str_first_item, str_class  )
{
	var str_request = '?id_os_type=' + id_os_type + 
					  '&name_select=' + name_select +
					  '&id_select=' + id_select +
					  '&js_action=' + js_action +
					  '&str_styles=' + str_styles + 
					  '&str_class=' + str_class + 
					  '&str_first_item=' + str_first_item; 
	//prompt('', str_request);
	call_ajax_page( 'get_select_os_version.php' + str_request , div_destination, 0 );
}



/*
 * Appel lors d'un onchange sur une liste des EQP TYPES de la FICHE EQUIPMENT 
 */
function change_card_eqp_type( id_eqp_type )
{
	$('div_card_select_os_version').innerHTML = '<input type="hidden" value="" id="eqp_id_os_version" name="eqp_id_os_version" /><span style="color:red;font-style:italic;">Please, select an OS Type..</font>';
	if( id_eqp_type == 0 )
	{
		$('div_card_select_os_type').innerHTML = '<input type="hidden" value="" id="eqp_id_os_type" name="eqp_id_os_type" /><span style="color:red;font-style:italic;">Please, select an EQP Type..</font>';	
		return false;
	}

	get_select_os_type( 'div_card_select_os_type', id_eqp_type, 'eqp_id_os_type', 'eqp_id_os_type', 'change_card_os_type(this.value);return false;', 'width:150px;', 'Select one...', 'input_type'  );
	
	if(id_eqp_type == 16) {
		$$('.category').each(function(el){
			el.style.display = '';
		});
		$$('.select_ip_cat').each(function(el){
			el.removeProperty('disabled');
		});
	}
	else {
		$$('.category').each(function(el){
			el.style.display = 'none';
		});
		$$('.select_ip_cat').each(function(el){
			el.set('disabled','disabled');
		});
	}
	
	
	
	return false;
}

/*
 * Recuperation en AJAX d'un SELECT populé de la liste des TYPES d'OS correspondants au TYPE EQP passé en paramètre
 */
function get_select_os_type( div_destination, id_eqp_type, name_select, id_select, js_action, str_styles, str_first_item, str_class  )
{

	var str_request = '?id_eqp_type=' + id_eqp_type + 
					  '&name_select=' + name_select +
					  '&id_select=' + id_select +
					  '&js_action=' + js_action +
					  '&str_styles=' + str_styles + 
					  '&str_class=' + str_class + 
					  '&str_first_item=' + str_first_item; 
	//prompt('', str_request);
	
	if( div_destination == 'div_card_select_os_type' )
	{
		call_ajax_page( 'get_select_os_type.php' + str_request , div_destination, callback_get_select_os_type_card );
	}
	else
	{
		call_ajax_page( 'get_select_os_type.php' + str_request , div_destination, 0 );
	}
}



function callback_get_select_os_type_card()
{
	if( document.getElementById('div_card_select_os_type') && document.getElementById('eqp_id_os_type') )
	{
		change_card_os_type($('eqp_id_os_type').value);
	}
}



function save_data_card(tr_name)
{
	show_data_card_icon(tr_name);
}


var min_func = function( e ) {  
						
							maximize_eqp_list();
							return false; 
							}
							

var max_func = function( e ) {  
						
							minimize_eqp_list();
							return false; 
							}

function maximize_eqp_list()
{


	$('content_equipment_card').style.width 	= '49%';	
	$('content_equipment_card').style.display 	= 'none';
	$('img_eqp_card_maximize').src="/module/image/legacy/maximize_16.gif";
	
	if( document.getElementById('content_list_equipments') )
	{
	
	$('content_list_equipments').style.width = '100%';
	
	}
	
	/*
	$('img_action_min_max').src = '/module/image/legacy/minimize_16.gif';
	$('img_action_min_max').title = 'Minimize';
	//$('img_action_min_max').onclick = 'minimize_eqp_list();return false;';	
	
	$('img_action_min_max').removeEvent('click', min_func);
	$('img_action_min_max').addEvent('click', max_func);
	*/

	
	return false;
}




function minimize_eqp_list()
{
	if( document.getElementById('content_list_equipments') )
	{
	
	$('content_list_equipments').style.display 	= '';
	$('content_list_equipments').style.width 	= '49%';
	
	}
	
	$('content_equipment_card').style.display 	= '';
	$('content_equipment_card').style.width 	= '49%';
	if($('img_eqp_card_maximize'))
	{
		$('img_eqp_card_maximize').src="/module/image/general/button_maximize_16.gif" //arrow_out_16.png"; //go_fullscreen.png"; //"/module/image/legacy/maximize_16.gif"; 
	}
				
	/*
	$('img_action_min_max').src = '/module/image/legacy/maximize_16.gif';
	$('img_action_min_max').title = 'Maximize';
	//$('img_action_min_max').onclick = 'hide_eqp_card();return false;';

	
	$('img_action_min_max').removeEvent('click', max_func);
	$('img_action_min_max').addEvent('click', min_func);
	 */

	
	
	return false;
}

function close_eqp_card_maximize_list(is_popup)
{
	if( is_popup == '1' )
	{
		// dans un popup : on close le popup
		this.close();
	}
	else
	{
		// dans la page principale
		
		$('div_eqp_equipment_title').style.display 	= '';
		$('div_eqp_equipment_criteria').style.display 	= '';
		
		
		$('div_eqp_equipment_container_result').setStyle('margin-right', '5px');
		$('div_eqp_equipment_container_result').setStyle('padding-top', '10px');
		$('div_eqp_equipment_container_result').setStyle('width', '95%');
		
		
		$('content_equipment_card').style.display 	= 'none';
		$('content_equipment_card').style.width 	= '49%';
		//$('content_equipment_card').setStyle('margin-top', '25px');
		$('content_equipment_card').setStyle('margin-top', '28px');
				
		$('img_eqp_card_maximize').src="/module/image/general/button_maximize_16.gif";
					
		if( document.getElementById('content_list_equipments') )
		{
		$('content_list_equipments').style.display 	= '';
		$('content_list_equipments').style.width 	= '100%';
		
		}
	}
	return false;
}


function max_minimize_eqp_card()
{	
	if( document.getElementById('content_list_equipments') )
	{
		if( $('content_list_equipments').style.display == '' )
		{
			$('div_eqp_equipment_title').style.display 	= 'none';
			$('div_eqp_equipment_criteria').style.display 	= 'none';
			
			$('div_eqp_equipment_container_result').setStyle('margin-right', '0px');
			$('div_eqp_equipment_container_result').setStyle('padding-top', '0px');
			$('div_eqp_equipment_container_result').setStyle('width', '100%');
			
			$('content_equipment_card').style.display 	= '';
			$('content_equipment_card').setStyle('margin-top', '0px');
			$('content_equipment_card').style.width 	= '100%';	

			$('content_list_equipments').style.width 	= '0%';		
			$('content_list_equipments').style.display 	= 'none';

			$('img_eqp_card_maximize').src="/module/image/general/button_minimize_16.gif"; //arrow_in_16.png"; //leave_fullscreen.png"; // "/module/image/legacy/minimize_16.gif";
		}
		else
		{
			$('div_eqp_equipment_title').style.display 	= '';
			$('div_eqp_equipment_criteria').style.display 	= '';
			
			$('div_eqp_equipment_container_result').setStyle('margin-right', '5px');
			$('div_eqp_equipment_container_result').setStyle('padding-top', '10px');
			$('div_eqp_equipment_container_result').setStyle('width', '95%');
			
			$('content_equipment_card').style.display 	= '';
			//$('content_equipment_card').setStyle('margin-top', '25px');
			$('content_equipment_card').setStyle('margin-top', '28px');
			$('content_equipment_card').style.width 	= '49%';
			
		
			$('content_list_equipments').style.width 	= '49%';				
			$('content_list_equipments').style.display 	= '';
			
			$('img_eqp_card_maximize').src="/module/image/general/button_maximize_16.gif"; //arrow_out_16.png"; //go_fullscreen.png";  // "/module/image/legacy/maximize_16.gif";
		}
	
	}
	
}


function add_eqp_service()
{
	var id_service_cur = $('add_id_service').value;
	
	if( id_service_cur == 0 )
	{
		alert('Please select one service to add.');
		return false;	
	}
	if( document.getElementById('div_item_service_'+ id_service_cur) )
	{
		alert('This service is still associated with this Equipment. Please choose another one.');
		return false;
	}

	var name_service_cur	= $('add_id_service').options[$('add_id_service').selectedIndex].text;	


	var inner_html_span = '<img src="/module/image/legacy/dot_black.png" style="vertical-align:middle;">&nbsp;&nbsp;'+name_service_cur
						+ '<input type="hidden" class="eqp_card_service" name="eqp_id_service[]" value="'+ id_service_cur +'" />' 
						+ '<img src="/module/image/shadowless/cross-script.png"  style="cursor:pointer;vertical-align:middle;" title="Remove this service" onclick="remove_eqp_service(\''+id_service_cur+'\');return false;" />'  
						+ '';
											
											
	  var newspan = document.createElement('div');
	  var spanId = 'div_item_service_'+id_service_cur;
	  newspan.setAttribute('id',spanId);
	  newspan.innerHTML = inner_html_span;
	  $('eqp_card_services_list').appendChild(newspan);
	  
	  $('eqp_no_service_found').style.display = 'none';	  
	  $('add_id_service').value = '';												
	
	
	return false;
}

function remove_eqp_service(id_service_cur)
{
	$('div_item_service_' + id_service_cur).innerHTML = '';
	$('eqp_card_services_list').removeChild($('div_item_service_' + id_service_cur)); 
	
	return false;
}


function refresh_eqp_card()
{

/*
     $$( '.tr_survol_edit' ).each( function( el ) {

                 el.addEvents({

			

                            mouseenter: function( e ) {

                                   this.style.cursor = 'pointer';
	       	                       this.style.backgroundColor = '#D4DDEE'; 
	       	                       
	       	                       if( $('flag_edit_'+el.id).value == '0' )
	       	                       {     	                       
	       	                       		show_data_card_icon(el.id);
	       	                       }       	                       


                            },

                            mouseleave: function( e ) {  
                            
                            	   this.style.cursor = 'default';
                            	   this.style.backgroundColor = '#FFFFFF';      

	       	                       if( $('flag_edit_'+el.id).value == '0' )
	       	                       {   
		       	                       if( document.getElementById( 'edit_' + el.id ) )
		       	                       {
		       	                       		$('edit_' + el.id ).style.visibility = 'hidden';
		       	                       }
		       	                   }
                    		
                            }, 
                            'dblclick': function( e ) {

	       	                   edit_data_eqp_card(el.id);

                            }        

                 });
                 
     });    
*/
     // Ajoute le title dans une popup instantée pour les éléments pourvu d'un title.
	
     $$( '.tips' ).each( function( el ) {

                 el.addEvents({

                            mouseover: function( e ) {

                                        if( !this.saved_title ) {

                                                    this.saved_title = this.title;

                                        }

                                        this.title = '';

                                        this.style.cursor = 'pointer';

                                        popupOutline( this.saved_title );

                            },

                            mouseout: function( e ) { nd(); }

                 });

    	 /*
    	    el.store('tip:title', '' );
    	    el.store('tip:text', el.title);
		*/
     });
     /*
	var toolTipsTwo = new Tips('.tips', {
		className: 'custom_tip', //par défaut : null
	    hideDelay: 0,
	    showDelay: 0
	});
	*/
     
     		
     // ++++ INTEGRATION DE CKeditor ++++ //
     /*
     if( CKEDITOR )
     {
     	  
	      $$( '.txt_wysiwyg' ).each( function( el ) {
	
				
				// détruit une éventuelle ancienne instance de CKeditor liée 
				// au textarea courant
			    var instance_ckeditor = CKEDITOR.instances[el.id];
			    if(instance_ckeditor)
			    {
			        CKEDITOR.remove(instance_ckeditor);
			    }
	
				// crée une nouvelle instance de CKeditor pour le textarea courant
	         	CKEDITOR.replace( el.id , 
						         	{
									skin : 'office2003',
									language: 'en', 
									uiColor: '#E9EEEE', 
									width: '350px', 
									height: '100px',
									removePlugins: 'elementspath', 
									toolbarCanCollapse: false, 
									toolbar : [ [ 'Bold', 'Italic', 'Underline', 'Strike','-','Link','Unlink', '-', 'Font','FontSize','-', 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock', 'TextColor','BGColor'  ] ]									
									}
	         					);
	         	    
	
	     });    
     }
     */
     // ++++ +++++++++++++++++++++++ ++++ //
     
     
	if( 	document.getElementById('is_popup_card') 
		&&  $('is_popup_card').value == 0 )
	{
		/* double-click on equipment card title bar */
		/* SI N'EST PAS EN MODE POPUP */
		
       $('tr_title_eqp_card').addEvents({

                    
                    'dblclick': function( e ) { max_minimize_eqp_card(); }                         

         });     
     }
     
     	
}


/**

 * Popup affichant la description d'un dossier.
	<img src="/module/image/legacy/l_info.gif" style="vertical-align:middle;margin-right:5px;" />&nbsp;
 */

function popupOutline( comment )
{

            var popup = '<div class="custom_tip">' + comment + '</div>';

            return overlib( popup );

}

/**

 * Popup affichant la description.

 */

function popupOutlineDiv( comment )
{

            var popup = '<div class="custom_tip_white">' + comment + '</div>';

            return overlib( popup );

}


/**

 * Popup affichant la description.

 */

function popupOutlineWarning( comment )

{

            var popup = '<div class="custom_tip_warning"><img src="/module/image/legacy/warning.png" style="vertical-align:middle;margin-right:5px;" />&nbsp;' + comment + '</div>';

            return overlib( popup );

}

function show_div_add_site()
{
	var moofx 		= new Fx.Slide( 'div_add_site', {duration: 300} );

	if( status_slide_div_add_site == 0 )
	{
		$('div_tab_sites_actions').style.visibility = 'hidden';
		
		moofx.hide( );
		moofx.slideIn( );

		status_slide_div_add_site = 1;
	}
	else
	{
		moofx.toggle( );
		$('div_tab_sites_actions').style.visibility = 'visible';
		status_slide_div_add_site = 0;
		
		$('div_msg_error_add_site').style.display = 'none';
	}
	
	return false;
}

function add_new_ip_address()
{
	var nbr_increment = parseInt( $('nbr_total_ip_addr').value , 10 ) + 1;
	
	var str_radio_selected = '';
	if( $('tr_entete_ip_addr').style.display == 'none' )
	{
		$('tr_entete_ip_addr').style.display = ''; 
		if( document.getElementById('tr_ip_addr_no_data') )
		{
			$('tr_ip_addr_no_data').style.display = 'none';
		} 
		
		str_radio_selected = ' checked="checked"'; 
	}
	
	var oTbl = $('tbl_list_ip_address');
	
    var newRow = oTbl.insertRow(-1);
    newRow.setAttribute('id', 'tr_row_ip_addr_' + nbr_increment);
    
    var newCell = newRow.insertCell(0);
    newCell.setAttribute('align', 'center');
    newCell.innerHTML = '<input type="radio" name="is_main_interface[]" id="is_main_interface_'+nbr_increment+'" value="" class="tips input_ip_addr_is_main" title="is Main INTERFACE if selected" style="cursor:pointer;" '+str_radio_selected+'>' 
    					+ '<input type="hidden" name="id_ip_address[]" id="id_ip_address_'+nbr_increment+'" value="" class="input_ip_addr_id" />';
    newCell = newRow.insertCell(1);
    newCell.innerHTML = '<input type="text" id="value_ip_address_'+nbr_increment+'" name="value_ip_address[]" value="" class="input_wide input_ip_addr" maxlength="15" style="width:100px !important;" onchange="check_ip_addr(this.value, '+nbr_increment+');return false;" />' 
    					+ '<input type="hidden" class="is_valid_ip_addr" id="is_valid_ip_addr_'+nbr_increment+'" value="0"  />';	

    
    newCell = newRow.insertCell(2);
   	newCell.setAttribute('align', 'center');
    newCell.innerHTML = '/';
    
    newCell = newRow.insertCell(3);
    newCell.innerHTML = '<input type="text" id="value_mask_ip_address_'+nbr_increment+'" name="value_mask_ip_address[]" value="" class="input_wide input_ip_addr_mask" maxlength="2" style="width:20px !important;"  onkeyup="this.value=check_ip_mask(this.value);" />';
    
    newCell = newRow.insertCell(4);
    newCell = $(newCell);
    newCell.addClass('category');
    
    var select = '<select id="ip_category_'+nbr_increment+'" name="ip_category[]" class="select_ip_cat input_type" ';
    
    if($('eqp_id_eqp_type').value != 16) {
    	newCell.style.display = 'none';
    	select = select + 'disabled="disabled">';
    }
    else {
    	select = select + '>';
    }
    select = select + '<option value="0">select one category</option>'
							+ '<option value=""></option>'
							+ '<option value="public">Public</option>'
							+ '<option value="private">Private</option>'
							+ '<option value="RFC 1918">RFC 1918</option>'
						+ '</select>'
						+ '<input type="hidden" id="ip_category_hidden_'+nbr_increment+'" name="ip_category[]" class="select_ip_cat" disabled="disabled"/>';
    newCell.innerHTML = select;
    
    
    newCell = newRow.insertCell(5);
    newCell.innerHTML = '<input type="text" id="name_ip_address_'+nbr_increment+'" name="name_ip_address[]" value="" class="input_wide input_ip_addr_name" maxlength="100" />';
    
    newCell = newRow.insertCell(6);
    newCell.setAttribute('align', 'left');
   	newCell.setAttribute('style', 'padding-left:5px;');	
    newCell.innerHTML = '<img src="/module/image/shadowless/eraser.png" class="tips" style="cursor:pointer;vertical-align:middle;" title="Reset" onclick="reset_ip_address(\''+nbr_increment+'\');return false;" />';
    
    newCell = newRow.insertCell(7);
   	newCell.setAttribute('align', 'left');
   	newCell.setAttribute('style', 'padding-left:5px;');	
    newCell.innerHTML = '<img src="/module/image/shadowless/cross-script.png" class="tips" style="cursor:pointer;vertical-align:middle;" title="Remove this IP interface" onclick="remove_ip_address(\''+nbr_increment+'\');return false;" />';
	
	
	// ligne de message d'info
	var newRow = oTbl.insertRow(-1);
    newRow.setAttribute('id', 'tr_info_ip_addr_' + nbr_increment);
	newRow.setAttribute('style', 'display:none;');	

    var newCell = newRow.insertCell(0);
   	newCell.innerHTML = '&nbsp;';
	
    var newCell = newRow.insertCell(1);
   	newCell.innerHTML = '&nbsp;';
	newCell.setAttribute('id', 'td_info_ip_addr_' + nbr_increment);
	newCell.setAttribute('colspan', '4');
	newCell.setAttribute('class', 'ip_addr_info');

    var newCell = newRow.insertCell(2);
   	newCell.innerHTML = '&nbsp;';
	
	// 
	
	
	$('nbr_total_ip_addr').value = 	"" + nbr_increment;							
}


function remove_ip_address(id_increment)
{
 	if( document.getElementById('tr_row_ip_addr_' + id_increment) )
 	{
 		var oTrRow = $('tr_row_ip_addr_'+ id_increment);
		var i=oTrRow.rowIndex;
		document.getElementById('tbl_list_ip_address').deleteRow(i);
		
		var oTrInfo = $('tr_info_ip_addr_'+ id_increment);
		var i2=oTrInfo.rowIndex;
		document.getElementById('tbl_list_ip_address').deleteRow(i2);
		
		//var nbr_increment = parseInt( $('nbr_total_ip_addr').value , 10 ) - 1; 
			// on ne décrémente plus le nombre total car sinon bug JS en cas d'ajout d'une
			// address IP directement ensuite (car doublon possible dans les Id des 'is_ip_addr_valid' )
		var nbr_increment = parseInt( $('nbr_total_ip_addr').value , 10 );
		$('nbr_total_ip_addr').value = 	"" + nbr_increment;		
 	}
}

function check_ip_bdd_exists(value_ip_addr, id_increment)
{

	var str_request = '?todo=list' + 
					  '&ip_addr=' + value_ip_addr;
					  
	if( $('card_id_eqp').value != 0 )
	{
		str_request = str_request + '&id_eqp_excluded=' + $('card_id_eqp').value;
	}


					   
	//prompt('', str_request);
	call_ajax_action( 'check_ip_addr.php' + str_request , callback_ajax_ip_addr, id_increment );	
}

function callback_ajax_ip_addr( res_action, id_increment, supplement)
{
	isRFC1918 = supplement.item(0).firstChild.data;
	if( res_action != 0 )
	{
		// l'adresse IP existe dejà 
		
		$('tr_info_ip_addr_'+ id_increment).style.display = '';
		$('td_info_ip_addr_'+ id_increment).innerHTML = 'This IP address is already used by:<br />' + res_action;
		$('is_valid_ip_addr_' + id_increment).value = '0';
		$('value_ip_address_' + id_increment).style.color = 'red';
		
	}
	else
	{
		// ok
		$('tr_info_ip_addr_'+ id_increment).style.display = 'none';
		$('td_info_ip_addr_'+ id_increment).innerHTML = '';
		$('is_valid_ip_addr_' + id_increment).value = '1';	
		
		$('value_ip_address_' + id_increment).style.color = 'black';
		
		if(!$('ip_category_'+id_increment).get('disabled') || !$('ip_category_hidden_'+id_increment).get('disabled')) {
			if( isRFC1918 == 1 ) {
				$('ip_category_'+id_increment).value = "RFC 1918";
				$('ip_category_'+id_increment).set('disabled','disabled');
				$('ip_category_hidden_'+id_increment).value = $('ip_category_'+id_increment).value;
				$('ip_category_hidden_'+id_increment).set('disabled','');
			}
			else {
				$('ip_category_'+id_increment).set('disabled','');
				$('ip_category_hidden_'+id_increment).value = $('ip_category_'+id_increment).value;
				$('ip_category_hidden_'+id_increment).set('disabled','disabled');
			}
		}
	}
		

}

function check_ip_mask(value_ip_addr)
{
	var value_ret = value_ip_addr;
	if( parseInt(value_ip_addr,10) > 0 && parseInt(value_ip_addr,10) < 33 )
	{
		value_ret = value_ip_addr;
	}
	else
	{
		//alert('IP Mask must be > 0 and < 33.');
		value_ret = '';
	}
	
	return value_ret;
}

function check_ip_addr(value_ip_addr, id_increment)
{

	// ETAPE 1 - on verifie si @IP est bien formée
	// si "false" -> bloquant 
	var follow_process = true;
	
	var regex = new RegExp("^((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\\.){3}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})$", "");
	if( ! regex.test(value_ip_addr) ) 
	{ 	
		// ne correspond pas à une adresse IP 
		$('tr_info_ip_addr_'+ id_increment).style.display = '';
		$('td_info_ip_addr_'+ id_increment).innerHTML = 'This IP address is not valid.';
		$('is_valid_ip_addr_' + id_increment).value = '0';
		$('value_ip_address_' + id_increment).style.color = 'red';
		
		follow_process = false;
	}
	else
	{
		// ok
		$('tr_info_ip_addr_'+ id_increment).style.display = 'none';
		$('td_info_ip_addr_'+ id_increment).innerHTML = '';
		$('is_valid_ip_addr_' + id_increment).value = '1';	
		
		$('value_ip_address_' + id_increment).style.color = 'black';
		
		follow_process = true;
	}




	// ETAPE 2 - on verifie si @IP n'est pas déjà entrée dans un des autres input text pour cet equipement
	// si c'est le cas -> bloquant
	if( follow_process )
	{
		var test_other_input = 0;
		
	     $$( '.input_ip_addr' ).each( 
	     	function( el ) { 
		     	if( el.value == value_ip_addr )
		     	{
		     		test_other_input = test_other_input + 1;
		     	}
	     	}
	     );
	     
	     // s'il y a plus d'une adresse IP dans la liste (= l'input de reference inclus)
	     if( test_other_input > 1 )
	     {
			// adresse IP existe déjà dans un des autres input text de cet equipement 
			$('tr_info_ip_addr_'+ id_increment).style.display = '';
			$('td_info_ip_addr_'+ id_increment).innerHTML = 'This IP address already exists for this equipment.';
			$('is_valid_ip_addr_' + id_increment).value = '0';
			$('value_ip_address_' + id_increment).style.color = 'red';
			
			follow_process = false;	     
	     }
	     else
	     {
			// ok
			$('tr_info_ip_addr_'+ id_increment).style.display = 'none';
			$('td_info_ip_addr_'+ id_increment).innerHTML = '';
			$('is_valid_ip_addr_' + id_increment).value = '1';	
			
			$('value_ip_address_' + id_increment).style.color = 'black';
			
			follow_process = true;	     
	     }
	}


	// ETAPE 3 - on verifie si @IP appartient à un sous-reseau OU un interval d'IP 
	// -> Message d'Information suivant le retour (non bloquant)
	
	//TODO:	verifier si @IP appartient à un sous-reseau *************************************

	// ETAPE 4 - on verifie dans la BDD si @IP n'est pas déjà prise
	// si "false" -> bloquant
	if( follow_process )
	{
		check_ip_bdd_exists(value_ip_addr, id_increment);
	}
	
}


function check_eqp_name_bdd_exists(value_name_eqp)
{
	if( value_name_eqp != '' )
	{
		var str_request = '?todo=list' + 
						  '&name_eqp=' + value_name_eqp;
						  
		if( $('card_id_eqp').value != 0 )
		{
			str_request = str_request + '&id_eqp_excluded=' + $('card_id_eqp').value;
		}
			   
		//prompt('', str_request);
		call_ajax_action( 'check_eqp_name.php' + str_request , callback_ajax_eqp_name_bdd_exists, 0 );			
	}
	else
	{
		$('check_name_eqp_warning').style.display = '';
		$('check_name_eqp_result').style.display = 'none';
		$('card_name_eqp_is_valid').value = '0';	
	}
}

function callback_ajax_eqp_name_bdd_exists( res_action, i_arg )
{
	if( res_action != 0 )
	{
		// le nom d'equipement existe déjà
		$('check_name_eqp_warning').style.display = 'none';
		$('check_name_eqp_result').innerHTML = 'NOT Allowed. This equipment already exists.<br /><img src="/module/image/legacy/fleche-noire-droite.gif" class="img-vertical-middle">'+res_action;
		$('check_name_eqp_result').style.display = '';
		$('card_name_eqp_is_valid').value = '0';
		
		if( $('check_name_eqp_result').hasClass('name_eqp_check_result_good') )
		{ 
			$('check_name_eqp_result').removeClass('name_eqp_check_result_good');
			$('check_name_eqp_result').addClass('name_eqp_check_result_bad'); 
		} 			
		
	}
	else
	{
		// ok 
		$('check_name_eqp_warning').style.display = 'none';
		$('check_name_eqp_result').innerHTML = 'Valid name.';
		$('check_name_eqp_result').style.display = '';
		if( $('check_name_eqp_result').hasClass('name_eqp_check_result_bad') )
		{ 
			$('check_name_eqp_result').removeClass('name_eqp_check_result_bad');
			$('check_name_eqp_result').addClass('name_eqp_check_result_good'); 
		} 	
		
		$('card_name_eqp_is_valid').value = '1';
				
	}
}





/*
function check_lock_ok(id_eqp)
{
	//alert('check lock ok');

	if( id_eqp != 0 )
	{	
		str_request = '?todo=check_lock_ok&id_eqp=' + id_eqp;
		call_ajax_action( 'actions_equipment_card.php' + str_request , callback_eqp_lock_ok, id_eqp );
	}
}

function callback_eqp_lock_ok(res_action, id_eqp)
{
	if( res_action == 1 )
	{
		// traitement
		setTimeout('check_lock_ok('+id_eqp+')',10000); // rappel après 10 secondes = 10 000 millisecondes 
	}
	else
	{
		// on verifie bien que l' id_eqp de la fiche courante est bien celle de l'equipement testé
		// par le timer. Si ce n'est pas le cas, c'est qu'une autre fiche equipement a été loadé 
		// entre temps (et dans ce cas là, on ne fait rien, car un autre timer a été mis en route pour 
		// la nouvelle fiche). 
		if( id_eqp == $('card_id_eqp').value )
		{
			// la fiche n'est plus lockée ( = le temps d'édition par défaut a été dépassé )
			$('button_save_card_top').src = '/module/image/legacy/nosave.gif';
			$('button_save_card_top').onclick = '';
			$('div_no_save').style.display = '';
		}
	}
}
*/

function decrease_countdown_timer()
{
	if( document.getElementById('card_id_eqp') 
		&& $('card_id_eqp').value != 0 &&  $('card_id_eqp').value != '' )
	{
		var val_timer = $('countdown_timer_value').value;
		var val_timer_new = parseInt(val_timer, 10 ) - 10; // on retranche 10 secondes
		$('countdown_timer_value').value = val_timer_new; // on le repercute dans l'input hidden
		
		if( val_timer_new > 0 )
		{

			var hourVar = Math.floor(val_timer_new/3600);   		// The hours
			var minVar = Math.floor(val_timer_new/60) - (hourVar*60);  // The minutes
			var secVar = val_timer_new - (hourVar*3600) - (minVar*60);	// The balance of seconds
			
			
			str_timer_new = '';
			/*
			if( hourVar > 0 )
			{
				hourVar = hourVar + "";
				if (hourVar.length == 1)
				{hourVar = "" + hourVar;}
				str_timer_new += hourVar + ":";
			}
			*/		
			
			if( minVar > 0 )
			{
				var str_pluriel = '';
				if( minVar > 1 ){str_pluriel='s';}
				
				minVar  = minVar  + "";
				str_timer_new += minVar + ' minute' + str_pluriel;
			}
			else
			{
				secVar  = secVar  + "";
				if (secVar.length == 1)
				{secVar = "0" + secVar;}
				
				str_timer_new += secVar + ' seconds';
			}

			$('span_countdown_display').innerHTML = str_timer_new + ' remaining';
			setTimeout('decrease_countdown_timer()',10000); // rappel après 10 secondes = 10 000 millisecondes
		}
		else
		{
			// la fiche n'est plus lockée ( = le temps d'édition par défaut a été dépassé )
			$('button_save_card_top').src = '/module/image/general/save_floppy_blue_not.png'; //'/module/image/legacy/nosave.gif';
			$('button_save_card_top').onclick = '';
			
			$('button_save_card_bottom').style.display = 'none';
			$('button_save_card_bottom').onclick = '';
			
			
			$('div_countdown').style.display = 'none';	
			$('div_no_save').style.display = '';		
		}
	
	} 
}



/**
 * Actions exécutées au chargement de la page.
 */
window.addEvent( 'domready', function()
{

	// Ajout des DatePicker.
	$$('input.DatePicker').each( function(el)
	{
		// Calendrier.
		new DatePicker(el);
	});
	
	
     // Ajoute le title dans une popup instantée pour les éléments pourvu d'un title.
     $$( '.tips' ).each( function( el ) {

                 el.addEvents({

                            mouseover: function( e ) {

                                        if( !this.saved_title ) {

                                                    this.saved_title = this.title;

                                        }

                                        this.title = '';

                                        this.style.cursor = 'pointer';

                                        popupOutline( this.saved_title );

                            },

                            mouseout: function( e ) { nd(); }

                 });

     });	
     
     
     // Ajoute le title dans une popup instantée pour les éléments pourvu d'un title.
     $$( '.tips_content' ).each( function( el ) {

                 el.addEvents({

                            mouseover: function( e ) {

                                         var content_val = $('div_' + el.id ).innerHTML;

                                         this.style.cursor = 'pointer';

                                         popupOutlineDiv( content_val );


                            },

                            mouseout: function( e ) { nd(); }

                 });

     });     
     
	
});


window.onbeforeunload = function(e) 
{	
	if( document.getElementById('card_id_eqp') )
	{
		if( $('card_id_eqp').value != 0 )
		{
			// unlock de la fiche Equipment affichée en mode EDITION (  $('card_id_eqp').value != 0 )
			// avant remplacement par la nouvelle
			eqp_unlock($('card_id_eqp').value);
		}
	}
}


/*
 * Charge l'onglet de Status de la fiche Equipements avec un nouveau select view
 */
function change_eqp_tab_status_view(id_view)
{
	var str_request = '?todo=view&id_eqp=' + $('id_eqp_selected').value + '&tab=status&status_view='+id_view+ '&timeZoneOffset=' + $('timeZoneOffset').value;
	call_ajax_page( 'get_equipment_card_tab.php' + str_request , 'tab_status', call_ajax_post_eqp_tab );
}

/*
 * Callback function : after loading new tab in the equipment card
 */ 
function call_ajax_post_eqp_tab()
{
	refresh_eqp_card();

	return false;
}


function call_popup_persistant( div_name )
{
     $$( '.custom_tip_persistant' ).each( 
     	function( el ) { 
	     el.style.display = 'none';
     	}
     );	
	
	$( div_name ).style.display = '';
}

function close_popup_persistant( div_name )
{
	if( div_name != '' )
	{
		// si nom de div passée en paramètre, alors on la ferme
		$( div_name ).style.display = 'none';
	}
	else
	{
		// si pas de nom de div passée en paramètre,
		// alors on ferme toutes les div persistantes
		$$( '.custom_tip_persistant' ).each( 
     		function( el ) { 
	    	 el.style.display = 'none';
     		}
     	);	
     
	}
	
}

function open_log_prstools(path_log)
{
	//prompt('', path_log);
	timestamp_nbr = new Date().getTime();
			
	window.open (path_log, 'popup_log_'+timestamp_nbr, config='height=450, width=550, toolbar=no, menubar=no, scrollbars=yes, resizable=yes, location=no, directories=no, status=no');
	return false;
}


function show_hide_pwd(id_netlogin, flag_action)
{
	/*
	if( flag_action == 'show' )
	{
		$('netlogin_stars_' + id_netlogin).innerHTML = $('netlogin_pwd_' + id_netlogin).innerHTML;
	}
	else
	{
		$('netlogin_stars_' + id_netlogin).innerHTML = "&bull;&bull;&bull;&bull;&bull;&bull;&bull;";
	}
	*/

	if( $('netlogin_stars_' + id_netlogin).style.display == 'none' )
	{
		// cache le mot de passe
		 $('netlogin_stars_' + id_netlogin).style.display 	= '';
		 $('netlogin_pwd_' + id_netlogin).style.display 	= 'none'; 
		 $('netlogin_display_' + id_netlogin).innerHTML 	= 'show'; 
	}
	else
	{
		// affiche le mot de passe 
		 $('netlogin_stars_' + id_netlogin).style.display 	= 'none';
		 $('netlogin_pwd_' + id_netlogin).style.display 	= ''; 
		 $('netlogin_display_' + id_netlogin).innerHTML 	= 'hide'; 
	}
	
}


function show_hide_eqp_credential_pwd(id_credential, flag_action)
{
	if( $('eqp_credential_stars_' + id_credential).style.display == 'none' )
	{
		// cache le mot de passe
		 $('eqp_credential_stars_' + id_credential).style.display 	= '';
		 $('eqp_credential_pwd_' + id_credential).style.display 	= 'none'; 
		 $('eqp_credential_display_' + id_credential).innerHTML 	= 'show'; 
	}
	else
	{
		// affiche le mot de passe 
		 $('eqp_credential_stars_' + id_credential).style.display 	= 'none';
		 $('eqp_credential_pwd_' + id_credential).style.display 	= ''; 
		 $('eqp_credential_display_' + id_credential).innerHTML 	= 'hide'; 
	}
	
}


function show_hide_eqp_pwd(id_identifiant)
{
	if( $('netlogin_stars_sos_current_' + id_identifiant).style.display == 'none' )
	{
		// cache le mot de passe
		 $('netlogin_stars_sos_current_' + id_identifiant).style.display 	= '';
		 $('netlogin_pwd_sos_current_' + id_identifiant).style.display 	= 'none'; 
		 $('netlogin_display_sos_current_' + id_identifiant).innerHTML 	= 'show'; 
	}
	else
	{
		// affiche le mot de passe 
		 $('netlogin_stars_sos_current_' + id_identifiant).style.display 	= 'none';
		 $('netlogin_pwd_sos_current_' + id_identifiant).style.display 	= ''; 
		 $('netlogin_display_sos_current_' + id_identifiant).innerHTML 	= 'hide'; 
	}

}


function open_popup_eqp_card(id_eqp_cur)
{
	if( parseInt(id_eqp_cur, 10) != 0 )
	{
		// timestamp utilisé pour rendre le nom de pop-up toujours unique
		// => chaque clic sur le bouton 'pop-up' créera donc toujours une nouvelle pop-up
		timestamp_nbr = new Date().getTime();
	
		window.open ('ajax/php/get_equipment_card.php?todo=view&tab=common&popup=1&id_eqp='+id_eqp_cur, 'popup_eqp_'+id_eqp_cur+'_'+timestamp_nbr, config='height=450, width=550, toolbar=no, menubar=no, scrollbars=yes, resizable=yes, location=no, directories=no, status=no');
	
		// ------- TEST -------- //
		//window.open ('index.php', 'popup_eqp_'+id_eqp_cur, config='height=300, width=500, toolbar=no, menubar=no, scrollbars=yes, resizable=yes, location=no, directories=no, status=no');
		// --------------------- //		
	}
}

function reset_eqp_search_form()
{

	/*var tableau_input = $ES('input', 'form_critere');
	for(tableau_input as data_tableau_input)
	{
		
	}*/
	return false;
}


function show_hide_unlock()
{
	if( $('div_content_unlock').style.display == 'none' )
	{
		$('div_content_unlock').style.display = ''; 
		//$('button_netlogin_unlock').style.visibility = 'hidden';
		$('button_netlogin_unlock').style.display = 'none';
	}
	else
	{
		$('div_content_unlock').style.display = 'none'; 
		//$('button_netlogin_unlock').style.visibility = 'visible';
		$('button_netlogin_unlock').style.display = '';
	}
	
}

function confirm_unlock(id_eqp_cur, id_eqp_type_cur, id_sub_cur )
{
	if( id_eqp_cur != 0 && id_eqp_type_cur != 0 && id_sub_cur != 0 )
	{
		var str_admin_pwd 	= $('netlogin_admin_pwd').value;
		
		if(  str_admin_pwd != '' && str_admin_pwd.length > 3 )
		{
			if( confirm('Are you sure to UNLOCK this equipment with admin password "' + str_admin_pwd +'" ?' ) )
			{
				var str_request = '?todo=netlogin_unlock&id_eqp='+id_eqp_cur+'&id_eqp_type='+id_eqp_type_cur+'&id_sub='+id_sub_cur+'&admin_pwd='+str_admin_pwd; 
				//prompt('', 'actions_equipment_card.php' + str_request );
				call_ajax_action( 'actions_equipment_card.php' + str_request , callback_netlogin_unlock, id_eqp_cur );
			}
		}
		else
		{
			alert('You must enter an admin password ( 4 characters or more ).');
			return false;
		}
	}
	return false;
}

function callback_netlogin_unlock(res_action, id_eqp)
{
	if( res_action == 1 )
	{
		alert('Network Logins are unlocked and will be processed on next script run.');
		switchTabCard('credential', 'edit');
	}
	else
	{
		alert('Error while unlocking this equipment.');
	}
	return false;
}


function check_netlogin_exist(netlogin_input_id, div_netlogin_result)
{
	$(netlogin_input_id).style.backgroundImage = "url('/module/image/legacy/spinner.gif')";

	var netlogin_value = $(netlogin_input_id).value;
	
	var str_request = '?todo=check&login=' + netlogin_value ; 
	
	//prompt('', str_request);
	
	var tab_args = new Array();
	tab_args['netlogin_input_id'] = netlogin_input_id;
	tab_args['div_netlogin_result'] = div_netlogin_result;
	
	call_ajax_action( 'check_netlogin_exist.php' + str_request , call_ajax_post_chek_netlogin_exist, tab_args );	
}


function call_ajax_post_chek_netlogin_exist(res_action, tab_args)
{

	var str_result = "Netlogin already exists.<br />Please, choose another one.";
	if( res_action == 0 )
	{
		// netlogin doesn't exists => Ok
		str_result	= 'Ok';
		
		// flag setté à 1 == 'Ok'
		$(tab_args['netlogin_input_id'] + '_res').value = '1';
		
		$(tab_args['div_netlogin_result']).style.display = 'none';		
	}
	else
	{
		// netlogin already exists => NOk
		
		// flag setté à 0 == 'Ko'
		$(tab_args['netlogin_input_id'] + '_res').value = '0';
		$(tab_args['div_netlogin_result']).style.display = '';
		$(tab_args['div_netlogin_result']).innerHTML = str_result;
	}

	$(tab_args['netlogin_input_id']).style.backgroundImage = "url('/module/image/general/table_16.png')";

}


// AUTO SUGGEST EQUIPMENTS NAME --> RETURN EQP ID
function suggest_equipment(searched_val, id_list_result )
{
	if( searched_val.length < 3 )
	{
		$(id_list_result).style.display = 'none';
		return false;
	}
	
	$(id_list_result).style.display = '';

	var str_request = '?todo=list&flag_like_left=1&id_list_result='+ id_list_result +'&name_eqp=' + searched_val;
	//prompt('', str_request);
	
	// traitement de l'appel Ajax
	//call_ajax_page( 'suggest_equipments.php' + str_request , id_list_result, call_ajax_post_suggest_equipment );

	$('netlogin_eqp_autocomplete').style.backgroundImage = "url('/module/image/legacy/spinner.gif')";
	//document.getElementById(id_list_result).innerHTML = '<img src="/module/image/legacy/spinner.gif" title="Loading" alt="Loading" style="vertical-align:middle;" />&nbsp;&nbsp;<span style="vertical-align:middle;font-weight:normal;"><small><em>Loading...</em></small></font>';
		
	var url = '/module/it_equipment/ajax/php/suggest_equipments.php' + str_request ;
	//prompt( '', url );
	
	// APPEL DE LA PAGE EN ASYNCHRONE !!! IMPORTANT !!! // 
	var ajaxRequest = new Request( {	'url': url,
  										method: 'get',
  										async:	true, 
  										encoding: 'iso-8859-1',
  										onComplete: function( request, requestXML ) {
  										getBackAjaxContent( request, id_list_result, call_ajax_post_suggest_equipment );
  										} } ).send( ); 					
  	return true;	

}

function call_ajax_post_suggest_equipment()
{
	// TODO: call_ajax_post_suggest_equipment()
	
	$('netlogin_eqp_autocomplete').style.backgroundImage = "url('/module/image/equipments/network_16.gif')";
	return false;
}


function select_suggestion( id_suggestion, id_list_result ) //, value_suggestion , id_list_result, id_input_selected, id_input_origine )
{
	// TODO: select_suggestion()
	//alert('TODO: common.js->select_suggestion()');
	
	if(   $('id_eqp_type_assoc').value != 0  
		  &&   
			( 
			    (
					$('id_eqp_type_found_' + id_suggestion).value != $('id_eqp_type_assoc').value 
				)
				|| 
				( 	
					$('id_eqp_type_found_' + id_suggestion).value == $('id_eqp_type_assoc').value
					&& $('id_os_type_found_' + id_suggestion).value != $('id_os_type_assoc').value  
				)
			)
	  )
	{
		 alert('You can only add the same Type of Equipment (same Type and same OS)\nthan the first one.');
		 return false;
	} 
	
	$('netlogin_eqp_autocomplete_id').value = $('id_eqp_found_' + id_suggestion).value;
	$('netlogin_eqp_autocomplete_id_type').value = $('id_eqp_type_found_' + id_suggestion).value;
	$('netlogin_eqp_autocomplete').value 	= $('name_eqp_found_' + id_suggestion).value;

	$('id_eqp_type_assoc').value = $('id_eqp_type_found_' + id_suggestion).value;
	$('id_os_type_assoc').value = $('id_os_type_found_' + id_suggestion).value;
	
	$(id_list_result).style.display = 'none';
	
	return false;
}

function eraseDate(id_input_date)
{
	$(id_input_date).value = '';
}


function search_netlogins_eqp_list() 
{
	var str_param = '';
	if( document.getElementById('id_sub') )
	{	
		str_param = '&id_sub=' + $('id_sub').value;
	}
	if( document.getElementById('type_display_full') && document.getElementById('type_display_part') )
	{
		if( $('type_display_full').checked )
		{
			str_param = str_param + '&type_display=full';
		}
		else if( $('type_display_part').checked )
		{
			str_param = str_param + '&type_display=part';
		}
	}
	
	
	call_ajax_page( 'get_list_netlogins.php?todo=list' + str_param , 'content_list_netlogins', call_ajax_post_netlogins );  
}

function call_ajax_post_netlogins()
{




     $$( '.tr_survol' ).each( function( el ) {

                 el.addEvents({

			

                            mouseenter: function( e ) {

								if( $('lock_' + el.id).value == '0' )
								{
                                   this.style.cursor = 'pointer';
	       	                       this.style.backgroundColor = '#D4DDEE'; 
                				}         
				
                            },

                            mouseleave: function( e ) {  
                            
                            	if( $('lock_' + el.id).value == '0' )
								{
                            		this.style.cursor = 'default';
                            		this.style.backgroundColor = '#FFFFFF';
                            		
                            	}

                            }    
                            
      
                                                       


                 });
                 
     });

     
     // Ajoute le title dans une popup instantée pour les éléments pourvu d'un title.
     $$( '.tips' ).each( function( el ) {

                 el.addEvents({

                            mouseover: function( e ) {

                                        if( !this.saved_title ) {

                                                    this.saved_title = this.title;

                                        }

                                        this.title = '';

                                        this.style.cursor = 'pointer';

                                        popupOutline( this.saved_title );

                            },

                            mouseout: function( e ) { nd(); }

                 });

     });	     
     


	return false;
}

function delete_netlogin_by_id(id_netlogin_delete)
{
	if( confirm('This Network Login will be deleted. Are you sure to do this?') )
	{
		$('form_delete_netlogin_' + id_netlogin_delete).submit();
	}
}


function open_popup_eqp_network_logs( id_eqp_cur, type_log, date_log )
{
	if( parseInt(id_eqp_cur, 10) != 0 )
	{
		// timestamp utilisé pour rendre le nom de pop-up toujours unique
		// => chaque clic sur le bouton 'pop-up' créera donc toujours une nouvelle pop-up
		timestamp_nbr = new Date().getTime();
	
		window.open ('/module/it_equipment/ajax/php/get_equipment_network_logs.php?todo=view&type_log='+type_log+'&date_log='+date_log+'&popup=1&id_eqp='+id_eqp_cur, 'popup_eqp_'+id_eqp_cur+'_'+timestamp_nbr, config='height=450, width=550, toolbar=no, menubar=no, scrollbars=yes, resizable=yes, location=no, directories=no, status=no');

	}
}

var open_log_without_modif;
var open_log_modif;

function show_popup_choose_network_logs( id_eqp_cur, name_eqp_cur, date_log )
{

/*
	$('log_link_withoutdiff').removeEvent('click', open_log_without_modif);
	$('log_link_diff').removeEvent('click', open_log_modif);
	
	$('log_link_withoutdiff').addEvent( 'click' , open_log_without_modif = function(){ open_popup_eqp_network_logs( id_eqp_cur, 'backup_nodiff', date_log ); } );
	$('log_link_diff').addEvent( 'click' ,  open_log_modif = function() { open_popup_eqp_network_logs( id_eqp_cur, 'backup_diff', date_log ); } );

	$('div_choose_type_log_background').style.display = '';
	$('div_choose_type_log').style.display = '';
	$('log_eqp_title').innerHTML = name_eqp_cur;
*/	
	
	// initialisation de la Modal Box // 
    SqueezeBox.initialize({
        size: {x: 350, y: 200}, 
		sizeLoading: {x: 350, y: 200}, 
		overlayOpacity: 0.5
    });
	// // // // // // // // // // // //

	var str_request =   '?todo=view'  
					  + '&id_eqp='+id_eqp_cur
					  + '&name_eqp='+encodeURIComponent(name_eqp_cur)
					  + '&date_log='+date_log;
	
	//prompt('', str_request);
 	SqueezeBox.open( '/module/it_equipment/ajax/php/display_status_logs.php' + str_request ); //, {handler: 'iframe'} );  
 

	
	return false;
}

function close_popup_choose_network_logs()
{
	$('div_choose_type_log_background').style.display = 'none';
	$('div_choose_type_log').style.display = 'none';
	
	return false;
}


/*
function initialize_eqp_widget(code_widget, div_widget)
{
	
}
*/

function initialize_eqp_widget_actions()
{
	
	if( parseInt( $('eqp_nbr_user_widget_ready').value , 10) >= parseInt( $('eqp_nbr_user_widget').value , 10) )
	{
		$$('.widget_elem').each(
				function(el) { 
					
					 var id_access_widget_cur = el.get('alt');
					// alert(id_access_widget_cur);
					if( $('params_widget_'+id_access_widget_cur) )
					{
						$('params_widget_'+id_access_widget_cur).style.display = '';

						
						var mySlide = new Fx.Slide('params_widget_'+id_access_widget_cur).hide();
	  					$('btn_edit_params_widget_'+ id_access_widget_cur).addEvent('click', function(e){
	  					
							e.stop();
							mySlide.toggle();	
							
							var is_params_open = $('btn_edit_params_widget_'+id_access_widget_cur).get('rel');
							//alert(is_params_open);
							if( is_params_open == 0 )
							{
								$('btn_edit_params_widget_'+id_access_widget_cur).set('rel', '1');
								$('btn_edit_params_widget_'+id_access_widget_cur).setStyle('border','1px solid gray');
								$('btn_edit_params_widget_'+id_access_widget_cur).setStyle('background-color','beige');
							}
							else
							{
								$('btn_edit_params_widget_'+id_access_widget_cur).set('rel', '0');
								$('btn_edit_params_widget_'+id_access_widget_cur).setStyle('border','1px solid transparent');
								$('btn_edit_params_widget_'+id_access_widget_cur).setStyle('background-color','transparent');
							}
												
						});
						
	  				}	
				  }
		);
		
		/*
		$$('.widget_title_content').each(
				function(el) { 
	                 el.addEvents({
	                            mouseover: function( e ) { el.style.visibility = 'visible'; },
	                            mouseout: function( e ) { el.style.visibility = 'hidden';  }
	               			  	});		
				 }
		);
		*/
		
	}		
		
	return true;
}



var sortableList;

function initialize_widget_sortable()
{	
	if(  parseInt( $('eqp_nbr_user_widget_ready').value , 10 ) >= parseInt( $('eqp_nbr_user_widget').value , 10 ) )
	{

		var tListSortableList = $$('#list-sortable-widget-1, #list-sortable-widget-2, #list-sortable-widget-3'); //$$('#listA, #listB');
		
		sortableList = new Sortables(tListSortableList, {
		
		//sortableList = new Sortables('list-sortable-widget', {
			/* set options */
			handle: '.widget_title_bar', 
			constraint:true, 
			clone:true,
			opacity: 0.5, 
			revert: true,
			/*revert: { duration: 500, transition: 'bounce:out' },*/ 			
			snap: 5 , 
			/* initialization stuff here */
			initialize: function() { 

			},
			/* once an item is selected */
			onStart: function(el) { 
				el.set('old_bgcolor', el.style.backgroundColor);
				el.setStyle('background','beige');
				//el.setStyle('z-index', 3000);
				//show_dashboard_grid(1);
			},
			/* when a drag is complete */
			onComplete: function(el) {
			
				var old_bgcolor = el.get('old_bgcolor'); 
				el.setStyle('background', old_bgcolor);
				//el.setStyle('z-index', 2);
							
				//creation d'une String pour le nouvel ordre
				var sort_order = '';
				var nbr_widget_per_column = 0;
				var i_column = 1;
				for (i_column=1; i_column<=3; i_column++)
				{
					nbr_widget_per_column = 0;
					$$('#list-sortable-widget-'+i_column+' .widget_elem').each(
									function(div_el) { 
														nbr_widget_per_column++;
														sort_order = sort_order + '' + div_el.get('alt')  + '.'; 
													  }
					);
					
					if( i_column < 3 )
					{ sort_order = sort_order + '|'; }
					
					// update en JS des input nbr de wigets par colonnes 
					$('nbr_widget_col_' + i_column ).value = ''+nbr_widget_per_column;					
				}

				//	$$('#list-sortable-widget-1 .widget_elem').each(function(div_el) { sort_order = sort_order +  div_el.get('alt')  + '|'; });
				//	sort_order = sort_order + "¤";				
				//	$$('#list-sortable-widget-2 .widget_elem').each(function(div_el) { sort_order = sort_order +  div_el.get('alt')  + '|'; });
				//	sort_order = sort_order + "¤";
				//	$$('#list-sortable-widget-3 .widget_elem').each(function(div_el) { sort_order = sort_order +  div_el.get('alt')  + '|'; });

				//$('sort_order').value = sort_order;
				//alert(sort_order);
				widget_change_sort(sort_order);

				//show_dashboard_grid(0);

			}
			
		});//.detach();		
	
	
	
	$$('.widget_title_bar').each(function(el) { el.setStyle('cursor', 'move'); });
	
	}
	
	return true;
}

/*
function activate_widget_sortable(flag_force_detach)
{
	if( flag_force_detach == 1 || $('eqp_is_widget_sortable').value == '1'  )
	{
		sortableList.detach();
		$$('.widget_title_bar').each(function(el) { el.setStyle('cursor', 'auto'); });
		$('eqp_is_widget_sortable').value = '0';
		$('eqp_img_move_widget').src = '/module/image/general/move-no.gif';
		$('eqp_img_move_widget').setStyle('border-color', '#E9EEEE'); 
		$('eqp_img_move_widget').setStyle('background-color', '#E9EEEE'); 
	}
	else
	{
		sortableList.attach();
		$$('.widget_title_bar').each(function(el) { el.setStyle('cursor', 'move'); });
		$('eqp_is_widget_sortable').value = '1';
		$('eqp_img_move_widget').src = '/module/image/general/move.gif';
		$('eqp_img_move_widget').setStyle('border-color', 'silver'); 
		$('eqp_img_move_widget').setStyle('background-color', '#CDEB8B'); 
	}
}
*/

function widget_change_sort(sorted_id_list)
{
	// sorted_id_list ====> liste des "id_access_widget" dans leur nouvel ordre
	// ---> separés par "|" (pour separer les différentes colonnes de la page)
	// ---> et séparé par "." (pour séparer les widgets d'une colonne donnée)
	
	// /!\ ATTENTION: NE PAS utiliser encodeURIComponent sur la chaine "sorted_id_list" : 
	// car un caractère special s'insère lors du décodage (urldecode) par PHP dans "action_widget.php"
	// ( générant des erreurs lors des MàJ de la position des widget ).
	
	var str_request = '?todo=change_sort&id_list=' + sorted_id_list;
	//prompt('', str_request);
	call_ajax_action( 'actions_widget.php' + str_request , call_ajax_post_widget_change_sort, 0 );
		
}


function call_ajax_post_widget_change_sort(res_action, args)
{
	return false;
}




function display_widget(code_widget, div_id, display_mode, args_widget )
{
	
	var str_request = '?todo=' + display_mode +  
					  '&code_widget=' + code_widget + 
					  '&args_widget=' + args_widget;
				
	//prompt('', str_request);
	call_ajax_page( 'get_widget.php' + str_request , div_id, call_ajax_post_widget );
	
}

function display_widget_byidaccess(id_access_widget, div_id, display_mode, args_widget )
{
	
	var str_request = '?todo=' + display_mode +  
					  '&id_access_widget=' + id_access_widget;
				
	//prompt('', str_request);
	call_ajax_page( 'get_widget.php' + str_request , div_id, call_ajax_post_widget );
	
}

function call_ajax_post_widget()
{
	// -- //
	$('eqp_nbr_user_widget_ready').value =  parseInt( $('eqp_nbr_user_widget_ready').value, 10 ) + 1;
	initialize_widget_sortable();
	//activate_widget_sortable(1);
		
	refresh_tips();

	initialize_eqp_widget_actions();
				
	return false;
}


/*
var dashboard_grid = 0
function show_dashboard_grid(force_show)
{
	// force_show == 1 en cas de drag d'un widget => on fait apparaitre les zones libres
	
	if( dashboard_grid == 0 || force_show == 1 )
	{
		$$('.eqp_widget_free').each(function(el) {
										el.setStyles({'border':'0px solid white'});
										el.innerHTML = '';
										
									});
	
		dashboard_grid = 1;
		
	}
	else
	{
		$$('.eqp_widget_free').each(function(el) {
										el.setStyles({'border':'0px solid white'});
										el.innerHTML = '';
									});	
		dashboard_grid = 0;
	}
}
*/

function dashboard_create_widget(id_access_widget, id_widget)
{
	var first_free_element = 0;
	
	var nb_elem_col = new Array();

		
	$$('.nbr_widget_per_col').each(function(el) {
	
			num_col_cur = el.get('rel');
			nb_elem_col[num_col_cur] = el.value;
		
	});
					

	
	var num_col_min_nbr = 1;
	var val_col_min_nbr = $('nbr_widget_col_1').value;
	for (elem_num_col in nb_elem_col)
	{
	//alert(elem_num_col+'-'+nb_elem_col[elem_num_col]);
		if( nb_elem_col[elem_num_col] < val_col_min_nbr )
		{
		
			num_col_min_nbr = elem_num_col;
			val_col_min_nbr = nb_elem_col[elem_num_col];
		}
	}
	
	//alert(nb_elem_col);
	//return false;
	var num_order_found = ''+(parseInt(val_col_min_nbr, 10) + 1);
	//alert(num_order_found);
	var div_col_container = $('list-sortable-widget-'+num_col_min_nbr);

	var newdiv=document.createElement("div");
	newdiv = new Element( newdiv ); // pour compatibilité IE 8+ mootools non chargé (probleme de synchro)
	newdiv.set('id', 'content_widget_'+id_access_widget);
	newdiv.set('rel', num_order_found);
	newdiv.set('alt', id_access_widget);

	newdiv.addClass("eqp_widget");
	newdiv.addClass("dragable");
	newdiv.addClass("widget_elem");
	
	newdiv.setStyle("min-height", '150px');
	newdiv.setStyle("_height", '150px');

	div_col_container.appendChild(newdiv);
	
	$('nbr_widget_col_' + num_col_min_nbr ).value = parseInt( $('nbr_widget_col_' + num_col_min_nbr ).value, 10 ) + 1;
	
	$('eqp_nbr_user_widget').value 				=  parseInt( $('eqp_nbr_user_widget').value, 10 ) + 1;
	 	
	
	display_widget_byidaccess(id_access_widget, 'content_widget_'+id_access_widget, 'view', '' );	
	
	/*
		if( first_free_element == 0 )
		{
			el.setStyles({'border':'1px solid silver'});
			el.setStyles({'border-top':'1px solid white'});
			
			el.removeClass('eqp_widget_free');
			el.addClass('eqp_widget');
			el.addClass('dragable');

			el.set('alt', id_access_widget);		
			var num_order_cur = el.get('rel');
			
			el.innerHTML = '&nbsp;';
		
			display_widget_byidaccess(id_access_widget, 'content_widget_'+num_order_cur, 'view', '' );
					
			first_free_element = 1;
		}
	*/
}

function dashboard_add_widget()
{
	var id_widget = $('select_add_widget').value;
	if(	id_widget != '' && id_widget != 0 )
	{ 
		var str_request = '?todo=add_widget&id_widget=' + id_widget;
		//prompt('', str_request);
		call_ajax_action( 'actions_widget.php' + str_request , call_ajax_post_widget_add_widget, id_widget );
		
		$('select_add_widget').value = '';	
	}
	else
	{
		alert('Please, select a widget in the list.');
	}
	return false;
}

function call_ajax_post_widget_add_widget(res_action, id_widget)
{
	if( res_action != 0 )
	{
		// res_action correspond au id_acess_widget
		dashboard_create_widget(res_action, id_widget);
	}
	
	return false;
}

function dashboard_remove_widget(id_access_widget) /*, num_col, num_order) */
{

	if(	id_access_widget != '' && id_access_widget != 0 )
	{ 
		if( confirm('This widget will be removed from your Dashboard.\nAre you sure to do this?') )
		{
			var str_request = '?todo=remove_widget&id_access_widget=' + id_access_widget;
			//prompt('', str_request);
			var tab_args = new Array();
			tab_args['id_access_widget'] = id_access_widget;
			//tab_args['num_col'] = num_col;
			//tab_args['num_order'] = num_order;			
			call_ajax_action( 'actions_widget.php' + str_request , call_ajax_post_widget_remove_widget, tab_args );
		}
	}
	return false;
}

function call_ajax_post_widget_remove_widget(res_action, tab_args)
{
	if( res_action != 0 )
	{
	//alert('list-sortable-widget-'+tab_args['num_col']);
	//alert('content_widget_' + tab_args['num_col'] + '-' + tab_args['num_order'] );
	//alert('nbr_widget_col_' + tab_args['num_col']);
	
		//var el_container = document.body; //$('list-sortable-widget-'+tab_args['num_col']);
		var el = $('content_widget_' + tab_args['id_access_widget'] );
		// alert('content_widget_' + tab_args['id_access_widget'] );
		var el_container = el.parentNode;
		el_container.removeChild(el);
		
		el_container = new Element( el_container ); // pour compatibilité IE 8+ mootools non chargé (probleme de synchro)
		var num_col_cur = el_container.get('alt');

		$('nbr_widget_col_' + num_col_cur ).value = parseInt( $('nbr_widget_col_' + num_col_cur ).value, 10 ) - 1;
		
		$('eqp_nbr_user_widget').value 				=  parseInt( $('eqp_nbr_user_widget').value, 10 ) - 1;
		$('eqp_nbr_user_widget_ready').value 		=  parseInt( $('eqp_nbr_user_widget_ready').value, 10 ) - 1;
		 
		 
		/* 
		el.removeClass('eqp_widget');
		el.removeClass('dragable');
		
		el.addClass('eqp_widget_free');

		el.set('alt', '');		
		
		el.innerHTML = '&nbsp;';	
		*/
		
		//show_dashboard_grid(1);	
	}
	
	return false;
}


function dashboard_popup_widget(id_access_widget)
{
	if( parseInt(id_access_widget, 10) != 0 )
	{
		// timestamp utilisé pour rendre le nom de pop-up toujours unique
		// => chaque clic sur le bouton 'pop-up' créera donc toujours une nouvelle pop-up
		timestamp_nbr = new Date().getTime();
	
		window.open ('ajax/php/get_widget.php?todo=view&popup=1&id_access_widget='+id_access_widget, 'popup_widget_'+id_access_widget+'_'+timestamp_nbr, config='height=230, width=320, toolbar=no, menubar=no, scrollbars=yes, resizable=yes, location=no, directories=no, status=no');

	}	
}


function dashboard_showhide_params_widget(id_access_widget)
{
	if( parseInt(id_access_widget, 10) != 0 )
	{
	
		//$('params_widget_'+id_access_widget).

	}	
}


function display_dropdown_list( list_name, id_result_container )
{
	var str_request = '?todo=list_' + list_name;
				
	//prompt('', str_request);
	call_ajax_page( 'get_dropdown_list.php' + str_request , id_result_container, 0 );
		
}



function eqp_change_style_background(str_color)
{
	var el = document.body; //$('body');
	el.setStyle('background-color', "#" + str_color );
	

		
	return false;
}

function showhide_criteria_more()
{
	if( $('tr_criteria_more').style.display == 'none' )
	{
		$('tr_criteria_more').style.display = ''; 
		$('img_plusminus_criteria_more').src="/module/image/legacy/b_minus.png";
	}
	else
	{
		$('tr_criteria_more').style.display = 'none'; 	
		$('img_plusminus_criteria_more').src="/module/image/legacy/b_plus.png";
	}
}


function switch_profile_right( id_profile, id_right )
{
	var name_input_right 	= 'val_right_'+id_profile+'_'+id_right;
	var name_chk_right 		= 'img_chk_right_'+id_profile+'_'+id_right;
	if( $(name_input_right).value > 0 )
	{
		$(name_input_right).value = 0;
		$(name_chk_right).src = '/module/image/legacy/checkbox-unchecked.gif';
	}
	else
	{
		$(name_input_right).value = id_right;
		$(name_chk_right).src = '/module/image/legacy/checkbox-checked.gif';
	}
	
	return false;
}

/*
 *  gere le comportement des cases à cocher du Deployment Status
 *  dans les Criteria de Recherche 
 */
function change_status_deployment( input_check_all )
{
	if( input_check_all == 1 )
	{
		if( !$('status_deployment_all').checked )
		{
			$('status_deployment_all').set( 'checked', true );
		}
		
		$$( '.status_deployment_checkbox' ).each( function( el ) {
			el.set('checked', false );
		});
	}
	else
	{
		$('status_deployment_all').set( 'checked', false );
	
		var nbr_unchecked = 0;
		$$( '.status_deployment_checkbox' ).each( function( el ) {
			if( !el.checked )
			{
				nbr_unchecked++;
			}
		});
		
		if( nbr_unchecked == 0 )
		{
			$('status_deployment_all').set( 'checked', true );
			
			$$( '.status_deployment_checkbox' ).each( function( el ) {
				el.set('checked', false );
			});
		} 
	}
}


/*
 *  gere le comportement des cases à cocher du Monitoring Status
 *  dans les Criteria de Recherche 
 */
function change_status_monitoring( input_check_all )
{
	if( input_check_all == 1 )
	{
		if( !$('status_monitoring_all').checked )
		{
			$('status_monitoring_all').set( 'checked', true );
		}
		
		$$( '.status_monitoring_checkbox' ).each( function( el ) {
			el.set('checked', false );
		});
	}
	else
	{
		$('status_monitoring_all').set( 'checked', false );
	
		var nbr_unchecked = 0;
		$$( '.status_monitoring_checkbox' ).each( function( el ) {
			if( !el.checked )
			{
				nbr_unchecked++;
			}
		});
		
		if( nbr_unchecked == 0 )
		{
			$('status_monitoring_all').set( 'checked', true );
			
			$$( '.status_monitoring_checkbox' ).each( function( el ) {
				el.set('checked', false );
			});
		} 
	}
}


function refresh_tips()
{

     $$( '.tips' ).each( function( el ) {

                 el.addEvents({

                            mouseover: function( e ) {

                                        if( !this.saved_title ) {

                                                    this.saved_title = this.title;

                                        }

                                        this.title = '';

                                        this.style.cursor = 'pointer';

                                        popupOutline( this.saved_title );

                            },

                            mouseout: function( e ) { nd(); }

                 });

     });

}


function add_manual_eqp_log(id_eqp_cur, id_txt_manual_log)
{
	var str_txt_manual_log = $(id_txt_manual_log).value;
	if( str_txt_manual_log == '' )
	{
		alert('Please, enter a Manual Log.');
		$(id_txt_manual_log).focus();
		
		return false;
	}
	
		
	if( confirm('Are you sure to post this manual log?' ) )
	{
	
		var str_request = '?todo=manual_log&id_eqp='+id_eqp_cur+'&txt_manual_log='+str_txt_manual_log; 
		//prompt('', 'actions_equipment_card.php' + str_request );
		call_ajax_action( 'actions_equipment_card.php' + str_request , callback_add_manual_eqp_log, id_eqp_cur );
	}
}

function callback_add_manual_eqp_log(res_action, id_eqp)
{
	if( res_action == 1 )
	{
		//alert('Manual Log saved.');
		switchTabCard('logs', 'edit');
	}
	else
	{
		alert('Error while creating Manual Log for this equipment.');
	}
	return false;
}

/*
 * Equipment Search - composant d'autocomplete 
 * Si le texte passé en paramètre est bien celui présent dans le controle input
 * alors : suppression de ce texte  
 */
function eqp_search_check_erase( idSearchAutoComplete, txtToCheck )
{
	if( $(idSearchAutoComplete).value == txtToCheck )
	{
		$(idSearchAutoComplete).value = '';
	}
}

/*
 *
 */
function eqp_search_erase_field(idSearchAutoComplete, idListResult)
{
	$(idSearchAutoComplete).value = '';
	$(idListResult).style.display = 'none';
}



// DASHBOARD - AUTO SUGGEST EQUIPMENTS NAME --> RETURN EQP ID 
function dashboard_suggest_equipment(searched_val, num_page, id_list_result )
{
	if( searched_val.length < 3 )
	{
		$(id_list_result).style.display = 'none';
		return false;
	}
	
	$(id_list_result).style.display = '';

	var str_request = '?todo=list_dashboard&flag_like_left=1&id_list_result='+ id_list_result +'&page='+num_page+'&name_eqp=' + searched_val;
	//prompt('', str_request);

	$('dashboard_eqp_autocomplete').style.backgroundImage = "url('/module/image/legacy/spinner.gif')";
	//document.getElementById(id_list_result).innerHTML = '<img src="/module/image/legacy/spinner.gif" title="Loading" alt="Loading" style="vertical-align:middle;" />&nbsp;&nbsp;<span style="vertical-align:middle;font-weight:normal;"><small><em>Loading...</em></small></font>';
		
	var url = '/module/it_equipment/ajax/php/suggest_equipments.php' + str_request ;
	//prompt( '', url );
	
	// APPEL DE LA PAGE EN ASYNCHRONE !!! IMPORTANT !!! // 
	var ajaxRequest = new Request( {	'url': url,
  										method: 'get',
  										async:	true, 
  										encoding: 'iso-8859-1',
  										onComplete: function( request, requestXML ) {
  										getBackAjaxContent( request, id_list_result, call_ajax_post_dashboard_suggest_equipment );
  										} } ).send( ); 					
  	return true;	

}

function call_ajax_post_dashboard_suggest_equipment()
{
	$('dashboard_eqp_autocomplete').style.backgroundImage = "url('/module/image/equipments/network_16.gif')";
	return false;
}


function dashboard_select_suggestion( id_suggestion, id_list_result ) 
{
	$('dashboard_eqp_autocomplete_id').value = $('id_eqp_found_' + id_suggestion).value;
	$('dashboard_eqp_autocomplete').value 	= $('name_eqp_found_' + id_suggestion).value;
	
	$(id_list_result).style.display = 'none';

	open_popup_eqp_card($('id_eqp_found_' + id_suggestion).value);
		
	return false;
}

function dashboard_select_dropdown_item( id_item, id_list_result ) 
{
	$(id_list_result).style.display = 'none';

	open_popup_eqp_card(id_item);
		
	return false;
}

function dashboard_suggestion_change_page(num_page)
{
	var valSearched = $('dashboard_eqp_autocomplete').value;
	
	dashboard_suggest_equipment(valSearched, num_page, 'list_suggestions');
	
	return false;
}

/*
 * Change un/des argument(s) d'un widget affiché sur le dashboard d'un Utilisateur précis.
 */
function dashboard_change_widget_args(id_access_widget, is_popup, str_args)
{
	// TODO: prendre en compte le mode popup 

	var str_request = '?todo=update_args&id_access_widget='+id_access_widget+''+str_args; 
	//prompt('', 'actions_widget.php' + str_request );
	
	var tab_args = new Array();
	tab_args['id_access_widget'] = id_access_widget;
	tab_args['is_popup'] = is_popup;
	
	call_ajax_action( 'actions_widget.php' + str_request , callback_actions_widget, tab_args );	
	
	return false;
}


function callback_actions_widget(res_action, tab_args)
{
	if( res_action == 1 )
	{
		// update successfull
		var id_access_widget_cur = tab_args['id_access_widget'];
		if( id_access_widget_cur != 0 )
		{
			if( tab_args['is_popup'] == '1' )
			{
				// TODO: prendre en compte le mode popup == sans Ajax dans cette fonction  
			}
			else
			{
				display_widget_byidaccess(id_access_widget_cur, 'content_widget_'+id_access_widget_cur, 'view', '' );
			}
		}
	}
	else
	{
		alert('Error updating widget.');
	}
	return false;
}


/*
 * ajout de contacts IT pour un Equipement donné
 */
function add_eqp_contact()
{
	var ret = false;
	var nbr_selected_eqp_contact = 0;
	
	var id_eqp_contact_add = $('id_eqp_contact').value;

	if( id_eqp_contact_add != 0 && id_eqp_contact_add != '' )
	{  
		ret = true; 
		
		$$( '.selected_eqp_contact' ).each( function( el ) 
		{
			nbr_selected_eqp_contact++;
			
			if( el.value == id_eqp_contact_add )
			{
				ret = false;
			}	
		});
		
		if( !ret )
		{
			alert('This user has been already added.');
			return ret;
		}
	}
	else
	{
		alert('Please, choose a valid Perenco User.');
		return false;
	}
	
	if( ret )
	{
		// ajout du User dans la Liste
		if( nbr_selected_eqp_contact == 0 )
		{
			$('div_eqp_contact_container').innerHTML = '';
		}
		
		var str_content_new_contact = '<div id="div_eqp_contact_'+id_eqp_contact_add+'" style="float:left;padding-right:3px;">'
									+ $('name_eqp_contact').value 
									+ '<img src="/module/image/shadowless/cross-script.png" title="Remove this contact" class="tips" style="vertical-align:middle;cursor:pointer;"  onclick="remove_eqp_contact('+id_eqp_contact_add+');return false;" />'
									+ '<input type="hidden" id="eqp_id_contact_'+id_eqp_contact_add+'" class="selected_eqp_contact" value="'+id_eqp_contact_add+'" />'
									+ '</div>';   		
													
		$('div_eqp_contact_container').innerHTML += str_content_new_contact;
		
		$('name_eqp_contact').value = '';
		$('id_eqp_contact').value 	= '0';
		
	}

	return ret;
}

/*
 * suppression de contacts IT pour un Equipement donné
 * (suppression javascript: pas effective de suite si la fiche n'est pas sauvegardée ensuite)	
 */
function remove_eqp_contact(id_eqp_contact)
{
	if( id_eqp_contact != 0 && confirm('This contact will be removed. Are you sure?') )
	{
		var el = $('div_eqp_contact_' + id_eqp_contact);
		var el_container = el.parentNode; // $('div_eqp_contact_container')
		el_container.removeChild(el);		
	}
	
	return false;
}


/*
 * affiche / cache le panneau des Contacts de Notification pour un Service/Software
 */
function show_hide_soft_notif_contacts(id_eqp_soft)
{
	if( $('list_notif_contacts_'+id_eqp_soft).style.display == 'none' )
	{
		$('list_notif_contacts_'+id_eqp_soft).style.display = '';
		$('img_list_notif_contacts_'+id_eqp_soft).src = '/module/image/shadowless/chevron-small.png';
	}
	else
	{
		$('list_notif_contacts_'+id_eqp_soft).style.display = 'none';
		$('img_list_notif_contacts_'+id_eqp_soft).src = '/module/image/shadowless/chevron-small-expand.png';	
	}

	return false;
}


/*
 * affiche la fenetre de selection / ajout de Softwares
 */ 
function display_select_software( id_input_retour )
{
	// initialisation de la Modal Box // 
    SqueezeBox.initialize({
        size: {x: 450, y: 380}, 
		sizeLoading: {x: 450, y: 380}, 
		overlayOpacity: 0.5
    });
	// // // // // // // // // // // //

	var str_request = '?todo=main'+
					  '&id_input_back='+id_input_retour;
	
	//prompt('', str_request);
 	SqueezeBox.open( '/module/it_equipment/ajax/php/select_software.php' + str_request ); //, {handler: 'iframe'} );  
 
  //id_input_retour).value 
  return false;
}

/*
 * Déselection et RESET d'un choix de software software
 */
function reset_select_software( div_name_software, id_input_retour)
{
	$(div_name_software).innerHTML = 'no software associated';
	$(id_input_retour).value = '0';
}


/*
 * appel de la recherche des software en cas de recherche par nom (onChange sur le input)
 */ 
function check_input_search_software()
{
	var str_searched = $('txt_search_software_name').value;
	var str_search_field_init =  $('txt_search_software_name_init').value; 
	
	//if( str_searched != str_search_field_init ) //&& str_searched.length >= 3 )
	//{
		call_search_software('list', 0);
	//}
	
	return true;
}


/*
 * affiche / cache le texte initial de l'input de Recherche des Software  
 */
function first_type_input_search_software()
{
	if( $('txt_search_software_name').value == $('txt_search_software_name_init').value )
	{
		$('txt_search_software_name').value = '';
	}
	else if( $('txt_search_software_name').value == '' )
	{
		$('txt_search_software_name').value = $('txt_search_software_name_init').value;
		//call_search_software('list');
	}
}	

/*
 * affiche la liste des Softwares (suivant les criteria)
 */ 
function call_search_software( display_mode, num_page )
{
	var div_id 			 =	$('str_dest_div_id').value; 
	var id_input_back 	 =	$('str_dest_id_input_back').value; 
	var str_search_field =  $('txt_search_software_name').value; 
	var str_search_field_init =  $('txt_search_software_name_init').value; 
	
	var str_request = '?todo=' + display_mode 
					+ '&id_input_back=' + id_input_back 	
					+ '&page=' + num_page
					
	if( str_search_field != '' && str_search_field != str_search_field_init )
	{
		str_request += '&name_soft=' + str_search_field;
	}
	
	//prompt('', str_request);
	call_ajax_page( 'select_software.php' + str_request , div_id, call_ajax_post_search_software );	
}

function call_ajax_post_search_software()
{
	refresh_tips();
	
	return false;
}


/*
 * selection d'un Software dans le popup de selection et report du choix dans la Page Parente
 */
function action_search_software_select(id_software_sel, name_software_sel)
{
	if( id_software_sel != '' && id_software_sel != 0 )
	{
		var strInputBack = 'edit_eqp_soft_id_soft_' + $('str_dest_id_input_back').value;
		var oInputBack = $(strInputBack);
		var strLabelDivBack = 'div_eqp_soft_name_soft_' + $('str_dest_id_input_back').value;
		var oLabelDivBack = $(strLabelDivBack);		
		
		oInputBack.value = id_software_sel;
		oLabelDivBack.innerHTML = name_software_sel;
		
		SqueezeBox.close();
	
	} 
	return false;
} 

/*
 * affichage de la DIV d'ajout d'un Nouveau Software
 */
function search_software_show_add_new()
{
	if( $('div_search_add_software').style.display == 'none' ) 
	{
		 $('div_search_add_software').style.display = '';
		 $('btn_search_add_software').style.display = 'none';
	}
	else
	{
		 $('div_search_add_software').style.display = 'none';
		 $('btn_search_add_software').style.display = '';
	}
	
	return false;
} 

/*
 * action d'enregistrement du Nouveau Software entré
 */
function action_search_software_add_new()
{
	// checks + construction des parametres ajax
	if( $('txt_search_software_add_name').value == '' )
	{
		alert('Please, enter a soft name.');
		return false;
	}
		
	str_request = '?todo=add_soft' +
				  '&name_soft=' + encodeURIComponent( $('txt_search_software_add_name').value );

	if( $('select_search_software_add_provider').value != '' )
	{
		str_request += '&id_provider='+$('select_search_software_add_provider').value;
	}	
	
	// ajax action 
	//prompt('','actions_software.php' + str_request );
	call_ajax_action( 'actions_software.php' + str_request , callback_actions_search_software_add_new, 0 );	
	
	return false;
}



function callback_actions_search_software_add_new(res_action, args)
{
	if( res_action == 1 )
	{
		search_software_show_add_new();
	
		//		ajout du nouveau Soft dans le champs de recherche 
		// + 	appel de la recherche avec ce nouveau nom (afin de facilité la selection immédiate)
		$('txt_search_software_name').value = $('txt_search_software_add_name').value;
		
		$('txt_search_software_add_name').value = '';
		$('select_search_software_add_provider').value = '';
		
		call_search_software('list', 0);
	}
	return false;
}



/*
 * affiche la fenetre de selection / ajout des ALIAS 
 */ 
function display_select_alias()
{
	// initialisation de la Modal Box // 
    SqueezeBox.initialize({
        size: {x: 450, y: 340}, 
		sizeLoading: {x: 450, y: 340}, 
		overlayOpacity: 0.5
    });
	// // // // // // // // // // // //

	var str_request = '?todo=main';
	
	//prompt('', str_request);
 	SqueezeBox.open( '/module/it_equipment/ajax/php/select_alias.php' + str_request, {size: {x: 450, y: 340}}); //, {handler: 'iframe'} );  
 
  return false;
}


/*
 * affiche la liste des Alias (suivant les criteria)
 */ 
function call_search_alias( display_mode, num_page )
{
	var div_id 			 =	$('str_dest_div_id').value; 
	var str_search_field =  $('txt_search_alias_name').value; 
	var str_search_field_init =  $('txt_search_alias_name_init').value; 
	
	var str_request = '?todo=' + display_mode 
					+ '&page=' + num_page
					
	if( str_search_field != '' && str_search_field != str_search_field_init )
	{
		str_request += '&name_alias=' + str_search_field;
	}
	
	//prompt('', str_request);
	call_ajax_page( 'select_alias.php' + str_request , div_id, call_ajax_post_search_software );	
}

function call_ajax_post_search_alias()
{
	refresh_tips();
	
	return false;
}


/*
 * ajout de l'alias sélectionné dans la fiche de l'equipement
 */
function action_search_alias_select( id_alias_sel, name_alias_sel )
{
	if( id_alias_sel != '' && id_alias_sel != 0 )
	{
		if( document.getElementById('div_item_eqp_card_alias_'+id_alias_sel) )
		{
			alert('This Alias is already linked to this equipment.');
			return false;
		}
		else
		{
			var str_new_alias_item =  '<div id="div_item_eqp_card_alias_'+id_alias_sel+'" class="item_eqp_alias_edit">' 
									+ '<input type="hidden" class="input_eqp_alias_id_assoc" value="0" />' 
									+ '<input type="hidden" class="input_eqp_alias_id_new_link" value="'+id_alias_sel+'" />' 
									+ name_alias_sel +'&nbsp;<img src="/module/image/shadowless/cross-script.png" title="Unlink this alias" class="tips img-vertical-middle" onclick="remove_eqp_alias('+id_alias_sel+');return false;" />'							
									+ '</div>';
	
			
			
			$('div_list_eqp_card_alias').innerHTML += str_new_alias_item;
			
			SqueezeBox.close();
		}
	} 
	return false;	
}

function remove_eqp_alias(id_alias_sel)
{
	if( id_alias_sel != 0 )
	{
		var el = $('div_item_eqp_card_alias_'+id_alias_sel);
		var el_container = el.parentNode; // $('div_eqp_contact_container')
		el_container.removeChild(el);		
	}
	
	return false;
}



/*
 * appel de la recherche des alias en cas de recherche par nom (onChange sur le input)
 */ 
function check_input_search_alias()
{
	var str_searched = $('txt_search_alias_name').value;
	var str_search_field_init =  $('txt_search_alias_name_init').value; 
	
	//if( str_searched != str_search_field_init ) //&& str_searched.length >= 3 )
	//{
		call_search_alias('list', 0);
	//}
	
	return true;
}


/*
 * affiche / cache le texte initial de l'input de Recherche des Alias  
 */
function first_type_input_search_alias()
{
	if( $('txt_search_alias_name').value == $('txt_search_alias_name_init').value )
	{
		$('txt_search_alias_name').value = '';
	}
	else if( $('txt_search_alias_name').value == '' )
	{
		$('txt_search_alias_name').value = $('txt_search_alias_name_init').value;
		//call_search_software('list');
	}
}	

/*
 * affichage de la DIV d'ajout d'un Nouveau Alias
 */
function search_alias_show_add_new()
{
	if( $('div_search_add_alias').style.display == 'none' ) 
	{
		 $('div_search_add_alias').style.display = '';
		 $('btn_search_add_alias').style.display = 'none';
	}
	else
	{
		 $('div_search_add_alias').style.display = 'none';
		 $('btn_search_add_alias').style.display = '';
	}
	
	return false;
} 

/*
 * action d'enregistrement du Nouveau Alias entré
 */
function action_search_alias_add_new()
{
	// checks + construction des parametres ajax
	if( $('txt_search_alias_add_name').value == '' )
	{
		alert('Please, enter an alias name.');
		return false;
	}
		
	str_request = '?todo=add_alias' +
				  '&name_alias=' + encodeURIComponent( $('txt_search_alias_add_name').value );

	
	// ajax action 
	//prompt('','actions_software.php' + str_request );
	call_ajax_action( 'actions_alias.php' + str_request , callback_actions_search_alias_add_new, 0 );	
	
	return false;
}



function callback_actions_search_alias_add_new(res_action, args)
{
	if( res_action == 1 )
	{
		search_alias_show_add_new();
	
		//		ajout du nouveau Soft dans le champs de recherche 
		// + 	appel de la recherche avec ce nouveau nom (afin de facilité la selection immédiate)
		$('txt_search_alias_name').value = $('txt_search_alias_add_name').value;
		
		$('txt_search_alias_add_name').value = '';
		
		call_search_alias('list', 0);
	}
	return false;
}



/*
 * affiche la fenetre de view/edit des Procedures 
 */ 
function display_procedure(id_eqp_proc, id_eqp, mode_display, target_display)
{
	// initialisation de la Modal Box // 
    /*
    SqueezeBox.initialize({
        size: {x: 550, y: 440}, 
		sizeLoading: {x: 550, y: 440}, 
		overlayOpacity: 0.5
    });
	// // // // // // // // // // // //
	var str_request = '?todo='+ mode_display 
					+ '&id_eqp_proc='+id_eqp_proc;
	
	//prompt('', str_request);
 	SqueezeBox.open( '/module/it_equipment/ajax/php/display_procedure.php' + str_request ); //, {handler: 'iframe'} );  
 	*/
 	
	var str_request = '/module/it_equipment/ajax/php/display_procedure.php?todo='+ mode_display 
					+ '&id_eqp_proc='+id_eqp_proc + '&id_eqp='+id_eqp;
					
 	if( target_display == 'popup' )
 	{
 		window.open(str_request, 'popup_procedure_'+id_eqp_proc, config='height=440, width=440, toolbar=no, menubar=no, scrollbars=yes, resizable=yes, location=no, directories=no, status=no');
 	}
 	else
 	{
 		// case 'self'
 		window.location.href  = str_request;
 	}
 	
 	

  return false;
}


/*
 * fermeture de la popup de Procedure
 */
function save_procedure(flag_alert)
{
	var continue_save = true;
	if(flag_alert != '')
	{
		if( !confirm(flag_alert) )
		{
			continue_save = false;
		}
	}

	if( continue_save )
	{
		$('form_eqp_procedure_edit').submit();
				
		//$('todo_action_procedure')
		//var str_request = '/module/it_equipment/ajax/php/display_procedure.php?todo=';
		//window.location.href  = str_request;
	}
}

/*
 * fermeture de la popup de Procedure
 */
function close_popup_procedure(flag_alert)
{
	var rep_close = true;
	if(flag_alert != '')
	{
		if( !confirm(flag_alert) )
		{
			rep_close = false;
		}
	}
	
	if( rep_close )
	{
		window.close();
	}
}


/*
 * suppression de la procedure
 */

function delete_procedure(id_eqp_proc_del, flag_close_popup, str_msg)
{
	if( confirm(str_msg) )
	{
		// Ajax mode with "tab" refresh after deletion 
		var str_request = '?todo=delete&id_eqp_proc='+id_eqp_proc_del;
		call_ajax_action( 'actions_procedure.php' + str_request , callback_actions_delete_procedure, flag_close_popup );
		
	}
}



function callback_actions_delete_procedure(res_action, flag_close_popup)
{
	if( res_action == 1 )
	{
		if( flag_close_popup == 1 )
		{
			close_popup_procedure('');
		}
		
		// reload de l'onglet "Procedures"
		//$('todo_value')
		//alert(opener.todo_value.value);
		//var todo_opener_val = window.opener.todo_value.value;
		if( flag_close_popup == 2 )
		{
			switchTabCard('procedures', 'edit');
		}
		else
		{
			if( window.opener.document.getElementById("opened_tab_procedures") &&  window.opener.document.getElementById("opened_tab_procedures").value == 1 )
			{
				window.opener.switchTabCard('procedures', 'edit');
			}
		}
		//opener.switchTabCard('procedures', 'edit');
		
	}
	else
	{
		alert('An Error occured while deleting this procedure.');
		return false;
	}
}

/*
 * affiche la fenetre d'edition d'un Running SERVICE - d'une association software/equipments
 */
function display_service(id_eqp_soft, id_eqp, mode_display)
{
	var str_request = '/module/it_equipment/ajax/php/display_service.php?todo='+ mode_display  
					+ '&id_eqp_soft='+id_eqp_soft + '&id_eqp='+id_eqp;

 	window.open(str_request, 'popup_service_soft_'+id_eqp_soft, config='height=440, width=500, toolbar=no, menubar=no, scrollbars=yes, resizable=yes, location=no, directories=no, status=no');
}



/*
 * SAUVEGARDE DES DONNEES d'edition de la popup des Running Services 
 */
function save_service(flag_alert)
{
	var continue_save = true;
	if(flag_alert != '')
	{
		if( !confirm(flag_alert) )
		{
			continue_save = false;
		}
	}

	if( continue_save )
	{
		if( $('service_label_soft').value == '' )
		{
			alert('Please, enter a Service name.');
			return false;
		}
		
		$('form_eqp_service_edit').submit();
				
		//var str_request = '/module/it_equipment/ajax/php/display_service.php?todo=';
		//window.location.href  = str_request;
	}
}


/*
 * fermeture de la popup des Running Services
 */
function close_popup_service(flag_alert)
{
	var rep_close = true;
	if(flag_alert != '')
	{
		if( !confirm(flag_alert) )
		{
			rep_close = false;
		}
	}
	
	if( rep_close )
	{
		window.close();
	}
}


/*
 * suppression du Running Service
 */

function delete_service(id_eqp_soft_del, flag_close_popup, str_msg)
{
	if( confirm(str_msg) )
	{
		// Ajax mode with "tab" refresh after deletion 
		var str_request = '?todo=delete&id_eqp_soft='+id_eqp_soft_del;
		//prompt('', str_request);
		call_ajax_action( 'actions_service.php' + str_request , callback_actions_delete_service, flag_close_popup );
		
	}
}


function callback_actions_delete_service(res_action, flag_close_popup)
{
	if( res_action == 1 )
	{
		if( flag_close_popup != 0 )
		{
			if( window.opener.document.getElementById("opened_tab_services") &&  window.opener.document.getElementById("opened_tab_services").value == 1 )
			{
				switchTabCard('services', 'edit');
			}		
			
			close_popup_service('');
		}
		else
		{
			switchTabCard('services', 'edit');
		}

	}
	else
	{
		alert('An Error occured while deleting this service.');
		return false;
	}
}



/*
 * suppression en JS d'une ligne de contacts  
 * dans le Pop-Up d'edition d'un Running Service (Software/Equipment) 
 */
function remove_eqp_soft_contact(id_item_contact)
{
	if( id_item_contact != 0 )
	{
		var el = $('item_eqp_soft_notif_contact_'+id_item_contact);
		var el_container = el.parentNode; // $('div_eqp_contact_container')
		el_container.removeChild(el);
		
		// Evite tout ancrage de l'infobulle à la souris 
		// lors de la suppression de l'élément initiateur de l'infobulle  
		nd();
	}
}

/*
 * ajout en JS d'un contact de Notification
 * dans le Pop-Up d'edition d'un Running Service (Software/Equipment)  
 */
function add_eqp_soft_contact()
{
	// ajout du User dans la Liste
	var i_item 				= $('nbr_eqp_soft_item_contacts').value;

	var id_contact_select 	= $('id_user_eqp_soft_notif').value;
	var name_contact_select = $('edit_eqp_name_add_user').value;
	
	
	if( id_contact_select != 0 && id_contact_select != '' )
	{
	
		if( 	i_item == 0 
			|| 	i_item == '' )
		{
			i_item = parseInt( i_item ) + 1; 
			$('div_list_notif_contacts').innerHTML = '';
		}
		
		var i_item_next 		= parseInt( i_item ) + 1;
		var item_already_exist  = false;
		
			$$( '.item_eqp_soft_id_user' ).each( function( el ) 
			{
				if( el.value == id_contact_select )
				{
					item_already_exist = true;
				}	
			});
		
		if( item_already_exist )
		{
			alert('This user has been already selected.');
		}
		else
		{
			var str_content_new_contact = '<div id="item_eqp_soft_notif_contact_'+i_item+'">'
											+ name_contact_select 
											+ '<img src="/module/image/shadowless/cross-script.png" title="Remove this contact" class="tips" style="vertical-align:middle;cursor:pointer;"  onclick="remove_eqp_soft_contact(\''+i_item+'\');return false;" />'
											+ '<input type="hidden" name="service_id_contact[]" class="item_eqp_soft_id_user" value="'+id_contact_select+'" />' 
										+ '</div>';   		
			
			$('div_list_notif_contacts').innerHTML += str_content_new_contact; 
			
			$('nbr_eqp_soft_item_contacts').value = i_item_next;
		}
	}
	else
	{
		alert('Please, search and select one user.');	
	}
	
	$('id_user_eqp_soft_notif').value = '0';
	$('edit_eqp_name_add_user').value = '';
		
}



/*
 * affiche la fenetre d'aide
 */ 
function display_help( help_field_code )
{
	// initialisation de la Modal Box // 
    SqueezeBox.initialize({
        size: {x: 450, y: 300}, 
		sizeLoading: {x: 450, y: 300}, 
		overlayOpacity: 0.5
    });
	// // // // // // // // // // // //

	var str_request =   '?todo=view'  
					  + '&help_field_code='+help_field_code;
	
	//prompt('', str_request);
 	SqueezeBox.open( '/module/it_equipment/ajax/php/display_help.php' + str_request, { size: {x: 450, y: 300}} ); //, {handler: 'iframe'} );  
 
  //id_input_retour).value 
  return false;
}

/*
 * close la fenetre d'aide
 */ 
function close_help()
{
 	SqueezeBox.close();  
}


/*
 * affiche la fenetre d'aide des LOCATIONS 
 */ 
function display_location_reference()
{
	// initialisation de la Modal Box // 
    SqueezeBox.initialize({
        size: {x: 550, y: 450}, 
		sizeLoading: {x: 550, y: 450}, 
		overlayOpacity: 0.5
    });
	// // // // // // // // // // // //

	var str_request =   '?todo=view';
	
	//prompt('', str_request);
 	SqueezeBox.open( '/module/it_equipment/ajax/php/display_location_reference.php' + str_request ,{ size: {x: 550, y: 450}}); //, {handler: 'iframe'} );  
 
  //id_input_retour).value 
  return false;
}


/*
 * affiche la fenetre d'affichage des Erreurs Monitoring 
 */ 
function display_monitoring_popup(id_eqp_cur,name_eqp_cur)
{
	// initialisation de la Modal Box // 
    SqueezeBox.initialize({
        size: {x: 550, y: 450}, 
		sizeLoading: {x: 550, y: 450}, 
		overlayOpacity: 0.5
    });
	// // // // // // // // // // // //

	var str_request =   '?todo=view&id_eqp='+id_eqp_cur+'&name_eqp='+name_eqp_cur;
	
	//prompt('', str_request);
 	SqueezeBox.open( '/module/it_equipment/ajax/php/display_monitoring_data.php' + str_request ,{ size: {x: 550, y: 450}}); //, {handler: 'iframe'} );  
 
  //id_input_retour).value 
  return false;
}


/*
 * affiche la fenetre d'affichage des Erreurs Monitoring ayant fait l'objet d'ACTIONS 
 * pour les IN PROGRESS et les FIXED 
 */ 
function display_monitoring_action_popup(type_view,id_eqp_cur,id_mon_action_cur,name_eqp_cur)
{
	// initialisation de la Modal Box // 
    SqueezeBox.initialize({
        size: {x: 550, y: 450}, 
		sizeLoading: {x: 550, y: 450}, 
		overlayOpacity: 0.5
    });
	// // // // // // // // // // // //

	var str_request =   '?todo='+type_view+'&id_eqp='+id_eqp_cur+'&id_mon_action='+id_mon_action_cur+'&name_eqp='+name_eqp_cur;
	
	//prompt('', str_request);
 	SqueezeBox.open( '/module/it_equipment/ajax/php/display_monitoring_data.php' + str_request ,{ size: {x: 550, y: 450}}); //, {handler: 'iframe'} );  
 
  //id_input_retour).value 
  return false;
}


/*
 * affiche la page Todo LIST
 */
function goto_todolist()
{
	window.location.href = '?todo=todolist';
}

/*
 * Open POPUP PDF
 */
function open_popup_pdf( type_pdf, arg1 )
{

	timestamp_nbr = new Date().getTime();
				
	window.open ('/module/it_equipment/ajax/php/get_eqp_pdf.php?type_pdf='+type_pdf+'&id_eqp='+arg1, 'popup_pdf_'+timestamp_nbr, config='height=450, width=550, toolbar=no, menubar=no, scrollbars=yes, resizable=yes, location=no, directories=no, status=no');

	
	return false;
}

/*
 * OPEN POPUP PRTG 
 */
function open_popup_prtg( monitoring_srv_id_monitor, monitoring_objid )
{
	timestamp_nbr = new Date().getTime();
	
	window.open ( '/module/it_equipment/go_to_prtg.php?monitoring_srv_id_monitor='+monitoring_srv_id_monitor+'&monitoring_objid='+monitoring_objid, 'popup_prtg_'+timestamp_nbr, config='toolbar=yes, menubar=yes, scrollbars=yes, resizable=yes, location=yes, directories=no, status=yes');
	
	return false;
}


/*
 * Show / Hide full text of an EQP Comment
 */
function show_eqp_comment(id_eqp_comment_cur)
{
	if( $('eqp_comment_txt_full_'+id_eqp_comment_cur).style.display == 'none' )
	{
		 $('eqp_comment_txt_truncated_'+id_eqp_comment_cur).style.display = 'none';
		 $('eqp_comment_txt_full_'+id_eqp_comment_cur).style.display = '';
		 if( $('img-show-eqp-comment-'+id_eqp_comment_cur) )
	     {
			 $('img-show-eqp-comment-'+id_eqp_comment_cur).src = '/module/image/shadowless/chevron-large.png';
	     }
	}
	else
	{
		 $('eqp_comment_txt_full_'+id_eqp_comment_cur).style.display = 'none';	
		 $('eqp_comment_txt_truncated_'+id_eqp_comment_cur).style.display = '';
		 if( $('img-show-eqp-comment-'+id_eqp_comment_cur) )
	     {
			 $('img-show-eqp-comment-'+id_eqp_comment_cur).src = '/module/image/shadowless/chevron-large-expand.png';
	     }
	}
}


/*
 * ajout d'un nouveau Comment pour un Eqp donné 
 */
function add_manual_eqp_comment(id_eqp_cur)
{
	if( id_eqp_cur != 0 && id_eqp_cur != '' )
	{
		var str_comment_cur = $('txt_eqp_manual_comment').value;
		
		if( str_comment_cur == '' )
		{
			alert('Please, enter some text.');
			return false;
		}
		else
		{
			// call ajax action 
			if( confirm('Are you sure to post this comment?' ) )
			{
				// Ajax action with "tab" refresh after creation 
				// IMPORTANT: encodeURI() gère les sauts de lignes du TEXTAREA (doit ensuite etre traité en nl2br coté PHP)
				var str_request = '?todo=add_eqp_comment&id_eqp='+id_eqp_cur+'&txt_comment='+encodeURI(str_comment_cur);
				
				//prompt('', 'actions_equipment_card.php' + str_request );
				
				call_ajax_action( 'actions_equipment_card.php' + str_request , callback_add_manual_eqp_comment, id_eqp_cur );			
			}
			
		}
	}
}


function callback_add_manual_eqp_comment(res_action, id_eqp)
{
	if( res_action == 1 )
	{
		//alert('Comment saved.');
		switchTabCard('comments', 'edit');
	}
	else
	{
		alert('Error while adding Comment for this equipment.');
	}
	return false;
}


/*
 * ajout d'un nouveau EQP CREDENTIAL pour un Eqp donné 
 */
function add_eqp_credential(id_eqp_cur)
{
	if( id_eqp_cur != 0 && id_eqp_cur != '' )
	{
		var str_credential = '';
		
		if( $('txt_eqp_credential_login').value != '' )
		{
			str_credential = str_credential + '&login_credential='+encodeURI($('txt_eqp_credential_login').value);
		}
		else
		{
			alert('Please, type a Login.');
			$('txt_eqp_credential_login').focus();
			return false;
		}
		
		if( $('txt_eqp_credential_pwd').value != '' )
		{
			str_credential = str_credential + '&pwd_credential='+encodeURI( $('txt_eqp_credential_pwd').value);
		}
		else
		{
			alert('Please, type a Password.');
			$('txt_eqp_credential_pwd').focus();
			return false;
		}
		
		/*
		if( $('type_eqp_credential_domain').checked )
		{
			str_credential = str_credential + '&type_credential=1';
		}
		else
		{
			str_credential = str_credential + '&type_credential=0';
		}
		*/
		
		if( $('txt_eqp_credential_desc').value != '' )
		{
			str_credential = str_credential + '&desc_credential='+encodeURI( $('txt_eqp_credential_desc').value);
		}



		// call ajax action 
		if( confirm('Are you sure to add this credential?' ) )
		{
			// Ajax action with "tab" refresh after creation 
			// IMPORTANT: encodeURI() gère les sauts de lignes du TEXTAREA (doit ensuite etre traité en nl2br coté PHP)
			var str_request = '?todo=add_eqp_credential&id_eqp='+id_eqp_cur+str_credential;
			
			//prompt('', 'actions_equipment_card.php' + str_request );
			
			call_ajax_action( 'actions_equipment_card.php' + str_request , callback_add_eqp_credential, id_eqp_cur );			
		}
		
		
	}
}


function callback_add_eqp_credential(res_action, id_eqp)
{
	if( res_action == 1 )
	{
		//alert('Comment saved.');
		switchTabCard('eqp_credential', 'edit');
	}
	else
	{
		alert('Error while adding New Equipment Credential  for this equipment.');
	}
	return false;
}


/*
 * update d'un nouveau EQP CREDENTIAL pour un Eqp donné 
 */
function save_edit_eqp_credential(id_credential_cur)
{
	if( id_credential_cur != 0 && id_credential_cur != '' )
	{
		var str_credential = '';
		
		if( $('txt_eqp_credential_login_edit_' + id_credential_cur).value != '' )
		{
			str_credential = str_credential + '&login_credential='+encodeURI($('txt_eqp_credential_login_edit_' + id_credential_cur).value);
		}
		else
		{
			alert('Please, type a Login.');
			$('txt_eqp_credential_login_edit_' + id_credential_cur).focus();
			return false;
		}
		
		if( $('txt_eqp_credential_pwd_edit_' + id_credential_cur).value != '' )
		{
			str_credential = str_credential + '&pwd_credential='+encodeURI($('txt_eqp_credential_pwd_edit_' + id_credential_cur).value);
		}
		else
		{
			alert('Please, type a Password.');
			$('txt_eqp_credential_pwd_edit_' + id_credential_cur).focus();
			return false;
		}
		
		
		/*
		if( $('type_eqp_credential_domain_edit_' + id_credential_cur).checked )
		{
			str_credential = str_credential + '&type_credential=1';
		}
		else
		{
			str_credential = str_credential + '&type_credential=0';
		}
		*/
		
		if( $('txt_eqp_credential_desc_edit_' + id_credential_cur).value != '' )
		{
			str_credential = str_credential + '&desc_credential='+encodeURI($('txt_eqp_credential_desc_edit_' + id_credential_cur).value);
		}



		// call ajax action 
		if( confirm('Are you sure to update this credential?' ) )
		{
			// Ajax action with "tab" refresh after creation 
			// IMPORTANT: encodeURI() gère les sauts de lignes du TEXTAREA (doit ensuite etre traité en nl2br coté PHP)
			var str_request = '?todo=update_eqp_credential&id_credential='+id_credential_cur+str_credential;
			
			//prompt('', 'actions_equipment_card.php' + str_request );
			
			call_ajax_action( 'actions_equipment_card.php' + str_request , callback_save_edit_eqp_credential, id_credential_cur );			
		}
		
		
	}
}


function callback_save_edit_eqp_credential(res_action, id_credential_cur)
{
	if( res_action == 1 )
	{
		//alert('Comment saved.');
		show_hide_edit_eqp_credential(id_credential_cur);
		switchTabCard('eqp_credential', 'edit');
	}
	else
	{
		alert('Error while updating Equipment Credential for this equipment.');
	}
	return false;
}



/*
 * delete d'un nouveau EQP CREDENTIAL pour un Eqp donné 
 */
function delete_eqp_credential(id_credential_cur)
{
	if( id_credential_cur != 0 && id_credential_cur != '' )
	{
		// call ajax action 
		if( confirm('Are you sure to DELETE this credential?' ) )
		{
			// Ajax action with "tab" refresh after creation 
			// IMPORTANT: encodeURI() gère les sauts de lignes du TEXTAREA (doit ensuite etre traité en nl2br coté PHP)
			var str_request = '?todo=delete_eqp_credential&id_credential='+id_credential_cur;
			
			//prompt('', 'actions_equipment_card.php' + str_request );
			
			call_ajax_action( 'actions_equipment_card.php' + str_request , callback_delete_eqp_credential, id_credential_cur );			
		}
		
		
	}
}


function callback_delete_eqp_credential(res_action, id_credential_cur)
{
	if( res_action == 1 )
	{
		var el = $('tr_eqp_credential_edit_' + id_credential_cur );
		var el_container = el.parentNode;
		el_container.removeChild(el);
		
		var el2 = $('tr_eqp_credential_view_' + id_credential_cur );
		//var el2_container = el.parentNode;
		el_container.removeChild(el2);		
		
	}
	else
	{
		alert('Error while deleting Equipment Credential for this equipment.');
	}
	return false;
}


function show_hide_edit_eqp_credential(id_credential)
{
	if( $('tr_eqp_credential_edit_' + id_credential).style.display == 'none' )
	{
		$('tr_eqp_credential_view_' + id_credential).style.display = 'none';
		$('tr_eqp_credential_edit_' + id_credential).style.display = '';
	}
	else
	{
		$('tr_eqp_credential_view_' + id_credential).style.display = '';
		$('tr_eqp_credential_edit_' + id_credential).style.display = 'none';
	}
}

/* ************************************ */
/* ************ SMTP RELAYS *********** */
/* ************************************ */
/*
 * ajout d'un nouveau SMTP RELAY pour un Eqp donné 
 */
function add_smtp_relay(id_eqp_cur)
{
	if( id_eqp_cur != 0 && id_eqp_cur != '' )
	{
		var str_request_param = '';
		
		if( $('txt_smtp_relay_ip_start').value != '' )
		{
			str_request_param = str_request_param + '&ip_start_str='+$('txt_smtp_relay_ip_start').value;
		}
		else
		{
			alert('Please, type at least an IP START.');
			$('txt_smtp_relay_ip_start').focus();
			return false;
		}
		
		
		if( ( $('txt_smtp_relay_ip_end').value == '' || $('txt_smtp_relay_ip_end').value == 0 ) 
				&& ( $('txt_smtp_relay_ip_mask').value == '' || $('txt_smtp_relay_ip_mask').value == 0 ) )
		{
			alert('Please, type at least an IP MASK - OR - an IP END Address.');
			$('txt_smtp_relay_ip_end').focus();
			return false;	
		}
		
		
		if( $('txt_smtp_relay_ip_mask').value != '' && $('txt_smtp_relay_ip_mask').value != 0 )
		{
			str_request_param = str_request_param + '&ip_mask='+$('txt_smtp_relay_ip_mask').value;
		}	
		else if( $('txt_smtp_relay_ip_end').value != '' )
		{
			str_request_param = str_request_param + '&ip_end_str='+$('txt_smtp_relay_ip_end').value;
		}

		
		if( $('txt_smtp_relay_desc').value != '' )
		{
			str_request_param = str_request_param + '&desc_smtp_relay='+encodeURI( $('txt_smtp_relay_desc').value);
		}
		else
		{
			alert('Please, type a Description.');
			$('txt_smtp_relay_desc').focus();
			return false;	
		}



		// call ajax action 
		if( confirm('Are you sure to add this SMTP Relay ?' ) )
		{
			// Ajax action with "tab" refresh after creation 
			// IMPORTANT: encodeURI() gère les sauts de lignes du TEXTAREA (doit ensuite etre traité en nl2br coté PHP)
			var str_request = '?todo=add_smtp_relay&id_eqp='+id_eqp_cur+str_request_param;
			
			//prompt('', 'actions_equipment_card.php' + str_request );
			
			call_ajax_action( 'actions_equipment_card.php' + str_request , callback_add_smtp_relay, id_eqp_cur );			
		}
		
		
	}
}


function callback_add_smtp_relay(res_action, id_eqp)
{
	if( res_action == 1 )
	{
		//alert('Comment saved.');
		switchTabCard('smtp_relay', 'edit');
	}
	else
	{
		alert('Error while adding New SMTP Relay for this equipment.');
	}
	return false;
}


/*
 * Control JS pour saisie des champs MASK + IP_END
 * SI saisie dans IP_MASK => alors efface contenu de IP_END
 * ET le contraire.
 */
function control_smtp_ip_address(field_typed, mode_edit, id_smtp_relay)
{

	if( mode_edit == 'new' )
	{
		if( field_typed == 'ip_mask' )
		{
			if(	 	$('txt_smtp_relay_ip_mask').value != '' 
				&&  $('txt_smtp_relay_ip_mask').value != 0 )
			{
				 $('txt_smtp_relay_ip_end').value = '';
			}
		}
		else
		{
			// field_typed == ip_end 
			if(	 	$('txt_smtp_relay_ip_end').value != '' 
				&&  $('txt_smtp_relay_ip_end').value != 0 )
			{
				 $('txt_smtp_relay_ip_mask').value = '';
			}			
		}
		
	}
	else if( mode_edit == 'edit' )
	{
		
		
		if( field_typed == 'ip_mask' )
		{
			if(	 	$('txt_smtp_relay_ip_mask_edit_'+id_smtp_relay).value != '' 
				&&  $('txt_smtp_relay_ip_mask_edit_'+id_smtp_relay).value != 0 )
			{
				 $('txt_smtp_relay_ip_end_edit_'+id_smtp_relay).value = '';
			}
		}
		else
		{
			// field_typed == ip_end 
			if(	 	$('txt_smtp_relay_ip_end_edit_'+id_smtp_relay).value != '' 
				&&  $('txt_smtp_relay_ip_end_edit_'+id_smtp_relay).value != 0 )
			{
				$('txt_smtp_relay_ip_mask_edit_'+id_smtp_relay).value = '';
			}			
		}	

	}

}

/*
 * update d'un nouveau EQP CREDENTIAL pour un Eqp donné 
 */
function save_edit_smtp_relay(id_smtp_relay_cur)
{
	if( id_smtp_relay_cur != 0 && id_smtp_relay_cur != '' )
	{
		var str_params = '';
		
		if( $('txt_smtp_relay_ip_start_edit_' + id_smtp_relay_cur).value != '' )
		{
			str_params = str_params + '&ip_start_str='+encodeURI($('txt_smtp_relay_ip_start_edit_' + id_smtp_relay_cur).value);
		}
		else
		{
			alert('Please, enter an IP Start.');
			$('txt_smtp_relay_ip_start_edit_' + id_smtp_relay_cur).focus();
			return false;
		}
		
		if( ( $('txt_smtp_relay_ip_end_edit_' + id_smtp_relay_cur).value == '' || $('txt_smtp_relay_ip_end_edit_' + id_smtp_relay_cur).value == 0 ) 
				&& ( $('txt_smtp_relay_ip_mask_edit_' + id_smtp_relay_cur).value == '' || $('txt_smtp_relay_ip_mask_edit_' + id_smtp_relay_cur).value == 0 ) )
		{
			alert('Please, type at least an IP MASK - OR - an IP END Address.');
			$('txt_smtp_relay_ip_end_edit_' + id_smtp_relay_cur).focus();
			return false;	
		}
		
		
		if( $('txt_smtp_relay_ip_mask_edit_' + id_smtp_relay_cur).value != '' && $('txt_smtp_relay_ip_mask_edit_' + id_smtp_relay_cur).value != 0 )
		{
			str_params = str_params + '&ip_mask='+$('txt_smtp_relay_ip_mask_edit_' + id_smtp_relay_cur).value;
		}	
		else if( $('txt_smtp_relay_ip_end_edit_' + id_smtp_relay_cur).value != '' )
		{
			str_params = str_params + '&ip_end_str='+$('txt_smtp_relay_ip_end_edit_' + id_smtp_relay_cur).value;
		}
		

		
		
		
		if( $('txt_smtp_relay_desc_edit_' + id_smtp_relay_cur).value != '' )
		{
			str_params = str_params + '&desc_smtp_relay='+encodeURI($('txt_smtp_relay_desc_edit_' + id_smtp_relay_cur).value);
		}
		else
		{
			alert('Please, type a Description.');
			$('txt_smtp_relay_desc_edit_' + id_smtp_relay_cur).focus();
			return false;			
		}


		// call ajax action 
		if( confirm('Are you sure to update this SMTP Relay ?' ) )
		{
			// Ajax action with "tab" refresh after creation 
			// IMPORTANT: encodeURI() gère les sauts de lignes du TEXTAREA (doit ensuite etre traité en nl2br coté PHP)
			var str_request = '?todo=update_smtp_relay&id_smtp_relay='+id_smtp_relay_cur+str_params;
			
			//prompt('', 'actions_equipment_card.php' + str_request );
			
			call_ajax_action( 'actions_equipment_card.php' + str_request , callback_save_edit_smtp_relay, id_smtp_relay_cur );			
		}
		
		
	}
}


function callback_save_edit_smtp_relay(res_action, id_smtp_relay_cur)
{
	if( res_action == 1 )
	{
		//alert('Comment saved.');
		show_hide_edit_smtp_relay(id_smtp_relay_cur);
		switchTabCard('smtp_relay', 'edit');
	}
	else
	{
		alert('Error while updating Equipment Credential for this equipment.');
	}
	return false;
}



/*
 * delete d'un nouveau SMTP Relay pour un Eqp donné 
 */
function delete_smtp_relay(id_smtp_relay_cur)
{
	if( id_smtp_relay_cur != 0 && id_smtp_relay_cur != '' )
	{
		// call ajax action 
		if( confirm('Are you sure to DELETE this SMTP Relay?' ) )
		{
			// Ajax action with "tab" refresh after creation 
			// IMPORTANT: encodeURI() gère les sauts de lignes du TEXTAREA (doit ensuite etre traité en nl2br coté PHP)
			var str_request = '?todo=delete_smtp_relay&id_smtp_relay='+id_smtp_relay_cur;
			
			//prompt('', 'actions_equipment_card.php' + str_request );
			
			call_ajax_action( 'actions_equipment_card.php' + str_request , callback_delete_smtp_relay, id_smtp_relay_cur );			
		}
		
		
	}
}


function callback_delete_smtp_relay(res_action, id_smtp_relay_cur)
{
	if( res_action == 1 )
	{
		var el = $('tr_smtp_relay_edit_' + id_smtp_relay_cur );
		var el_container = el.parentNode;
		el_container.removeChild(el);
		
		var el2 = $('tr_smtp_relay_view_' + id_smtp_relay_cur );
		//var el2_container = el.parentNode;
		el_container.removeChild(el2);		
		
	}
	else
	{
		alert('Error while deleting SMTP Relay for this equipment.');
	}
	return false;
}


function show_hide_edit_smtp_relay(id_smtp_relay)
{
	if( $('tr_smtp_relay_edit_' + id_smtp_relay).style.display == 'none' )
	{
		$('tr_smtp_relay_view_' + id_smtp_relay).style.display = 'none';
		$('tr_smtp_relay_edit_' + id_smtp_relay).style.display = '';
	}
	else
	{
		$('tr_smtp_relay_view_' + id_smtp_relay).style.display = '';
		$('tr_smtp_relay_edit_' + id_smtp_relay).style.display = 'none';
	}
}


/* *********************************** */
/* *********************************** */
/* *********************************** */



function eqp_force_backup(id_eqp_cur)
{
	if( id_eqp_cur != 0 && id_eqp_cur != '' )
	{
		// call ajax action 
		if( confirm('Are you sure to force backup on this equipment?' ) )
		{
			// Ajax action with "tab" refresh after creation 
			// IMPORTANT: encodeURI() gère les sauts de lignes du TEXTAREA (doit ensuite etre traité en nl2br coté PHP)
			var str_request = '?todo=eqp_force_backup&id_eqp='+id_eqp_cur;
			
			//prompt('', 'actions_equipment_card.php' + str_request );
			
			call_ajax_action( 'actions_equipment_card.php' + str_request , callback_eqp_force_backup, id_eqp_cur );			
		}
	}
}


function callback_eqp_force_backup(res_action, id_eqp)
{
	if( res_action == 1 )
	{
		//alert('Comment saved.');
		switchTabCard('status', 'view');
	}
	else
	{
		alert('Error while forcing Backup for this equipment.');
	}
	return false;
}

function reset_ip_address(id_increment) {
	$('value_ip_address_'+id_increment).value = '';
	$('value_mask_ip_address_'+id_increment).value = '';
	if($('ip_category_'+id_increment)) {
		$('ip_category_'+id_increment).value = '0';
		$('ip_category_'+id_increment).set('disabled','');
		$('ip_category_hidden_'+id_increment).value='0';
		$('ip_category_hidden_'+id_increment).set('disabled','disabled');
	}
	$('name_ip_address_'+id_increment).value = '';
}