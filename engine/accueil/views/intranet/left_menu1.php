<?php 
$uri = $this->uri->segment(1);
//echo $this->uri->uri_string();
?>
<div id="left_menu">
	<div id="contacts_menu" class="left_menus_contact">
		<ul id="contacts_menu_content">
			<li class="need_access">
				<a title="" href="<?php echo base_url()."working_area"?>"><strong>Need an access?</strong></a>
			</li>
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
				<li><a href="http://dladev1/base_loisirs/attendance/" class="level2selected" target="_self"><span class="">&raquo; Planning des cases</span></a></li>
				<?php } else { ?>
				<li><a href="http://dladev1/base_loisirs/attendance/" class="level2" target="_self"><span class="">Planning des cases</span></a></li>
				<?php } ?>
				<?php if($uri == 'demande') { ?>
				<li><a href="http://dladev1/base_loisirs/demande/" class="level2selected" target="_self"><span>&raquo; Faire une r&eacute;servation</span></a></li>
				<?php } elseif ($this->uri->uri_string() == 'reservation/invitation' && $this->session->userdata('invitation')) { ?>
				<li><a href="http://dladev1/base_loisirs/reservation/invitation/" class="level2selected" target="_self"><span>&raquo; Faire une r&eacute;servation</span></a></li>
				<?php } elseif ($this->session->userdata('invitation')) { ?>
				<li><a href="http://dladev1/base_loisirs/reservation/invitation/" class="level2" target="_self"><span>Faire une r&eacute;servation</span></a></li>
				<?php } else { ?>
				<li><a href="http://dladev1/base_loisirs/demande/" class="level2" target="_self"><span>Faire une r&eacute;servation</span></a></li>
				<?php } ?>
				<?php if($uri == 'logs') { ?>
				<li><a href="http://dladev1/base_loisirs/logs/demandes" class="level2selected" target="_self"><span class="">&raquo; Historiques</span></a></li>
				<?php } else { ?>
				<li><a href="http://dladev1/base_loisirs/logs/demandes" class="level2" target="_self"><span class="">Historiques</span></a></li>
				<?php } ?>
				
				<li><a href="file://///DLAFP04.cm.perenco.com/KRIBI\Reglement\Regl Interne Cases KRIBI - 2011 - révisé.pdf" class="level2"><span class="">Informations sur la base</span></a></li>
			</ul>
	</div>
		
	<div class="cleardiv">&nbsp;</div>
	<div class="left_menus">
		<h2>About</h2>
		<ul>
			<?php if($this->uri->uri_string() == 'base_loisirs/about') { ?>
			<li><a class="level1 level2selected" href="http://dladev1/base_loisirs/base_loisirs/about/" target="_self"><span>&raquo; About</span></a></li>
			<?php } else { ?>
			<li><a class="level1" href="http://dladev1/base_loisirs/base_loisirs/about/" target="_self"><span>About</span></a></li>
			<?php } ?>
		</ul>
	</div>
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