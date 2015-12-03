<form class="form no_bottom resa" method="post"  action="<?php echo base_url('annuaire.php/annuaire/admin_cout_pabx'); ?>" name="frmCriteria" target="_parent" id="frmCriteria">
			<div class="title">
				Formulaire d'attribution de PABX<br /><!--<span class="last_update"></span>-->
			</div>
		
		<div id="section_headline">
		<script type="text/javascript">
		</script>

			<table class="ticket_header">
				<tbody><tr>
				<td class="ticket_header_td">
					<table class="ticket_header_sub">
						<tbody>
							<tr>
								<th class="cell_title"></th>
								<td width="12%"></td>
								<td width="3%"></td>
								<td width="8%" class="cell_title"></td>
								<td width="12%"></td>
								<td width="2%"></td>
							</tr>
							<tr >
								<th class="cell_title">Nom de l'utilisateur</th>
								<td colspan="3" >
									<select name="iduser" type="text" id="iduser" class="input_half_wide" style="float:left; line-height:20px;" >
										<option value="">Selectionner utilisateur</option>
										<?php foreach($users as $a) { ?>
					   
										<option value="<?php echo $a->id; ?>"><?php echo $a->last_name . ' ' . $a->first_name; ?></option>
										
										<?php } ?>
									</select>
								</td>
							</tr>
							<tr>
								<th class="cell_title">Numero de PABX</th>
								<td colspan="3"><input name="pabx" type="text" id="pabx" value="" maxlength="150" class="input_wide">
								</td>
							</tr>
							<tr>
								<th class="cell_title">
									<input name="chk_invites" type="checkbox" id="chk_invites" value="1" style="cursor: default;">
								</th>
								<td colspan="4">
									<span class="cl fl">Ajouter un back to back</span>
									
									
									<div class="fl cl">
										<textarea placeholder="Pr&eacute;cisez quelques d&eacute;tails sur vos invit&eacute;s" class="msg_to_cos msg_info_old" rows="4" cols="50" style="display:none;background-image:none;" id="invite_cmt" name="invite_cmt"><?php  ?></textarea>
									</div>
								</td>
							</tr>
					
							<tr>
								<th class="cell_title">Nom back to back</th>
								<td colspan="3"><input name="backtoback" type="text" id="montant" value="<?php ?>"  maxlength="100" class="input_wide"></td>
							</tr>
						
				</tbody></table></td>
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
														
							<input name="envoyer_demande" type="submit" onClick="checkInput();" id="envoyer_demande" style='background-color: #d6d6d6 !important;' value="Attribuer numéro" class="tpl_button_save" /> 			
						</div>  
					</td>
				</tr>
			</tbody>
		</table>
	</form>
<script type="javascript">
function DefaultCtrl($scope) {
    $scope.names = ["Assontia", "Jongo", "charlie", "robert", "alban", "oscar", "marie", "celine", "brad", "drew", "rebecca", "michel", "francis", "jean", "paul", "pierre", "nicolas", "alfred", "gerard", "louis", "albert", "edouard", "benoit", "guillaume", "nicolas", "joseph"];
}

angular.module('MyModule', []).directive('autoComplete', function($timeout) {
    return function(scope, iElement, iAttrs) {
            iElement.autocomplete({
                source: scope[iAttrs.uiItems],
                select: function() {
                    $timeout(function() {
                      iElement.trigger('input');
                    }, 0);
                }
            });
    };
});

function checkInput() {
	alert($('#pabx').val()); return false;
	if($('#pabx') == '') {
		alert("Vous n'avez renseigné aucun numero de PABX!");
		return false;
	}
}
</script>