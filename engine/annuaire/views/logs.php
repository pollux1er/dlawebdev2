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
	<link type="text/css" rel="stylesheet" href="assets/base_loisirs/css/style_planning.css?nocache=22">
	
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
	<script type="text/javascript" src="assets/base_loisirs/js/overlib.js?nocache=60"></script>
	<script type="text/javascript" src="assets/base_loisirs/js/mootools-1.2.5.min.js?nocache=60"></script>
	<script type="text/javascript" src="assets/base_loisirs/js/mootools-more-1.2.5.1.min.js?nocache=60"></script>
	<script type="text/javascript" src="assets/base_loisirs/js/common.js?nocache=60"></script>
	<script type="text/javascript" src="assets/base_loisirs/js/common2.js?nocache=60"></script>
	<script type="text/javascript" src="assets/base_loisirs/js/Form.Placeholder.js?nocache=60"></script>

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
						
																			
<!--<script src="assets/base_loisirs/js/common3.js?nocache=22" type="text/javascript"></script>-->
<script src="assets/base_loisirs/js/common4.js?nocache=22" type="text/javascript"></script>


<script type="text/javascript">
window.addEvent('domready', function()
{
	
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

</script>
<!--
<form id="criteria_form" target="_blank" name="criteria_form" enctype="application/x-www-form-urlencoded" method="post" action="#">
  
  <input type="hidden" id="timesheetId" name="timesheetId">
  <input type="hidden" id="timestamp" name="timestamp" value="1406847600">
  <input type="hidden" value="" id="timesheet" name="timesheet">

  <table id="form_search" class="form">
 	
  	<colgroup><col width="50%">
	<col width="50%">
  
  	</colgroup><tbody><tr>
  
  		<td valign="top">
  			
  			<table>
  				<colgroup><col width="150">
				<col width="">
				
				
				 
									</colgroup><tbody><tr>
						<td class="cell_blue">
							<div class="bulle2" id="alt_keyword">&nbsp;</div>
							Réservations
						</td>
						<td id="td_keyword">
															
							<input type="checkbox" checked /> Non confirmées
						 <input type="checkbox"  checked  /> Confirmées
						
						</td>
						
					</tr>
					
								

				 
				 
				    
				<tr>
					<td class="cell_blue">Case</td>
					<td>
						 <input type="checkbox" name="case[1]" value='1' checked /> Verte
						 <input type="checkbox" name="case[2]" value='2'  checked  /> Bleue
						 <input type="checkbox" name="case[4]" value='4'  checked  /> Jaune
						 <input type="checkbox" name="case[3]" value='3'  checked  /> Grande
					</td>
				</tr>
				<tr>
					<td class="cell_blue">Between</td>
					<td>
						<input type="text" class="DatePicker border" maxlength="10" size="10" value="" id="begin" name="begin" autocomplete="off">
						and
						<input type="text" class="DatePicker border" maxlength="10" size="10" value="" id="end" name="end" autocomplete="off">
					</td>
				</tr>
			</tbody>
		</table>
 
  		</td>
  		<td valign="top">
			<!--
  			<table>
  				<colgroup><col width="150">
				<col width="">
				
				
				</colgroup>
				<tbody>
					<tr style="height: 21px;">
						<td class="cell_blue">Demandes</td>
						<td id="td_subsidiary"> 
							<input type="checkbox" checked="">
						</td>
					</tr>
				    
				    
									<tr style="height: 22px;">
						<td class="cell_blue">Réservations</td>
						<td>
							<input type="checkbox" checked="">
						</td>
					</tr>
					<tr style="height: 22px;">
					    <td class="cell_blue">Occupations</td>
					    <td id="td_department"> 
					      	<input type="checkbox" checked="">
						</td>
					</tr>									
  			</tbody>
			</table>
  			
  		</td>
  		
  		
  	</tr>
  

  </tbody></table>

  
  <div style="width: 100%; text-align: center;">
			<input type="button" onclick="javascript:search_planning('planning_data', '');" class="tpl_button_search" value="Search" name="planning_search" id="planning_search">
	  </div>
&nbsp; 


</form>
-->
<?php 
	//var_dump($logs); die;
	$db['users'] = $annuaire;
	echo $this->load->view('annuaire_pabx', $db);

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