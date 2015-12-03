
<div style="border:1px solid gray;" class="tpl_box_init_container">
	<div align="center" class="tpl_box_init_title">Logs des Réservations de la saison en cours</div>
	
	<div align="center" class="tpl_box_white"> 
		<div align="center" style="width:100% !important;" class="tpl_box_container_result" id="div_result_entity"> 
			<form action="" id="op_form" name="op_form" method="GET">
				<input type="hidden" value="date_last_report" id="order" name="order">
				<input type="hidden" value="ASC" id="sort" name="sort">
				<input type="hidden" value="0" id="page" name="page">
				<input type="hidden" value="main" id="todo" name="todo">
				<fieldset class="tpl_fieldset">
					
					<table cellspacing="0" cellpadding="0" class="tab_op_list_main">
						<colgroup>
							<col width="150">
							<col width="180">
							<col width="35">
							<col width="70">
							<col width="100">
							<col width="120">
							<col width="70">
							<col width="40">
						</colgroup>
						<tbody>
							<tr class="tr_title">				
								<th>Date et heure de réservation</th>
								<th>Réservé par</th>
								<th>Case</th>
								<th>Statut</th>
								<th>Date d'arrivée</th>
								<th>Date de départ</th>
								<th>Temps restant</th>
								<th>Action</th>
							</tr>
							<?php
								$i = 0;
							foreach ($logs as $row) { 
								switch($row->id_case) {
									case 1: $imgcase = "home_green.png"; break;
									case 2: $imgcase = "house-blue.png"; break;
									case 3: $imgcase = "home_food.png"; break;
									case 4: $imgcase = "home.png"; break;

								}
							?>
							<tr align="center" style="" id="tr<?php echo $row->id_demandes; ?>" class="<?php if( $i & 1 ) echo "even"; else echo "odd"; ?> line_color_0 tr_survol ">
								<td align="left"><?php echo ucfirst($row->date); ?> à <?php echo $row->heure; ?></td>
								<td align="left"><?php echo ($row->Last_Name) . " " . ($row->First_Name); ?></td>
								<td align="center"><img class="tips" title="<?php echo $row->nomcase; ?>" style="margin:0 0 -2px 5px; cursor:help" src="assets/base_loisirs/images/<?php echo $imgcase; ?>"></td>
								<td id="statut<?php echo $row->id_demandes; ?>"><?php if($row->statut == '0') echo "Annulée"; elseif($row->statut == '1') echo "En attente"; elseif($row->statut == '2') echo "Reservée"; else echo "Confirmée"; ?></td>
								<td><?php echo $row->date_arrivee; ?> à <?php echo $row->heure_arrivee; ?></td>
								<td><?php echo $row->date_depart; ?> à <?php echo $row->heure_depart; ?></td>
								<td><?php if($row->days >= 0) echo $row->days . " jours"; ?><?php if($row->days>=7) { ?><img class="tips" title="<?php echo $row->days-7; ?> jrs restants avant confirmation" style="margin:0 0 -2px 5px; float:right; cursor:help" src="assets/base_loisirs/images/ico-warning.gif"><?php } ?></td>
								<td align="left" style="padding:0 2px 0 2px">
									<?php if($row->statut == '1' || $row->statut == '2' ) { ?><a href="javascript:void(0)" id="<?php echo $row->id_demandes; ?>" class="confirm"><img class="tips" title="Confirmer la réservation" style="margin:0 0 -2px 5px; cursor:help; float:left" src="assets/base_loisirs/images/button_ok.gif"></a><?php } ?>
									<?php if($row->statut == '1' || $row->statut == '3' || $row->statut == '2' ) { ?><a href="javascript:void(0)" id="a<?php echo $row->id_demandes; ?>" class="cancel"><img class="tips" id="<?php echo $row->id_demandes; ?>" title="Annuler la réservation" style="margin:2px 0 2px 10px; cursor:help;  float:left" src="assets/base_loisirs/images/close.gif"></a><?php } ?>
								</td>
							</tr>
							<?php $i++; } ?>
							
						</tbody>
					</table>
				</fieldset>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
window.addEvent('domready', function()
{	
	var Confirm = new Request({
		url: 'base_loisirs.php/ajax/confirm_resa/',
		method: 'get',
		onProgress: function(event, xhr){
			var loaded = event.loaded, total = event.total;
	 
			console.log(parseInt(loaded / total * 100, 10));
		},
		onComplete: function(response){
			if(response == '0') {
					
			} else {
				$('statut'+response).set('text','Confirmée').highlight('#ddf');
				$(response).set('text','');
			} 
		}
	});
	
	var Annuler = new Request({
		url: 'base_loisirs.php/ajax/cancel_resa/',
		method: 'get',
		onProgress: function(event, xhr){
			var loaded = event.loaded, total = event.total;
	 
			console.log(parseInt(loaded / total * 100, 10));
		},
		onComplete: function(response){
			if(response == '0') {
					
			} else {
				$('statut'+response).set('text','Annulée').highlight('#ddf');
				$('a'+response).set('text','');
				$(response).set('text','');
			} 
		}
	});
	
	$$('.confirm').addEvent('click', function(e){
		e.stop();
		var id = this.id;
		var SM = new SimpleModal({"btn_ok":"Confirmer"});
        SM.show({
          "model":"confirm",
          "callback": function(){
			Confirm.send('id_resa='+id);
          },
          "title":"Confirmer cette réservation ?",
          "contents":"Le statut sera changé de réservée vers confirmé! Cette action est irréversible."
          
        });
		
	});
	
	$$('.cancel').addEvent('click', function(e){
		e.stop();
		var id = this.id;
		var SM = new SimpleModal({"btn_ok":"Confirmer"});
        SM.show({
          "model":"confirm",
          "callback": function(){
			Annuler.send('id_resa='+id);
          },
          "title":"Annuler cette réservation ?",
          "contents":"Le statut sera changé et la réservation annulée!"
          
        });
		
	});
});

</script>