// Date limite.
window.addEvent( 'domready', function()
{	
	
	initializeTicketFormEvent( 'body' );
	var foo = document.id('envoyer_demande');
	
	$('annuler_demande').addEvent('click', function(event){
		event.stop();
		var url_cancel = 'base_loisirs.php/ajax/user_cancel_resa/';
		if (confirm('Confirmez-vous l\'annulation de votre réservation ?')) {
			if(frmCriteria.annuler_demande.value == "Annuler" || frmCriteria.annuler_demande.value == "Annuler votre Réservation") {
				
				if (!window.location.origin)
					window.location.origin = window.location.protocol+"//"+window.location.host;
					//alert(window.location.origin + '/base_loisir/demande/?cancel_resa=' + frmCriteria.demande_id.value);	
				window.location = window.location.origin + '/base_loisirs.php/demande/?cancel_resa=' + frmCriteria.demande_id.value;
			}
		} else {
			//return false;
		}
		/*
		alert(frmCriteria.annuler_demande.value);
		if(frmCriteria.annuler_demande.value == "Annuler") {
			if (!window.location.origin)
				window.location.origin = window.location.protocol+"//"+window.location.host;
		alert(window.location.origin + '/base_loisir/demande/?id_resa=' + frmCriteria.demande_id.value);	
			window.location = window.location.origin + '/base_loisir/demande/?id_resa=' + frmCriteria.demande_id.value;
		} else {
			var Annuler = new Request({
				url: url_cancel,
				method: 'post',
				onComplete: function(response){
					if(response == '0') {
							
					} else {
						if (!window.location.origin)
							window.location.origin = window.location.protocol+"//"+window.location.host;
							
							window.location = window.location.origin + '/base_loisirs/';
					} 
				},
				data: $('frmCriteria').toQueryString()
			});
			Annuler.send();
		}*/
	});
	if (foo) {
	var button = $('envoyer_demande');
	button.addEvent('click', function(event){
		button.set('value','Veuillez patienter...').disabled = true;
		event.stop();
		
		///////////////////////////////////////
		//alert('affiche les valeurs des dates');
		//alert($j('#bl_date_arr').val()); 
		//alert($j('#bl_date_dep').val());
		//alert(todaydate());
		//return false;
		jours = daydiff(parseDate($j('#bl_date_arr').val()), parseDate($j('#bl_date_dep').val()));
		if(jours >= 8) {
			$('notification').set('html', '<span style="font-size: 13px;margin-left: 2px;float: left;color:red;font-weight : bold;">Votre réservation ne peux dépasser plus d\'une semaine.</span>');
			return false;
		}	
		if (process($j('#bl_date_arr').val()) < process(todaydate())) {
			$('notification').set('html', '<span style="font-size: 13px;margin-left: 2px;float: left;color:red;font-weight : bold;">Veuillez vérifier vos dates de réservation s.v.p.</span>');
			return false;
		}
		if($j('#bl_heure_arr') == '' || $j('#bl_heure_dep') == '') {
			alert('Vous devez renseigner une heure');
			return false;
		}
		
		//////////////////////////////////////
		
		var url_book = 'base_loisirs.php/ajax/envoyer_demande/';
		var url_pending = 'base_loisirs.php/ajax/liste_attente/';
		var url_case_libre = 'base_loisirs.php/ajax/check_case_libre/';
		var url_get_id_resa = 'base_loisirs.php/ajax/url_get_id_resa/';
		var url = '';
		alert("En attente : "+frmCriteria.attente.value);
		if(frmCriteria.attente.value == "non")
			url = url_book;
		else
			url = url_pending;
	
		if (frmCriteria.bl_heure_arr.value == ""  || frmCriteria.bl_heure_dep.value == "" || frmCriteria.bl_heure_arr.value == "hh:mm" || frmCriteria.bl_heure_dep.value == "hh:mm") {
			alert("Vous devez preciser une heure d'arrivee et de depart!");
			button.disabled = false; 
			button.set('value','Enregistrer votre réservation');
			return false;
		}
		var mesRequetes = {
			EnregistrerDemande : new Request({
				url: url,
				onRequest: function(){
					$('notification').set('html', '<img style="float: left;height: 20px;" src="assets/base_loisirs/images/spinner.gif" /><span style="font-size: 12px;margin-left: 5px;float: left;">Verification de la disponibilite de la case...</span>');
				},
				onComplete: function(response){
					if(response == '1') {
						$('notification').set('html', '<span style="font-size: 13px;margin-left: 2px;float: left;color:red">Case indisponible. Regarder le <a href="base_loisirs.php/attendance/" style="font-size:12px">planning</a> ou allez en liste d\'attente.</span>');
						$('envoyer_demande').value = 'Passer en liste d\'attente';
						$('attente').value = 'oui';	
						mesRequetes.checkCaseLibre.send();	
						 
					} else if(response == '0') {
						$('notification').set('html', '<span style="font-size: 13px;margin-left: 2px;float: left;color:blue; font-weight:bold">Votre réservation a été effectuée.</span>');
						$('envoyer_demande').value = 'Modifier votre réservation';
						$('attente').value = 'non';
						mesRequetes.getIdResa.send();
						
					} else if(response == '2') {
						$('notification').set('html', '<span style="font-size: 13px;margin-left: 2px;float: left;color:green; font-weight:bold">Votre réservation a été modifiée.</span>');
						$('envoyer_demande').value = 'Modifier votre réservation';
						$('attente').value = 'non';
						button.disabled = false;
					} else if(response == '4') {
						$('notification').set('html', '<span style="font-size: 13px;margin-left: 2px;float: left;color:green; font-weight:bold">Vous avez été inséré en liste d\'attente.</span>');
						$('envoyer_demande').value = 'Modifier votre réservation';
						$('attente').value = 'oui';
						button.disabled = false;
					} else if(response == '4Impossible') {
						$('notification').set('html', '<span style="font-size: 13px;margin-left: 2px;float: left;color:red; font-weight:bold">Votre réservation est enregistrée mais ne peut être mise en attente.<br /> Veuillez modifier votre réservation.</span>');
						$('envoyer_demande').value = 'Modifier votre réservation';
						$('attente').value = 'non';
						button.disabled = false;
					}
				},
				data: $('frmCriteria').toQueryString(),
				onFailure: function(){
					$('notification').set('html', '<span style="font-size: 12px;margin-left: 2px;float: left;color:red">La requete a echouée. Veuillez reessayer.</span>');
					button.disabled = false;
				}
			}),
			checkCaseLibre : new Request({
				url: url_case_libre, 
				data: $('frmCriteria').toQueryString(),
				onRequest: function(){
					
				},
				onComplete: function(text, xml){
					$('broadcast').set('html', text);
					var notif = new Fx.Slide('broadcast');
					notif.slideIn();
					button.disabled = false;
				}
			}),
			getIdResa : new Request({
				url: url_get_id_resa, 
				data: $('frmCriteria').toQueryString(),
				onRequest: function(){
					
				},
				onComplete: function(text, xml){
					$('demande_id').value = text;
					button.disabled = false;
				}
			})
			
		};
		
		var maFileAjax = new Request.Queue({
			requests: mesRequetes,
			onComplete: function(name, instance, text, xml){
				console.log('queue: ' + name + ' response: ', text, xml);
			}
		});
		
		mesRequetes.EnregistrerDemande.send();
	});
	} else {
		$('notification').set('html', '');
	}
	
	/* $$('.toggleSenderFields:checked').each( function( el )
	{
		el.parentNode.parentNode.getChildren('.auto_sending').hide();
	});
	
	// Cache les lignes de log techniques.
	hide_show( 'log', 'true' ); */
} );

function initializeTicketFormEvent( section )
{
	$( 'chk_invites' ).addEvent( 'click', function()
		{
			if( this.checked )
			{
				$('invite_cmt').setStyle('display', 'block');
				$('nb_famille').setStyle('display', 'block')
				$j('#montant').val(5000+10000*$j('#nb_famille').val());
				//alert('a des invités');
				// $('nb_famille').addEvent('change',function(event) {
					// alert($j('#nb_famille').val());
				// });
				$j('#nb_famille').bind('change', function() {
					//alert( this.value ); // or $(this).val()
					$j('#montant').val(5000+10000*this.value);
				});
			}
			else 
			{
				$('invite_cmt').setStyle('display', 'none');
				$('nb_famille').setStyle('display', 'none');
				$j('#montant').val(5000);
			}
		}
	);
	
	$('chk_invites').fireEvent('click');
}

var $j = jQuery.noConflict();
	// $j is now an alias to the jQuery function; creating the new alias is optional.
	 
$j(document).ready(function() {
	var url = "base_loisirs.php/ajax/envoyer_demande";/*
	$j('#envoyer_demande').click(function(){
		if($j("#bl_heure_arr").val()=='' || $j("#bl_heure_dep").val()=='') {
			alert("Vous devez preciser une heure d'arrivee et de depart!");
			return false;
		}
		var data = $j("#frmCriteria").serialize();
		//alert(data); 
		$j("#notification").show();
		
		$j.ajax({
			type : "POST",
			cache: false,
			url : url,
			data : data,
			success : function(response){
				//console.log(response);
				//alert(response);
				//var newXML = parseXml(response);
				//alert(newXML);
				if(response == 'rejette') {
					alert("Pour le moment, les demandes pour la saison prochaine ne sont plus acceptées! Veuillez patienter en début de saison prochaine.");
					$j("#notification").hide('slow');
				} else {
				//if(response=='1') {
					$j('#envoyer_demande').attr('disabled', 'disabled');
					$j("#notification").html('Votre demande a &eacute;t&eacute; enregistr&eacute;e!');
					$j("#fqdn_notification").show('slow');
					$j("#fqdn_notification").html('<p>Votre demande a &eacute;t&eacute; enregistr&eacute;e! <a style="color:black" target="_self" href="demande/">Cliquez ici pour la modifier</a></p>');
					$j("#frmCriteria :input").attr("disabled", true);
					setTimeout(function() {
						$j("#notification").hide('slow');
						//$j("#envoyer_demande").val('Modifier votre demande');
						//window.location.reload();
					}, 5000);
				//}
				}
			},
			error: function(a, b, c) {
				  alert('Une erreur est survenue pendant la requete.'); // this is where the errors happen, 'b' and 'c' are typically the only ones with values
				} // end error
			}); // end .ajax
		
		return false;
	});*/
});
		 
// The $ variable now has the prototype meaning, which is a shortcut for
// document.getElementById(). mainDiv below is a DOM element, not a jQuery object.
	

function parseXml(xml) {
//  if (jQuery.browser.msie) {
    var xmlDoc = new ActiveXObject("Microsoft.XMLDOM");
	alert();
    xmlDoc.loadXML(xml);
    xml = xmlDoc;
//  }
  return xml;
}

function formatHeure(time, moment) {
    var result = false, m;
    var re = /^\s*([01]?\d|2[0-3]):?([0-5]\d)\s*$/;
    if ((m = time.match(re))) {
        result = (m[1].length == 2 ? "" : "0") + m[1] + ":" + m[2];
    }
	if (result == false) {
		alert('Vous devez renseigner une heure!');
		if(moment == 'd')
			result = '12:30';
		else	result = '14:30';
	}
    return result;
}

function parseDate(str) {
    var mdy = str.split('/')
    return new Date(mdy[2], mdy[1], mdy[0]-1);
}

function daydiff(first, second) {
    return (second-first)/(1000*60*60*24);
}

function todaydate() {
	var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!

    var yyyy = today.getFullYear();
    if(dd<10){
        dd='0'+dd
    } 
    if(mm<10){
        mm='0'+mm
    } 
    var today = dd+'/'+mm+'/'+yyyy;
    return today;
}

function process(date){
   var parts = date.split("/");
   return new Date(parts[2], parts[1] - 1, parts[0]);
}