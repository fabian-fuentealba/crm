<div class="page-header">
	<h1> Categorias <small> listado general</small></h1>
</div>

<?php echo form_open()?>
	<a href="<?php echo site_url('admin/parametros')?>" class="btn btn-default btn-sm"> <i class="fa fa-arrow-left"></i> SALIR</a>
	<a href="<?php echo site_url(uri_string())?>" class="btn btn-default btn-sm"> <i class="fa fa-retweet"></i> </a>
	<a data-url="<?php echo site_url("categories/agregar")?>" class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModal" data-title="AGREGAR CATEGORIA" > <i class="fa fa-plus-square"></i> AGREGAR CATEGORIA </a>
	<button class="btn btn-danger btn-sm">ELIMINAR SELECCIONADOS</button>
	<br><br>

	<div class="table-responsive">
		<table class="table table-hover table-striped">
		<thead>
			<tr>
				<th>#</th>
				<th>CATEGORIA</th>
				<th>EDITAR</th>
				<th>ESTADO</th>
				<th>ELIMINAR</th>		
			</tr>
		</thead><?php
		foreach ($categorias as $key => $value) {
			?>
			<tr >
				<td align="center"><b><?php echo $key + 1 ?></b></td>
				<td><?php echo $value['categoria']?></td>
				<td ><a data-url="<?php echo site_url('categories/editar/' . $value['id_categoria'])?>" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal" data-title="MODIFICAR CATEGORIA" > <i class="fa fa-pencil-square-o"></i> </a></td>
				<td><?php echo ($value['estado'] == 1)?'<span class="label label-success">ACTIVO</span>':'<span class="label label-danger">INACTIVO</span>'?></td>
				<td><input type="checkbox" name="eliminar[]" value="<?php echo $value['id_categoria']?>"></td>
			</tr><?php
		}?>
		</table>
	</div>
</form>
 