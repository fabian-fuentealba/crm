<div class="page-header">
	<h1> <i class="fa fa-bookmark" aria-hidden="true"></i> Planes<small> listado general</small></h1>
</div>

<a href="<?php echo site_url('admin/parametros')?>" class="btn btn-default btn-sm"> <i class="fa fa-arrow-left"></i> SALIR</a>
<a href="<?php echo site_url(uri_string())?>" class="btn btn-default btn-sm"> <i class="fa fa-retweet"></i> </a>
<a data-url="<?php echo site_url("plans/agregar")?>" class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModal" data-title="Planes <small>agregar</small>" > <i class="fa fa-plus-square"></i> AGREGAR PLAN </a>

<br><br>
<div class="table-responsive">
	<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th>#</th>
			<th>PLAN </th>			
			<th>VALOR ($)</th>			
			<th>EDITAR</th>
			<th>ELIMINAR</th>
		</tr>
	</thead><?php
	foreach ($planes as $key => $value) {
		?>
		<tr>
			<td><b><?php echo ( $key + 1 )?></b></td>
			<td><?php echo $value['plan']?></td>			
			<td>$ <?php echo $value['valor']?></td>			
			<td ><a data-url="<?php echo site_url('plans/editar/' . $value['id_plan'])?>" class="btn btn-default btn-xs" data-toggle="modal" data-target="#myModal" data-title="Planes <small>editar</small>" > <i class="fa fa-pencil-square-o"></i> </a></td>
			<td ><input type="checkbox" value="<?php echo $value['id_plan']?>"></td>
		</tr><?php
	}?>
	</table>
</div>
