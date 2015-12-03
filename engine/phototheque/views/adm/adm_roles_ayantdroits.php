<style>
	table.tab_op_list_main tbody tr.checked td {
		background: #8080c0;
		color: #fff;
	}
</style>
<div style="border:1px solid gray;" class="tpl_box_init_container">
	<div align="center" class="tpl_box_init_title">Attribuer des roles aux ayants droits</div>
	
	<div align="center" class="tpl_box_white"> 
	<br />
	<form id="formid" target="_self" method="POST" name="">
		<input id="attribution_id" type="hidden" value="" name="attribution_id" style="display: none;">
		<table cellspacing="" cellpadding="" border="1" width="100%" class="">
			<tr>
				<td width="25%"></td>
				<td width="50%">
					<table class="" cellspacing="2" cellpadding="2" border="1" width="100%">
						<colgroup>
							<col width="50%">
							<col width="50%">
						</colgroup>	
						<tbody>
							<tr>
								<td align="right" valign="top" style="padding:5px">Gestionnaire Base Loisir</td>
								<td align="left" style="padding:5px">
									<select name="manager" id="manager" onChange="" class="input_type input_criteria">
										<?php foreach ($users as $row) { ?>
										<option value="<?php echo $row->user_id; ?>" <?php if($row->bl == '2') echo 'selected="selected"'; ?>><?php echo $row->nom; ?></option>
										<?php } ?>
									</select>
								</td>
							</tr>
							<tr>
								<td align="right" valign="top" style="padding:5px">Gestionnaire Ayant Droits</td>
								<td align="left" style="padding:5px">
									<select name="hr_manager" id="hr_manager" onChange="" class="input_type input_criteria">
										<?php foreach ($hrusers as $row) { ?>
										<option value="<?php echo $row->user_id; ?>" <?php if($row->bl == '3') echo 'selected="selected"'; ?>><?php echo $row->nom; ?></option>
										<?php } ?>
									</select>
								</td>
							</tr>
							<tr>
								<td align="right" valign="top" style="padding:5px"></td>
								<td align="left"><input onclick="document.getElementById('formid').submit();" type="button" id="sub" target="_self" value="Enregistrer les roles" class="tpl_button_update" /><td>
							</tr>
						</tbody>
					</table>
				</td>
				<td width="25%"></td>
			</tr>
		</table>
	</form>
	<?php if(isset($message)) { ?>
	<span style="color: blue;font-size: 12px;font-style: italic;"><?php echo $message; ?></span>
	<?php } ?>
	<br />	
	<div align="center" style="width:100% !important;" class="tpl_box_container_result" id="div_result_entity"> 
			
		</div>
	</div>
</div>
<script type="text/javascript">

</script>