<script type="text/javascript">

</script>
<?php 
$departement = $this->input->get('departement') ? $this->input->get('departement') : '*';
$formule = $this->input->get('formule') ? $this->input->get('formule') : '*';
$status = $this->input->get('status') ? $this->input->get('status') : '*';

//echo "<pre>"; var_dump($users); die;
?>

<div class="container" ng-app="sortApp" ng-controller="mainController" style="width:100%">
<div style="border:1px solid gray;" class="tpl_box_init_container">
	<div align="center" class="tpl_box_init_title">Annuaire des téléphones fixes</div>
	
	<div align="center" class="tpl_box_white"> 
	
	<div class="alert alert-info" style="background-color: #51647d;margin: 1%;text-align: left;width: 98%; margin-bottom:0;">
	    <p>Type de tri : {{ sortType }}</p>
	    <!--<p>Sort Reverse: {{ sortReverse }}</p>-->
	    <p>Recherche : {{ Noms }}</p>
  	</div>
	
	<!--[ <a id="label_hide_show_log" onclick="showme(this.id); return false;" href=""> </a> ] -->
		<div align="center" style="width:100% !important;" class="tpl_box_container_result" id="div_result_entity"> 				
					<form style="margin : 0 1%;" action="" target="_self">
					<div class="form-group">
						<div class="input-group">
						<div class="input-group-addon"><i class="fa fa-search"></i></div>
							<input type="text" class="form-control" placeholder="Rechercher" ng-model="Noms"  style="width : 30%" id="recherche" name="recherche" autofocus />
							<select name="departement" id="departement" onChange="this.form.submit();" class="form-control" style="margin-left: 1%;width: 16%;">
								<option value="*" <?php if($departement == '*') echo 'selected="selected"'; ?>>Tous les départements</option>
								<?php foreach($departments as $dep) { ?>
								<option value="<?php echo $dep->department; ?>" <?php if($departement == $dep->department) echo 'selected="selected"'; ?>><?php echo $dep->department; ?></option>
								<?php } ?>
							</select>
							<select name="formule" id="formule" onChange="this.form.submit();" class="form-control" style="margin-left: 1%;width: 14%;">
								<option value="*" <?php if($formule == '*') echo 'selected="selected"'; ?>>Toutes les formules</option>
								<?php foreach($formules as $dep) { ?>
								<option value="<?php echo $dep->formula; ?>" <?php if($formule == $dep->formula) echo 'selected="selected"'; ?>><?php echo $dep->formula; ?></option>
								<?php } ?>
							</select>
							<select name="status" id="status" onChange="this.form.submit();" class="form-control" style="margin-left: 1%;width: 12%;">
								<option value="*" <?php if($status == '*') echo 'selected="selected"'; ?>>Tous les status</option>
								<?php foreach($statuses as $dep) { ?>
								<option value="<?php echo $dep->status; ?>" <?php if($status == $dep->status) echo 'selected="selected"'; ?>><?php echo $dep->status; ?></option>
								<?php } ?>
							</select>
							<span style="font-size: x-large;margin: 0;background-color: #5a4080; border: 1px solid #ccc; color: white; float: right; font-size: x-large; height: 46px; margin: 0; padding: 1%;">{{ (Annuaire | filter:Noms).length }} </span>
							<a href="<?php echo base_url('annuaire.php/annuaire/load_csv_gsm'); ?>" title="Charger le fichier des consomations" target="_self">
								<img style="margin: 0;float: right; height: 46px; margin-right: 1%;; padding: 0%;" src="assets/annuaire/images/excel_2013.png" alt="submit" />
							</a>
							<a href="<?php echo base_url('annuaire.php/annuaire/add_new_gsm'); ?>" title="Ajouter une nouvelle entrée PABX" target="_self">
								<img style="margin: 0;float: right; height: 46px; margin-right: 1%;; padding: 0%;" src="assets/annuaire/images/phone_add.png" alt="Ajouter une nouvelle entrée GSM" title="Ajouter une nouvelle entrée GSM" />
							</a>
						</div>      
						</div>
					</form>

					<table cellspacing="0" cellpadding="0" class="tab_op_list_main table table-bordered table-striped" style="width : 98%">
						<thead>
							<tr align="left">
								<td>
									<a href="" ng-click="sortType = 'Noms'; sortReverse = !sortReverse" >
								        Noms & prenoms
								        <span ng-show="sortType == 'Noms' && !sortReverse" class="fa fa-caret-down"></span>
								        <span ng-show="sortType == 'Noms' && sortReverse" class="fa fa-caret-up"></span>
								    </a>
								</td>
								<td style="width : 6%; text-align: center">GSM</td>
								<td style="width : 5%; text-align: center">Formule</td>
								<td style="width : 6%; text-align: center">Forfait</td>
								<td style="width : 5%; text-align: center">Provider</td>
								<td style="width : 6%; text-align: center">Roaming</td>
								<td style="width : 8%; text-align: center">International</td>
								<td style="width : 7%; text-align: center">Puk Code</td>
								<td style="width : 14%; text-align: center">S/N</td>
								<td style="width : 7%; text-align: center">Status</td>
								<td style="width : 12%; text-align: right"></td>
							</tr>
						</thead>
						<tfoot>
							<tr align="left" style="background-color: #51647d;color: white;">
								<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td style="font-size: 14px;font-weight: bold;"></td>
							</tr>
						</tfoot>
						<tbody>
							 <tr id="{{ item.GSM }}" align="left" ng-repeat="item in Annuaire | filter:Noms ">
						        <td>{{ item.Noms }}</td>
						        <td>{{ item.GSM }}</td>
						        <td>{{ item.Formule }}</td>
						        <td style="text-align: center">
									<span editable-text="item.Forfait" e-name="Forfait" e-form="rowform" onbeforesave="checkName($data, item.GSM)">
										{{ item.Forfait }}
									</span>
								</td>
						        <td>{{ item.Provider }}</td>
						        <td style="text-align: center">{{ item.Roaming }}</td>
						        <td style="text-align: center">{{ item.International }}</td>
						        <td style="text-align: center">
									<span editable-text="item.Puk" e-name="Puk" e-form="rowform" onbeforesave="checkName($data, item.GSM)">
										{{ item.Puk || '' }}
									</span>
								</td>
						        <td style="text-align: center">
									<span editable-text="item.Serial" e-name="Serial" e-form="rowform" onbeforesave="checkName($data, item.GSM)">
										{{ item.Serial }}
									</span>
								</td>
						        <td style="text-align: center">{{ item.Status }}</td>
						        <td style="text-align: right; white-space: nowrap; padding: 4px;">
						        	<form editable-form name="rowform" onaftersave="saveUser($data, item.GSM)" ng-show="rowform.$visible" class="form-buttons form-inline" shown="inserted == item">
										<button type="submit" ng-disabled="rowform.$waiting" class="btn btn-primary" style="padding: 0 4px;">
											<img src="assets/annuaire/images/save.png" width="32" height="32" alt="submit" />
										</button>
										<button type="button" ng-disabled="rowform.$waiting" ng-click="rowform.$cancel()" style="padding: 0 4px;" class="btn btn-default">
											<img src="assets/annuaire/images/back.png" width="44" height="32" alt="submit" />
										</button>
									</form>
									<div class="buttons" ng-show="!rowform.$visible">
										<a href="<?php echo base_url('annuaire.php/annuaire/set_gsm_to_user'); ?>?gsm={{ item.GSM }}" target="_self">
											<img height="31px" width="31px" title="Changer l'utilisateur du {{item.GSM }}" src="assets/annuaire/images/user109.png" class="phone2" alt="submit" />
										</a>
										<!--
										<a href="<?php echo base_url('annuaire.php/annuaire/change_gsm_user'); ?>?gsm={{ item.GSM }}" target="_self">
											<img title="Mettre à jour l'utilisateur du {{item.GSM }}" src="assets/annuaire/images/phone_refresh.png" class="phone" alt="submit" />
										</a>-->
										<button class="btn btn-primary" ng-click="spareGsm($index, item.GSM)" style="padding: 0px;">
											<img src="assets/annuaire/images/phone_lock.png" class="phone" alt="submit" />
										</button>
										<button class="btn btn-primary" ng-click="rowform.$show()" style="padding: 0px;">
											<img src="assets/annuaire/images/phone_pencil.png" class="phone" alt="submit" />
										</button>
										<button class="btn btn-danger" ng-click="removeUser($index, item.Id, item.GSM)" style="padding: 0px;">
											<img src="assets/annuaire/images/phone_close.png" class="phone" alt="submit" />
										</button>
									</div>
						        </td>
						      </tr>
						</tbody>
					</table>
				
		</div>
	</div>
</div>
</div>
<script type="text/javascript">

var app = angular.module("sortApp", ["xeditable"]);

app.run(function(editableOptions) {
  editableOptions.theme = 'bs3';
});

app.controller('mainController', function($scope, $filter, $http) {
  $scope.sortType     = 'Noms'; // set the default sort type
  $scope.sortReverse  = false;  // set the default sort order
  $scope.Noms   = '';     // set the default search/filter term
  
  // create the list of sushi items 
  $scope.Annuaire = [
   
<?php
	if(count($users) == 0) { 
	} else {
	foreach ($users as $row) { 	
		if($row->status == 'in_use') $row->status = 'Utilisé';
		if($row->status == 'spare') $row->status = 'En spare';
		if($row->status == 'terminated') $row->status = 'Résilié';
		?>
		{ Id: <?php echo "'" . $row->id . "'"; ?>, 
		    Noms: <?php echo "'" . $row->nom . "'"; ?>, 
			GSM: <?php echo "'" . utf8_decode($row->number) . "'"; ?>, 
			Formule: <?php echo "'" . utf8_decode($row->formula) . "'"; ?>, 
			Forfait: <?php echo "'" . utf8_decode($row->quota) . "'"; ?> ,
			Provider: <?php echo "'" . utf8_decode($row->provider) . "'"; ?> ,
			Status: <?php echo "'" . $row->status . "'"; ?> ,
			Puk: <?php echo "'" . utf8_decode($row->puk_code) . "'"; ?> ,
			International: <?php echo "'" . utf8_decode($row->international) . "'"; ?> ,
			Serial: <?php echo "'" . utf8_decode($row->sn) . "'"; ?> ,
			Roaming: <?php echo "'" . utf8_decode($row->roaming) . "'"; ?> },
	<?php 
		}
	}
?>

  ];
  // Résilier le numéro
  $scope.removeUser = function(index, id, gsm) {
  	if (confirm("Etes vous sur de vouloir résilier le numéro " + gsm +" ?")) {
  		$scope.Annuaire.splice(index, 1);
		//alert(id);
		//alert(index);
    	//angular.extend({}, {id_user: id, ext: ext});
		//return false;
	   	return $http.post('<?php echo base_url(); ?>annuaire.php/ajax/terminate_gsm', {id_user: id, gsm: gsm})
		.success(function (data, status, headers, config) {
				
			//	$('#'+GSM).fadeOut(1000);
			//	$('#'+GSM).remove();
		});

    }
  };
  // Mettre en spare
  $scope.spareGsm = function(index, gsm) {
  	if (confirm("Etes vous sur de vouloir mettre en spare le numéro " + gsm +" ?")) {
  		//$scope.Annuaire.splice(index, 1);
		//alert(id);
		//alert(index);
    	//angular.extend({}, {id_user: id, ext: ext});
		//return false;
	   	return $http.post('<?php echo base_url(); ?>annuaire.php/ajax/spare_gsm', {gsm: gsm})
		.success(function (data, status, headers, config) {
			alert('Le numero'+' '+gsm+' a été mis en spare!');	
			//	$('#'+GSM).fadeOut(1000);
			//	$('#'+GSM).remove();
		});

    }
  };
  
  $scope.saveUser = function(data, gsm) {
    //$scope.item not updated yet
	//alert(data);
	   angular.extend(data, {id: gsm});
	   return $http.post('<?php echo base_url(); ?>annuaire.php/ajax/update_gsm_infos', data);
  };
  
});
</script>