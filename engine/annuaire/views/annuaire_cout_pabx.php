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
						<thead>
							<tr align="left">
								<td style="width : 2%; text-align: center">#</td>
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
								<td style="width : 8%; text-align: center">
									Habilitation
								</td>
								<td style="width : 6%; text-align: center">
									Minuterie
								</td>
								<td style="width : 7%; text-align: right">
									<a href="" ng-click="sortType = 'Juin'; sortReverse = !sortReverse" >
										Juin
										<span ng-show="sortType == 'Juin' && !sortReverse" class="fa fa-caret-down"></span>
								        <span ng-show="sortType == 'Juin' && sortReverse" class="fa fa-caret-up"></span>
								    </a>
								</td>
								<td style="width : 7%; text-align: right">
									<a href="" ng-click="sortType = 'Juillet'; sortReverse = !sortReverse" >
										Juil
										<span ng-show="sortType == 'Juillet' && !sortReverse" class="fa fa-caret-down"></span>
								        <span ng-show="sortType == 'Juillet' && sortReverse" class="fa fa-caret-up"></span>
								    </a>
								</td>
								<td style="width : 7%; text-align: right">
									<a href="" ng-click="sortType = 'Aout'; sortReverse = !sortReverse" >
										Aout
										<span ng-show="sortType == 'Aout' && !sortReverse" class="fa fa-caret-down"></span>
								        <span ng-show="sortType == 'Aout' && sortReverse" class="fa fa-caret-up"></span>
								    </a>
								</td>
								<td style="width : 7%; text-align: right">
									<a href="" ng-click="sortType = 'Septembre'; sortReverse = !sortReverse" >
										Sept
										<span ng-show="sortType == 'Septembre' && !sortReverse" class="fa fa-caret-down"></span>
								        <span ng-show="sortType == 'Septembre' && sortReverse" class="fa fa-caret-up"></span>
								    </a>
								</td>
								<td style="width : 7%; text-align: right">
									<a href="" ng-click="sortType = 'Total'; sortReverse = !sortReverse" >
										Total
										<span ng-show="sortType == 'Total' && !sortReverse" class="fa fa-caret-down"></span>
								        <span ng-show="sortType == 'Total' && sortReverse" class="fa fa-caret-up"></span>
								    </a>
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
								<td></td>
								<td style="font-size: 14px;font-weight: bold;">{{Annuaire | filter:Noms | sumOfValue:'Juin' | noFractionCurrency:"":"" }}</td>
								<td style="font-size: 14px;font-weight: bold;">{{Annuaire | filter:Noms | sumOfValue:'Juillet' | noFractionCurrency:""}}</td>
								<td style="font-size: 14px;font-weight: bold;">{{Annuaire | filter:Noms | sumOfValue:'Aout' | noFractionCurrency:""}}</td>
								<td style="font-size: 14px;font-weight: bold;">{{Annuaire | filter:Noms | sumOfValue:'Septembre' | noFractionCurrency:""}}</td>
								<td style="font-size: 14px;font-weight: bold;">{{getTotal('Septembre') + getTotal('Aout') + getTotal('Juillet') + getTotal('Juin') |filter:Noms |  noFractionCurrency:""}}</td>
							</tr>
						</tfoot>
						<tbody>
							 <tr align="left" ng-repeat="item in Annuaire | orderBy:sortType:sortReverse  | filter:Noms | filter:Mouchard | filter:Juin | filter:Juillet | filter:Aout | filter:Septembre | filter:Total ">
						        <td style="text-align: center; padding: 8px 2px;">{{$index + 1}}</td>
						        <td><a target="_blank" href="http://intranet.perenco.net/module/staff/?id={{ item.Id }}">{{ item.Noms }}</a></td>
						        <td>{{ item.Fonction }}</td>
						        <td>{{ item.Departement }}</td>
						        <td style="text-align: center">{{ item.Extension }}</td>
						        <td>{{ item.Habilitation }}</td>
						        <td style="text-align: center">{{ item.Mouchard }}</td>
						        <td style="text-align: right">{{ item.Juin  | noFractionCurrency:"" }}</td>
						        <td style="text-align: right">{{ item.Juillet | noFractionCurrency:"" }}</td>
						        <td style="text-align: right">{{ item.Aout | noFractionCurrency:"" }}</td>
						        <td style="text-align: right">{{ item.Septembre | noFractionCurrency:"" }}</td>
						        <td style="text-align: right">{{ item.Total | noFractionCurrency:"" }}</td>
						      </tr>
						</tbody>
					</table>
				
		</div>
	</div>
</div>
</div>
<script type="text/javascript">
angular.module('sortApp', [])
.filter('noFractionCurrency',
    [ '$filter', '$locale', function(filter, locale) {
      var currencyFilter = filter('currency');
      var formats = locale.NUMBER_FORMATS;
      return function(amount, currencySymbol) {
        var value = currencyFilter(amount, currencySymbol);
        var sep = value.indexOf(formats.DECIMAL_SEP);
        console.log(amount, value);
        if(amount >= 0) { 
          return value.substring(0, sep);
        }
        return value.substring(0, sep) + ')';
      };
    } ])
.filter('sumOfValue', function () {
    return function (data, key) {
        //debugger;
        if (angular.isUndefined(data) && angular.isUndefined(key))
            return 0;        
        var sum = 0;
        
        angular.forEach(data,function(v,k){
            sum = sum + parseInt(v[key]);
        });        
        return sum;
    }
}).filter('totalSumPriceQty', function () {
    return function (data, key1, key2, key3, key4) {        
        if (angular.isUndefined(data) && angular.isUndefined(key1)  && angular.isUndefined(key2) && angular.isUndefined(key3) && angular.isUndefined(key4)) 
            return 0;
        
        var sum = 0;
        angular.forEach(data,function(v,k){
            sum = sum + (parseInt(v[key1]) + parseInt(v[key2]) + parseInt(v[key3]) + parseInt(v[key4]));
        });
        return sum;
    }
})
.controller('mainController', function($scope) {
  $scope.sortType     = 'Noms'; // set the default sort type
  $scope.sortReverse  = false;  // set the default sort order
  $scope.Noms   = '';     // set the default search/filter term
  
  // create the list of sushi items 
  $scope.Annuaire = [
   
<?php
	if(count($users) == 0) { 
	} else {
	foreach ($users as $row) { 	
		if($row->juin == '') $row->juin = 0.00;
		if($row->juil == '') $row->juil = 0.00;
		if($row->aou == '') $row->aou = 0.00;
		if($row->sep == '') $row->sep = 0.00;
		?>
		{ Id: <?php echo "'" . $row->id . "'"; ?>, 
		    Noms: <?php echo "'" . $row->last_name . ' ' . $row->first_name . "'"; ?>, 
			Fonction: <?php echo "'" . addslashes(utf8_decode($row->job_title)) . "'"; ?>, 
			Departement: <?php echo "'" . addslashes(utf8_decode($row->department)) . "'"; ?>, 
			Extension: <?php echo "'" . utf8_decode($row->extension) . "'"; ?> ,
			Habilitation: <?php echo "'" . utf8_decode($row->habilitation) . "'"; ?> ,
			Mouchard: <?php echo "'" . utf8_decode($row->mouchard) . "'"; ?> ,
			Juin: <?php echo $row->juin; ?> ,
			Juillet: <?php echo $row->juil; ?> ,
			Aout: <?php echo $row->aou; ?> ,
			Septembre: <?php echo $row->sep; ?> ,
			Total: <?php echo $row->juin + $row->juil + $row->aou + $row->sep; ?> },
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