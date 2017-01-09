<?php echo form_open(NULL, array('class'=> 'form-horizontal'))?>

	<?php echo (validation_errors())?'<div class="alert alert-warning"><ul>'.validation_errors('<li>','</li>').'</ul></div>':''; ?>
	<?php echo $this->session->flashdata("message")?>

	<div class="form-group">
		<label class="col-md-3 label-control">SITIOS </label>
		<div class="col-md-9">

			<table class="table table-bordered" style="margin-bottom: 0 ">
				<tbody><?php
					foreach ($sitios as $key => $value) {
						if( in_array($value['id_sitio'] , $rel_sitios ) ){
							?>
							<tr>
								<th><?php echo $value['nombre']?></th>
			    			</tr><?php
						}
			    	}?>					
				</tbody>
			</table>
			
	    </div>
	</div>

	<div class="form-group">
		<label class="col-md-3 label-control">ROL </label>
		<div class="col-md-9">
			<p class="form-control-static"> <b><?php echo $usuario['rol']?></b> </p>	
	    </div>
	</div>	
  
	<div class="form-group">
		<label class="col-md-3 label-control"> NOMBRES </label>
		<div class="col-md-9">
	    	<input type="text" class="form-control" name="nombres" value="<?php echo $usuario['nombre']?>" placeholder="NOMBRES">
	    </div>
	</div>

	<div class="form-group">
		<label class="col-md-3 label-control"> APELLIDOS </label>
		<div class="col-md-9">
	    	<input type="text" class="form-control" name="apellidos" value="<?php echo $usuario['apellido']?>" placeholder="APELLIDOS">
	    </div>
	</div>

	<div class="form-group">
		<label class="col-md-3 label-control">F. NACIMIENTO <i class="fa fa-asterisk text-primary"></i> </label>
		<div class="col-md-3">
	    	<input type="text" class="form-control date" name="f_nacimiento" value="<?php echo $usuario['fecha_nacimiento']?>" placeholder="09/12/9999" >
	    </div>
	    <div class="col-md-6">
	    	<p><?php echo $usuario['edad']?> años</p>
	    </div>
	</div>

	<div class="form-group">
		<label class="col-md-3 label-control"> CORREO </label>
		<div class="col-md-9">
	    	<input type="text" class="form-control" name="correo" value="<?php echo $usuario['email']?>" placeholder="Correo">
	    </div>
	</div>

	<div class="form-group">
		<label class="col-md-3 label-control"> TELÉFONO FIJO </label>
		<div class="col-md-9">
	    	<input type="text" class="form-control" name="telefono_fijo" value="<?php echo $usuario['fijo']?>" data-mask="+(99) 9 9999 99 99" placeholder="+(56) 9 6556 66 66">
	    </div>
	</div>

	<div class="form-group">
		<label class="col-md-3 label-control"> TELEF. CELULAR <i class="fa fa-asterisk text-primary"></i> </label>
		<div class="col-md-9">
	    	<input type="text" class="form-control" name="telefono_celular" value="<?php echo $usuario['celular']?>" data-mask="+(99) 9 9999 99 99" placeholder="+(56) 9 6556 66 66">
	    </div>
	</div>

	<div class="form-group">
		<label class="col-md-3 label-control"> SEXO <i class="fa fa-asterisk text-primary"></i> </label>
		<div class="col-md-9">
	    	<select class="form-control" name="sexo">
		    	<optgroup label="Sexos">
		    		<option value="1" <?php echo ($usuario['sexo'] == 1 )?'selected':'';?> >HOMBRE</option>
		    		<option value="0" <?php echo ($usuario['sexo'] == 0 )?'selected':'';?> >MUJER</option>
		    	</optgroup>
	    	</select>
	    </div>
	</div>

	<div class="form-group">
		<label class="col-md-3 label-control"> USUARIO </label>
		<div class="col-md-5">
			<input type="text" class="form-control" name="usuario" value="<?php echo $usuario['usuario']?>" placeholder="USUARIO">
	    </div>
	</div>

	<div class="form-group">
		<label class="col-md-3 label-control"> PASSWORD </label>
		<div class="col-md-5">
	    	<input type="password" class="form-control" name="password" value="" placeholder="PASSWORD">
	    </div>
	</div>

</form>