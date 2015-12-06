<script type="text/javascript">
	
</script>

<div class="container" ng-app="sortApp" ng-controller="mainController" style="width:100%">
<div style="border:1px solid gray;" class="tpl_box_init_container">
	<div align="center" class="tpl_box_init_title">Annuaire des téléphones fixes</div>
	
	<div align="center" class="tpl_box_white"> 
	
	<!--[ <a id="label_hide_show_log" onclick="showme(this.id); return false;" href=""> </a> ] -->
		<div align="center" style="width:100% !important;" class="tpl_box_container_result" id="div_result_entity"> 				
			<div class="form-group">
				<div class="input-group">
					<?php if (isset($success_msg)) { echo $success_msg; } ?>
					<?php $attributes = array('class' => 'form-horizontal', 'id' => 'upload', 'role' => 'form', 'target' => '_self'); ?>
					<?php echo form_open_multipart('annuaire/load_csv_gsm',  $attributes); ?>
                    <label class="control-label">Select File</label>
                    <input type="file" name="filename" class="file" ><br><br>
                    <span class="text-danger"><?php if (isset($error)) { echo $error; } ?></span>
                    <input type="submit" name="submit" value="Charger le fichier" class="btn btn-primary">
	              	<?php echo form_close(); ?>
	            	<?php /*echo "<pre>"; var_dump($upload_data);*/ ?>
	            	<table border="1">
	               	<?php //var_dump($csv);
	               	if(isset($csv))
	            		foreach($csv as $k => $v) {
	               			//var_dump($v);
	               			$ligne = explode( ';', $v[0] );
	               			echo "<tr>";
	               			foreach($ligne as $l)
	               				echo "<td>" . utf8_decode($l) . "</td>"; 
	               			echo "</tr>";
	               		} 
	               	?>
	               	</table>
				</div>  
<table cellspacing="0" cellpadding="0" class="tab_op_list_main">
						<colgroup>
							<col width="150">
							<col width="180">
							<col width="55">
							<col width="70">
							<col width="100">
							<col width="120">
							<col width="70">
							<!--<col width="80">-->
						</colgroup>
						<tbody>
							<tr class="tr_title">				
								<th>Date et heure de réservation</th>
								<th>Réservé par</th>
								<th>Case</th>
								<th>Statut</th>
								<th>Date d'arrivée</th>
								<th>Date de départ</th>
								<th>Temps restant</th>
								<!--<th>Last report</th>-->
							</tr>
							<tr align="center" style="" id="tr_site_20818" class="<?php if( $i & 1 ) echo "even"; else echo "odd"; ?> line_color_0 tr_survol ">
								<td align="left"><?php echo ucfirst($row->date); ?> à <?php echo $row->heure; ?></td>
								<td align="left"><?php echo ($row->Last_Name) . " " . ($row->First_Name); ?></td>
								<td align="center" style="background-color : <?php echo $color; ?>"><?php echo $t; ?><!--<img class="tips" title="<?php echo $row->nomcase; ?>" style="margin:0 0 -2px 5px; cursor:help" src="assets/images/<?php echo $imgcase; ?>">--></td>
								<td><?php if($row->statut == '0') echo "Annulé"; elseif($row->statut == '1') echo "En attente"; elseif($row->statut == '2') echo "Reservée"; else echo "Confirmée"; ?></td>
								<td><?php echo $row->date_arrivee; ?> à <?php echo $row->heure_arrivee; ?></td>
								<td><?php echo $row->date_depart; ?> à <?php echo $row->heure_depart; ?></td>
								<td><?php if($row->statut != '0') { if($row->days >= 0) echo $row->days . " jours"; if($row->days >= 5) { ?><img class="tips" title="<?php echo ($row->days-5); ?> jrs restants avant confirmation" style="margin:0 0 -2px 5px; float:right; cursor:help" src="assets/base_loisirs/images/ico-warning.gif"><?php } } ?></td>
								<!-- <td align="left" style="padding:0 0 0 10px"><?php echo $i; ?></td> -->
							</tr>
							<?php if(count($row->logs) > 0) { ?>
							<tr class="detail">
								<td colspan="7">
									<table cellspacing="0" cellpadding="0" class="tab_op_list_main">
										<colgroup>
											<col width="25%">
											<col width="50%">
											<col width="25%">
										</colgroup>
										<thead>
											<tr>
												<th>Date et heure</th>
												<th>Description</th>
												<th>Effectuée par</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td></td>
												<td></td>
												<td></td>
											</tr>
										</tbody>
									</table>
								</td>					
						</tbody>
					</table>				
			</div>
		</div>
	</div>
</div>
</div>