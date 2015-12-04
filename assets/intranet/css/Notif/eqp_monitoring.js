/*
 * ****************************************************************************************
 * Javascript propre à la page EQP_EQUIPMENT **********************************************
 * **************************************************************************************** 
 */


/**
 * Fonction de changement de l'onglet en cours ECRAN MONITORING 
 */
function switchTabMonitoring( section_name )
{
	var d = document;
	var list_section = Array( 'incoming', 'fauxpositif', 'consolidated', 'paused', 'fixed' );
	
	// Masquage de tous les onglets.
	for( var i = 0; i<list_section.length; i++ )
	{
		if( $( 'menu_li_' + list_section[i] ) )
		{
			$( 'menu_li_' + list_section[i] ).removeClass( 'current' );
		}
		//$( 'tab_' + list_section[i] ).setStyle( 'display', 'none' );
	}

	// Affichage de l'onglet sélectionné.
	$( 'menu_li_' + section_name ).addClass( 'current' );
	//$( 'tab_' + section_name ).setStyle( 'display', 'block' );
	
	// update de la valeur de l'onglet SELECTIONNE 
	$('tab_selected').value = section_name;
	
	// Récupération en ajax
	call_display_monitoring();
}

function sortBy(sort) {
	
	if($('sort').value == sort){
		
		if ($('order').value == 'ASC'){
			$('order').value = 'DESC';
		}else{
			$('order').value = 'ASC';
		}
	
	}else{
		$('order').value = 'ASC';	
	}

	$('sort').value = sort;
	display_monitoring();
}

function change_page(num_page)
{
	$('page').value = num_page;
	display_monitoring();
}

function call_display_monitoring()
{
	$('page').value = 0;
	display_monitoring();
}

function display_monitoring()
{
	var flag_continue = false;
	if(
		 $('id_site') && $('id_sub') && $('id_area') && $('page') && $('order') && $('sort') 
		) 
	 {
	 	flag_continue = true;
	 }
	
	if( !flag_continue )
	{
		// dans le cas où un des champs est cours de rafraichissement Ajax (n'existe pas)
		// => on inhibe l'action pour éviter une erreur javascript
		//	  entrainant le rechargement général de la page  
		return false;
	}
	/*	
	var str_val_display_mode = '0';
	if( $('show_monitoring_err_warning').checked )
	{
		 str_val_display_mode = '1';
	}
	'&display_mode=' + str_val_display_mode + 
	*/
	
	var str_request = '?todo=list_' + $('tab_selected').value +
					  '&id_site=' + $('id_site').value + 
					  '&id_sub=' + $('id_sub').value + 
					  '&id_area=' + $('id_area').value + 
					  '&name_eqp=' + encodeURIComponent($('name_eqp').value) + 
					  '&tab=' + $('tab_selected').value + 
					  '&page=' + $('page').value + 
					  '&order=' + $('order').value + 
					  '&sort=' + $('sort').value; 
	//prompt('', str_request);
	call_ajax_page( 'get_list_monitoring.php' + str_request , 'content_list_monitoring', call_ajax_post_monitoring );
	
}



function change_criteria_area( id_area )
{
	$('div_criteria_select_site').innerHTML = '<div class="div_criteria_msg_no_select"><input type="hidden" value="0" id="id_site" name="id_site" />all sites</div>';
	get_select_sub_site( 'list_sub', 'div_criteria_select_sub', 0, id_area, 'id_sub', 'id_sub', 'change_criteria_sub(this.value);return false;', 'width:180px;', 'all subsidiaries', ''  );
	return false;
}

function change_criteria_sub( id_sub )
{
	if( id_sub == 0 )
	{
		$('div_criteria_select_site').innerHTML = '<div class="div_criteria_msg_no_select"><input type="hidden" value="0" id="id_site" name="id_site" />all sites</div>';
		return false;
	}

	get_select_sub_site( 'list_site', 'div_criteria_select_site', id_sub, 0, 'id_site', 'id_site', '', 'width:180px;', 'all', ''  );
	return false;
}



function reset_monitoring_search_criteria()
{
	//var list_inputs = $('form_critere').getElements('input');
	$$('.input_criteria').each( function(el) {

	        el.value = '';
     });
     
    change_criteria_area('');
    
    $('name_eqp').value = '';
    
}


/*
 * affiche la fenetre d'affichage des Actions sur les Evements de Monitoring 
 */ 
function display_monitoring_action(id_eqp_cur,name_eqp_cur,id_mon_cur,id_sensor_cur)
{
	// initialisation de la Modal Box // 
    SqueezeBox.initialize({
        size: {x: 550, y: 450}, 
		sizeLoading: {x: 550, y: 450}, 
		overlayOpacity: 0.5
    });
	// // // // // // // // // // // //

	var str_request =   '?todo=view&id_eqp='+id_eqp_cur+'&name_eqp='+name_eqp_cur+'&id_mon='+id_mon_cur+'&id_sensor='+id_sensor_cur;
	
	//prompt('', str_request);
 	SqueezeBox.open( '/module/it_equipment/ajax/php/display_monitoring_action.php' + str_request ,{ size: {x: 550, y: 450}}); //, {handler: 'iframe'} );  
 
  //id_input_retour).value 
  return false;
}


/*
 * affiche la fenetre d'affichage des Actions PAUSE sur les Evements de Monitoring 
 */ 
function display_monitoring_action_pause(id_eqp_cur,name_eqp_cur,id_mon_cur,id_sensor_cur)
{
	// initialisation de la Modal Box // 
    SqueezeBox.initialize({
        size: {x: 550, y: 450}, 
		sizeLoading: {x: 550, y: 450}, 
		overlayOpacity: 0.5
    });
	// // // // // // // // // // // //

	var str_request =   '?todo=view_pause&id_eqp='+id_eqp_cur+'&name_eqp='+name_eqp_cur+'&id_mon='+id_mon_cur+'&id_sensor='+id_sensor_cur;
	
	//prompt('', str_request);
 	SqueezeBox.open( '/module/it_equipment/ajax/php/display_monitoring_action.php' + str_request ,{ size: {x: 550, y: 450}}); //, {handler: 'iframe'} );  
 
  //id_input_retour).value 
  return false;
}

/*
 * affiche la fenetre d'affichage des Actions FIX sur les Evements de Monitoring 
 */ 
function display_monitoring_action_fix(id_eqp_cur,name_eqp_cur,id_mon_action_cur)
{
	// initialisation de la Modal Box // 
    SqueezeBox.initialize({
        size: {x: 550, y: 450}, 
		sizeLoading: {x: 550, y: 450}, 
		overlayOpacity: 0.5
    });
	// // // // // // // // // // // //

	var str_request =   '?todo=view_fix&id_eqp='+id_eqp_cur+'&name_eqp='+name_eqp_cur+'&id_mon_action='+id_mon_action_cur;
	
	//prompt('', str_request);
 	SqueezeBox.open( '/module/it_equipment/ajax/php/display_monitoring_action.php' + str_request ,{ size: {x: 550, y: 450}}); //, {handler: 'iframe'} );  
 
  //id_input_retour).value 
  return false;
}



/*
 * affiche la fenetre d'affichage de la Liste des Serveurs de Monitoring 
 */ 
function display_monitoring_server_list()
{
	// initialisation de la Modal Box // 
    SqueezeBox.initialize({
        size: {x: 550, y: 450}, 
		sizeLoading: {x: 550, y: 450}, 
		overlayOpacity: 0.5
    });
	// // // // // // // // // // // //

	var str_request =   '?todo=view_monitoring_servers';
	
	//prompt('', str_request);
 	SqueezeBox.open( '/module/it_equipment/ajax/php/display_monitoring_data.php' + str_request ,{ size: {x: 550, y: 450}}); //, {handler: 'iframe'} );  
 
  return false;
}


/*
 * Execute l'action utilisateur d' " Acknowlege " pour une Erreur de Monitoring
 */
function send_action_mon_acknowledge(id_eqp_cur, device_label_cur, id_sensor_cur, id_mon_cur )
{
	var str_todo =  'acknowledge_all';
	if( id_sensor_cur != 0 )
	{
		str_todo =  'acknowledge';	
	}

	
	var str_request =   '?todo='+str_todo+'&id_eqp='+id_eqp_cur+'&device_label='+device_label_cur+'&id_sensor='+id_sensor_cur+'&id_mon='+id_mon_cur;

	if( $('action_mon_txt_comment').value != '' )
	{
		str_request = str_request + '&txt_comment=' + encodeURI( $('action_mon_txt_comment').value );
	}
	else
	{
		alert('Please, enter a Short Message description for you acknowledgement.');
		return false;
	}
	
	var str_confirm_msg_precision = 'as Fixed';
	if( $('action_mon_send_it_ticket_ok').checked )
	{
		str_request = str_request + '&send_it_ticket=1';
		
		str_confirm_msg_precision = 'In Progress';
	}	
	
	var str_confirm_msg = 'This Notification';
	if( str_todo == 'acknowledge_all' )
	{
		str_confirm_msg = 'These Notifications';
	}
	str_confirm_msg = str_confirm_msg + ' will be acknowledged and Marked ' + str_confirm_msg_precision + '.\nAre you sure to perform this action?';

	
	if( confirm(str_confirm_msg) )
	{
	
	//prompt('','actions_monitoring.php' + str_request);
	//return false;
		$('div_main_monitoring_action').style.display = 'none';
		$('div_wait_monitoring_action').style.display = '';
		
		call_ajax_action( 'actions_monitoring.php' + str_request , callback_action_mon_acknowledge, 0 );
	
	}
}



function callback_action_mon_acknowledge( res_action, tab_args )
{
	if( res_action == 0 )
	{
		alert('An ERROR occured during the process.'); 
	}
	/*
	else
	{
		alert('Error(s) acknowledged.'); 
	}
	*/
	
	//fermeture de la popup d'action
	SqueezeBox.close();
	
	//refresh liste courante
	display_monitoring();
}



/*
 * Execute l'action utilisateur de " PAUSE " pour un Sensor d'une Erreur de Monitoring
 */
function send_action_mon_pause(id_eqp_cur, device_label_cur, id_sensor_cur, id_mon_cur )
{
	var str_todo =  'pause';
	if( id_sensor_cur == 0 )
	{
		return false;	
	}
	
	var str_request =   '?todo='+str_todo+'&id_eqp='+id_eqp_cur+'&device_label='+device_label_cur+'&id_sensor='+id_sensor_cur+'&id_mon='+id_mon_cur;

	if( $('action_mon_txt_comment').value != '' )
	{
		str_request = str_request + '&txt_comment=' + encodeURI( $('action_mon_txt_comment').value );
	}
	else
	{
		alert('Please, enter a Short Message description for you action.');
		return false;
	}
	
	
	//prompt('','actions_monitoring.php' + str_request);
	//return false;
	
	var str_confirm_msg = 'The related PRTG Sensor will be Paused.\nAre you sure to perform this action?';

	if( confirm(str_confirm_msg) )
	{	
		$('div_main_monitoring_action').style.display = 'none';
		$('div_wait_monitoring_action').style.display = '';
		
		call_ajax_action( 'actions_monitoring.php' + str_request , callback_action_mon_pause, 0 );
	}

}

function callback_action_mon_pause( res_action, tab_args )
{
	if( res_action == 0 )
	{
		alert('An ERROR occured during the process.'); 
	}
	/*
	else
	{
		alert('The sensor has been paused.'); 
	}
	*/
	
	//fermeture de la popup d'action
	SqueezeBox.close();
	
	//refresh liste courante
	display_monitoring();
}

/*
 * Execute l'action utilisateur " FIX " pour une Erreur de Monitoring
 */
function send_action_mon_fix(id_eqp_cur, device_label_cur, id_mon_action_cur )
{
	var str_todo =  'fix';

	var str_request =   '?todo='+str_todo+'&id_eqp='+id_eqp_cur+'&device_label='+device_label_cur+'&id_mon_action='+id_mon_action_cur;

	if( $('action_mon_txt_comment').value != '' )
	{
		str_request = str_request + '&txt_step=' + encodeURI( $('action_mon_txt_comment').value );
	}
	else
	{
		alert('Please, enter a short Description for your action.');
		return false;
	}
	
	
	//prompt('','actions_monitoring.php' + str_request);
	//return false;
	var str_confirm_msg = 'All Notifications related to the IT Ticket will be Marked as Fixed.\nAre you sure to perform this action?';

	if( confirm(str_confirm_msg) )
	{		
		$('div_main_monitoring_action').style.display = 'none';
		$('div_wait_monitoring_action').style.display = '';
		
		call_ajax_action( 'actions_monitoring.php' + str_request , callback_action_mon_fix, 0 );
	}

}

function callback_action_mon_fix( res_action, tab_args )
{
	if( res_action == 0 )
	{
		alert('An ERROR occured during the process.'); 
	}
	/*
	else
	{
		alert('Error(s) fixed.'); 
	}
	*/
	
	//fermeture de la popup d'action
	SqueezeBox.close();
	
	//refresh liste courante
	display_monitoring();
}



/*
 * Appel des fonctions JS et Mootools indispensables après le chargement de la page en Ajax
 */
function call_ajax_post_monitoring()
{

     $$( '.tr_survol' ).each( function( el ) {

                 el.addEvents({

			

                            mouseenter: function( e ) {


                                   this.style.cursor = 'pointer';
	       	                       /*this.style.backgroundColor = '#D4DDEE';*/
	       	                       this.addClass('tr_selected_err'); 
                		       
				
                            },

                            mouseleave: function( e ) {  
                            
                            	
                            		this.style.cursor = 'default';
                            		/*this.style.backgroundColor = '#FFFFFF';*/
                            		this.removeClass('tr_selected_err'); 
                            

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
	 	     
   
}
