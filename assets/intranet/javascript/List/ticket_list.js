/**
 * Mise � jour rapide d'un seul champ du ticket par popup.
 */
function updateField( id, field )
{
	openPopup('ticket.php?id='+id+'&field='+field, 'ticket_popup_' + uniqid(), 'activity=no,scrollbars=yes,width=450, height=200, top=100, left=100, resizable=yes');
}

/**
 * Navigation dans les pages de r�sultats.
 */
function changePage( page )
{
	$('page').value = page;
	var form = $( 'frm_criteria' );
	var submit = $( 'Submit' );
	if( form )
	{
		form.submit();
	}
	else if( submit )
	{
		submit.click();
	}
	return false;
}

/**
 * Contr�le de la longueur du mot-cl� et (d�)verrouillage des �l�ments o� chercher.
 */
function controlKeyword( keyword, where_class )
{
	var disabled = true;
	if( keyword.length >= global_cfg_minimum_search_keyword_length )
	{
		disabled = false;
	}
	$$( 'input.' + where_class ).each( function( el )
	{
		el.setProperty( 'disabled', disabled );
	});
}

/**
 * Tri par crit�re de s�lection.
 */
function sortBy( sort )
{
	var changed_sort = false;
	if( $('sort').value != sort )
	{
		changed_sort = true;
	}

	$('sort').value = sort;
	if( $('order').value == '' )
	{
		var new_order = 'ASC';
		if( sort == 'date'
			|| sort == 'ticket'
			|| sort == 'solution'
			|| sort == 'tck_urgency' )
		{
			new_order = 'DESC';
		}
		$('order').value = new_order;
    }
	else if( changed_sort )
	{
		var new_order = 'ASC';
		$('order').value = new_order;
    }
	else if ($('order').value == 'ASC')
	{
		$('order').value = 'DESC';
	}
	else if ($('order').value == 'DESC')
	{
		$('order').value = 'ASC';
	}

	if ($('Submit') != null)
	{
		$('Submit').click();
	}
	else
	{
		$('frm_criteria').submit();
	}
}

/**
 * Efface une date saisie dans un champ DatePicker.
 */
function eraseDate( input_id )
{
	var field = $( input_id );
	if( field )
	{
		field.value = '';
	}
	return false;
}

/**
 * Soumission du formulaire.
 */
function submitCriteria()
{
	if (validate())
	{
		$('frm_criteria').submit();
	}
}

/**
 * Validation du formulaire.
 */
function validate()
{
	if( $( 'check_tck_filter_my_tickets' )
		&& $( 'check_tck_filter_my_tickets' ).checked )
	{
		$( 'tck_filter_my_tickets' ).value = 1;
	}
	else
	{
		$('tck_filter_my_tickets').value = 0;
	}
	return true;
}

/**
 * V�rifie si de nouveaux tickets ont �t� cr��s depuis le chargement de la page, et le cas
 * �ch�ant : rafraichit la page.
 * todo: rafraichir la liste des tickets en ajax.
 */
function refreshTicketList( )
{
	// Timer cyclique.
	refreshTicketList.delay( global_cfg_time_ticket_refresh );

	// Requ�te ajax.
	var url = '/module/helpdesk/ajax/php/refresh.ticket.php?'
					+'refresh_criteria='+global_refresh_criteria;
	//prompt( '', url );
	displayRefreshingMessage( true );
	var ajaxRequest = new Request.JSON( {
									url: url,
	  								method: 'get',
	  								encoding: 'iso-8859-1',
	  								onComplete: function( jsonObj ) {
	  									getBackRefreshAnswer( jsonObj );
	  								} } ).send( );
}

/**
 * Fonction ajax de callback apr�s r�cup�ration de la r�ponse sur le rafraichissement de tickets.
 */
function getBackRefreshAnswer( jsonObj )
{
	// S�curisation de la pr�sence de r�sultats.
	if( !jsonObj )
	{
		return false;
	}

	// Mise � jour des donn�es tabulaires YTD.
	if( jsonObj.need_refresh )
	{
		// Mise � jour de la page.
		var refresh_ticket = $( 'refresh_ticket' );
		if( refresh_ticket )
		{
			refresh_ticket.set( 'text', global_label_tck_message_new_ticket );
			window.location.reload();
		}
	}
	else
	{
		// Masquage du message de mise � jour sous 3 secondes.
		var arg = Array( );
		arg['bool'] = false;
		displayRefreshingMessage.delay( global_cfg_time_ticket_message_refresh, this, arg );
	}
}

/**
 * Cache le message de rafraichissement des tickets.
 */
function displayRefreshingMessage( bool )
{
	var display = 'none';
	if( bool )
	{
		display = 'inline';
	}
	var refresh_ticket = $( 'refresh_ticket' );
	if( refresh_ticket )
	{
		refresh_ticket.setStyle( 'display', display );
	}
}

/**
 * Ev�nements au chargement de la page.
 */
window.addEvent( 'domready', function()
{
	// Pdf.
	if ($$('.action_pdf'))
	{
		$$('.action_pdf').addEvent('click', function()
		{
			var old_action = $('frm_criteria').getProperty('action');
			$('frm_criteria').action = 'ticket.action.php';
			$('frm_criteria').target = '_blank';
			$('tck_action').value = global_cfg_action_pdf;
			$('frm_criteria').submit();
			$('frm_criteria').setProperty('action', old_action);
			$('tck_action').value = '';
			$('frm_criteria').setProperty('target', '');
		});
	}

	// Xls.
	if ($$('.action_xls'))
	{
		$$('.action_xls').addEvent('click', function()
		{
			var old_action = $('frm_criteria').getProperty('action');
			$('frm_criteria').action = 'ticket.action.php';
			$('frm_criteria').target = '_blank';
			$('tck_action').value = global_cfg_action_xls;
			$('frm_criteria').submit();
			$('frm_criteria').setProperty('action', old_action);
			$('tck_action').value = '';
			$('frm_criteria').setProperty('target', '');
		});
	}
	// Composants de date: from... to...
	createFromToCalendar( 'tck_creation_begin_date', 'tck_creation_end_date' );
	createFromToCalendar( 'tck_close_begin_date', 'tck_close_end_date' );

	// Rafra�chissement de la liste des tickets.
	if( !global_advanced_search )
	{
		refreshTicketList.delay( global_cfg_time_ticket_refresh );
	}

	// Verrouillage des options de la recherche par mot-cl� si n�cessaire.
	if( $( 'keyword' ) )
	{
		controlKeyword( $( 'keyword' ).value, 'keyword_where' );
	}
});
