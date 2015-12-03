<script type="text/javascript">
</script>
<?php 
$departement = $this->input->get('departement') ? $this->input->get('departement') : '*';
?>
<div class="container" ng-app="sortApp" ng-controller="mainController" style="width:100%">
<div style="border:1px solid gray;" class="tpl_box_init_container">
	<div class="-p-heading-title"> 
		<h1 class="documentFirstHeading">Annuaire du staff</h1>
	</div>
	
	<div align="center" class="tpl_box_white"> 
	
	<div class="alert alert-info" style="background-color: #51647d;margin: 1% 1% 2px;text-align: left;width: 98%;">
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
								<input type="text" class="form-control" placeholder="Rechercher" id="recherche" ng-model="Noms"  style="width : 40%" />
								<select name="departement" id="departement" onChange="this.form.submit();" class="form-control" style="margin-left: 1%;width: 16%;">
									<option value="*" <?php if($departement == '*') echo 'selected="selected"'; ?>>Tous les départements</option>
									<?php foreach($departments as $dep) { ?>
									<option value="<?php echo $dep->department; ?>" <?php if($departement == $dep->department) echo 'selected="selected"'; ?>><?php echo $dep->department; ?></option>
									<?php } ?>
								</select>
								<span style="font-size: x-large;margin: 0;background-color: #5a4080; border: 1px solid #ccc; color: white; float: right; font-size: x-large; height: 46px; margin: 0; padding: 1%;">{{ (Annuaire | filter:Noms).length }} </span>  
							</div>      
						</div>
					</form>
					<table cellspacing="0" cellpadding="0" class="tab_op_list_main table table-bordered table-striped" style="width : 98%" >
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
									Fixe			 
								</td>
								<td>
									Abrégé			 
								</td>
								<td>
									Portable			 
								</td>
								<td>
									Batiment
								</td>
								<td>
									Bureau
								</td>
							</tr>
						</thead>
						<tbody>
							 <tr align="left" ng-repeat="roll in Annuaire | orderBy:sortType:sortReverse  | filter:Noms">
						        <td>{{ roll.Noms }}</td>
						        <td>{{ roll.Fixe }}</td>
						        <td>{{ roll.Fixe }}</td>
						        <td>{{ roll.Portable }}</td>
						        <td>{{ roll.Batiment }}</td>
						        <td>{{ roll.Bureau }}</td>
						      </tr>
							
							
						</tbody>
					</table>
				
		</div>
	</div>
</div>
</div>
<script type="text/javascript">
angular.module('sortApp', [])

.controller('mainController', function($scope) {
  $scope.sortType     = 'Noms'; // set the default sort type
  $scope.sortReverse  = false;  // set the default sort order
  $scope.Noms   = '';     // set the default search/filter term
  
  // create the list of sushi rolls 
  $scope.Annuaire = [
   
<?php
	if(count($users) == 0) { 
	} else {
	foreach ($users as $row) { 	?>
		{ Noms: <?php echo "'" . $row->last_name . ' ' . $row->first_name . "'"; ?>, 
			Fixe: <?php echo "'" . utf8_decode($row->extension) . "'"; ?>, 
			Portable: <?php echo "'" . utf8_decode($row->id_gsm) . "'"; ?>, 
			Batiment: <?php echo "'" . utf8_decode($row->batiment) . "'"; ?>, 
			Bureau: <?php echo "'" . utf8_decode($row->bureau) . "'"; ?> },
	<?php 
		}
	}
?>

  ];
  
});
</script>