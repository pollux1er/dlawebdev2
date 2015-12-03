<!DOCTYPE html> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" > 
	<head>
		<title>Perenco Cameroon Intranet</title>
		<base href="<?php echo base_url(); ?>" target="_blank">
		<meta http-equiv="X-UA-Compatible"  content="IE=9;" />
		<meta name="GENERATOR" content="MSHTML 9.00.8112.16443" />
		<link rel="shortcut icon" type="image/ico" href="http://dlawebprd2.cm.perenco.com/assets/intranet/images/perenco1/favicon.ico" />
	
		<link rel="stylesheet" type="text/css" media="screen" href="http://dlawebprd2.cm.perenco.com/assets/intranet/css/intranet/alert_late.css" />
		<link rel="stylesheet" type="text/css" media="screen" href="http://dlawebprd2.cm.perenco.com/assets/intranet/css/it_assets/style (2).css" />
		<link rel="stylesheet" type="text/css" media="screen" href="http://dlawebprd2.cm.perenco.com/assets/intranet/css/List/top_menu.css" />
		<link rel="stylesheet" type="text/css" media="screen" href="http://dlawebprd2.cm.perenco.com/assets/intranet/css/List/left_menu.css" />
		<link rel="stylesheet" type="text/css" media="screen" href="http://dlawebprd2.cm.perenco.com/assets/intranet/css/List/main.css" />
		<link rel="stylesheet" type="text/css" media="screen" href="http://dlawebprd2.cm.perenco.com/assets/intranet/css/List/datepicker.css" />
		<link rel="stylesheet" type="text/css" media="screen" href="http://dlawebprd2.cm.perenco.com/assets/intranet/css/Perenco2/generic.css" />
		<link rel="stylesheet" type="text/css" media="screen" href="http://dlawebprd2.cm.perenco.com/assets/intranet/css/perenco2/print.css" />
		<link rel="stylesheet" type="text/css" media="screen" href="http://dlawebprd2.cm.perenco.com/assets/intranet/css/List/style.css" />
		<link rel="stylesheet" type="text/css" media="screen" href="http://dlawebprd2.cm.perenco.com/assets/intranet/css/List/style_002.css" />
		<link rel="stylesheet" type="text/css" media="screen" href="http://dlawebprd2.cm.perenco.com/assets/intranet/css/it_assets/message.css" />
		<link rel="stylesheet" type="text/css" media="screen" href="http://dlawebprd2.cm.perenco.com/assets/intranet/css/jquery.datepick.css" />
		<link rel="stylesheet" type="text/css" href="http://dlawebprd2.cm.perenco.com/assets/intranet/css/perenco_intranet/print.css" media="print">
		<link type="text/css" rel="stylesheet" href="http://localhost/dlawebdev2/assets/portail/css/lightslider.css" />
		
		<script src="http://dlawebprd2.cm.perenco.com/assets/intranet/javascript/jquery/jquery.js" type="text/javascript"></script>
		<script src="http://dlawebprd2.cm.perenco.com/assets/intranet/javascript/jquery.form.js" type="text/javascript"></script>
		<!--<script src="http://dlawebprd2.cm.perenco.com/assets/intranet/javascript/jquery-1.3.2.min.js" type="text/javascript"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>-->
		<script src="http://localhost/dlawebdev2/assets/portail/js/jquery.min.js"></script>
		<script type="text/javascript" src="http://dlawebprd2.cm.perenco.com/assets/intranet/javascript/xhr_test.js"></script>
		<script type="text/javascript" src="http://dlawebprd2.cm.perenco.com/assets/intranet/javascript/it_assets/pagination.js"></script>
		<script type="text/javascript" src="http://dlawebprd2.cm.perenco.com/assets/intranet/javascript/it_assets/cut_space.js"></script>
		<script type="text/javascript" src="http://dlawebprd2.cm.perenco.com/assets/portail/js/jssor.js"></script>
		<script type="text/javascript" src="http://dlawebprd2.cm.perenco.com/assets/portail/js/jssor.slider.js"></script>
		<script type="text/javascript" src="http://localhost/dlawebdev2/assets/portail/js/lightslider.js"></script>
		<style type="text/css">
		<!--
			* {
				margin: 0;
			}
			html, body {
				height: 100%;
			}
			.wrapper {
				height: auto !important;
				width : 600px;
			}
			
			.footerholder {
				background: none repeat scroll 0 0 transparent;
				bottom: 0;
				position: fixed;
				text-align: center;
				width: 100%;
			}

			
			.wrapper {
				min-height: 100%;
				/*margin: 4% auto -155px;  the bottom margin is the negative value of the footer's height */
				margin: 3% auto;
				width: 72%;
			}
			
			
			#left
			{
				width: 60%;
				max-width: 800px;
				float: left;
				padding: 0 0 0 10px; 
				height:450px;
				display: block;
			}
			
			#right
			{	
				width: 22%;
				/*max-width: 300px;*/
				margin-left: 30px;
				float: right;
				display: block;
				margin-bottom : 5px;
			}
			
			#right li
			{
				border-bottom: 1px dotted gray;
				line-height:25px;
			}
			
			#ph_desc
			{
				position: absolute;
				display: inline-block;
				text-decoration: none;
				color: #4f565c;
				max-width:200px;
				background: #fff;
				max-height: 300px;
				float: left;
				padding: 21px 18px 25px 60px;
				margin: 25px 0 0 500px;
				z-index: 1;
				border-radius: 0 10px 10px 0;
				
			}
			
			#ph_desc div
			{
				max-height:250px;
				overflow:hidden;
				text-overflow:ellipsis;
				white-space:pre-line; 
				overflow:hidden; 
				text-overflow:ellipsis;
				
			}
			
			#ph_desc span
			{
				margin: 20px 0 0 0;
				float:right;
			}
			
			#ph_desc span a
			{
				text-decoration: underline;
				cursor: pointer;
				color: black;
			}
			
			#ph_desc span a:hover
			{
				color: orange;
			}
			
			#ph_desc p
			{
				font-size:18px;
			}
			
			#div_ph
			{
				position: absolute;
				z-index: 2;
			}
			
			#barre_select
			{
				position: relative;
				margin: 0px;
				/*border: 1px solid black;*/
				background: url(./assets/css/Perenco2/images/lil_ban_4.png) repeat-x scroll left bottom;
				/*width: 537px;*/
				padding: 5px;
				height:25px;
				border-radius: 0 0 10px 10px;
			}
			
			.nav_diapo
			{
				width: 48%;
				text-align: right;
				font-size: 0.85em;
				margin: auto;
				margin-top: 2px;
				margin-bottom: 2px;
				padding: 3px;
				text-align: center;
			}
			
			.nav_diapo strong, .picked_link 
			{
				background-color: #3666D4;
				/* background-color: #366600; */
				background-image: none;
				background-position: center bottom;
				border: 1px solid #2B55AF;
				/* border: 1px solid #2B5500; */
				border-radius: 4px 4px 4px 4px;
				color: #FFFFFF;
				font-weight: bold;
				margin-right: 3px;
				padding: 2px 6px;
				text-decoration: none;
			}
			
			.nav_diapo a {
				color: green;
				background-color: #E9EEEE;
				background-position: center bottom;
				border: 1px solid #CCDBE4;
				border-radius: 4px 4px 4px 4px;
				/* color: #0061DE; */
				margin-right: 3px;
				padding: 2px 6px;
				text-decoration: none;
			}
			
			.disabled {
				
				background-color: darkgray;
			}
			
			.odd_title
			{
				padding: .6em;
				background-color: #e4ecf4;
				background: url(./assets/css/List/top-bottom-50px.png) repeat-x scroll left bottom;
				border: 0;
				border-top: 2px solid #8CaCD8;
				border-bottom: 2px solid #8CaCD8;
				color: black;
				font-weight: bold;
				font-variant: small-caps;
				font-size: 1.7em;
				text-align: center;
			}
			
			#wait
			{
				position:absolute;
				width:550px;
				background-color: rgba( 254, 254, 254, 0.6 );
				/* margin-top:200px; */
				/* visibility:hidden; */
				display:none;
			}
			
			
			
			.captionOrange, .captionBlack
			{
				color: #fff;
				font-size: 20px;
				line-height: 30px;
				text-align: center;
				border-radius: 4px;
			}
			.captionOrange
			{
				background: #EB5100;
				background-color: rgba(235, 81, 0, 0.6);
			}
			.captionBlack
			{
				font-size:16px;
				background: #000;
				background-color: rgba(0, 0, 0, 0.4);
			}
			a.captionOrange, A.captionOrange:active, A.captionOrange:visited
			{
				color: #ffffff;
				text-decoration: none;
			}
			a.captionOrange:hover
			{
				color: #eb5100;
				text-decoration: underline;
				background-color: #eeeeee;
				background-color: rgba(238, 238, 238, 0.7);
			}
			.bricon
			{
				background: url(assets/base_loisirs/img/browser-icons.png);
			}
			.item{
				/*margin-bottom: 60px;*/
				width: 100%;
			}
			.item li {
				margin-left : 0px;
				color : white;
			}
		-->
		</style>
		<script>
			jQuery(document).ready(function ($) {
				var _SlideshowTransitions = [
            //Fade in R
            {$Duration: 1200, x: -0.3, $During: { $Left: [0.3, 0.7] }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
            //Fade out L
            , { $Duration: 1200, x: 0.3, $SlideOut: true, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
            ];

            var options = {
                $AutoPlay: false,                                    //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
                $AutoPlaySteps: 1,                                  //[Optional] Steps to go for each navigation request (this options applys only when slideshow disabled), the default value is 1
                $AutoPlayInterval: 4000,                            //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
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
                    $Lanes: 2,                                      //[Optional] Specify lanes to arrange items, default value is 1
                    $SpacingX: 10,                                   //[Optional] Horizontal space between each item in pixel, default value is 0
                    $SpacingY: 10                                    //[Optional] Vertical space between each item in pixel, default value is 0
                },

                $ArrowNavigatorOptions: {
                    $Class: $JssorArrowNavigator$,              //[Requried] Class to create arrow navigator instance
                    $ChanceToShow: 2,                                //[Required] 0 Never, 1 Mouse Over, 2 Always
                    $AutoCenter: 2                                 //[Optional] Auto center navigator in parent container, 0 None, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
                },

                $ThumbnailNavigatorOptions: {
                    $Class: $JssorThumbnailNavigator$,              //[Required] Class to create thumbnail navigator instance
                    $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
                    $ActionMode: 0,                                 //[Optional] 0 None, 1 act by click, 2 act by mouse hover, 3 both, default value is 1
                    $DisableDrag: true                              //[Optional] Disable drag or not, default value is false
                }
            };

            var jssor_sliderb = new $JssorSlider$("slider2_container", options);
            //responsive code begin
            //you can remove responsive code if you don't want the slider scales while window resizes
            function ScaleSlider() {
                var parentWidth = jssor_sliderb.$Elmt.parentNode.clientWidth;
                if (parentWidth)
                    jssor_sliderb.$ScaleWidth(Math.min(parentWidth, 593));
                else
                    window.setTimeout(ScaleSlider, 30);
            }
            ScaleSlider();

            $(window).bind("load", ScaleSlider);
            $(window).bind("resize", ScaleSlider);
            $(window).bind("orientationchange", ScaleSlider);
			});
			
			jQuery(document).ready(function() {
				$("#content-slider").lightSlider({
					loop:true,
					auto:true,
					item:1,
					speed:800,
					controls: false,
					pager: false,
					prevHtml: '',
					nextHtml: '',
					pause: 10000
				});
			});
			
		</script>
	</head>
	<body style="">
		<div id="tpl_wrapper_page">
			<div id="tpl_header">
				<div><a id="tpl_title" href="" target="_self"></a></div>
			</div> <!-- end #tpl_header -->
			<div id="tpl_main_body">
				<div class="generic_menu">
					<?php echo $this->load->view('templates/elements/generic_menu'); ?>			
				</div>
			</div>
			