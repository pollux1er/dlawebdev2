/*
 * DatePicker
 * @author Rick Hopkins
 * @modified by Micah Nolte and Martin Vašina
 * @version 0.3.2
 * @classDescription A date picker object. Created with the help of MooTools v1.11
 * MIT-style License.

-- start it up by doing this in your domready:

$$('input.DatePicker').each( function(el){
	new DatePicker(el);
});

 */

var DatePicker = new Class({

	/* set and create the date picker text box */
	initialize: function(dp){

		// Options defaults
		this.dayChars = 1; // number of characters in day names abbreviation
		this.dayNames = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
		this.daysInMonth = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
		this.format = 'mm/dd/yyyy';
		this.monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
		this.startDay = 1; // 1 = week starts on Monday, 7 = week starts on Sunday
		this.yearOrder = 'asc';
		if(dp.getProperty('yearRange') && dp.getProperty('yearRange') > 0){
			this.yearRange = parseFloat(dp.getProperty('yearRange'));
		}else{
			this.yearRange = 10;
		}
		if(dp.getProperty('year_start') && parseFloat(dp.getProperty('year_start')) > 1900){			
			this.yearStart = parseFloat(dp.getProperty('year_start'));
		}else{
			this.yearStart = (new Date().getFullYear());
		}

		// Pull the rest of the options from the alt attr
		if(dp.alt) {
			options = JSON.decode(dp.alt);
		} else {
			options = [];
		}
		dp.options = {
			monthNames: (options.monthNames && options.monthNames.length == 12 ? options.monthNames : this.monthNames) || this.monthNames, 
			daysInMonth: (options.daysInMonth && options.daysInMonth.length == 12 ? options.daysInMonth : this.daysInMonth) || this.daysInMonth, 
			dayNames: (options.dayNames && options.dayNames.length == 7 ? options.dayNames : this.dayNames) || this.dayNames,
			startDay : options.startDay || this.startDay,
			dayChars : options.dayChars || this.dayChars, 
			format: options.format || this.format,
			yearStart: options.yearStart || this.yearStart,
			yearRange: options.yearRange || this.yearRange,
			yearOrder: options.yearOrder || this.yearOrder
		};


		// Finds the entered date, or uses the current date
		if(dp.value != '') {
			
			indexOf_day   = options.format.indexOf('dd', 0);
			indexOf_month = options.format.indexOf('mm', 0);
			indexOf_year  = options.format.indexOf('yyyy', 0);

			dp.then = new Date(dp.value.substr(indexOf_year, 4), dp.value.substr(indexOf_month, 2)-1, dp.value.substr(indexOf_day, 2));
			dp.today = new Date();
		} else {
			dp.then = dp.today = new Date();
		}
		// Set beginning time and today, remember the original
		dp.oldYear = dp.year = dp.then.getFullYear();
		dp.oldMonth = dp.month = dp.then.getMonth();
		dp.oldDay = dp.then.getDate();
		dp.nowYear = dp.today.getFullYear();
		dp.nowMonth = dp.today.getMonth();
		dp.nowDay = dp.today.getDate();
		
		var is_read_only = true;
		if(dp.getProperty('no_read_only')){
			var is_read_only = false;
		}
		if(is_read_only){
			dp.setProperties({'id':dp.getProperty('name'), 'readonly':true});
		}else{
			dp.setProperties({'id':dp.getProperty('name')});
		}
		dp.container = false;
		dp.calendar = false;
		dp.interval = null;
		dp.active = false;
		dp.onclick = dp.onfocus = this.create.pass(dp, this);

	},

	/* create the calendar */
	create: function(dp){
		if (dp.calendar) return false;
		

		// Hide select boxes while calendar is up
 		if(window.ie6){
 			//$$('select').addClass('dp_hide');	// on en a plus besoin avec l'iframe
 		}
		
		/* create the outer container */				
		dp.container = new Element('div', {'class':'dp_container'}).injectBefore(dp);
		
		/* create timers */
		dp.container.onmouseover = dp.onmouseover = function(){
			$clear(dp.interval);
		};
		dp.container.onmouseout = dp.onmouseout = function(){
			dp.interval = setInterval(function(){
				if (!dp.active) this.dispose(dp);				
			}.bind(this), 500);
		}.bind(this);
		
		/* create the calendar */
		dp.calendar = new Element('div', {'class':'dp_cal'}).injectInside(dp.container);
		
		/* create the date object */
		var date = new Date();
		

		if(dp.value != '') {
		  		  
			indexOf_day   = options.format.indexOf('dd', 0);
			indexOf_month = options.format.indexOf('mm', 0);
			indexOf_year  = options.format.indexOf('yyyy', 0);
                
			var date_r = new Date(dp.value.substr(indexOf_year, 4), dp.value.substr(indexOf_month, 2)-1, dp.value.substr(indexOf_day, 2));
			
			dp.oldYear  = date_r.getFullYear();
			dp.oldMonth = date_r.getMonth();
			dp.oldDay   = date_r.getDate();
			
		}
		
		
		if (dp.month && dp.year) {
			date.setFullYear(dp.year, dp.month, 1);
		} else {
			dp.month = date.getMonth();
			dp.year = date.getFullYear();
			date.setDate(1);
		}
		dp.year % 4 == 0 ? dp.options.daysInMonth[1] = 29 : dp.options.daysInMonth[1] = 28;
		
		/* set the day to first of the month */
		var firstDay = (1-(7+date.getDay()-dp.options.startDay)%7);
		
		
		
		/* create the month select box */
		monthSel = new Element('select', {'id':dp.id + '_monthSelect'});
		for (var m = 0; m < dp.options.monthNames.length; m++){
			monthSel.options[m] = new Option(dp.options.monthNames[m], m);
			if (dp.month == m) monthSel.options[m].selected = true;
		}
		



		/* create the year select box */
		yearSel = new Element('select', {'id':dp.id + '_yearSelect'});
		i = 0;
		dp.options.yearStart ? dp.options.yearStart : dp.options.yearStart = date.getFullYear();
		if (dp.options.yearOrder == 'desc'){
			for (var y = dp.options.yearStart; y > (dp.options.yearStart - dp.options.yearRange - 1); y--){
				yearSel.options[i] = new Option(y, y);
				if (dp.year == y) yearSel.options[i].selected = true;
				i++;
			}
		} else {
			for (var y = dp.options.yearStart; y < (dp.options.yearStart + dp.options.yearRange + 1); y++){				
				yearSel.options[i] = new Option(y, y);
				if (dp.year == y) yearSel.options[i].selected = true;
				i++;
			}
		}




		
		/* start creating calendar */
		calTable = new Element('table');
		calTableThead = new Element('thead');
		calSelRow = new Element('tr');
		calSelCell = new Element('th', {'colspan':'7'});
		monthSel.injectInside(calSelCell);
		yearSel.injectInside(calSelCell);
		calSelCell.injectInside(calSelRow);
		calSelRow.injectInside(calTableThead);
		calTableTbody = new Element('tbody');
		
		/* create day names */
		calDayNameRow = new Element('tr');
		for (var i = 0; i < dp.options.dayNames.length; i++) {
			calDayNameCell = new Element('th');
			calDayNameCell.appendText(dp.options.dayNames[(dp.options.startDay+i)%7].substr(0, dp.options.dayChars)); 
			calDayNameCell.injectInside(calDayNameRow);
		}
		calDayNameRow.injectInside(calTableTbody);


		
		/* create the day cells */
		while (firstDay <= dp.options.daysInMonth[dp.month]){
			calDayRow = new Element('tr');
			for (i = 0; i < 7; i++){
				if ((firstDay <= dp.options.daysInMonth[dp.month]) && (firstDay > 0)){
					calDayCell = new Element('td', {'class':dp.id + '_calDay', 'axis':dp.year + '|' + (parseInt(dp.month) + 1) + '|' + firstDay}).appendText(firstDay).injectInside(calDayRow);
				} else {
					calDayCell = new Element('td', {'class':'dp_empty'}).appendText(' ').injectInside(calDayRow);
				}
				// Show the previous day
				if ( (firstDay == dp.oldDay) && (dp.month == dp.oldMonth ) && (dp.year == dp.oldYear) ) {
					calDayCell.addClass('dp_selected');
				}
				// Show today
				if ( (firstDay == dp.nowDay) && (dp.month == dp.nowMonth ) && (dp.year == dp.nowYear) ) {
					calDayCell.addClass('dp_today');
				}
				firstDay++;
			}
			calDayRow.injectInside(calTableTbody);
		}
		
		/* table into the calendar div */
		calTableThead.injectInside(calTable);
		calTableTbody.injectInside(calTable);
		calTable.injectInside(dp.calendar);

		var pos_input = findPos( dp );
		dp.container.style.position = 'absolute';
		dp.container.style.left = pos_input[0]; //dp.offsetLeft;
		
		/////////////////////////////////////////////////////////////////////////////////////////
		//utilsation iframe sous la fenetre date picker pour corriger le bug IE6 => les select passait sur la date.

		var iframe_id = 'date_iframe_'+ dp.name;
		if( !document.getElementById( iframe_id ) )
		{
			var iframe_element = document.createElement( 'iframe' );
			with( iframe_element )
			{
				id = iframe_id;
				scrolling = 'no';
				frameborder = 0;
				style.position = 'absolute';
				style.width = 0;
				style.height = 0;
				style.margin = 0;
				style.padding = 0;
			}
			document.body.appendChild(iframe_element );
		}
		var date_iframe = document.getElementById( iframe_id );

		var pos = findPos( dp.calendar );

		with( dp.calendar.style )	// on change le style du calendrier
		{			
			zIndex = date_iframe.style.zIndex+1;
		}
				
		with( date_iframe.style )	// on change le style due l'iframe
		{
			width = dp.calendar.offsetWidth;
			height = dp.calendar.offsetHeight - 1;
			left = pos[0];
			//left = dp.offsetLeft;
			top = pos[1];
			zIndex = dp.calendar.style.zIndex - 1; 
			display = "block";
		}
		/////////////////////////////////////////////////////////////////////////////////////////
		

		
		/* set the onmouseover events for all calendar days */
		$$('td.' + dp.id + '_calDay').each(function(el){
			el.onmouseover = function(){
				el.addClass('dp_roll');
			}.bind(this);
		}.bind(this));
		
		/* set the onmouseout events for all calendar days */
		$$('td.' + dp.id + '_calDay').each(function(el){
			el.onmouseout = function(){
				el.removeClass('dp_roll');
			}.bind(this);
		}.bind(this));
		
		/* set the onclick events for all calendar days */
		
		$$('td.' + dp.id + '_calDay').each(function(el){
			el.onclick = function(){

				ds = el.axis.split('|');
				dp.value = this.formatValue(dp, ds[0], ds[1], ds[2]);
				
				// modification : BOYER PASCAL - bug IE6+ajax+datepicker, pour récupérer en ajax la valeur 
				// du champs datepicker, il faut un champ hidden qui possède la même valeur que celui-ci.
				if($(dp.name+'_hidden'))$(dp.name+'_hidden').value = dp.value;
				
				this.to_do_when_click(dp.value);	//fonction libre a modifier dans chaque module pour gérer un evenement click
				
				this.dispose(dp);
			}.bind(this);
		}.bind(this));
		
		/* set the onchange event for the month & year select boxes */
		monthSel.onfocus = function(){ dp.active = true; };
		monthSel.onchange = function(){
			dp.month = monthSel.value;
			dp.year = yearSel.value;
			this.dispose(dp);
			this.create(dp);
		}.bind(this);
		
		yearSel.onfocus = function(){ dp.active = true; };
		yearSel.onchange = function(){
			dp.month = monthSel.value;
			dp.year = yearSel.value;
			this.dispose(dp);
			this.create(dp);
		}.bind(this);
	},
	
	/* Format the returning date value according to the selected formation */
	formatValue: function(dp, year, month, day){
		/* setup the date string variable */
		var dateStr = '';
		
		/* check the length of day */
		if (day < 10) day = '0' + day;
		if (month < 10) month = '0' + month;
		
		/* check the format & replace parts // thanks O'Rey */
		dateStr = dp.options.format.replace( /dd/i, day ).replace( /mm/i, month ).replace( /yyyy/i, year );
		dp.month = dp.oldMonth = '' + (month - 1) + '';
		dp.year = dp.oldYear = year;
		dp.oldDay = day;
		
		/* return the date string value */
		return dateStr;
	},
	
	/* Remove the calendar from the page */
	dispose: function(dp){
		var iframe_id = 'date_iframe_' + dp.name;
		if($( iframe_id )) $( iframe_id ).style.display = "none";	//efface l'iframe s'il y en a une (correction bug ie)	
		$clear(dp.interval);
		dp.active = false;
		if (window.opera) dp.container.empty();
		else if (dp.container) dp.container.dispose();
		dp.calendar = false;
		dp.container = false;
		$$('select.dp_hide').removeClass('dp_hide');	
		
	},
	
	/* fonction libre a modifier dans chaque projet si on veut intervenir sur le fait de cliquer sur une date.*/
	to_do_when_click: function(new_value){
		
	}
});




function findPos(obj)
{
	var curleft = curtop = 0;
	if( obj.offsetParent )
	{
		do
		{
			curleft += obj.offsetLeft;
			curtop += obj.offsetTop;
		} while( obj = obj.offsetParent );
	}
	return [curleft,curtop];
}



