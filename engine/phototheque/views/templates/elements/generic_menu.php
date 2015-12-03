<div align="left" class="top-menu-category">
	<div style="z-index:1;" id="menu-container-home">
		<?php
		 echo $this->load->view('common/menu', '', TRUE);
		?>
		<div class="login_div">
			<a id="tpl_edit_profile" href="#"><?php echo $this->session->userdata('nom') . ' ' . $this->session->userdata('prenom'); ?></a>
			<a class="link_top_menu_logout" href="<?php echo base_url('home.php/home/logout/'); ?>" target="_self">Logout</a>
		</div>
	</div>
	<div class="clear"></div>
</div>