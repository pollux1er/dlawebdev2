<?php 

//var_dump($post['case']);
?>
<table class="legend">
	<tbody>
		<tr>
			<td><div style="background: none repeat scroll 0% 0% #0080ff;" class="color">&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
			<td width="100px">Réservée</td>
			<td><div style="background: none repeat scroll 0% 0% rgb(255, 128, 0);" class="color">&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
			<td width="100px">Réservation confirmée</td>
			<td><div style="background: none repeat scroll 0% 0% #ffffff;" class="color">&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
			<td width="100px">Réservation en attente</td>
			
		</tr>
	</tbody>
</table>
	<?php 
		list($d, $m, $y) = preg_split('/\//', $post['begin']);
		$sd = sprintf('%4d-%02d-%02d', $y, $m, $d);
		
		list($d, $m, $y) = preg_split('/\//', $post['end']);
		$ed = sprintf('%4d-%02d-%02d', $y, $m, $d);
		
		$start_date = $sd;
		$start = new DateTime( $start_date );
		$end_date = $ed;
		$end = new DateTime( $end_date );
		$endf = new DateTime( $end_date );
		//echo $d->format( 'Y-m-t' );
	//echo $this->demande->nb_jours($start_date, $end_date);
	
	?>
	<table class="planning" id="planning">
		<thead>
			<tr class="header">
				<td class="month" style="width:100px"></td>
				<?php if($this->demande->nb_mois($start_date, $end_date) == 1) { 
				//$this->demande->nb_jours($start_date, $end_date);
				?>
				<td colspan="<?php echo $this->demande->nb_jours($start_date, $end_date); ?>" style="text-align: center;" class="month"><?php echo date_format($start, 'F Y'); ?></td>
				<?php } else { 
					
					//$end = $end->modify( '+1 month' );
					//$end->add(new DateInterval("P1M"));
					//$interval = DateInterval::createFromDateString('1 month');

					//$period = new DatePeriod($start, $interval, $end);
					
					$interval = DateInterval::createFromDateString('1 day');
					$period = new DatePeriod($start, $interval, $end);

					$months = array();
					
					//$counter = 0;
					foreach($period as $dt) { 
						if(!in_array($dt->format( "m" ), $months)) {
							// Si c'est le 1er mois de la boucle
							if($dt->format( "m" )  == date_format($start, 'm')) { 	
							?>
							<td colspan="<?php echo $this->demande->nb_jours($start_date, $start->format( 'Y-m-t' )); ?>" style="text-align: center;" class="month"><?php echo date_format(new DateTime( $start_date ), 'F Y'); ?></td>
					<?php	} elseif ($dt->format( "m" ) == date_format($end, 'm')) { // Si c'est le dernier mois de la boucle ?>
							<td colspan="<?php echo $this->demande->nb_jours($endf->format( 'Y-m-1' ), $end_date); ?>" style="text-align: center;" class="month"><?php echo date_format(new DateTime( $end_date ), 'F Y'); ?></td>
					<?php	} else { // Si ce n'est ni le 1er ni le dernier  ?>
							<td colspan="<?php echo $this->demande->nb_jours($dt->format( 'Y-m-1' ), $dt->format( 'Y-m-t' )); ?>" style="text-align: center;" class="month"><?php echo $dt->format( 'F Y' ); ?></td>
					<?php	}
							$months[] = $dt->format( "m" );
						}
						//$counter++;
					}
					
					
					
				?><!--
				<td colspan="31" style="text-align: center;" class="month">Aug 2014</td>
				<td colspan="12" style="text-align: center;" class="month">Sept 2014</td>-->
				<?php } ?>
			</tr>
			<tr class="header">
				<td class="dayW"></td>
				<?php 
					$begin = new DateTime( $start_date );
					$stop = new DateTime( $end_date );
					$stop = $stop->modify( '+1 day' );
					
					$interval = DateInterval::createFromDateString('1 day');
					$period = new DatePeriod($begin, $interval, $stop);
					$nbjrs = 0;
					foreach($period as $dt) { ?>
						<td class="dayW"><?php echo substr($dt->format( 'D' ), 0, -1); 
					?></td>
				<?php 
					$nbjrs++;
					}
				
				?>
			</tr>
			<tr class="header">
				<td class="day"></td>
				<?php 
					$begin = new DateTime( $start_date );
					$stop = new DateTime( $end_date );
					$stop = $stop->modify( '+1 day' );
					$today = new DateTime("now");
					$aujourdhui = $today->format('Y-m-d');
					
					$interval = DateInterval::createFromDateString('1 day');
					$period = new DatePeriod($begin, $interval, $stop);
					
					foreach($period as $d) { 
					
					if($d->format( 'w' ) == '6' || $d->format( 'w' ) == '5')
						$class = 'WE';
					else	
						$class = 'day';
						
					if($d->format('Y-m-d') == $aujourdhui)
						$class .= ' today';
					?>
						<td class="<?php echo $class; ?>"><?php echo $d->format( 'd' ); ?></td>
		<?php 		}
				
				?>
			</tr>
		</thead>
		<tbody>
			<?php if(isset($post['case'])) { ?>
			<?php if(isset($post['case'][3])) { ?>
			<tr id="u8942" class="user_line">
				<td class="user grandecase" ref="8942">GRANDE CASE</td>
				<?php 
					$begin = new DateTime( $start_date );
					$stop = new DateTime( $end_date );
					$stop = $stop->modify( '+1 day' );
					$today = new DateTime("now");
					$aujourdhui = $today->format('Y-m-d');
					
					
					$interval = DateInterval::createFromDateString('1 day');
					$period = new DatePeriod($begin, $interval, $stop);
					
					foreach($period as $d) {
						$t = "";
						if($d->format( 'w' ) == '6' || $d->format( 'w' ) == '0')
							$class = 'class="WE ';
						else	
							$class = 'class="day';
							
						if($d->format('Y-m-d') == $aujourdhui) {
							$class .= ' today';
							$t = "today";
						}
						
						$class .= '"';
						
						$occupancy = $this->demande->check_case_jour(3, $d->format( 'Y-m-d' ));
						
						$statut = $occupancy[0];
						$lettre = substr($occupancy, -1);
						//$occupancy = substr($occupancy, 0, 1);
						if($statut == '2')
							$color = '#0080ff';
						elseif($statut == '1')
							$color = '#fff';
						elseif($statut == 'X') {
							$color = '#0080ff'; $lettre = '<div class="day am" style="background-color: #0080ff;"> </div><div class="day pm l" style="background-color: #0080ff; border-top : 1px solid #fff"> </div>';
						} else
							$color = 'rgb(255, 128, 0)';
						
						if($occupancy) {
							//substr($occupancy, 0, -1);
							$class = 'class="day l '.$t.'" style="background-color : '.$color.'; font-size: 12px; line-height: 19px; cursor: pointer;"';
							$occupancygc = substr($d->format( 'd F Y (D)' ) . $occupancy, 0, -1);
							?><td <?php echo $class; ?> onMouseOver="popupOutline('<?php echo $occupancygc; ?>');" onMouseOut="return nd();"><?php echo $lettre; ?></td><?php
						} else {
						?><td <?php echo $class; ?>></td>
							
			<?php 		} 
					}
				
				?><!--
				<td name="day" id="8942:1" class="day"></td>
				<td name="day" id="8942:2" class="WE"></td>
				<td name="day" id="8942:3" class="WE"></td>
				<td name="day" id="8942:4" class="day"></td>
				<td name="day" id="8942:5" class="day"></td>
			
				<td name="day" id="8942:41" class="day l" style="background-color: rgb(128, 128, 128);"></td>
				<td name="day" id="8942:42" class="day l" style="background-color: rgb(128, 128, 128);"></td>
				<td name="day" id="8942:43" class="day l" style="background-color: rgb(128, 128, 128);"></td>-->
			</tr>
			<?php } ?>
			<?php if(isset($post['case'][2])) { ?>
			<tr id="u14194" class="user_line">
				<td class="user casebleue" ref="14194">CASE BLEUE</td>
				<?php 
					$begin = new DateTime( $start_date );
					$stop = new DateTime( $end_date );
					$stop = $stop->modify( '+1 day' );
					$today = new DateTime("now");
					$aujourdhui = $today->format('Y-m-d');
					
					$interval = DateInterval::createFromDateString('1 day');
					$period = new DatePeriod($begin, $interval, $stop);
					
					foreach($period as $d) { 
							$t = "";
							if($d->format( 'w' ) == '6' || $d->format( 'w' ) == '0')
								$class = 'class="WE ';
							else	
								$class = 'class="day';
								
							if($d->format('Y-m-d') == $aujourdhui) {
								$class .= ' today';
								$t = "today";
							}
							
							$class .= '"';
							
							$occupancy = $this->demande->check_case_jour(2, $d->format( 'Y-m-d' ));
							
							$statut = $occupancy[0];
							$lettre = substr($occupancy, -1);
							//$occupancy = substr($occupancy, 0, 1);
							if($statut == '2')
								$color = '#0080ff';
							elseif($statut == '1')
								$color = '#fff';
							elseif($statut == 'X')
								$color = '#0080ff';
							else
								$color = 'rgb(255, 128, 0)';
							
							if($occupancy) {
								//substr($occupancy, 0, -1);
								$class = 'class="day l '.$t.'" style="background-color : '.$color.'; font-size: 12px; line-height: 19px; cursor: pointer;"';
								$occupancygc = substr($d->format( 'd F Y (D)' ) . $occupancy, 0, -1);
								?><td <?php echo $class; ?> onMouseOver="popupOutline('<?php echo $occupancygc; ?>');" onMouseOut="return nd();"><?php echo $lettre; ?></td><?php
							} else {
								?><td <?php echo $class; ?>></td>
									
					<?php 		} 
					}
				
				?><!--
				<td name="day" id="14194:1" class="day" style="background-color: rgb(255, 128, 0);"></td>
			
				<td name="day" id="14194:42" class="day"></td>
				<td name="day" id="14194:43" class="day"></td>-->
			</tr>
			<?php } ?>
			<?php if(isset($post['case'][1])) { ?>
			<tr id="u9001" class="user_line">
				<td class="user caseverte" ref="9001">CASE VERTE</td>
				<?php 
					$begin = new DateTime( $start_date );
					$stop = new DateTime( $end_date );
					$stop = $stop->modify( '+1 day' );
					$today = new DateTime("now");
					$aujourdhui = $today->format('Y-m-d');
					
					$interval = DateInterval::createFromDateString('1 day');
					$period = new DatePeriod($begin, $interval, $stop);
					
					foreach($period as $d) { 
						$t = "";
						if($d->format( 'w' ) == '6' || $d->format( 'w' ) == '0')
							$class = 'class="WE ';
						else	
							$class = 'class="day';
							
						if($d->format('Y-m-d') == $aujourdhui) {
							$class .= ' today';
							$t = "today";
						}
						
						$class .= '"';
						
						$occupancy = $this->demande->check_case_jour(1, $d->format( 'Y-m-d' ));
						
						$statut = $occupancy[0];
						$lettre = substr($occupancy, -1);
													
						//$occupancy = substr($occupancy, 0, 1);
						if($statut == '2')
							$color = '#0080ff';
						elseif($statut == '1')
							$color = '#fff';
						elseif($statut == 'X') {
							$color = '#0080ff'; $lettre = '<div class="day am" style="background-color: #0080ff;"> </div><div class="day pm l" style="background-color: #0080ff; border-top : 1px solid #fff"> </div>';
						} else
							$color = 'rgb(255, 128, 0)';
						
						if($occupancy) {
							//substr($occupancy, 0, -1);
							$class = 'class="day l '.$t.'" style="background-color : '.$color.'; font-size: 12px; line-height: 19px; cursor: pointer;"';
							$occupancygc = substr($d->format( 'd F Y (D)' ) . $occupancy, 0, -1);
							?><td <?php echo $class; ?> onMouseOver="popupOutline('<?php echo $occupancygc; ?>');" onMouseOut="return nd();"><?php echo $lettre; ?></td><?php
						} else {
						?><td <?php echo $class; ?>></td>
							
			<?php 		} 
					}
				
				?><!--
			
				<td name="day" id="9001:43" class="day l" style="background-color: rgb(128, 128, 128);"></td>-->
			</tr>
			<?php } ?>
			<?php if(isset($post['case'][4])) { ?>
			<tr id="u13072" class="user_line">
				<td class="user casejaune" ref="13072">CASE JAUNE</td>
				<?php 
					$begin = new DateTime( $start_date );
					$stop = new DateTime( $end_date );
					$stop = $stop->modify( '+1 day' );
					$today = new DateTime("now");
					$aujourdhui = $today->format('Y-m-d');
					
					$interval = DateInterval::createFromDateString('1 day');
					$period = new DatePeriod($begin, $interval, $stop);
					
					foreach($period as $d) { 
							$t = "";
							if($d->format( 'w' ) == '6' || $d->format( 'w' ) == '0')
								$class = 'class="WE ';
							else	
								$class = 'class="day';
								
							if($d->format('Y-m-d') == $aujourdhui) {
								$class .= ' today';
								$t = "today";
							}
							
							$class .= '"';
							
							$occupancy = $this->demande->check_case_jour(4, $d->format( 'Y-m-d' ));
							
							$statut = $occupancy[0];
							$lettre = substr($occupancy, -1);
								//$occupancy = substr($occupancy, 0, 1);
							if($statut == '2')
								$color = '#0080ff';
							elseif($statut == '1')
								$color = '#fff';
							elseif($statut == 'X') {
								$color = '#0080ff'; $lettre = '<div class="day am" style="background-color: #0080ff;"> </div><div class="day pm l" style="background-color: #0080ff; border-top : 1px solid #fff"> </div>';
							}
							else
								$color = 'rgb(255, 128, 0)';
							
							if($occupancy) {
								//substr($occupancy, 0, -1);
								$class = 'class="day l '.$t.'" style="background-color : '.$color.'; font-size: 12px; line-height: 19px; cursor: pointer;"';
								$occupancygc = '<font color=#fff>' . substr($d->format( 'd F Y (D)' ) . '</font>' . $occupancy, 0, -1);
								?><td <?php echo $class; ?> onMouseOver="popupOutline('<?php echo $occupancygc; ?>');" onMouseOut="return nd();"><?php echo $lettre; ?></td><?php
							} else {
							?><td <?php echo $class; ?>></td>
								
					<?php 	} 
					}
				} 
				?>
			
			</tr>
			
			<?php } else { ?>
			<b style="color:white">
				Aucune case selectionnée.
			</b>
			<?php } ?>
		</tbody>
	</table>

	<br />
	<br />
	
	
	
	
	<!--
	<a class="tpl_button_save" style="background-image: url(&quot;/module/image/shadowless/document-pdf.png&quot;);" href="../manage/download_pdf.php?status=0:2:3:4:1:5&amp;location_id=0&amp;userId[0]=14194&amp;userId[1410243785470]=8942&amp;userId[1409426743575]=13072&amp;userId[1409902810259]=9001&amp;begin=01/08/2014&amp;end=12/09/2014" target="_bank">Extract the planning in PDF file</a><a class="tpl_button_save" style="background-image: url(&quot;/module/image/shadowless/document-excel.png&quot;); margin: 0px 0px 0px 5px;" href="../export_excel.php?status=0:2:3:4:1:5&amp;location_id=0&amp;userId[0]=14194&amp;userId[1410243785470]=8942&amp;userId[1409426743575]=13072&amp;userId[1409902810259]=9001&amp;begin=01/08/2014&amp;end=12/09/2014" target="_bank">Extract the planning in CSV file</a>
	-->