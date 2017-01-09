<div class="page-header">
  <h1> <i class="fa fa-credit-card" aria-hidden="true"></i>  Tarifas <small> listado </small></h1>
</div>
<?php echo form_open()?>
	
	<a href="<?php echo site_url(uri_string())?>" class="btn btn-default btn-sm"> <i class="fa fa-retweet"></i> </a>
	<a data-url="<?php echo site_url('account/ratesadd')?>" class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModal" data-title="Tarifas <small>agregar</small>" > <i class="fa fa-plus-square"></i> AGREGAR TARIFA </a>
	<button class="btn btn-danger btn-sm">ELIMINAR SELECCION</button>
	<br><br>
	
	<?php echo (validation_errors())?'<div class="alert alert-warning"><ul>'.validation_errors('<li>','</li>').'</ul></div>':''; ?>
	<?php echo $this->session->flashdata("message")?>
	<div class="table-responsive">
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th>ANTES / AHORA </th>
					<th>CONDICION</th>
					<th>ELIMINAR</th>
				</tr>
			</thead>
			<tbody><?php
			foreach ($tarifas as $key => $value) {
				?>
				<tr>
					<td align="center"><b><?php echo $key + 1?></b></td>
					<td><?php echo number_format($value['antes'],0,',','.')?> / <?php echo number_format($value['ahora'],0,',','.')?></td>
					<td><?php echo $value['condiciones']?></td>
					<td><input type="checkbox" name="eliminar[]" value="<?php echo $value['id_tarifa']?>" ></td>
				</tr><?php
			}?>
			</tbody>
		</table>
	</div>

</form>
