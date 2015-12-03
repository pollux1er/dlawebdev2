<?php

 ?>
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
				margin: 4% auto -155px; /* the bottom margin is the negative value of the footer's height */
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
			
		-->
	</style>
		<div class="wrapper">
			<style> 
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
    </style>
    <!-- it works the same with all jquery version from 1.x to 2.x -->
   <!-- <script type="text/javascript" src="../js/jquery-1.9.1.min.js"></script>-->
    <!-- use jssor.slider.mini.js (40KB) instead for release -->
    <!-- jssor.slider.mini.js = (jssor.js + jssor.slider.js) -->
    <script type="text/javascript" src="http://dladev1.cm.perenco.com/base_loisirs/assets/js/jssor.js"></script>
    <script type="text/javascript" src="http://dladev1.cm.perenco.com/base_loisirs/assets/js/jssor.slider.js"></script>
    <script>

        jQuery(document).ready(function ($) {
            var options = {
                $AutoPlay: true,                                    //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
                $AutoPlaySteps: 1,                                  //[Optional] Steps to go for each navigation request (this options applys only when slideshow disabled), the default value is 1
                $AutoPlayInterval: 8000,                            //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
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

                $ArrowNavigatorOptions: {
                    $Class: $JssorArrowNavigator$,              //[Requried] Class to create arrow navigator instance
                    $ChanceToShow: 1,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
                    $AutoCenter: 2,                                 //[Optional] Auto center arrows in parent container, 0 No, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
                    $Steps: 1                                       //[Optional] Steps to go for each navigation request, default value is 1
                },

                $ThumbnailNavigatorOptions: {
                    $Class: $JssorThumbnailNavigator$,              //[Required] Class to create thumbnail navigator instance
                    $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always

                    $ActionMode: 1,                                 //[Optional] 0 None, 1 act by click, 2 act by mouse hover, 3 both, default value is 1
                    $AutoCenter: 3,                                 //[Optional] Auto center thumbnail items in the thumbnail navigator container, 0 None, 1 Horizontal, 2 Vertical, 3 Both, default value is 3
                    $Lanes: 1,                                      //[Optional] Specify lanes to arrange thumbnails, default value is 1
                    $SpacingX: 3,                                   //[Optional] Horizontal space between each thumbnail in pixel, default value is 0
                    $SpacingY: 3,                                   //[Optional] Vertical space between each thumbnail in pixel, default value is 0
                    $DisplayPieces: 9,                              //[Optional] Number of pieces to display, default value is 1
                    $ParkingPosition: 260,                          //[Optional] The offset position to park thumbnail
                    $Orientation: 1,                                //[Optional] Orientation to arrange thumbnails, 1 horizental, 2 vertical, default value is 1
                    $DisableDrag: false                            //[Optional] Disable drag or not, default value is false
                }
            };

            var jssor_slider2 = new $JssorSlider$("slider2_container", options);
            //responsive code begin
            //you can remove responsive code if you don't want the slider scales while window resizes
            function ScaleSlider() {
                var parentWidth = jssor_slider2.$Elmt.parentNode.clientWidth;
                if (parentWidth)
                    jssor_slider2.$ScaleWidth(Math.min(parentWidth, 600));
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
	<div id="error" align="center" style=""><?php echo $message; ?></div>
    <!-- Jssor Slider Begin -->
    <!-- You can move inline styles to css file or css block. -->
    <div id="slider2_container" style="position: relative; top: 0px; left: 0px; width: 600px; height: 300px; overflow: hidden; ">

        <!-- Loading Screen -->
        <div u="loading" style="position: absolute; top: 0px; left: 0px;">
            <div style="filter: alpha(opacity=70); opacity:0.7; position: absolute; display: block;
                background-color: #000000; top: 0px; left: 0px;width: 100%;height:100%;">
            </div>
            <div style="position: absolute; display: block; background: url(<?php echo base_url(); ?>assets/base_loisirs/img/loading.gif) no-repeat center center;
                top: 0px; left: 0px;width: 100%;height:100%;">
            </div>
        </div>

        <!-- Slides Container -->
        <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 600px; height: 300px; overflow: hidden;">
            <!--<div>
                <img u="image" src="<?php echo base_url(); ?>assets/base_loisirs/img/photography/img1.jpg" />
                <img u="thumb" src="<?php echo base_url(); ?>assets/base_loisirs/img/photography/timg1.jpg" />
            </div>-->
			<div>
                <img u="image" src="http://dlawebdev2.cm.perenco.com/assets/portail/images/ebome-lalobe.jpg" />
                <img u="thumb" src="http://dlawebdev2.cm.perenco.com/assets/portail/images/thumbs/ebome-lalobe.jpg" />
            </div>
			<div>
                <img u="image" src="http://dlawebdev2.cm.perenco.com/assets/portail/images/reunion-dg.jpg" />
                <img u="thumb" src="http://dlawebdev2.cm.perenco.com/assets/portail/images/thumbs/reunion-dg.jpg" />
            </div>
            <div>
                <img u="image" src="<?php echo base_url(); ?>assets/base_loisirs/img/photography/img2.jpg" />
                <img u="thumb" src="<?php echo base_url(); ?>assets/base_loisirs/img/photography/timg2.jpg" />
            </div>
            <div>
                <img u="image" src="http://dlawebdev2.cm.perenco.com/assets/portail/images/visite-chairman.jpg" />
                <img u="thumb" src="http://dlawebdev2.cm.perenco.com/assets/portail/images/thumbs/visite-chairman.jpg" />
            </div>
			<!--<div>
                <img u="image" src="<?php echo base_url(); ?>assets/base_loisirs/img/photography/img3.jpg" />
                <img u="thumb" src="<?php echo base_url(); ?>assets/base_loisirs/img/photography/timg3.jpg" />
            </div>-->
            <div>
                <img u="image" src="<?php echo base_url(); ?>assets/base_loisirs/img/photography/img4.jpg" />
                <img u="thumb" src="<?php echo base_url(); ?>assets/base_loisirs/img/photography/timg4.jpg" />
            </div>
            <div>
                <img u="image" src="<?php echo base_url(); ?>assets/base_loisirs/img/photography/img5.jpg" />
                <img u="thumb" src="<?php echo base_url(); ?>assets/base_loisirs/img/photography/timg5.jpg" />
            </div>
            <div>
                <img u="image" src="<?php echo base_url(); ?>assets/base_loisirs/img/photography/img6.jpg" />
                <img u="thumb" src="<?php echo base_url(); ?>assets/base_loisirs/img/photography/timg6.jpg" />
            </div>
			<div>
                <img u="image" src="http://dlawebdev2.cm.perenco.com/assets/portail/images/moudi.jpg" />
                <img u="thumb" src="http://dlawebdev2.cm.perenco.com/assets/portail/images/thumbs/moudi.jpg" />
            </div>
            <!--<div>
                <img u="image" src="<?php echo base_url(); ?>assets/base_loisirs/img/photography/img7.jpg" />
                <img u="thumb" src="<?php echo base_url(); ?>assets/base_loisirs/img/photography/timg7.jpg" />
            </div>-->
           
        </div>
        
        <!-- Arrow Navigator Skin Begin -->
        <style>
            /* jssor slider arrow navigator skin 02 css */
            /*
            .jssora02l              (normal)
            .jssora02r              (normal)
            .jssora02l:hover        (normal mouseover)
            .jssora02r:hover        (normal mouseover)
            .jssora02ldn            (mousedown)
            .jssora02rdn            (mousedown)
            */
            .jssora02l, .jssora02r, .jssora02ldn, .jssora02rdn
            {
            	position: absolute;
            	cursor: pointer;
            	display: block;
                background: url(<?php echo base_url(); ?>assets/base_loisirs/img/a02.png) no-repeat;
                overflow:hidden;
            }
            .jssora02l { background-position: -3px -33px; }
            .jssora02r { background-position: -63px -33px; }
            .jssora02l:hover { background-position: -123px -33px; }
            .jssora02r:hover { background-position: -183px -33px; }
            .jssora02ldn { background-position: -243px -33px; }
            .jssora02rdn { background-position: -303px -33px; }
        </style>
        <!-- Arrow Left -->
        <span u="arrowleft" class="jssora02l" style="width: 55px; height: 55px; top: 123px; left: 8px;">
        </span>
        <!-- Arrow Right -->
        <span u="arrowright" class="jssora02r" style="width: 55px; height: 55px; top: 123px; right: 8px">
        </span>
        <!-- Arrow Navigator Skin End -->
        
        <!-- ThumbnailNavigator Skin Begin -->
        <div u="thumbnavigator" class="jssort03" style="position: absolute; width: 600px; height: 60px; left:0px; bottom: 0px;">
            <div style=" background-color: #000; filter:alpha(opacity=30); opacity:.3; width: 100%; height:100%;"></div>

            <!-- Thumbnail Item Skin Begin -->
            <style>
                /* jssor slider thumbnail navigator skin 03 css */
                /*
                .jssort03 .p            (normal)
                .jssort03 .p:hover      (normal mouseover)
                .jssort03 .pav          (active)
                .jssort03 .pav:hover    (active mouseover)
                .jssort03 .pdn          (mousedown)
                */
                .jssort03 .w, .jssort03 .pav:hover .w
                {
                	position: absolute;
                	width: 60px;
                	height: 30px;
                	border: white 1px dashed;
                }
                * html .jssort03 .w
                {
                	width /**/: 62px;
                	height /**/: 32px;
                }
                .jssort03 .pdn .w, .jssort03 .pav .w { border-style: solid; }
                .jssort03 .c
                {
                	width: 62px;
                	height: 32px;
                	filter:  alpha(opacity=45);
                	opacity: .45;
                	
                	transition: opacity .6s;
                    -moz-transition: opacity .6s;
                    -webkit-transition: opacity .6s;
                    -o-transition: opacity .6s;
                }
                .jssort03 .p:hover .c, .jssort03 .pav .c
                {
                	filter:  alpha(opacity=0);
                	opacity: 0;
                }
                .jssort03 .p:hover .c
                {
                	transition: none;
                    -moz-transition: none;
                    -webkit-transition: none;
                    -o-transition: none;
                }
            </style>
            <div u="slides" style="cursor: move;">
                <div u="prototype" class="p" style="POSITION: absolute; WIDTH: 62px; HEIGHT: 32px; TOP: 0; LEFT: 0;">
                    <div class=w><div u="thumbnailtemplate" style=" WIDTH: 100%; HEIGHT: 100%; border: none;position:absolute; TOP: 0; LEFT: 0;"></div></div>
                    <div class=c style="POSITION: absolute; BACKGROUND-COLOR: #000; TOP: 0; LEFT: 0">
                    </div>
                </div>
            </div>
            <!-- Thumbnail Item Skin End -->
        </div>
        <!-- ThumbnailNavigator Skin End -->
        <a style="display: none" href="http://www.jssor.com">javascript</a>
    </div>
			<div class="push"></div>
		</div>
		<div class="footerholder">
			<div class="footer">
				<div style="float: left;margin: 5px;text-align: right;width: 47%; line-height:15px"><strong>Corporate</strong><hr style="border: 1px solid white;" />
					<a target="_blank" href="http://www.perenco.com/cameroon">Perenco Cameroon Website</a><br />
					<a target="_self" href="http://dlawebprd2.cm.perenco.com/">Subsidiary Intranet</a>
				</div>
				<div style="float: left;  margin: 5px; text-align: left;width: 48%; line-height:15px"><strong>Group</strong><hr style="border: 1px solid white;" />
					<a target="_blank" href="http://www.perenco.com/">Perenco Group Website</a> <br />
					<a target="_self" href="http://intranet.perenco.net/">Intranet Group</a>
				</div>
			</div>
		</div>
		<!--<div id="body_content" style="margin:1%">
			<br />
			<input id="step_img" type="hidden" value="1"/>
			<input id="max_actu" type="hidden" value="<?php echo $max_actu; ?>"/>
			<input id="frst" type="hidden" value="<?php echo $frst; ?>" />
			<div style="width:100%; overflow:visible; position:relative;">
				
				<div id="left" >
					<div class="photo">
						
						<div id="div_ph">
							<div id="wait" align="center">
							
								<img src="<?php // echo img_url("loading213.gif"); ?>"/>	
							</div>
							<div id="1" align="center" style="height:390px; height:390px; overflow-y:hidden; background-color:rgba( 0, 0, 0, 1)">
								<img id="img_sl" style="width:550px;" src="<?php //echo img_url("actu/master527.png"); ?>"/>
							</div>
							--><!--<div id="2" align="center">
								<img style="width:550px;" src="<?php //echo img_url("actu/master527.png"); ?>"/>
							</div>--><!--
							<div id="barre_select" align="center">
								<div id="page_1" class="nav_diapo" align="center">
									
									
									<?php // $i = 1; foreach( $id_actus as $act ) { ?>
										<a id="step_<?php // echo $i; ?>" onclick="_step('<?php // echo $act; ?>')"><?php // echo $i; ?></a>
									<?php // $i++; } ?>
									
													
								</div>
							</div>
						</div>
						<div id="ph_desc">
							<p id="titre"> </p>
							<div id="ph_content">
								
							</div> 
							<span><a id="lien_suite" href=""></a></span>
						</div>
					</div>
				</div>
				-->
				
				<!--
				<div id="right"> 
					<div class="left_menus">
						<div class="odd_title">
							Ev&egrave;nements
						</div>							
						<ul>	
							<li>
								<a href="<?php // echo base_url()."working_area" ?>" class="level2"><span>Fetes de fin d'annee</span></a>
							</li>
							<li>
								<a href="<?php // echo base_url()."working_area" ?>" class="level2"><span>Soiree du trentenaire</span></a>
							</li>
							<li>
								<a href="<?php // echo base_url()."working_area" ?>" class="level2"><span>Tournoi de Golf</span></a>
							</li>
							
							<li>
								<a href="<?php // echo base_url()."working_area" ?>" class="level2"><span>Le SAPREF</span></a>
							</li>
						</ul>
					</div>
					
					<div class="cleardiv">&nbsp;</div>	
				
					<div class="left_menus">
						<div class="odd_title">
							Notes de Service
						</div>									
						<ul>	
							<li>
								<a href="<?php // echo base_url()."working_area" ?>" class="level2"><span>Sorties des stocks - Restrictions DMTS</span></a>
							</li>
							<li>
								<a href="<?php // echo base_url()."working_area" ?>" class="level2"><span>DG-Réorganisation Interne (Septembre 2014)</span></a>
							</li>
							<li>
								<a href="<?php // echo base_url()."working_area" ?>" class="level2"><span>Itinéraire suplémentaire pour la navette du personnel</span></a>
							</li>
							<li>
								<a href="<?php // echo base_url()."working_area" ?>" class="level2"><span>Notes de Mutation de la Direction Générale</span></a>
							</li>
							<li>
								<a href="<?php // echo base_url()."working_area" ?>" class="level2"><span>Verifications periodiques et requalifications des appareils et accessoires de levages</span></a>
							</li>
						</ul>
					</div>
				</div>
				
			</div>
		</div>-->
		
		
		<script type="text/javascript">
			/*
			function _step(a)
			{
				var step = a.split("_");
				$("#step_img").val( step[0] );
				
				var param = [ { "name": "actu" , value: step[1] } ];
				
				$.post( 'accueil/slide_img', param, function(data){
					if(data.success)
					{
						$('#wait').fadeIn();
						$('#img_sl').css("visibility", "hidden" );
						$('#img_sl').attr( "src" , data.image );
						
						if( Array.isArray(data.suite) )
						{
							$('#lien_suite').attr( "src", data.suite.lien );
							$('#lien_suite').html( data.suite.lib );
						}else{
							$('#lien_suite').attr( "src", "" );
							$('#lien_suite').html( "" );
						}
						
						col(step[0], step[1]);
						
						window.setTimeout( function(){
							
							var hgt1 = parseInt( $("#1").css("height") );
							var hgt2 = parseInt( $("#img_sl").css("height") );
							
							if( ( hgt1 > hgt2 ) && ( hgt2 != 0 ) )
							{
								var pad = ( hgt1 - hgt2 ) / 2;
								
								$("#img_sl").css("margin-top", pad).css("margin-bottom", pad);
							}else{
								$("#img_sl").css("margin-top", 0 ).css("margin-bottom", 0 );
							}
							
							$('#wait').fadeOut();
						}, 500 );
						
						
						window.setTimeout( function(){
						
							$('#titre').html( data.title );
							$('#ph_content').html( data.contenu );
							$('#img_sl').css("visibility", "visible" );
							
						}, 1000 );
						
					}
				}, "json" );
			}
			
			function col( num, num_id )
			{
				var param = [{ "name":"num", value: num }, { "name":"num_id", value: num_id }];
				
				$.post('accueil/reloadA', param, function(data){
					if(data)
					{
						$('#page_1').html( data );
					}
				}, "text");
				
			}
			
			$(function(){ 
				
				if( parseInt( $('#max_actu').val() ) != 0  )
				{
					var a = document.getElementById('page_1').getElementsByTagName('a')[0];
					$(a).trigger('click');
					
					setInterval(function(){
						
						if( parseInt($('#step_img').val()) == 5 )
						{
							var i = 1;
						}else{
							var i = parseInt($('#step_img').val()) + 1;
						}		
						
						var vid = 'step_'+i;
						
						var b = document.getElementById(vid);
						$(b).trigger('click');				
					}, 10000);
				}
			});
			
			*/
		</script>
	</div>
	</div></div></div>
