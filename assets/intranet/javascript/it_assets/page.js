function pagination(target, num, nav, step){

	var trs = document.getElementById(target).getElementsByTagName('tbody')[0].getElementsByTagName('tr');
	var num_rows = trs.length;
	var pages = Math.ceil(num_rows/num);
	
	// var stps = 
	
	//var tds = $('#tck_list tbody tr td'); 
	
	// if(trs[0].style.display == 'none')
	// {
		// trs[0].style.display = '';
	// }
	
	/*window.setTimeout(function(){},2000);*/
	//alert(tds.length);
	
	
	if(trs.length == 0)
	{
		//$(ths).hide();
		if($('#page').val() == 'commande')
		{
			document.getElementById(target).getElementsByTagName('tbody')[0].innerHTML = '<tr class="altcol"><td colspan="2" class="align_center"><p>pas d\'&eacute;l&eacute;ment dans le tableau</p></td></tr>';
			$(nav).hide();
		}else if($('#page').val() == 'materiel'){
			document.getElementById(target).getElementsByTagName('tbody')[0].innerHTML = '<tr class="altcol"><td colspan="10" class="align_center"><p>pas d\'&eacute;l&eacute;ment dans le tableau</p></td></tr>';
			$(nav).hide();
		}else{
			document.getElementById(target).getElementsByTagName('tbody')[0].innerHTML = '<tr class="altcol"><td colspan="2" class="align_center"><p>pas d\'&eacute;l&eacute;ment dans le tableau</p></td></tr>';
			$(nav).hide();
		}
		
		
	}else
	{
		view_(step);
	
		function view_(step)
		{	
			alert(step);
			var page_links = "";
			
			if (pages > 3)
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
							// alert(compt);
						}
						
					}
				}
				
				$(nav).html('<a name="deb"> &lsaquo; Debut </a><a name="prec"> &lt; </a>'+page_links+'<a name="suiv"> &gt; </a><a name="fin"> Fin &rsaquo; </a>');
					
				for (i = compt; i < pages; i++)
				{
					$('[name=step'+i+']').hide();
				}
				
			}else{
				$('[name^=step]').show();
			}
		}
		
		show_table();
		
		function show_table()
		{	
			for(var i = 0; i<trs.length; i++)
			{
				if(i>=num)
				{
					trs[i].style.display = 'none';
				}else{trs[i].style.display = '';}
			}
		}
		
		$('#prec').hide();
		show_range();
	}

	
	function show_range()
	{
		//nbre_vue = Math.ceil(trs.length/2);
		for(var i =0; i<trs.length; i++)
		{
			if(trs[i].style.display == '')
			{
				dernier_rang_visible = i;
			}
		}
		derniere_ligne_visible = dernier_rang_visible+1;
				
		//$('[name=numb]').text(derniere_ligne_visible +' / '+ trs.length)
		
		if((derniere_ligne_visible == trs.length))
		{
			$('[name=suiv]').hide();
		}else
		{
			$('[name=suiv]').show();
		}
		
		if((trs.length >=(num+1)) && (trs[(num-1)].style.display == 'none'))
		{
			$('[name=prec]').show()
		}else if(trs[0].style.display == ''){$('[name=prec]').hide();}
		
		
		
		return derniere_ligne_visible;
	}
	
		
	
	$('[name=prec]').click(function(){
		derniere_ligne_visible = show_range();
		derniere_lgn_prec = Math.floor(trs.length/num)*num;
		//alert(derniere_lgn_prec+' '+derniere_ligne_visible);
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
		//alert(show_range())
		current_page = (Math.ceil(show_range()/num)).toString();
		alert(current_page);
		// if(isNaN(current_page) == true) {alert('text');}else{alert('chiffre');}
		view_(current_page);
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
		//alert(show_range());
		current_page = (Math.ceil(show_range()/num)).toString();;
		// alert(current_page);
		//if(isNaN(current_page) == true) {alert('text');}else{alert('chiffre');}
		view_(current_page);
	});
	
	$('[name^=step]').each(function(){
		$(this).click(function(){
			pagination(target, num, nav,$(this).text());
		});	
	});
};