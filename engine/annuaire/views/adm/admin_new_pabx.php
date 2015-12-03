<script type="text/javascript">
	// var columns = new Array("name","fonction","departement","extension","habilitation","mouchard");
	 // var placeholder = new Array("","","","","");
	 // var inputType = new Array("text","text","text","text","select2","select");
	 //var table = "tab_op_list_main";
	 var table = "";
	 var selectOpt = new Array("Oui","Non");
	 var selectOpt2 = new Array("Interne","Intra-perenco","GSM","France/UK","International");


	 // Set button class names 
	 var savebutton = "ajaxSave";
	 var deletebutton = "ajaxDelete";
	 var editbutton = "ajaxEdit";
	 var updatebutton = "ajaxUpdate";
	 var cancelbutton = "cancel";
	 
	 var saveImage = "assets/annuaire/images/save.png"
	 var editImage = "assets/annuaire/images/edit.png"
	 var deleteImage = "assets/annuaire/images/remove.png"
	 var cancelImage = "assets/annuaire/images/back.png"
	 var updateImage = "assets/annuaire/images/save.png"

	 // Set highlight animation delay (higher the value longer will be the animation)
	 var saveAnimationDelay = 3000; 
	 var deleteAnimationDelay = 1000;
	  
	 // 2 effects available available 1) slide 2) flash
	 var effect = "flash"; 
</script>
<?php 
$departement = $this->input->get('departement') ? $this->input->get('departement') : '*';

//echo "<pre>"; var_dump($users); die;
?>

<div class="container" ng-app="sortApp" ng-controller="mainController" style="width:100%">
<div style="border:1px solid gray;" class="tpl_box_init_container">
	<div align="center" class="tpl_box_init_title">Annuaire des téléphones fixes</div>
	
	<div align="center" class="tpl_box_white"> 
	
	<div class="alert alert-info" style="background-color: #51647d;margin: 1%;text-align: left;width: 98%;">
	    <p>Type de tri : {{ sortType }}</p>
	    <!--<p>Sort Reverse: {{ sortReverse }}</p>-->
	    <p>Recherche : {{ Noms }}</p>
  	</div>
	
	
	</form>
	<!--[ <a id="label_hide_show_log" onclick="showme(this.id); return false;" href=""> </a> ] -->
		<div align="center" style="width:100% !important;" class="tpl_box_container_result" id="div_result_entity"> 				
					<form style="margin : 0 1%;" action="" target="_self">
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-search"></i></div>
								<input type="text" class="form-control" placeholder="Rechercher" ng-model="Noms"  style="width : 40%" />
								<select name="departement" id="departement" onChange="this.form.submit();" class="form-control" style="margin-left: 1%;width: 16%;">
									<option value="*" <?php if($departement == '*') echo 'selected="selected"'; ?>>Tous les départements</option>
									<?php foreach($departments as $dep) { ?>
									<option value="<?php echo $dep->department; ?>" <?php if($departement == $dep->department) echo 'selected="selected"'; ?>><?php echo $dep->department; ?></option>
									<?php } ?>
								</select>

								<span style="font-size: x-large;margin: 0;background-color: #5a4080; border: 1px solid #ccc; color: white; float: right; font-size: x-large; height: 46px; margin: 0; padding: 1%;">{{ (Annuaire | filter:Noms).length }} </span>  
								<a href="/annuaire.php/annuaire/load_excel" title="Charger le fichier des consomations" target="_self">
									<img style="margin: 0;float: right; height: 46px; margin-right: 1%;; padding: 0%;" src="assets/annuaire/images/excel_2013.png" alt="submit" />
								</a>
								<a href="/annuaire.php/annuaire/add_new_pabx" title="Ajouter une nouvelle entrée PABX" target="_self">
									<img style="margin: 0;float: right; height: 46px; margin-right: 1%;; padding: 0%;" src="assets/annuaire/images/telephone_add.png" alt="Ajouter une nouvelle entrée PABX" title="Ajouter une nouvelle entrée PABX" />
								</a>	
							</div>      
						</div>
					</form>
					<table cellspacing="0" cellpadding="0" class="table-hover tab_op_list_main table table-bordered table-striped" style="width : 98%" >
						
						<thead>
							<tr align="left">
								<td>
									<a href="" ng-click="sortType = 'Noms'; sortReverse = !sortReverse" >
								        Noms & prenoms
								        <span ng-show="sortType == 'Noms' && !sortReverse" class="fa fa-caret-down"></span>
								        <span ng-show="sortType == 'Noms' && sortReverse" class="fa fa-caret-up"></span>
								    </a>
								</td>
								<td>
									Fonction			 
								</td>
								<td>
									Departement
								</td>
								<td style="width : 4%; text-align: center">
									Ext.
								</td>
								<td style="width : 10%; text-align: center">
									Habilitation
								</td>
								<td style="width : 6%; text-align: center">
									Mouchard
								</td>
								
								<td style="width : 7%; text-align: right">
									
								</td>
							</tr>
						</thead>
						<tfoot>
							<tr align="left" style="background-color: #51647d;color: white;">
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>								
								<td style="font-size: 14px;font-weight: bold;"></td>
							</tr>
						</tfoot>
						<tbody>
							 <tr id="{{ item.Id }}" align="left" ng-repeat="item in Annuaire | orderBy:sortType:sortReverse  | filter:Noms | filter:Mouchard | filter:Habilitation | filter:Fonction | filter:Departement | filter:Extension ">
						        <td>{{ item.Noms }}</td>
						        <td class="fonction">{{ item.Fonction }}</td>
						        <td class="departement">{{ item.Departement }}</td>
						        <td class="extension" style="text-align: center">{{ item.Extension }}</td>
						        <td>
									<span editable-select="item.Habilitation" e-name="Habilitation" e-form="rowform" e-ng-options="h.value as h.text for h in habilitations">
										{{ showHabilitation(item) }}
									</span>
								</td>
						        <td class="mouchard" style="text-align: center">
									<span editable-select="item.Mouchard"  e-name="Mouchard" e-form="rowform" e-ng-options="m.value as m.text for m in mouchards">
										{{ showMouchard(item) }}
									</span>	
								</td>
						        <td style="text-align: right; white-space: nowrap; padding: 4px;"><!--
						        	<a href="" id="{{ item.Id }}" class="ajaxEdit"><img src="" class="eimage"></a>
									<a href="" id="{{ item.Id }}" class="ajaxDelete"><img src="" class="dimage"></a>-->
									<!-- form -->
									<form editable-form name="rowform" onaftersave="saveUser($data, item.Extension)" ng-show="rowform.$visible" class="form-buttons form-inline" shown="inserted == item">
										<button type="submit" ng-disabled="rowform.$waiting" class="btn btn-primary" style="padding: 0 4px;">
											<img title="Supprimer de" src="assets/annuaire/images/save.png" width="32" height="32" alt="submit" />
										</button>
										<button type="button" ng-disabled="rowform.$waiting" ng-click="rowform.$cancel()" style="padding: 0 4px;" class="btn btn-default">
											<img title="Supprimer de" src="assets/annuaire/images/back.png" width="32" height="32" alt="submit" />
										</button>
									</form>
									<div class="buttons" ng-show="!rowform.$visible">
										<button class="btn btn-primary" ng-click="rowform.$show()" style="padding: 0px;">
											<img title="Supprimer de" src="assets/annuaire/images/telephone_edit.png" width="32" height="32" alt="submit" />
										</button>
										<button class="btn btn-danger" ng-click="removeUser($index, item.Id, item.Extension)" style="padding: 0px;">
											<img src="assets/annuaire/images/telephone_delete.png" width="32" height="32" alt="submit" />
										</button>
									</div>
						        </td>
						      </tr>
						</tbody>
					</table>
					<button class="btn btn-default" ng-click="addUser()">Ajouter PABX</button>
				
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
  
  $scope.Annuaire = [
   
	<?php
	if(count($users) == 0) { 
	} else {
	foreach ($users as $row) { 	

		?>
		{ Id: <?php echo "'" . $row->id . "'"; ?>, 
		    Noms: <?php echo "'" . $row->last_name . ' ' . $row->first_name . "'"; ?>, 
			Fonction: <?php echo "'" . addslashes(utf8_decode($row->job_title)) . "'"; ?>, 
			Departement: <?php echo "'" . addslashes(utf8_decode($row->department)) . "'"; ?>, 
			Extension: <?php echo "'" . utf8_decode($row->extension) . "'"; ?> ,
			Habilitation: <?php echo "'" . utf8_decode($row->habilitation) . "'"; ?> ,
			Mouchard: <?php echo "'" . utf8_decode($row->mouchard) . "'"; ?> },
	<?php 
		}
	}
?>

  ];

  $scope.habilitations = [
    {value: 'Interne', text: 'Interne'},
    {value: 'INTRA-PERENCO', text: 'INTRA-PERENCO'},
    {value: 'GSM', text: 'GSM'},
    {value: 'International', text: 'International'},
    {value: 'France/UK', text: 'France/UK'}
  ];
  
   $scope.mouchards = [
    {value: 'oui', text: 'oui'},
    {value: 'non', text: 'non'}
  ];

  $scope.showHabilitation = function(Annuaire) {
    var selected = [];
    if(Annuaire.Habilitation) {
      selected = $filter('filter')($scope.habilitations, {value: Annuaire.Habilitation});
    }
    return selected.length ? selected[0].text : 'Not set';
  };
  
  $scope.showMouchard = function(Annuaire) {
    var selected = [];
    if(Annuaire.Mouchard) {
      selected = $filter('filter')($scope.mouchards, {value: Annuaire.Mouchard});
    }
    return selected.length ? selected[0].text : 'Not set';
  };
  
  $scope.removeUser = function(index, id, ext) {
  	if (confirm("Etes vous sur de vouloir effacer cette entrée ?")) {
  		$scope.Annuaire.splice(index, 1);
    	//angular.extend({}, {id_user: id, ext: ext});
	   	return $http.post('/annuaire.php/ajax/update_taxation_infos', {id_user: id, ext: ext});

    }
  };
  
   // $scope.postname = function ($prodid){
        // alert($prodid);
        // $http.get('base_loisirs.php/ajax/envoyer_demande/'+$prodid)        
        // .success(function(results){
        // })
        // .error(function(data, status){
            // console.error("Category add error: ", status, data);
        // });    
    // };  
	
	$scope.postName = function () {
		//alert($scope.Annuaire.$index);
		// $http.post("<?php echo base_url(); ?>base_loisirs.php/ajax/envoyer_demande/", {"name": $scope.Annuaire.Id})
			// .success(function (data, status, headers, config) {
				// $scope.data = data;

			// })
			// .error(function (data, status, headers, config) {
				// $scope.status = status;
			// });
		// $http.get('/auth.py').success(function(data, status, headers) {
			// authToken = headers('A-Token');
			// $scope.user = data;
		  // });
	}

  $scope.saveUser = function(data, id) {
    //$scope.item not updated yet
	//alert(data);
	   angular.extend(data, {id: id});
	   return $http.post('/annuaire.php/ajax/update_taxation_infos', data);
  };

  // $scope.addUser = function() {
    // $scope.inserted = {
      // id: $scope.Annuaire.length+1,
      // Noms: '',
      // Habilitation: null
    // };
    // $scope.Annuaire.push($scope.inserted);
  // };
  
  // app.run(function($httpBackend) {
	// $httpBackend.whenPOST(/\/saveUser/).respond(function(method, url, data) {
		// data = angular.fromJson(data);
		// return [200, {status: 'ok'}];
	// });
	// });

});
</script>