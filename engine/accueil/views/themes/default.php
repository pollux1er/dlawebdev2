<!DOCTYPE html> 

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" > 
 <head>
  <title><?php echo $titre; ?></title>
  <!--<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $charset; ?>" />-->
  <meta http-equiv="X-UA-Compatible"  content="IE=9;" />
  <meta name=GENERATOR content="MSHTML 9.00.8112.16443" />

	<link rel="shortcut icon" type=image/ico href="<?php echo $icon; ?>" />
	
<?php foreach($css as $url): ?>
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $url; ?>" />
<?php endforeach; ?>
<LINK rel=stylesheet type=text/css href="<?php echo css_url('perenco_intranet/print'); ?>" 
media=print>

<script src="<?php echo js_url('jquery/jquery'); ?>" type="text/javascript"></script>
<script src="<?php echo js_url('jquery.form'); ?>" type="text/javascript"></script>
<script src="<?php echo js_url('jquery-1.3.2.min'); ?>" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo js_url('xhr_test'); ?>"></script>
<script type="text/javascript" src="<?php echo js_url('it_assets/pagination'); ?>"></script>
<script type="text/javascript" src="<?php echo js_url('it_assets/cut_space'); ?>"></script>

 </head>
 <body style="">
 <div id="message" style="display:none;" align="center"><img id="load" style="display:none" src="<?php echo img_url('5.gif') ?>" /><div id="messcontent"><div id="box_return"></div><div id="mess_text"></div><div id="ex_mess"><img src="<?php echo img_url('exitblue.png') ?>"/></div></div></div>
  <div id="tpl_wrapper_page">
	
	<DIV id="tpl_header" >
		<DIV >
		<A id="tpl_title" href="<?php echo base_url().'index.php/accueil'; ?>"></A></DIV>
	</DIV> <!-- end #tpl_header -->
  
	<div id="tpl_main_body">
		<div class="generic_menu">
			<div class="top-menu-category" align="left">
				<div style="z-index:1;" id="menu-container-home">
					<ul id="drop_down_menu_home">
					
						<?php $i = 0;
						foreach($menu as $men)
						{ ?>
							<li title="<?php echo $men['nom']; ?>" alt="<?php echo $men['nom']; ?>" class="menu link_top_menu_<?php echo $men['nom']; ?>">
								<a href="<?php echo "../".$men['lien']; ?>">										
									<?php echo $men['nom']; ?>
								</a>
								<ul id="sub_drop_down_<?php echo $i ?>" class="sub_drop_downs">
									<?php 
										foreach( $men['sous_menu'] as $ss)
										{
									?>		
											<LI><A href="<?php echo $ss['lien']; ?>" title="<?php echo $ss['nom']; ?>"><?php echo $ss['nom']; ?> </A></LI>
									<?php
										}
									?>
								</ul>
							</li>
						<?php $i++; 
						} ?>	
								
					</ul>
					<div class="login_div">
					<?php if( $this->session->userdata('nom') == '' ) { ?>
						<a class="link_top_menu_logout" href="<?php echo base_url().'index.php/login'?>">login</a>
					<?php } else { ?>
						<a id="tpl_edit_profile" href="#>"><?php echo $this->session->userdata('nom').' '.$this->session->userdata('prenom'); ?></a>
						<a class="link_top_menu_logout" href="<?php echo base_url().'index.php/login/logout'?>">Logout</a>
					<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	
   <?php echo $output; ?>
  </div>
<?php foreach($js as $url): ?>
<script type="text/javascript" src="<?php echo $url; ?>"></script> 
<?php endforeach; ?>  
 </body>
</html>