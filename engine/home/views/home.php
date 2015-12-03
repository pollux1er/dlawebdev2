<?php echo $this->load->view('templates/header'); ?>
<div class="wrapper">
	<!--<div id="error" align="center" style=""><?php //echo $message; ?></div>-->
    <!-- Jssor Slider Begin -->
    <!-- You can move inline styles to css file or css block. -->
	<div id="error" align="center" style=""><?php echo ( (isset($_GET['err'])) ? "ACCESS DENIED" : "" ); ?></div>
    <div id="container" style="margin: 0 auto; width: 92%;">
		<div style="border: 2px solid #fff; width: 593px; float:left; max-width: 57%;"><!---->
			<div id="slider2_container" style="position: relative;  width: 593px; height: 290px; overflow: hidden;">

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
				<div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 593px; height: 290px; overflow: hidden;">
					
					<div>	
						
						<img u="image" src="http://dlawebprd2.cm.perenco.com/assets/portail/images/slider/image1.png" />
						<div u="thumb">PREMIERE MARCHE SPORTIVE ASCIP </div>
					</div>
					<div>
						<img u="image" src="http://dlawebprd2.cm.perenco.com/assets/portail/images/slider/image2.png" />
						<div u="thumb">PREMIERE MARCHE SPORTIVE ASCIP</div>
					</div>
					<!--<div>
						<img u="image" src="http://dlawebprd2.cm.perenco.com/assets/portail/images/slider/image3.png" />
						<div u="thumb">Do you notice it is draggable by mouse/finger?</div>
					</div>-->
					<div>
						<img u="image" src="http://dlawebprd2.cm.perenco.com/assets/portail/images/slider/image4.png" />
						<div u="thumb">PREMIERE MARCHE SPORTIVE ASCIP</div>
					</div>
					<div>
						<img u="image" src="http://dlawebprd2.cm.perenco.com/assets/portail/images/slider/image5.png" />
						<div u="thumb">PREMIERE MARCHE SPORTIVE ASCIP</div>
					</div>
					<div>
						<img u="image" src="http://dlawebprd2.cm.perenco.com/assets/portail/images/slider/image6.png" />
						<div u="thumb">PREMIERE MARCHE SPORTIVE ASCIP</div>
					</div>
					<div>
						<img u="image" src="http://dlawebprd2.cm.perenco.com/assets/portail/images/slider/image7.png" />
						<div u="thumb">PREMIERE MARCHE SPORTIVE ASCIP</div>
					</div>
					<div>
						<img u="image" src="http://dlawebprd2.cm.perenco.com/assets/portail/images/slider/image8.png" />
						<div u="thumb">PREMIERE MARCHE SPORTIVE ASCIP</div>
					</div>
					<div>
						<img u="image" src="http://dlawebprd2.cm.perenco.com/assets/portail/images/slider/image9.png" />
						<div u="thumb">PREMIERE MARCHE SPORTIVE ASCIP</div>
					</div>           
				</div>
				
				<!-- ThumbnailNavigator Skin Begin -->
				<div u="thumbnavigator" class="sliderb-T" style="position: absolute; bottom: 0px; left: 0px; height:45px; width:600px;">
					<div style="filter: alpha(opacity=40); opacity:0.4; position: absolute; display: block;
						background-color: #000000; top: 0px; left: 0px; width: 100%; height: 100%;">
					</div>
					<!-- Thumbnail Item Skin Begin -->
					<div u="slides">
						<div u="prototype" style="POSITION: absolute; WIDTH: 600px; HEIGHT: 45px; TOP: 0; LEFT: 0;">
							<div u="thumbnailtemplate" style="font-family: verdana; font-weight: normal; POSITION: absolute; WIDTH: 100%; HEIGHT: 100%; TOP: 0; LEFT: 0; color:#fff; line-height: 45px; font-size:20px; padding-left:10px;"></div>
						</div>
					</div>
					<!-- Thumbnail Item Skin End -->
				</div>
				<!-- ThumbnailNavigator Skin End -->
				
				<!-- Bullet Navigator Skin Begin -->
        <!-- jssor slider bullet navigator skin 01 -->
        <style>
            /*
            .jssorb01 div           (normal)
            .jssorb01 div:hover     (normal mouseover)
            .jssorb01 .av           (active)
            .jssorb01 .av:hover     (active mouseover)
            .jssorb01 .dn           (mousedown)
            */
            .jssorb01 div, .jssorb01 div:hover, .jssorb01 .av
            {
                filter: alpha(opacity=70);
                opacity: .7;
                overflow:hidden;
                cursor: pointer;
                border: #000 1px solid;
            }
            .jssorb01 div { background-color: gray; }
            .jssorb01 div:hover, .jssorb01 .av:hover { background-color: #d3d3d3; }
            .jssorb01 .av { background-color: #fff; }
            .jssorb01 .dn, .jssorb01 .dn:hover { background-color: #555555; }
        </style>
        <!-- bullet navigator container -->
        <div u="navigator" class="jssorb01" style="position: absolute; bottom: 7px; right: 10px;">
            <!-- bullet navigator item prototype -->
            <div u="prototype" style="POSITION: absolute; WIDTH: 12px; HEIGHT: 12px;"></div>
        </div>
        <!-- Bullet Navigator Skin End -->
        
        <!-- Arrow Navigator Skin Begin -->
        <style>
            /* jssor slider arrow navigator skin 05 css */
            /*
            .jssora05l              (normal)
            .jssora05r              (normal)
            .jssora05l:hover        (normal mouseover)
            .jssora05r:hover        (normal mouseover)
            .jssora05ldn            (mousedown)
            .jssora05rdn            (mousedown)
            */
            .jssora05l, .jssora05r, .jssora05ldn, .jssora05rdn
            {
            	position: absolute;
            	cursor: pointer;
            	display: block;
                background: url(../img/a17.png) no-repeat;
                overflow:hidden;
            }
            .jssora05l { background-position: -10px -40px; }
            .jssora05r { background-position: -70px -40px; }
            .jssora05l:hover { background-position: -130px -40px; }
            .jssora05r:hover { background-position: -190px -40px; }
            .jssora05ldn { background-position: -250px -40px; }
            .jssora05rdn { background-position: -310px -40px; }
        </style>
        <!-- Arrow Left -->
        <span u="arrowleft" class="jssora05l" style="width: 40px; height: 40px; top: 123px; left: 8px;">
        </span>
        <!-- Arrow Right -->
        <span u="arrowright" class="jssora05r" style="width: 40px; height: 40px; top: 123px; right: 8px">
        </span>
				</div>
				<!-- ThumbnailNavigator Skin End -->
				<a style="display: none" href="http://www.jssor.com">javascript</a>
			</div>
		</div>
		
		<div class="boxesleft" style="float:left; max-width: 39%;">
			<div class="vie">
				<span style="font-family: Verdana,Arial,sans-serif; color : #fff; font-size : 13px; font-weight : bold">Vie de la filiale</span>
				<hr class="box" />
				 <div class="item">
					<ul id="content-slider" class="content-slider">
						<li>
							<h3>D&eacute;part Jean-Yves GRALL</h3>
							<p>Bienvenue a Mr. Rome de St Leon qui le remplace. Vous etes tous convies au boucarreu pour un pot a 17h30</p>
						</li>
						<li>
							<h3>Visite du ministre</h3>
							<p>Le ministre sera en visite dans nos locaux le 20/09/2010</p>
						</li>
					</ul>
					
				</div>
				<hr class="box" style="" />
				<span style="font-family: Verdana,Arial,sans-serif; color : #fff; font-size : 12px; font-weight : bold; float:right;">CPG : BILONG Jean Emmanuel</span>
			</div>
			<div class="rh">
				<span style="font-family: Verdana,Arial,sans-serif; color : #fff; font-size : 13px; font-weight : bold">Note de services</span>
				<hr class="box" />
				<ul class="rhnotes">
					<li class="pdf"><a>[08/09/15] Cameroon Chart - Septembre 2015 edition</a></li>
					<li class="pdf"><a>[16/07/15] Note de Communication de la Direction g&eacute;n&eacute;rale</a></li>
					<li class="pdf"><a>[16/07/15] Note de R&eacute;organisation Interne - Edition Juillet 2015</a></li>
					<li class="pdf"><a>[16/07/15] Note de R&eacute;organisation Interne - Edition Juillet 2015</a></li>
				</ul>
				
				<span style="font-family: Verdana,Arial,sans-serif; color : #fff; font-size : 13px; font-weight : bold; margin-top: 10px;">Documents RH</span>
				<hr class="box" style="" />
				<ul class="rhdoc">
					<li class="pdf"><a>Convention Collectives</a></li>
					<li class="pdf"><a>Reglement Interieur</a></li>
				</ul>
			</div>
		</div>
	</div>
	
	<style>
		.vie {
			 background-color: #2f708c;
			border: 2px solid #fff;
			float: left;
			margin: 0 0 0 10px;
			max-height: 76px;
			min-height: 78px;
			overflow: hidden;
			padding: 7px;
			width: 97%;
		}
		.rh {
			background-color: #2f708c;
			border: 2px solid #fff;
			float: left;
			margin: 10px 0 10px 10px;
			max-height: 170px;
			min-height: 169px;
			overflow: hidden;
			padding: 7px;
			text-align: right;
			width: 97%;
		}
		hr.box {
			border : 1px solid;
			color : #fff;
			height : 1px;
			width : 100%;
			text-align : left;
		}
		ul.rhnotes {
			color: white;
			margin-left: 4px;
			margin-top: 6px;
			text-align: left;
			cursor : pointer
			margin-bottom: 5px;
		}
		ul.rhdoc {
			color: white;
			margin-left: 5px;
			margin-top: 6px;
			text-align: left;
			cursor : pointer
		}
		ul li.pdf {
			background : url(../../../assets/base_loisirs/images/pdf_icon_16.png) no-repeat left top;
			padding: 3px 0px 3px 24px;
			list-style: none;
			margin: 0px;
			color : #464646;
			cursor : pointer;
		}
		ul.rhnotes  li a:hover {
			background-color : white;
			color : #000000;
			
		}
	</style>
	
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

</div>

</body>
</html>