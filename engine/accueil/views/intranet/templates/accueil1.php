<?php

 ?>
	<style type="text/css">
		<!--
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
		-->
	</style>
	
		<div id="body_content">
			<br>
			
			<div style="width:100%; overflow:visible; position:relative;">
				<div id="left" >
					<div class="photo">
						<div id="div_ph">
							<img style="width:550px;" src="<?php echo img_url("perenco2/master527.png"); ?>"/>
							<div id="barre_select" align="center">
								<div id="page_1" class="nav_diapo" align="center">
									<!--<a name="deb_vehicule" style="display:none;" onclick="_deb(this)"> ‹ Debut </a>-->
									<a name="prec_vehicule" style="display:none;" onclick="_prec(this)"> &lt; </a>
									<strong name="numb_vehicule">1</strong><a name="step_vehicule_1" onclick="_step(this)">2</a>
									<a name="step_vehicule_2" onclick="_step(this)">3</a>
									<a name="step_vehicule_3" style="display:none;" onclick="_step(this)">4</a>
									<a name="step_vehicule_4" style="display:none;" onclick="_step(this)">5</a>
									<a name="step_vehicule_5" style="display:none;" onclick="_step(this)">6</a>
									<a name="suiv_vehicule" onclick="_suiv(this)"> &gt; </a>
									<!--<a name="fin_vehicule" onclick="_fin(this)"> Fin › </a>-->							
								</div>
							</div>
						</div>
						<div id="ph_desc">
							<p> Nouvelles Installations </p>
							<div>
								(Chairman) and Jean-Michel Jacoulot (CEO) visited Vietnam during the week of 21-26 October 2014 to attend the Su Tu Nau and Su Tu Vang South West First OiI?s Ceremony which was held on Friday October 24, 2014. 

								The ceremony was attented by many high level officials including Mr. Hoang Trung Hai ? Deputy Prime Minister, Mr. Nguyen Cao Luc ? Deputy Head of Government Office, Mr. Dang Huy Cuong ? General Director of Petroleum Energy Department, Mr. Do Xuan Son ? Chairman of PVN, Dr. Do Van Hau - PVN President & CEO, Dr. Hoang Ngoc Dang- Chairman of PVEP and Dr. Do Van Khanh - PVEP CEO & President.

								On this occasion, CLJOC (the operator of Block 15-1), was honored to be awarded the First Level Labor Medal of the Social Republic of Vietnam.

								During their visit, Francois Perrodo and Jean-Michel Jacoulot had executive meetings with PVN and PVEP?s leaders strengthening the friendship and partnership between companies and also visited the offshore fields and the newly producing facilities.

								The Block 15-1 team achieved first oil for STN on 14 September, 2014 which was safely delivered 3 weeks ahead of schedule and within budget. Su Tu Vang South West's first oil was achieved on 19 September 2014, also within budget and 6 weeks ahead of schedule. 

								This is the third consecutive year of first oil achievements in Block 15-1 since 2012: Su Tu Trang's first gas in September 2012; Su Tu Vang North East's first oil in September 2013 and Su Tu Nau / Su Tu Vang South West in 2014.
							</div>...
							<span><a>>> Lire la suite</a></span>
						</div>
					</div>
				</div>
				
				<div id="right">
					<div class="left_menus">
						<div class="odd_title">
							Ev&egrave;nements
						</div>							
						<ul>	
							<li>
								<a href="" class="level2"><span>Fetes de fin d'annee</span></a>
							</li>
							<li>
								<a href="" class="level2"><span>Soiree du trentenaire</span></a>
							</li>
							<li>
								<a href="" class="level2"><span>Tournoi de Golf</span></a>
							</li>
							
							<li>
								<a href="" class="level2"><span>Le SAPREF</span></a>
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
								<a href="" class="level2"><span>Sorties des stocks - Restrictions DMTS</span></a>
							</li>
							<li>
								<a href="" class="level2"><span>DG-Réorganisation Interne (Septembre 2014)</span></a>
							</li>
							<li>
								<a href="" class="level2"><span>Itinéraire suplémentaire pour la navette du personnel</span></a>
							</li>
							<li>
								<a href="" class="level2"><span>Notes de Mutation de la Direction Générale</span></a>
							</li>
							<li>
								<a href="" class="level2"><span>Verifications periodiques et requalifications des appareils et accessoires de levages</span></a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div></div></div>
