<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<title><?php echo $title; ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<base href="<?php //echo base_url(); ?>" target="_blank">
	<link rel="shortcut icon" type="image/ico" href="/favicon.ico" />
	<link href="assets/css/jquery-ui-1.8.22.custom.css?nocache=60" rel="stylesheet" type="text/css" />
	<link href="assets/css/left_menu.css?nocache=60" rel="stylesheet" type="text/css" />
	<link href="assets/css/top_menu.css?nocache=60" rel="stylesheet" type="text/css" />
	<link href="assets/css/main.css?nocache=60" rel="stylesheet" type="text/css" />
	<link href="assets/css/generic.css?nocache=60" rel="stylesheet" type="text/css" />
	<link href="assets/css/print.css?nocache=60" rel="stylesheet" type="text/css" media="print" />
	<link href="assets/css/style.css?nocache=60" rel="stylesheet" type="text/css" />
	<link href="assets/css/style1.css?nocache=60" rel="stylesheet" type="text/css" />
	<link href="assets/css/base_loisir.css?nocache=60" rel="stylesheet" type="text/css" />
	<link href="assets/css/calendar-eightysix-v1.1-default.css?nocache=60" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="assets/css/calendar-eightysix-v1.1-vista.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="assets/css/calendar-eightysix-v1.1-osx-dashboard.css" media="screen" />
	
	<link href="assets/css/datepicker.css" rel="stylesheet" type="text/css" />
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
	<script type="text/javascript" src="assets/js/jquery-1.10.2.min.js?nocache=60"></script>
	<script type="text/javascript" src="assets/js/jquery-ui-1.10.3.custom.min.js?nocache=60"></script>
	<script type="text/javascript" src="assets/js/jquery-impromptu.js?nocache=60"></script>
	<script type="text/javascript" src="assets/js/compatibility-jquery-mootools.js?nocache=60"></script>
	<script type="text/javascript" src="assets/js/overlib.js?nocache=60"></script>
	<script type="text/javascript" src="assets/js/mootools-1.2.5.min.js?nocache=60"></script>
	<script type="text/javascript" src="assets/js/mootools-more-1.2.5.1.min.js?nocache=60"></script>
	<script type="text/javascript" src="assets/js/common.js?nocache=60"></script>
	<script type="text/javascript" src="assets/js/common2.js?nocache=60"></script>
	<script type="text/javascript" src="assets/js/calendar-eightysix-v1.1.js?nocache=60"></script>
	<script type="text/javascript" src="assets/js/base_loisir.js?nocache=60"></script>
	<script type="text/javascript" src="assets/js/Form.Placeholder.js?nocache=60"></script>

	<script>
	$j(document).ready(function() {
	
	<?php if($message != '') { ?>
		$j("#frmCriteria :input").attr("disabled", true);
		$j("#envoyer_demande").val('Modifier votre demande');
		$j("#frmCriteria :input").attr("disabled", false);
		
	<?php }  ?>
	
		$j('#id_case').on('change', function() {
			$j('#case_verte').hide();
			$j('#case_bleue').hide();
			$j('#gde_case').hide();
			$j('#case_jaune').hide();
			if(this.value == '1') {
				$j('#case_verte').show();
			}
			if(this.value == '2') {
				$j('#case_bleue').show();
			}
			if(this.value == '3') {
				$j('#gde_case').show();
			}
			if(this.value == '4') {
				$j('#case_jaune').show();
			}
			
		});
	
	});
	
	window.addEvent('domready', function() {
		/* ajax alert */
		$('ajax-alert').addEvent('click', function(event) {
			//prevent the page from changing
			event.stop();
			//make the ajax call
			var req = new Request({
				method: 'get',
				url: $('ajax-alert').get('href'),
				data: { 'do' : '1' },
				onRequest: function() { alert('Request made. Please wait...'); },
				onComplete: function(response) { alert('Response: ' + response); }
			}).send();
		});
		
		$('envoyer_demande').addEvent('click', function(event) {
			//prevent the page from changing
			event.stop();
			alert('allez');
		});
	});
	</script>
	
	<style type="text/css">
	
	</style>
	</head>
<body>