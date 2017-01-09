<div class="page-header">
	<h1> <b> Usuarios</b> <small> servicios</small></h1>
</div>

<?php echo form_open()?>
	<a href="<?php echo site_url('users')?>" class="btn btn-default btn-sm"> <i class="fa fa-arrow-left"></i> SALIR</a>
	<a href="<?php echo site_url(uri_string())?>" class="btn btn-default btn-sm"> <i class="fa fa-retweet"></i> </a>
	<button class="btn btn-success btn-sm">GUARDAR CAMBIOS</button>
	<br><br>

	<div class="table-responsive">
		<table class="table table-hover table-striped">
		<thead>
			<tr>
				<th>#</th>
				<th>SERVICIO</th>
				<th></th>
				<th>SI / NO </th>			
			</tr>
		</thead><?php
		foreach ($servicios as $key => $value) {
			?>
			<tr >
				<td align="center"><b><?php echo $key + 1 ?></b></td>
				<td><?php echo $value['servicio']?></td>
				<td><?php echo (is_numeric($value['id_rel_usu_ser']))?'<span class="label label-success">ACTIVO</span>':'<span class="label label-danger">INACTIVO</span>';?></td>
				<td><input type="checkbox" name="servicio[]" value="<?php echo $value['id_servicio']?>" <?php echo (is_numeric($value['id_rel_usu_ser']))?'checked':'';?> ></td>			
			</tr><?php
		}?>
		</table>
	</div>
</form>
 