<div class="page-header">
	<h1> <b> Usuarios</b> <small> lugares de atención</small></h1>
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
				<th>LUGAR</th>
				<th></th>
				<th>SI / NO </th>			
			</tr>
		</thead>
		<tbody><?php
		foreach ($lugares as $key => $value) {
			?>
			<tr >
				<td align="center"><b><?php echo $key + 1 ?></b></td>
				<td><?php echo $value['lugar']?></td>
				<td><?php echo (is_numeric($value['id_rel_usu_lug']))?'<span class="label label-success">ACTIVO</span>':'<span class="label label-danger">INACTIVO</span>';?></td>
				<td><input type="checkbox" name="lugar[]" value="<?php echo $value['id_lugar']?>" <?php echo (is_numeric($value['id_rel_usu_lug']))?'checked':'';?> ></td>			
			</tr><?php
		}?>
		</tbody>
		</table>
	</div>
</form>
 