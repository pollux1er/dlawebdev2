<form class="form no_bottom resa" method="post"  action="<?php echo base_url('annuaire.php/annuaire/admin_cout_gsm'); ?>" name="frmCriteria" target="_parent" id="frmCriteria">
			<div class="title">
				Formulaire d'ajout d'une nouvelle SIM<br /><!--<span class="last_update"></span>-->
			</div>
		
		<div id="section_headline">
		<script type="text/javascript">
		</script>

			<table class="ticket_header">
				<tbody><tr>
				<td class="ticket_header_td">
					<table class="ticket_header_sub new_gsm">
						<tbody>
							<tr>
								<th class="cell_title"></th>
								<td width="12%"></td>
								<td width="3%"></td>
								<td width="8%" class="cell_title"></td>
								<td width="12%"></td>
								<td width="2%"></td>
							</tr>
							<tr class="form-group">
								<th class="cell_title"><label for="usr">Numero de GSM</label></th>
								<td colspan="3"><input name="gsm" type="text" id="gsm" value="" maxlength="10" class="form-control input_wide gsm_num text_">
								</td>
							</tr>
							
							<tr>
								<th class="cell_title">Formule</th>
								<td colspan="3">
									<select name="formula" type="text" id="formula" class="input_half_wide" style="float:left; line-height:20px;" >
										<option value="Postaid">Postpaid</option>
										<option value="Prepaid">Prepaid</option>
										<option value="GFA">GFA</option>
									</select>
								</td>
							</tr>
							<tr>
								<th class="cell_title">Forfait</th>
								<td colspan="3">
									<select name="forfait" type="text" id="forfait" class="input_half_wide" style="float:left; line-height:20px;" >
										<option value="7000">7 000</option>
										<option value="10000">10 000</option>
										<option value="11000">11 000</option>
										<option value="14000">14 000</option>
										<option value="15000">15 000</option>
										<option value="20000">20 000</option>
										<option value="21000">21 000</option>
										<option value="25000">25 000</option>
										<option value="30000">30 000</option>
										<option value="32000">32 000</option>
										<option value="40000">40 000</option>
										<option value="50000">50 000</option>
										<option value="60000">60 000</option>
										<option value="70000">70 000</option>
										<option value="80000">80 000</option>
										<option value="100000">100 000</option>
									</select>
								</td>
							</tr>
							<tr>
								<th class="cell_title">Provider</th>
								<td colspan="3">
									<select name="provider" type="text" id="provider" class="input_half_wide" style="float:left; line-height:20px;" >
										<option value="Orange">Orange</option>
										<option value="MTN">MTN</option>
										<option value="CAMTEL">CAMTEL</option>
										<option value="NEXTTEL">NEXTTEL</option>
									</select>
								</td>
							</tr>
							<tr>
								<th class="cell_title">Roaming</th>
								<td colspan="3">
									<label class="radio-inline"><input type="radio" name="roaming">Oui</label>
									<label class="radio-inline"><input type="radio" name="roaming">Non</label>
								</td>
							</tr>
							<tr>
								<th class="cell_title">International</th>
								<td colspan="3">
									<label class="radio-inline"><input type="radio" name="inter">Oui</label>
									<label class="radio-inline"><input type="radio" name="inter">Non</label>
								</td>
							</tr>
							<tr class="form-group">
								<th class="cell_title"><label for="usr">Code PUK</label></th>
								<td colspan="3"><input type="text" name='puk' class="form-control text_ input_wide" id="puk"></td>
							</tr>
							<tr class="form-group">
								<th class="cell_title"><label for="usr">SN</label></th>
								<td colspan="3"><input type="text" name="sn" class="form-control text_ input_wide" style="width:80% !important" id="sn"></td>
							</tr>						
						</tbody>
					</table>
				</td>
				<td class="ticket_header_td">
				</td>
				</tr>
				</tbody>
				</table>	
		</div>
		<table class="form_table">
			<tbody>
				<tr>
					<td align="right" colspan="2" class="ithd_wrapper_button">
						<div id="save_global">
							<span id="notification" style="float: left; line-height: 26px; font-size:12px"> Veuillez remplir les détails de la nouvelle entrée! </span>
							
							<input name="annuler_demande" type="button" id="annuler_demande" value="Annuler" class="tpl_button_cancel" />
														
							<input name="envoyer_demande" type="submit" onClick="checkInput();" id="envoyer_demande" style='background-color: #d6d6d6 !important;' value="Ajouter numéro" class="tpl_button_save" /> 			
						</div>  
					</td>
				</tr>
			</tbody>
		</table>
	</form>
<script type="javascript">

function checkInput() {
	alert($('#gsm').val()); return false;
	if($('#gsm') == '') {
		alert("Vous n'avez renseigné aucun numero de GSM!");
		return false;
	}
}
</script>