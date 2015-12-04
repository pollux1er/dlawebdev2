function pagination(target, num, nav, step){
	
	var trs = document.getElementById(target).getElementsByTagName('tbody')[0].getElementsByTagName('tr');
	var num_rows = trs.length;
	var pages = Math.ceil(num_rows/num);
	if( $('#zero').val() == '1' )
	{
		step = '1';
	}
	var moves = function(){
		var deb, prec, suiv, fin, id;
			
		if(nav == '#page_1')
		{
			deb = $('#page_1 [name=deb]');
			prec = $('#page_1 [name=prec]');
			suiv = $('#page_1 [name=suiv]');
			fin = $('#page_1 [name=fin]');
			
		}else if(nav == '#page_2')
		{
			deb = $('#page_2 [name=deb]');
			prec = $('#page_2 [name=prec]');
			suiv = $('#page_2 [name=suiv]');
			fin = $('#page_2 [name=fin]');
		} else if(nav == '#page_3')
		{
			deb = $('#page_3 [name=deb]');
			prec = $('#page_3 [name=prec]');
			suiv = $('#page_3 [name=suiv]');
			fin = $('#page_3 [name=fin]');
		}else
		{
			deb = $('[name=deb]');
			prec = $('[name=prec]');
			suiv = $('[name=suiv]');
			fin = $('[name=fin]');
		}
		
		return [deb, prec, suiv, fin];
	}
	
	var parent = $(nav).parent();
	
	// alert(document.getElementsByTagName('div').length);
	
	$(parent).each(function(){
		
		var nb_div = this.getElementsByTagName('div');
		
		if(nb_div.length > 3)
		{	
			$(nb_div[0]).html(trs.length+' &Eacute;l&eacute;ment(s)');
		}else if(nb_div.length == 3){
			$(nav).before('<div class="navig_nb_record">'+trs.length+' &Eacute;l&eacute;ment(s) </div>');
		}
	});	
	
	if(trs.length == 0)
	{
		if($('#page').val() == 'commande')
		{
			document.getElementById(target).getElementsByTagName('tbody')[0].innerHTML = '<tr class="altcol"><td colspan="2" class="align_center"><p>pas d\'&eacute;l&eacute;ment dans le tableau</p></td></tr>';
			$(nav).hide();
		}else if(($('#page').val() == 'reservation') || ($('#page').val() == 'materiel') || ($('#page').val() == 'Recherche')){
			document.getElementById(target).getElementsByTagName('tbody')[0].innerHTML = '<tr class="altcol"><td colspan="10" class="align_center"><p>pas d\'&eacute;l&eacute;ment dans le tableau</p></td></tr>';
			$(nav).hide();
		}else{
			document.getElementById(target).getElementsByTagName('tbody')[0].innerHTML = '<tr class="altcol"><td colspan="2" class="align_center"><p>pas d\'&eacute;l&eacute;ment dans le tableau</p></td></tr>';
			$(nav).hide();
		}
	}else
	{
		function view_(step)
		{	
			var page_links = "";
			
			if (pages > 5)
			{
				if( step < 3)
				{
					for( var i = 0; i < 3; i++)
					{
						if(i == (parseInt(step) - 1))
						{
							page_links += '<strong name="numb">'+step+'</strong>';
						}else{
							page_links += '<a name="step'+i+'">'+(i+1)+'</a>';
							compt = i+1;
						}
						
					}
					
					$(nav).html('<a name="deb"> &lsaquo; Debut </a><a name="prec"> &lt; </a>'+page_links+'<a name="suiv"> &gt; </a><a name="fin"> Fin &rsaquo; </a>');
					$(nav).css('visibility','visible');
					
				}else if(step == 3)
				{
					for( var i = 0; i < 5; i++)
					{
						if(i == (parseInt(step) - 1))
						{
							page_links += '<strong name="numb">'+step+'</strong>';
						}else{
							page_links += '<a name="step'+i+'">'+(i+1)+'</a>';
							compt = i+1;
						}
						
					}
					
					$(nav).html('<a name="deb"> &lsaquo; Debut </a><a name="prec"> &lt; </a>'+page_links+'<a name="suiv"> &gt; </a><a name="fin"> Fin &rsaquo; </a>');
					$(nav).css('visibility','visible');
				}else if(step > 3) {
					for (i = 0; i < pages; i++)
					{
						if(i == (parseInt(step) - 1))
						{
							page_links += '<strong name="numb">'+step+'</strong>';
						}else{
							page_links += '<a name="step'+i+'">'+(i+1)+'</a>';
							compt = i+1;
						}
					}
					
					$(nav).html('<a name="deb"> &lsaquo; Debut </a><a name="prec"> &lt; </a>'+page_links+'<a name="suiv"> &gt; </a><a name="fin"> Fin &rsaquo; </a>');
					$(nav).css('visibility','visible');
					
					var index_page, id_targ;
					var hide_a = function(i){
						if(nav == "#page_1")
						{
							index_page = $('#page_1 [name=step'+i+']');
						}else if(nav == "#page_2")
						{
							index_page = $('#page_2  [name=step'+i+']');
						}else if(nav == "#page_3")
						{
							index_page = $('#page_3 [name=step'+i+']');
						}else
						{
							index_page = $('[name=step'+i+']');
						}
						return index_page;
					}
					
					for (i = 0; i < (parseInt(step) - 3); i++)
					{
						id_targ = hide_a(i);
						$(id_targ).hide();
					}
					
					for (i = (parseInt(step) + 2); i < pages; i++)
					{
						id_targ = hide_a(i);
						$(id_targ).hide();
					}
				}
				
			}else if(pages == "1"){
				page_links += '<strong name="numb">'+step+'</strong>';
				$(nav).html('<a name="deb"> &lsaquo; Debut </a><a name="prec"> &lt; </a>'+page_links+'<a name="suiv"> &gt; </a><a name="fin"> Fin &rsaquo; </a>');
				$(nav).css('visibility','hidden');
			}else{
				for (i = 0; i < pages; i++)
				{
					if(i == (parseInt(step) - 1))
					{
						page_links += '<strong name="numb">'+step+'</strong>';
					}else{
						page_links += '<a name="step'+i+'">'+(i+1)+'</a>';
						compt = i+1;
					}
				}
				
				$(nav).html('<a name="deb"> &lsaquo; Debut </a><a name="prec"> &lt; </a>'+page_links+'<a name="suiv"> &gt; </a><a name="fin"> Fin &rsaquo; </a>');
				$(nav).css('visibility','visible');
			}	
		}
		
		
		view_(step);		
		
		
		function show_table(a)
		{	
			first_pos = (parseInt(a)*num)-num;
			last_pos = (parseInt(a)*num)-1;
			
						
			for(var i = 0; i<trs.length; i++)
			{
				if((i < first_pos) || (i > last_pos))
				{
					trs[i].style.display = 'none';
				}else{
					trs[i].style.display = '';
				}
			}
			
			show_range();
		}
	}
	
	show_table(step);

	function show_range()
	{
		var dernier_rang_visible = 0;
		for(var i =0; i<trs.length; i++)
		{
			if(trs[i].style.display == '')
			{
				dernier_rang_visible = i;
			}
		}
		
		derniere_ligne_visible = dernier_rang_visible+1;
		
		var deb, prec, suiv, fin;
		var move = moves();
		
		deb = move[0];
		prec = move[1];
		suiv = move[2];
		fin = move[3];
		
		if((pages >= 1) && (pages <= 5))
		{
			$(deb).hide();
			$(prec).hide();
			$(suiv).hide();
			$(fin).hide();
		}else if (pages > 5)
		{
			if(step < 4)
			{
				$(deb).hide();
			}
			if((step >= 4) && (step < pages-5))
			{
				$(deb).show();
				$(fin).show();
			}else if((step >= pages-2) && (step < pages))
			{
				$(deb).show();
				$(fin).hide();
			}else if(step == pages)
			{
				$(deb).show();
				$(fin).hide();
			}
			
			if((derniere_ligne_visible == trs.length))
			{
				$(suiv).hide();
			}else
			{
				$(suiv).show();
			}
			
			if((trs.length >=(num+1)) && (trs[(num-1)].style.display == 'none'))
			{
				$(prec).show()
			}else if(trs[0].style.display == ''){$(prec).hide();}
		}
		
		return derniere_ligne_visible;
	}
	
		
	
	$('[name=prec]').click(function(){
		
		derniere_ligne_visible = show_range();
		derniere_lgn_prec = Math.floor(trs.length/num)*num;
		for(var i=0; i<trs.length; i++)
		{
			if(derniere_ligne_visible == trs.length)
			{
				if(derniere_lgn_prec != derniere_ligne_visible)
				{
					if(i < derniere_lgn_prec-num)
					{
						trs[i].style.display = 'none';
					}else if((i >= derniere_lgn_prec-num) && (i <= derniere_lgn_prec-1) )
					{
						trs[i].style.display = '';
					}else{trs[i].style.display = 'none';}
				}else{
					if((i <= derniere_ligne_visible-(num+1)) && (i >= derniere_ligne_visible-(2*num)))
					{
						trs[i].style.display = '';
					}else{
						trs[i].style.display = 'none';
					}
				}
				
			}else if(derniere_ligne_visible < trs.length)
			{
				if((i >= derniere_ligne_visible-(2*num)) && (i <= derniere_ligne_visible-(num+1)) )
				{
					trs[i].style.display = '';
				}else{trs[i].style.display = 'none';}
			}
		}
		show_range();
		current_page = (Math.ceil(show_range()/num)).toString();
		pagination(target, num, nav, current_page);
	});
	
	
	
	$('[name=suiv]').click(function(){	
		
		derniere_ligne_visible = show_range();
		for(var i=0; i<trs.length; i++)
		{
			if((derniere_ligne_visible+(num-1)) < trs.length)
			{
				if((i<derniere_ligne_visible) || ((i>derniere_ligne_visible+(num-1))))
				{
					trs[i].style.display = 'none';
				}else{trs[i].style.display = '';}
			}else
			{
				if((i<derniere_ligne_visible) || ((i>trs.length)))
				{
					trs[i].style.display = 'none';
				}else{trs[i].style.display = '';}
			}
		}
		show_range();
		current_page = (Math.ceil(show_range()/num)).toString();
		pagination(target, num, nav, current_page);
	});
	
	$('[name^=step]').each(function(){
		$(this).click(function(){
			pagination(target, num, nav,$(this).text());
		});	
	});
	
	$('[name=deb]').each(function(){
		$(this).click(function(){
			pagination(target, num, nav,'1');
		});	
	});
	$('[name=fin]').each(function(){
		$(this).click(function(){
			pagination(target, num, nav, pages);
		});	
	});
	
	$('#zero').val("");
};