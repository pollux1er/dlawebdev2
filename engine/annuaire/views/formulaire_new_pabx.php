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
	<link rel="stylesheet" media="all" type="text/css" href="assets/base_loisirs/css/jquery-ui-timepicker-addon.css" />
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
	<script type="text/javascript" src="assets/base_loisirs/js/Form.Placeholder.js?nocache=60"></script><!--
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="http://code.jquery.com/ui/1.11.0/jquery-ui.min.js"></script>-->
	<link rel="stylesheet" media="all" type="text/css" href="http://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css" />
	<script type="text/javascript" src="assets/base_loisirs/js/jquery-ui-timepicker-addon.js"></script>
	<script type="text/javascript" src="assets/base_loisirs/js/i18n/jquery-ui-timepicker-addon-i18n.min.js"></script>

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
		</div>			
	<div style="margin-left:0px;" id="tpl_wrapper_body">
		<div id="tpl_inner_body">
			<?php echo $this->load->view('templates/elements/menu_gauche'); ?>
								
			<div id="body_content">
				<div id="tpl_info_top" >
						
				</div>
						
						
		<div id="fqdn_notification">
			
		</div>
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
								<th class="cell_title">Nom du souscripteur</th>
								<td colspan="3"><input name="name_user_staff" type="text" id="name_user_staff" value="<?php echo $this->session->userdata('Last_Name') . " " . $this->session->userdata('First_Name'); ?>" readonly=readonly maxlength="150" class="input_wide">
								<input name="id_user_staff" type="hidden" id="id_user_staff" value="<?php echo $this->session->userdata('iduser'); ?>" />
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
									
									<div class="msg_tip tips case_verte" id="case_verte" title="Case Verte : Logement 8 personnes (2 chambres + 1 studio)" style="cursor: pointer;">&nbsp;</div>
									<div class="msg_tip tips invisible case_bleue" id="case_bleue" title="Case Bleue : Logement 8 personnes (2 chambres + 1 studio)" style="cursor: pointer;">&nbsp;</div>
									<div class="msg_tip tips invisible gde_case" id="gde_case" title="Grande Case : Logement de 11 personnes (4 chambres)" style="cursor: pointer;">&nbsp;</div>
									<div class="msg_tip tips invisible case_jaune" id="case_jaune" title="Case Jaune : Logement 8 personnes (2 chambres + 1 studio)" style="cursor: pointer;">&nbsp;</div>
								</td>
							</tr>
							<tr>
								<th class="cell_title">
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
							<span id="notification" style="float: left; line-height: 26px; font-size:12px"> Veuillez remplir les détails de votre réservation! </span>
							<?php if(!$annuler) { ?>
							<input name="envoyer_demande" type="submit" id="envoyer_demande" <?php if($message != '') echo "disabled=disabled style='background-color: #d6d6d6 !important;'"; ?> value="Enregistrer votre réservation" class="tpl_button_save" />
							<?php } ?>
							<input name="annuler_demande" type="button" id="annuler_demande" value="Annuler" class="tpl_button_cancel" />
							
							
								
									<input name="envoyer_demande" type="submit" id="envoyer_demande" style='background-color: #d6d6d6 !important;' value="Modifier votre réservation" class="tpl_button_save" /> 
									
							
							<input name="annuler_demande" type="button" id="annuler_demande" value="Annuler votre Réservation" class="tpl_button_cancel" />
							
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
	

<script type="text/javascript">
	
	
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