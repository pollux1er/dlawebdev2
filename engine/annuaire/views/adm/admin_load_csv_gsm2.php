<script type="text/javascript">
	
</script>

<div class="container" ng-app="sortApp" ng-controller="mainController" style="width:100%">
<div style="border:1px solid gray;" class="tpl_box_init_container">
	<div align="center" class="tpl_box_init_title">Annuaire des téléphones fixes</div>
	
	<div align="center" class="tpl_box_white"> 
	
	<!--[ <a id="label_hide_show_log" onclick="showme(this.id); return false;" href=""> </a> ] -->
		<div align="center" style="width:100% !important;" class="tpl_box_container_result" id="div_result_entity"> 				
			<div class="form-group">
				<div class="input-group">
					<?php if (isset($success_msg)) { echo $success_msg; } ?>
					<?php $attributes = array('class' => 'form-horizontal', 'id' => 'upload', 'role' => 'form', 'target' => '_self'); ?>
					<?php echo form_open_multipart('annuaire/load_csv_gsm',  $attributes); ?>
                    <label class="control-label">Select File</label>
                    <input type="file" name="filename" class="file" ><br><br>
                    <span class="text-danger"><?php if (isset($error)) { echo $error; } ?></span>
                    <input type="submit" name="submit" value="Charger le fichier" class="btn btn-primary">
	              	<?php echo form_close(); ?>
	            	<?php /*echo "<pre>"; var_dump($upload_data);*/ ?>
	            	<table border="1">
	               	<?php //var_dump($csv);
	               	if(isset($csv))
	            		foreach($csv as $k => $v) {
	               			//var_dump($v);
	               			$ligne = explode( ';', $v[0] );
	               			echo "<tr>";
	               			foreach($ligne as $l)
	               				echo "<td>" . utf8_decode($l) . "</td>"; 
	               			echo "</tr>";
	               		} 
	               	?>
	               	</table>
	               	<?php	/*echo "</pre>";*/ ?>
				</div>      
			</div>
			<button class="btn btn-default" ng-click="addUser()">Ajouter PABX</button>	
		</div>
	</div>
</div>
</div>