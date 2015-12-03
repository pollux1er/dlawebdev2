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
	<link href="assets/base_loisirs/css/style_about.css?nocache=60" rel="stylesheet" type="text/css" />
	<link href="assets/base_loisirs/css/base_loisir.css?nocache=60" rel="stylesheet" type="text/css" />
	
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
				<a id="tpl_title" href="" target="_self">R&eacute;servations base de Loisirs</a>
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
					<div class="parent">
						<div class="box_white">
							<div style="width:70%;float:left;text-align:left;padding:7px 0 7px 5px;" class="folder_major"><!--
								<a class="display_minor_ok" href="?show_minor=ok&amp;show_all_content=ko">Show minor version</a>&nbsp;&nbsp;
								<a class="display_content_ok" href="?show_all_content=ok&amp;show_minor=ko">Show all content</a>-->
							</div>
							<div style="clear:both;"></div>
							<div class="folder_wrapper">
								<table border="0" cellspacing="0" cellpadding="0" style="text-align:left;" class="folder">
									<colgroup><col width="15%">
									<col width="10%">
									<col width="11%">
									<col width="12%">
									<col width="12%">
									<col width="40%">
								
									</colgroup>
									<tbody>
										<tr class="header_row last_header_row">
											<th>Date production</th>
											<th>Version number</th>
											<th style="text-align:right;padding-right:10px;">Time spent</th>				
											<th>Fonctional</th>
											<th>Technical</th>
											<th>Content</th>
										</tr>
										<tr valign="top" class="folder_major">
											<td>24/12/2014</td>
											<td>1.0</td>					
											<td onmouseout="toolTip()" onmouseover="toolTip('', '#FFF', '#36393D');" style="text-align:right;padding-right:10px;">
													3&nbsp;month(s)&nbsp;					</td>
											<td><a href="http://intranet.perenco.net/module/staff/index.php?id=8944&num_onglet=1" target="_blank">Marie-Roselyne AVA Atanga</a></td>
											<td style="cursor: pointer;" class="td_display_data1"><a href="http://intranet.perenco.net/module/staff/index.php?id=14194&num_onglet=1">Patient ASSONTIA</a></td>	
											<td>Implementing a module for booking of leisure base of Kribi</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div> <!-- end #tpl_inner_body -->
				
			</div>
		</div>
	</div>
	
	<div style="clear: both">&nbsp;</div>	
</body>
</html>