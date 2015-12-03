<?php 
$uri = $this->uri->segment(1);
$this->load->model('user_model', 'user');
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
			<li><a style="padding-left:5px;" class="link_contact_email" href="mailto:mravaatanga@cm.perenco.com">AVA ATANGA Marie...</a></li>
			<div style="height:8px">&nbsp;</div>
		</ul>
	</div>
	<div class="cleardiv">&nbsp;</div>
	<div class="left_menus">
		<h2>Base de Loisirs</h2>								
			<ul><!--<?php if($uri == 'calendar') { ?>
				<li><a href="calendar/" class="level2selected" target="_self"><span class="">&raquo; Vue calendier</span></a></li>
				<?php } else { ?>
				<li><a href="calendar/" class="level2" target="_self"><span class="">Vue calendrier</span></a></li>
				<?php } ?>-->
				<?php if($uri == 'attendance') { ?>
				<li><a href="base_loisirs.php/attendance/" class="level2selected" target="_self"><span class="">&raquo; Planning des cases</span></a></li>
				<?php } else { ?>
				<li><a href="base_loisirs.php/attendance/" class="level2" target="_self"><span class="">Planning des cases</span></a></li>
				<?php } ?>
				<?php if($uri == 'demande') { ?>
				<li><a href="base_loisirs.php/demande/" class="level2selected" target="_self"><span>&raquo; Faire une r&eacute;servation</span></a></li>
				<?php } elseif ($this->uri->uri_string() == 'reservation/invitation' && $this->session->userdata('invitation')) { ?>
				<li><a href="base_loisirs.php/reservation/invitation/" class="level2selected" target="_self"><span>&raquo; Faire une r&eacute;servation</span></a></li>
				<?php } elseif ($this->session->userdata('invitation')) { ?>
				<li><a href="base_loisirs.php/reservation/invitation/" class="level2" target="_self"><span>Faire une r&eacute;servation</span></a></li>
				<?php } else { ?>
				<li><a href="base_loisirs.php/demande/" class="level2" target="_self"><span>Faire une r&eacute;servation</span></a></li>
				<?php } ?>
				<?php if($uri == 'logs') { ?>
				<li><a href="base_loisirs.php/logs/demandes" class="level2selected" target="_self"><span class="">&raquo; Historiques</span></a></li>
				<?php } else { ?>
				<li><a href="base_loisirs.php/logs/demandes" class="level2" target="_self"><span class="">Historiques</span></a></li>
				<?php } ?>
				
				<li><a target="_blank" href="http://dlawebprd2.cm.perenco.com/assets/base_loisirs/img/Reglement.pdf" class="level2"><span class="">Informations sur la base</span></a>
					
				</li>
			</ul>
	</div>
	
	<div class="cleardiv">&nbsp;</div>
	<div class="left_menus">
		<h2>About</h2>
		<ul>
			<?php if($this->uri->uri_string() == 'base_loisirs/about') { ?>
			<li><a class="level1 level2selected" href="base_loisirs.php/base_loisirs/about/" target="_self"><span>&raquo; About</span></a></li>
			<?php } else { ?>
			<li><a class="level1" href="base_loisirs.php/base_loisirs/about/" target="_self"><span>About</span></a></li>
			<?php } ?>
		</ul>
	</div>
	<?php if($this->user->is_manager($this->session->userdata('iduser')) || $this->user->is_administrator($this->session->userdata('iduser'))) { ?>
	<div class="cleardiv">&nbsp;</div>
	<div class="left_menus">
		<h2>Gestion</h2>								
			<ul>
				<!--<li><a href="" class="level2_off " target="_self"><span class="gris">Lister demandes</span></a></li>-->
				<?php if($this->uri->uri_string() == 'admresas') { ?>
				<li><a href="base_loisirs.php/admresas/" class="level2selected " target="_self"><span>&raquo; Lister r&eacute;servations</span></a></li>
				<?php } else { ?>
				<li><a href="base_loisirs.php/admresas/" class="level2 " target="_self"><span>Lister r&eacute;servations</span></a></li>
				<?php } ?>
				<?php if($this->uri->uri_string() == 'admresas/users') { ?>
				<li><a href="base_loisirs.php/admresas/users" class="level2selected " target="_self"><span>&raquo; Lister ayants droits</span></a></li>
				<?php } else { ?>
				<li><a href="base_loisirs.php/admresas/users" class="level2 " target="_self"><span>Lister ayants droits</span></a></li>
				<?php } ?>
				<li><a href="" class="level2_off " target="_self"><span class="gris">Rechercher</span></a></li>
				<?php if($this->uri->uri_string() == 'admresas/booking_report') { ?>
				<li><a href="base_loisirs.php/admresas/booking_report" class="level2selected" target="_self"><span class="">&raquo; Rapports d'occupation</span></a></li>
				<?php } else { ?>
				<li><a href="base_loisirs.php/admresas/booking_report" class="level2 " target="_self"><span>Rapports d'occupation</span></a></li>
				<?php } ?>
				<li><a href="" class="level2_off " target="_self"><span class="gris">Statistiques</span></a></li>
			</ul>
	</div>
	<?php  } ?>
	<?php if($this->user->is_hr_manager($this->session->userdata('iduser'))) { ?>
	<div class="cleardiv">&nbsp;</div>
	<div class="left_menus">
		<h2>Gestion RH</h2>								
			<ul>
				<!--<li><a href="" class="level2_off " target="_self"><span class="gris">Lister demandes</span></a></li>-->
				<?php if($this->uri->uri_string() == 'admresas/manage_users') { ?>
				<li><a href="base_loisirs.php/admresas/manage_users" class="level2selected " target="_self"><span>&raquo; Gestion des ayants droits</span></a></li>
				<?php } else { ?>
				<li><a href="base_loisirs.php/admresas/manage_users" class="level2 " target="_self"><span>Gestion des ayants droits</span></a></li>
				<?php } ?>
			</ul>
	</div>
	<?php  } ?>
	<?php if($this->user->is_hr_administrator($this->session->userdata('iduser'))) { ?>
	<div class="cleardiv">&nbsp;</div>
	<div class="left_menus">
		<h2>Administration RH</h2>								
			<ul>
				<!--<li><a href="" class="level2_off " target="_self"><span class="gris">Lister demandes</span></a></li>-->
				<?php if($this->uri->uri_string() == 'admresas/manage_users') { ?>
				<li><a href="base_loisirs.php/admresas/manage_users" class="level2selected " target="_self"><span>&raquo; Gestion des ayants droits</span></a></li>
				<?php } else { ?>
				<li><a href="base_loisirs.php/admresas/manage_users" class="level2 " target="_self"><span>Gestion des ayants droits</span></a></li>
				<?php } ?>
				<?php if($this->uri->uri_string() == 'admresas/manage_roles') { ?>
				<li><a href="base_loisirs.php/admresas/manage_roles" class="level2selected " target="_self"><span>&raquo; Gestion des rôles</span></a></li>
				<?php } else { ?>
				<li><a href="base_loisirs.php/admresas/manage_roles" class="level2 " target="_self"><span>Gestion des rôles</span></a></li>
				<?php } ?>
			</ul>
	</div>
	<?php  } ?>
	<div class="cleardiv">&nbsp;</div>
	<div class="left_menus">
		<h2>Besoin d'aide ?</h2>								
			<div style="background-color : white; padding:5px; border-bottom-left-radius : 6px; border-bottom-right-radius : 6px; font-weight : bold">
				<a href="mailto:passontia@cm.perenco.com?subject=[Aide]%20Base Loisir&cc=ggwanen@cm.perenco.com; tbell@cm.perenco.com">Contact Email</a><br />
				Appelez au 1027<br /> ou au 1510
			</div>
				<!--<li><a href="" class="level2_off " target="_self"><span class="gris">Lister demandes</span></a></li>-->

		
	</div>
	<div class="cleardiv">&nbsp;</div>
	<div class="left_menus">
		<h2>Group</h2>								
			<ul>
				<li><a href="http://intranet.perenco.net/" class="level2 " target="_self"><span>Intranet Group</span></a></li>
			</ul>
	</div>
</div>