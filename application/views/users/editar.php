<div class="page-header">
  <h1> <i class="fa fa-users"></i> Usuarios  <small> datos personales </small></h1>
</div>

<a href="<?php echo site_url('users')?>" class="btn btn-default btn-sm"> <i class="fa fa-arrow-left"></i> SALIR</a>

<br><br>

<?php echo form_open(NULL, array('class'=> 'form-horizontal'))?>

	<?php echo (validation_errors())?'<div class="alert alert-warning"><ul>'.validation_errors('<li>','</li>').'</ul></div>':''; ?>
	<?php echo $this->session->flashdata("message")?>

	<div class="form-group">
		<label class="col-md-2 label-control"> SITIO  <i class="fa fa-asterisk text-primary"></i> </label>
		<div class="col-md-10">
			<ul class="list-group" style="margin-bottom:0;"><?php
				foreach ($sitios as $key => $value) {
		    		?>
		    		<li class="list-group-item" style="padding-top:8px;padding-bottom:8px">
						<input type="checkbox" name="sitio[]" value="<?php echo $value['id_sitio']?>" <?php echo (in_array($value['id_sitio'],$rel_sitios))?'checked':'';?> > <?php echo $value['nombre']?>
		    		</li><?php
		    	}?>
			</ul>
	    </div>
	</div><?php
	if(!in_array($this->session->userdata("id_rol"),array(1,3))){
		?>
		<div class="form-group">
			<div class="col-md-offset-2 col-md-10">
				<div class="alert alert-warning" style="margin-bottom:0;">Ud no tiene permisos para asignar roles</div>
			</div>
		</div><?php
	}?>
	<div class="form-group">
		<label class="col-md-2 label-control">ROL <i class="fa fa-asterisk text-primary"></i></label>
		<div class="col-md-10">
	    	<select class="form-control" name="rol" >
	    		<option value=""></option>
		    	<optgroup label="Roles"><?php
		    	foreach ($roles as $key => $value) {
		    		?>
		    		<option value="<?php echo $value['id_rol']?>" <?php echo ($usuario['id_rol'] == $value['id_rol'])?'selected':'';?> ><?php echo $value['rol']?></option><?php
		    	}?>
		    	</optgroup>
	    	</select>
	    </div>
	</div>

	<div class="form-group">
		<label class="col-md-2 label-control"> ESTADO</label>
		<div class="col-md-10">
			<div class="checkbox">
				<label>
				<input type="checkbox" name="estado" value="1" <?php echo ($usuario['estado'])?'checked':'';?> > Activo / Inactivo
				</label>
			</div>
		</div>
	</div>
  
	<div class="form-group">
		<label class="col-md-2 label-control"> NOMBRES </label>
		<div class="col-md-10">
	    	<input type="text" class="form-control" name="nombres" value="<?php echo $usuario['nombre']?>" placeholder="Nombres">
	    </div>
	</div>

	<div class="form-group">
		<label class="col-md-2 label-control"> APELLIDOS </label>
		<div class="col-md-10">
	    	<input type="text" class="form-control" name="apellidos" value="<?php echo $usuario['apellido']?>" placeholder="Apellidos">
	    </div>
	</div>

	<div class="form-group">
		<label class="col-md-2 label-control">F. NACIMIENTO <i class="fa fa-asterisk text-primary"></i> </label>
		<div class="col-md-2">
	    	<input type="text" class="form-control date" name="f_nacimiento" value="<?php echo $usuario['fecha_nacimiento']?>" placeholder="09/12/9999" readonly>
	    </div>
	    <div class="col-md-2">
	    	<p><?php echo $usuario['edad']?> años</p>
	    </div>
	</div>

	<div class="form-group">
		<label class="col-md-2 label-control"> CORREO </label>
		<div class="col-md-10">
	    	<input type="text" class="form-control" name="correo" value="<?php echo $usuario['email']?>" placeholder="Correo">
	    </div>
	</div>

	<div class="form-group">
		<label class="col-md-2 label-control">TELEFONO FIJO </label>
		<div class="col-md-10">
	    	<input type="text" class="form-control" name="telefono_fijo" value="<?php echo $usuario['fijo']?>" data-mask="+(99) 9 9999 99 99" placeholder="+(56) 9 6556 66 66">
	    </div>
	</div>

	<div class="form-group">
		<label class="col-md-2 label-control">TELEF. CELULAR </label>
		<div class="col-md-10">
	    	<input type="text" class="form-control" name="telefono_celular" value="<?php echo $usuario['celular']?>" data-mask="+(99) 9 9999 99 99" placeholder="+(56) 9 6556 66 66">
	    </div>
	</div>

	<div class="form-group">
		<label class="col-md-2 label-control"> SEXO <i class="fa fa-asterisk text-primary"></i> </label>
		<div class="col-md-10">
	    	<select class="form-control" name="sexo">
		    	<optgroup label="Sexos">
		    		<option value="1" <?php echo ($usuario['sexo'] == 1 )?'selected':'';?> >HOMBRE</option>
		    		<option value="0" <?php echo ($usuario['sexo'] == 0 )?'selected':'';?> >MUJER</option>
		    	</optgroup>
	    	</select>
	    </div>
	</div>

	<div class="form-group">
		<label class="col-md-2 label-control"> PAIS <i class="fa fa-asterisk text-primary"></i> </label>
		<div class="col-md-10">
	    	<select class="form-control" name="pais" id="pais">
	    		<option value=""></option>
		    	<optgroup label="Paises"><?php
		    	foreach ($paises as $key => $value) {
		    		?>
		    		<option value="<?php echo $value['id_pais']?>" <?php echo ($usuario['id_pais'] == $value['id_pais'])?'selected':'';?> ><?php echo $value['pais']?></option><?php
		    	}?>
		    	</optgroup>
	    	</select>
	    </div>
	</div> <?php
	
	if($this->session->userdata("id_rol") == 4 AND $usuario["id_rol"] != 2 AND ( $this->session->userdata("id_usuario") != $usuario["id_usuario"] )){

	}else{
		?>
		<hr>
		<div class="form-group">
			<label class="col-md-2 label-control"> USUARIO </label>
			<div class="col-md-4">
				<div class="input-group">
						<span class="input-group-addon" id="basic-addon1"> <i class="fa fa-user"></i> </span>
		    		<input type="text" class="form-control" name="usuario" value="<?php echo $usuario['usuario']?>" placeholder="Usuario">
		    	</div>
		    </div>
		</div>

		<div class="form-group">
			<label class="col-md-2 label-control"> PASSWORD </label>
			<div class="col-md-4">
		    	<input type="password" class="form-control" name="password" value="" placeholder="Password">
		    </div>
		</div><?php
	}?>

	<div class="form-group">
		<div class="col-md-4 col-md-offset-2">
	    	<button class="btn btn-success"> GUARDAR CAMBIOS </button>
	    </div>
	</div>

</form>
