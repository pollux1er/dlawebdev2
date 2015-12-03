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
			<li><a style="padding-left:5px;" class="link_contact_email" href="mailto:mravaatanga@cm.perenco.com">NDOMOUKA MBANGO Louise...</a></li>
			<div style="height:8px">&nbsp;</div>
		</ul>
	</div>
	<div class="cleardiv">&nbsp;</div>
	<div class="left_menus">
		<h2>Photothèque</h2>								
			<ul>
				<?php if($this->uri->uri_string() == 'albums') { ?>
				<li><a href="phototheque.php/albums" class="level2selected" target="_self"><span class="">&raquo; Liste des albums</span></a></li>
				<?php } else { ?>
				<li><a href="phototheque.php/albums" class="level" target="_self"><span class=""> Liste des albums</span></a></li>
				<?php } ?>
				<li><a href="phototheque.php/album3/" class="level2" target="_self"><span class=""> Créer nouvel album</span></a></li>
				<li><a href="phototheque.php/album2/" class="level2" target="_self"><span class="">Ajouter une photo</span></a></li>
				
				
				</li>
			</ul>
	</div>
	<div class="cleardiv">&nbsp;</div>
	<div class="left_menus">
		<h2>Diapositives</h2>								
			<ul>
				<li><a href="phototheque.php/album1/" class="level2" target="_self"><span class=""> Réglages</span></a></li>
				<?php if($this->uri->uri_string() == 'selection') { ?>
				<li><a href="phototheque.php/selection" class="level2selected" target="_self"><span class="">&raquo; Sélection</span></a></li>
				<?php } else { ?>
				<li><a href="phototheque.php/selection" class="level2" target="_self"><span class="">Sélection</span></a></li>
				<?php } ?>
				<li><a href="phototheque.php/album3/" class="level2" target="_self"><span class="">Ajouter une photo</span></a></li>
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
		
	<div class="cleardiv">&nbsp;</div>
	<div class="left_menus">
		<h2>Group</h2>								
			<ul>
				<li><a href="http://intranet.perenco.net/" class="level2 " target="_self"><span>Intranet Group</span></a></li>
			</ul>
	</div>
</div>