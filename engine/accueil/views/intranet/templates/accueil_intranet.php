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
	
		<div id="body_content">
			<br>
			<input id="step_img" type="hidden" value="1"/>
			<input id="max_actu" type="hidden" value="<?php echo $max_actu; ?>"/>
			<input id="frst" type="hidden" value="<?php echo $frst; ?>" />
			<div style="width:100%; overflow:visible; position:relative;">
				<div id="left" >
					<div class="photo">
						
						<div id="div_ph">
							<div id="wait" align="center">
							
								<img src="<?php echo img_url("loading213.gif"); ?>"/>	
							</div>
							<div id="1" align="center" style="height:390px; height:390px; overflow-y:hidden; background-color:rgba( 0, 0, 0, 1)">
								<img id="img_sl" style="width:550px;" src="<?php //echo img_url("actu/master527.png"); ?>"/>
							</div>
							<!--<div id="2" align="center">
								<img style="width:550px;" src="<?php //echo img_url("actu/master527.png"); ?>"/>
							</div>-->
							<div id="barre_select" align="center">
								<div id="page_1" class="nav_diapo" align="center">
									
									
									<?php $i = 1; foreach( $id_actus as $act ) { ?>
										<a id="step_<?php echo $i; ?>" onclick="_step('<?php echo $act; ?>')"><?php echo $i; ?></a>
									<?php $i++; } ?>
									
													
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
				
				<div id="right"> 
					<div class="left_menus">
						<div class="odd_title">
							Ev&egrave;nements
						</div>							
						<ul>	
							<li>
								<a href="<?php echo base_url()."working_area" ?>" class="level2"><span>Fetes de fin d'annee</span></a>
							</li>
							<li>
								<a href="<?php echo base_url()."working_area" ?>" class="level2"><span>Soiree du trentenaire</span></a>
							</li>
							<li>
								<a href="<?php echo base_url()."working_area" ?>" class="level2"><span>Tournoi de Golf</span></a>
							</li>
							
							<li>
								<a href="<?php echo base_url()."working_area" ?>" class="level2"><span>Le SAPREF</span></a>
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
								<a href="<?php echo base_url()."working_area" ?>" class="level2"><span>Sorties des stocks - Restrictions DMTS</span></a>
							</li>
							<li>
								<a href="<?php echo base_url()."working_area" ?>" class="level2"><span>DG-Réorganisation Interne (Septembre 2014)</span></a>
							</li>
							<li>
								<a href="<?php echo base_url()."working_area" ?>" class="level2"><span>Itinéraire suplémentaire pour la navette du personnel</span></a>
							</li>
							<li>
								<a href="<?php echo base_url()."working_area" ?>" class="level2"><span>Notes de Mutation de la Direction Générale</span></a>
							</li>
							<li>
								<a href="<?php echo base_url()."working_area" ?>" class="level2"><span>Verifications periodiques et requalifications des appareils et accessoires de levages</span></a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		
		<script type="text/javascript">
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
			
			
		</script>
	</div>
	</div></div></div>
