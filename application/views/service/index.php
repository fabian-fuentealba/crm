<div class="page-header">
	<h1> <i class="fa fa-asterisk" aria-hidden="true"></i> Servicios <small> listado general</small></h1>
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
				<th>NORMAL</th>
				<th>ADICIONAL</th>	
				<th>DESACTIVAR</th>
			</tr>
		</thead>
		<tbody><?php
		foreach ($servicios as $key => $value) {
			?>
			<tr >
				<td align="center"><b><?php echo $key + 1 ?></b></td>
				<td><?php echo $value['servicio']?></td>
				<td><?php echo (is_numeric($value['id_rel_usu_ser']))?'<span class="label label-default">ACTIVO</span>':'';?></td>
				<td>
					<input type="radio" name="servicio[<?php echo $value['id_servicio']?>]" value="normal" <?php echo (is_numeric($value['normal']))?'checked':'';?> >					
				</td>	
				<td>
					<input type="radio" name="servicio[<?php echo $value['id_servicio']?>]" value="adicional" <?php echo (is_numeric($value['adicional']))?'checked':'';?> >
				</td>
				<td>
					<input type="radio" name="servicio[<?php echo $value['id_servicio']?>]"  >
				</td>	
			</tr><?php
		}?>
		</tbody>
		</table>
	</div>
</form>
 