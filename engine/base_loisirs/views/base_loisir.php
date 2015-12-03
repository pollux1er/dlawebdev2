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


 <script type="text/javascript" src="http://dlawebprd2.cm.perenco.com/assets/portail/js/jssor.js"></script>
    <script type="text/javascript" src="http://dlawebprd2.cm.perenco.com/assets/portail/js/jssor.slider.js"></script>
    <script>

        jQuery(document).ready(function ($) {

            var _SlideshowTransitions = [
            //Fade
            { $Duration: 1200, $Opacity: 2 }
            ];

            var options = {
                $AutoPlay: true,                                    //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
                $AutoPlaySteps: 1,                                  //[Optional] Steps to go for each navigation request (this options applys only when slideshow disabled), the default value is 1
                $AutoPlayInterval: 3000,                            //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
                $PauseOnHover: 1,                               //[Optional] Whether to pause when mouse over if a slider is auto playing, 0 no pause, 1 pause for desktop, 2 pause for touch device, 3 pause for desktop and touch device, 4 freeze for desktop, 8 freeze for touch device, 12 freeze for desktop and touch device, default value is 1

                $ArrowKeyNavigation: true,   			            //[Optional] Allows keyboard (arrow key) navigation or not, default value is false
                $SlideDuration: 500,                                //[Optional] Specifies default duration (swipe) for slide in milliseconds, default value is 500
                $MinDragOffsetToSlide: 20,                          //[Optional] Minimum drag offset to trigger slide , default value is 20
                //$SlideWidth: 600,                                 //[Optional] Width of every slide in pixels, default value is width of 'slides' container
                //$SlideHeight: 300,                                //[Optional] Height of every slide in pixels, default value is height of 'slides' container
                $SlideSpacing: 0, 					                //[Optional] Space between each slide in pixels, default value is 0
                $DisplayPieces: 1,                                  //[Optional] Number of pieces to display (the slideshow would be disabled if the value is set to greater than 1), the default value is 1
                $ParkingPosition: 0,                                //[Optional] The offset position to park slide (this options applys only when slideshow disabled), default value is 0.
                $UISearchMode: 1,                                   //[Optional] The way (0 parellel, 1 recursive, default value is 1) to search UI components (slides container, loading screen, navigator container, arrow navigator container, thumbnail navigator container etc).
                $PlayOrientation: 1,                                //[Optional] Orientation to play slide (for auto play, navigation), 1 horizental, 2 vertical, 5 horizental reverse, 6 vertical reverse, default value is 1
                $DragOrientation: 3,                                //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0)

                $SlideshowOptions: {                                //[Optional] Options to specify and enable slideshow or not
                    $Class: $JssorSlideshowRunner$,                 //[Required] Class to create instance of slideshow
                    $Transitions: _SlideshowTransitions,            //[Required] An array of slideshow transitions to play slideshow
                    $TransitionsOrder: 1,                           //[Optional] The way to choose transition to play slide, 1 Sequence, 0 Random
                    $ShowLink: true                                    //[Optional] Whether to bring slide link on top of the slider when slideshow is running, default value is false
                },

                $BulletNavigatorOptions: {                                //[Optional] Options to specify and enable navigator or not
                    $Class: $JssorBulletNavigator$,                       //[Required] Class to create navigator instance
                    $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
                    $AutoCenter: 1,                                 //[Optional] Auto center navigator in parent container, 0 None, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
                    $Steps: 1,                                      //[Optional] Steps to go for each navigation request, default value is 1
                    $Lanes: 1,                                      //[Optional] Specify lanes to arrange items, default value is 1
                    $SpacingX: 10,                                   //[Optional] Horizontal space between each item in pixel, default value is 0
                    $SpacingY: 10,                                   //[Optional] Vertical space between each item in pixel, default value is 0
                    $Orientation: 1                                 //[Optional] The orientation of the navigator, 1 horizontal, 2 vertical, default value is 1
                },

                $ArrowNavigatorOptions: {
                    $Class: $JssorArrowNavigator$,              //[Requried] Class to create arrow navigator instance
                    $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
                    $Steps: 1                                       //[Optional] Steps to go for each navigation request, default value is 1
                }
            };
            var jssor_slider1 = new $JssorSlider$("slider1_container", options);

            //responsive code begin
            //you can remove responsive code if you don't want the slider scales while window resizes
            function ScaleSlider() {
                var parentWidth = jssor_slider1.$Elmt.parentNode.clientWidth;
                if (parentWidth)
                    jssor_slider1.$ScaleWidth(Math.min(parentWidth, 600));
                else
                    window.setTimeout(ScaleSlider, 30);
            }
            ScaleSlider();

            $(window).bind("load", ScaleSlider);
            $(window).bind("resize", ScaleSlider);
            $(window).bind("orientationchange", ScaleSlider);
            //responsive code end
        });
    </script>
<div id="body_content" style="width: 83%;" >
	<br />
	<div align="center" class="tpl_box_init_container">	

	<div class="tpl_box_init_title">Base Loisirs de KRIBI</div>


	<div align="center" class="tpl_box_white tpl_box_lightgrey">
		<div align="center">

		<div align="center" class="tpl_box_container_result" style="min-height:none">
		
			<div id="tpl_content_list">			
				<div style="font-weight: normal;" class="tpl_tab_list_main">
					L'acc&egrave;s &agrave; la base de Kribi concerne les collaborateurs de statut cadre et assimil&eacute;s des soci&eacute;t&eacute;s du Groupe PERENCO au Cameroun ainsi que leurs ayant droits (conjoints et enfants).<br />
					<strong><u>RESERVATIONS et TARIFS</u> :</strong>
Vous pouvez r&eacute;server &agrave;tout moment. Les disponibilit&eacute;s sont consultables sur le planning de r&eacute;servation
grace au lien : <a href="http://dlawebprd2.cm.perenco.com/base_loisirs.php/attendance/">Planning des cases</a>
Le principe g&eacute;n&eacute;ral est que les cases sont affect&eacute;es dans l'ordre des r&eacute;servations. Un syst&egrave;me de liste d'attente est mis en place dans le cas où le nombre des demandes est sup&eacute;rieur aux disponibilit&eacute;s. <br /><br />
Environ 150 personnes sont inscrites sur la liste des postulants &agrave;la r&eacute;servation &agrave; Kribi. L'int&eacute;r&ecirc;t est de
permettre d'assurer pour chaque famille 2 s&eacute;jours par an minimum, hors p&eacute;riodes des f&ecirc;tes de fin d'ann&eacute;e
(vacances f&ecirc;tes de fin d'ann&eacute;e)
					<br><br>
					
				</div>
				<br>
				<div id="slider1_container" style="position: relative; top: 0px; left: 0px; width: 600px; height: 400px; overflow: hidden; ">

        <!-- Loading Screen -->
        <div u="loading" style="position: absolute; top: 0px; left: 0px;">
            <div style="filter: alpha(opacity=70); opacity:0.7; position: absolute; display: block;
                background-color: #000000; top: 0px; left: 0px;width: 100%;height:100%;">
            </div>
            <div style="position: absolute; display: block; background: url(http://dladev1.cm.perenco.com/base_loisirs/assets/images/loading.gif) no-repeat center center;
                top: 0px; left: 0px;width: 100%;height:100%;">
            </div>
        </div>

        <!-- Slides Container -->
        <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 600px; height: 400px; overflow: hidden;">
             <div>
               <img u="image" src="http://localhost/dlawebdev2/assets/base_loisirs/images/base_loisirs_cases/4.JPG" />
            </div>
			 <div>
               <img u="image" src="http://localhost/dlawebdev2/assets/base_loisirs/images/base_loisirs_cases/5.JPG" />
            </div>
            <div>
                 <img u="image" src="http://localhost/dlawebdev2/assets/base_loisirs/images/base_loisirs_cases/6.JPG" />
            </div>
			<div>
                <img u="image" src="http://localhost/dlawebdev2/assets/base_loisirs/images/base_loisirs_cases/1.JPG" />
            </div>
            <div>
                <img u="image" src="http://localhost/dlawebdev2/assets/base_loisirs/images/base_loisirs_cases/2.JPG" />
            </div>
            <div>
                <img u="image" src="http://localhost/dlawebdev2/assets/base_loisirs/images/base_loisirs_cases/3.JPG" />
            </div>
			 <div>
               <img u="image" src="http://localhost/dlawebdev2/assets/base_loisirs/images/base_loisirs_cases/1.JPG" />
            </div>
			 <div>
               <img u="image" src="http://localhost/dlawebdev2/assets/base_loisirs/images/base_loisirs_cases/2.JPG" />
            </div>
			 <div>
               <img u="image" src="http://localhost/dlawebdev2/assets/base_loisirs/images/base_loisirs_cases/3.JPG" />
            </div>
            <!--<div>
                <img u="image" src="http://localhost/dlawebdev2/assets/base_loisirs/images/base_loisirs_cases/5.JPG" />
            </div>-->
            <div>
               <img u="image" src="http://localhost/dlawebdev2/assets/base_loisirs/images/base_loisirs_cases/7.JPG" />
            </div>
			 <div>
               <img u="image" src="http://localhost/dlawebdev2/assets/base_loisirs/images/base_loisirs_cases/7.JPG" />
            </div>
			 <div>
               <img u="image" src="http://localhost/dlawebdev2/assets/base_loisirs/images/base_loisirs_cases/9.JPG" />
            </div>
			 <div>
               <img u="image" src="http://localhost/dlawebdev2/assets/base_loisirs/images/base_loisirs_cases/10.JPG" />
            </div>
			 <div>
               <img u="image" src="http://localhost/dlawebdev2/assets/base_loisirs/images/base_loisirs_cases/11.JPG" />
            </div>
			 <div>
               <img u="image" src="http://localhost/dlawebdev2/assets/base_loisirs/images/base_loisirs_cases/8.JPG" />
            </div>
        </div>

        <!-- Bullet Navigator Skin Begin -->
        <style>
            /* jssor slider bullet navigator skin 05 css */
            /*
            .jssorb05 div           (normal)
            .jssorb05 div:hover     (normal mouseover)
            .jssorb05 .av           (active)
            .jssorb05 .av:hover     (active mouseover)
            .jssorb05 .dn           (mousedown)
            */
            .jssorb05 div, .jssorb05 div:hover, .jssorb05 .av {
                background: url(http://dladev1.cm.perenco.com/base_loisirs/assets/images/b05.png) no-repeat;
                overflow: hidden;
                cursor: pointer;
            }

            .jssorb05 div {
                background-position: -7px -7px;
            }

                .jssorb05 div:hover, .jssorb05 .av:hover {
                    background-position: -37px -7px;
                }

            .jssorb05 .av {
                background-position: -67px -7px;
            }

            .jssorb05 .dn, .jssorb05 .dn:hover {
                background-position: -97px -7px;
            }
        </style>
        <!-- bullet navigator container -->
        <div u="navigator" class="jssorb05" style="position: absolute; bottom: 16px; right: 6px;">
            <!-- bullet navigator item prototype -->
            <div u="prototype" style="POSITION: absolute; WIDTH: 16px; HEIGHT: 16px;"></div>
        </div>
        <!-- Bullet Navigator Skin End -->
        <!-- Arrow Navigator Skin Begin -->
        <style>
            /* jssor slider arrow navigator skin 12 css */
            /*
            .jssora12l              (normal)
            .jssora12r              (normal)
            .jssora12l:hover        (normal mouseover)
            .jssora12r:hover        (normal mouseover)
            .jssora12ldn            (mousedown)
            .jssora12rdn            (mousedown)
            */
            .jssora12l, .jssora12r, .jssora12ldn, .jssora12rdn {
                position: absolute;
                cursor: pointer;
                display: block;
                background: url(http://dladev1.cm.perenco.com/base_loisirs/assets/images/a12.png) no-repeat;
                overflow: hidden;
            }

            .jssora12l {
                background-position: -16px -37px;
            }

            .jssora12r {
                background-position: -75px -37px;
            }

            .jssora12l:hover {
                background-position: -136px -37px;
            }

            .jssora12r:hover {
                background-position: -195px -37px;
            }

            .jssora12ldn {
                background-position: -256px -37px;
            }

            .jssora12rdn {
                background-position: -315px -37px;
            }
        </style>
        <!-- Arrow Left -->
        <span u="arrowleft" class="jssora12l" style="width: 30px; height: 46px; top: 123px; left: 0px;">
        </span>
        <!-- Arrow Right -->
        <span u="arrowright" class="jssora12r" style="width: 30px; height: 46px; top: 123px; right: 0px">
        </span>
        <!-- Arrow Navigator Skin End -->
        <a style="display: none" href="http://www.jssor.com">javascript</a>
    </div>
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