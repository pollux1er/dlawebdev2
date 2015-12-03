// Date limite.

window.addEvent( 'domready', function()
{
	initializeTicketFormEvent( 'body' );

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
				//$('nb_famille').setStyle('display', 'none');
				$j('#montant').val(5000);
			}
		}
	);
	
	$('chk_invites').fireEvent('click');
}

var $j = jQuery.noConflict();
	// $j is now an alias to the jQuery function; creating the new alias is optional.
	 
	$j(document).ready(function() {
		var url = "ajax/envoyer_demande";
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
				//dataType: ($.browser.msie) ? "text" : "xml",
				success : function(response){
					//console.log(response);
					//alert(response);
					//var newXML = parseXml(response);
					//alert(newXML);
					//if(response=='1') {
						$j('#envoyer_demande').attr('disabled', 'disabled');
						$j("#notification").html('Votre demande a &eacute;t&eacute; enregistr&eacute;e!');
						$j("#fqdn_notification").show('slow');
						$j("#fqdn_notification").html('<p>Votre demande a &eacute;t&eacute; enregistr&eacute;e! <a style="color:black" href="">Cliquez ici pour la modifier</a></p>');
						$j("#frmCriteria :input").attr("disabled", true);
						setTimeout(function() {
							$j("#notification").hide('slow');
							//$j("#envoyer_demande").val('Modifier votre demande');
							//window.location.reload();
						}, 5000);
					//}
				},
				error: function(a, b, c) {
					  alert('Une erreur est survenue pendant la requete.'); // this is where the errors happen, 'b' and 'c' are typically the only ones with values
					} // end error
				}); // end .ajax
			
			return false;
		});
	});
		 
// The $ variable now has the prototype meaning, which is a shortcut for
// document.getElementById(). mainDiv below is a DOM element, not a jQuery object.


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
