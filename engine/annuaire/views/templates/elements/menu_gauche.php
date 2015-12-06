<?php 
$uri = $this->uri->segment(1);
$this->load->model('user_model', 'user');
$this->load->model('annuaire_model', 'annuaire');
//echo $this->uri->uri_string();
?>
<div id="left_menu"><!--
	<div id="contacts_menu" class="left_menus_contact">
		<ul id="contacts_menu_content">
			<li class="need_access">
				<a title="" href="/infos.php"><strong>Need an access?</strong></a>
			</li>
		</ul>
	</div>
	<div class="cleardiv">&nbsp;</div>--><!--
	<div class="left_menus">
		<h2>Mon Planing</h2>
		<ul>
			<li><a href="#" onClick="return false;"  class="level2_off"><span class="gris">Consulter</span></a></li>
			<li><a href="#" onClick="return false;" class="level2_off" title=""><span class="gris">Annuler une r&eacute;servation</span></a></li>
			<li><a href="#" onClick="return false;" class="level2_off" title="Intranet"><span class="gris">Mes Notifications</span></a></li>
		</ul>
	</div>-->
	<div class="left_menus_contact" id="contacts_menu">
		<ul id="contacts_menu_content">
			<li><strong>Site contact</strong></li>
			<li><a style="padding-left:5px;" class="link_contact_email" href="mailto:passontia@cm.perenco.com">ASSONTIA Patient</a></li>
			<div style="height:8px">&nbsp;</div>
		</ul>
	</div>
	
	<div class="left_menus">
		<h2>Annuaires</h2>								
			<ul>
				<?php if($this->uri->uri_string() == 'annuaire') { ?>
				<li><a href="annuaire.php/annuaire/" class="level2selected" target="_self"><span class="">&raquo; Annuaire Interne</span></a></li>
				<?php } else { ?>
				<li><a href="annuaire.php/annuaire/" class="level2" target="_self"><span class="">Annuaire Interne</span></a></li>
				<?php } ?>
			</ul>
	</div>
	<?php if($this->annuaire->is_super_admin($this->session->userdata('iduser'))) { ?>
	<div class="left_menus">
		<h2>Suivi de Coûts</h2>								
			<ul>
				<?php if($this->uri->uri_string() == 'annuaire/cout_pabx') { ?>
				<li><a href="annuaire.php/annuaire/cout_pabx" class="level2selected" target="_self"><span class="">&raquo; Côut Taxation</span></a></li>
				<?php } else { ?>
				<li><a href="annuaire.php/annuaire/cout_pabx" class="level2" target="_self"><span class=""> Côut Taxation</span></a></li>
				<?php } ?>
				<?php if($this->uri->uri_string() == 'annuaire/cout_gsm') { ?>
				<li><a href="annuaire.php/annuaire/cout_gsm" class="level2selected" target="_self"><span class="">&raquo; Côut GSM</span></a></li>
				<?php } else { ?>
				<li><a href="annuaire.php/annuaire/cout_gsm" class="level2" target="_self"><span class=""> Côut GSM</span></a></li>
				<?php } ?>
				<?php if($this->uri->uri_string() == 'annuaire/cout_gsm_pabx') { ?>
				<li><a href="annuaire.php/annuaire/cout_gsm_pabx" class="level2selected" target="_self"><span class="">&raquo; Côut Taxation & GSM</span></a></li>
				<?php } else { ?>
				<li><a href="annuaire.php/annuaire/cout_gsm_pabx" class="level2" target="_self"><span class=""> Côut Taxation & GSM</span></a></li>
				<?php } ?>
				
			</ul>
	</div>
	<?php } ?>
	<?php if($this->annuaire->is_super_admin($this->session->userdata('iduser'))) { ?>
	<div class="left_menus">
		<h2>MAJ de Coûts</h2>								
			<ul>
				<?php if($this->uri->uri_string() == 'annuaire/admin_cout_pabx') { ?>
				<li><a href="annuaire.php/annuaire/admin_cout_pabx" class="level2selected" target="_self"><span class="">&raquo; Taxation</span></a></li>
				<?php } else { ?>
				<li><a href="annuaire.php/annuaire/admin_cout_pabx" class="level2" target="_self"><span class=""> Taxation</span></a></li>
				<?php } ?>
				<?php if($this->uri->uri_string() == 'annuaire/admin_cout_gsm' || $this->uri->uri_string() == 'annuaire/load_csv_gsm' || $this->uri->uri_string() == 'annuaire/set_gsm_to_user') { ?>
				<li><a href="annuaire.php/annuaire/admin_cout_gsm" class="level2selected" target="_self"><span class="">&raquo; GSM</span></a></li>
				<?php } else { ?>
				<li><a href="annuaire.php/annuaire/admin_cout_gsm" class="level2" target="_self"><span class=""> GSM</span></a></li>
				<?php } ?>
				<?php if($this->uri->uri_string() == 'annuaire/admin_tiers') { ?>
				<li><a href="annuaire.php/annuaire/admin_tiers" class="level2selected" target="_self"><span class="">&raquo; Utilisateurs Tiers</span></a></li>
				<?php } else { ?>
				<li><a href="annuaire.php/annuaire/admin_tiers" class="level2" target="_self"><span class=""> Utilisateurs Tiers</span></a></li>
				<?php } ?>
			</ul>
	</div>
	<?php } ?>
	
	

</div>