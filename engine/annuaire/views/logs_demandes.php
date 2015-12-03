<script type="text/javascript">
window.addEvent('domready', function()
{
	//$('label_hide_show_log').set('html', 'Merde');
	
	// $('label_hide_show_log').addEvent('click', function(event){
		// event.stop();
		// $$( 'tr.detail' ).toggle();
		// var divid = document.getElementById('label_hide_show_log');
		// alert(divid);
		// if (divid == 'http://dlad212/base_loisir/') {
			// divid.innerHTML = "Hide Widget";
			// $('label_hide_show_log').value = 'montrer';
        // } else {
			// $('label_hide_show_log').value = 'http://dlad212/base_loisir/';
			// divid.innerHTML = "Show Widget";
		// }
	// });
	$$( 'tr.detail' ).toggle();
});
function showme(linkid) {
	//var divid = document.getElementByClass(id);
	var toggler = document.getElementById(linkid);
	var toggleLink = document.getElementById(linkid).innerHTML;
	//alert(toggleLink);
	if (toggleLink == 'Montrer logs des historiques') {
		toggler.innerHTML = 'Cacher logs des historiques';
		
		$$( 'tr.detail' ).toggle();
	}
	else {
		toggler.innerHTML = 'Montrer logs des historiques';
		$$( 'tr.detail' ).toggle();
	}
}

</script>
<?php 
$statut = $this->input->get('statut');
if(!$statut)
	$statut = '*';
$case = $this->input->get('idcase') ? $this->input->get('idcase') : '*';
?>
<div style="border:1px solid gray;" class="tpl_box_init_container">
	<div align="center" class="tpl_box_init_title">Annuaire des téléphones fixes</div>
	
	<div align="center" class="tpl_box_white"> 
	<br />
	<form name="critere" id="critere" method="get" action="" target="_self">
	Site
	<select name="statut" id="statut" onChange="this.form.submit();">
		<option value="*" <?php if($statut == '*') echo 'selected="selected"'; ?>>Tous</option>
	</select>
	Département 
	<select name="idcase" id="idcase" onChange="this.form.submit();">
		<option value="*" <?php if($case == '*') echo 'selected="selected"'; ?>>Tous</option>
	</select><br />
	</form>
	<!--[ <a id="label_hide_show_log" onclick="showme(this.id); return false;" href=""> </a> ] -->
		<div align="center" style="width:100% !important;" class="tpl_box_container_result" id="div_result_entity"> 
			<form action="" id="op_form" name="op_form" method="GET">
				<input type="hidden" value="date_last_report" id="order" name="order">
				<input type="hidden" value="ASC" id="sort" name="sort">
				<input type="hidden" value="0" id="page" name="page">
				<input type="hidden" value="main" id="todo" name="todo">
				<fieldset class="tpl_fieldset">
					
					<table cellspacing="0" cellpadding="0" class="tab_op_list_main">
						<colgroup>
							<col width="25%">
							<col width="25%">
							<col width="25%">
							<col width="25%">
							<!--<col width="80">-->
						</colgroup>
						<tbody>
							<tr class="tr_title">				
								<th>Noms et prénoms</th>
								<th>Fixe</th>
								<th>Fonction</th>
								<th>Département</th>
								<!--<th>Last report</th>-->
							</tr>
							<?php
								$i = 0;
							foreach ($logs as $row) { 
								switch($row->id_case) {
									case 1: $imgcase = "home_green.png"; $color = 'rgb(0, 178, 0)'; $t = 'Case Verte'; break;
									case 2: $imgcase = "house-blue.png"; $color = 'rgb(0, 128, 255)'; $t = 'Case Bleue'; break;
									case 3: $imgcase = "home_food.png"; $color = 'rgb(255, 128, 128)'; $t = 'Grande Case'; break;
									case 4: $imgcase = "home.png"; $color = 'rgb(255, 208, 0)'; $t = 'Case Jaune'; break;

								}
							?>
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
										<?php foreach($row->logs as $ro) { ?>
											<tr>
												<td><?php echo $ro->date; ?></td>
												<td><?php echo $ro->description; ?></td>
												<td><?php echo $ro->name; ?></td>
											</tr>
										<?php } ?>
										</tbody>
									</table>
								</td>
								
							</tr>
							<?php } ?>
							<?php $i++; } ?>
							
						</tbody>
					</table>
				</fieldset>
			</form>
		</div>
	</div>
</div>