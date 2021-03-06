<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" style="font-weight:bold;"></h4>
          </div>
          <div class="modal-body">
              <p>...</p>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">CERRAR</button>
              <button type="button" id="save" class="btn btn-success">GUARDAR</button>
          </div>
        </div>
    </div>
</div>

<div class="page-header">
	<h1> <b> Paises</b> <small> listado general</small></h1>
</div>

<a href="<?php echo site_url('admin/parametros')?>" class="btn btn-default btn-sm"> <i class="fa fa-arrow-left"></i> SALIR</a>
<a href="<?php echo site_url(uri_string())?>" class="btn btn-default btn-sm"> <i class="fa fa-retweet"></i> </a>
<a data-url="<?php echo site_url("admin/agregar-pais")?>" class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModal" data-title="AGREGAR PAIS" > <i class="fa fa-plus-square"></i> AGREGAR PAIS </a>

<br><br>
<div class="table-responsive">
	<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th>#</th>
			<th>PAIS </th>
			<th>NIC </th>
			<th>ESTADO</th>
			<th>REGIONES</th>
			<th>EDITAR</th>
			<th>ELIMINAR</th>
		</tr>
	</thead><?php
	foreach ($paises as $key => $value) {
		?>
		<tr>
			<td align="center"><b><?php echo ( $key + 1 )?></b></td>
			<td><i class="flag-icon flag-icon-<?php echo $value['nic']?>"></i> <?php echo $value['pais']?></td>
			<td><?php echo $value['nic']?></td>
			<td ><?php echo ($value['estado']) ? '<i class="fa fa-check-square-o text-success"></i>':'<i class="fa fa-square-o text-danger"></i>'?></td>
			<td ><a href="<?php echo site_url('admin/regiones/' . $value['id_pais'])?>" class="btn btn-primary btn-xs"> <i class="fa fa-bars"></i> </a></td>
			<td ><a data-url="<?php echo site_url('admin/editar-pais/' . $value['id_pais'])?>" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal" data-title="MODIFICAR PAIS" > <i class="fa fa-pencil-square-o"></i> </a></td>
			<td ><input type="checkbox" value="<?php echo $value['id_pais']?>"></td>
		</tr><?php
	}?>
	</table>
</div>
