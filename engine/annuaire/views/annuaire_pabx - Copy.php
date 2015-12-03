<script type="text/javascript">
/*
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
*/
</script>
<?php 
$departement = $this->input->get('departement') ? $this->input->get('departement') : '*';
?>
<div style="border:1px solid gray;" class="tpl_box_init_container">
	<div align="center" class="tpl_box_init_title">Annuaire des téléphones fixes</div>
	
	<div align="center" class="tpl_box_white"> 
	<br />
	<form name="critere" id="critere" method="get" action="" target="_self">
	
	Département 
	<select name="departement" id="departement" onChange="this.form.submit();">
		<option value="*" <?php if($departement == '*') echo 'selected="selected"'; ?>>Tous</option>
		<?php foreach($departments as $dep) { ?>
		<option value="<?php echo $dep->department; ?>" <?php if($departement == $dep->department) echo 'selected="selected"'; ?>><?php echo $dep->department; ?></option>
		<?php } ?>
	</select>
	<br />
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
								<th style="text-align:left; padding-left : 4px">Noms et prénoms</th>
								<th style="text-align:left; padding-left : 4px">Fixe</th>
								<th style="text-align:left; padding-left : 4px">Batïment</th>
								<th style="text-align:left; padding-left : 4px">Bureau</th>
								<!--<th>Last report</th>-->
							</tr>
							<?php
								$i = 0;
							if(count($users) == 0) { ?>
							
							<tr align="center" style="" id="tr_site_20818" class="<?php if( $i & 1 ) echo "even"; else echo "odd"; ?> line_color_0 tr_survol ">
								<td colspan="4" align="left">Aucune entrée trouvée.</td>
							</tr>

							<?php
							} else {
							
							foreach ($users as $row) { 	?>

								<tr align="center" style="" id="tr_site_20818" class="<?php if( $i & 1 ) echo "even"; else echo "odd"; ?> line_color_0 tr_survol ">
									<td align="left"><?php echo $row->last_name . ' ' . $row->first_name; ?></td>
									<td align="left"><?php echo utf8_decode($row->extension); ?></td>
									<td align="left"><?php echo utf8_decode($row->batiment); ?></td>
									<td align="left"><?php echo utf8_decode($row->bureau); ?></td>
								</tr>
							
							<?php 
							 $i++; 
							}

							}

							?>
							
						</tbody>
					</table>
				</fieldset>
			</form>
		</div>
	</div>
</div>