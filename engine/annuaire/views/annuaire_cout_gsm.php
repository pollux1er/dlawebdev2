<script type="text/javascript">

</script>
<?php 
$departement = $this->input->get('departement') ? $this->input->get('departement') : '*';
$formule = $this->input->get('formule') ? $this->input->get('formule') : '*';
$status = $this->input->get('status') ? $this->input->get('status') : '*';
//$freq = $this->input->get('freq') ? $this->input->get('freq') : '*';
$actual_month_updated = $this->annuaire->get_the_last_gsm_month_bill_updated();

$months = array(
    'January',
    'February',
    'March',
    'April',
    'May',
    'June',
    'July',
    'August',
    'September',
    'October',
    'November',
    'December',
);

$current = date('F');

if($this->input->get('freq'))
	$freq = $this->input->get('freq');
else	
	$freq = 4;
	
$start = array_search($actual_month_updated, $months);

$toshow = array();
$total = 0;

for($i = $start; $total < $freq; $i--)
{
    if($i == 0)
    {
        $i = 12;
    }

    $toshow[] = $months[$i];
    $total++;
}

$toshow = array_reverse($toshow);
?>

<div class="container" ng-app="sortApp" ng-controller="mainController" style="width:100%">
<div style="border:1px solid gray;" class="tpl_box_init_container">
	<div align="center" class="tpl_box_init_title">Annuaire des téléphones fixes</div>
	
	<div align="center" class="tpl_box_white"> 
	
	<div class="alert alert-info" style="background-color: #51647d;margin: 1%;text-align: left;width: 48%; float : left">
	    <p>Type de tri : {{ sortType }}</p>
	    <!--<p>Sort Reverse: {{ sortReverse }}</p>-->
	    <p>Recherche : {{ Noms }}</p>
  	</div>
	<div class="alert alert-info" style="background-color: #51647d;margin: 1%;text-align: left;width: 48%; float : right">
	    <p>
		&nbsp;
	    <p>
			&nbsp;
		</p>
  	</div>
	
	<!--[ <a id="label_hide_show_log" onclick="showme(this.id); return false;" href=""> </a> ] -->
		<div align="center" style="width:100% !important;" class="tpl_box_container_result" id="div_result_entity"> 				
					<form style="margin : 0 1%;" action="" target="_self">
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-search"></i></div>
								<input type="text" class="form-control" placeholder="Rechercher" ng-model="Noms"  style="width : 30%" />
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
								<select name="freq" id="freq" onChange="this.form.submit();" class="form-control" style="margin-left: 1%;width: 12%;">
									<option value="3" <?php if($freq == '3') echo 'selected="selected"'; ?>>3 derniers mois</option>
									<option value="4" <?php if($freq == '4') echo 'selected="selected"'; ?>>4 derniers mois</option>
								</select>
							
								<span style="font-size: x-large;margin: 0;background-color: #5a4080; border: 1px solid #ccc; color: white; float: right; font-size: x-large; height: 35px; margin: 0; padding: 0 1%;">{{ (Annuaire | filter:Noms).length }} </span>  
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
								<td>Fonction</td>
								<td>Departement</td>
								<td style="width : 7%; text-align: center">GSM</td>
								<td style="width : 7%; text-align: center">Formule</td>
								<?php foreach($toshow as $month) { ?>
								<td style="width : 7%; text-align: right">
									<a href="" ng-click="sortType = '<?php echo $month; ?>'; sortReverse = !sortReverse" >
										<?php echo $month; ?>
										<span ng-show="sortType == '<?php echo $month; ?>' && !sortReverse" class="fa fa-caret-down"></span>
								        <span ng-show="sortType == '<?php echo $month; ?>' && sortReverse" class="fa fa-caret-up"></span>
								    </a>
								</td>
								<?php } ?><!--
								<td style="width : 7%; text-align: right">
									<a href="" ng-click="sortType = 'July'; sortReverse = !sortReverse" >
										Juil
										<span ng-show="sortType == 'July' && !sortReverse" class="fa fa-caret-down"></span>
								        <span ng-show="sortType == 'July' && sortReverse" class="fa fa-caret-up"></span>
								    </a>
								</td>
								<td style="width : 7%; text-align: right">
									<a href="" ng-click="sortType = 'August'; sortReverse = !sortReverse" >
										August
										<span ng-show="sortType == 'August' && !sortReverse" class="fa fa-caret-down"></span>
								        <span ng-show="sortType == 'August' && sortReverse" class="fa fa-caret-up"></span>
								    </a>
								</td>
								<td style="width : 7%; text-align: right">
									<a href="" ng-click="sortType = 'September'; sortReverse = !sortReverse" >
										Sept
										<span ng-show="sortType == 'September' && !sortReverse" class="fa fa-caret-down"></span>
								        <span ng-show="sortType == 'September' && sortReverse" class="fa fa-caret-up"></span>
								    </a>
								</td>-->
								<td style="width : 9%; text-align: right">
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
								<?php foreach($toshow as $month) { ?>
									<td style="font-size: 14px;font-weight: bold;padding-right: 4px;text-align: right;">{{Annuaire | filter:Noms | sumOfValue:'<?php echo $month; ?>' | noFractionCurrency:"":0 }}</td>
								<?php } ?><!--
								<td style="font-size: 14px;font-weight: bold;padding-right: 4px;text-align: right;">{{Annuaire | filter:Noms | sumOfValue:'July' | noFractionCurrency:"":0 }}</td>
								<td style="font-size: 14px;font-weight: bold;padding-right: 4px;text-align: right;">{{Annuaire | filter:Noms | sumOfValue:'August' | noFractionCurrency:"":0 }}</td>
								<td style="font-size: 14px;font-weight: bold;padding-right: 4px;text-align: right;">{{Annuaire | filter:Noms | sumOfValue:'September' | noFractionCurrency:"":0 }}</td>-->
								<td style="font-size: 14px;font-weight: bold;padding-right: 4px;text-align: right;">{{ 0 <?php foreach($toshow as $month) { ?> + getTotal('<?php echo $month; ?>')<?php } ?> | filter:Noms |  noFractionCurrency:"" }}</td>
							</tr>
						</tfoot>
						<tbody>
							 <tr id="{{ item.Id }}" align="left" ng-repeat="item in Annuaire | orderBy:sortType:sortReverse  | filter:Noms | filter:Mouchard | filter:January |  filter:February | filter:March | filter:April | filter:May | filter:June | filter:July | filter:August | filter:September | filter:October | filter:December | filter:Total ">
						        <td style="text-align: center; padding: 8px 2px;">{{$index + 1}}</td>
						        <td><a target="_blank" href="http://intranet.perenco.net/module/staff/?id={{ item.Id }}">{{ item.Noms }}</a></td>
						        <td>{{ item.Fonction }}</td>
						        <td>{{ item.Departement }}</td>
						        <td style="text-align: center">{{ item.GSM }}</td>
						        <td>{{ item.Formule }}</td>
								<?php foreach($toshow as $month) { ?>
									<td style="text-align: right;padding-right: 4px;">{{ item.<?php echo $month; ?>  | noFractionCurrency:"":0 }}</td>
								<?php } ?><!--
						        <td style="text-align: right;padding-right: 4px;">{{ item.July | noFractionCurrency:"" }}</td>
						        <td style="text-align: right;padding-right: 4px;">{{ item.August | noFractionCurrency:"" }}</td>
						        <td style="text-align: right;padding-right: 4px;">{{ item.September | noFractionCurrency:"" }}</td>-->
						        <td style="text-align: right;padding-right: 4px;">{{ item.Total | noFractionCurrency:"":0 }}</td>
						      </tr>
						</tbody>
					</table>
				
		</div>
	</div>
</div>
</div>
<script type="text/javascript">
angular.module('sortApp', []).filter('noFractionCurrency',
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
		if($row->January == '' || is_null($row->January)) $row->January = 0.00;
		if($row->February == '' || is_null($row->February)) $row->February = 0.00;
		if($row->March == '' || is_null($row->March)) $row->March = 0.00;
		if($row->April == '' || is_null($row->April)) $row->April = 0.00;
		if($row->May == '' || is_null($row->May)) $row->May = 0.00;
		if($row->June == '' || is_null($row->June)) $row->June = 0.00;
		if($row->July == '' || is_null($row->July)) $row->July = 0.00;
		if($row->August == '' || is_null($row->August)) $row->August = 0.00;
		if($row->September == '' || is_null($row->September)) $row->September = 0.00;
		if($row->October == '' || is_null($row->October)) $row->October = 0.00;
		if($row->November == '' || is_null($row->November)) $row->November = 0.00;
		if($row->December == '' || is_null($row->December)) $row->December = 0.00;
		$nom = $row->nom;
		if($nom == ' ') $nom = $row->status;
		$tot = 0;
		foreach($toshow as $month) {
			$tot = $tot + (int) $row->$month;
		}
		//die;
		?>
		{ Id: <?php echo "'" . $row->id . "'"; ?>, 
		    Noms: <?php echo "'" . $nom . "'"; ?>, 
			Fonction: <?php echo "'" . addslashes(utf8_decode($row->job_title)) . "'"; ?>, 
			Departement: <?php echo "'" . addslashes(utf8_decode($row->department)) . "'"; ?>, 
			GSM: <?php echo "'" . utf8_decode($row->number) . "'"; ?> ,
			Formule: <?php echo "'" . utf8_decode($row->formula) . "'"; ?> ,
			January: <?php echo $row->January; ?> ,
			February: <?php echo $row->February; ?> ,
			March: <?php echo $row->March; ?> ,
			April: <?php echo $row->April; ?> ,
			May: <?php echo $row->May; ?> ,
			June: <?php echo $row->June; ?> ,
			July: <?php echo $row->July; ?> ,
			August: <?php echo $row->August; ?> ,
			September: <?php echo $row->September; ?> ,
			October: <?php echo $row->October; ?> ,
			November: <?php echo $row->November; ?> ,
			December: <?php echo $row->December; ?> ,
			Total: <?php echo $tot; ?> },
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
		return item.June + item.July + item.August + item.September;
	}

  
});
</script>