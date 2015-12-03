<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<title><?php echo $title; ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<link rel="shortcut icon" type="image/ico" href="/favicon.ico" />
	<link href="assets/css/jquery-ui-1.8.22.custom.css?nocache=60" rel="stylesheet" type="text/css" />
	<link href="assets/css/left_menu.css?nocache=60" rel="stylesheet" type="text/css" />
	<link href="assets/css/top_menu.css?nocache=60" rel="stylesheet" type="text/css" />
	<link href="assets/css/main.css?nocache=60" rel="stylesheet" type="text/css" />
	<link href="assets/css/generic.css?nocache=60" rel="stylesheet" type="text/css" />
	<link href="assets/css/print.css?nocache=60" rel="stylesheet" type="text/css" media="print" />
	<link href="assets/css/style.css?nocache=60" rel="stylesheet" type="text/css" />
	<link href="assets/css/style1.css?nocache=60" rel="stylesheet" type="text/css" />
	<link href="assets/css/base_loisir.css?nocache=60" rel="stylesheet" type="text/css" />
	<link href="assets/css/calendar-eightysix-v1.1-default.css?nocache=60" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="assets/css/calendar-eightysix-v1.1-vista.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="assets/css/calendar-eightysix-v1.1-osx-dashboard.css" media="screen" />
	
	<link href="assets/css/datepicker.css" rel="stylesheet" type="text/css" />
	<!--<link href="assets/css/home.css?nocache=60" rel="stylesheet" type="text/css" media="all" />-->
	
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
	<script type="text/javascript" src="assets/js/jquery-1.10.2.min.js?nocache=60"></script>
	<script type="text/javascript" src="assets/js/jquery-ui-1.10.3.custom.min.js?nocache=60"></script>
	<script type="text/javascript" src="assets/js/jquery-impromptu.js?nocache=60"></script>
	<script type="text/javascript" src="assets/js/compatibility-jquery-mootools.js?nocache=60"></script>
	<script type="text/javascript" src="assets/js/overlib.js?nocache=60"></script>
	<script type="text/javascript" src="assets/js/mootools-1.2.5.min.js?nocache=60"></script>
	<script type="text/javascript" src="assets/js/mootools-more-1.2.5.1.min.js?nocache=60"></script>
	<script type="text/javascript" src="assets/js/common.js?nocache=60"></script>
	<script type="text/javascript" src="assets/js/common2.js?nocache=60"></script>
	<script type="text/javascript" src="assets/js/calendar-eightysix-v1.1.js?nocache=60"></script>
	<script type="text/javascript" src="assets/js/base_loisir2.js?nocache=60"></script>
	<script type="text/javascript" src="assets/js/Form.Placeholder.js?nocache=60"></script>

	<script>
	
	window.addEvent('domready', function() {
		new CalendarEightysix('bl_date_arr', { 'defaultDate': '12/08/2014', 'offsetY': -4 });
		new CalendarEightysix('bl_date_dep', { 'defaultDate': '10/09/2014', 'minDate': 'tomorrow', 'offsetY': -4 });
		
		new Form.Placeholder('bl_heure_arr');
		new Form.Placeholder('bl_heure_dep');
	});
	</script>
	
	<style type="text/css">
	
	</style>
	</head>
<body>
	<div id="tpl_wrapper_page">
				
		<div id="tpl_header">
			<div>
				<a id="tpl_title" href="/index.php">R&eacute;servations base de Loisirs</a>
			</div>
		</div> <!-- end #tpl_header -->
		
		<div id="tpl_main_body">
					<div class="generic_menu">
				<div align="left" class="top-menu-category">
	<div style="z-index:1;" id="menu-container-home">
		<!--
		 menu effacee
		-->
		<div class="login_div">
			<a id="tpl_edit_profile" href="#"><?php echo $this->input->ip_address(); ?></a>
						<a class="link_top_menu_logout" href="#">Logout</a>
		</div>
	</div>
	<div class="clear"></div>
</div>			</div>			
	<div style="margin-left:0px;" id="tpl_wrapper_body">
		<div id="tpl_inner_body">
			<div id="left_menu">
				<div id="contacts_menu" class="left_menus_contact">
					<ul id="contacts_menu_content">
						<li class="need_access">
							<a title="" href="/infos.php"><strong>Need an access?</strong></a>
						</li>
					</ul>
				</div>
				<div class="cleardiv">&nbsp;</div>
				<div class="left_menus">
					<h2>Mon Planing</h2>
					<ul>
						<li><a href="#" class="level2_off"><span class="gris">Consulter</span></a></li>
						<li><a href="#" class="level2_off" title=""><span class="gris">Annuler une r&eacute;servation</span></a></li>
						<li><a href="#" class="level2_off" title="Intranet"><span class="gris">Mes Notifications</span></a></li>
					</ul>
				</div>
				<div class="cleardiv">&nbsp;</div>
				<div class="left_menus">
					<h2>Base de loisirs</h2>								
						<ul>
							<li><a href="calendar/index" class="level2 "><span class="">Saison en cours</span></a></li>
							<li><a href="#" class="level2selected"><span>&raquo; Faire une r&eacute;servation</span></a></li>
							<li><a href="#" class="level2_off"><span class="gris">R&egrave;glement</span></a></li>
							<li><a href="#" class="level2_off"><span class="gris">Tarifs</span></a></li>
						</ul>
				</div>
				<div class="cleardiv">&nbsp;</div>
			</div>					
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
				Formulaire de demande de r&eacute;servations<br /><!--<span class="last_update"></span>-->
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
								<td colspan="4" class="cell_flag" style="background-image: url( 'assets/images/cm.png' );"><input name="sub_id" value="3" type="hidden">CAMEROON</td>
							</tr>
							<tr>
								<th class="cell_title">Nom du souscripteur</th>
								<td colspan="3"><input name="id_user_staff" type="text" id="id_user_staff" value="" readonly=readonly maxlength="100" class="input_wide"></td>
							</tr>
							<tr>
								<th class="cell_title">Case choisie</th>
								<td colspan="4">
									
									
									<select name="id_case" id="id_case" class="input_half_wide" style="float:left; line-height:20px;">
										<option value="1">Case Verte</option>
										<option value="2">Case Bleue</option>
										<option value="3">Grande Case</option>
										<option value="4">Case Jaune</option>
									</select>
									<div class="msg_tip tips case_verte" id="case_verte" title="Case Verte : Logement 8 personnes (2 chambres + 1 studio)" style="cursor: pointer;">&nbsp;</div>
									<div class="msg_tip tips invisible case_bleue" id="case_bleue" title="Case Bleue : Logement 8 personnes (2 chambres + 1 studio)" style="cursor: pointer;">&nbsp;</div>
									<div class="msg_tip tips invisible gde_case" id="gde_case" title="Grande Case : Logement de 11 personnes (4 chambres)" style="cursor: pointer;">&nbsp;</div>
									<div class="msg_tip tips invisible case_jaune" id="case_jaune" title="Case Jaune : Logement 8 personnes (2 chambres + 1 studio)" style="cursor: pointer;">&nbsp;</div>
								</td>
							</tr>
							<tr>
								<th class="cell_title">Date arriv&eacute;e</th>
								<td>
									<input name="bl_date_arr" class="DatePicker input_type fl" type="text" id="bl_date_arr" value="" maxlength="10" style="padding-right: 22px;" class="input_date input_wide">
									<a href="#" class="eraser fl" onclick="document.getElementById('bl_date_arr').value='';return false;">&nbsp;</a>
								</td>
								<td></td>
								<td class="cell_title_h">Heure arriv&eacute;e</td>
								<td>
									<input name="bl_heure_arr" type="text" id="bl_heure_arr" placeholder="hh:mm" onblur="this.value=formatHeure(this.value, 'a');" value="" maxlength="100" class="input_date fl">
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
									<input name="bl_heure_dep" type="text" id="bl_heure_dep" placeholder="hh:mm" onblur="this.value=formatHeure(this.value, 'd');" value=""  maxlength="100" class="input_date fl">
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
									<input name="chk_invites" type="checkbox" id="chk_invites" value="1" style="cursor: default;">
								</th>
								<td colspan="4">
									<span class="cl fl">Famille(s) Invit&eacute;e(s)</span>
									
									<div class="fl cl">
										<textarea placeholder="Pr&eacute;cisez quelques d&eacute;tails sur vos invit&eacute;s" class="msg_to_cos msg_info_old" rows="4" cols="50" style="display:none;background-image:none;" id="invite_cmt" name="invite_cmt"><?php echo utf8_decode($this->session->userdata('details')); ?></textarea>
									</div>
								</td>
							</tr>
					
							<tr>
								<th class="cell_title">Montant</th>
								<td colspan="3"><input name="montant" type="text" id="montant" value="<?php echo $this->session->userdata('frais'); ?>" readonly=readonly maxlength="100" class="input_wide"></td>
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
							<span id="notification" style="float: left; line-height: 26px; display : none;"> Envoi de la demande ... </span>
							<input name="annuler_demande" type="button" id="annuler_demande" value="Annuler" class="tpl_button_cancel" onclick="window.location.href=''" />
							<input name="envoyer_demande" type="submit" id="envoyer_demande" <?php if($message != '') echo "disabled=disabled style='background-color: #d6d6d6 !important;'"; ?> value="Enregistrer votre demande" class="tpl_button_save" />
							<input name="demande_id" type="hidden" id="demande_id" value="<?php echo $this->session->userdata('id_demandes'); ?>" />
						</div>  
					</td>
				</tr>
			</tbody>
		</table>
		</form>


<script type="text/javascript">
	
</script>

<div id="zapette" ></div>																							</div>
				</div> <!-- end #tpl_inner_body -->
				
			</div> <!-- end #tpl_wrapper_body -->			
			<div style="clear: both">&nbsp;</div>
			
		</div> <!-- end #tpl_main_body -->
		
	</div> <!-- end #tpl_wrapper_page -->
	<div style="clear: both">&nbsp;</div>	
</body>
</html>