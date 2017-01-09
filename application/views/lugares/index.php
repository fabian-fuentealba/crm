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
	<h1> <b> Lugares</b> <small> listado general</small></h1>
</div>

<?php echo form_open()?>
	<a href="<?php echo site_url('admin/parametros')?>" class="btn btn-default btn-sm"> <i class="fa fa-arrow-left"></i> SALIR</a>
	<a href="<?php echo site_url(uri_string())?>" class="btn btn-default btn-sm"> <i class="fa fa-retweet"></i> </a>
	<a data-url="<?php echo site_url("locations/agregar")?>" class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModal" data-title="AGREGAR LUGAR" > <i class="fa fa-plus-square"></i> AGREGAR LUGAR </a>
	<button class="btn btn-danger btn-sm">ELIMINAR SELECCIONADOS</button>
	<br><br>

	<div class="table-responsive">
		<table class="table table-hover table-striped">
		<thead>
			<tr>
				<th>#</th>
				<th>LUGAR</th>
				<th>EDITAR</th>
				<th>ESTADO</th>
				<th>ELIMINAR</th>		
			</tr>
		</thead><?php
		foreach ($lugares as $key => $value) {
			?>
			<tr >
				<td align="center"><b><?php echo $key + 1 ?></b></td>
				<td><?php echo $value['lugar']?></td>
				<td ><a data-url="<?php echo site_url('locations/editar/' . $value['id_lugar'])?>" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal" data-title="MODIFICAR LUGAR" > <i class="fa fa-pencil-square-o"></i> </a></td>
				<td><?php echo ($value['estado'] == 1)?'<span class="label label-success">ACTIVO</span>':'<span class="label label-danger">INACTIVO</span>'?></td>
				<td><input type="checkbox" name="eliminar[]" value="<?php echo $value['id_lugar']?>"></td>
			</tr><?php
		}?>
		</table>
	</div>
</form>
 