<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<title><?php echo $title; ?></title>
	<base href="<?php echo base_url(); ?>" target="_blank">
	<meta http-equiv="X-UA-Compatible" content="IE=9;" />
	<meta http-equiv="Content-type" content="text/html; charset=UTF-8"/>
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
	<link rel="icon" href="/favicon.ico" type="image/x-icon">
	<link href="assets/base_loisirs/css/jquery-ui-1.8.22.custom.css?nocache=60" rel="stylesheet" type="text/css" />
	<link href="assets/base_loisirs/css/left_menu.css?nocache=60" rel="stylesheet" type="text/css" />
	<link href="assets/base_loisirs/css/top_menu.css?nocache=60" rel="stylesheet" type="text/css" />
	<link href="assets/base_loisirs/css/main.css?nocache=60" rel="stylesheet" type="text/css" />
	<link href="assets/base_loisirs/css/generic.css?nocache=60" rel="stylesheet" type="text/css" />
	<link href="assets/base_loisirs/css/print.css?nocache=60" rel="stylesheet" type="text/css" media="print" />
	<link href="assets/base_loisirs/css/style.css?nocache=60" rel="stylesheet" type="text/css" />
	<link href="assets/base_loisirs/css/style1.css?nocache=60" rel="stylesheet" type="text/css" />
	<link href="assets/base_loisirs/css/base_loisir.css?nocache=60" rel="stylesheet" type="text/css" />
	<link href="assets/base_loisirs/css/calendar-eightysix-v1.1-default.css?nocache=60" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="assets/base_loisirs/css/calendar-eightysix-v1.1-vista.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="assets/base_loisirs/css/calendar-eightysix-v1.1-osx-dashboard.css" media="screen" />
	
	<link href="assets/base_loisirs/css/datepicker.css" rel="stylesheet" type="text/css" />
	<!--<link href="assets/base_loisirs/css/home.css?nocache=60" rel="stylesheet" type="text/css" media="all" />-->
	
		<!--[if IE 6]>
	
	<style type="text/css">	
		#top_menu .department_name { margin-top:1px; } 
		#left_menu {width: 13% !important;}
		#body_content { width: 75% !important; } 
		#menu-container-home { position: absolute; top:68px; z-index:1000; zoom: 1; }		
		#drop_down_menu_home li { padding: 4px 10px; }
		#drop_down_menu_home li.sfhover ul { left: 0px; top:22px; padding: 0; margin: 0; z-index:1000; zoom: 1; background-color: white; }
		#devCornerBlock { position: relative; width: auto; }
	</style>
	<script type="text/javascript">
		sfHover = function() {
			var sfEls = document.getElementById("drop_down_menu_home").getElementsByTagName("LI");
			for (var i=0; i<sfEls.length; i++) {
				sfEls[i].onmouseover=function() {
					this.className+=" sfhover";
				}
				sfEls[i].onmouseout=function() {
					this.className=this.className.replace(new RegExp(" sfhover\\b"), "");
				}
			}
		}
		if (window.attachEvent) window.attachEvent("onload", sfHover);
	</script>
	
	<![endif]-->
	<script type="text/javascript" src="assets/base_loisirs/js/jquery-1.10.2.min.js?nocache=60"></script>
	<script type="text/javascript" src="assets/base_loisirs/js/jquery-ui-1.10.3.custom.min.js?nocache=60"></script>
	<script type="text/javascript" src="assets/base_loisirs/js/jquery-impromptu.js?nocache=60"></script>
	<script type="text/javascript" src="assets/base_loisirs/js/compatibility-jquery-mootools.js?nocache=60"></script>
	<script type="text/javascript" src="assets/base_loisirs/js/overlib.js?nocache=60"></script>
	<script type="text/javascript" src="assets/base_loisirs/js/mootools-1.2.5.min.js?nocache=60"></script>
	<script type="text/javascript" src="assets/base_loisirs/js/mootools-more-1.2.5.1.min.js?nocache=60"></script>
	<script type="text/javascript" src="assets/base_loisirs/js/common.js?nocache=60"></script>
	<script type="text/javascript" src="assets/base_loisirs/js/common2.js?nocache=60"></script>
	<script type="text/javascript" src="assets/base_loisirs/js/calendar-eightysix-v1.1.js?nocache=60"></script>
	<script type="text/javascript" src="assets/base_loisirs/js/base_loisir.js?nocache=60"></script>
	<script type="text/javascript" src="assets/base_loisirs/js/Form.Placeholder.js?nocache=60"></script>

	<script>
	$j(document).ready(function() {
	
	<?php if($message != '') { ?>
		$j("#frmCriteria :input").attr("disabled", true);
		//$j("#envoyer_demande").val('Modifier votre demande');
		$j("#frmCriteria :input").attr("disabled", false);
		
	<?php }  ?>
	
		$j('#id_case').on('change', function() {
			$j('#case_verte').hide();
			$j('#case_bleue').hide();
			$j('#gde_case').hide();
			$j('#case_jaune').hide();
			if(this.value == '1') {
				$j('#case_verte').show();
			}
			if(this.value == '2') {
				$j('#case_bleue').show();
			}
			if(this.value == '3') {
				$j('#gde_case').show();
			}
			if(this.value == '4') {
				$j('#case_jaune').show();
			}
			
		});
	
	});
	
	
	window.addEvent('domready', function() {
		/*
		$('ajax-alert').addEvent('click', function(event) {
			//prevent the page from changing
			event.stop();
			//make the ajax call
			var req = new Request({
				method: 'get',
				url: $('ajax-alert').get('href'),
				data: { 'do' : '1' },
				onRequest: function() { alert('Request made. Please wait...'); },
				onComplete: function(response) { alert('Response: ' + response); }
			}).send();
		});*/
		<?php if($message != '') { ?>
		
		<?php if(!$annuler) { ?>
		$('annuler_demande').addEvent('click', function(event) {
			
			event.stop();
			var x;
			// if (confirm("Voulez-vous annuler votre réservation ?") == true) {
				// alert("You pressed OK!");
			// } else {
				// alert("You pressed Cancel!");
			// }
			/*
			var myAjax = new Request.HTML({
				'url':'/base_loisir/demande/annuler_demande/', 
				method:'post', data:$('frmCriteria'), 
				onComplete: function(response) {
					alert('Response: ' + response); 
				}
			});
			myAjax.send();
			*/
		});
		<?php } ?>
		
		<?php } ?>
	
	});
	</script>
	
	<style type="text/css">
	
	</style>
</head>
<body>
	<div id="tpl_wrapper_page">
				
		<div id="tpl_header">
			<div>
				<a id="tpl_title" href="" target="_self">R&eacute;servations base de Loisirs</a>
			</div>
		</div> <!-- end #tpl_header -->
		
		<div id="tpl_main_body">
					<div class="generic_menu">
						<?php echo $this->load->view('templates/elements/generic_menu'); ?>			
					</div>		
	<div style="margin-left:0px;" id="tpl_wrapper_body">
		<div id="tpl_inner_body">
			<?php echo $this->load->view('templates/elements/menu_gauche'); ?>
								
			<div id="body_content">
				<div id="tpl_info_top" >
						
				</div>
						
		<?php if($message != '') { ?>				
		<div id="fqdn_notification">
			<?php echo $message; ?>
		</div>
		<?php } else { ?>
		<div id="fqdn_notification" style="display:none;width: 75%;">
			
		</div>
		<?php } ?>
		<br />
		<form class="form no_bottom resa" method="get" enctype="application/x-www-form-urlencoded" action="" name="frmCriteria" target="_parent" id="frmCriteria">
			<div class="title">
				Formulaire de r&eacute;servation<br /><!--<span class="last_update"></span>-->
			</div>
		
		<div id="section_headline">
		<script type="text/javascript">
		</script>

			<table class="ticket_header">
				<tbody><tr>
				<td class="ticket_header_td">
					<table class="ticket_header_sub">
						<tbody>
							<tr>
								<th class="cell_title"></th>
								<td width="12%"></td>
								<td width="3%"></td>
								<td width="8%" class="cell_title"></td>
								<td width="12%"></td>
								<td width="2%"></td>
							</tr>
							<tr>
								<th class="cell_title">Subsidiary<span class="mandatory">*</span></th>
								<td colspan="4" class="cell_flag" style="background-image: url( 'assets/base_loisirs/images/cm.png' );"><input name="sub_id" value="3" type="hidden">CAMEROON</td>
							</tr>
							<tr>
								<th class="cell_title">Motif</th>
								<td colspan="3"><input name="motif_name" type="text" id="motif_name" value="<?php echo $this->session->userdata('Last_Name') . " " . $this->session->userdata('First_Name'); ?>" maxlength="150" class="input_wide">
								<input name="id_user_staff" type="hidden" id="id_user_staff" value="<?php echo $this->session->userdata('id_user_staff'); ?>" />
								<input name="motif" type="hidden" id="motif" value="<?php echo $this->session->userdata('Last_Name') . " " . $this->session->userdata('First_Name'); ?>" />
								</td>
							</tr>
							<tr>
								<th class="cell_title">Ayant Droit</th>
								<td colspan="3">
								<select name="id_user_staff" type="text" id="id_user_staff" class="input_half_wide" style="float:left; line-height:20px;" >
									<option value="">Selectionner ayant droit</option>
									<?php foreach($ad as $a) { ?>
				   
									<option value="<?php echo $a->user_id; ?>"><?php echo $a->nom; ?></option>
									
									<?php } ?>
								</select>
								</td>
							</tr>
							<tr>
								<th class="cell_title">Case choisie</th>
								<td colspan="4">
									<?php 
										$options = array(
										  '1' => 'Case Verte',
										  '2' => 'Case Bleue',
										  '3' => 'Grande Case',
										  '4' => 'Case Jaune',
										);
										echo form_dropdown('id_case', $options, $this->session->userdata('id_case'), 'id="id_case" class="input_half_wide" style="float:left; line-height:20px;" ');
									?>
									<!--
									<select name="id_case" id="id_case" class="input_half_wide" style="float:left; line-height:20px;">
										<option value="1">Case Verte</option>
										<option value="2">Case Bleue</option>
										<option value="3">Grande Case</option>
										<option value="4">Case Jaune</option>
									</select>-->
									<div class="msg_tip tips case_verte" id="case_verte" title="Case Verte : Logement 8 personnes (2 chambres + 1 studio)" style="cursor: pointer;">&nbsp;</div>
									<div class="msg_tip tips invisible case_bleue" id="case_bleue" title="Case Bleue : Logement 8 personnes (2 chambres + 1 studio)" style="cursor: pointer;">&nbsp;</div>
									<div class="msg_tip tips invisible gde_case" id="gde_case" title="Grande Case : Logement de 11 personnes (4 chambres)" style="cursor: pointer;">&nbsp;</div>
									<div class="msg_tip tips invisible case_jaune" id="case_jaune" title="Case Jaune : Logement 8 personnes (2 chambres + 1 studio)" style="cursor: pointer;">&nbsp;</div>
								</td>
							</tr>
							<tr>
								<th class="cell_title">Date arriv&eacute;e</th>
								<td>
									<input name="bl_date_arr" class="DatePicker input_type fl" type="text" id="bl_date_arr" value="<?php echo $this->session->userdata('date_arrivee'); ?>" maxlength="10" style="padding-right: 22px;" class="input_date input_wide">
									<a href="#" class="eraser fl" onclick="document.getElementById('bl_date_arr').value='';return false;">&nbsp;</a>
								</td>
								<td></td>
								<td class="cell_title_h">Heure arriv&eacute;e</td>
								<td>
									<input name="bl_heure_arr" type="text" id="bl_heure_arr" placeholder="hh:mm" onblur="this.value=formatHeure(this.value, 'a');" value="<?php echo $this->session->userdata('heure_arrivee'); ?>" maxlength="100" class="input_date fl">
									<a href="#" class="eraser fl" onclick="document.getElementById('bl_heure_arr').value='';return false;" style="padding: 0 8px 0 20px;">&nbsp;</a>
								</td>
							</tr>
							<tr>
								<th class="cell_title">Date d&eacute;part</th>
								<td>
									<input name="bl_date_dep" class="DatePicker input_type fl" type="text" id="bl_date_dep" value="" maxlength="100" class="input_date input_wide">
									<a href="#" class="eraser fl" onclick="document.getElementById('bl_date_dep').value='';return false;">&nbsp;</a>
								</td>
								<td></td>
								<td class="cell_title_h">Heure d&eacute;part</td>
								<td>
									<input name="bl_heure_dep" type="text" id="bl_heure_dep" placeholder="hh:mm" onblur="this.value=formatHeure(this.value, 'd');" value="<?php echo $this->session->userdata('heure_depart'); ?>"  maxlength="100" class="input_date fl">
									<a href="#" class="eraser fl" onclick="document.getElementById('bl_heure_dep').value='';return false;" style="padding: 0 8px 0 20px;">&nbsp;</a>
								</td>
							</tr>
						
							<tr>
								<th class="cell_title">
									<?php 
										// $data = array(
											// 'name'        => 'chk_invites',
											// 'id'          => 'chk_invites',
											// 'value'       => $this->session->userdata('invites'),
											
											// 'style'       => 'cursor: default;',
											// );

										// echo form_checkbox($data);
									?>
								<input name="chk_invites" type="checkbox" id="chk_invites" <?php if($this->session->userdata('invites')=='o') echo 'checked="checked"'; ?> value="1" style="cursor: default;">
									
								</th>
								
								<td colspan="4">
									<span class="cl fl">Famille(s) Invit&eacute;e(s)</span>
									<?php 
										$options = array(
										  '1' => '1',
										  '2' => '2',
										  '3' => '3',
										  '4' => '4',
										);
										echo form_dropdown('nb_famille', $options, $this->session->userdata('nb_invites'), 'class="input_half_wide cl" style="float:left; line-height:20px; width:10% !important;" id="nb_famille"');
									?>
									
									<div class="fl cl">
										<textarea placeholder="Pr&eacute;cisez quelques d&eacute;tails sur vos invit&eacute;s" class="msg_to_cos msg_info_old" rows="4" cols="50" style="display:none;background-image:none;" id="invite_cmt" name="invite_cmt"><?php echo $this->session->userdata('details'); ?></textarea>
									</div>
								</td>
								
							</tr>
					
							<tr>
								<th class="cell_title">Montant</th>
								<td colspan="3"><input name="montant" type="text" id="montant" value="" maxlength="100" class="input_wide"></td>
							</tr>
						
				</tbody></table></td>
				<td class="ticket_header_td">
				</td>
				</tr>
				</tbody>
				</table>	
		</div>
		<table class="form_table">
			<tbody>
				<tr>
					<td align="right" colspan="2" class="ithd_wrapper_button">
						<div id="save_global">
							<span id="notification" style="float: left; line-height: 26px; font-size:12px"> Veuillez remplir les détails de votre réservation! </span>
							<input name="envoyer_demande" type="submit" id="envoyer_demande" <?php if($message != '') echo "disabled=disabled style='background-color: #d6d6d6 !important;'"; ?> value="Enregistrer votre réservation" class="tpl_button_save" />
							<input name="annuler_demande" type="button" id="annuler_demande" value="Annuler" class="tpl_button_cancel" />
							<input name="demande_id" type="hidden" id="demande_id" value="<?php echo $this->session->userdata('id_demandes'); ?>" />
							<input name="attente" type="hidden" id="attente" value="non" />
							<input name="saved" type="hidden" id="saved" value="non" />
						</div>  
					</td>
				</tr>
			</tbody>
		</table>
		</form>
		<br />
		<div id="broadcast" style="width : 75%; font-size : 12px">
			
		</div>
		<!--
<div align="center" id="welcome">Welcome to the Intranet<br /></div>
<div align="center" id="contact">If you are a new user or you have queries <b>about your Intranet access</b>, please <a href="javascript:openPopup('contact.php', 'ForgotPassword', 'activity=no,scrollbars=yes,width=450, height=250, top=100, left=100, resizable=no');">contact us</a> </div>
-->

<script type="text/javascript">
	
	var f = <?php echo strtotime('+8 days'); ?>;
	var f = <?php echo strtotime($this->saison->fin_saison($this->session->userdata('id_saison'))); ?>;
/*
	window.addEvent('domready', function()
	{
		// Ajoute le title dans une popup instantée pour les éléments pourvu d'un title.
		$$( '.tips' ).each( function( el ) {
			el.addEvents({
				mouseover: function( e ) {
					if( !this.saved_title ) {
						this.saved_title = this.title;
					}
					this.title = '';
					this.style.cursor = 'pointer';
					popupOutline( this.saved_title );
				},
				mouseout: function( e ) { nd(); }
			});
		});
	} );
	<?php echo $this->session->userdata('date_arrivee') ?>
	*/
window.addEvent('domready', function() {
	var notif = new Fx.Slide('broadcast');
	
	
		$('id_case').addEvents({
			'change' : function() {
				$('notification').set('html', 'Veuillez remplir les détails de votre réservation!');
				$('attente').value = 'non';
				if(notif)
					notif.slideOut();
				if(frmCriteria.demande_id.value == "") {
					$('envoyer_demande').value = 'Enregistrer votre réservation';
				} else {
					$('envoyer_demande').value = 'Modifier votre réservation';
				}
			}
		});
	
	
	<?php if($this->session->userdata('date_arrivee')) { ?>
	var message = new Fx.Slide('fqdn_notification');
	
	$('id_case').addEvents({
		'change' : function() {
			//event.stop();
			$('envoyer_demande').value = 'Modifier votre réservation';
			$('attente').value = 'non';
			//$('feedback').tween('opacity', 1);
			// Get the span's ID
			//spanID = $(this).get('id');
			// Set the text inside feedback div, reference
			// array index using spanID
			$('notification').set('html', 'Veuillez remplir les détails de votre réservation!');
			message.slideOut();
			
			// $('fqdn_notification').set('html', '');
			// $('fqdn_notification').setStyles({  display : "none" });
		}
	});
	<?php } ?>
	
	MooTools.lang.set('fr-FR', 'Date', {
		months:    ['Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Decembre'],
		days:      ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
		dateOrder: ['date', 'month', 'year', '/']
	});
	<?php if($this->session->userdata('date_arrivee') && !$this->session->userdata('session_prochaine')) { ?>
	var dateArr = new CalendarEightysix('bl_date_arr', {'defaultDate':'<?php echo $this->session->userdata('date_arrivee'); ?>', 'startMonday' : true, 'minDate':'<?php echo $this->session->userdata('date_arrivee'); ?>', 'format': '%d/%m/%Y', 'offsetY': -4, 'maxDate':'<?php echo date("m/d/Y",strtotime($this->saison->fin_saison($this->session->userdata('id_saison')))); ?>' });
	var dateDep = new CalendarEightysix('bl_date_dep', {'defaultDate':'<?php echo $this->session->userdata('date_depart'); ?>', 'minDate':'<?php echo $this->session->userdata('date_arrivee'); ?>', 'format': '%d/%m/%Y', 'offsetX': -4, 'maxDate':'<?php echo date("m/d/Y",strtotime($this->saison->fin_saison($this->session->userdata('id_saison')))); ?>' });
	<?php } elseif($this->session->userdata('date_arrivee') && $this->session->userdata('session_prochaine')) { ?>
	var dateArr = new CalendarEightysix('bl_date_arr', {'defaultDate':'<?php echo $this->session->userdata('date_arrivee'); ?>', 'startMonday' : true, 'minDate':'<?php echo $this->session->userdata('date_arrivee'); ?>', 'maxDate':'<?php echo date("m/d/Y",strtotime($this->saison->fin_saison_prochaine())); ?>', 'format': '%d/%m/%Y', 'offsetY': -4 });
	var dateDep = new CalendarEightysix('bl_date_dep', {'defaultDate':'<?php echo $this->session->userdata('date_depart'); ?>', 'format': '%d/%m/%Y', 'minDate':'<?php echo $this->session->userdata('date_arrivee'); ?>', 'offsetY': -4, 'maxDate':'<?php echo date("m/d/Y",strtotime($this->saison->fin_saison_prochaine())); ?>' });
	<?php } elseif(!$this->session->userdata('date_arrivee') && $this->session->userdata('session_prochaine')) { ?>
	var dateArr = new CalendarEightysix('bl_date_arr', {'defaultDate':'<?php echo date("m/d/Y",strtotime('+8 days')); ?>', 'startMonday' : true, 'minDate':'<?php echo date("m/d/Y",strtotime('+4 days')); ?>', 'maxDate':'<?php echo date("m/d/Y",strtotime($this->saison->fin_saison_prochaine())); ?>', 'format': '%d/%m/%Y', 'offsetY': -4 });
	var dateDep = new CalendarEightysix('bl_date_dep', {'defaultDate':'<?php echo date("m/d/Y",strtotime('+11 days')); ?>', 'format': '%d/%m/%Y', 'minDate':'<?php echo date("m/d/Y",strtotime('+10 days')); ?>', 'offsetY': -4, 'maxDate':'<?php echo date("m/d/Y",strtotime($this->saison->fin_saison_prochaine())); ?>' });
	<?php } else { ?>
	var dateArr = new CalendarEightysix('bl_date_arr', {'defaultDate':'<?php echo date("m/d/Y",strtotime('+8 days')); ?>', 'startMonday' : true, 'minDate':'<?php echo date("m/d/Y",strtotime('+4 days')); ?>', 'maxDate':'<?php echo date("m/d/Y",strtotime($this->saison->fin_saison($this->session->userdata('id_saison')))); ?>', 'format': '%d/%m/%Y', 'offsetY': -4 });
	var dateDep = new CalendarEightysix('bl_date_dep', {'defaultDate':'<?php echo date("m/d/Y",strtotime('+11 days')); ?>', 'format': '%d/%m/%Y', 'minDate':'<?php echo date("m/d/Y",strtotime('+10 days')); ?>', 'offsetY': -4, 'maxDate':'<?php echo date("m/d/Y",strtotime($this->saison->fin_saison($this->session->userdata('id_saison')))); ?>' });
	<?php } ?>
	new Form.Placeholder('bl_heure_arr');
	new Form.Placeholder('bl_heure_dep');
	MooTools.lang.setLanguage('fr-FR');
	
	dateArr.addEvent('change', function(date) { 
		date = date.clone().increment(); //At least one day higher; so increment with one day
		dateDep.options.minDate = date; //Set the minimal date
		dateArr.options.minDate = 'tomorrow'; //Set the minimal date
		if(dateDep.getDate().diff(date) >= 1) dateDep.setDate(date); //If the current date is lower change it
		else dateDep.render(); //Always re-render
	<?php if($this->session->userdata('date_arrivee')) { ?>
		$('envoyer_demande').value = 'Modifier votre réservation';
		$('attente').value = 'non';
		$('notification').set('html', 'Veuillez remplir les détails de votre réservation!');
		message.slideOut();
		
	<?php } ?>
		if(notif) notif.slideOut();
		$('notification').set('html', 'Veuillez remplir les détails de votre réservation!');
		if(frmCriteria.demande_id.value == "") {
			$('envoyer_demande').value = 'Enregistrer votre réservation';
			$('attente').value = 'non';
		} else {
			$('envoyer_demande').value = 'Modifier votre réservation';
		}
	});
	// s'il y a une demande à annuler
	<?php if ($this->input->get('cancel_resa')) { ?>
	if (!window.location.origin)
	window.location.origin = window.location.protocol+"//"+window.location.host;
	var url_cancel = window.location.origin + '/base_loisir/demande/notif_cancel/';
	var Annuler = new Request({
				url: url_cancel,
				method: 'post',
				onComplete: function(response){
					
				}/* ,
				data: $('frmCriteria').toQueryString() */
			});
	Annuler.send();
	<?php } ?>
});	
</script>

<div id="zapette"></div>																							
</div>
</div> <!-- end #tpl_inner_body -->
				
			</div> <!-- end #tpl_wrapper_body -->			
			<div style="clear: both">&nbsp;</div>
			
		</div> <!-- end #tpl_main_body -->
		
	</div> <!-- end #tpl_wrapper_page -->
	<div style="clear: both">&nbsp;</div>	
</body>
</html>