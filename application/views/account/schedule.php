<div class="page-header">
  <h1> <i class="fa fa-clock-o" aria-hidden="true"></i>  Horarios <small> listado </small></h1>
</div>

<?php echo form_open()?>

	<a href="<?php echo site_url(uri_string())?>" class="btn btn-default btn-sm"> <i class="fa fa-retweet"></i> </a>
	<button class="btn btn-success btn-sm">GUARDAR CAMBIOS</button>
	<br><br>
	
	<div class="table-responsive">
		<table class="table table-hover table-striped">
		<thead>
			<tr>
				<th>DIA</th>
				<th></th>
				<th>DESDE</th>
				<th>HASTA</th>						
			</tr>
		</thead>
		<tbody><?php
		$days = array(			
			2 => 'LUNES' ,
			3 => 'MARTES' ,
			4 => 'MIERCOLES',
			5 => 'JUEVES' ,
			6 => 'VIERNES' ,
			7 => 'SABADO' ,
			1 => 'DOMINGO' ,
		);

		foreach ($days as $key => $value) {
			?>
			<tr >
				<td ><b><?php echo $value?></b></td>
				<td></td>
				<td ><input type="text" class="form-control text-center" data-mask="99:99" name="dia[<?php echo $key?>][desde]" placeholder="23:59" value="<?php echo (isset($listado[$key]['desde'])) ? substr($listado[$key]['desde'],0,5) : '' ;?>" ></td>
				<td ><input type="text" class="form-control text-center" data-mask="99:99" name="dia[<?php echo $key?>][hasta]" placeholder="23:59" value="<?php echo (isset($listado[$key]['hasta'])) ? substr($listado[$key]['hasta'],0,5) : '' ;?>" ></td>	
			</tr><?php
		}?>
		</tbody>
		</table>
	</div>


</form>