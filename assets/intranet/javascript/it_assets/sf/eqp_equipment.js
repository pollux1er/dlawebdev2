/*
 * ****************************************************************************************
 * Javascript propre à la page EQP_EQUIPMENT **********************************************
 * **************************************************************************************** 
 */
	
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
	indexKeyBoardCursor = -1;
	search_equipments();
}

function change_page(num_page)
{
	$('page').value = num_page;
	indexKeyBoardCursor = -1;
	search_equipments();
}

function call_search_equipment()
{
	$('page').value = 0;
	indexKeyBoardCursor = -1;
	search_equipments();
}


function refresh_search_equipment()
{
	indexKeyBoardCursor = -1;
	search_equipments();
}

function search_equipments()
{
	/*
	if( $('content_list_equipments').style.display == 'none' )
	{
		$('content_equipment_card').style.display = 'none';
		$('content_list_equipments').style.display = ''; 
		$('content_list_equipments').style.width = '100%';	
		$('content_equipment_card').style.width = '49%';		
	}
	*/
	var flag_continue = false;
	if(
		 $('id_site') &&  $('id_locus') && $('id_sub') && $('id_area') && $('page') && $('order') && $('sort') 
	 && $('id_eqp_type') && $('id_os_type') && $('ip_address_search') && $('name_eqp') 
	 && $('owner_type_perenco') && $('owner_type_other') 
	 &&  $('is_dev_0') &&  $('is_dev_1') 
	 && $('is_virtual_0') &&  $('is_virtual_1')  
	 && $('status_deployment_all') 
	 && $('status_monitoring_all') 
	 
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
	
	
	var str_virtual = 'all';
	if( $('is_virtual_0').checked )
	{
		str_virtual = '0';
	}	
	if( $('is_virtual_1').checked )
	{
		str_virtual = '1';
	}	
	
	
	if( !subnet_search_check_ip_address() )
	{
		// SubNet Mask search ( SUBNET MASK criteria != '' )
		// dans le cas où une adresse IP malformée est entrée dans le champ de critère :
		return false;		
	}
	
	
	
	var str_owner = '';
	if(  $('owner_type_perenco').checked )
	{
		str_owner = 'perenco';
	}	
	if( $('owner_type_other').checked )
	{
		str_owner = 'other';
	}
	
	var str_env = 'all';
	if( $('is_dev_0').checked )
	{
		str_env = '0';
	}	
	if( $('is_dev_1').checked )
	{
		str_env = '1';
	}

	var str_deployment = '';
	if( $('status_deployment_all').checked )
	{
		str_deployment = '&status_deployment=all';
	}
	else
	{
		$$( '.status_deployment_checkbox' ).each( function( el ) {
			if( el.checked )
			{
				str_deployment += '&status_deployment[]=' + el.value;
			} 
		});
	}
	
	var str_monitoring = '';
	if( $('status_monitoring_all').checked )
	{
		str_monitoring = '&status_monitoring=all';
	}
	else
	{
		$$( '.status_monitoring_checkbox' ).each( function( el ) {
			if( el.checked )
			{
				str_monitoring += '&status_monitoring[]=' + el.value;
			} 
		});
	}
		
	
	
	var str_request = '?todo=list' + 
					  '&id_site=' + $('id_site').value + 
					  '&id_locus=' + $('id_locus').value + 
					  '&id_sub=' + $('id_sub').value + 
					  '&id_area=' + $('id_area').value + 
					  '&page=' + $('page').value + 
					  '&order=' + $('order').value + 
					  '&sort=' + $('sort').value + 
					  '&id_eqp_type=' + $('id_eqp_type').value + 
					  '&id_os_type=' + $('id_os_type').value + 
					  '&eqp_owner=' + str_owner + 
					  '&is_dev=' + str_env + 
					  '&is_virtual=' + str_virtual + 
					  '' + str_deployment + 
					  '' + str_monitoring + 
					  '&ip_address=' + encodeURIComponent($('ip_address_search').value) +  
					  '&subnet_mask=' + $('subnet_mask_search').value +  
					  '&name_eqp=' + encodeURIComponent($('name_eqp').value); 
	//prompt('', str_request);
	call_ajax_page( 'get_list_equipments.php' + str_request , 'content_list_equipments', call_ajax_post_equipments );
	
}



function change_criteria_area( id_area )
{
	$('div_criteria_select_locus').innerHTML = '<div class="div_criteria_msg_no_select"><input type="hidden" value="0" id="id_locus" name="id_locus" />all locations</div>';
	$('div_criteria_select_site').innerHTML = '<div class="div_criteria_msg_no_select"><input type="hidden" value="0" id="id_site" name="id_site" />all sites</div>';
	get_select_sub_site( 'list_sub', 'div_criteria_select_sub', 0, id_area, 'id_sub', 'id_sub', 'change_criteria_sub(this.value);return false;', 'width:180px;', 'all subsidiaries', ''  );
	return false;
}

function change_criteria_sub( id_sub )
{

	$('div_criteria_select_locus').innerHTML = '<div class="div_criteria_msg_no_select"><input type="hidden" value="0" id="id_locus" name="id_locus" />all locations</div>';
	if( id_sub == 0 )
	{
		$('div_criteria_select_site').innerHTML = '<div class="div_criteria_msg_no_select"><input type="hidden" value="0" id="id_site" name="id_site" />all sites</div>';
		return false;
	}

	get_select_sub_site( 'list_site', 'div_criteria_select_site', id_sub, 0, 'id_site', 'id_site', 'change_criteria_site(this.value);return false;', 'width:180px;', 'all', ''  );

	return false;
}


function change_criteria_site( id_site )
{
	if( id_site == 0 )
	{
		$('div_criteria_select_locus').innerHTML = '<div class="div_criteria_msg_no_select"><input type="hidden" value="0" id="id_locus" name="id_locus" />all locations</div>';
		return false;
	}

	get_select_locus( 'list_locus', 'div_criteria_select_locus', id_site, 0, 'id_locus', 'id_locus', '', 'width:180px;', 'all', ''  );
	return false;
}


function ip_addr_search_change()
{
	if( $('ip_address_search').value != '' )
	{
		$('div_area_msg_all').style.display = '';
		$('div_sub_msg_all').style.display 	= '';
		$('div_site_msg_all').style.display = '';
		$('div_locus_msg_all').style.display = '';

		$('div_criteria_select_area').style.display = 'none';
		$('div_criteria_select_sub').style.display 	= 'none';
		$('div_criteria_select_site').style.display = 'none';
		$('div_criteria_select_locus').style.display = 'none';
		
	}
	else
	{
		$('div_area_msg_all').style.display = 'none';
		$('div_sub_msg_all').style.display 	= 'none';
		$('div_site_msg_all').style.display = 'none';
		$('div_locus_msg_all').style.display = 'none';	
		
		$('div_criteria_select_area').style.display = '';
		$('div_criteria_select_sub').style.display 	= '';
		$('div_criteria_select_site').style.display = '';	
		$('div_criteria_select_locus').style.display = '';	
	}
}

/*
 * criteria restriction for SubNet mask input search 
 */
function subnet_search_change()
{
	var val_subnet_mask = $('subnet_mask_search').value;

	return 	check_ip_mask(val_subnet_mask);
}

/*
 * reset des input ip_address + subnet mask criteria 
 */
function reset_ip_search_criteria()
{
	$('ip_address_search').value='';
	$('subnet_mask_search').value='';
	
	ip_addr_search_change();
	
	if( $('ip_address_search').hasClass('input_type_wrong') )
	{ 
		$('ip_address_search').removeClass('input_type_wrong'); 
	}		
}


/*
 * criteria warning SubNet search + check si IP address conforme 
 */
function subnet_search_check_ip_address()
{
	var ret_fct = true;
	var val_subnet_mask = $('subnet_mask_search').value;
	var val_ip_addr 	= $('ip_address_search').value;
	
	if( val_subnet_mask != '' )
	{
	 	var regex = new RegExp("^((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\\.){3}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})$", "");
		if( ! regex.test(val_ip_addr) ) 
		{ 	
			// ne correspond pas à une adresse IP 
			alert('Searches with a SubNet Mask requires a fully valid IP Address.');
			ret_fct = false;
			
			if( !$('ip_address_search').hasClass('input_type_wrong') )
			{ 
				$('ip_address_search').addClass('input_type_wrong'); 
			} 	
		}
		else
		{
			if( $('ip_address_search').hasClass('input_type_wrong') )
			{
				$('ip_address_search').removeClass('input_type_wrong'); 
			}
		}
	}
	else
	{
		if( $('ip_address_search').hasClass('input_type_wrong') )
		{ 
			$('ip_address_search').removeClass('input_type_wrong'); 
		}		
	}
	
	return ret_fct;
}


/*
 * Appel des fonctions JS et Mootools indispensables après le chargement de la page en Ajax
 */
function call_ajax_post_equipments()
{


	if( $('content_equipment_card').style.display == '' )
	{
		minimize_eqp_list();
	}

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


function keyboardNavigation(e){
		if(!e) e=window.event;
		if (e.altKey) return true;
		var target = e.target || e.srcElement;
		if (target && target.type) return true; //an input editable element		
		var keyCode=e.keyCode || e.which;
		var docElem = document.documentElement;
		
		var ret = true;
		
		switch(keyCode) {
			case 38:
				// si 38 => UP
				if( indexKeyBoardCursor <= 0 )
				{
					indexKeyBoardCursor = 0;
				}
				else
				{
					indexKeyBoardCursor--;
				}			
				var i_cpp = 0;
			     $$( '.tr_survol' ).each( function( el ) {
					if( i_cpp == indexKeyBoardCursor )
					{
						// el.setStyle('background-color', '#F3E2D0');
						  el.addClass('tr_selected'); 
					}
					else
					{
			            //el.style.backgroundColor = '#fff';
						if( $('lock_' + el.id).value == 0 && el.hasClass('tr_selected') )
						{ 
							el.removeClass('tr_selected'); 
						} 			            
			        }
			            
					i_cpp++;
			     });				
				

				//alert('UP:'+indexKeyBoardCursor);
				ret = false;
				break;
			case 40:
				// si 40 => DOWN	
				if( indexKeyBoardCursor >= ( $('input_nbr_eqp_displayed').value - 1 ) )
				{
					indexKeyBoardCursor = 0;
				}
				else
				{
					indexKeyBoardCursor++;
				}	
				var i_cpp = 0;
			     $$( '.tr_survol' ).each( function( el ) {
			
					if( i_cpp == indexKeyBoardCursor )
					{
					  //	el.setStyle('background-color', '#F3E2D0');
					 	 el.addClass('tr_selected'); 
					}
					else
					{
			          //  el.style.backgroundColor = '#fff';
			          	if( $('lock_' + el.id).value == 0 && el.hasClass('tr_selected') )
						{ 
							el.removeClass('tr_selected'); 
						} 		
			        }
			            
					i_cpp++;
			     });				
								
								
				//alert('DOWN:'+indexKeyBoardCursor);
				ret = false;
				break;
				
			case 13: 
				// si 13 => ENTER 	
				if( indexKeyBoardCursor >= 0 )
				{
					 var i_cpp = 0;
				     $$( '.tr_survol' ).each( function( el ) {
				
						if( i_cpp == indexKeyBoardCursor )
						{
							var str_id_tr = el.get('id');
							var id_eqp_current = $('val_' + str_id_tr).value;
							if( id_eqp_current != 0 )
							{
								display_equipments(id_eqp_current, 'common', 'view');
							}				
						}
				            
						i_cpp++;
				     });		
			   }  		
				ret = false;
				break;
				
			case 37:
				// si 37 => LEFT	
				// PAGE PREVIOUS 
				if( $('page').value > 0 )
				{
					indexKeyBoardCursor = -1 ;
					var page_previous = $('page').value - 1;
					change_page(page_previous);
				}
							
				
				ret = false;
				break;			
					
			case 39:
				// si 39 => RIGHT	
				// PAGE NEXT 
				if( document.getElementById('nb_page_total') )
				{
					if( $('page').value < ($('nb_page_total').value - 1) )
					{
						indexKeyBoardCursor = -1 ;
						var page_next = parseInt( $('page').value, 10) + 1;
						change_page(page_next);
					}
				}
				ret = false;
				break;
		}
		//document.focus();
		return ret;
}
	
// INITIALISATION et APPEL de la fonction keyBoardNavigation
var indexKeyBoardCursor = -1;
document.onkeydown=keyboardNavigation;

// INITIALISATION (dans le corps de la page) du champ contenant la valeur de l'offset
// correspondant à la TimeZone du navigateur de l'utilisateur ( = du système de l'utilisateur )
var d= new Date();
document.write('<input type="hidden" id="timeZoneOffset" ');
if (d) {
    document.write('value="' + ( - (d.getTimezoneOffset()/60) ) + '">');
} else {
    document.write('value="0">');
}
