<?php 
$uri = $this->uri->segment(1);
$this->load->model('user_model', 'user');
//echo $this->uri->uri_string();
?>
<div id="left_menu">
	<div class="left_menus_contact" id="contacts_menu">
		<ul id="contacts_menu_content">
			<li><strong>Site contact</strong></li>
			<li><a style="padding-left:5px;" class="link_contact_email" href="mailto:mravaatanga@cm.perenco.com">EBENE SAMUEL</a></li>
			<div style="height:8px">&nbsp;</div>
		</ul>
	</div>
	<div class="cleardiv">&nbsp;</div>
	<div class="left_menus">
		<h2>Induction HSE</h2>								
			<ul>
				<?php if($this->uri->uri_string() == '') { ?>
				<li><a href="qhse.php" class="level2selected" target="_self"><span class="">&raquo; Support d'induction</span></a></li>
				<?php } else { ?>
				<li><a href="qhse.php" class="level2" target="_self"><span class="">Support d'induction</span></a></li>
				<?php } ?>
				
				<?php if($this->uri->uri_string() == 'induction/procedure') { ?>
				<li><a href="qhse.php/induction/procedure" class="level2selected" target="_self"><span class="">&raquo; Comment lancer le support</span></a></li>
				<?php } else { ?>
				<li><a href="qhse.php/induction/procedure" class="level2" target="_self"><span class="">Comment lancer le support</span></a></li>
				<?php } ?>
				
				<li><a target="_blank" href="http://localhost/dlawebdev2/assets/qhse/docs/livret_perenco_stagiaireA6_v6_BD.pdf" class="level2"><span class="">Livret de formation</span></a>
					
				</li>
			</ul>
	</div>
	
	<div class="cleardiv">&nbsp;</div>
	<div class="left_menus">
		<h2>About</h2>
		<ul>
			<?php if($this->uri->uri_string() == 'qhse/about') { ?>
			<li><a class="level1 level2selected" href="qhse.php/induction/about/" target="_self"><span>&raquo; About</span></a></li>
			<?php } else { ?>
			<li><a class="level1" href="qhse.php/induction/about/" target="_self"><span>About</span></a></li>
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