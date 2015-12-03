<style>
	table.tab_op_list_main tbody tr.checked td {
		background: #8080c0;
		color: #fff;
	}
</style>
<div style="border:1px solid gray;" class="tpl_box_init_container">
	<div align="center" class="tpl_box_init_title">Gestion des utilisateurs ayants droits</div>
	
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
								<td align="right" valign="top" style="padding:5px">Utilisateurs</td>
								<td align="left" style="padding:5px">
									<input type="text" onkeyup="search_user(event, 'attribution_name', 'attribution_id', 'attributionCompletion');" id="attribution_name" name="attribution_name"  class="autocompletion input_wide" autocomplete="off" style="background-color : transparent; width:96%" />
									<div id="attributionCompletion" class="completion"></div>
								</td>
							</tr>
							<tr>
								<td align="right" valign="top" style="padding:5px"></td>
								<td align="left"><input onclick="document.getElementById('formid').submit();" type="button" id="sub" target="_self" value="Ajouter" class="tpl_button_add" /><td>
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
			<form action="" id="op_form" name="op_form" method="GET">
				<input type="hidden" value="date_last_report" id="order" name="order">
				<input type="hidden" value="ASC" id="sort" name="sort">
				<input type="hidden" value="0" id="page" name="page">
				<input type="hidden" value="main" id="todo" name="todo">
				<fieldset class="tpl_fieldset" style="clear:left">
					
					<table cellspacing="0" cellpadding="0" class="tab_op_list_main">
						<colgroup>
							<col width="2%">
							<col width="2%">
							<col width="35%">
							<col width="31%">
							<col width="25%">
							<col width="5%">
							<!--<col width="70">
							<col width="100">
							<col width="120">
							<col width="70">
							<col width="80">-->
						</colgroup>
						<thead>
							<tr class="tr_title">				
								<th align="center"></th>
								<th align="left"></th>
								<th align="left">Noms et Prenoms</th>
								<th>Département</th>
								<th>Status</th>
								<th></th>
								<!--<th>Statut</th>
								<th>Date d'arrivée</th>
								<th>Date de départ</th>
								<th>Temps restant</th>
								<th>Last report</th>-->
							</tr>
						</thead>
						<tbody>
							<?php
								$i = 1;
							foreach ($users as $row) { 
								
							?>
							<tr align="center" style="" id="tr_<?php echo $row->user_id; ?>" class="<?php if( $i & 1 ) echo "even"; else echo "odd"; ?> line_color_0 tr_survol ">
								<td align="center"><input type="checkbox" onclick="changetrbg('tr_<?php echo $row->user_id; ?>')" name="<?php echo $row->user_id; ?>" id="<?php echo $row->user_id; ?>" value="<?php echo $row->user_id; ?>"/></td>
								<td align="left"><?php echo $i; ?> </td>
								<td align="left"><?php echo $row->nom; ?> </td>
								<td align="left"><?php echo $row->Department; ?></td>
								<td align="left"><?php echo $row->Status; ?></td>
								<td align="right"><a href="javascript:void(0)" id="<?php echo $row->user_id; ?>" class="cancel"><img class="tips" id="<?php echo $row->user_id; ?>" nom="<?php echo $row->nom; ?> " title="Retirer <?php echo $row->nom; ?> des ayants droits" style="margin:2px 0 2px 10px; cursor:help;  float:left" src="assets/base_loisirs/images/close.gif"></a></td>
								
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
function changetrbg(id) {
	//alert("#"+id);
	$(id).toggleClass('checked');
}

window.addEvent('domready', function()
{	
	

    
	
	var Annuler = new Request({
		url: 'base_loisirs.php/ajax/user_remove_from_executive/',
		method: 'get',
		onProgress: function(event, xhr){
			var loaded = event.loaded, total = event.total;
	 
			console.log(parseInt(loaded / total * 100, 10));
		},
		onComplete: function(response){
			if(response == '0') {
					
			} else {
				//alert('tr_'+response);
				$('tr_'+response).highlight('#ddf');
				$('tr_'+response).hide(1000);
				//notif.slideOut();
				//$(response).set('text','');
			} 
		}
	});
	
	$$('.cancel').addEvent('click', function(e){
		e.stop();
		var id = this.id;
		//var title = this.title;
		
		var nom = this.getElementsByTagName("img")[0].getAttribute("nom"); 
		//document.getElementById("demo").innerHTML = x;
		//alert(x);
		var SM = new SimpleModal({"btn_ok":"Confirmer"});
        SM.show({
          "model":"confirm",
          "callback": function(){
			Annuler.send('user='+id);
          },
          "title":"Confirmez vous ?",
          "contents":"Une fois retiré de la liste, "+nom+" ne recevra plus les mails de notifications relatives à la base loisirs de Kribi!"
          
        });
		//var notif = new Fx.Slide('tr_'+id);
	});
});
</script>