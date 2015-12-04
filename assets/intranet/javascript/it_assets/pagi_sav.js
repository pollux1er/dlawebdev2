function pagination(target, num, nav){

	var trs = document.getElementById(target).getElementsByTagName('tbody')[0].getElementsByTagName('tr');
	var num_rows = trs.length;
	var pages = Math.ceil(num_rows/num);
	
	var page_links = "";
	
	for( var i = 0; i < pages; i++)
	{
		page_links += '<a name="step"'+i+' >'+(i+1)+'</a>';
	}
	// <strong name="numb"></strong> 
	$(nav).html('<a name="deb"> &lsaquo; Debut </a> &nbsp; <a name="prec"> &lt; </a> &nbsp;'+page_links+' &nbsp; <a name="suiv"> &gt; </a> &nbsp; <a name="fin"> Fin &rsaquo; </a>');
	
	// var stps = 
	
	//var tds = $('#tck_list tbody tr td'); 
	
	if(trs[0].style.display == 'none')
	{
		trs[0].style.display = '';
	}
	
	/*window.setTimeout(function(){*/ $('[name=deb]').hide(); $('[name=fin]').hide(); $('[name=prec]').hide(); $('[name=suiv]').hide(); /*},1000);*/
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
		//var tds = document.getElementById(target).getElementsByTagName('tbody')[0].getElementsByTagName('tr')[0].getElementsByTagName('td');
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
				
		$('[name=numb]').text(derniere_ligne_visible +' / '+ trs.length)
		
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
	});
	
	
	
	
	// error();
	
	// function error()
	// {
		// if($('#error h6').html() != "")
		// {
			// var i = $('#error h6 p').length*2000;
			// if(i>6000)
			// {
				// i = 6000;
			// }else
			// $('#error').show("slow");
			// window.setTimeout( function() {$('#error').hide(2000)},i)
		// }
		
	// }
	
	

};