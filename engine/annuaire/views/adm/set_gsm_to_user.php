<?php 

	
?>
<form class="form no_bottom resa" method="post"  action="<?php echo base_url('annuaire.php/annuaire/admin_cout_gsm'); ?>" name="frmCriteria" target="_parent" id="frmCriteria">
			<div class="title">
				Formulaire d'attribution d'un numero à un utilisateur<br /><!--<span class="last_update"></span>-->
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
								<th class="cell_title"><label for="usr">Numéro à attribuer</label></th>
								<td colspan="3"><input name="number_to_set" type="text" readonly=readonly id="number_to_set" value="<?php echo $this->input->get('gsm'); ?>" maxlength="60" class="form-control input_wide gsm_num text_"> <i>(Ne peut pas être changé)</i>
								</td>
							</tr>
							<?php if(!is_null($actual_user[0]->user)) { ?>
							<tr>
								<th class="cell_title">Utilisateur actuel</th>
								<td colspan="3"><input name="nom" type="text" readonly=readonly id="nom" value="<?php echo $actual_user[0]->user; ?>" maxlength="200" class="form-control input_wide gsm_num text_"></td>
							</tr>
							<?php } ?>
							<tr>
								<th class="cell_title">Nouvel Utilisateur</th>
								<td colspan="3">
									<select name="new_user" type="text" id="new_user" class="input_half_wide" style="float:left; line-height:20px;" >
										<?php foreach($users as $a) { ?>
					   
										<option value="<?php echo $a->id . '.' . $a->type; ?>"><?php echo $a->nom; ?></option>
										
										<?php } ?>
									</select>
								</td>
							</tr>
							<tr>
								<th class="cell_title">Motif d'attibution</th>
								<td colspan="3">
									<label class="radio-inline"><input type="radio" name="motif">Utilisation</label>
									<label class="radio-inline"><input type="radio" name="motif">Pret</label>
								</td>
							</tr>
							<tr class="form-group">
								<th class="cell_title"><label for="usr">Ticket ID</label></th>
								<td colspan="3"><input type="text" name='ticket' class="form-control text_ input_wide" id="ticket"></td>
							</tr>
							<tr class="form-group">
								<th class="cell_title"><label for="usr">Commentaire</label></th>
								<td colspan="3"><textarea style="width:80% !important" name="comment" id="comment" class="form-control" rows="1"></textarea></td>
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
							
							<input name="annuler_demande" type="button" id="annuler_demande" value="Annuler" class="tpl_button_cancel" onclick="history.go(-1);" />
														
							<input name="envoyer_demande" type="submit" onClick="checkInput();" id="envoyer_demande" style='background-color: #d6d6d6 !important;' value="Attribuer Numéro" class="tpl_button_save" /> 			
						</div>  
					</td>
				</tr>
			</tbody>
		</table>
	</form>
<script type="javascript">

</script>