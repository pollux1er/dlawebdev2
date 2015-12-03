/**
 * Affichage du sous-menu dont l'id est passé en paramètre.
 */
function showMenu( menu_id )
{
	var d = document;
	var menu_div = d.getElementById( 'tm_'+menu_id );
	var department_div = d.getElementById( 'department_name_'+menu_id );
	var menu_iframe = d.getElementById( 'menu_iframe' );

	// Masquage de l'iframe
	ShowDiv( menu_div, menu_iframe, false );

	// Masquage de tous les sous-menus.
	d.getElements( 'ul[id^=tm_]' ).each( function( el ) { el.style.display = 'none' } );

	// Affichage du sous-menu demandé.
	if( menu_div )
	{
		ShowDiv( menu_div, menu_iframe, department_div, true );
		menu_div.style.display = 'block';
	}
}

/**
 * Recherche des coordonnées left et top d'un élément html (d'après left et top de ses parents, car les fonctions natives ne fonctionnent pas).
 */
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

/**
 * Affichage  du sous-menu avec son iframe.
 */
function ShowDiv( div, iframe, department, state )
{
	if( state )
	{
		// Coordonnées de la div.
		var pos = findPos( div );
		var pos_department = findPos( department );
		pos[1] += div.parentNode.firstChild.offsetHeight;

		// Modification de la div.
		with( div.style )
		{
			left = (pos_department[0] - 160 ) + 'px';
			top =  (pos_department[1] - 40 ) + 'px';
			display = "block";
			zIndex = iframe.style.zIndex+1;
		}

		/*var old_content = div.innerHTML;
		div.innerHTML = '<iframe>'+old_content+'</iframe>';*/

		// Modification de l'iframe.
		with( iframe.style )
		{
			width = div.offsetWidth + 'px';
			height = ( div.offsetHeight - 1 ) + 'px';
			left = pos_department[0] + 'px';
			//top = pos_department[1] + document.getElementById( 'top_menu' ).offsetHeight - 6; //department.parentNode.firstChild.offsetHeight;
			top = ( pos_department[1] + 14 ) + 'px'; //parseInt( div.style.top )
			zIndex = div.style.zIndex - 1; 
			display = "block";
		}
	}
	else
	{
		if( div )
		{
			div.style.display = "none";
		}
		iframe.style.display = "none";
	}
}

document.write( '<iframe id="menu_iframe" scrolling="no" frameborder="0" style="position: absolute; width: 0; height: 0; margin: 0; padding: 0;"></iframe>' );
