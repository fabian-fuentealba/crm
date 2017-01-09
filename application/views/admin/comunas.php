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
	<h1> <b> Comunas </b><small> <?php echo strtolower($region['region'])?></small></h1>
</div>

<a href="<?php echo site_url('admin/regiones/' . $region['id_pais'])?>" class="btn btn-default btn-sm">  <i class="fa fa-arrow-left"></i> SALIR </a>
<a href="<?php echo site_url(uri_string())?>" class="btn btn-default btn-sm"> <i class="fa fa-retweet"></i> </a>
<a data-url="<?php echo site_url("admin/agregar-comuna/" . $region['id_region'] )?>" class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModal" data-title="AGREGAR COMUNA" > <i class="fa fa-plus-square"></i> AGREGAR COMUNA </a>

<br><br>
<div class="table-responsive">
	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th>#</th>
				<th>COMUNA</th>
				<th>ESTADO</th>
				<th>EDITAR</th>
				<th>ELIMINAR</th>
			</tr>
		</thead>
		<tbody><?php
		foreach ($comunas as $key => $value) {
			?>
			<tr>
				<td><b><?php echo ( $key + 1 )?></b></td>
				<td><?php echo $value['comuna']?></td>
				<td ><?php echo ($value['estado']) ? '<i class="fa fa-check-square-o text-success"></i>':'<i class="fa fa-square-o text-danger"></i>'?></td>
				<td ><a data-url="<?php echo site_url('admin/editar-comuna/'.$value['id_comuna'])?>" data-toggle="modal" data-target="#myModal" class="btn btn-primary btn-xs" data-title="MODIFICAR COMUNA"> <i class="fa fa-pencil-square-o"></i> </a></td>
				<td ><input type="checkbox" value="<?php echo $value['id_comuna']?>"></td>
			</tr><?php
		}?>
		</tbody>
	</table>
</div>
