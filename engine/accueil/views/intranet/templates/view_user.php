<div id="body_content">
	
	<style type="text/css">
		<!--	
			input.action_ 
			{
				background-color: transparent;
				color: black;
				cursor: pointer;
				padding: 0px;
				margin: 0px;
				width: 75px;
				text-align: right;
			}
			
			.action_  
			{ 
				line-height: 20px;
				
				display: inline-block;
				height: 20px;
				border: 0px;
				padding: 0px 5px 0 18px;
				text-decoration: none;
				font-weight: bold;
				color: #000;
				width: auto;
				text-decoration: underline;
			}
			
			.filtre
			{
				background: url(./assets/images/Loupe.png) no-repeat left center;
			}

			.excel
			{
				background: url(./assets/images/Excel.png) no-repeat left center;
			}
			
			input.excel
			{
				width:70px;
			}
			
			#div_spl
			{
				position:absolute;
				background-color:rgba(255, 255, 255, 0.9);
				border:2px solid gray;
				
			}
			
			#showf td
			{
				text-overflow:ellipsis;
				overflow:hidden;
				white-space:nowrap;
			}
		-->
	</style>
	<div id="tpl_info_top">
			
	</div>
		<input type="hidden" value="" name="methode" id="methode_action"/>
		<input type="hidden" value="" name="port" id="port_val"/>
		<input type="hidden" value="" name="portm" id="port_vmat"/>
		<input id='hidden_clt' name='clt' value="" type='hidden' />
		<input id='hidden_stat' name='stat' value="" type='hidden' />
		<input id='hidden_last' name='last' value="" type='hidden' />
		<input id="timeZoneOffset" value="1" type="hidden">
		<input id="pass_recup" value="" type="hidden">
		<input id='nom_module' value='<?php echo $module?>' type='hidden'>
		<input id='mod_data' value='' type='hidden'>
		<input id='imgurl' value="<?php echo img_url(''); ?>" type='hidden'>
		<input id='hidden_link' name='link' value='<?php echo $liens_possibles; ?>' type='hidden' />
		<input id='hidden_act' name='act' value='<?php echo $act; ?>' type='hidden' />
		<input id='selected_user' name='sel_user' value='' type='hidden' />
		
		<input id='num_rows' value='<?php echo $num_rows; ?>' type='hidden'/>
		<input id='limit' value='<?php echo $limit; ?>' type='hidden' />
		<input id='sort' value='<?php echo $sort; ?>' type='hidden' />
		<input id='order' value='<?php echo $order; ?>' type='hidden' />
		<input id='step' value='<?php echo $step; ?>' type='hidden' />
		
		<input id='id' value='<?php echo $id; ?>' type='hidden' />
		<input id='r_nm' value='' type='hidden' />
		<input id='r_dep' value='' type='hidden' />
		
	<?php if($act == "1") { ?>
	<div class="form" align="center">	
		<div class="title">
			<?php echo $legend; ?>
		</div>
		
		<div id="div_entity">
			<!--  -->
			
			<?php echo form_open($method, 'method="post" id="form_insert"'); ?>
				<input id="password" name="password" value="<?php echo $password; ?>" type="hidden"/>
				<table cellspacing="0" class="form" cellpadding="0" width="" style="display:inline-block;">
					<colgroup>
						<col width="60%"></col><col width="30%"></col>
					</colgroup>
					<tbody>
						<tr>
							<td align="center" style="vertical-align:top;">
								<fieldset align="left" style="border-radius: 5px 5px 5px 5px; padding: 0 0 10px 0; display:inline-block; border: 1px groove darkgray; margin:10px; width:95%">
									<legend>Infos Utilisateur</legend>
									<table id="tab_entity"  cellspacing="0" class="form" cellpadding="0" width="100%">
										<colgroup>
											<col width="30%"><col width="35%"><col width="35%">
										</colgroup>
										<tbody>
											<tr>
												<td class="label" align="right">Nom de l'utilisateur</td>
												<td><input class="input_type " style="width: 180px; margin-left:50px;" id="name_user" name="name_user" value="" type="text"></td>									
												
											</tr>	
										</tbody>
									</table>
									<div id='tab_chrg_info' align="center">
										<p style="font-weight:bold;">Tapez le nom et/ou prénom de celui/celle que vous souhaitez ajouter à l'application...</p>
									</div>									
								</fieldset>
							</td>
							<td rowspan="2" align="center" style="vertical-align:top;">
								<fieldset align="left" style="border-radius: 5px 5px 5px 5px; display:inline-block; border: 1px groove darkgray; margin:10px; width:95%">
									<legend>Privilèges</legend>
									<table id='tab_mod' cellspacing="0" class="form" cellpadding="0" width="100%">
										<colgroup>
											<col width="30%"><col width=""><col width="">
										</colgroup>
										<thead>
											<tr>
												<th rowspan="2" align="center">Modules</th><th align="center" colspan='2'>Autorisations</th>
											</tr>
											<tr>
												<th align="center">Modification</th><th align="center">Lecture</th>
											</tr>
										</thead>
										<tbody id="mod_body">
											<?php foreach($modules as $mod) {?>
												<tr>
													<td class="label" style="padding:5px;">
														<?php echo $mod['nom'] ?>
														<span style="float:right; z-index:20;"><img src="<?php echo img_url('options.png'); ?>" onclick="move(this);"></span>
														<input  type="hidden" name="" value="<?php echo $mod['id']; ?>"/>
														<input  type="hidden" name="" value=""/>
														<input  type="hidden" name="" value="<?php echo $mod['nom']; ?>"/>
														<input  type="hidden" name="" value="<?php echo $mod['lien']; ?>"/>
													</td>
													<td align="center"><input name="first" type="checkbox" onclick="first_(this);" disabled=true /></td>
													<td align="center"><input name="second" type="checkbox" onclick="second_(this);" disabled=true /></td>
												</tr>
											<?php } ?>
										</tbody>
										<div id='option_mod' style="display:none; padding:2px; position:absolute; width:50px; border-radius:0px 5px 5px 0px; background-color:#e9eeee">&nbsp;<img src="<?php echo img_url('auto/edit.gif') ?>" onclick="mod_mod();">&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo img_url('auto/supprimer_icone.png') ?>" onclick="sup_mod();"></div>
									</table>
								</fieldset>
							</td>
						</tr>
						<tr>
							<td align="center" style="vertical-align:top;">
								<fieldset align="left" style="border-radius: 5px 5px 5px 5px; display:inline-block; border: 1px groove darkgray; margin:10px; width:95%">
									<legend>Module</legend>
									<table class="form" id="Module">
										<tbody>
											<tr>
												<input  class="input_type " style="width: 180px;" type="<?php echo $records1[0]['hidden']; ?>" id="<?php echo $records1[0]['labelnom']; ?>" name="<?php echo $records1[0]['nom']; ?>" value=""/>
												<td align="right" class="label"><?php echo $records1[1]['labelnom'] ?></td><td><input  class="input_type " style="width: 180px;" type="text" id="<?php echo $records1[1]['labelnom']; ?>" name="<?php echo $records1[1]['nom']; ?>" value=""/></td>
												<td align="right" class="label"><?php echo $records1[2]['labelnom'] ?></td><td><input  class="input_type " style="width: 180px;" type="text" id="<?php echo $records1[2]['labelnom']; ?>" name="<?php echo $records1[2]['nom']; ?>" value=""/></td>
											</tr>
										</tbody>
										<tfoot>
											<tr>
												<td colspan='4' align="center">	
													<input style="margin:5px;" type="button" name='valider' class="tpl_button_insert" value="Ajouter"> 
													<input style="margin-left:5px; display:none;" type="button" name='annuler' class="button_action_ann" value="Annuler">
												</td>
											</tr>
										</tfoot>
									</table>
								</fieldset>
							</td>
						</tr>
					</tbody>
				</table>
			</form>
		</div>
	</div>
	
	<br><?php } ?>
	<div class="ticket">
		<div class="title">
			Liste Users
		</div>
		<br>
		<div class="caption_ticket">
			
			<div name="nb_record" class="navig_nb_record">
				<?php echo $num_rows.' '.mb_strtolower($module).'(s)'; ?>
			</div>
						
				<div id="page_1" class="navig_list_page" align="center">
					<?php echo $links; ?>
				</div>
			
			<div class="export_pdf">
				<input class="action_ filtre" value="Chercher" type="button" onclick="filtre(this);">
				<input class="action_pdf excel" value="Exporter" type="button" onclick="get_csv(this);">
			</div>
			<div class="clearer">
			</div>
		</div>
		<br>
		<table class="ticket_list" id="tck_list" border="0" cellpadding="0" cellspacing="0" width="100%">
			
			<thead id="resultstete">
				<tr>
					<?php foreach($fields as $field_name => $field_display): ?>
						<?php if (($field_display == "Code") || ($field_display == "Id Staff User") || ($field_display == "Id Responsable") || ($field_display == "Login") || ($field_display == "Password") || ($field_display == "Profil")) { ?>
							<th style="display:none">
								<input id="<?php echo $field_name ?>" name="<?php echo $field_name ?>" type="hidden" value="<?php echo (($sort == 'asc') ? 'desc' : 'asc') ?>"/>
								<a id="a_<?php echo $field_name ?>" href="#" onclick="sort_cmde($('#<?php echo $field_name ?>'), '<?php echo $field_name; ?>', $('#<?php echo $field_name ?>').val(), $('#sh_cmd')); return false;"> <?php echo $field_display; ?> </a>
							</th>
						<?php }else{ ?>
							<th>
								<input id="<?php echo $field_name ?>" name="<?php echo $field_name ?>" type="hidden" value="<?php echo (($sort == 'asc') ? 'desc' : 'asc') ?>"/>
								<a id="a_<?php echo $field_name ?>" href="#" onclick="sort_cmde($('#<?php echo $field_name ?>'), '<?php echo $field_name; ?>', $('#<?php echo $field_name ?>').val(), $('#sh_cmd')); return false;"> <?php echo $field_display; ?> </a>
							</th>
						<?php } ?>
					<?php endforeach; ?>
					<?php if($act == "1") { ?> <th name="act_butt" style="width:40px;"> Action</th> <?php } ?>
				</tr>
			</thead>
			<tbody id="showf">
				<?php if( count($results) != 0 ) { $i = 1; foreach ($results as $result){ ?>
				   <tr class="altcol" onclick = "modifier(this)">
						<?php foreach ($fields as $field_name => $field_display){ ?>
							<?php if (($field_display == "Code") || ($field_display == "Id Staff User") || ($field_display == "Id Responsable") || ($field_display == "Login") || ($field_display == "Password") || ($field_display == "Profil")){ ?>
								<td  style="display:none;"><?php echo $result[$field_name]; ?></td>
							<?php } else { ?>
								<td class="align_center"><?php echo $result[$field_name]; ?></td>
							<?php } ?>		
						<?php } ?>
						<?php if($act == "1") { ?>
					   <td align='center' name="act_butt" style="background-color:lightgray;">
							<img class="" title="Supprimer" src="<?php echo img_url('auto/supprimer_icone.png')?>" border="" name="<?php echo $result['id']; ?>" onclick="supprimer_form(<?php echo $result['id']; ?>); return false;" >   
					  </td>
					  <?php } ?>
					</tr>
				<?php $i++;} } else { ?>
					<tr class=""><td colspan="8"> Aucun élément enregistré... </td></tr>
				<?php } ?>
			</tbody>
		</table>
		<br>
		<div class="caption_ticket">
			<div class="clearer">
			</div>
		</div>
		<br>
	</div>
</div>
<script type="text/javascript" src="<?php //echo js_url('auto/formulaire_user') ?>"></script>
<script type="text/javascript" src="<?php //echo js_url('it_assets/formulaire') ?>"></script>
<script type="text/javascript">
	
</script>

<br>
</div></div></div>