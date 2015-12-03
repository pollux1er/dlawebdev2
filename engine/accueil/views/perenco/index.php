<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<!-- saved from url=(0037)http://intranet.perenco.net/index.php -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><HTML 
lang="fr" xml:lang="fr" 
xmlns="http://www.w3.org/1999/xhtml"><HEAD><TITLE>Perenco Intranet</TITLE>
<META content="text/html; charset=iso-8859-1" http-equiv="Content-Type">
<LINK rel="shortcut icon" type="image/ico" href="<?php echo css_url('Perenco2/favicon.ico') ?>">
<LINK rel="stylesheet" type="text/css" href="<?php echo css_url('perenco1/jquery-ui-1.10.3.custom.min') ?>">
<LINK rel="stylesheet" type="text/css" href="<?php echo css_url('perenco2/left_menu') ?>">
<LINK rel="stylesheet" type="text/css" href="<?php echo css_url('perenco2/top_menu') ?>">
<LINK rel="stylesheet" type="text/css" href="<?php echo css_url('perenco2/main') ?>">
<LINK rel="stylesheet" type="text/css" href="<?php echo css_url('perenco2/datepicker') ?>">
<LINK rel="stylesheet" type="text/css" href="<?php echo css_url('perenco2/generic') ?>">
<LINK rel="stylesheet" type="text/css" href="<?php echo css_url('perenco2/print') ?>" media="print">

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
	
	<![endif]--><!--[if IE 8]>
	
	<style type="text/css">	
		#body_content { width: 82% !important; } 
	</style>
	
	<![endif]-->
<SCRIPT type="text/javascript" src="<?php echo js_url('perenco1/jquery-1.9.1.min') ?>"></SCRIPT>
<SCRIPT type="text/javascript" src="<?php echo js_url('jquery/jquery') ?>"></SCRIPT>

<SCRIPT type="text/javascript" src="<?php echo js_url('perenco1/jquery-ui-1.10.3.custom.min') ?>"></SCRIPT>

<SCRIPT type="text/javascript" src="<?php echo js_url('perenco1/compatibility-jquery-mootools') ?>"></SCRIPT>

<SCRIPT type="text/javascript" src="<?php echo js_url('perenco1/top_menu') ?>"></SCRIPT>

<SCRIPT type="text/javascript" src="<?php echo js_url('perenco1/ts_picker') ?>"></SCRIPT>

<SCRIPT type="text/javascript" src="<?php echo js_url('perenco1/overlib') ?>"></SCRIPT>

<SCRIPT type="text/javascript" src="<?php echo js_url('perenco1/mootools-1.2.5.min') ?>"></SCRIPT>

<SCRIPT type="text/javascript" src="<?php echo js_url('perenco1/mootools-more-1.2.5.1.min') ?>"></SCRIPT>

<SCRIPT type="text/javascript" src="<?php echo js_url('perenco1/common') ?>"></SCRIPT>

<SCRIPT type="text/javascript" src="<?php echo js_url('perenco1/datepicker') ?>"></SCRIPT>

<SCRIPT type="text/javascript" src="<?php echo js_url('perenco1/user') ?>"></SCRIPT>

<SCRIPT type="text/javascript" src="<?php echo js_url('perenco1/tpl_scrolling_v3') ?>"></SCRIPT>

<META name="GENERATOR" content="MSHTML 9.00.8112.16490"></HEAD>
<BODY>
	<DIV id="tpl_wrapper_page">
		<DIV id="tpl_header" >
			<DIV >
			<A id="tpl_title" href="http://dlawebdev2.cm.perenco.com/index.php"></A></DIV>
		</DIV> <!-- end #tpl_header -->
		
		<DIV id="tpl_main_body">
			<DIV style="margin-left: 0px;" id="tpl_wrapper_body">
				<DIV id="tpl_inner_body">
					<!--<DIV id="left_menu">
						<DIV id="contacts_menu" class="left_menus_contact">
							<UL id="contacts_menu_content">
								<LI class="need_access">	
									<A title="" href="http://dladev1.cm.perenco.com/new_intranet_perenco/working_area">
										<STRONG>Need an access?</STRONG>
									</A>
								</LI>
							</UL>
						</DIV>
						<DIV class="cleardiv">&nbsp;</DIV>
						<DIV class="left_menus">
							<H2>Corporate</H2>
							<UL>
								<LI><A class="level2" href="http://www.perenco.com/" target="_blank"><SPAN>Perenco website</SPAN></A></LI>
							</UL>
						</DIV>
						<DIV class="cleardiv">&nbsp;</DIV>
						<DIV class="left_menus">
							<H2>Subsidiary</H2>
							<UL><LI><A class="level2" href="http://dlaoldintranet.cm.perenco.com/" target="_blank"><SPAN>Douala old Intranet</SPAN></A></LI></UL>
						</DIV>
						<DIV class="cleardiv">&nbsp;</DIV>
					</DIV>-->
					<DIV id="body_content">
						<DIV id="tpl_info_top"></DIV>
						<SCRIPT type="text/javascript">

							$(document).ready(function() 
							{
								function validate () {
	  
									if ($('#login') && $('#login').value == "") {
									
										alert ('Please enter your login');
										return false;

									}

									if ($('#password') && $('#password').value == "") {

										alert ('Please enter your password');
										return false;

									}
									//alert('gaga');
									return true;
								}
							});

						</SCRIPT>
						<?php //echo $current_url; ?>
						<DIV id="connection" align="center">
							<H2>Connexion - Intranet Cameroon</H2>
							<DIV id="connection_form_content">
								<?php echo form_open($method, 'method="post" name="login_frm" id="login_frm" onsubmit="javascript:return validate();"'); ?>
									<div align="center" style="font-family: trebuchet, helvetica, arial, sans-serif; font-size: 20px; color: #F00;"><?php if(isset($message)) echo $message;?></div>
									
									<input id='current_url' name='current_url' value="<?php echo ( ( isset($current_url) )? '?cible='.$current_url : "" ) ?>" type="hidden" >
									<INPUT id="redir" name="redir" type="hidden">
									<INPUT id="img_url" name="" value='<?php echo img_url(''); ?>' type="hidden">
									<P style="clear: both;">
										<LABEL for="login">Login</LABEL><INPUT id="login" class="tpl_input_type" name="login" maxLength="50" size="15" type="text">
									</P>

									<P style="clear: both;">
										<LABEL for="password">Password</LABEL><INPUT id="password" class="tpl_input_type" name="password" maxLength="50" size="15" type="password">
									</P>
									<P>
										<INPUT class="tpl_button_validate" name="Submit" value="Log In" type="submit">
									</P>
									<!--<P>
										<A id="forgot_password" href="javascript:openPopup('/password.php', 'ForgotPassword', 'activity=no,scrollbars=yes,width=400, height=200, top=100, left=100, resizable=yes');">Can't access your account?</A>
									</P>-->
									<!--<P id="contact" align="center">	
										If you are a new user or you have queries, please 
										<A href="javascript:openPopup('/contact.php', 'ContactUs', 'activity=no,scrollbars=yes,width=450, height=400, top=100, left=100, resizable=yes');">contact us</A>
									</P>-->
									<DIV style="clear: both;">&nbsp;</DIV>
								</FORM>
									
								
							</DIV>
							
							
							
						</DIV>
					</DIV>
			
				</DIV> <!-- end #tpl_inner_body -->
		
			</DIV> <!-- end #tpl_wrapper_body -->
			<DIV style="clear: both;">&nbsp;</DIV>
		
		</DIV> <!-- end #tpl_main_body -->
		
	</DIV> <!-- end #tpl_wrapper_page -->
	<DIV style="clear: both;">&nbsp;</DIV>
	
</BODY>
</HTML>
