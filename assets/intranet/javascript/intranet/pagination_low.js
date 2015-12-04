	function load_rows( a, c, t, o, s, l )
	{
		if( t != "user" )
		{		
			if ( t == "dash" ){
				$('#rech').trigger('click');
			}else{
				var xhr = getXMLHttpRequest();
				xhr.onreadystatechange = function() {
					if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
						// alert(xhr.responseText);
						load_rw(xhr.responseXML, c); //retrouvé dans chauffeur.js, vehicule.js, manip_res.js
					}
				};
				
				// alert( t );
				
				if( t == "vehicules/dest." )
				{
					t = "vehicule";
				}
				
				var param = "";
				if( t == "chauffeur" )
				{
					param = "&nom="+$('#r_nm').val()+"&prenom="+$('#r_prnm').val()+"&cat="+$('#r_cat').val();
				}else if( t == "vehicule" )
				{
					param = "&immat="+$('#r_immat').val()+"&mrk="+$('#r_mrk').val()+"&type="+$('#r_type').val()+"&stat="+$('#r_stat').val()+"&pp="+$('#r_pp').val();
				}
				
				if( $(c).attr('id') == "n_form_show" )
				{
					param += "&new=new";
				}
				// alert("step="+a+"&order="+o+"&sort="+s+"&limit="+l+param);
				
				xhr.open("POST", t, true);
				xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				xhr.send("step="+a+"&order="+o+"&sort="+s+"&limit="+l+param);
			}
		}else{
			var param =	[
							{"name" : "step", value : a},
							{"name" : "order", value : o},
							{"name" : "sort", value : s},
							{"name" : "limit", value : l},
							{"name" : "id", value : $('#id').val()}
						];
			$.post( t, param, function(data){
				// $('#mess_text').html(data);
				// $('#message').show();
				if( data )
				{
					load_rw(data, c);
				}
			}, "json");
		}
	}
		
	// num : Le nombre total de lignes 
	// step : Le step selectionné
	// limit : Le nombre max affiché
	// target : Le div qui montre les boutons de navigation	
	
	function load_range(target, limit, step, num, c)
	{	
		var page_links = "";
		var pages = Math.ceil(num/limit);
		if (pages > 5)
		{
			var hide = "";
			var _hide = "";
			var __hide = "";
			var ___hide = "";
			var ____hide = "";
			var links = "";
			
			for( var i = 0; i < pages; i++)
			{
				hide = "";
				if(i == ( step - 1))
				{
					page_links += '<strong name="numb_'+c+'">'+step+'</strong>';
				}else{
					if( step <= 2 )
					{
						_hide = 'style="display:none;"';
						__hide = 'style="display:none;"';
						if( i >= 3  )
						{
							hide = 'style="display:none;"';
						}
					}else if( step == 3 ) {
						_hide = 'style="display:none;"';
						__hide = 'style="display:none;"';
						if( i >= 5 )
						{
							hide = 'style="display:none;"';
						}
					}else if( step > 3 ) {
						
						if( (i >=  step+2) || (i <=  step-4) )
						{
							hide = 'style="display:none;"';
						}
					}
					
					page_links += '<a name="step_'+c+'_'+i+'" '+hide+'  onclick="_step(this);">'+(i+1)+'</a>';
				}
			}
			
			if( step >= pages - 2 )
			{
				___hide = 'style="display:none;"';
				____hide = 'style="display:none;"';
			}
			links = '<a name="deb_'+c+'" '+_hide+'  onclick="_deb(this);"> &lsaquo; Debut </a><a name="prec_'+c+'" '+__hide+' onclick="_prec(this);"> &lt; </a>'+page_links+'<a name="suiv_'+c+'" '+___hide+' onclick="_suiv(this);"> &gt; </a><a name="fin_'+c+'" '+____hide+' onclick="_fin(this);"> Fin &rsaquo; </a>';
			
		}else if( pages != 1 ){
			for (i = 0; i < pages; i++)
			{
				if(i == (step - 1))
				{
					page_links += '<strong name="numb_'+c+'">'+step+'</strong>';
				}else{
					page_links += '<a name="step_'+c+'_'+i+'" onclick="_step(this);">'+(i+1)+'</a>';
				}
			}
			links = page_links;
		}
		
		$(target).html(links);
	}

	
	function _step(a){
				
		var step = parseInt(trim($(a).text())); // data A
		// alert("step : "+step);
		var t = a.name.split('_');
		var table = "";
		var table1 = "";
		
		for( var i = 1; i < t.length-1; i++)
		{
			if( i != t.length-2)
			{
				table += t[i]+'/'; 
			}else{
				table += t[i];
			}
		}
		
		// alert("table : "+table);
		
		for( var i = 1; i < t.length-1; i++)
		{
			if( i != t.length-2)
			{
				table1 += t[i]+'_'; 
			}else{
				table1 += t[i];
			}
		}
		
		// alert("table1 : "+table1);
		
		var div_link = a.parentElement; // cible A
		var b_div = div_link.parentElement.parentElement;
		var target = b_div.getElementsByTagName('table')[0].getElementsByTagName('tbody')[0]; // cible B
		
		var lim =  "";
		var rows = "";
		var order = "";
		var sort = "";
		
		if( t.length == 4 )
		{
			if( t[2] == 'rgres' )
			{
				lim =  $('#limit1').val();
				rows = $('#num_rows1').val();
				order = $('#order1').val();
				sort = $('#sort1').val();
				if( $('#step1').val() != step )
				{
					$('#step1').val(step);
				}
			}else if( t[2] == 'rgform' ){
				lim =  $('#limit').val();
				rows = $('#num_rows').val();
				order = $('#order').val();
				sort = $('#sort').val();
				if( $('#step').val() != step )
				{
					$('#step').val(step);
				}
			}
		}else{
			lim =  $('#limit').val();
			rows = $('#num_rows').val();
			order = $('#order').val();
			sort = $('#sort').val();
			if( $('#step').val() != step )
			{
				$('#step').val(step);
			}
		}
		
		// alert( step+'--__--'+$(target).attr('id')+'--__--'+table+'--__--'+order+'--__--'+sort+'--__--'+lim );
		
		load_range(div_link, parseInt(lim), step, parseInt(rows), table1);
		load_rows( step, target, table, order, sort, lim );	
		// load_rows( a, c, t, o, s, l )
	}
	
	function _prec(a)
	{
		var nav_d = a.parentElement
		var ab = "#"+$(nav_d).attr('id')+" [ name^=\"step\" ]";
		
		var steps = $(ab);
		
		var step_str = parseInt(trim(nav_d.getElementsByTagName('strong')[0].innerHTML));
		
		$(ab).each(function(){
			var step_val = parseInt(this.innerHTML);
			if( step_val == (step_str-1)  )
			{
				$(this).trigger('click');
				return true;
			}
		});
	}
	
	function _suiv(a)
	{
		var nav_d = a.parentElement
		var ab = "#"+$(nav_d).attr('id')+" [ name^=\"step\" ]";
		
		var steps = $(ab);
		
		var step_str = parseInt(trim(nav_d.getElementsByTagName('strong')[0].innerHTML));
		
		$(ab).each(function(){
			var step_val = parseInt(this.innerHTML);
			if( step_val == (step_str+1)  )
			{
				$(this).trigger('click');
				return true;
			}
		});
	}
	
	function _deb(a){
		
		var t = a.name.split('_');
		var table = "";
		var table1 = "";
		
		for( var i = 1; i < t.length; i++)
		{
			if( i != t.length-1)
			{
				table += t[i]+'/'; 
			}else{
				table += t[i];
			}
		}
		
		for( var i = 1; i < t.length; i++)
		{
			if( i != t.length-1)
			{
				table1 += t[i]+'_'; 
			}else{
				table1 += t[i];
			}
		}
		
		var div_link = a.parentElement; // cible A
		var b_div = div_link.parentElement.parentElement;
		var target = b_div.getElementsByTagName('table')[0].getElementsByTagName('tbody')[0]; // cible B
		
		var lim =  "";
		var rows = "";
		var order = "";
		var sort = "";
		
		if( t.length == 3 )
		{
			if( t[2] == 'rgres' )
			{
				lim =  $('#limit1').val();
				rows = $('#num_rows1').val();
				order = $('#order1').val();
				sort = $('#sort1').val();
				
			}else if( t[2] == 'rgform' ){
				lim =  $('#limit').val();
				rows = $('#num_rows').val();
				order = $('#order').val();
				sort = $('#sort').val();
				
			}
		}else{
			lim =  $('#limit').val();
			rows = $('#num_rows').val();
			order = $('#order').val();
			sort = $('#sort').val();
			
		}
		
		$('#step').val(1);
		
		load_range(div_link, parseInt(lim), 1, parseInt(rows), table1);
		load_rows( 1, target, table, order, sort, lim );
	}
	
	function _fin(a){
		var t = a.name.split('_');
		var table = "";
		var table1 = "";
		for( var i = 1; i < t.length; i++)
		{
			if( i != t.length-1)
			{
				table += t[i]+'/'; 
			}else{
				table += t[i];
			}
		}
		
		for( var i = 1; i < t.length; i++)
		{
			if( i != t.length-1)
			{
				table1 += t[i]+'_'; 
			}else{
				table1 += t[i];
			}
		}
		
		var div_link = a.parentElement; // cible A
		var b_div = div_link.parentElement.parentElement;
		var target = b_div.getElementsByTagName('table')[0].getElementsByTagName('tbody')[0]; // cible B
		
		var lim =  "";
		var rows = "";
		var order = "";
		var sort = "";
		
		if( t.length == 3 )
		{
			if( t[2] == 'rgres' )
			{
				lim =  $('#limit1').val();
				rows = $('#num_rows1').val();
				order = $('#order1').val();
				sort = $('#sort1').val();
				var pages = Math.ceil(parseInt($('#num_rows1').val())/ parseInt($('#limit1').val()));
			}else if( t[2] == 'rgform' ){
				lim =  $('#limit').val();
				rows = $('#num_rows').val();
				order = $('#order').val();
				sort = $('#sort').val();
				var pages = Math.ceil(parseInt($('#num_rows').val())/ parseInt($('#limit').val()));
			}
			
		}else{
			lim =  $('#limit').val();
			rows = $('#num_rows').val();
			order = $('#order').val();
			sort = $('#sort').val();
			var pages = Math.ceil(parseInt($('#num_rows').val())/ parseInt($('#limit').val()));
		
		}
		
		$('#step').val(pages);
		
		load_range(div_link, parseInt(lim), pages, parseInt(rows), table1);
		load_rows( pages, target, table, order, sort, lim );
	}
	
	