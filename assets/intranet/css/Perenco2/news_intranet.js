function display_news(id_news, id_subsidiary, date_news, is_archive, is_news_subsidiary)
{
	// ajax
	var url = 'module/news_intranet/ajax/php/news_intranet.php?id_news='+id_news+'&id_subsidiary='+id_subsidiary+'&date_news='+date_news+'&is_archive='+is_archive;
	if(is_news_subsidiary != ''){
		url = url + '&is_news_subsidiary='+is_news_subsidiary;
	}

	//prompt( '', url );
	var myAjax = new Request( {
						'url': url,
						method: 'get',
						onComplete: function( request, requestXML )
						{
							complete_news( requestXML, date_news, is_archive );
						}}).send();
}



function complete_news(requestXML, date_news, is_archive) {
	
	if(requestXML && requestXML.getElementsByTagName('news')){
		var news     = requestXML.getElementsByTagName('news');
	
		
		this.format = 'yyyy/mm/dd';
		indexOf_day   = this.format.indexOf('dd', 0);
		indexOf_month = this.format.indexOf('mm', 0);
		indexOf_year  = this.format.indexOf('yyyy', 0);
		var tab_month = new Array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
	
		
		if(news[0] && news[0].getElementsByTagName('nw_id')[0]){
			
			/* récupération xml */
			var nw_id = news[0].getElementsByTagName('nw_id')[0].firstChild.data;
			var news_title = news[0].getElementsByTagName('nw_title')[0].firstChild.data;
			var nw_description = news[0].getElementsByTagName('nw_description')[0].firstChild.data;
			var nw_filename = news[0].getElementsByTagName('nw_filename')[0].firstChild.data;
			var position = news[0].getElementsByTagName('position')[0].firstChild.data;
			var id_precendant = news[0].getElementsByTagName('id_precendant')[0].firstChild.data;
			var id_suivant = news[0].getElementsByTagName('id_suivant')[0].firstChild.data;
			var id_subsidiary = news[0].getElementsByTagName('id_subsidiary')[0].firstChild.data;
			var name_subsidiary = news[0].getElementsByTagName('name_subsidiary')[0].firstChild.data;
			var nb_news = news[0].getElementsByTagName('nb_news')[0].firstChild.data;
			var annee_min = news[0].getElementsByTagName('annee_min')[0].firstChild.data;
			var annee_max = news[0].getElementsByTagName('annee_max')[0].firstChild.data;
			if(date_news == '') {date_news = news[0].getElementsByTagName('date_news')[0].firstChild.data };
			var list_date = news[0].getElementsByTagName('date');
			var list_subsidiary = news[0].getElementsByTagName('subsidiary');
			
		
			/* affichage news avec son image */
			var displayed_news = '<center><div id="zap_prec_next">';
			if(date_news == 'now' || is_archive == ''){			
				date_tmp = new Date();
				var month_tmp = date_tmp.getMonth()+1;
				var day_tmp = date_tmp.getDate();
				if (month_tmp<10) month_tmp = '0'+month_tmp;
				if (day_tmp<10) day_tmp = '0'+day_tmp;
				var date_choose = date_tmp.getFullYear()+'/'+month_tmp+'/'+day_tmp;			
			}else{
				
				var date_choose = date_news;
				displayed_news += '<div align="center" id="welcome">News Archive</div>';
				date_tmp = new Date(date_news.substr(indexOf_year, 4), date_news.substr(indexOf_month, 2)-1, date_news.substr(indexOf_day, 2));
			}
			var display_date = tab_month[date_tmp.getMonth()]+' '+date_tmp.getFullYear();
				
			displayed_news += '<span style="font-size:15px;font-weight: bold;">' + name_subsidiary + ' ' + display_date + '</span><br/>';
			
			if(id_precendant){
				displayed_news += '<a id="zap_prec" href="#" onclick="display_news(\''+id_precendant+'\',\''+id_subsidiary+'\',\'\', \''+is_archive+'\', \'\')">&laquo;&laquo; Prev</a>';
			}else{
				displayed_news += '<span id="zap_prec" href="#" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>';
			}
			displayed_news += '<span id="zap_pages">'+position+'/'+nb_news+'</span> ';
			if(id_suivant){
				displayed_news += '<a id="zap_next" href="#" onclick="display_news(\''+id_suivant+'\',\''+id_subsidiary+'\',\'\', \''+is_archive+'\', \'\')">Next &raquo;&raquo;</a>';
			}else{
				displayed_news += '<span id="zap_next" href="#" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>';
			}
			displayed_news += '</div>';

			if( nw_id == 194 )
			{
				displayed_news += '<div id="zap_img"><div style="width:100%px"><a href="'+nw_filename+'"><img src="'+nw_filename+'" style="width: 650px;" title="Please click on the image to maximize" /></a></div></div>';
			}
			// London move.
			else if( nw_id == 347 )
			{
				displayed_news += '<div id="zap_img"><div style="width:100%px"><img src="'+nw_filename+'" /></div></div>';
				displayed_news += '<div id="zap_timer"></div>';
				displayed_news += '<style type="text/css">div#zap_timer { font-size: 2em;  } div#zap_description { text-align: center; font-size: 1.4em;  }</style>';
			}
			else if(nw_filename){
				displayed_news += '<div id="zap_img"><div style="width:100%px"><img src="'+nw_filename+'" /></div></div>';
			}else{
				displayed_news += '<div id="zap_img"><div style="width:100%px">&nbsp;</div></div>';
			}
			displayed_news += '<h2 id="zap_title">'+news_title+'</h2>';
			displayed_news += '<div id="zap_description">'+nw_description+'</div></center>';

			if(document.getElementById('zapette')){
				document.getElementById('zapette').innerHTML        =  displayed_news;
			}

			// London move.
			if( nw_id == 347 )
			{
				var timer_move = function() {

					var zap_timer = document.getElementById( 'zap_timer' );

					var today = new Date();
					var move = new Date("Feb 18 09:00:00 2013");
					var total = (move - today) / 1000;

					if( zap_timer && total > 0 )
					{
						var days = Math.floor(total / (60 * 60 * 24));
						var hours = Math.floor((total - (days * 60 * 60 * 24)) / (60 * 60));
						minutes = Math.floor((total - ((days * 60 * 60 * 24 + hours * 60 * 60))) / 60);
						seconds = Math.floor(total - ((days * 60 * 60 * 24 + hours * 60 * 60 + minutes * 60)));
						zap_timer.innerHTML = days + ' day' + (days > 1 ? 's' : '' ) + ' '
											 + hours + ' hour' + (hours > 1 ? 's' : '' ) + ' '
											 + minutes + ' minute' + (minutes > 1 ? 's' : '' ) + ' '
											 + seconds + ' second' + (seconds > 1 ? 's' : '' ) + ' '
											 ;//+ 'until London HQ move';
						setTimeout( function() { timer_move(); }, 1000 );
					}
				};
				timer_move();
			}

			/* appel fonction création search archive */
			if(date_news == 'now'){
				initialize_calendar(date_news, list_date, id_subsidiary, date_choose, annee_min, annee_max);
				create_select_subsidiary(list_subsidiary, id_subsidiary);
			}else{
				var all_date = '';
				if($('calendar')){
					dp = $('calendar');
					if(list_date[0]){		
						for (var i= 0; i < list_date.length; i++) {		  
						    all_date = all_date + list_date[i].firstChild.data + '-';			   
						}
					}
								
					dp.then = new Date(date_news.substr(indexOf_year, 4), date_news.substr(indexOf_month, 2)-1, date_news.substr(indexOf_day, 2));			
					dp.year = dp.then.getFullYear();
					dp.month = dp.then.getMonth();
			
					remove_calendar(dp);
					create_calendar(dp, all_date, id_subsidiary, date_choose);
				}
			
			}
		}else{
			
			date_tmp = new Date();
			var month_tmp = date_tmp.getMonth()+1;
			var day_tmp = date_tmp.getDate();
			if (month_tmp<10) month_tmp = '0'+month_tmp;
			if (day_tmp<10) day_tmp = '0'+day_tmp;
			var date_choose = date_tmp.getFullYear()+'/'+month_tmp+'/'+day_tmp;	
			
			var list_date = news[0].getElementsByTagName('date');
			var list_subsidiary = news[0].getElementsByTagName('subsidiary');
					
			initialize_calendar('now', list_date, '', date_choose,2005,2015);
			create_select_subsidiary(list_subsidiary, '');
	
		}	
		
		
		//affiche décompte pour certaine news
		if($('uptime')){
			change_uptime();
		}
		
		
	}
	
	
	
	

}

function initialize_calendar(date_news, list_date, id_subsidiary, date_choose, annee_min, annee_max){
	
	if($('calendar')){
		dp = $('calendar');
	
		if(date_news == 'now'){
			dp.value = '';
		}else{	
			dp.value = date_news;			
		}
		
		
		///////////////////////////////// calcul date existante ////////////////////////////////	
		
		var all_date = '';
		var firstdate = '2005';
		var lastdate = '10';
		if(list_date[0]){
			
			for (var i= 0; i < list_date.length; i++) {		  
			    all_date = all_date + list_date[i].firstChild.data + '-';
			    lastdate_tmp = list_date[i].firstChild.data;
			}
			
			if(annee_min && annee_min>1999){ firstdate = annee_min;}
			if(annee_max && annee_max<2020){ lastdate = annee_max - firstdate;}
			
			/* //old
			firstdate_tmp = list_date[0].firstChild.data.substr(0,4);
			if(firstdate_tmp >1999 && firstdate_tmp < 2020){
				firstdate = firstdate_tmp;
			}
			
			lastdate_tmp = lastdate_tmp.substr(0,4);		
			if(lastdate_tmp >1999 && lastdate_tmp < 2020){
				lastdate = lastdate_tmp - firstdate;			
			}
			*/		
			
		}
	
		
		/////////////////////////récupérer en partie de datepiecker - création calendrier//////////////////////////////
		dp.year_start	= firstdate;
		dp.year_range	= lastdate;
		this.dayChars = 1; // number of characters in day names abbreviation
		this.dayNames = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
		this.daysInMonth = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
		this.format = 'yyyy/mm/dd';
		this.monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
		this.startDay = 1; // 1 = week starts on Monday, 7 = week starts on Sunday
		this.yearOrder = 'asc';
		
		
		if(dp.year_range && dp.year_range > 0){
			this.yearRange = parseFloat(dp.year_range);
		}else{
			this.yearRange = 10;
		}
		if(dp.year_start && parseFloat(dp.year_start) > 1900){			
			this.yearStart = parseFloat(dp.year_start);
		}else{
			this.yearStart = (new Date().getFullYear());
		}
	
		// Pull the rest of the options from the alt attr
		if(dp.alt) {
			options = Json.evaluate(dp.alt);
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
			
			indexOf_day   = this.format.indexOf('dd', 0);
			indexOf_month = this.format.indexOf('mm', 0);
			indexOf_year  = this.format.indexOf('yyyy', 0);
	
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
	
		//dp.setProperties({'id':dp.getProperty('name'), 'readonly':true});
		dp.container = false;
		dp.calendar = false;
		dp.interval = null;
		dp.active = false;
	
		if(date_news == 'now'){
			create_calendar(dp, all_date, id_subsidiary, date_choose);
		}
	}

}


function create_calendar(dp, all_date, id_subsidiary, date_choose){

	dp.container = new Element('div', {'class':'dp_container'}).injectInside(dp);
	dp.calendar = new Element('div', {'class':'dp_calendar'}).injectInside(dp.container);
	var date = new Date();
	this.format = 'yyyy/mm/dd';
	dp.calendar.style.position = 'static';

	if(dp.value != '') {
	  	  
	  	indexOf_day   = this.format.indexOf('dd', 0);
		indexOf_month = this.format.indexOf('mm', 0);
		indexOf_year  = this.format.indexOf('yyyy', 0);

		
		var date_r = new Date(dp.value.substr(indexOf_year, 4), dp.value.substr(indexOf_month, 2)-1, dp.value.substr(indexOf_day, 2));
		
		dp.oldYear  = date_r.getFullYear();
		dp.oldMonth = date_r.getMonth();
		dp.oldDay   = date_r.getDate();
		
	}

	
	if (dp.month > -1 && dp.year) {
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

	
	
	/* date a afficher*/
	if(date_choose != ""){
		
		indexOf_day   = this.format.indexOf('dd', 0);
		indexOf_month = this.format.indexOf('mm', 0);
		indexOf_year  = this.format.indexOf('yyyy', 0);
		var date_c = new Date(date_choose.substr(indexOf_year, 4), date_choose.substr(indexOf_month, 2)-1, date_choose.substr(indexOf_day, 2));	
		dp.yearChoose  = date_c.getFullYear();
		dp.monthChoose = date_c.getMonth();
		dp.dayChoose   = date_c.getDate();
		
	}else{
		dp.yearChoose = '';
		dp.monthChoose = '';
		dp.dayChoose = -10;	
	}
		
	
	
	/* create the day cells */
	while (firstDay <= dp.options.daysInMonth[dp.month]){
		calDayRow = new Element('tr');
		for (i = 0; i < 7; i++){
			if ((firstDay <= dp.options.daysInMonth[dp.month]) && (firstDay > 0)){
				calDayCell = new Element('td', {'axis':dp.year + '|' + (parseInt(dp.month) + 1) + '|' + firstDay}).appendText(firstDay).injectInside(calDayRow);
			} else {
				calDayCell = new Element('td').appendText(' ').injectInside(calDayRow);
			}
			
						
			//montre les jours clicables
			var is_date = 0;
			var month_tmp = parseInt(dp.month) + 1;
			if (month_tmp < 10){							
				var month_tmp = '0' + month_tmp;				
			}
			if (firstDay < 10){				
				var day_tmp = '0' + firstDay;
			}else{
				var day_tmp = firstDay;
			}			
			var date_tmp = dp.year + '/' + month_tmp + '/' + day_tmp;
			var is_date = all_date.indexOf(date_tmp, 0);
			if (is_date > -1) {
				calDayCell.addClass(dp.id + '_calDay');
				calDayCell.addClass('dp_clicable');
			}else{
				calDayCell.addClass('dp_empty');
				calDayCell.style.cursor = 'default';
			}
						
			
			// montre le jour séléctionné			
			if ( (firstDay == dp.dayChoose)) {
				calDayCell.addClass('dp_today_search');
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
	dp.container.style.position = 'static';
	dp.container.style.margin = '0 0px';
	dp.container.style.height = '120px';
	
	
	// set the onmouseover events for all calendar days 
	$$('td.' + dp.id + '_calDay').each(function(el){
		el.onmouseover = function(){
			el.addClass('dp_roll_search');
		}.bind(this);
	}.bind(this));
	
	// set the onmouseout events for all calendar days 
	$$('td.' + dp.id + '_calDay').each(function(el){
		el.onmouseout = function(){
			el.removeClass('dp_roll_search');
		}.bind(this);
	}.bind(this));
	
	// set the onclick events for all calendar days 	
	$$('td.' + dp.id + '_calDay').each(function(el){
		el.onclick = function(){

			ds = el.axis.split('|');
			dp.value = formatValue_calendar(dp, ds[0], ds[1], ds[2]);
		
			display_news('', id_subsidiary, dp.value, '1', '');
			
		}.bind(this);
	}.bind(this));
	
	// set the onchange event for the month & year select boxes 
	monthSel.onfocus = function(){ dp.active = true; };
	monthSel.onchange = function(){
		dp.month = monthSel.value;
		dp.year = yearSel.value;
		remove_calendar(dp);
		create_calendar(dp, all_date, id_subsidiary, '');
	}.bind(this);
	
	yearSel.onfocus = function(){ dp.active = true; };
	yearSel.onchange = function(){
		dp.month = monthSel.value;
		dp.year = yearSel.value;
		remove_calendar(dp);
		create_calendar(dp, all_date, id_subsidiary, '');
	}.bind(this);


}


function formatValue_calendar(dp, year, month, day){
	// setup the date string variable 
	var dateStr = '';
	
	// check the length of day 
	if (day < 10) day = '0' + day;
	if (month < 10) month = '0' + month;
	
	// check the format & replace parts // thanks O'Rey 
	dateStr = dp.options.format.replace( /dd/i, day ).replace( /mm/i, month ).replace( /yyyy/i, year );
	dp.month = dp.oldMonth = '' + (month - 1) + '';
	dp.year = dp.oldYear = year;
	dp.oldDay = day;
	
	// return the date string value 
	return dateStr;
}
	

function remove_calendar(dp){
	$clear(dp.interval);
	dp.active = false;
	if (window.opera) dp.container.empty();
	else if (dp.container) dp.container.dispose();
	dp.calendar = false;
	dp.container = false;
	
	
}

function create_select_subsidiary(list_subsidiary, subsidiary_id){
	
	if($('search_by_subsidiary')){
		dp = $('search_by_subsidiary');
		
		var div_subsidiary = new Element('div', {'class':'div_subsidiary'} ).injectInside(dp);
		var select_subsidiary = new Element('select', {'id':'select_subsidiary'}).injectInside(div_subsidiary);
		
		select_subsidiary.onchange = function(){
			display_news('', select_subsidiary.value, '', '1', '');
		};	
		
		select_subsidiary.options[0] = new Option('Choose one...',0);
		select_subsidiary.options[1] = new Option('All',0);
		for (var i= 0; i < list_subsidiary.length; i++) {	
			select_subsidiary.options[i+2] = new Option(list_subsidiary[i].firstChild.data, list_subsidiary[i].getAttribute('id'));
			if (subsidiary_id == list_subsidiary[i].getAttribute('id')) select_subsidiary.options[i+2].selected = true;
		}
	}
	
	
}




//ajoute dans une news un décompte
//texte a rajouté dans la news, directement en base, avec XXXXX = timestamp : 
// => <input type="hidden" value="XXXXX" name="uptime" id="uptime" /><div id="div_uptime"></div>
//exemple : lundi 10 décembre : 1355127300 
//jour
function change_uptime(){
		
	if($('uptime') && $('div_uptime') ){
		var oDate = new Date;
		var time_cur = oDate.getTime(); 
		time_cur = Math.floor(time_cur/1000);
					
		var time_conn = document.getElementById('uptime').value;
		
		if(parseInt(time_conn, 10) > parseInt(time_cur, 10) ){
			
			var uptime_cur =  parseInt(time_conn, 10) - parseInt(time_cur, 10);
			
			var dayVar = Math.floor(uptime_cur/86400); 					// The day
			var hourVar = Math.floor(uptime_cur/3600) - (dayVar*24);			// The hours
			var minVar = Math.floor(uptime_cur/60) - (dayVar*24*60) - (hourVar*60) ; 	// The minutes
			var secVar = uptime_cur - (dayVar*24*60*60) - (hourVar*3600) - (minVar*60);	// The balance of seconds
			
			dayVar = dayVar + "";
			hourVar = hourVar + "";
			minVar  = minVar  + "";
			secVar  = secVar  + "";
			if (dayVar.length == 1)
			{dayVar = "0" + dayVar;}
			if (hourVar.length == 1)
			{hourVar = "0" + hourVar;}
			if (minVar.length == 1)
			{minVar = "0" + minVar;}
			if (secVar.length == 1)
			{secVar = "0" + secVar;}
			
			document.getElementById('div_uptime').innerHTML = dayVar + " Days, " +hourVar + " Hours, " + minVar + " Minutes, " + secVar+" Seconds";
			
				
			setTimeout("change_uptime()",1000);
		}else{
			
			document.getElementById('div_uptime').innerHTML = "0 Days";
			
		}
	}
	
}


