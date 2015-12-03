// Execute une action du planning
function planning_action(action) {

	if ($('planning_form') == null){
		return;
	}
	
	$('planning_table').setOpacity(0.9);
	
	if ($('planning_submit') != null) {
		
		$('planning_submit').removeClass('button_save');
		$('planning_submit').setProperty('disabled', true);
	
	}
	
	var url = '/module/planning/ajax/php/planning.action.php?action='+action;
	//prompt( '', url );
	//document.write( $('planning_form').innerHTML ); return false;
	var myAjax = new Request({'url': url, method:'post', data:$('planning_form'), onComplete:function(request, requestXML) { complete_planning_action(requestXML);}});
	myAjax.send();

}


function complete_planning_action(requestXML) {

  var nberErrors;
  
  if (requestXML != null) {

    var error     = requestXML.getElementsByTagName('error');
    nberErrors    = error.length

  }

  if (nberErrors == 1) {

    alert('Error:' + error[0].firstChild.data);

    if ($('planning_table') != null)
      $('planning_table').setOpacity(1);

    if ($('planning_submit') != null) {

      $('planning_submit').addClass('button_save');
      $('planning_submit').setProperty('disabled', false);

    }
    return;

  }

  if (window.opener.document.getElementById('planning_search') != null && nberErrors == 0) { // Relance la recherche et ferme la fenetre courante
    window.opener.document.getElementById('planning_search').click();
    window.close();
    return;

  }

  $('planning_table').setOpacity(0);

  if ($('planning_submit') != null) {

    $('planning_submit').addClass('button_save');
    $('planning_submit').setProperty('disabled', false);

  }

  return;

}

// Charge la timesheet selectionnée
function loadTimesheet(outputField, subsidiaryId, year, month, timesheetId) {

  if (document.getElementById(outputField) == null)
    return;

  if (document.getElementById('subsidiaryId') != null) {

    select_subsidiaryId = document.getElementById('subsidiaryId');

    for (subsidiaryIdx = 0 ; subsidiaryIdx < select_subsidiaryId.length ; subsidiaryIdx++) {

      if (select_subsidiaryId[subsidiaryIdx].value == subsidiaryId)
        select_subsidiaryId.selectedIndex = subsidiaryIdx;

    } // End for

  }

  if (document.getElementById('year') != null) {

    select_year = document.getElementById('year');

    for (yearIdx = 0 ; yearIdx < select_year.length ; yearIdx++) {

      if (select_year[yearIdx].value == year)
        select_year.selectedIndex = yearIdx;

    } // End for

  }

  if (document.getElementById('month') != null) {

    select_month = document.getElementById('month');

    for (monthIdx = 0 ; monthIdx < select_month.length ; monthIdx++) {

      if (select_month[monthIdx].value == month)
        select_month.selectedIndex = monthIdx;

    } // End for

  }

  if (document.getElementById('timesheetId') != null){
  	if(timesheetId){
   		document.getElementById('timesheetId').value = timesheetId;
   	}else{
   		document.getElementById('timesheetId').value = '';
	}
  }

  var outputField   = document.getElementById(outputField);

  var fieldsets     = document.getElementsByTagName('fieldset')

  for (fieldsetIdx = 0 ; fieldsetIdx < fieldsets.length ; fieldsetIdx ++ ) {

    if (timesheetId > 0 && fieldsets[fieldsetIdx].id == 'timesheet_' + timesheetId) {

      fieldsets[fieldsetIdx].className = 'timesheet_selected';

      if (document.getElementById('timesheet_view_' + timesheetId) != null) {

        document.getElementById('timesheet_view_' + timesheetId).href      = 'javascript:search_timesheets(\''+outputField.id+'\');';
        document.getElementById('timesheet_view_' + timesheetId).innerHTML = 'Show closings';

      }

      continue;

    }
    else if (fieldsets[fieldsetIdx].id == 'timesheet_' + subsidiaryId + '_' + year + '_' + month && timesheetId == '') {

      fieldsets[fieldsetIdx].className = 'timesheet_selected';

      if (document.getElementById('timesheet_view_' + subsidiaryId + '_' + year + '_' + month) != null) {

        document.getElementById('timesheet_view_' + subsidiaryId + '_' + year + '_' + month).href      = 'javascript:search_timesheets(\''+outputField.id+'\');';
        document.getElementById('timesheet_view_' + subsidiaryId + '_' + year + '_' + month).innerHTML = 'Show closings'

      }

      continue;

    }

    fieldsets[fieldsetIdx].style.visibility = 'hidden';
    fieldsets[fieldsetIdx].style.display    = 'none';
    fieldsets[fieldsetIdx].style.height    = 'auto';

  }

  if (timesheetId > 0)
    search_planning('timesheet_planning_' + timesheetId, timesheetId);
  else
    search_planning('timesheet_planning_' + subsidiaryId +'_'+year+'_'+month, '');

}

/*
function testie(){
	alert('1');
	$$('.select_subsidiary').each( function(el) {
    	//alert(el.id + ' - '+el.value);
    });
}*/

// Récupere le planning
function search_planning(outputField, timesheetId) {
	alert('m');
  if ($('criteria_form') == null)
    return;

  if (document.getElementById(outputField) == null)
    return;

  // Chargement de la page
  document.getElementById(outputField).innerHTML = '<div class="loading">Loading ... </div>';

  var myAjax = new Request(
	{
		'url':'/base_loisir/attendance/planning/ajax/php/planning.php', 
		method:'post', 
		data:$('criteria_form'), 
		onComplete:function(request, requestXML) {complete_planning(requestXML, outputField, timesheetId)}
	});
  myAjax.send();
}

/**
 * Retour ajax des données du planning.
 */
function complete_planning( requestXML, outputField, timesheetId )
{
	var outputField = document.getElementById( outputField );
	if( outputField == null )
	{
		return;
	}

	// User : infos.
	var user_max_split_rows = 10;
	var user_max_length = 200;
	var today = new Date();
	var todayDate = today.getDate();
	var todayMonth = today.getMonth();
	var todayFullYear = today.getFullYear();

	// Day : infos.
	var day_width = 20;

	// Tableaux
	var tab_day             = new Array("Su", "Mo", "Tu", "We", "Th", "Fr", "Sa");
	var tab_month           = new Array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sept", "Oct", "Nov", "Dec");
	var tab_activity        = new Array;

	// Parcours du XML.
	if( requestXML != null )
	{
		var planning      = requestXML.getElementsByTagName('planning');
		var users         = requestXML.getElementsByTagName('u');
		var legends       = requestXML.getElementsByTagName('l');
		var abreviations  = requestXML.getElementsByTagName('s');
		var dates         = requestXML.getElementsByTagName('t');
		var error         = requestXML.getElementsByTagName('error');

		var nberUsers        = users.length
		var nberLegends      = legends.length
		var nberAbreviations = abreviations.length
		var nberDates        = dates.length
		var nberErrors       = error.length
		var nberPlannings    = planning.length
	}
	else
	{
		nberUsers = 0;
	}
	outputField.innerHTML     = '';

	if( nberPlannings == 1 )
	{
		var user_max_split_rows = planning[0].getAttribute('limit_user');
		var file_xhr            = planning[0].getAttribute('file');
	}

	if( nberErrors == 1 )
	{
		outputField.innerHTML = '<div class="error">'+error[0].firstChild.data+'</div>';
		return;
	}

	// Traitement des lignes d'utilisateurs.
	if( nberUsers > 0 )
	{
		// Activités (légendes).
		if( nberLegends > 0 )
		{
			var nb_line = 1;
			var tr_legend = new Array;
			var tab_color = new Array;
			var table_legend = document.createElement('table');
			table_legend.className = 'legend';
			var tbody_legend = document.createElement('tbody');
			tr_legend[nb_line]    = document.createElement('tr');
			
			var cpt = 0;
			var max_td = 8;
			


			// Parcours des activités.
			for( var legendIdx = 0; legendIdx < nberLegends; legendIdx ++ )
			{
				if(cpt > max_td){
					cpt = 0;
					tbody_legend.appendChild(tr_legend[nb_line]);
					nb_line = nb_line +1;
					tr_legend[nb_line]    = document.createElement('tr');
				}
				
				cpt = cpt +1;	
				
				
				var current_legend = legends[legendIdx];
				var legend_color       = current_legend.getAttribute('c');
				var legend_borderColor = current_legend.getAttribute('b');
				var legend_ref         = current_legend.getAttribute('i');
				var legend_abr         = current_legend.getAttribute('a');
				var is_erase           = current_legend.getAttribute('e');
				var legend_data        = current_legend.firstChild.data;

				if( legend_ref > 0 )
				{
					tab_color[legend_ref]    		= legend_color;
					tab_activity[legend_ref] 		= legend_data;
				}
				
				//attention, on n'affice plus dans la legende les activité effacé (elle reste visible dans le planning)
				if(is_erase == 0){
					var td_color = document.createElement('td');
					
					var div_color = document.createElement('div');
		
					if( legend_color != null )
						div_color.style.background = legend_color;
	
					if( legend_borderColor != null )
						div_color.style.border = '1px solid ' + legend_borderColor;
	
					div_color.className = 'color';
					div_color.innerHTML = '&nbsp;&nbsp;&nbsp;&nbsp;';
	
					var td_label = document.createElement('td');
					td_label.innerHTML = legend_data;
					td_label.width = "100px";
	
					tr_legend[nb_line].appendChild(td_color);
					tr_legend[nb_line].appendChild(td_label);
					td_color.appendChild(div_color);
				}
			}

			tbody_legend.appendChild(tr_legend[nb_line]);
			table_legend.appendChild(tbody_legend);
		}

		// Abréviations des filiales.
		if( nberAbreviations > 0 )
		{
			var tab_abreviation = new Array;
			var tab_subsidiary = new Array;

			for( var abreviationIdx = 0; abreviationIdx < nberAbreviations; abreviationIdx ++ )
			{
				var current_abreviation = abreviations[abreviationIdx];
				var abreviation_subsidiary   = current_abreviation.getAttribute('i');
				var abreviation_value        = current_abreviation.getElementsByTagName('a')[0].firstChild.data;
				var abreviation_name         = current_abreviation.getElementsByTagName('n')[0].firstChild.data;

				tab_abreviation[abreviation_subsidiary] = abreviation_value;
				tab_subsidiary[abreviation_subsidiary]  = abreviation_name;
			}
		}

		// Dates journalières.
		if( nberDates > 0 )
		{
			var tab_timestamp        = new Array;
			var tab_date_dayW        = new Array;
			var tab_date_date        = new Array;
			var tab_date_month       = new Array;
			var tab_date_year        = new Array;
			var input_timestamp		 = $('timestamp');

			for( var dateIdx = 0; dateIdx < nberDates; dateIdx ++ )
			{
				var current_timestamp  = dates[dateIdx];
				var date_ref           = current_timestamp.getAttribute('i');
				var date_value         = current_timestamp.getAttribute('v');

				if( dateIdx == 0
					&& input_timestamp != null )
				{
					input_timestamp.value = date_value;
				}

				tab_timestamp[date_ref]      = date_value;
				tab_date_dayW[date_ref]      = current_timestamp.getAttribute('w');
				tab_date_date[date_ref]      = current_timestamp.getAttribute('d');
				tab_date_month[date_ref]     = parseInt(current_timestamp.getAttribute('m')-1);
				tab_date_year[date_ref]      = current_timestamp.getAttribute('y');
			}
		}
		else
		{
			return false;
		}

		// Création du tableau HTML de planning.
		var table_planning = document.createElement('table');
		table_planning.className  = 'planning';
		table_planning.id         = 'planning';

		var thead_planning   = document.createElement('thead');
		var tbody_planning   = document.createElement('tbody');

		//var tr_year       = document.createElement('tr');
		var tr_daysOfWeek = document.createElement('tr');
		tr_daysOfWeek.className = 'header';
		var tr_date       = document.createElement('tr');
		tr_date.className = 'header';
		var tr_month      = document.createElement('tr');
		tr_month.className = 'header';

		var td_daysOfWeek = document.createElement('td');
		td_daysOfWeek.className = 'dayW';
		var td_date       = document.createElement('td');
		td_date.className = 'day';
		var td_month      = document.createElement('td');
		td_month.className = 'month';
		//var td_year       = document.createElement('td');

		// Lignes d'utilisateurs.
		for( var userIdx = 0; userIdx < nberUsers; userIdx++ )
		{
			var current_user = users[userIdx];
			var user_ref     = current_user.getAttribute('i');
			var user_name    = current_user.getElementsByTagName('n')[0].firstChild.data;
			var user_subsidiary_id   = current_user.getAttribute('s');
			var user_subsidiary_abbreviation = tab_abreviation[user_subsidiary_id];
			

			var tr_user          = document.createElement('tr');
			tr_user.id = 'u'+user_ref;
			tr_user.className = 'user_line';

			if( userIdx == 0 )
			{
				tr_daysOfWeek.appendChild(td_daysOfWeek);
				tr_date.appendChild(td_date);
				tr_month.appendChild(td_month);
				//tr_year.appendChild(td_year);
			}

			var td_user       = document.createElement('td');
			td_user.className = 'user';
			td_user.setAttribute('ref', user_ref);

			// Création des liens vers Staff.
			var a_user = document.createElement('a');
			a_user.setAttribute('href', '/module/staff?id='+user_ref);
			a_user.innerHTML = user_name;
			if( user_name.length > user_max_length )
			{
				user_max_length = user_name.length;
			}
			td_user.appendChild( a_user );
			tr_user.appendChild( td_user );

			// Initialisation.
			var nberDaysPerMonth = new Array;
			var monthInfos       = new Array;
			var yearInfos        = new Array;
			var days = current_user.getElementsByTagName('d');
			var nberDays = days.length;

			// Parcours des journées.
			for( var dayIdx = 0; dayIdx < nberDays; dayIdx ++ )
			{
				var current_days = days[dayIdx];

				// Activity.
				var am             = current_days.getAttribute('a'); // Matin
				var pm             = current_days.getAttribute('p'); // Après-midi
				var full           = current_days.getAttribute('f'); // Matin & Après-midi (Journée entiere)
			
				// Activity.
				var abreviation_full = current_days.getAttribute('sf'); // Subsidiary ID
				var abreviation_am   = current_days.getAttribute('sa'); // Subsidiary ID (Matin)
				var abreviation_pm   = current_days.getAttribute('sp'); // Subsidiary ID (Après-midi)

				// Timesheet.
				var timesheet_full = current_days.getAttribute('tf'); // Planning clos
				var timesheet_am   = current_days.getAttribute('ta'); // Planning clos
				var timesheet_pm   = current_days.getAttribute('tp'); // Planning clos

				// Locked.
				var locked_full = current_days.getAttribute('lf'); // Planning verrouillé
				var locked_am   = current_days.getAttribute('la'); // Planning verrouillé
				var locked_pm   = current_days.getAttribute('lp'); // Planning verrouillé
				
				//comment
				var comment_full = current_days.getAttribute('cf'); // Planning verrouillé
				var comment_am   = current_days.getAttribute('ca'); // Planning verrouillé
				var comment_pm   = current_days.getAttribute('cp'); // Planning verrouillé
				
				var planning_rights = current_days.getAttribute('r'); // Droit sur le planning
				var day_ref         = current_days.getAttribute('i'); // Date de référence (timestamp)

				var current_month     = tab_date_month[day_ref];
				var current_dayW      = tab_date_dayW[day_ref];
				var current_date      = tab_date_date[day_ref];
				var current_year      = tab_date_year[day_ref];

				if( dayIdx == 0 )
				{
					var referenceYear  = current_year;
					var referenceMonth = current_month;
				}
				else
				{
					if( referenceYear != current_year
						&& current_month == 0 )
					{
						var referenceMonth = current_month;
					}
				}

				// Calcul des années et mois.
				var keyYear   = current_year  - referenceYear;
				var keyMonth  = current_month - referenceMonth;
				if( nberDaysPerMonth[keyYear] == null )
				{
					nberDaysPerMonth[keyYear] = new Array;
					monthInfos[keyYear] = new Array;
				}
				if( nberDaysPerMonth[keyYear][keyMonth] == null )
				{
					nberDaysPerMonth[keyYear][keyMonth] = 0;
				}
				nberDaysPerMonth[keyYear][keyMonth]++;
				monthInfos[keyYear][keyMonth] = current_month;
				yearInfos[keyYear] = current_year;

				// Initialisation de la classe css de la journée.
				var dayClassName = '';
				if( current_dayW == 0
					|| current_dayW == 6 )
				{
					dayClassName += 'WE';
				}
				else
				{
					dayClassName += 'day';
				}

				// Gestion des classes CSS.
				var td_day = document.createElement('td');
				td_day.setAttribute('name', 'day');
				td_day.id = user_ref +':'+ day_ref;
				td_day.className   = dayClassName;
				if( current_date == todayDate
					&& current_month == todayMonth
					&& current_year == todayFullYear )
				{
					td_day.className += ' today';
				}
				if( userIdx == 0 )
				{
					var td_dayW = document.createElement('td');
					td_dayW.className = 'dayW';
					td_dayW.innerHTML = tab_day[current_dayW];

					var td_date = document.createElement('td');
					td_date.className = dayClassName;
					td_date.innerHTML = current_date;
					if( current_date == todayDate
						&& current_month == todayMonth
						&& current_year == todayFullYear )
					{
						td_date.className += ' today';
					}
				}

				// Initialisation.
				tab_user_activity = '';
				tab_user_color    = '';

				// Définition des couleurs des cases.
				// Journée entière.
				if( full != null
					&& full != ''
					&& !((am != null && am != '')
						|| (pm != null && pm != '')))
				{
					if( timesheet_full == true )
					{
						td_day.className += ' t';
					}
					if( locked_full == true )
					{
						td_day.className += ' l';
					}

					// Tableau des utilisateurs.
					tab_user_activity = tab_activity[full];
					tab_user_color    = tab_color[full];
					td_day.style.backgroundColor = tab_color[full];

					if( abreviation_full > 0
						&& tab_abreviation[abreviation_full] != null )
					{
						td_day.innerHTML = tab_abreviation[abreviation_full];
					}
				}
				// Il y a une journée entière plus une demi-journée.
				else if( full != null
					&& full != '' )
				{
					// On segmente la journée entière en deux demi-journées.
					if( !am )
					{
						var am = full;
					}

					if( !pm )
					{
						var pm = full;
					}
				}

				// Demi-journée (matin ou après-midi).	
				if( ( am != null
						&& am != '' )
					|| ( pm != null
						&& pm != '' ))
				{
					// Matin.
					var div_am = document.createElement('div');
					div_am.className = dayClassName + ' am';

					if( abreviation_am > 0
						&& tab_abreviation[abreviation_am] != null )
					{
						div_am.innerHTML = tab_abreviation[abreviation_am];
					}

					if( tab_color[am] != '' )
					{
						//div_am.setAttribute('a', am);
						div_am.style.backgroundColor = tab_color[am];
					}

					if( timesheet_am == true )
					{
						div_am.className += ' t';
					}

					if( locked_am == true )
					{
						div_am.className += ' l';
					}

					div_am.appendChild(document.createTextNode(' '));

					if( am != null
						&& am != '' && am > 0 )
					{
						tab_user_activity = tab_activity[am];
					}

					if( am != null
						&& am != '' && am > 0 )
					{
						tab_user_color    = tab_color[am];
					}

					// Séparateur.
					tab_user_activity += ':';
					tab_user_color    += ':';

					// Après-midi.
					var div_pm = document.createElement('div');
					div_pm.className = dayClassName + ' pm';

					if( abreviation_pm > 0
						&& tab_abreviation[abreviation_pm] != null )
					{
						div_pm.innerHTML = tab_abreviation[abreviation_pm]
					}

					if( tab_color[pm] != '' )
					{
						//div_pm.setAttribute('a', pm);
						div_pm.style.backgroundColor = tab_color[pm];
					}

					if( timesheet_pm == true )
					{
						div_pm.className += ' t';
					}

					if( locked_pm == true )
					{
						div_pm.className += ' l';
					}

					div_pm.appendChild(document.createTextNode(' '));
					td_day.appendChild(div_am);
					td_day.appendChild(div_pm);

					if( pm != null
						&& pm != '' && pm > 0 )
					{
						tab_user_activity += tab_activity[pm];
					}
					if( pm != null
						&& pm != '' && pm > 0 )
					{
						tab_user_color    += tab_color[pm];
					}
				} 

				// Tooltip.
				var day_activity = '';
				var day_title = current_date +' '+ tab_month[current_month] +' '+ current_year +' ('+ tab_day[current_dayW] +')';

				// Tableau des activités.
				/* //old, a la place de l'activité, on met le commentaire maintenant
				if( tab_user_activity != null )
				{
					var tab_user_activity_split = tab_user_activity.split(':');
					var tab_user_color_split    = tab_user_color.split(':');
					if( tab_user_activity_split.length >= 2
						&& tab_user_color_split.length >= 2 )
					{
						if( tab_user_color_split[0] != ''
							&& tab_user_activity_split[0] != '' )
						{
							day_activity = '<div style="color:'+tab_user_color_split[0]+'">' + tab_user_activity_split[0] + '</div>';
						}

						if( tab_user_color_split[1] != ''
							&& tab_user_activity_split[1] != '' )
						{
							day_activity += '<div style="color:'+tab_user_color_split[1]+'">' + tab_user_activity_split[1] + '</div>';
						}

						if( tab_user_color_split[2]
							&& tab_user_activity_split[2] )
						{
							day_activity += '<div style="color:'+tab_user_color_split[2]+'">' + tab_user_activity_split[2] + '</div>';
						}

						if( tab_user_color_split[3]
							&& tab_user_activity_split[3] )
						{
							day_activity += '<div style="color:'+tab_user_color_split[3]+'">' + tab_user_activity_split[3] + '</div>';
						}
					}
					else
					{
						if( tab_user_color
							!= '' && tab_user_activity != '' )
						{
							day_activity = '<div style="color:'+tab_user_color+'">' + tab_user_activity + '</div>';
						}
					}
				}
				else
				{
					day_activity = '';
				}
				*/
				//Le comment est encodé en url, on doit fair eun urldecode
				if( comment_full != null ){
					day_activity +=  '<div>'+unescape(comment_full.replace(/\+/g,  " "))+'</div>' ;
				}
				if( comment_am != null ){
					day_activity +=  '<div>'+unescape(comment_am.replace(/\+/g,  " "))+'</div>' ;				
				}
				if( comment_pm != null){
					day_activity +=  '<div>'+unescape(comment_pm.replace(/\+/g,  " "))+'</div>' ;			
				}
				
				var user_subsidiary = "";
				//en cas de mission, indiquer la filiale d'origine de l'utilisateur //ticket 1111100020 
				if((am == 3 || pm == 3 || full == 3) && user_subsidiary_abbreviation != ""){
					user_subsidiary = " ("+user_subsidiary_abbreviation+")";
				}
				

				// Popups de mise à jour.
				td_day.alt = day_title;
				td_day.text = '<b>' + user_name + user_subsidiary + '</b>' + day_activity;
				td_day.rights = planning_rights;

				// Masquage de la popup.
				td_day.onmouseout = hidePopup;

				// Information au survol.
				td_day.onmouseover = function()
				{
					var element = $( this );
					if( element.rights
						&& !element.hasClass( 'finger' ) )
					{
						element.className += ' finger';
					}
					//overlib( element.text, PADX, 20, 20, CAPTION, element.alt, CENTER, TEXTCOLOR, '#000000', CAPCOLOR, '#ffffff', FGCOLOR, '#eeeeee', WIDTH, 150, OFFSETY, 20);
					popupOutline( element.alt +'<br />'+ element.text );
				}

				// Menu de modification.
				td_day.onclick = function ()
				{
					var element = $( this );
					if( element.rights
						&& !element.hasClass( 'finger' ) )
					{
						element.className += ' finger';
					}
					spm(element.id, element.rights );
				};

				if( userIdx == 0 )
				{
					tr_date.appendChild( td_date );
					tr_daysOfWeek.appendChild( td_dayW );
				}

				// Création d'un objet contenant les paramètres de date,
				// rattaché à la cellule td du jour.
				td_day.date = new Object();
				td_day.date.day = tab_date_date[day_ref];
				td_day.date.month = tab_date_month[day_ref];
				td_day.date.year = tab_date_year[day_ref];
				td_day.date.timestamp = tab_timestamp[day_ref];
				tr_user.appendChild(td_day);
			}

			// En-têtes d'années et mois.
			if( userIdx == 0 )
			{
				for( var yearIdx = 0; yearIdx < nberDaysPerMonth.length; yearIdx ++ )
				{
					var nberDaysPerYear = 0;
					for( var monthIdx = 0; monthIdx < nberDaysPerMonth[yearIdx].length; monthIdx ++ )
					{
						nberDaysPerYear += nberDaysPerMonth[yearIdx][monthIdx];
						var td_month = document.createElement('td');
						td_month.colSpan = nberDaysPerMonth[yearIdx][monthIdx];
						td_month.style.textAlign = 'center';
						td_month.className = 'month';
						td_month.innerHTML = tab_month[monthInfos[yearIdx][monthIdx]];
						// Un seul jour: le mois + l'année ne tiennent pas dans la cellule.
						if( nberDaysPerMonth[yearIdx][monthIdx] > 1 )
						{
							td_month.innerHTML +=  ' '+ yearInfos[yearIdx];
						}
						tr_month.appendChild(td_month);
					}

					/*var td_year = document.createElement('td');
					td_year.colSpan = nberDaysPerYear;
					td_year.className = 'year';
					td_year.innerHTML = yearInfos[yearIdx];
					tr_year.appendChild(td_year);*/
				}
				//thead_planning.appendChild( tr_year );
				thead_planning.appendChild( tr_month );
				thead_planning.appendChild( tr_daysOfWeek );
				thead_planning.appendChild( tr_date );
			}
			tbody_planning.appendChild( tr_user );

			if( (userIdx+1)%user_max_split_rows == 0
				&& userIdx > 0
				&& userIdx+1 != nberUsers )
			{
				/*
				var tr_blank = document.createElement('tr');
				tr_blank.style.background = outputField.style.background;
				td_blank = document.createElement('td');
				td_blank.colSpan = nberDays+2;
				tr_blank.appendChild(td_blank);
				tbody_planning.appendChild(tr_blank);
				*/

				//tbody_planning.appendChild(tr_year.cloneNode(true));
				var new_tr_month = tr_month.cloneNode(true);
				new_tr_month.className = 'header';
				var new_tr_daysOfWeek = tr_daysOfWeek.cloneNode(true);
				new_tr_daysOfWeek.className = 'header';
				var new_tr_date = tr_date.cloneNode(true);
				new_tr_date.className = 'header';
				tbody_planning.appendChild(new_tr_month);
				tbody_planning.appendChild(new_tr_daysOfWeek);
				tbody_planning.appendChild(new_tr_date);
			}
		}

		table_planning.appendChild(thead_planning);
		table_planning.appendChild(tbody_planning);
		
		var new_width = nberDays*day_width + user_max_length*1.3;
		outputField.style.width = new_width+'px';
		outputField.appendChild(table_legend);
		outputField.appendChild(table_planning);

		// Bouton d'impression.
		if( file_xhr != '' ){
			
			
			//list critere de recherche			
			var cpt_critere = 0;			
			
			
			
			if($('myRights') && $('myRights').checked){
				list_critere = '?myRights=1';
				cpt_critere = cpt_critere +2;
			}else{
				
				list_critere = '?status='+$('status').value;
			
				if($('b2b') && $('b2b').checked == true){
					list_critere += '&b2b=1';
					cpt_critere = cpt_critere +1;
				}
				
				if($('month') && $('year')){
					cpt_critere = cpt_critere +1;
				}
				
				if($('year')){
					list_critere += '&year='+$('year').value;
				}
				
				if($('month')){
					list_critere += '&month='+$('month').value;
				}	
						
				if($('location_id')){
					list_critere += '&location_id='+$('location_id').value;
					cpt_critere = cpt_critere +1;
				}			
						
				$$('input.input_user').each( function(el) { 
					if(el.value != '' && el.value > 0){
						list_critere += '&'+el.id+'='+el.value;
						cpt_critere = cpt_critere +1;
					}
				});			
				$$('select.select_subsidiary').each( function(el) { 				
					if(el.value != '0'){
						list_critere += '&'+el.id+'='+el.value;					
						cpt_critere = cpt_critere +1;
					}
				});
				$$('select.select_department').each( function(el) { 
					if(el.value != '0'){
						list_critere += '&'+el.id+'='+el.value;
						cpt_critere = cpt_critere +1;
					}
				});
				$$('select.select_activity').each( function(el) { 
					if(el.value != '0'){
						list_critere += '&'+el.id+'='+el.value;
						cpt_critere = cpt_critere +1;
					}
				});
				
				if(timesheetId > 0){
					list_critere += '&timesheetId='+timesheetId;
				}
				
				if($('timesheet') && $('timesheet').value == 1){
					list_critere += '&timesheet=1';
					cpt_critere = cpt_critere +2;
				}
				
				if($('matricule2_p') && $('matricule2_b') && ($('matricule2_p').checked || $('matricule2_b').checked)){
					if($('matricule2_p').checked && $('matricule2_b').checked){
						list_critere += '&matricule=1';
					}else if($('matricule2_p').checked ){
						list_critere += '&matricule2_p=1';
					}else if($('matricule2_b').checked ){
						list_critere += '&matricule2_b=1';
					}
					
					cpt_critere = cpt_critere +1;
				}
			}
			
			
			if($('begin') && $('end')){
				cpt_critere = cpt_critere +1;
			}
			if($('begin')){
				list_critere += '&begin='+$('begin').value;					
			}
			
			if($('end')){
				list_critere += '&end='+$('end').value;
			}
			
			if(cpt_critere > 2){
				var a_print = document.createElement('a');
				a_print.className = 'tpl_button_save';	//old//button_pdf
				a_print.style.backgroundImage = "url(/module/image/shadowless/document-pdf.png)";
				a_print.innerHTML = 'Extract your planning in PDF file';
				a_print.setAttribute('href', '../manage/download_pdf.php'+list_critere);
				a_print.setAttribute('target', '_bank');	
				outputField.appendChild(document.createElement('br'));
				outputField.appendChild(a_print);
				
				//if(!$('timesheet') || $('timesheet').value!= '1'){ //ticket 1210180046 => pour le closing également
					//bouton extract csv
					var a_exttact_csv = document.createElement('a');
					a_exttact_csv.className = 'tpl_button_save';
					a_exttact_csv.style.backgroundImage = "url(/module/image/shadowless/document-excel.png)";	
					a_exttact_csv.style.margin = "0 0 0 5px";
					a_exttact_csv.innerHTML = 'Extract your planning in CSV file';				
					a_exttact_csv.setAttribute('href', '../export_excel.php'+list_critere);
					a_exttact_csv.setAttribute('target', '_bank');
					outputField.appendChild(a_exttact_csv);
				//}
				
				
			}else{
				//dans ce cas là il n'y a pas assez de critère. Ce n'est pas senssé arrivé
				outputField.innerHTML        = '<div class="infos">No user found</div>';
			}
		}
	}
	// Pas d'utilisateur.
	else
	{
 		outputField.innerHTML        = '<div class="infos">No user found</div>';
	}
}

/**
 * Masquage de la popup d'information.
 */
function hidePopup(){
	nd();
};

/**
 * Recherche une activité.
 */
function search_activity(inputField) {

	if (document.getElementById(inputField) == null){
		return;
	}
	
	var activityId = document.getElementById(inputField).options[document.getElementById(inputField).selectedIndex].value;
	
	var myAjax = new Request({'url':'/module/planning/ajax/php/activity.php?activityId='+document.getElementById(inputField).value, method:'get', onComplete:function(request, requestXML) {complete_activity(requestXML)}});
	myAjax.send();

}


function complete_activity(requestXML) {

	var activities  = requestXML.getElementsByTagName('activity');
	
	if (activities.length == 1) {
	
		var activity_location   = activities[0].getAttribute('location');
		
		if (activity_location == 1){
			activity_location = false;
		}else{
			activity_location = true;
		}
		
		var activity_subsidiaryId = document.getElementById('subsidiaryId');
		var activity_location_id   = document.getElementById('location_id');
		
		if (activity_subsidiaryId != null){
			activity_subsidiaryId.disabled = activity_location;
		}
		
		if (activity_location_id != null){
			activity_location_id.disabled = activity_location;
		}
		
		if (activity_subsidiaryId != null && activity_location_id != null){
			if (activity_location == true) {
			
				$('tr_subsidiary').setStyle('display', 'none');
				$('tr_location').setStyle('display', 'none');
				
				$('tr_subsidiary').setStyle('visibility', 'hidden');
				$('tr_location').setStyle('visibility', 'hidden');
			
			}else {
			
				$('tr_subsidiary').setStyle('display', '');
				$('tr_location').setStyle('display', '');
				
				$('tr_subsidiary').setStyle('visibility', 'visible');
				$('tr_location').setStyle('visibility', 'visible');
			
			}
		}
		
		return;
	
	}else{
		return;
	}

}



function search_location(inputField, outputField, locationAll, locationValue) {

	if (document.getElementById(inputField) == null){
		return;
	}
	
	var subsidiaryId = document.getElementById(inputField).options[document.getElementById(inputField).selectedIndex].value;
	
	var myAjax = new Request({'url':'/module/planning/ajax/php/location.php?subsidiaryId='+subsidiaryId+'&locationAll='+locationAll, method:'get', onComplete:function(request, requestXML) {complete_location(requestXML, outputField, locationValue)}});
	myAjax.send();

}


function complete_location(requestXML, outputField, locationValue) {

  var locations  = requestXML.getElementsByTagName('location');

  var dmc   = '';
  var locationList = document.getElementById(outputField);

  /*//old
  if (locationList.options.length >= 1 && locationList.options[0].value == '0')
    var init = 1;
  else
  */  
  
  var init = 0;

  locationList.options.length = init;

  for (var i= 0; i < locations.length; i++) {

    var location_id   = locations[i].getAttribute('value');
    var location_name = locations[i].firstChild.data;

    var dmc = document.createElement("option");

    dmc.value = location_id;
    dmc.text  = location_name;

    if (locationValue == location_id && locationValue != null){
      dmc.selected  = true;
    }

    try {
      locationList.add(dmc);
    }
    catch(ex) {
      locationList.appendChild(dmc);
    }

  }

}


// Récupere les timesheets
function search_timesheets(outputField) {

  if ($('criteria_form') == null)
    return;

  if (document.getElementById(outputField) == null)
    return;

  document.getElementById(outputField).innerHTML = '';

  if (document.getElementById('lastTimesheet') != null && document.getElementById('lastTimesheet').checked) {

    lastTimesheet = true;

  }
  else
    lastTimesheet = false;

  var myAjax = new Request({'url':'/module/planning/ajax/php/timesheet.php', method:'post', data:$('criteria_form'), onComplete:function(request, requestXML) {complete_timesheets(requestXML, lastTimesheet, outputField)}});
  myAjax.send();

}

// Charge toutes les timesheets
function complete_timesheets(requestXML, lastTimesheet, outputField) {

  var timesheets  = requestXML.getElementsByTagName('timesheet');
  var legends     = requestXML.getElementsByTagName('legend');

  if (timesheets == null)
    return;

  var outputField = document.getElementById(outputField);

  outputField.innerHTML     = '';

  if (!timesheets.length > 0)
    return;

  var timesheets_div = document.createElement('div');
  timesheets_div.className = 'timesheets';

  for (timesheetIdx = 0 ; timesheetIdx < timesheets.length ; timesheetIdx ++) {

    var current_timesheet    = timesheets[timesheetIdx];

    if (current_timesheet.getElementsByTagName('comment')[0] != null)
      var timesheet_data       = current_timesheet.getElementsByTagName('comment')[0].firstChild.data;
    else
      var timesheet_data = null

    if (current_timesheet.getElementsByTagName('label')[0] != null)
      var timesheet_legend     = current_timesheet.getElementsByTagName('label')[0].firstChild.data;
    else
      var timesheet_legend = null

    if (current_timesheet.getElementsByTagName('user')[0] != null)
      var timesheet_user       = current_timesheet.getElementsByTagName('user')[0].firstChild.data;
    else
      var timesheet_user = null

    if (current_timesheet.getElementsByTagName('view')[0] != null)
      var timesheet_view     = current_timesheet.getElementsByTagName('view')[0].firstChild.data;
    else
      var timesheet_view = null

    if (current_timesheet.getElementsByTagName('close')[0] != null)
      var timesheet_close     = current_timesheet.getElementsByTagName('close')[0].firstChild.data;
    else
      var timesheet_close = null

    if (current_timesheet.getElementsByTagName('confirm')[0] != null)
      var timesheet_confirm     = current_timesheet.getElementsByTagName('confirm')[0].firstChild.data;
    else
      var timesheet_confirm = null

    var timesheet_value      = current_timesheet.getAttribute('value');
    var timesheet_date       = current_timesheet.getAttribute('date');
    var timesheet_year       = current_timesheet.getAttribute('year');
    var timesheet_month      = current_timesheet.getAttribute('month');
    var timesheet_subsidiary = current_timesheet.getAttribute('subsidiary');


    if (lastTimesheet == true && timesheetIdx == 0) {

      if (timesheets.length == 1)
        timesheets_div.innerHTML = '<a href="javascript:export_lastTimesheets(\''+timesheet_year+'\', \''+timesheet_month+'\', \''+timesheet_subsidiary+'\', \''+outputField.id+'\');" class="tpl_button_default">Export last closings</a><br>';
      else
        timesheets_div.innerHTML = '<a href="javascript:export_lastTimesheets(\''+timesheet_year+'\', \''+timesheet_month+'\', \'\', \''+outputField.id+'\');" class="tpl_button_default">Export last closings</a><br>';

    } // End if


    var timesheet_fieldset = document.createElement('fieldset');
    timesheet_fieldset.className = 'timesheet';

    if (timesheet_value > 0)
      timesheet_fieldset.id = 'timesheet_' + timesheet_value;
    else
      timesheet_fieldset.id = 'timesheet_' + timesheet_subsidiary + '_' + timesheet_year + '_' + timesheet_month;

    timesheet_fieldset.innerHTML  = '<legend>'+timesheet_legend+'</legend>';
    timesheet_fieldset.innerHTML += timesheet_data;

    timesheet_fieldset.innerHTML += '<br/>';

    if (timesheet_value > 0)
      timesheet_fieldset.innerHTML += '<span class="timesheet_closedby">' + timesheet_user + ' @ ' + timesheet_date + '</span>';

    //timesheet_fieldset.innerHTML += '<br/>';

    string_action = '';

    if (timesheet_view != null && timesheet_value > 0)
     string_action += '<a id="timesheet_view_'+timesheet_value+'" href="javascript:loadTimesheet(\''+outputField.id+'\', \''+timesheet_subsidiary+'\', \''+timesheet_year+'\', \''+timesheet_month+'\', \''+timesheet_value+'\')" class="tpl_button_default">&nbsp;'+ timesheet_view + '</a>';
    else if (timesheet_view != null)
     string_action += '&nbsp;<a id="timesheet_view_'+timesheet_subsidiary+'_'+timesheet_year+'_'+timesheet_month+'" href="javascript:loadTimesheet(\''+outputField.id+'\', \''+timesheet_subsidiary+'\', \''+timesheet_year+'\', \''+timesheet_month+'\', \'\')" class="tpl_button_default">&nbsp;'+ timesheet_view + '</a>';

    if (timesheet_close != null) {

      string_action += '<input type="hidden" name="subsidiaryId" value="'+timesheet_subsidiary+'">';
      string_action += '<input type="hidden" name="year" value="'+timesheet_year+'">';
      string_action += '<input type="hidden" name="month" value="'+timesheet_month+'">';
      string_action += '&nbsp;<a href="javascript:closeTimesheet(\''+timesheet_fieldset.id+'\')" class="tpl_button_default" onClick="return confirm(\''+timesheet_confirm+'\')">&nbsp;'+ timesheet_close + '</a>';

    }

    var timesheet_action   = document.createElement('div');
    var timesheet_planning = document.createElement('div');

    if (timesheet_value > 0) {

      timesheet_action.id   = 'timesheet_action_' + timesheet_value;
      timesheet_planning.id = 'timesheet_planning_' + timesheet_value;

    }
    else {

      timesheet_action.id   = 'timesheet_action_' + timesheet_subsidiary + '_' + timesheet_year + '_' + timesheet_month;
      timesheet_planning.id = 'timesheet_planning_' + timesheet_subsidiary + '_' + timesheet_year + '_' + timesheet_month;

    }

    timesheet_action.className = 'timesheet_action';

    timesheet_action.innerHTML = string_action;

    timesheet_fieldset.appendChild(timesheet_action);

    timesheets_div.appendChild(timesheet_fieldset);
    timesheets_div.appendChild(timesheet_planning);

  } // End if : timesheet

  outputField.appendChild(timesheets_div);

}

// Récupère les derniers closings
function export_lastTimesheets(year, month, subsidiaryId, outputField) {

	var myAjax = new Request({'url':'/module/planning/ajax/php/timesheet.export.php?year='+year+'&month='+month+'&subsidiaryId='+subsidiaryId, method:'get', onComplete:function(request, requestXML) {complete_lastTimesheets(request, outputField)}});
	myAjax.send();

}

function complete_lastTimesheets(request, outputField) {

	if (document.getElementById(outputField) == null){
		return;
	}
	
	document.getElementById(outputField).innerHTML = '<a href="/module/planning/ajax/php/timesheet.download.php?file=' + request +'" target="_blank">Click here to download your export file</a>';

}



function clean_user(){
	/*
	if($('userId')) $('userId').value = '';
	if($('keyword')) $('keyword').value = '';
	*/
}



function checkMyRights() {

	if ($('myRights').getProperty('checked') == true) {
	
		/*
		$('keyword').setProperty('disabled', true);    
		$('keyword').setOpacity(0.5);
		*/
		
		
		$$('.input_keyword').each( function(el) {
			el.setProperty('disabled', true);   
			el.setOpacity(0.5);
		});
		
		
		$('b2b').setProperty('disabled', true);
		$('location_id').setProperty('disabled', true);
		$('status').setProperty('disabled', true);
		$$('.select_subsidiary').each( function(el) {
			el.setProperty('disabled', true);
		});
		
		$$('.select_department').each( function(el) {
			el.setProperty('disabled', true);
		});
		
		$$('.select_activity').each( function(el) {
			el.setProperty('disabled', true);
		});
		
		
		$$('.action_plus').each( function(el) {
			el.style.display = 'none';
		});
		
	}else {
	
		/*
		$('keyword').setProperty('disabled', false);    
		$('keyword').setOpacity(1);
		*/
		
		$$('.input_keyword').each( function(el) {
			el.setProperty('disabled', false);   
			el.setOpacity(1);
		});
		
		$('b2b').setProperty('disabled', false);
		$('location_id').setProperty('disabled', false);
		$('status').setProperty('disabled', false);
		
		$$('.select_subsidiary').each( function(el) {
			el.setProperty('disabled', false);
		});
		
		$$('.select_department').each( function(el) {
			el.setProperty('disabled', false);
		});
		
		$$('.select_activity').each( function(el) {
			el.setProperty('disabled', false);
		});
		
		
		$$('.action_plus').each( function(el) {
			el.style.display = '';
		});
	
	}

}



function remove_select(id_input){
	 var div_input = $(id_input);
	 div_input.dispose();
}



function clean_user2(){
	
	/* cette fonction remplace clean_user qui efface l'utilisateur du moteur de recherche*/
	
	/*
	if($('userId')) $('userId').value = '';
	if($('keyword')) $('keyword').value = '';
	*/
	
	
	
	$$('.input_keyword').each( function(el) {
		el.value = '';
	});
	$$('.input_user').each( function(el) {
		el.value = 0;
	});
	
	//une methode général remplace la classe 'input_keyword' par 'autocompletion'
	$$('.autocompletion').each( function(el) {
		el.value = '';
	});
	

}


function clean_data_research(){
	
	
	$$('.select_subsidiary').each( function(el) {
		el.selectedIndex = 0;
	});
	
	$$('.select_department').each( function(el) {
		el.selectedIndex = 0;
	});
	
	if ($('location_id')){
		$('location_id').selectedIndex = 0;  
	}
	
	if ($('status')){
		$('status').selectedIndex = $('status').length-1;
	}

}



function erase_user(id){

	document.getElementById('userId'+id).value=0;
	document.getElementById('keyword'+id).value='';

}




//génère des block textarea ckeditor
function generateCkEditor_planning(){
	if( typeof( CKEDITOR ) != 'undefined' )
	{
		$$( '.input_wide' ).each( function( el )
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
										[ 'Cut','Copy','Paste','-' ],
										[ 'Bold','Italic','Underline','Strike' ]
									],
									width: '98%', 
									height: '120px',
									entities: false,
									entities_latin: false,
									fontSize_sizes: '8/8px;10/10px;12/12px;14/14px;16/16px;18/18px;'
								};
			
			
			//NOTE : toolbar classic
			//[ 'Cut','Copy','Paste','-','Undo','Redo' ],
			//[ 'Bold','Italic','Underline','Strike','FontSize' ],
			//[ 'NumberedList','BulletedList','-','Outdent','Indent', 'Link','Unlink' ],
			//[ 'TextColor','BGColor' ]
			
											
			if( !Browser.Engine.trident4 )
			{
				ck_option.enterMode = CKEDITOR.ENTER_BR;
			}
			CKEDITOR.replace( el.id, ck_option );
		});
	}
}