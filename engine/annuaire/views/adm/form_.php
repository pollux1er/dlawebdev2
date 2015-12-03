<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<title><?php echo $title; ?></title>
	<base href="<?php echo base_url(); ?>" target="_blank">
	<meta http-equiv="X-UA-Compatible" content="IE=9;" />
	<meta http-equiv="Content-type" content="text/html; charset=UTF-8"/>
	<link rel="shortcut icon" href="<?php echo base_url(); ?>/favicon.ico" type="image/x-icon">
<link rel="icon" href="<?php echo base_url(); ?>/favicon.ico" type="image/x-icon">
	<link href="assets/base_loisirs/css/jquery-ui-1.8.22.custom.css?nocache=60" rel="stylesheet" type="text/css" />
	<link href="assets/base_loisirs/css/left_menu.css?nocache=60" rel="stylesheet" type="text/css" />
	<link href="assets/base_loisirs/css/top_menu.css?nocache=60" rel="stylesheet" type="text/css" />
	<link href="assets/base_loisirs/css/main.css?nocache=60" rel="stylesheet" type="text/css" />
	<link href="assets/base_loisirs/css/generic.css?nocache=60" rel="stylesheet" type="text/css" />
	<link href="assets/base_loisirs/css/print.css?nocache=60" rel="stylesheet" type="text/css" media="print" />
	<link href="assets/base_loisirs/css/style.css?nocache=60" rel="stylesheet" type="text/css" />
	<link href="assets/base_loisirs/css/style1.css?nocache=60" rel="stylesheet" type="text/css" />
	<link href="assets/base_loisirs/css/base_loisir.css?nocache=60" rel="stylesheet" type="text/css" />
	
	<link href="assets/annuaire/css/annuaire.css?nocache=60" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="assets/annuaire/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/annuaire/css/font-awesome.min.css">

	
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

	<script src="assets/annuaire/js/angular.min.js"></script>
	


	<script>
	
	</script>
	
	<style type="text/css">
	
	</style>

	<script type="text/javascript">

	</script>
</head>
<body>
	<div id="tpl_wrapper_page">
				
		<div id="tpl_header">
			<div>
				<a id="tpl_title" href="" target="_self">Annuaire Perenco Cameroun</a>
			</div>
		</div> <!-- end #tpl_header -->
		
		<div id="tpl_main_body">
			<div class="generic_menu">
				<?php echo $this->load->view('templates/elements/generic_menu'); ?>			
			</div>	
			<div id="tpl_wrapper_body" style="margin-left:0px;">
				<div id="tpl_inner_body">
					<?php echo $this->load->view('templates/elements/menu_gauche'); ?>
					<div id="body_content">
						<div id="tpl_info_top">
								
						</div>

						<?php 
							
							if($type == 'gsm') {
								$data['users'] = $this->annuaire->get_all_intranet_and_third();
								$data['actual_user'] = $this->annuaire->get_user_from_number($this->input->get('gsm'));
								//var_dump($data['users']); die;
								echo $this->load->view('adm/set_gsm_to_user', $data);
							}
							elseif($type == 'user') {
								$data['users'] = $this->annuaire->get_all_users_without_pabx();
								echo $this->load->view('adm/new_user', $data);
							} else {
								$data['users'] = $this->annuaire->get_all_users_without_pabx();
								echo $this->load->view('adm/new_pabx', $data);
							}
						?>
																							</div>
				</div> <!-- end #tpl_inner_body -->
				
			</div>
		</div>
	</div>
	
	<div style="clear: both">&nbsp;</div>	
</body>
</html>