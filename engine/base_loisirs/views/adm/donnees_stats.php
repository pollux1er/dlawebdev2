<?php 
$statut = $this->input->get('statut');
if(!$statut)
	$statut = '*';
$case = $this->input->get('idcase') ? $this->input->get('idcase') : '*';
?>
<div style="border:1px solid gray;" class="tpl_box_init_container">
	<div align="center" class="tpl_box_init_title">Statistiques de l'année <?php echo date('Y'); ?></div>
	
	<div align="center" class="tpl_box_white"> 
	<br />
	<table cellspacing="0" cellpadding="0" class="tab_op_list_main" style="float: left;margin: 1%;width: 2%;">
		<tr>				
			<td align="center" style="font-size:20px">
				
				<?php echo $population; ?>
			</td>
		</tr>
	</table>
	<table cellspacing="0" cellpadding="0" class="tab_op_list_main" style="float: left;margin: 1%;width: 2%;">
		<tr>				
			<td align="center" style="font-size:20px">
				
				<?php echo $occupation; ?>
			</td>
		</tr>
	</table>
	<table cellspacing="0" cellpadding="0" class="tab_op_list_main" style="float: left;margin: 1%;width: 4%;">
		<tr>				
			<td align="center" style="font-size:20px">
				
				<?php echo $occupation_case; ?>
			</td>
		</tr>
	</table>
	
	
	<!--
	Les 3
	
	-->	
	<div align="center" style="width:100% !important;" class="tpl_box_container_result" id="div_result_entity"> 
			<form action="" id="op_form" name="op_form" method="GET">
				<input type="hidden" value="date_last_report" id="order" name="order">
				<input type="hidden" value="ASC" id="sort" name="sort">
				<input type="hidden" value="0" id="page" name="page">
				<input type="hidden" value="main" id="todo" name="todo">
				<fieldset class="tpl_fieldset" style="clear:left">
					
					<table cellspacing="0" cellpadding="0" class="tab_op_list_main" style="width:30%;margin-right:2%;float:left">
						<colgroup>
							<col width="75%">
							<col width="25%">
						</colgroup>
						<tbody>
							<tr class="tr_title">				
								<th align="left">les 10 ayants-droits les plus actifs de l'annee</th>
								<th>Réservations</th>
							</tr>
							<?php
								$i = 0;
							foreach ($top_10_users as $row) { 
								
							?>
							<tr align="center" style="" id="tr_site_20818" class="<?php if( $i & 1 ) echo "even"; else echo "odd"; ?> line_color_0 tr_survol ">
								<td align="left"><?php echo $row->First_Name . ' ' . $row->Last_Name; ?> </td>
								<td align="center"><?php echo $row->nb_resa; ?></td>
								
							</tr>
							
							<?php $i++; } ?>
							
						</tbody>
					</table>

					<table cellspacing="0" cellpadding="0" class="tab_op_list_main" style="width:30%;margin-right:2%;float:left">
						<colgroup>
							<col width="75%">
							<col width="25%">
						</colgroup>
						<tbody>
							<tr class="tr_title">				
								<th align="left">les 10 ayants-droits les moins actifs de l'annee</th>
								<th>Réservations</th>
							</tr>
							<?php
								$i = 0;
							foreach ($top_10_less_users as $row) { 
								
							?>
							<tr align="center" style="" id="tr_site_20818" class="<?php if( $i & 1 ) echo "even"; else echo "odd"; ?> line_color_0 tr_survol ">
								<td align="left"><?php echo $row->First_Name . ' ' . $row->Last_Name; ?> </td>
								<td align="center"><?php echo $row->nb_resa; ?></td>
								
							</tr>
							
							<?php $i++; } ?>
							
						</tbody>
					</table>

					<table cellspacing="0" cellpadding="0" class="tab_op_list_main" style="width:30%;float:left">
						<colgroup>
							<col width="75%">
							<col width="25%">
						</colgroup>
						<tbody>
							<tr class="tr_title">				
								<th align="left">Noms et Prenoms</th>
								<th>Réservations</th>
							</tr>
							<?php
								$i = 0;
							foreach ($top_10_users as $row) { 
								
							?>
							<tr align="center" style="" id="tr_site_20818" class="<?php if( $i & 1 ) echo "even"; else echo "odd"; ?> line_color_0 tr_survol ">
								<td align="left"><?php echo $row->First_Name . ' ' . $row->Last_Name; ?> </td>
								<td align="center"><?php echo $row->nb_resa; ?></td>
								
							</tr>
							
							<?php $i++; } ?>
							
						</tbody>
					</table>
				</fieldset>
			</form>
		</div>
	</div>
</div>