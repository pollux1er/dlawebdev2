<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<title><?php echo $title; ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<base href="<?php echo base_url(); ?>" target="_blank">
	<link rel="shortcut icon" type="image/ico" href="/favicon.ico" />
	<link href="assets/css/calendar.css?nocache=60" rel="stylesheet" type="text/css" />
	<link href="assets/css/jquery-ui-1.8.22.custom.css?nocache=60" rel="stylesheet" type="text/css" />
	<link href="assets/css/left_menu.css?nocache=60" rel="stylesheet" type="text/css" />
	<link href="assets/css/top_menu.css?nocache=60" rel="stylesheet" type="text/css" />
	<link href="assets/css/main.css?nocache=60" rel="stylesheet" type="text/css" />
	<link href="assets/css/generic.css?nocache=60" rel="stylesheet" type="text/css" />
	<link href="assets/css/print.css?nocache=60" rel="stylesheet" type="text/css" media="print" />
	<link href="assets/css/style.css?nocache=60" rel="stylesheet" type="text/css" />
	<link href="assets/css/base_loisir.css?nocache=60" rel="stylesheet" type="text/css" />
	
	<!--<link href="assets/css/home.css?nocache=60" rel="stylesheet" type="text/css" media="all" />-->
	
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
	
	<!--[if IE]>
	<style>
		.today span.milieu {
			margin-top : 18px;
			margin-left : 10px;
			width : 100%;
			padding-left : 10px;
		}
		
		span.milieu {
			margin-left : 0px;
			margin-right : -5px;
			width : 100%;
		}

		span.debut {
			margin-right : -5px;
		}
	</style>
	<![endif]-->
	<script type="text/javascript" src="assets/js/jquery-1.10.2.min.js?nocache=60"></script>
	<script type="text/javascript" src="assets/js/jquery-ui-1.10.3.custom.min.js?nocache=60"></script>
	<script type="text/javascript" src="assets/js/jquery-impromptu.js?nocache=60"></script>
	<script type="text/javascript" src="assets/js/compatibility-jquery-mootools.js?nocache=60"></script>
	<script type="text/javascript" src="assets/js/overlib.js?nocache=60"></script>
	<script type="text/javascript" src="assets/js/mootools-1.2.5.min.js?nocache=60"></script>
	<script type="text/javascript" src="assets/js/mootools-more-1.2.5.1.min.js?nocache=60"></script>
	<script type="text/javascript" src="assets/js/common.js?nocache=60"></script>
	<script type="text/javascript" src="assets/js/common2.js?nocache=60"></script>

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
				<div align="left" class="top-menu-category">
	<div style="z-index:1;" id="menu-container-home">
		<!--
		 menu effacee
		-->
		<div class="login_div">
			<a id="tpl_edit_profile" href="#"><?php echo $nom; ?></a>
						<a class="link_top_menu_logout" href="logout/" target="_self">Logout</a>
		</div>
	</div>
	<div class="clear"></div>
</div>			</div>			
	<div style="margin-left:0px;" id="tpl_wrapper_body">
		<div id="tpl_inner_body">
			<?php echo $this->load->view('templates/elements/menu_gauche'); ?>	
		
					<div id="body_content">
						<div id="tpl_info_top" >
								
						</div>
						
		
		<br />
		
		<div class="title">
			Calendrier provisoire de la <?php echo $case; ?> pour le mois de <?php echo $mois ?><br /><!--<span class="last_update"></span>-->
		</div>
		<form action="calendar/kase/<?php echo $month; ?>" method="post" name="frm_criteria" target="_parent" id="frm_criteria" style="position: relative;">
			<table width="100%" border="0" cellpadding="0" cellspacing="0" class="form">
				<colgroup>
					<col width="15%"><col width="35%">
					<col width="15%"><col width="35%">
				</colgroup>
				<tbody>
					<tr>
						<td align="center" class="label">Case :  </td>
						<td>
							<select class="input_wide" name="case" id="case" onchange="submit();">
								<option value="">Selectionner une case</option>
								<option value="verte">Case Verte</option>
								<option value="bleue">Case Bleue</option>
								<option value="grande">Grande Case</option>
								<option value="jaune">Case Jaune</option>
							</select>
						</td>
						<td align="right">&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
				</tbody>
			</table>
		</form>
		<br />
		<div class="broadcast"><strong>Base de loisir info :</strong> La periode de demande d'admissibilite des demandes etant du 04/08 au 12/08, le calendrier ne sera effectif qu'a partir du 12/08. Vous pouvez faire vos demandes en <a href="" target="_self">cliquant ici</a></div>
		<div id="section_headline">
			<script type="text/javascript">
			</script>
				
			<?php echo $calendar;?>
			
			<div id="boite_priorite">
				<div class="list_user">Ordre de Priorite</div>
				<div><!--
					<ul>
						<li>Saidou</li>
						<li>Gael</li>
						<li>Patient</li>
					</ul>-->
				</div>
			</div>
		
		</div>
		
		
		
		<!--
<div align="center" id="welcome">Welcome to the Intranet<br /></div>
<div align="center" id="contact">If you are a new user or you have queries <b>about your Intranet access</b>, please <a href="javascript:openPopup('contact.php', 'ForgotPassword', 'activity=no,scrollbars=yes,width=450, height=250, top=100, left=100, resizable=no');">contact us</a> </div>
-->

<div id="zapette" ></div>																							</div>
				</div> <!-- end #tpl_inner_body -->
				
			</div> <!-- end #tpl_wrapper_body -->			
			<div style="clear: both">&nbsp;</div>
			
		</div> <!-- end #tpl_main_body -->
		
	</div> <!-- end #tpl_wrapper_page -->
	<div style="clear: both">&nbsp;</div>	
</body>
</html>