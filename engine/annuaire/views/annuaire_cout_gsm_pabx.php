<script type="text/javascript">

</script>
<?php 
$departement = $this->input->get('departement') ? $this->input->get('departement') : '*';

//echo "<pre>"; var_dump($users); die;
?>

<div class="container" ng-app="sortApp" ng-controller="mainController" style="width:100%">
<div style="border:1px solid gray;" class="tpl_box_init_container">
	<div align="center" class="tpl_box_init_title">Annuaire des téléphones fixes</div>
	
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
								<input type="text" class="form-control" placeholder="Rechercher" ng-model="Noms"  style="width : 40%" />
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
						<col style="width : 20%">
						<col style="width : 6%">
						<col style="width : 5%">
						<colgroup span="2"></colgroup>
						<colgroup span="2"></colgroup>
						<colgroup span="2"></colgroup>
						<colgroup span="2"></colgroup>
						<col>
						<tr>
							<th rowspan="2" style="vertical-align: middle;">
								<a href="" ng-click="sortType = 'Noms'; sortReverse = !sortReverse" >
								        Noms & prenoms
								    <span ng-show="sortType == 'Noms' && !sortReverse" class="fa fa-caret-down"></span>
								    <span ng-show="sortType == 'Noms' && sortReverse" class="fa fa-caret-up"></span>
								</a>
							</th>
							<th rowspan="2" style="vertical-align: middle;">GSM</th>
							<th rowspan="2" style="vertical-align: middle;">PABX</th>
							<th colspan="2" scope="colgroup">Juin</th>
							<th colspan="2" scope="colgroup">Juillet</th>
							<th colspan="2" scope="colgroup">Aout</th>
							<th colspan="2" scope="colgroup">Sept</th>
							<th rowspan="2" style="vertical-align: middle;">TOTAL</th>
						</tr>
						<tr>
							<th scope="col">GSM</th>
							<th scope="col">PABX</th>
							<th scope="col">GSM</th>
							<th scope="col">PABX</th>
							<th scope="col">GSM</th>
							<th scope="col">PABX</th>
							<th scope="col">GSM</th>
							<th scope="col">PABX</th>
						</tr>
						<!--<thead>
							<tr align="left">
								<td style="width : 2%; text-align: center">#</td>
								<td>
									<a href="" ng-click="sortType = 'Noms'; sortReverse = !sortReverse" >
								        Noms & prenoms
								        <span ng-show="sortType == 'Noms' && !sortReverse" class="fa fa-caret-down"></span>
								        <span ng-show="sortType == 'Noms' && sortReverse" class="fa fa-caret-up"></span>
								    </a>
								</td>
								<td style="width : 7%; text-align: center">GSM</td>
								
								<td style="width : 9%; text-align: right">
									<a href="" ng-click="sortType = 'Juin'; sortReverse = !sortReverse" >
										Juin
										<span ng-show="sortType == 'Juin' && !sortReverse" class="fa fa-caret-down"></span>
								        <span ng-show="sortType == 'Juin' && sortReverse" class="fa fa-caret-up"></span>
								    </a>
								</td>
								<td style="width : 9%; text-align: right">
									<a href="" ng-click="sortType = 'Juillet'; sortReverse = !sortReverse" >
										Juil
										<span ng-show="sortType == 'Juillet' && !sortReverse" class="fa fa-caret-down"></span>
								        <span ng-show="sortType == 'Juillet' && sortReverse" class="fa fa-caret-up"></span>
								    </a>
								</td>
								<td style="width : 9%; text-align: right">
									<a href="" ng-click="sortType = 'Aout'; sortReverse = !sortReverse" >
										Aout
										<span ng-show="sortType == 'Aout' && !sortReverse" class="fa fa-caret-down"></span>
								        <span ng-show="sortType == 'Aout' && sortReverse" class="fa fa-caret-up"></span>
								    </a>
								</td>
								<td style="width : 9%; text-align: right">
									<a href="" ng-click="sortType = 'Septembre'; sortReverse = !sortReverse" >
										Sept
										<span ng-show="sortType == 'Septembre' && !sortReverse" class="fa fa-caret-down"></span>
								        <span ng-show="sortType == 'Septembre' && sortReverse" class="fa fa-caret-up"></span>
								    </a>
								</td>
								<td style="width : 9%; text-align: right">
									<a href="" ng-click="sortType = 'Total'; sortReverse = !sortReverse" >
										Total
										<span ng-show="sortType == 'Total' && !sortReverse" class="fa fa-caret-down"></span>
								        <span ng-show="sortType == 'Total' && sortReverse" class="fa fa-caret-up"></span>
								    </a>
								</td>
							</tr>
						</thead>-->
						
						<tfoot>
							<tr align="left" style="background-color: #51647d;color: white;">
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<!--
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td style="font-size: 14px;font-weight: bold;padding-right: 4px;text-align: right;">{{Annuaire | filter:Noms | sumOfValue:'Juin' | currency:"":0 }}</td>
									<td style="font-size: 14px;font-weight: bold;padding-right: 4px;text-align: right;">{{Annuaire | filter:Noms | sumOfValue:'Juillet' | currency:"":0 }}</td>
									<td style="font-size: 14px;font-weight: bold;padding-right: 4px;text-align: right;">{{Annuaire | filter:Noms | sumOfValue:'Aout' | currency:"":0 }}</td>
									<td style="font-size: 14px;font-weight: bold;padding-right: 4px;text-align: right;">{{Annuaire | filter:Noms | sumOfValue:'Septembre' | currency:"":0 }}</td>
									<td style="font-size: 14px;font-weight: bold;padding-right: 4px;text-align: right;">{{ sum.Annuaire | filter:Noms |  currency:"":0 }}</td>
								-->
							</tr>
						</tfoot><!--
						<tbody>
							<tr id="{{ item.Id }}" align="left" ng-repeat="item in Annuaire | orderBy:sortType:sortReverse  | filter:Noms | filter:Mouchard | filter:Juin | filter:Juillet | filter:Aout | filter:Septembre | filter:Total ">
						        <td style="text-align: center; padding: 8px 2px;">{{$index + 1}}</td>
						        <td><a target="_blank" href="http://intranet.perenco.net/module/staff/?id={{ item.Id }}">{{ item.Noms }}</a></td>
						        <td>{{ item.Fonction }}</td>
						        <td>{{ item.Departement }}</td>
						        <td style="text-align: center">{{ item.GSM }}</td>
						        <td>{{ item.Formule }}</td>
						        <td style="text-align: right;padding-right: 4px;">{{ item.Juin  | currency:"":0 }}</td>
						        <td style="text-align: right;padding-right: 4px;">{{ item.Juillet | currency:"" }}</td>
						        <td style="text-align: right;padding-right: 4px;">{{ item.Aout | currency:"" }}</td>
						        <td style="text-align: right;padding-right: 4px;">{{ item.Septembre | currency:"" }}</td>
						        <td style="text-align: right;padding-right: 4px;">{{ item.Total | currency:"":0 }}</td>
						    </tr>
						</tbody>-->
						<tbody>
							<tr id="{{ item.Id }}" align="left" ng-repeat="item in Annuaire | orderBy:sortType:sortReverse | filter:Noms">
						        <td style="text-align: left; padding: 8px 2px;">{{ item.Noms }}</td>
						        <td style="text-align: center; padding: 8px 2px;">{{ item.gsm }}</td>
						        <td style="text-align: center; padding: 8px 2px;">{{ item.ext }}</td>
						        <td style="text-align: right;padding-right: 4px;">{{item.g_Juin | currency:"":0}}</td>
						        <td style="text-align: right;padding-right: 4px;">{{item.p_Juin | currency:"":0}}</td>
						        <td style="text-align: right;padding-right: 4px;">{{item.g_Juillet | currency:"":0}}</td>
						        <td style="text-align: right;padding-right: 4px;">{{item.p_Juillet | currency:"":0}}</td>
						        <td style="text-align: right;padding-right: 4px;">{{item.g_Aout | currency:"":0}}</td>
						        <td style="text-align: right;padding-right: 4px;">{{item.p_Aout | currency:"":0}}</td>
						        <td style="text-align: right;padding-right: 4px;">{{item.g_Septembre | currency:"":0}}</td>
						        <td style="text-align: right;padding-right: 4px;">{{item.p_Septembre | currency:"":0}}</td>
						        <td style="text-align: right;padding-right: 4px;">{{item.Total | currency:"":0}}</td>
						    </tr>
						</tbody>
					</table>
				
		</div>
	</div>
</div>
</div>
<script type="text/javascript">
angular.module('sortApp', []).filter('sumOfValue', function () {
	 return function (data, key) {
   		if (angular.isUndefined(data) && angular.isUndefined(key))
            return 0;        
        var sum = 0;
        
        angular.forEach(data,function(v,k){
            sum = sum + parseInt(v[key]);
        });        
        return sum;
    	}
}).controller('mainController', function($scope) {
  $scope.sortType     = 'Noms'; // set the default sort type
  $scope.sortReverse  = false;  // set the default sort order
  $scope.Noms   = '';     // set the default search/filter term
  
  // create the list of sushi items 
  $scope.Annuaire = [
   
<?php
	if(count($users) == 0) { 
	} else {
	foreach ($users as $row) { 	
		if($row['GSM_juin'] == '') $row['GSM_juin'] = 0.00;
		if($row["GSM_Juillet"] == '') $row["GSM_Juillet"] = 0.00;
		if($row["GSM_aout"] == '') $row["GSM_aout"]  = 0.00;
		if($row["GSM_sept"] == '') $row["GSM_sept"] = 0.00;
		if($row['Tax_juin'] == '') $row['Tax_juin'] = 0.00;
		if($row["Tax_Juillet"] == '') $row["Tax_Juillet"] = 0.00;
		if($row["Tax_aout"] == '') $row["Tax_aout"]  = 0.00;
		if($row["Tax_sept"] == '') $row["Tax_sept"] = 0.00;
		$nom = $row["Nom"] . ' ' . $row["Prenom"];
		if($nom == ' ') $nom = $row->status;
		?>
		{ Id: <?php echo "'" . $row["id"] . "'"; ?>, 
		    Noms: <?php echo "'" . $nom . "'"; ?>,  
			gsm: <?php echo "'" . $row['GSM'] . "'"; ?> ,
			ext: <?php echo "'" . $row['Extension'] . "'"; ?> ,
			g_Juin: <?php echo $row['GSM_juin']; ?> ,
			g_Juillet: <?php echo $row["GSM_Juillet"]; ?> ,
			g_Aout: <?php echo $row["GSM_aout"]; ?> ,
			g_Septembre: <?php echo $row["GSM_sept"]; ?> ,
			p_Juin: <?php echo $row['Tax_juin']; ?> ,
			p_Juillet: <?php echo $row["Tax_Juillet"]; ?> ,
			p_Aout: <?php echo $row["Tax_aout"]; ?> ,
			p_Septembre: <?php echo $row["Tax_sept"]; ?> ,
			Total: <?php echo $row['GSM_juin'] + $row["GSM_Juillet"] + $row["GSM_aout"] + $row["GSM_sept"] + $row['Tax_juin'] + $row["Tax_Juillet"] + $row["Tax_aout"] + $row["Tax_sept"]; ?> },
	<?php 
		}
	}
?>

  ];
  $scope.getTotal = function(type) {
       var total = 0;
        angular.forEach($scope.Annuaire, function(el) {
            total += el[type];
        });
        return total;
    };
    $scope.sum=function(item){
		return item.Juin + item.Juillet + item.Aout + item.Septembre;
	}

  
});
</script>