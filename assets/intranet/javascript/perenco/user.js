/**
 * Anciennes fonctions (pour r�trocompatibilit�).
 */
 	/**
 	 * Recherche d'utilisateur.
 	 */
	function search_user(event, inputField, outputField, completionDiv)
	{
		common_search_user(event, inputField, outputField, completionDiv, completion_user, complete_user, 'user');
	}

 	/**
 	 * Recherche de requester.
 	 */
	function search_requester(event, inputField, outputField, completionDiv)
	{
		common_search_user(event, inputField, outputField, completionDiv, completion_requester, complete_requester, 'requester');
	}

 	/**
 	 * Recherche d'utilisateur IT.
 	 */
	function search_access(event, inputField, outputField, completionDiv, option)
	{
		if( !( option instanceof Array ) )
		{
			var option = Array();
		}
		common_search_user(event, inputField, outputField, completionDiv, completion_user, complete_user, 'access', option);
	}

 	/**
 	 * Recherche d'utilisateur IT en incluant les utilisateurs g�n�riques de filiale.
 	 */
	function search_access_with_gen_user(event, inputField, outputField, completionDiv, option)
	{
		option = initOption( option );
		option['with_gen_user'] = 1;

		common_search_user(event, inputField, outputField, completionDiv, completion_user, complete_user, 'access', option);
	}

 	/**
 	 * Initialise si n�cessaire le tableau d'options � la recherche d'utilisateurs.
 	 */
	function initOption( option )
	{
		if( !( option instanceof Array ) )
		{
			var option = Array();
		}
		return option;
	}

 	/**
 	 * Recherche d'utilisateur avec email.
 	 */
	function search_email(event, inputField, completionDiv)
	{
		common_search_user(event, inputField, null, completionDiv, completion_email, complete_email, 'email');
	}




var global_index_ajax = 0;
var last_searched_value = Array();
/**
 * Traitements Ajax.
 */
	/**
	 * Recherche Ajax d'un utilisateur.
	 */
	function common_search_user(event, inputField, outputField, completionDiv, noentry_callback_function, ajaxdone_callback_function, type, option)
	{
		var d = document;
		var input = d.getElementById( inputField );
		var output = d.getElementById( outputField );
		if( !input )
		{
			return false;
		}
		var value = input.value;

		// Arguments optionnels.
		if( !( option instanceof Array ) )
		{
			var option = Array();
		}

		// Url Ajax.
		var url = '/js/template_v2/ajax/php/user.php?keyword=';
	
		// Si utilisateurs IT : url particuli�re.
		if( type == 'access' )
		{
			url = '/js/template_v2/ajax/php/access.php?keyword=';
		}
		// Si e-mail : on ne r�cup�re que la derni�re adresse saisie.
		else if( type == 'email' )
		{
			var begin_last_email = value.lastIndexOf( ',' );
			if( begin_last_email > 0)
			{
				value = value.substring( begin_last_email + 1 );
			}
			value = value.replace(/(^\s*)|(\s*$)/g,'');
		}
	
		// Parcours de la liste par touche de direction bas.
		var completion_id = d.getElementById( 'completion_' + input.id );
		if( event
			&& event.keyCode == 40
			&& completion_id
			&& completion_id.style.visibility == 'visible' )
		{
			input.blur();
			completion_id.focus();
			completion_id.selectedIndex = 0;
	    	return false;
		}
		// Handle des touches left / right.
		else if( event
			&& ( event.keyCode == 37
			|| event.keyCode == 38 ) )
		{
			// On ne renvoie pas de requ�te ajax.
			return false;
		}
		// Handle du backspace (quand la saisie n'est pas totalement effac�e).
		else if( event
			&& event.keyCode == 8
			&& value != '' )
		{
			// Suppression du pr�c�dent timeout si existant (si on appuie plusieurs fois sur backspace).
			if( input.backspace_timeout )
			{
				clearTimeout( input.backspace_timeout );
			}
			// R�ex�cution de la requ�te ajax dans 500 ms si aucun nouveau backspace n'est intervenu entretemps. 
			input.backspace_timeout = setTimeout( function() { common_search_user( null, inputField, outputField, completionDiv, noentry_callback_function, ajaxdone_callback_function, type, option); }, 500);
			return false;
		}
		// Handle de la touche suppr et du ctrl+x et du backspace lorsque la saisie est totalement effac�e.
		else if( event
			&& ( event.keyCode == 46
				|| event.keyCode == 17
				|| event.keyCode == 8 )
			&& value == '' )
		{
			var div = d.getElementById( completionDiv );
			div.innerHTML        = '';
			div.style.visibility = "hidden";
			div.style.display    = "none";
			if( output )
			{
				output.value = '';
			}
			return false;
		}
		// Si frappe en continu, on n'envoie la requ�te qu'apr�s 100 ms de pause (�vite requ�tes multiples).
		else if( event )
		{
			// Suppression du pr�c�dent timeout si existant (si on appuie plusieurs fois sur backspace).
			if( input.all_keys_timeout )
			{
				clearTimeout( input.all_keys_timeout );
			}
			// R�ex�cution de la requ�te ajax dans 100 ms si aucune nouvelle touche n'a �t� press�e entretemps. 
			input.all_keys_timeout = setTimeout( function() { common_search_user( null, inputField, outputField, completionDiv, noentry_callback_function, ajaxdone_callback_function, type, option); }, 100);
			return false;
		}
		
		// Test pour �viter de renvoyer une 2e fois la m�me valeur.
		if( input.id )
		{
			var last_search = last_searched_value[input.id];
			last_searched_value[input.id] = value;
			if( last_search == value )
			{
				return false;
			}
		}

		//alert( 'last='+last_searched_value[input.id]+' /new='+value );

		// Si la saisie est inf�rieure � 2 caract�res.
		if( value.length <= 1 )
		{
			if( value == '' )
			{
				noentry_callback_function(null, null, outputField, completionDiv);
			}
			if( output )
			{
				output.value = '';
				output.style.display = 'none';
			}
			return false;
		}
	
		// Ex�cution de la requ�te Ajax.
		url = url + value;

		// Options possibles.
		if( option['with_gen_user']
			&& option['with_gen_user'] == 1 )
		{
			url += '&with_gen_user=1';
		}

		if( !( input && input.addClass ) )
		{
			input = $( input );
		}
		if( input )
		{
			input.addClass( 'autocompletion_load' );
		}

		var myAjax = new Request( { 'url': url,
									method: 'get',
									onComplete: function( request, requestXML )
									{
										get_ajax_back(
																	global_index_ajax++,
																	value,
																	ajaxdone_callback_function,
																	requestXML,
																	inputField,
																	outputField,
																	completionDiv,
																	type
																	)
									}}).send();
		//prompt( '', url );
		//myAjax.request();
	}

	/**
	 * Cr�e le select d'autocompl�tion.
	 */
	function create_completion_select( optionList, completion_callback_function, inputField, outputField, completionDiv )
	{
		var selectList  = '<select	id="completion_'+ document.getElementById( inputField ).id +'" '+
									'size="'+ optionList.length +'" '+
									'onkeyup="javascript: '+ completion_callback_function +'( event, \''+ inputField +'\', \''+ outputField +'\', \''+ completionDiv +'\');" '+
									'onclick="javascript: '+ completion_callback_function +'( null, \''+ inputField +'\', \''+ outputField +'\', \''+ completionDiv +'\');" '+
									'style="visibility: visible;">';
		selectList      += optionList;
		selectList      += '</select>\n';
		return selectList;
	}
	
	/**
	 * Cr�e un tableau contenant les options du select d'autocompl�tion.
	 */
	function create_completion_option( requestXML, field, type )
	{
		// R�cup�ration de la liste d'users XML.
		var users  = requestXML.getElementsByTagName( 'user' );
		var nberUsers = users.length;
		var optionList = Array();
	
		// Parcours des r�sultats.
		for( var userIdx = 0; userIdx< users.length ; userIdx++ )
		{
			// R�cup�ration des diff�rents champs.
			var usr_id   = users[userIdx].getAttribute('value');
			var usr_full_name = users[userIdx].getElementsByTagName('name')[0].firstChild.data;
			var additional_field = Array();

			var field_length = field.length;
			//for( var i in field )
			for( i=0; i<field_length; i++ )
			{
				var a_field = '';
				if( users[userIdx].getElementsByTagName( field[i] )[0] )
				{
					a_field = users[userIdx].getElementsByTagName( field[i] )[0].firstChild.data;
	
					// Si liste de type 'email' : on concat�ne l'e-mail derri�re le nom.
					if( type == 'email' && field[i] == 'email' )
					{
						usr_full_name += ' ('+ a_field +')';
					}
				}
				additional_field[i] = a_field;
			}
			// Liste des options.
			optionList[userIdx] =	'<option value="'+ usr_id +':'+ additional_field.join( ':' ) +'">'+
										usr_full_name+
									'</option>\n';
		}
		return optionList;
	}

	/**
	 * G�re l'affichage du select proposant les utilisateurs.
	 */
	function update_user_list( selectList, nberUsers, completion_callback_function, inputField, outputField, completionDiv )
	{
		var d = document;
		var div = d.getElementById( completionDiv );
		var input = d.getElementById( inputField );
		var completion = d.getElementById( 'completion_' + input.id );

		// Plusieurs utilisateurs : on affiche la liste.
		if( nberUsers > 1 )
		{
			div.innerHTML        =  selectList;
	
			div.style.visibility = "visible";
			div.style.display    = "block";
			div.style.width      = input.offsetWidth;
	
			if( completion )
			{
				completion.style.visibility = "visible";
				completion.style.display    = "block";
			}
	
			completion_callback_function(null, inputField, outputField, completionDiv);
		}
		// Un seul utilisateur : on le s�lectionne automatiquement.
		else if( nberUsers == 1 )
		{
			div.innerHTML        = selectList;

			div.style.visibility = "hidden";
			div.style.display    = "none";
	
			if( completion )
			{
				completion.selectedIndex = 0;
			}
	
			completion_callback_function(null, inputField, outputField, completionDiv);
		}
		// Sinon : utilisateur invalide.
		else if( input.value != '' )
		{
			
			//hack pour paramettr� le message d'erreur en rajoutent une inpu hidden : id=msg_error_update_user_list
			if($('msg_error_update_user_list') && $('msg_error_update_user_list').value != ''){
				var msg_error_update_user_list = $('msg_error_update_user_list').value;
			}else{
				var msg_error_update_user_list = 'Invalid user, please enter a new one';
			}
						
			div.innerHTML =  '<div class="invalid">'+msg_error_update_user_list+'</div>';			
			completion_callback_function(null, inputField, outputField, completionDiv);
		}
	}



/**
 * Fonctions de compl�tion.
 */
	/**
	 * Cr�e la liste de suggestions d'un user.
	 */
	function complete_user(requestXML, inputField, outputField, completionDiv)
	{
		var optionList = create_completion_option( requestXML, Array( 'phone' ), 'user' );
		var selectList = create_completion_select( optionList, 'completion_user', inputField, outputField, completionDiv );
		var nberUsers = optionList.length;
	
		update_user_list( selectList, nberUsers, completion_user, inputField, outputField, completionDiv );
	}
	
	/**
	 * Cr�e la liste de suggestion d'un requester (avec phone et email).
	 */
	function complete_requester(requestXML, inputField, outputField, completionDiv)
	{
		var optionList = create_completion_option( requestXML, Array( 'email', 'phone' ), 'requester' );
		var selectList = create_completion_select( optionList, 'completion_requester', inputField, outputField, completionDiv );
		var nberUsers = optionList.length;
	
		update_user_list( selectList, nberUsers, completion_requester, inputField, outputField, completionDiv );
	}
	
	/**
	 * Cr�e la liste de suggestion d'un requester (avec email apparent � la suite du nom).
	 * outputField ne sert � rien pour cette fonction pr�cise (utilis� seulement pour l'abstraction entre les diff�rentes fonctions)
	 */
	function complete_email(requestXML, inputField, outputField, completionDiv)
	{
		var optionList = create_completion_option( requestXML, Array( 'email', 'phone' ), 'email' );
		var selectList = create_completion_select( optionList, 'completion_email', inputField, null, completionDiv );
		var nberUsers = optionList.length;
	
		update_user_list( selectList, nberUsers, completion_email, inputField, null, completionDiv );
	}
	

	/**
	 * M�thode de retour des requ�tes Ajax : permet de court-circuiter les requ�tes anciennes
	 * qui arrivent apr�s des requ�tes plus r�centes (�vite la d�synchronisation entre le terme
	 * recherch� et la liste d'utilisateurs propos�s).
	 */
	function get_ajax_back( query_index_ajax, search_value, ajaxdone_callback_function, requestXML,
																	inputField,
																	outputField,
																	completionDiv,
																	type )
	{
		var d = document;
		var input = d.getElementById( inputField );

		//document.getElementById( 'all_url' ).innerHTML += 'input.index_ajax='+input.index_ajax+' / query_index_ajax='+query_index_ajax+'<br>';

		// Si l'identifiant ajax de l'input de recherche est d�j� plus grand que l'id de la requ�te
		// ajax qui vient d'�tre retourn�, on arr�te l'action.
		if( input.index_ajax && input.index_ajax > query_index_ajax )
		{
			return false;
		}
		input.index_ajax = query_index_ajax;

		// Si la valeur cherch�e dans le retour d'ajax ne correspond pas � la valeur actuelle de l'input,
		// on drope cette recherche (une autre est intervenue entretemps).
		// SAUF s'il s'agit d'une recherche d'e-mails, car ceux-ci sont concat�n�s (recherche != input.value). 
		if( type != 'email'
			&& search_value != input.value )
		{
			return false;
		}

		// Poursuite du traitement du retour Ajax.
		ajaxdone_callback_function( requestXML, inputField, outputField, completionDiv );
	}
	
	
	/**
	 * Compl�te le champ utilisateur.
	 */
	function completion_user(event, inputField, outputField, completionDiv)
	{
		var saveField = Array;
		saveField[0] = outputField;
		saveField[1] = 'acc_in_service_phone_number';
		common_completion_user( event, saveField, inputField, outputField, completionDiv, 'user' );
	}
	
	/**
	 * Compl�te le champ requester.
	 */
	function completion_requester(event, inputField, outputField, completionDiv)
	{
		var saveField = Array;
		saveField[0] = outputField;
		saveField[1] = 'tck_email';
		saveField[2] = 'tck_phone_number';
		common_completion_user( event, saveField, inputField, outputField, completionDiv, 'requester' );
	}
	
	/**
	 * Compl�te le champ email.
	 */
	function completion_email(event, inputField, outputField, completionDiv)
	{
		var saveField = Array;
		saveField[1] = inputField;
		common_completion_user( event, saveField, inputField, null, completionDiv, 'email' );
	}







/**
 * Cr�e la liste de suggestions d'utilisateurs.
 */
function common_completion_user( event, saveField, inputField, outputField, completionDiv, type )
{
	var d = document;
	var div = d.getElementById( completionDiv );
	var input = document.getElementById( inputField );
	var completion;

	if( input )
	{
		completion = d.getElementById( 'completion_' + input.id );
		//alert( 'completion_' + input.id );
	}

	if( event != null )
	{
		// Handle de la fl�che vers le haut.
		if( completion.selectedIndex == 0 && event.keyCode == '38' )
		{
			completion.blur();
			input.focus();
			common_completion_user(null, saveField, inputField, outputField, completionDiv);
	    }
	    // Handle de la touche entr�e.
	    else if( event.keyCode == 13 )
	    {
			common_completion_user(null, saveField, inputField, outputField, completionDiv);
			return;
	    }
	    else
	    {
			return;
		}
	}

	if( !( input && input.removeClass ) )
	{
		input = $( input );
	}
	if( input )
	{
		input.removeClass( 'autocompletion_load' );
	}

	// Gestion du choix d'un utilisateur dans la liste.
	if( event == null
		&& input
		&& completion
		&& completion.selectedIndex >= 0 )
	{
		if( type != 'email' )
		{
			input.value  = completion.options[completion.selectedIndex].text;
		}

		// V�rification que l'e-mail n'est pas d�j� pr�sent.
		var already_notified = false;

		var results   = completion.options[completion.selectedIndex].value;
		userData = results.split(':');

		// Gestion de la liste de type e-mail.
		if( type == 'email' )
		{
			var tck_additional_email = input.value;
			var begin_last_email = tck_additional_email.lastIndexOf( ',' );

			// Si le contr�le a d�j� �t� lev�, on ne le r�ex�cute pas.
			if( tck_additional_email.substr( -2 ) == ', ' )
			{
				return false;
			}

			// D�j� pr�sent dans les notifi�s existant ?
			var send_to = d.getElementsByName( 'sol_send_to[]' );
			if( send_to.length )
			{
				var send_to_length = send_to.length;
				for( var i=0; i<send_to_length; i++ )
				{
					if( trim( send_to[i].value ) == userData[1] )
					{
						already_notified = true;
						break;
					}
				}
			}

			// D�j� pr�sent dans les additional emails ?
			if( tck_additional_email.indexOf( userData[1] ) != -1 )
			{
				already_notified = true;
			}

			// V�rification qu'il y a un e-mail.
			if( trim( userData[1] ) == '' )
			{
				alert( 'This user does not have a valid e-mail.' );
				input.focus();
			}
			// Si d�j� notifi�, message d'info.
			else if( already_notified )
			{
				alert( 'This e-mail is already present in the list of additional recipients.' );
				input.focus();
			}
			// Si pas encore notifi�, on l'ajoute.
			else
			{
				input.value = tck_additional_email.substr( 0, begin_last_email );

				// Gestion du s�parateur des e-mails.
				if( tck_additional_email.lastIndexOf( ',' ) != -1 )
				{
					input.value       = input.value + ', ';
				}
				// Ajout de la valeur.
				input.value = input.value + userData[1];

				if( input.value != '' )
				{
					input.value = input.value + ', ';
				}
			}
		}
		// Gestion des champs de type autre que e-mail.
		else
		{
			for( var i in saveField )
			{
				if( d.getElementById( saveField[i] ) && typeof( userData[i] ) != 'undefined' )
				{
					d.getElementById( saveField[i] ).value = userData[i];
				}
			}
		}

		// On cache la div si un e-mail valide a �t� ajout�.
		if( div
			&& !already_notified )
		{
			div.innerHTML        = '';
			div.style.visibility = "hidden";
			div.style.display    = "none";
		}
	}
	else
	{
		if( type == 'requester' )
		{
			for( var i in saveField )
			{
				if( d.getElementById( saveField[i] ) )
				{
					d.getElementById( saveField[i] ).value = '';
				}
			}
		}
		else if( type == 'user' )
		{
			d.getElementById(outputField).value = '';
		}

		if( div )
		{
	    	div.style.visibility = "visible";
	    	div.style.display    = "block";
	    }
	}
}


