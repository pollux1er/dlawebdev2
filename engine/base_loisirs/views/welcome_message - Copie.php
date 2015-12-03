<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<title>Perenco Cameroon Intranet</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	
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
		
		<link href="assets/css/datepicker.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/home.css?nocache=1" rel="stylesheet" type="text/css" media="all" />
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
			<script type="text/javascript" src="assets/js/jquery-1.9.1.min.js?nocache=60"></script>
			<script type="text/javascript" src="assets/js/top_menu.js?nocache=60"></script>
			<script type="text/javascript" src="assets/js/overlib.js?nocache=60"></script>
			<script type="text/javascript" src="assets/js/common.js?nocache=60"></script>
			<script type="text/javascript" src="assets/js/tpl_scrolling_v3.js?nocache=60"></script>
	
	<style type="text/css">
		#fqdn_notification {
			background: url("/module/image/general/warning_32.png") no-repeat scroll 25px center #ffffbb;
			color: #333;
			border: 2px solid #ffcc00;
			border-left: 0;
			border-right: 0;
			width: 100%;
			padding: .3em 0;
			text-align: center;
		}
		#fqdn_notification p {
			padding: .25em;
		}
		#fqdn_notification ul {
			padding: .5em;
		}
		#fqdn_notification p, #fqdn_notification ul {
			width: 85%;
			margin: 0 auto;
			text-align: left;
		}
		#fqdn_notification p, #fqdn_notification li {
			font-size: 12px;
			font-weight: normal;
		}
		#fqdn_notification strong {
			font-size: 12px;
		}
	</style>
	</head>
<body>
	<div id="tpl_wrapper_page">
				
		<div id="tpl_header">
			<div>
				<a id="tpl_title" href="/index.php">R&eacute;servations base de Loisirs</a>
			</div>
		</div> <!-- end #tpl_header -->
		
		<div id="tpl_main_body">
					<div class="generic_menu">
				<div align="left" class="top-menu-category">
	<div style="z-index:1;" id="menu-container-home">
		<!--
		<ul id="drop_down_menu_home">
							<li title="IT" alt="IT" class="menu link_top_menu_IT">
					<a href="#">										
						IT
					</a>
										<ul id="sub_drop_down_0" class="sub_drop_downs">
													<li>
								<a href="/module/helpdesk/" >IT Helpdesk</a>
							</li>
													<li>
								<a href="/module/sftp/index.php" >Secure FTP</a>
							</li>
													<li>
								<a href="/module/remote_access/index.php" >Remote Access</a>
							</li>
													<li>
								<a href="/awstats/awstats.pl?config=intranet1" >AWStats</a>
							</li>
													<li>
								<a href="/module/deposit/?firstParentId=480" >IT Documents</a>
							</li>
													<li>
								<a href="/module/it_equipment/index.php" >IT Equipments</a>
							</li>
													<li>
								<a href="/module/it_equipment/index_video.php" >Video conference</a>
							</li>
											</ul>
									</li>
							<li title="Reports" alt="Reports" class="menu link_top_menu_Reports">
					<a href="#">										
						Reports
					</a>
										<ul id="sub_drop_down_1" class="sub_drop_downs">
													<li>
								<a href="/module/regular_reporting/index.php?todo=list" >Regular Reporting</a>
							</li>
													<li>
								<a href="/module/deposit/?firstParentId=0" >Documents</a>
							</li>
													<li>
								<a href="http://i2.saiglobal.com/management/" >Norms-Standards</a>
							</li>
											</ul>
									</li>
							<li title="Operations" alt="Operations" class="menu link_top_menu_Operations">
					<a href="#">										
						Operations
					</a>
										<ul id="sub_drop_down_2" class="sub_drop_downs">
													<li>
								<a href="/prodb/codeprod/consult/main-menu.php" >Daily Production</a>
							</li>
													<li>
								<a href="/module/operation/" >Operations/Reference</a>
							</li>
													<li>
								<a href="/prodb/fieldreview/" >Field Review</a>
							</li>
													<li>
								<a href="/module/pims/" >PIMS</a>
							</li>
											</ul>
									</li>
							<li title="Project" alt="Project" class="menu link_top_menu_Project">
					<a href="#">										
						Project
					</a>
										<ul id="sub_drop_down_3" class="sub_drop_downs">
													<li>
								<a href="/module/afe/" >AFE</a>
							</li>
													<li>
								<a href="/module/project/" >Project Monitor</a>
							</li>
													<li>
								<a href="/module/passport/" >License Passport</a>
							</li>
													<li>
								<a href="/module/mto/" >MTO</a>
							</li>
													<li>
								<a href="/module/deposit/?firstParentId=827" >Reference Docs</a>
							</li>
													<li>
								<a href="http://gyoedms1.uk.perenco.com/otcs/livelink.exe" >LiveLink</a>
							</li>
													<li>
								<a href="/module/budget/" >Budget</a>
							</li>
											</ul>
									</li>
							<li title="QSHE" alt="QSHE" class="menu link_top_menu_QSHE">
					<a href="#">										
						QSHE
					</a>
										<ul id="sub_drop_down_4" class="sub_drop_downs">
													<li>
								<a href="/module/qshems/" >QSHE MS</a>
							</li>
													<li>
								<a href="/module/qhse/consult/report.php?categoryId=58" >Basics Reminder</a>
							</li>
													<li>
								<a href="/module/qhse/index.php" >M.O.I.</a>
							</li>
													<li>
								<a href="http://prshse2.fr.perenco.com/Perenco.SD/" target="_blank">EMIS</a>
							</li>
													<li>
								<a href="/module/qhse/consult/incident.php" >Comms</a>
							</li>
													<li>
								<a href="/module/deposit/manage/folder.php?tab=2&amp;parentId=2784" >MSDS</a>
							</li>
													<li>
								<a href="/module/action_tracking/index.php" >Action Tracking</a>
							</li>
											</ul>
									</li>
							<li title="HR" alt="HR" class="menu link_top_menu_HR">
					<a href="#">										
						HR
					</a>
										<ul id="sub_drop_down_5" class="sub_drop_downs">
													<li>
								<a href="/module/staff/organigram.php" >Organization Charts</a>
							</li>
													<li>
								<a href="/module/staff/move.php" >Mobility</a>
							</li>
													<li>
								<a href="/module/deposit/?firstParentId=684" >HR Documents</a>
							</li>
													<li>
								<a href="/module/staff/" >Staff</a>
							</li>
													<li>
								<a href="/module/planning/" >Staff Attendance</a>
							</li>
													<li>
								<a href="/module/travel/" >Travel</a>
							</li>
													<li>
								<a href="/module/dayoff/" >Holiday</a>
							</li>
													<li>
								<a href="/module/authenticate/go_application_tierce.php?id=1" target="_blanc">Training</a>
							</li>
											</ul>
									</li>
							<li title="Finance" alt="Finance" class="menu link_top_menu_Finance">
					<a href="#">										
						Finance
					</a>
										<ul id="sub_drop_down_6" class="sub_drop_downs">
													<li>
								<a href="/module/order/" >Purchase Order</a>
							</li>
													<li>
								<a href="/module/deposit/manage/folder.php?tab=2&amp;parentId=1338" >Documents</a>
							</li>
													<li>
								<a href="/module/deposit/manage/folder.php?tab=2&amp;parentId=1388" >Reporting</a>
							</li>
													<li>
								<a href="http://intranet.perenco.net/module/authenticate/go_application_tierce.php?id=8" >DRC Invoices</a>
							</li>
													<li>
								<a href="http://intranet.perenco.net/module/authenticate/go_application_tierce.php?id=18" >Gabon Invoices</a>
							</li>
													<li>
								<a href="http://intranet.perenco.net/module/authenticate/go_application_tierce.php?id=21" >Congo Invoices</a>
							</li>
													<li>
								<a href="http://intranet.perenco.net/module/authenticate/go_application_tierce.php?id=25" >Cameroon Invoices</a>
							</li>
													<li>
								<a href="http://intranet.perenco.net/module/authenticate/go_application_tierce.php?id=24" >Guatemala Invoices</a>
							</li>
													<li>
								<a href="http://intranet.perenco.net/module/authenticate/go_application_tierce.php?id=26" >UK Invoices</a>
							</li>
											</ul>
									</li>
							<li title="SCM" alt="SCM" class="menu link_top_menu_SCM last">
					<a href="#">										
						SCM
					</a>
										<ul id="sub_drop_down_7" class="sub_drop_downs">
													<li>
								<a href="/module/deposit/manage/folder.php?tab=2&amp;parentId=477" >Documents</a>
							</li>
											</ul>
									</li>
					</ul>
		-->
		<div class="login_div">
			<a id="tpl_edit_profile" href="/module/staff/?id=14194">ASSONTIA Patient</a>
						<a class="link_top_menu_logout" href="/login.php?action=logout">Logout</a>
		</div>
	</div>
	<div class="clear"></div>
</div>			</div>			
	<div style="margin-left:0px;" id="tpl_wrapper_body">
		<div id="tpl_inner_body">
			<div id="left_menu">
				<div id="contacts_menu" class="left_menus_contact">
					<ul id="contacts_menu_content">
						<li class="need_access">
							<a title="" href="/infos.php"><strong>Need an access?</strong></a>
						</li>
					</ul>
				</div>
				<div class="cleardiv">&nbsp;</div>
				<div class="left_menus">
					<h2>Mon Planing</h2>
					<ul>
						<li><a href="#" class="level2"><span>Consulter</span></a></li>
						<li><a href="#" class="level2" title=""><span>Annuler une r&eacute;servation</span></a></li>
						<li><a href="#" class="level2" title="Intranet"><span>Mes Notifications</span></a></li>
					</ul>
				</div>
				<div class="cleardiv">&nbsp;</div>
				<div class="left_menus">
					<h2>Base de loisirs</h2>								
						<ul>
							<li><a href="#" class="level2"><span>Saison</span></a></li>
							<li><a href="#" class="level2selected"><span>&raquo; Faire une r&eacute;servation</span></a></li>
							<li><a href="#" class="level2"><span>R&egrave;glement</span></a></li>
							<li><a href="#" class="level2"><span>Tarifs</span></a></li>
						</ul>
				</div>
				<div class="cleardiv">&nbsp;</div>
			</div>					
					<div id="body_content">
						<div id="tpl_info_top" >
								
						</div>
		<!--				
		<div id="fqdn_notification">
			<p>
			To support the growth of Perenco, two maintenance operations will be done on the corporate intranet server during summer.
			</p><p>
			<strong>The intranet will therefore be unavailable on the following dates:</strong></p>
			<ul><li><strong>Monday 7 July</strong> between 6:00 GMT and 12:00 GMT (migration of the database to a dedicated server)</li>
			<li><strong>Monday 4 August</strong> between 6:00 GMT and 12:00 GMT (migration of the web server to a more powerful server)</li></ul>
			<p>
			Please make the necessary arrangements to avoid any inconvenience during the interruption. Thank you.
			</p>
		</div>-->
		<form class="form no_bottom resa" method="get" enctype="application/x-www-form-urlencoded" action="" name="frmCriteria" target="_parent" id="frmCriteria">
			<div class="title">
				Formulaire de demande de r&eacute;servations<br /><span class="last_update"></span>
			</div>
		
		<div id="section_headline">
		<script type="text/javascript">
	// Copy to
	var global_cfg_action_delete = '-1';
	var global_label_confirm_delete = 'Do you really want to delete these data ?';
	var global_cfg_action_download = '1';
	var global_error_tck_type = 'Please select a type of case';
	var global_error_tck_log_comment = 'Please enter an event description';
	var global_error_tck_access = 'Please enter a valid IT user in charge of the ticket';
	var global_error_sol_description = 'Please fill in the description of the event';
	var global_error_sol_time = 'Please enter a positive numeric value for the step duration';
	var global_error_tck_access = 'Please enter a valid IT user in charge of the ticket';
	var global_cfg_tck_status_closed = '2';
	var global_cfg_tck_status_in_progress = '1';
	var global_label_sol_participant_or = 'or';
	var global_label_sol_participant_and = 'and';
	var global_label_button_delete = 'Delete';
	
	J(document).ready(function() {
		J('#lnk_duplicate').click(function() {
			window.open('/module/helpdesk/manage/ticket.php?action=3&dup_tck_id=');
			return false;
		});
		J('#lnk_follow').click(function() {
			window.location.href = '/module/helpdesk/manage/ticket.php?id=&follow_tck_id=';
		});
	});
	
</script>

			<table class="ticket_header">
				<colgroup><col width="50%"><col width="50%"></colgroup>
				<tbody><tr><td class="ticket_header_td">
					<table class="ticket_header_sub">
						<tbody>
							<tr>
								<th class="cell_title">Subsidiary<span class="mandatory">*</span></th>
								<td class="cell_flag" style="background-image: url( 'assets/images/cm.png' );"><input name="sub_id" value="3" type="hidden">CAMEROON</td>
							</tr>
							<tr>
								<th class="cell_title">Attribution (IT)<span class="mandatory">*</span></th>
								<td valign="top">
									<span id="attribution_it_helpdesk">
										<div class="input_wide"><input autocomplete="off" name="acc_name" type="text" id="acc_name" value="" class="autocompletion" maxlength="50" onkeyup="search_attribution_it(event, 'acc_name', 'acc_id', 'accessCompletion');" style="width: 96%; background-color: transparent;"></div>
											
									</span>
								</td>
							</tr>
							<tr>
								<th class="cell_title">
									Requester
									 <span class="mandatory">*</span>				</th>
								<td>
															<div class="input_wide"><input autocomplete="off" name="tck_requester_name" type="text" value="" class="autocompletion" maxlength="50" id="tck_requester_name" onkeyup="search_requester(event, 'tck_requester_name', 'tck_requester_id', 'userCompletion');" style="width: 96%; background-color: transparent;"></div>
										<div id="userCompletion" class="completion autocompleted"></div>
													</td>
							</tr>
							<tr>
								<th class="cell_title">
									E-mail
								</th>
								<td>
															<input name="tck_email" type="text" id="tck_email" value="" maxlength="100" class="input_wide">
													</td>
							</tr>
							<tr>
								<th class="cell_title">
									Phone
								</th>
								<td>
									<input name="tck_phone_number" type="text" id="tck_phone_number" value="" class="input_wide" maxlength="50">
								</td>
							</tr>
						<tr>
							<th class="cell_title">
								Copy to
							</th>
							<td><a href="#" onclick="addCopyTo(); return false;" id="add_copy_to" class="action_plus add_notify" title="Add">Add a recipient</a>
							<table id="tableCopyTo" style="width:100%">
								<colgroup><col width="10%">
								<col width="70%">
								<col width="15%">
								</colgroup><tbody>
										</tbody>
							</table>									</td>
						</tr>
					<tr>
						<th class="cell_title">
							Type of case
						</th>
						<td>
							<select name="tp_id" id="tp_id" class="input_wide">
								<option value="0"></option>
						           						<option value="30">Account Management: WINDOWS UNIX SAP</option>
            			           									           						<option value="116">Apps: ADRYAN</option>
            			           									           						<option value="128">Apps: ATHENEO</option>
            			           									           						<option value="94">Apps: ATS</option>
            			           									           						<option value="139">Apps: Avocet</option>
            			           									           						<option value="157">Apps: Bloomberg</option>
            			           									           						<option value="147">Apps: CARVAL</option>
            			           									           						<option value="89">Apps: CEMS</option>
            			           									           						<option value="41">Apps: CITRIX / TERMINAL SERVER</option>
            			           									           						<option value="107">Apps: DATALIFE</option>
            			           									           						<option value="138">Apps: DELTAPAIE (CM/ GA/ CD)</option>
            			           									           						<option value="137">Apps: DELTAV</option>
            			           									           						<option value="76">Apps: DOCUMENTUM</option>
            			           									           						<option value="102">Apps: DOCUWARE</option>
            			           									           						<option value="159">APPS: EDMS (PFR)</option>
            			           									           						<option value="148">APPS: EDMS (PUK)</option>
            			           									           						<option value="114">Apps: Enterprise Vault</option>
            			           									           						<option value="152">Apps: EVOLUTION</option>
            			           									           						<option value="162">Apps: Exceed</option>
            			           									           						<option value="47">Apps: EXCHANGE</option>
            			           									           						<option value="146">Apps: FuelLog</option>
            			           									           						<option value="59">Apps: GAP</option>
            			           									           						<option value="57">Apps: GEOLOG6</option>
            			           									           						<option value="46">Apps: HFM/REPORTS</option>
            			           									           						<option value="58">Apps: IMEX</option>
            			           									           						<option value="44">Apps: ISSOW</option>
            			           									           						<option value="133">Apps: KASPERSKY</option>
            			           									           						<option value="56">Apps: LANDMARK</option>
            			           									           						<option value="43">Apps: MAXIMO</option>
            			           									           						<option value="73">Apps: OFFICE (word, excel, powerpoint...)</option>
            			           									           						<option value="132">Apps: OpenText LiveLink</option>
            			           									           						<option value="163">Apps: OpenVPN</option>
            			           									           						<option value="144">Apps: P-Trac</option>
            			           									           						<option value="83">Apps: P2W</option>
            			           									           						<option value="141">Apps: PDMS</option>
            			           									           						<option value="140">Apps: PI</option>
            			           									           						<option value="136">Apps: PLM</option>
            			           									           						<option value="85">Apps: PMP</option>
            			           									           						<option value="108">Apps: ProChange</option>
            			           									           						<option value="78">Apps: PRODIS</option>
            			           									           						<option value="65">Apps: SCADA HMI</option>
            			           									           						<option value="134">Apps: SecureFTP</option>
            			           									           						<option value="115">Apps: SIS INTEGRAL</option>
            			           									           						<option value="104">Apps: SISPROD</option>
            			           									           						<option value="52">Apps: STREAMSERVE</option>
            			           									           						<option value="62">Apps: SUNSYSTEM</option>
            			           									           						<option value="39">Apps: SUPPORT</option>
            			           									           						<option value="123">Apps: TiM (PIPS)</option>
            			           									           						<option value="87">Apps: TM1</option>
            			           									           						<option value="84">Apps: VANTAGE</option>
            			           									           						<option value="105">Apps: VHUR</option>
            			           									           						<option value="150">Apps: WellView</option>
            			           									           						<option value="106">Apps: WinInstall</option>
            			           									           						<option value="161">AudioVisual</option>
            			           									           						<option value="55">Backup/restore</option>
            			           									           						<option value="91">Blackberry</option>
            			           									           						<option value="155">CO : PEC TRANSITION</option>
            			           									           						<option value="120">Comms : Data Network</option>
            			           									           						<option value="77">Comms : FAX</option>
            			           									           						<option value="22">Comms : Hardware</option>
            			           									           						<option value="23">Comms : LOS</option>
            			           									           						<option value="121">Comms : Misc</option>
            			           									           						<option value="119">Comms : Multiplexors</option>
            			           									           						<option value="145">Comms : Pagers</option>
            			           									           						<option value="40">Comms : PBX</option>
            			           									           						<option value="21">Comms : Phones</option>
            			           									           						<option value="117">Comms : Telemetry</option>
            			           									           						<option value="118">Comms : TSAT</option>
            			           									           						<option value="63">Comms : VHF Network</option>
            			           									           						<option value="13">Comms : VSAT</option>
            			           									           						<option value="92">Geoscience Support</option>
            			           									           						<option value="17">Hardware : Installation</option>
            			           									           						<option value="38">Hardware : Move</option>
            			           									           						<option value="18">Hardware : Support</option>
            			           									           						<option value="135">Instrum GABON</option>
            			           									           						<option value="48">Internet : Access</option>
            			           									           						<option value="109">Internet : Support</option>
            			           									           						<option value="34">Internet : Update</option>
            			           									           						<option value="49">Intranet : Access</option>
            			           									           						<option value="110">Intranet : Bug Report</option>
            			           									           						<option value="158">Intranet : Scan Invoices</option>
            			           									           						<option value="96">Intranet : Support</option>
            			           									           						<option value="130">Intranet : UK North Sea</option>
            			           									           						<option value="33">Intranet : Update</option>
            			           									           						<option value="32">Miscellaneous</option>
            			           									           						<option value="60">Network : Firewall</option>
            			           									           						<option value="19">Network : LAN</option>
            			           									           						<option value="90">Network : Proxy</option>
            			           									           						<option value="50">Network : VPN</option>
            			           									           						<option value="20">Network : WAN</option>
            			           									           						<option value="164">Network : Wi-Fi</option>
            			           									           						<option value="72">Oracle Support</option>
            			           									           						<option value="82">Password Reset</option>
            			           									           						<option value="79">Photocopiers</option>
            			           									           						<option value="24">Printer</option>
            			           									           						<option value="143">PRTG Event</option>
            			           									           						<option value="27">Purchase : hardware</option>
            			           									           						<option value="29">Purchase : license</option>
            			           									           						<option value="28">Purchase : software</option>
            			           									           						<option value="93">Records Management</option>
            			           									           						<option value="131">Remote Access : support</option>
            			           									           						<option value="154">SAP : Access (o)</option>
            			           									           						<option value="101">SAP : Approval needed</option>
            			           									           						<option value="36">SAP : BC</option>
            			           									           						<option value="37">SAP : FI/CO</option>
            			           									           						<option value="97">SAP : JV</option>
            			           									           						<option value="112">SAP : LE</option>
            			           									           						<option value="35">SAP : MM</option>
            			           									           						<option value="81">SAP : PM</option>
            			           									           						<option value="111">SAP : PS</option>
            			           									           						<option value="122">SAP : QM</option>
            			           									           						<option value="80">SAP : SD</option>
            			           									           						<option value="54">SAP : Transport</option>
            			           									           						<option value="149">SAP: Material(s) Creation</option>
            			           									           						<option value="151">SAP: Vendor(s) Creation</option>
            			           									           						<option value="26">Server : Unix</option>
            			           									           						<option value="126">Server : VMWare</option>
            			           									           						<option value="25">Server : Windows</option>
            			           									           						<option value="14">Software : install</option>
            			           									           						<option value="15">Software : support</option>
            			           									           						<option value="16">Software : upgrade</option>
            			           									           						<option value="113">SPAMS</option>
            			           									           						<option value="70">Training</option>
            			           									           						<option value="127">Video Conference Service</option>
            			           									           						<option value="31">Virus</option>
            			           									           						<option value="129">Windows Updates</option>
            			            				</select>
							<div class="msg_to_user msg_info_old" title="Please leave blank if you are not 100% sure of the type to choose.">
								Please leave blank if you are not 100% sure of the type to choose.
							</div>
           				           			           		           		</td>
            </tr>
            <tr>
				<th class="cell_title">
					Urgency
				</th>
				<td>
											<select name="tck_urgency" id="tck_urgency" class="input_half_wide" onchange="displayHelp( this.value );">
															<option value="5">
									project
								</option>
															<option value="0">
									low
								</option>
															<option value="1" selected="selected">
									normal
								</option>
															<option value="2">
									urgent
								</option>
															<option value="3">
									emergency
								</option>
															<option value="4">
									vip
								</option>
													</select>
													<span id="urgency_5" class="urgency_help" style="color: #226677;display: none;">
								IT project task.
							</span>
													<span id="urgency_0" class="urgency_help" style="color: #009900;display: none;">
								Routine work or no business impact.
							</span>
													<span id="urgency_1" class="urgency_help" style="color: #3366EE;">
								Day-to-day, foreseeable work.
							</span>
													<span id="urgency_2" class="urgency_help" style="color: #FF6600;display: none;">
								Operational work is slowed down and task was not foreseeable.
							</span>
													<span id="urgency_3" class="urgency_help" style="color: #FF0000;display: none;">
								Operational work is halted.
							</span>
													<span id="urgency_4" class="urgency_help" style="color: #CC33CC;display: none;">
								VIP task.
							</span>
															</td>
			</tr>
						<tr>
				<th class="cell_title">
					Outline
				</th>
				<td>
											<input name="tck_outline" type="text" id="tck_outline" value="" class="input_wide" maxlength="255">
									</td>
			</tr>
						
				</tbody></table></td><td class="ticket_header_td">
				<table class="ticket_header_sub">
									<tbody><tr>
					<th class="cell_title">
						Status
					</th>
					<td>
													<span id="tck_status_helpdesk">
								 
																			<select name="tck_status" id="tck_status" class="input_half_wide" style="float: left;">
																		<option value="0">
										Open
									</option>
																	 
																		<option value="1">
										In progress
									</option>
																	 
																		<option value="3">
										Solved
									</option>
																	 
																		<option value="-3">
										Pending
									</option>
																			</select>
																								</span>
							<span id="tck_status_remote_access" style="display: none; float: left;">
								Open
							</span>
																			<div class="msg_tip tips" id="tck_status_helpdesk_tip" title="When set to 'Pending', the ticket status will be updated to 'In progress' either manually or when a new solution step is added. The ticket will also appear with the lowest urgency as long as it stays in this status. ">&nbsp;</div>
											</td>
				</tr>
										<tr>
					<th class="cell_title">
						Linked to IT Project
					</th>
					<td>
													<input type="hidden" name="project_related_ticket_id" value="">
							<select name="it_project" class="input_wide" onchange="updateITProject( this.value );">
								<option value="0" selected="selected">
									- None -
								</option>
																	<option value="5">
										WW: AD and Exchange upgrade worldwide
									</option>
																	<option value="19">
										BR:Victoria drilling base
									</option>
																	<option value="31">
										GA: Network refresh on Off-Shore Nord
									</option>
																	<option value="34">
										TR: Connection of Bloc Station to Turkish Network and Global Perenco Intranet + DTown Internet access upgrade
									</option>
																	<option value="44">
										GT XAN LAN UPGRADE
									</option>
																	<option value="46">
										Office expansion Rio de Janeiro
									</option>
																	<option value="50">
										WW: Intranet Remote Access (roaming)
									</option>
																	<option value="54">
										Network connectivity for Rig Baguel North West
									</option>
																	<option value="57">
										GTC SAN IMPLEMENTATION
									</option>
																	<option value="59">
										IQ - exchange 2007 install, no SCR
									</option>
																	<option value="61">
										Mise en conformite IT Gabon (reseau/ serveur/ appli)
									</option>
																	<option value="62">
										SAP Gabon (POGG)
									</option>
																	<option value="65">
										SGA IT Transition
									</option>
																	<option value="68">
										PLC project / Network infrastructure rollout on Emeraude Field
									</option>
																	<option value="69">
										IT PETROBRAS Takeover
									</option>
															</select>
											</td>
				</tr>
				<tr>
					<th class="cell_title">
						Scheduling
					</th>
					<td class="scheduling_list">
																					<label for="scheduling_1">
									<input name="tck_scheduling" type="radio" id="scheduling_1" value="1" checked="checked">
									Not applicable
								</label>
															<label for="scheduling_2">
									<input name="tck_scheduling" type="radio" id="scheduling_2" value="2">
									Emergency
								</label>
															<label for="scheduling_3">
									<input name="tck_scheduling" type="radio" id="scheduling_3" value="3">
									Unplanned
								</label>
															<label for="scheduling_4">
									<input name="tck_scheduling" type="radio" id="scheduling_4" value="4">
									Planned
								</label>
																		</td>
				</tr>
				<tr>
					<th class="cell_title">
						Ext. reference (ie. SAP, etc.)
					</th>
					<td>
													<input name="tck_external_reference" type="text" id="tck_external_reference" value="" class="input_wide" maxlength="30">
											</td>
				</tr>
				<tr>
					<th class="cell_title">
						Deadline
					</th>
					<td>
													<input name="is_tck_limited_date" type="hidden" value="">
							<input type="checkbox" name="check_limit" id="check_limit" value="1" valign="middle" style="margin: 3px 4px 0 0; float: left;">
							<input style="float: left; zoom: 1; opacity: 0.4;" name="tck_limited_date" type="text" id="tck_limited_date" value="" size="10" maxlength="10" class="DatePicker input_type" disabled="">
							<div class="msg_tip tips" title="If checked, the ticket urgency will be set to 'urgent' in the last 24 hours before the deadline, and to 'emergency' thereafter.">&nbsp;</div>
											</td>
				</tr>
				<tr>
					<th class="cell_title">
						Trivial (5 min. or less)
					</th>
					<td>
													<input name="tck_trivial" type="checkbox" id="tck_trivial" value="1">
											</td>
				</tr>
				<tr>
					<th class="cell_title">
						Out of hours call
					</th>
					<td>
													<input name="tck_out_of_hour" type="checkbox" id="tck_out_of_hour" value="1">
											</td>
				</tr>
										<tr id="tr_document">
					<th class="cell_title">
						Document
					</th>
					<td id="td_document">
						<input name="filename[]" type="file" size="26" class="input_type">
						&nbsp;
						<a href="javascript:add_doc( 'td_document', 'filename[]' );" class="action_plus" title="Add">
							&nbsp;</a>
					</td>
				</tr>
										<tr>
					<th class="cell_title">
						Share with my back-to-back
					</th>
					<td>
													<input style="float: left;" name="tck_back_to_back_viewing" type="checkbox" value="1">
							<div class="msg_tip tips" title="If checked, your back-to-back will have the same rights to edit, answer and validate this ticket.">&nbsp;</div>
											</td>
				</tr>
										<tr>
					<th class="cell_title">
						Reinvoiced
					</th>
					<td>
						<div class="checkbox-unchecked">
							&nbsp;
						</div>
											</td>
				</tr>
					</tbody></table>
	</td></tr></tbody></table>	</div>
		
		</form>
<div align="center" id="welcome">Welcome to the Intranet<br /></div>
<div align="center" id="contact">If you are a new user or you have queries <b>about your Intranet access</b>, please <a href="javascript:openPopup('contact.php', 'ForgotPassword', 'activity=no,scrollbars=yes,width=450, height=250, top=100, left=100, resizable=no');">contact us</a> </div>


<script type="text/javascript">
	/*
	function popupOutline( comment )
	{
		var popup = '<div class="custom_tip">' + comment + '</div>';
		return overlib( popup );
	}

	window.addEvent('domready', function()
	{
		// Ajoute le title dans une popup instantée pour les éléments pourvu d'un title.
		$$( '.tips' ).each( function( el ) {
			el.addEvents({
				mouseover: function( e ) {
					if( !this.saved_title ) {
						this.saved_title = this.title;
					}
					this.title = '';
					this.style.cursor = 'pointer';
					popupOutline( this.saved_title );
				},
				mouseout: function( e ) { nd(); }
			});
		});
	} );
	*/
</script>

<div id="zapette" ></div>																							</div>
				</div> <!-- end #tpl_inner_body -->
				
			</div> <!-- end #tpl_wrapper_body -->			
			<div style="clear: both">&nbsp;</div>
			
		</div> <!-- end #tpl_main_body -->
		
	</div> <!-- end #tpl_wrapper_page -->
	<div style="clear: both">&nbsp;</div>	
</body>
</html>