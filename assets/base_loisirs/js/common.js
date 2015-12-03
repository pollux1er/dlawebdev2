String.prototype.contains = function(string, separator){
    return (separator) ? (separator + this + separator).indexOf(separator + string + separator) > -1 : String(this).indexOf(string) > -1;
};

function disp_delai()
	{
	  document.getElementById('countdown').innerHTML = delai(2007,2,21,10,0);
	setTimeout("disp_delai()",1000);
	}
	
function delai(annee,mois,jour,heure,min)
	{var date_fin=new Date(annee,mois-1,jour,heure,min)
	var date_jour=new Date();
	var tps=(date_fin.getTime()-date_jour.getTime())/1000;
	var j=Math.floor(tps/3600/24);     	// récupere le nb de jour
	tps=tps % (3600*24);
	var h=Math.floor(tps / 3600);		// recupère le nb d'heure
	tps=tps % 3600;
	var m=Math.floor(tps/60);		// récupère le nb minute
	tps=tps % 60
	var s=Math.floor(tps);
	
	var txt=j+" day(s) "+h+" hour(s) "+m+" min(s) and "+s+" sec";
	
	
	if (tps > 0)
	  return "Time before launch <br><br>" + txt;
	else
	  return "Visit it at <a href=\"http://www.perenco.com\" target=\"_blank\" style=\"font-size:20px\">www.perenco.com</a>";
	}



/**
 * Vérifie la validité d'un email
 */
 
function isValidEmail(email) { // vérif validité email par REGEXP

   var reg = /^[a-z0-9._-]+@[a-z0-9.-]{2,}[.][a-z]{2,3}$/
   return (reg.exec(email)!=null)

}
 



/**
 * Selection un objet <objet> dans un menu deroulant
 */
function loadSelecetedField(form, champ, value) {

  var w;

  if (window.document.forms[form])
    w = window.document.forms[form];
  else
    w = form;

  if (w) {

    for (idx = 0 ; idx < w.elements[champ].length ; idx++) {

      w.elements[champ][idx].selected = true;
      tmp = w.elements[champ].selectedIndex;

      if (w.elements[champ][tmp].value == value)
        break;

    }

  }

}

/**
 * Deplace des objets d'un menu deroulant à un autre
 */
function move(l1,l2) {
	if (l1.options.selectedIndex>=0) {
		o=new Option(l1.options[l1.options.selectedIndex].text,l1.options[l1.options.selectedIndex].value);
		l2.options[l2.options.length]=o;
		l1.options[l1.options.selectedIndex]=null;
	}
}

function selectAll(l1) {
  
  for (idx = 0 ; idx < l1.options.length ; idx++) {
    
    l1.options[idx].selected = true;
    
    
  }

}

/**
 * Ajoute un objet <objet> dans un menu deroulant
 */
function addOptionInSelect(text, value, l1) {
  
		if (text != null) {
		o=new Option(text, value);
		l1.options[l1.options.length]=o;
	}

}

/**
 * Supprime un objet <objet> dans un menu deroulant
 */
 
function removeOptionFromSelect(list) {
	if (list.options.selectedIndex>=0) {
		list.options[list.options.selectedIndex]=null;
	}
}


/**
 * Sets/unsets the pointer and marker in browse mode
 *
 * @param   object   the table row
 * @param   string   the action calling this script (over, out or click)
 * @param   string   the default background color
 * @param   string   the color to use for mouseover
 * @param   string   the color to use for marking a row
 *
 * @return  boolean  whether pointer is set or not
 */
function setPointer(theRow, theAction, theDefaultColor, thePointerColor, theMarkColor)
{
    var theCells = null;

    // 1. Pointer and mark feature are disabled or the browser can't get the
    //    row -> exits
    if ((thePointerColor == '' && theMarkColor == '')
        || typeof(theRow.style) == 'undefined') {
        return false;
    }

    // 2. Gets the current row and exits if the browser can't get it
    if (typeof(document.getElementsByTagName) != 'undefined') {
        theCells = theRow.getElementsByTagName('td');
    }
    else if (typeof(theRow.cells) != 'undefined') {
        theCells = theRow.cells;
    }
    else {
        return false;
    }

    // 3. Gets the current color...
    var rowCellsCnt  = theCells.length;
    var domDetect    = null;
    var currentColor = null;
    var newColor     = null;
    // 3.1 ... with DOM compatible browsers except Opera that does not return
    //         valid values with "getAttribute"
    if (typeof(window.opera) == 'undefined'
        && typeof(theCells[0].getAttribute) != 'undefined') {
        currentColor = theCells[0].getAttribute('bgcolor');
        domDetect    = true;
    }
    // 3.2 ... with other browsers
    else {
        currentColor = theCells[0].style.backgroundColor;
        domDetect    = false;
    } // end 3

    // 4. Defines the new color
    // 4.1 Current color is the default one
    if (currentColor == ''
        || currentColor.toLowerCase() == theDefaultColor.toLowerCase()) {
        if (theAction == 'over' && thePointerColor != '') {
            newColor = thePointerColor;
        }
        else if (theAction == 'click' && theMarkColor != '') {
            newColor = theMarkColor;
        }
    }
    // 4.1.2 Current color is the pointer one
    else if (currentColor.toLowerCase() == thePointerColor.toLowerCase()) {
        if (theAction == 'out') {
            newColor = theDefaultColor;
        }
        else if (theAction == 'click' && theMarkColor != '') {
            newColor = theMarkColor;
        }
    }
    // 4.1.3 Current color is the marker one
    else if (currentColor.toLowerCase() == theMarkColor.toLowerCase()) {
        if (theAction == 'click') {
            newColor = (thePointerColor != '')
                     ? thePointerColor
                     : theDefaultColor;
        }
    } // end 4

    // 5. Sets the new color...
    if (newColor) {
        var c = null;
        // 5.1 ... with DOM compatible browsers except Opera
        if (domDetect) {
            for (c = 0; c < rowCellsCnt; c++) {
                theCells[c].setAttribute('bgcolor', newColor, 0);
            } // end for
        }
        // 5.2 ... with other browsers
        else {
            for (c = 0; c < rowCellsCnt; c++) {
                theCells[c].style.backgroundColor = newColor;
            }
        }
    } // end 5

    return true;
} // end of the 'setPointer()' function



/**
 * Ouvre un fenetre popup
 */
function openPopup(page, name, option) {
    var w=window.open(page,name,option);
    w.document.close();
    w.focus();
  }
  

function isValidDate(d, name) {

      // Cette fonction vérifie le format JJ/MM/AAAA saisi et la validité de la date.
      // Le séparateur est défini dans la variable separateur
      var amin=1930; // année mini
      var amax=2050; // année maxi
      var separateur="/"; // separateur entre jour/mois/annee

      split_d = d.split('/');

      var j=parseInt(parseFloat(split_d[0]));
      var m=parseInt(parseFloat(split_d[1]));
      var a=parseInt(parseFloat(split_d[2]));

      if ( ((isNaN(j))||(j<1)||(j>31)) ) {
         alert("[WARNING "+name+" ] : The day is not valid."); return false;
      }
      if ( ((isNaN(m))||(m<1)||(m>12)) ) {
         alert("[WARNING "+name+" ] : The month is not valid"); return false;
      }
      if ( ((isNaN(a))||(a<amin)||(a>amax)) ) {
         alert("[WARNING "+name+" ] : The year is not valid"); return false;
      }
      if ( ((d.substring(2,3)!=separateur)||(d.substring(5,6)!=separateur)) ) {
         alert("[WARNING "+name+" ] : The separator is not valid, you have to use : "+separateur); return false;
      }
         var d2=new Date(a,m-1,j);

         j2=d2.getDate();
         m2=d2.getMonth()+1;
         a2=d2.getFullYear();

         if (a2<=100) {a2=1900+a2}
         if ( (j!=j2)||(m!=m2)||(a!=a2) ) {
            alert("[WARNING "+name+" ] : The date "+d+" is not valid");
            return false;
         }
      return true;
   }
   
   
// ENVOI DE FORMULAIRE VERS UNE AUTRE PAGE
function submitForm(form, action, valid) {

  document.forms[form].action=action;

  var status = document.forms[form].onsubmit;

  if (status == null || valid == 1 ) {
    document.forms[form].submit();
  }
  else {

    if (document.forms[form].onsubmit()) {
      document.forms[form].submit();
    }

  }

}


///////////////
//3 fonctions qui permettent de remplacer les alt/title
function tip_mouse_out(id_bulle){
	
        document.getElementById(id_bulle).style.display="none";
   
}

function tip_mouse_over(declencheur, id_bulle, ev, obj, message, dX, dY){

	
	idInput=obj.id;//On recupere l'id de l'objet appelant
	

	var Xdoc, Xfen, Ydoc, Yfen, htDiv, lgDiv, dX, dY;
	

	var el=document.getElementById(id_bulle);

	
	//on affiche la boite de dialogue pour evaluer ses dimensions.
	if (el.style.display!="block")
		el.style.display="block";
	

	//hauteur et largeur de la bulle
	htDiv = el.offsetHeight;
	lgDiv = el.offsetWidth;

	var position = tip_find_position(declencheur);
	var Xdoc = position[0];
	var Ydoc = position[1];



	//position de la bulle dans la page :

	if ((Xfen + lgDiv + dX) > document.body.clientWidth)
		el.style.left = document.body.clientWidth + document.body.scrollLeft - lgDiv;
	else
		el.style.left = Xdoc + dX;
	
	if ((Yfen + htDiv + dY) > document.body.clientHeight)	{
		el.style.top = document.body.clientHeight + document.body.scrollTop - htDiv-5;
	}
	else
		el.style.top = Ydoc + dY-5;

	el.innerHTML = message;

}



function tip_find_position(obj){

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

///////////////

/**
 * Edition du profil.
 */
function editUser()
{
	openPopup('/user.php', 'UserPopup', 'status=no,activity=no,scrollbars=no,width=500, height=550, top=100, left=100, resizable=yes');
}

/**
 * Affiche/masque un bloc avec grâce.
 */
function tpl_toggleWithGrace( clicked, expand, args )
{
	var el_clicked = $( clicked );
	var el_expand = $( expand );
	if( !el_clicked )
	{
		return;
	}
	var param = {};
	param.duration = 300;
	param.mode = 'vertical';

	if( typeof( args ) != "undefined" ) {
		for( var i in param ){
			if( args[i] ) {
				param[i] = args[i];
			}
		}
	}

	// IE6.
	if( Browser.Engine.trident4 )
	{
		param.transition = Fx.Transitions.Quad.easeOut;
		var fx_slide = new Fx.Slide(expand, param);
		el_clicked.addEvent('click', function(e) {
			e = new Event(e);
			fx_slide.toggle().chain(function() {
				var opacity = ( this.open ? 1: 0.25 );
				el_expand.fade( opacity  );
			});
			e.stop();
		});
		el_expand.setStyle( 'display', 'block' );
		fx_slide.hide();
		el_expand.fade( 0.25 );
	}
	else
	{
		var fx_slide = new Fx.Reveal(el_expand, param);
		el_clicked.addEvent('click', function(e){
				fx_slide.toggle();
		});
	}
}

/**
 * Initialise les arguments de création d'une alert box.
 */
function tpl_setAlertArg( arg )
{
	if( !arg ) arg = {};
	if( !arg.textBoxBtnOk ) arg.textBoxBtnOk = 'Confirm';
	if( !arg.textBoxBtnCancel ) arg.textBoxBtnCancel = 'Cancel';
	return arg;
}

/**
 * Fonction d'ajout d'évènements au démarrage.
 */
  var tpl_invalid_doctype = true;
 /*  window.addEvent("domready", function()
  {
	// Top-menu.
	var body = $('body');
	if( body )
	{
		body.addEvent('mouseout', function(){ showMenu(); });
	}

	// Détection du doctype.
	var dtd = document.doctype;
	var doc = '';
	// IE.
	if( !dtd )
	{
		doc = document.all[0].text;
	}
	// Firefox.
	else if( dtd.publicId )
	{
		doc = dtd.publicId;
	}
	// Default: invalid doctype (pour rétrocompatibilité).
	if( doc
		&& typeof( doc ) != 'undefined' )
	{
		tpl_invalid_doctype = ( doc.indexOf( 'HTML 4.01 Transitional' ) > -1 );
	}

	// Clignotement rouge d'éléments. Bug CPU dans IE8+doctype valide. TPA 2011-08-22.
	// $$(".blink").addEvent("domready", function() {
		// var color_from = '#ff0000';
		// var color_to = this.getStyle( 'background-color' );
		// var fx = new Fx.Tween( this, {
			// duration: 1000,
			// onComplete: function() {
				// var from = color_from;
				// var to = color_to;
				// if( fx.element.getStyle( 'background-color' ) == from )
				// {
					// var temp = from;
					// from = to;
					// to = temp;
				// }
				// fx.start('backgroundColor', from).chain(function() {
					// this.start('backgroundColor', to);
				// });
			// }
		// } );
		// fx.fireEvent( 'complete' );
	// });

	// Affichage / masquage des infos de contact du responsable du projet.
	tpl_toggleWithGrace( 'contact_site_toggle', 'contact_site_info' );

	// Affichage / masquage des infos de contact de l'IT (présent pour certaines filiales seulement).
	tpl_toggleWithGrace( 'contact_it_toggle', 'contact_it_info' );

	// Affichage / masquage du bandeau de nouvelle version.
	tpl_toggleWithGrace( 'version_expand', 'version_content' );
	var version_expand = $( 'version_expand' );
	if( version_expand )
	{
		version_expand.addEvents( {
			mouseover: function( e ) { this.setStyle( 'cursor', 'pointer' ); },
			mouseout: function( e ) { this.setStyle( 'cursor', 'default' ); }
		} );
	}

	// Ajoute les styles aux champs en user autocomplétion.
	tpl_addUserAutocompletion();

	// Formatage des alert box.
	if( typeof SexyAlertBox != 'undefined' )
	{
		tpl_callSexyAlert();
		window.addEvent("resize", function() { tpl_callSexyAlert() } );
	}
});
 */
/**
 * Ajoute les styles d'autocomplétion aux champs qui le méritent.
 */
function tpl_addUserAutocompletion()
{
	// Affichage d'une image dans les champs en autocomplétion.
	//var div = document.getElementsByClassName( 'completion' );
	var div_completion = $$('div.completion');
	div_length = div_completion.length;

	var theDate = new Date();
	var uniqid = theDate.getTime();

	// Parcours des champs en autocomplétion.
	for( var i = 0; i<div_length; i++ )
	{
		var div = div_completion[i];
		var element = div.getPrevious();
		// Rétrocompatibilité: ancien doctype invalide en HTML.
		if( tpl_invalid_doctype )
		{
			if( element
				&& !element.hasClass( 'autocompletion' ) )
			{
				//element.className += ' autocompletion';
				element.addClass( ' autocompletion' );
			}
		}
		// Nouveau doctype valide.
		else
		{
			if( element
				//&& !div.autocompleted )
				&& !div.hasClass( 'autocompleted' ) )
			{
				if( !element.id )
				{
					element.id = 'autocompletion_' + uniqid;
					uniqid = uniqid + 1;
				}
				var div_wrapper = new Element( 'div' ).wraps( element.id );
				//div_wrapper.className element.className;
				div_wrapper.addClass( element.className );
				//div_wrapper.addClass( 'autocompletion' );
				element.removeClass( element.className );
				element.addClass( 'autocompletion' );
				element.setStyles( { 'background-color': 'transparent', 'width': '96%' } );
			}
			div.addClass( 'autocompleted' );
		}
	}
}

function tpl_callSexyAlert()
{
	// Animation.
	Sexy = new SexyAlertBox( {
		OverlayStyles   : { 'opacity': 0.5 },
		onCloseComplete: function(  ) { return Sexy.options.onReturn ; }
		/*onReturnFunction: function( test ) { alert( Sexy.options.onReturn); },*/
		//onCloseComplete: function( properties ) { return Sexy.options.onReturn;}
		/*,moveEffect      : $empty,
		showEffect      : $empty,
		showDuration    : 0,
		moveDuration    : 0,
		moveEffect      : $empty,*/
	} );

	// Mapping.
	window.alert = function( msg, arg ) {
		var arg = tpl_setAlertArg( arg );
		Sexy.alert( msg );
	};
	window.confirm = function( msg, arg ) {
	
		var arg = tpl_setAlertArg( arg );
		arg.onComplete = function() { alert( 'blah' ); };
		/*arg.onReturnFunction = function() { return Sexy.options.onReturn; };*/
		Sexy.confirm( msg, arg );
		//onComplete
		//alert( test );

		/*
		arg.onCloseComplete = function() {
		return this.options.onReturn;
		onReturnFunction
		*/
		
		//Sexy.confirm('Do you agree to the terms and conditions?', { textBoxBtnOk: 'I Agree', textBoxBtnCancel: 'Cancel' });
			
		//Sexy.onReturnFunction( data ) = function() { return data; };
	};
	window.info = function( msg, arg ) {
		var arg = tpl_setAlertArg( arg );
		Sexy.info( msg );
	};
	window.prompt = function( msg, text, arg ) {
		var arg = tpl_setAlertArg( arg );
		Sexy.prompt( msg, text, arg );
	};
}










//bulle d'aide pour remplacer le title
function MouseOut_common(id_bulle){
	document.getElementById(id_bulle).style.display="none";
} 

function MouseOver_common(declencheur, id_bulle, ev,obj,message, dX, dY){

	idInput=obj.id;//On recupere l'id de l'objet appelant

	var Xdoc, Xfen, Ydoc, Yfen, htDiv, lgDiv, dX, dY;

	var el=document.getElementById(id_bulle);

	//on affiche la boite de dialogue pour evaluer ses dimensions.
	if (el.style.display!="block")
		el.style.display="block";

	//hauteur et largeur de la bulle
	htDiv = el.offsetHeight;
	lgDiv = el.offsetWidth;
	
	//dY dX : et delta de la bulle sous la souris
		
	var position = findPosition_common(declencheur);
	var Xdoc = position[0];
	var Ydoc = position[1];


	//position de la bulle dans la page :
	if ((Xfen + lgDiv + dX) > document.body.clientWidth)
		el.style.left = document.body.clientWidth + document.body.scrollLeft - lgDiv;
	else
		el.style.left = Xdoc + dX;
	
	if ((Yfen + htDiv + dY) > document.body.clientHeight)	{
		el.style.top = document.body.clientHeight + document.body.scrollTop - htDiv-5;
	}
	else
		el.style.top = Ydoc + dY-5;

	el.innerHTML = message;
	
}

function findPosition_common(obj){

	var curleft = curtop = 0;
	if( obj.offsetParent ){
		do
		{
			curleft += obj.offsetLeft;
			curtop += obj.offsetTop;
		} while( obj = obj.offsetParent );
	}
	return [curleft,curtop];

}

/*J(document).ready(function(){
	J('#body_content').tooltip({track: true});
});*/