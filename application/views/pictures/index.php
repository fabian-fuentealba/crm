
<div class="modal fade" id="myModal2">
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
  <h1> <i class="fa fa-camera" aria-hidden="true"></i> Fotos <small> listado general </small></h1>
</div>
<?php echo form_open()?>
  <a href="<?php echo site_url('users')?>" class="btn btn-default btn-sm"> <i class="fa fa-arrow-left"></i> SALIR</a>
  <a href="<?php echo site_url(uri_string())?>" class="btn btn-default btn-sm"> <i class="fa fa-retweet"></i> </a>
  <a data-url="<?php echo site_url("pictures/agregar/" . $this->uri->segment(3))?>" class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModal4" data-title="Fotos <small>agregar</small>" > <i class="fa fa-plus-square"></i> AGREGAR FOTO </a>
  <button class="btn btn-danger btn-sm">ELIMINAR SELECCION</button>
  <br><br>

	<div class="table-responsive">
  		<table class="table table-striped table-hover ">
      		<thead>
      			<tr>				
      				<th>FOTO</th>      			
      				<th>SITIO</th>
    				<th>ELIMINAR</th>
    			</tr>
    		</thead><?php
    		foreach ($fotos as $key => $value) {
    			?>
    			<tr class="<?php echo ($value['es_perfil']) ? 'danger':'';?> " >							
    				<td >          
                <a data-url="<?php echo base_url('assets/uploads/' . $value['id_sitio'] . '/' . $value['id_usuario'] . '/' . $value['imagen'])?>" data-toggle="modal" data-target="#myModal3" data-title="Fotos <small><?php echo ($value['es_perfil']) ? 'perfil':'galeria';?></small>" style="cursor:pointer" > <b>FOTO <?php echo ( $key + 1 )?> </b> <span class="label label-primary pull-right"> <?php echo $value['tamano']?> kb</span>
                </a>
            </td>    			
    				<td ><?php echo $value['nombre']?></td>
    				<td ><input type="checkbox" name="eliminar[]" value="<?php echo $value['id_foto']?>"></td>
    			</tr><?php
    		}?>
  		</table>
	</div>
</form>
