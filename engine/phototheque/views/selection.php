<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<title><?php echo $title; ?></title>
	<base href="<?php echo base_url(); ?>" target="_blank">
	<meta http-equiv="X-UA-Compatible" content="IE=9;" />
	<meta http-equiv="Content-type" content="text/html; charset=UTF-8"/>
	<link rel="shortcut icon" href="<?php echo base_url(); ?>/favicon.ico" type="image/x-icon">
<link rel="icon" href="<?php echo base_url(); ?>/favicon.ico" type="image/x-icon">
	<link href="assets/phototheque/css/jquery-ui-1.8.22.custom.css?nocache=60" rel="stylesheet" type="text/css" />
	<link href="assets/phototheque/css/left_menu.css?nocache=60" rel="stylesheet" type="text/css" />
	<link href="assets/phototheque/css/top_menu.css?nocache=60" rel="stylesheet" type="text/css" />
	<link href="assets/phototheque/css/main.css?nocache=60" rel="stylesheet" type="text/css" />
	<link href="assets/phototheque/css/generic.css?nocache=60" rel="stylesheet" type="text/css" />
	<link href="assets/phototheque/css/print.css?nocache=60" rel="stylesheet" type="text/css" media="print" />
	<link href="assets/phototheque/css/style.css?nocache=60" rel="stylesheet" type="text/css" />
	<link href="assets/phototheque/css/style1.css?nocache=60" rel="stylesheet" type="text/css" />
	<link href="assets/phototheque/css/style_about.css?nocache=60" rel="stylesheet" type="text/css" />
	<link href="assets/phototheque/css/base_loisir.css?nocache=60" rel="stylesheet" type="text/css" />
	
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

	<script>
	
	</script>
	
	<style type="text/css">
	
	</style>
</head>
<body>
	<div id="tpl_wrapper_page">
				
		<div id="tpl_header">
			<div>
				<a id="tpl_title" href="" target="_self">Gestion Photothèque</a>
			</div>
		</div> <!-- end #tpl_header -->
		
		<div id="tpl_main_body">
			<div class="generic_menu">
				<?php echo $this->load->view('templates/elements/generic_menu'); ?>			
			</div>	
			<div id="tpl_wrapper_body" style="margin-left:0px;">
				<div id="tpl_inner_body">
					<?php echo $this->load->view('templates/elements/menu_gauche'); ?>

<!--           
 <script type="text/javascript" src="http://dladev1.cm.perenco.com/base_loisirs/assets/js/jssor.js"></script>
    <script type="text/javascript" src="http://dladev1.cm.perenco.com/base_loisirs/assets/js/jssor.slider.js"></script>--->
    
<div id="body_content" style="width: 83%;" >
	<br>
	<div align="center" class="tpl_box_init_container">	

	<div class="tpl_box_init_title">Selection de la diapositive</div>


	<div align="center" class="tpl_box_white tpl_box_lightgrey">
		<div align="center">

		<div align="center" class="tpl_box_container_image" style="min-height:none">
		
			<div id="tpl_content_list">			
				<div style="font-weight: normal;" class="tpl_tab_list_main">
					<div class="tpl_tab_list_img">
						<img src="http://localhost/dlawebdev2/assets/phototheque/images/PLG/1.png" />
					</div>
				</div>
				<br>
			</div>
		
		</div>
		
		<div align="center" class="tpl_box_container_image" style="min-height:none">
		
			<div id="tpl_content_list">			
				<div style="font-weight: normal;" class="tpl_tab_list_main">
					<div class="tpl_tab_list_img">
						<img src="http://localhost/dlawebdev2/assets/phototheque/images/PLG/2.png" />
					</div>
					
				</div>
				<br>
			</div>
		
		</div>
		
		<div align="center" class="tpl_box_container_image" style="min-height:none">
		
			<div id="tpl_content_list">			
				<div style="font-weight: normal;" class="tpl_tab_list_main">
					<div class="tpl_tab_list_img">
						<img src="http://localhost/dlawebdev2/assets/phototheque/images/PLG/3.png" />
					</div>
					
				</div>
				<br>
			</div>
		
		</div>
		
		<div align="center" class="tpl_box_container_image" style="min-height:none">
		
			<div id="tpl_content_list">			
				<div style="font-weight: normal;" class="tpl_tab_list_main">
					<div class="tpl_tab_list_img">
						<img src="http://localhost/dlawebdev2/assets/phototheque/images/PLG/3.png" />
					</div>
					
				</div>
				<br>
			</div>
		
		</div>
		
		<div align="center" class="tpl_box_container_image" style="min-height:none">
		
			<div id="tpl_content_list">			
				<div style="font-weight: normal;" class="tpl_tab_list_main">
					<div class="tpl_tab_list_img">
						<img src="http://localhost/dlawebdev2/assets/phototheque/images/PLG/3.png" />
					</div>
					
				</div>
				<br>
			</div>
		
		</div>
		
		<div align="center" class="tpl_box_container_image" style="min-height:none">
		
			<div id="tpl_content_list">			
				<div style="font-weight: normal;" class="tpl_tab_list_main">
					<div class="tpl_tab_list_img">
						<img src="http://localhost/dlawebdev2/assets/phototheque/images/PLG/3.png" />
					</div>
					
				</div>
				<br>
			</div>
		
		</div>
		
		</div>
		
		<div style="clear:both"></div>
		<br>
	
	</div>
	
</div>
</div>
	
</div></div></div>
<!-- -->
</div> <!-- end #tpl_inner_body -->

	
	<div style="clear: both">&nbsp;</div>	
</body>
</html>