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
	<div align="center" class="tpl_box_init_title">Liste des utilisateurs ayants droits</div>
	
	<div align="center" class="tpl_box_white"> 
	<br />
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
							<col width="2%">
							<col width="25%">
							<col width="33%">
							<col width="25%">
							<col width="15%">
							<!--<col width="70">
							<col width="100">
							<col width="120">
							<col width="70">
							<col width="80">-->
						</colgroup>
						<tbody>
							<tr class="tr_title">				
								<th align="left"></th>
								<th align="left">Noms et Prenoms</th>
								<th>Département</th>
								<th>Status</th>
								<th>Email</th>
								<!--<th>Statut</th>
								<th>Date d'arrivée</th>
								<th>Date de départ</th>
								<th>Temps restant</th>
								<th>Last report</th>-->
							</tr>
							<?php
								$i = 1;
							foreach ($users as $row) { 
								
							?>
							<tr align="center" style="" id="tr_site_20818" class="<?php if( $i & 1 ) echo "even"; else echo "odd"; ?> line_color_0 tr_survol ">
								<td align="left"><?php echo $i; ?> </td>
								<td align="left"><?php echo $row->nom; ?> </td>
								<td align="center"><?php echo $row->Department; ?></td>
								<td align="center"><?php echo $row->Status; ?></td>
								<td align="right"><?php echo $row->email; ?></td>
								
							</tr>
							
							<?php $i++; } ?>
							
						</tbody>
					</table>
				</fieldset>
			</form>
		</div>
	</div>
</div>