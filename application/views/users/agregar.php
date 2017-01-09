<div class="page-header">
  <h1> <i class="fa fa-users"></i> Usuarios <small> datos personales </small></h1>
</div>

<a href="<?php echo site_url('users')?>" class="btn btn-default btn-sm"> <i class="fa fa-arrow-left"></i> SALIR</a>
<br><br>

<?php echo form_open(NULL, array('class'=> 'form-horizontal'))?>

	<?php echo (validation_errors())?'<div class="alert alert-warning"><ul>'.validation_errors('<li>','</li>').'</ul></div>':''; ?>
	<?php echo $this->session->flashdata("message")?>

	<div class="form-group">
		<label class="col-md-2 control-label"> SITIO  <i class="fa fa-asterisk text-primary"></i> </label>
		<div class="col-md-10">
			<ul class="list-group" style="margin-bottom:0;"><?php
				foreach ($sitios as $key => $value) {
		    		?>
		    		<li class="list-group-item" style="padding-top:8px;padding-bottom:8px">		    			
						<input type="checkbox" name="sitio[]" value="<?php echo $value['id_sitio']?>" <?php echo set_checkbox("sitio",$value['id_sitio'])?> > <?php echo $value['nombre']?>							
		    		</li><?php
		    	}?>				
			</ul>	    	
	    </div>
	</div>	

	<div class="form-group">
		<label class="col-md-2 control-label"> ROL <i class="fa fa-asterisk text-primary"></i> </label>
		<div class="col-md-10">
	    	<select class="form-control" name="rol">
	    		<option value=""></option>
		    	<optgroup label="Roles"><?php
		    	foreach ($roles as $key => $value) {
		    		?>
		    		<option value="<?php echo $value['id_rol']?>" <?php echo set_select('rol',$value['id_rol'])?> ><?php echo $value['rol']?></option><?php
		    	}?>				    		
		    	</optgroup>
	    	</select>
	    </div>
	</div>	
	
	<div class="form-group">
		<label class="col-md-2 control-label"> NOMBRES </label>
		<div class="col-md-10">
	    	<input type="text" class="form-control" name="nombres" value="<?php echo set_value('nombres')?>" placeholder="Nombres">
	    </div>
	</div>

	<div class="form-group">
		<label class="col-md-2 control-label"> APELLIDOS </label>
		<div class="col-md-10">
	    	<input type="text" class="form-control" name="apellidos" value="<?php echo set_value('apellidos')?>" placeholder="Apellidos">
	    </div>
	</div>

	<div class="form-group">
		<label class="col-md-2 control-label">F. NACIMIENTO <i class="fa fa-asterisk text-primary"></i> </label>
		<div class="col-md-3">
	    	<input type="text" class="form-control date" name="f_nacimiento" value="<?php echo set_value('f_nacimiento')?>" placeholder="9999-12-09" readonly>
	    </div>
	</div>

	<div class="form-group">
		<label class="col-md-2 control-label"> CORREO </label>
		<div class="col-md-10">
	    	<input type="text" class="form-control" name="correo" value="<?php echo set_value('correo')?>" placeholder="Correo">
	    </div>
	</div>			

	<div class="form-group">
		<label class="col-md-2 control-label">TELEFONO FIJO </label>
		<div class="col-md-10">
	    	<input type="text" class="form-control" name="telefono_fijo" value="<?php echo set_value('telefono_fijo')?>" data-mask="+(99) 9 9999 99 99" placeholder="+(56) 9 6556 66 66">
	    </div>
	</div>

	<div class="form-group">
		<label class="col-md-2 control-label">TELEF. CELULAR <i class="fa fa-asterisk text-primary"></i></label>
		<div class="col-md-10">
	    	<input type="text" class="form-control" name="telefono_celular" value="<?php echo set_value('telefono_celular')?>" data-mask="+(99) 9 9999 99 99" placeholder="+(56) 9 6556 66 66">
	    </div>
	</div>

	<div class="form-group">
		<label class="col-md-2 control-label"> SEXO  <i class="fa fa-asterisk text-primary"></i> </label>
		<div class="col-md-4">
	    	<select class="form-control" name="sexo">
	    		<option value=""></option>
		    	<optgroup label="Sexos">
		    		<option value="1" <?php echo set_select('sexo',1)?> >Hombre</option>
		    		<option value="0" <?php echo set_select('sexo',0)?> >Mujer</option>
		    	</optgroup>
	    	</select>
	    </div>
	</div>
	
	<div class="form-group">
		<label class="col-md-2 control-label"> PAIS <i class="fa fa-asterisk text-primary"></i> </label>
		<div class="col-md-10">
	    	<select class="form-control" name="pais" id="pais">
	    		<option value=""></option>
		    	<optgroup label="Paises"><?php
		    	foreach ($paises as $key => $value) {
		    		?>
		    		<option value="<?php echo $value['id_pais']?>" <?php echo set_select('pais',$value['id_pais'])?> ><?php echo $value['pais']?></option><?php
		    	}?>				    		
		    	</optgroup>
	    	</select>
	    </div>
	</div>
	<div class="form-group">
		<label class="col-md-2 control-label"> REGION <i class="fa fa-asterisk text-primary"></i> </label>
		<div class="col-md-10">
	    	<select class="form-control" name="region" id="region" data-selected="<?php echo set_value('region')?>">
	    		<option value=""></option>
		    	<optgroup label="Regiones">
		    		
		    	</optgroup>
	    	</select>
	    </div>
	</div>
	<div class="form-group">
		<label class="col-md-2 control-label"> COMUNA <i class="fa fa-asterisk text-primary"></i> </label>
		<div class="col-md-10">
	    	<select class="form-control" name="comuna" id="comuna" data-selected="<?php echo set_value('comuna')?>">
	    		<option value=""></option>
		    	<optgroup label="Comunas">
		    		
		    	</optgroup>
	    	</select>
	    </div>
	</div>


	<hr>
	<div class="form-group">
		<label class="col-md-2 control-label"> USUARIO </label>
		<div class="col-md-4">
			<div class="input-group">
					<span class="input-group-addon" id="basic-addon1"> <i class="fa fa-user"></i> </span>
	    		<input type="text" class="form-control" autocomplete="off" name="usuario" value="<?php echo set_value('usuario')?>" placeholder="Usuario">
	    	</div>
	    </div>
	</div>

	<div class="form-group">
		<label class="col-md-2 control-label"> PASSWORD </label>
		<div class="col-md-4">
			<div class="input-group">
				<span class="input-group-addon" id="basic-addon1"> ... </span>
	    		<input type="password" class="form-control" name="password" placeholder="Password">
	    	</div>	    	
	    </div>
	</div>
	

	<div class="form-group">				
		<div class="col-md-4 col-md-offset-2">
	    	<button class="btn btn-success"> GUARDAR </button>
	    </div>
	</div>

</form>