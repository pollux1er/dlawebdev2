<div style="margin-left:0px;" id="tpl_wrapper_body">
	<div id="tpl_inner_body">
			<?php
				if( $this->session->userdata('nom') != '' )
				{
					echo $contenu;
				}
				 
			?>
		