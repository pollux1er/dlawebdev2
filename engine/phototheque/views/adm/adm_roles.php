<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<title><?php echo $title; ?></title>
	<meta http-equiv="X-UA-Compatible" content="IE=9;" />
	<base href="<?php echo base_url(); ?>" target="_blank">
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
	<script type="text/javascript" src="assets/base_loisirs/js/jquery-1.10.2.min.js?nocache=60"></script>
	<script type="text/javascript" src="assets/base_loisirs/js/jquery-ui-1.10.3.custom.min.js?nocache=60"></script>
	<script type="text/javascript" src="assets/base_loisirs/js/jquery-impromptu.js?nocache=60"></script>
	<script type="text/javascript" src="assets/base_loisirs/js/compatibility-jquery-mootools.js?nocache=60"></script>
	<script type="text/javascript" src="assets/base_loisirs/js/overlib.js?nocache=60"></script><!---->
	<script src="assets/base_loisirs/js/mootools-core-1.3.1.js" type="text/javascript" charset="utf-8"></script>
    <script src="assets/base_loisirs/js/mootools-more-1.3.1.1.js" type="text/javascript" charset="utf-8"></script>
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
				</div>			
			</div>	
			<div id="tpl_wrapper_body" style="margin-left:0px;">
				<div id="tpl_inner_body">
					<?php echo $this->load->view('templates/elements/menu_gauche'); ?>
					<div id="body_content">
						<div id="tpl_info_top">
								
						</div>
						
																			
<!--<script src="assets/base_loisirs/js/common3.js?nocache=22" type="text/javascript"></script>-->
<script src="assets/base_loisirs/js/common4.js?nocache=22" type="text/javascript"></script>


<script type="text/javascript">
window.addEvent('domready', function(){
	
	//tips
	// var toolTipsTwo = new Tips('.tips', {
		// className: 'planning_custom_tip', //par défaut : null
		// hideDelay: 0,
		// showDelay: 0
	// });
	
	var tab_tmp = new Array;

	if($('keyword[0]')){
		$('keyword[0]').focus();
		$('keyword[0]').addEvent('keyup', function() {
			clean_data_research();
		});
	}
});

var user_day = '';

// Show the planning menu
function spm(day_key, action) {

	var myDiv     = document.getElementsByTagName('div');
	var menu_html = '';
	
	user_day = day_key;
	
	menu_html += '&lt;div class="planning_menu"&gt;';
	menu_html += '&lt;ul&gt;';
	
	switch (action) {
	
		case '1' :
		menu_html += '&lt;li&gt;&lt;a href="javascript:planningPopup('+1+');"&gt;&lt;span class="b_insert"&gt;&lt;/span&gt;Update&lt;/a&gt;&lt;/li&gt;';
		menu_html += '&lt;li&gt;&lt;a href="javascript:planningPopup('+4+');"&gt;&lt;span class="b_insert_multiple"&gt;&lt;/span&gt;Update multiple&lt;/a&gt;&lt;/li&gt;';
		break;
		
		case '2' :
		menu_html += '&lt;li&gt;&lt;a href="javascript:planningPopup('+9+');"&gt;&lt;span class="b_view"&gt;&lt;/span&gt;View&lt;/a&gt;&lt;/li&gt;';
		menu_html += '&lt;li&gt;&lt;a href="javascript:planningPopup('+1+');"&gt;&lt;span class="b_insert"&gt;&lt;/span&gt;Update&lt;/a&gt;&lt;/li&gt;';
		menu_html += '&lt;li&gt;&lt;a href="javascript:planningPopup('+4+');"&gt;&lt;span class="b_insert_multiple"&gt;&lt;/span&gt;Update multiple&lt;/a&gt;&lt;/li&gt;';
		menu_html += '&lt;li&gt;&lt;a href="javascript:planningPopup('+2+');"&gt;&lt;span class="b_update"&gt;&lt;/span&gt;Edit&lt;/a&gt;&lt;/li&gt;';
		menu_html += '&lt;li&gt;&lt;a href="javascript:planningPopup('+-1+');"&gt;&lt;span class="b_delete"&gt;&lt;/span&gt;Delete all&lt;/a&gt;&lt;/li&gt;';
		menu_html += '&lt;li&gt;&lt;a href="javascript:planningPopup('+-2+');"&gt;&lt;span class="b_delete"&gt;&lt;/span&gt;Delete part&lt;/a&gt;&lt;/li&gt;';
		break;
		
		case '-1' :
		menu_html += '&lt;li&gt;&lt;a href="javascript:planningPopup('+9+');"&gt;&lt;span class="b_view"&gt;&lt;/span&gt;View&lt;/a&gt;&lt;/li&gt;';
		menu_html += '&lt;li&gt;&lt;a href="javascript:planningPopup('+-1+');"&gt;&lt;span class="b_delete"&gt;&lt;/span&gt;Delete all&lt;/a&gt;&lt;/li&gt;';
		break;
		
		case '9' :
		menu_html += '&lt;li&gt;&lt;a href="javascript:planningPopup('+9+');"&gt;&lt;span class="b_view"&gt;&lt;/span&gt;View&lt;/a&gt;&lt;/li&gt;';
		break;
		
		default :
		return;
		break;
	}
	
	menu_html += '&lt;/ul&gt;';
	menu_html += '&lt;/div&gt;';
	
	overlib(menu_html, RIGHT, BELOW, OFFSETX, 0, OFFSETY, 0, STICKY, WIDTH, 100);
}

</script>

<?php 
	//var_dump($users); die;
	$users['users'] = $users;
	$users['hrusers'] = $all_hr_users;
	if(isset($message))
		$users['message'] = $message;
	echo $this->load->view('adm/adm_roles_ayantdroits', $users);

?>


<script language="JavaScript">
	if(document.getElementById('keyword[0]')){
		document.getElementById('keyword[0]').focus();
	}
	function popupOutline( comment )
	{
		var popup = '<div class="custom_tip">' + comment + '</div>';
		return overlib( popup );
	}
</script>
																							</div>
				</div> <!-- end #tpl_inner_body -->
				
			</div>
		</div>
	</div>
	
	<div style="clear: both">&nbsp;</div>	
</body>
</html>