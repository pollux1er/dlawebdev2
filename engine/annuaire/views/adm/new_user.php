<form class="form no_bottom resa" method="post"  action="<?php echo base_url('annuaire.php/annuaire/admin_tiers'); ?>" name="frmCriteria" target="_parent" id="frmCriteria">
			<div class="title">
				Formulaire d'ajout d'un nouvel utilisateur<br /><!--<span class="last_update"></span>-->
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
								<th class="cell_title"><label for="usr">Nom complet</label></th>
								<td colspan="3"><input name="user" type="text" id="user" value="" maxlength="60" class="form-control input_wide gsm_num text_"> <i>(Ou nom générique)</i>
								</td>
							</tr>
							
							<tr>
								<th class="cell_title">Personne Accountable</th>
								<td colspan="3">
									<select name="accountable" type="text" id="accountable" class="input_half_wide" style="float:left; line-height:20px;" >
										<option value="" select>Aucune</option>
										<?php foreach($users as $a) { ?>				   
										
										<option value="<?php echo $a->id; ?>"><?php echo $a->last_name . ' ' . $a->first_name; ?></option>
										
										<?php } ?>
									</select>
								</td>
							</tr>
							<tr class="form-group">
								<th class="cell_title"><label for="usr">Ticket ID</label></th>
								<td colspan="3"><input type="text" name='ticket' class="form-control text_ input_wide" id="ticket"></td>
							</tr>
							<tr class="form-group">
								<th class="cell_title"><label for="usr">Commentaire</label></th>
								<td colspan="3"><textarea style="width:80% !important" name="comment" id="comment" class="form-control" rows="3"></textarea></td>
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
														
							<input name="envoyer_demande" type="submit" onClick="checkInput();" id="envoyer_demande" style='background-color: #d6d6d6 !important;' value="Ajouter Personne" class="tpl_button_save" /> 			
						</div>  
					</td>
				</tr>
			</tbody>
		</table>
	</form>
<script type="javascript">

</script>