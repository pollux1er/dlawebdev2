var fade_start = 0.35;
var fade_end = 1;

/**
 * Génère un id pseudo-unique.
 */
 function uniqid()
 {
	var thedate = new Date();
	return thedate.getTime();
}

/**
 * Ajout d'un document.
 */
function add_doc( id_td, name_file_element )
{
	var d = document;
	var td_document   = d.getElementById( id_td ); // 'td_document'
	var input_file = d.createElement( 'input' );
	input_file = $( input_file );

	input_file.type = 'file';
	input_file.name = name_file_element; // 'filename[]'
	input_file.size = '26';
	input_file.className = 'input_type';
	input_file.setStyle( 'clear', 'both' );

	td_document.appendChild( d.createElement( 'br' ) );
	td_document.appendChild( input_file );
}

/**
 * Retourne un objet date à partir d'une chaîne.
 */
function getDate( strDate )
{
	var day   = strDate.substring(0,2);
	var month = strDate.substring(3,5);
	var year  = strDate.substring(6,10);

	var d = new Date();
	d.setFullYear(year);
	d.setMonth(month-1);
	d.setDate(day);
	return d;
}

/**
 * Compare deux dates.
 * Retourne :
 * 0 si date_1=date_2
 * 1 si date_1>date_2
 * -1 si date_1<date_2
 */
function compare( date_1, date_2 )
{
	var diff = date_1.getTime()-date_2.getTime();
	return (diff==0?diff:diff/Math.abs(diff));
}

/**
 * Retourne la chaîne val sans ses espaces.
 */
function trim( chaine )
{
	if( trim.arguments.length > 1 )
	{
		var str = trim.arguments[1];
		expreg = new RegExp('(^'+ str +'*)|('+ str +'*$)', 'g');
	}
	else
	{
		expreg = /(^\s*)|(\s*$)/g;
	}

	var new_chaine = stripHtml(chaine.replace(expreg,''));
	return new_chaine.replace(/&nbsp;/g, '');
}

/**
 * Remplace les tags html par leurs entités équivalentes.
 */
function stripHtml( s )
{
	return s.replace(/\\&/g, '&amp;').replace(/\\</g, '&lt;').replace(/\\>/g, '&gt;').replace(/\\t/g, '&nbsp;&nbsp;&nbsp;').replace(/\\n/g, '<br />');
}

/**
 * Retourne la valeur checkée d'une liste de radios.
 * cf. http://www.somacon.com/p143.php
 */
function getCheckedValue( radioObj )
{
	if( radioObj == undefined
		|| !radioObj )
	{
		return '';
	}
	var radioLength = radioObj.length;
	if( radioLength == undefined )
	{
		if( radioObj.checked )
			return radioObj.value;
		else
			return '';
	}
	for( var i = 0; i < radioLength; i++ )
	{
		if( radioObj[i].checked )
		{
			return radioObj[i].value;
		}
	}
	return '';
}

/**
 * Recherche d'un Attribution IT, en incluant le requestor.
 */
function search_attribution_it( event, inputField, outputField, completionDiv )
{
	// Identifiant du ticket.
	var option = Array();
	var tck_id = $( 'tck_id' );

	if( tck_id )
	{
		// Requestor.
		option['tck_id'] = tck_id.value;
		option['include_requestor'] = '1';
	}

	// Appel de la fonction du template.
	search_access_with_gen_user( event, inputField, outputField, completionDiv, option );
}

/**
 * Ajoute un utilisateur en délégation.
 */
function addUser( id_section )
{
	var id = uniqid();

	var td_user = $( 'td_' + id_section );

	var div_wrapper = document.createElement( 'div' );
	div_wrapper.id = 'div_' + id_section + '_' + id;
	div_wrapper.className = 'delegation_wrapper';

	var div_user_field = document.createElement( 'div' );
	div_user_field.className = 'div_user_field';

	var input_userId   = document.createElement( 'input' );
	input_userId.type = 'hidden';
	input_userId.id   = id_section + '_userId['+id+']';
	input_userId.name = id_section + '_userId['+id+']';
	input_userId.className = id_section + '_userId';

	var input_name = document.createElement( 'input' );
	input_name.type = 'text';
	input_name.size = '40';
	input_name.className = 'input_half_wide';
	input_name.maxlength = '50';
	input_name.name = id_section + '_input_name['+id+']';
	input_name.id = id_section + '_input_name['+id+']';

	input_name.onkeyup = function() { search_attribution_it(event, id_section + '_input_name['+id+']', id_section + '_userId['+id+']', 'completion_user['+id+']'); };
	input_name.setAttribute('onKeyUp', "search_attribution_it(event, '"+ id_section + "_input_name["+id+"]', '"+ id_section + "_userId["+id+"]', 'completion_user["+id+"]'); checkToClearField( this, '"+ id_section + "_userId[" + id + "]' );");

	var link_remove = document.createElement( 'a' );
	link_remove.href = "#";
	link_remove.setAttribute( 'onClick', "removeUser( 'div_"+ id_section + "_"+ id +"' ); return false;" );
	link_remove.className = 'action_delete action_moins left';
	link_remove.title = label_delete;
	link_remove.innerHTML = '&nbsp;';

	var div_completion = document.createElement("div");
	div_completion.className = "completion";
	div_completion.id = 'completion_user['+id+']';

	div_user_field.appendChild( input_userId );
	div_user_field.appendChild( document.createTextNode( ' ' ) );
	div_user_field.appendChild( input_name );
	div_user_field.appendChild( div_completion );

	div_wrapper.appendChild( link_remove );
	div_wrapper.appendChild( div_user_field );

	td_user.appendChild( div_wrapper );

	// Champs en autocomplétion si nécessaire.
	tpl_addUserAutocompletion();
}

/**
 * Retire une ligne d'utilisateur en délégation.
 */
function removeUser( id_element )
{
	var div = $( id_element );
	div.parentNode.removeChild( div );
}

/**
 * Modifie le pointeur de souris lors du passage sur un input.
 */
function setPointerOnHover( el )
{
	el.addEvents( {
		mouseover: function( e ) { this.setStyle( 'cursor', 'pointer' ); },
		mouseout: function( e ) { this.setStyle( 'cursor', 'default' ); }
	} );
}

/**
 * Popup affichant la description d'un dossier.
 */
function popupOutline( comment )
{
	var popup = '<div class="custom_tip">' + comment + '</div>';
	return overlib( popup );
}

/**
 * Crée un élément refermable.
 */
function createExpandCollapse( id_wrapper, id_header, id_body, open )
{
	var wrapper = $( id_wrapper );
	var header = $( id_header );
	var body = $( id_body );
	if( wrapper )
	{
		//var fx = new Fx.Styles( wrapper, { duration: 300, wait: false } );
		var slide = new Fx.Slide( body, {
			duration: 200,
			transition: Fx.Transitions.Cubic.easeInOut,
			onStart: function() {
				if( this.open )
				{
					header.removeClass( 'pane_open' );
					header.addClass( 'pane_closed' );
				}
				else
				{
					header.removeClass( 'pane_closed' );
					header.addClass( 'pane_open' );
				}
			} } );
		wrapper.slide = slide;
		header.addEvents( {
			'click': function( e ) {
				wrapper.slide.toggle( );
			},
			'mouseover': function( e ) {
				this.setStyle( 'cursor', 'pointer' );
			},
			'mouseout': function( e ) {
				this.setStyle( 'cursor', 'default' );
			}
		} );
		var state_style = ( open ? 'pane_open' : 'pane_closed' );
		header.addClass( state_style );
	}
	return wrapper;
}

/**
 * Affiche le message d'urgency correspondant à l'urgency sélectionnée.
 */
function displayHelp( id_urgency )
{
	$$( 'span.urgency_help' ).setStyle( 'display', 'none' );
	var urgency_field = $( 'urgency_' + id_urgency );
	if( urgency_field )
	{
		urgency_field.setStyle( 'display', 'block' );
	}
}

/**
 * Trim JS.
 * see http://blog.stevenlevithan.com/archives/faster-trim-javascript
 */
function trimString( str )
{
	var	str = str.replace(/^\s\s*/, ''),
		ws = /\s/,
		i = str.length;
	while (ws.test(str.charAt(--i)));
	return str.slice(0, i + 1);
}

/**
 * Fonctionnalités de pliage/dépliage de tous les onglets à la fois.
 * cf. http://forum.mootools.net/viewtopic.php?id=2713
 */
Accordion.implement({
	showAll: function() {
		var obj = {};
		this.previous = -1;
		this.elements.each(function(el, i){
			obj[i] = {};
			this.fireEvent('onActive', [this.togglers[i], el]);
			for (var fx in this.effects) obj[i][fx] = el[this.effects[fx]];
		}, this);
		return this.start(obj);
	},
	hideAll: function() {
		var obj = {};
		this.previous = -1;
		this.elements.each(function(el, i){
			obj[i] = {};
			this.fireEvent('onBackground', [this.togglers[i], el]);
			for (var fx in this.effects) obj[i][fx] = 0;
		}, this);
		return this.start(obj);
	}
});

/**
 * Edition sélective des champs du ticket.
 */
function saveAllSection( tck_id )
{
	$$( 'a.zone_save' ).each( function( el )
	{
		loadSection( tck_id, el.getParent().get( 'id' ), 'save' );
	});
}

/**
 * Edition sélective des champs du ticket.
 */
function loadSection( tck_id, section, todo )
{
	// Validation de l'annulation.
	if( todo == 'cancel' )
	{
		if( !confirm( "Your modifications will be lost. Are you sure?" ) )
		{
			return false;
		}
		todo = 'view';
	}

	// Paramètres de la requête ajax.
	var url = '/module/helpdesk/ajax/php/edit.ticket.php';
	url += '?tck_id='+tck_id;
	url += '&section='+section;
	url += '&todo='+todo;
	var param = {
				url: url,
				method: 'get',
 				encoding: 'iso-8859-1',
				evalScripts: true,
				onComplete: function( response )
				{
					getBackSectionContent( tck_id, section, response, todo );
				}
			};
	//prompt( '', url );

	// Récupère la vue des champs.
	if( todo == 'view' )
	{
		param.method = 'get';
	}
	else if( todo == 'edit' )
	{
		param.method = 'get';
	}
	// Sauve le formulaire en ajax.
	else if( todo == 'save' )
	{
		if( !validateTicket( section ) )
		{
			return false;
		}
		param.method = 'post';
		param.data = $( 'frmTicket' );
	}

	// Récupère la valeur du champ description.
	var tck_description = $( 'tck_description' );
	if( tck_description )
	{
		$( 'tck_description' ).value = CKEDITOR.instances.tck_description.getData();
	}

	// Requête ajax.
	$( section ).fade( fade_start );
	var ajaxRequest = new Request( param ).send( );
	return false;
}

/**
 * Récupère le contenu d'une section et la met à jour.
 */
function getBackSectionContent( tck_id, section, response, todo )
{
	//$( section ).innerHTML = response;
	$( section ).set('html', response);

	// Génère les champs CkEditor.
	// Génération des CkEditor sur les textareas de la page.
/*
	if( section == 'section_description' )
	{
		generateCkEditor();
	}
*/
	if( todo == 'edit' )
	{
		if( typeof( initializeCommonEvent ) == 'function' )
		{
			initializeCommonEvent( section );
		}
		if( typeof( initializeTicketFormEvent ) == 'function' )
		{
			initializeTicketFormEvent( section );
		}
		if( typeof( initializeChecklistFormEvent ) == 'function' )
		{
			initializeChecklistFormEvent( );
		}
	}

     // Mise à jour du statut dans le bandeau de titre si le statut a changé.
     if( section == 'section_headline'
     	&& $( 'tck_status' )
     	&& $( 'current_tck_status' )
     	&& $( 'tck_status' ).value != $( 'current_tck_status' ).value )
     {
     	loadSection( tck_id, 'section_header', 'view' )
     	$( 'current_tck_status' ).value = $( 'tck_status' ).value;
     }
    $( section ).fade( fade_end );

	// Todo : afficher l'erreur s'il y en a une.
	var ajax_error = $( 'ajax_error_'+ section );
	if( ajax_error
		&& ajax_error.value
		&& ajax_error.value != '' )
	{
	/*
		alert( ajax_error.result );
		alert( ajax_error.value );
		*/
		//$( section ).createElement;
	}

	// Interchange l'affichage du bouton Edit ou Save selon le statut d'édition.
	switchSave( );
}

/**
 * Affiche le bouton de sauvegarde ajax ou général.
 */
function switchSave( )
{
	var to_save = $$( 'a.zone_save' );
	var mode = 'ajax'
	if( to_save == '' )
	{
		mode = 'global'
	}
	var save_global = $( 'save_global' );
	var save_ajax = $( 'save_ajax' );
	if( save_global
		&& save_ajax )
	{
		if( mode == 'global' )
		{
			save_global.setStyle( 'display', 'block' );
			save_ajax.setStyle( 'display', 'none' );
		}
		else
		{
			save_global.setStyle( 'display', 'none' );
			save_ajax.setStyle( 'display', 'block' );
		}
	}
}

/**
 * Regénère les champs CkEditor après un appel ajax (by GTA).
 */
function generateCkEditor()
{
	if( CKEDITOR )
	{
		$$( 'textarea' ).each( function( el )
		{
			// détruit une éventuelle ancienne instance de CKeditor liée 
			// au textarea courant
			var instance_ckeditor = CKEDITOR.instances[el.id];
			if( instance_ckeditor )
			{
				CKEDITOR.remove( instance_ckeditor );
			}
			// crée une nouvelle instance de CKeditor pour le textarea courant
			var ck_option = {
									removePlugins: 'elementspath',
									toolbarCanCollapse: false,
									toolbar: [
										[ 'Cut','Copy','Paste','-','Undo','Redo' ],
										[ 'Bold','Italic','Underline','Strike','FontSize' ],
										[ 'NumberedList','BulletedList','-','Outdent','Indent', 'Link','Unlink' ],
										[ 'TextColor','BGColor', 'Image' ]
									],
									width: '98%', 
									height: '200px',
									entities: false,
									entities_latin: false,
									fontSize_sizes: '8/8px;10/10px;12/12px;14/14px;16/16px;18/18px;'
								};
			if( !Browser.Engine.trident4 )
			{
				ck_option.enterMode = CKEDITOR.ENTER_BR;
			}
			CKEDITOR.replace( el.id, ck_option );
		});
	}
}

/**
 * Contrôles de la checklist avant soumission du formulaire.
 */
function validateChecklist( status_value )
{
	// Toutes les étapes de la checklist doivent être cochées pour que le statut du ticket
	// puisse passer à Solved ou Closed.
	if( status_value == global_cfg_tck_status_solved
		|| status_value == global_cfg_tck_status_closed )
	{
		// Pas de droit d'édition sur la checklist : il faut qu'elle soit complète.
		var checked_all = $( 'tck_checklist_is_complete' ).value == 1;
		// Droit d'édition sur checklist : il faut que les anciennes tâches soient cochées. 
		if( global_is_acc_checklist == 1 )
		{
			checked_all = $$( 'input.checklist_done' ).every( function( chk ) {
				return chk.getProperty( 'checked' );
			});
		}
		if( !checked_all )
		{
			alert( global_label_tck_status_checklist_incomplete );
			return false;
		}
	}

	// La description de la tâche ne doit pas être vide.
	var description_all = $$( 'input.checklist_description' ).every( function( input ) {
		if( input.value == '' )
		{
			if( input.getStyle( 'display' ) == 'block' )
			{
				input.addClass( 'error' );
				if( accordion ) accordion.display( 2 );
				//input.focus();
			}
			return false;
		}
		return true;
	});
	if( !description_all )
	{
		alert( global_label_tck_status_checklist_desc_empty );
		return false;
	}

	return true;
}

/**
 * Crée un calendrier d'intervalle (from... to...).
 */
function createFromToCalendar( from, to )
{
	if( !$( from ) || !$( to ) )
	{
		return false;
	}

	// Fix pour permettre valeur vide
	var del_from = false;
	var del_to = false;
	if( $( from ).value == '' )
	{
		del_from = true;
	}
	if( $( to ).value == '' )
	{
		del_to = true;
	}

	var cal_from = new CalendarEightysix( from, { format: '%Y-%m-%d' } );
	var cal_to = new CalendarEightysix( to, { format: '%Y-%m-%d' } );

	cal_from.addEvent('change', function(date)
	{
		date = date.clone();//.increment(); //At least one day higher; so increment with one day
		cal_to.options.minDate = date; //Set the minimal date
		if(cal_to.getDate().diff(date) >= 1) cal_to.setDate(date); //If the current date is lower change it
		else cal_to.render(); //Always re-render
	});

	if( del_from )
	{
		eraseDate( from );
	}
	if( del_to )
	{
		eraseDate( to );
	}
}




/**
 * Adds users in copy of a ticket or a step.
 */
function addCopyTo() 
{
	var table = $( 'tableCopyTo' ).getElement('tbody');
	var row_index = table.rows.length;
	var row = table.insertRow( row_index );
	var id_row = ++global_copy_to_id_row;
	var list_cell = Array();
	var list_class = Array();

	// Delete icon.
	list_cell.push( '<a href="#" onclick="deleteCopyTo(this); return false;" class="action_delete action_minus" title="' + global_label_button_delete +'">&nbsp;</a>' );
	list_class.push( '' );

	// User name or e-mail.
	list_cell.push( '<input type="hidden" name="id_sent_to['+ id_row +']" value="" />'
			+ '<input type="hidden" name="tck_copy_to_id_list['+ id_row +']" id="tck_copy_to_id_list_'+ id_row +'" value="" />'
			 + '<span class="copy_to_staff" style="display: block;">'
			 + '<input name="tck_copy_to['+ id_row +']" value="" type="text" id="tck_copy_to_'+ id_row +
			 '" size="20" maxlength="50" class="tpl_input_type auto_sending" autocomplete="off" onkeyup="javascript:search_user(event, \'tck_copy_to_'+ id_row 
			 +'\', \'tck_copy_to_id_list_'+ id_row +'\', \'copytoEmailCompletion_'+ id_row +'\');"  />'
			 + '<div id="copytoEmailCompletion_'+ id_row +'" class="completion"></div>'
			 + '</span>'
			 + '<input value="" style="display: none;" name="external_email['+id_row +']" type="text" size="20" maxlength="50" class="tpl_input_type copy_to_external" autocomplete="off" onclick="checkEmail(this);" onblur="checkEmail(this); " />'
			 + '<div class="hint invalid" style="display:none">A valid email adress is needed.</div>'
			 );
	list_class.push( '' );

	// Third party.
	list_cell.push( '<label class="check_3rd_party tips" id="toggler_email_'+ id_row +'" title="'+ global_label_tck_copy_to_external_help +'">'
			 + '<input class="check_3rd_party toggleSenderFields" name="is_external['+ id_row +']" value="1" id="toggler_email_'+ id_row +'" type="checkbox" onclick="toggleCopyTo(this);" />'
			 + '</label>' );
	list_class.push( 'align_center' );

	// Ajout des cellules à la ligne.
	for( var i=0; i<list_cell.length; i++ )
	{
		cell = row.insertCell( i );
		cell.innerHTML = list_cell[i];
		cell.className = list_class[i];
	}
	
	tpl_addUserAutocompletion();
	setTimeout(function() { J('#tck_copy_to_'+id_row).focus(); }, 1);
}

/**
 * Supprime une ligne des personnes en copie
 */
function deleteCopyTo( obj )
{
	var table = $( 'tableCopyTo' );
	table.deleteRow( obj.parentNode.parentNode.rowIndex );
}

function toggleCopyTo( obj )
{
	J('.copy_to_staff, .copy_to_external').attr('value','');
	var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	obj = $( obj );
	if( obj.checked ) {
		obj.getParent( 'tr' ).getElements('.copy_to_staff').hide();
		if ( J(obj).is(":checked") ) {
			var ipt = obj.getParent( 'tr' ).getElements('.copy_to_external').get('value');
			if (regex.test(ipt) == false) {
				obj.getParent( 'tr' ).getElements('.hint').show();
			}else{
				obj.getParent( 'tr' ).getElements('.hint').hide();
			}
		}		
		obj.getParent( 'tr' ).getElements('.copy_to_external').show();
		var input = obj.getParent( 'tr' ).getElements('.copy_to_external')[0];
		input.focus();
	} else {
		obj.getParent( 'tr' ).getElements('.copy_to_staff').show();
		var input = obj.getParent( 'tr' ).getElements('.copy_to_staff')[0].getElements( 'input' )[0];
		input.focus();
		obj.getParent( 'tr' ).getElements('.copy_to_external').hide();
		obj.getParent( 'tr' ).getElements('.hint').hide();
	}
}

function checkEmail( obj )
{
	var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	obj = J( obj );
	if(J('input.check_3rd_party').is(":checked")) {
		var ipt = obj.val();
		if (regex.test(ipt) == false) {
			obj.next('.hint').show();
			//J('.tpl_button_save').attr('disabled', 'disabled');
		}else{
			obj.next('.hint').hide(); 
			//J('.tpl_button_save').removeAttr('disabled');
		}
	}else{
		//J('.tpl_button_save').removeAttr('disabled');
	}
}
/**
 * Actions exécutées au chargement de la page.
 */
window.addEvent( 'domready', function()
{
	//$$( 'a' ).unselectable();
	/*$$( 'a' ).each( function( el ) {
		//alert( el.href );
		el.set( 'unselectable', 'on' );
	} );*/

	// Page (ticket).
	
	initializeCommonEvent( 'body' );
	// Popup (solution step).
	initializeCommonEvent( 'div_solution' );
} );
function initializeCommonEvent( section )
{
	// New template id.
	if( section == 'body'
		&& !$( section ) )
	{
		section = 'body_content';
	}
	if( !$( section ) )
	{
		return;
	}
	// Ajoute un curseur en forme de main sur chaque contenu de label (pour les checkboxes).
	$( section ).getElements( 'label' ).each( function( el ) { setPointerOnHover( el ); } );
	$( section ).getElements( 'label input' ).each( function( el ) { setPointerOnHover( el ); } );

	// Correctif du .input_wide:focus pour IE6.
/*
	var input_active_arg = {	focus: function() { this.addClass( 'input_active' ); },
								blur: function() { this.removeClass( 'input_active' ); } };
	$( section ).getElements( 'input.input_wide' ).each( function( el ) { el.addEvents( input_active_arg ); });
	$( section ).getElements( 'input.input_half_wide' ).each( function( el ) { el.addEvents( input_active_arg ); });
	$( section ).getElements( 'input.input_type' ).each( function( el ) { el.addEvents( input_active_arg ); });
*/

	// Alternate colors.
	var count = 0;
	$( section ).getElements( 'table.tab_list_main tr' ).each(function( el )
	{
		el.addClass(count++ % 2 == 0 ? 'odd' : 'even');
	});

	// Ajoute le title dans une popup instantée pour les éléments pourvu d'un title.
	$( section ).getElements( '.tips' ).each( function( el ) {
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

	// Champs en autocomplétion si nécessaire.
	tpl_addUserAutocompletion();
}

function add_option(id_td, id_input){
	
	
	theDate = new Date();
	var id = theDate.getTime()+Math.round(Math.random()*1000000000);
	
	var reg = new RegExp("(_0)","g");			//id
	var reg2 = new RegExp('(add_subsidiary\\(\\))',"g");	//fonction add/remove pour la filiale (page liste)
	var reg3 = new RegExp('(plus-circle)',"g");		//image boutton
	var reg4 = new RegExp('(add_option\\(.+\\))',"g");	//fonction add/remove
	var reg5 = new RegExp('(add_children\\(\\))',"g");	//fonction add/remove pour les enfants (page liste)
	var reg6 = new RegExp('(add_cause\\(\\))',"g");		//fonction add/remove pour les cause (page rapport workover)
	var reg7 = new RegExp('(add_criteria\\(.+\\))',"g");	//fonction add/remove pour les recherche avancé (page advanced search)
	
		
	if($(id_td) && $(id_input)){
	
		// récupération clone
		var td_a_cloner = $(id_td);
		var input_a_cloner = $(id_input);
		
		var clone_input =  input_a_cloner.cloneNode(true);
		
		
		var tmp_balise = document.createElement("div");	
		tmp_balise.id = 'div_to_remove_'+id;
		tmp_balise.className = 'div_to_remove';
		tmp_balise.appendChild(clone_input);
		tmp_balise.innerHTML = tmp_balise.innerHTML.replace(reg,"_"+id);					// met un id différent de 0.
		tmp_balise.innerHTML = tmp_balise.innerHTML.replace(reg2,'remove_option(div_to_remove_'+id+')');	// met un bouton remove a la place du bouton add
		tmp_balise.innerHTML = tmp_balise.innerHTML.replace(reg3,'cross-circle');				// met une image "remove"
		tmp_balise.innerHTML = tmp_balise.innerHTML.replace(reg4,'remove_option(div_to_remove_'+id+')');	// met un bouton remove a la place du bouton add
		tmp_balise.innerHTML = tmp_balise.innerHTML.replace(reg5,'remove_option(div_to_remove_'+id+')');	// met un bouton remove a la place du bouton add
		tmp_balise.innerHTML = tmp_balise.innerHTML.replace(reg6,'remove_option(div_to_remove_'+id+')');	// met un bouton remove a la place du bouton add
		tmp_balise.innerHTML = tmp_balise.innerHTML.replace(reg7,'remove_option(div_to_remove_'+id+')');	// met un bouton remove a la place du bouton add
		
		td_a_cloner.appendChild(tmp_balise);
		// Resets the selected element when duplicating its parent select.
		tmp_balise.getElements('select').each( function( el ){
			el.selectedIndex = '0';
		} );
		
	}
	
	return id;
	
}
//retire un element d'une page
function remove_option(id_elmt){
	
	if($(id_elmt)){
		
		$(id_elmt).dispose();	
		
	}
}
