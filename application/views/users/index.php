<div class="modal fade" id="myModal2">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">         
          <div class="modal-body">
              <p>...</p>
          </div>          
        </div>
    </div>
</div>

<div class="page-header">
  <h1> <i class="fa fa-users"></i> Usuarios  <small> listado general </small></h1>
</div>

<?php echo form_open()?>

	<div class="form-group">
		<div class="input-group input-group-sm">
			<span class="input-group-btn">
				<a href="<?php echo site_url("users/agregar")?>" class="btn btn-default"> <i class="fa fa-user-plus"></i> AGREGAR USUARIO </a>
			</span>
			<input type="text" class="form-control" name="buscar" placeholder="BUSCAR POR ...">
			<span class="input-group-btn">
				<button class="btn btn-default"> <i class="fa fa-search"></i> </button>
			</span>
	    </div>
	</div>	
</form>

<br>

<div class="table-responsive">
	<table class="table table-hover table-striped">
	<thead>
		<tr>
			<th>#</th>
			<th>NOMBRES / APELLIDOS </th>
			<th class="hidden-xs" >ROL</th>
			<th>MENU</th>					
			<th class="hidden-xs">ELIMINAR</th>
		</tr>
	</thead>
	<tbody><?php
		foreach ($listado as $key => $value) {
			?>
			<tr>
				<td align="center"><b><?php echo $key + 1 ?></b></td>
				<td><?php echo $value['nombre']?> <?php echo $value['apellido']?> 
					<span class="label label-default pull-right"><?php echo $value["posicion"]?></span>
					<?php echo ($value['estado'] == 1 ) ? '<span class="label label-default pull-right">ACTIVO</span>' : '' ;?>
				</td>
				<td class="hidden-xs"><?php echo $value['rol']?></td>
				<td >  
					<a data-url="<?php echo site_url('users/menu/'. $value['id_usuario'])?>" data-toggle="modal" data-target="#myModal2" data-title="Opciones" class="btn btn-default btn-xs" > <i class="fa fa-ellipsis-h" aria-hidden="true"></i> </a>
				</td>					
				<td class="hidden-xs"><input type="checkbox" name="eliminar[]" value="<?php echo $value['id_usuario']?>"></td>
			</tr><?php
		}?>
	</tbody>
	</table>
</div>
 