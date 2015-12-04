	function line_color(a, b)
	{
		// alert(a.className);
		var trs = document.getElementById(b).getElementsByTagName('tbody')[0].getElementsByTagName('tr'); 
		$(a).removeAttr('class');
		$(a).attr('class','l_selected');
		
		for( var i = 0; i < trs.length; i++)
		{
			if( (trs[i] != a) && ( $(trs[i]).attr('class') == 'l_selected' ) )
			{
				$(trs[i]).removeAttr('class');
				$(trs[i]).attr('class','altcol');
			}
		}
	}