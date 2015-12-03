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
	<div align="center" class="tpl_box_init_title">Quota d'occupation sur la saison en cours</div>
	
	<div align="center" class="tpl_box_white"> 
	<br />
	<table cellspacing="0" cellpadding="0" class="tab_op_list_main" style="float: left;margin: 1%;width: 23%;">
		<tr class="tr_title">				
			<th align="center">Réservations non confirmées</th>
		</tr>
		<tr class="">				
			<td align="center" style="font-size:20px"><?php echo $resanc; ?></th>
		</tr>
	</table>
	<table cellspacing="0" cellpadding="0" class="tab_op_list_main" style="float: left;margin: 1%;width: 23%;">
		<tr class="tr_title">				
			<th align="center">Réservations confirmées</th>
		</tr>
		<tr class="">				
			<td align="center" style="font-size:20px"><?php echo $resac; ?></th>
		</tr>
	</table>
	<table cellspacing="0" cellpadding="0" class="tab_op_list_main" style="float: left;margin: 1%;width: 23%;">
		<tr class="tr_title">				
			<th align="center">Réservations en attente</th>
		</tr>
		<tr class="">				
			<td align="center" style="font-size:20px"><?php echo $resaat; ?></th>
		</tr>
	</table>
	<table cellspacing="0" cellpadding="0" class="tab_op_list_main" style="float: left;margin: 1%;width: 23%;">
		<tr class="tr_title">				
			<th align="center">Réservations annulées</th>
		</tr>
		<tr class="">				
			<td align="center" style="font-size:20px"><?php echo $resaan; ?></th>
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
					
					<table cellspacing="0" cellpadding="0" class="tab_op_list_main">
						<colgroup>
							<col width="25%">
							<col width="60%">
							<col width="15%">
							<!--<col width="70">
							<col width="100">
							<col width="120">
							<col width="70">
							<col width="80">-->
						</colgroup>
						<tbody>
							<tr class="tr_title">				
								<th align="left">Noms et Prenoms</th>
								<th>Réservations confirmées</th>
								<th></th>
								<!--<th>Statut</th>
								<th>Date d'arrivée</th>
								<th>Date de départ</th>
								<th>Temps restant</th>
								<th>Last report</th>-->
							</tr>
							<?php
								$i = 0;
							foreach ($quotas as $row) { 
								
							?>
							<tr align="center" style="" id="tr_site_20818" class="<?php if( $i & 1 ) echo "even"; else echo "odd"; ?> line_color_0 tr_survol ">
								<td align="left"><?php echo $row['First_Name'] . ' ' . $row['Last_Name']; ?> </td>
								<td align="center"><?php echo $row['unit']; ?></td>
								<td align="right"><?php echo $row['Professional E-mail']; ?></td>
								
							</tr>
							
							<?php $i++; } ?>
							
						</tbody>
					</table>
				</fieldset>
			</form>
		</div>
	</div>
</div>