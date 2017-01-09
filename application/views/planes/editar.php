<?php echo form_open(NULL, array('class'=> 'form-horizontal'))?>

	<?php echo (validation_errors())?'<div class="alert alert-warning"><ul>'.validation_errors('<li>','</li>').'</ul></div>':''; ?>
	<?php echo $this->session->flashdata("message")?>

	<div class="form-group">
		<label class="col-md-2 label-control">Plan <i class="fa fa-asterisk text-primary"></i> </label>
		<div class="col-md-10">
	    	<input type="text" name="plan" class="form-control" value="<?php echo $plan["plan"]?>" placeholder="Nombre del plan" >
	    </div>			   
	</div>

	<div class="form-group">
		<label class="col-md-2 label-control">Lugar <i class="fa fa-asterisk text-primary"></i> </label>
		<div class="col-md-10">
	    	<input type="text" name="lugar" class="form-control" value="<?php echo $plan["lugar"]?>" placeholder="Posicion al listar clientes" >
	    </div>			   
	</div>

	<div class="form-group">
		<label class="col-md-2 label-control">Valor <i class="fa fa-asterisk text-primary"></i> </label>
		<div class="col-md-10">
			<div class="input-group">
  				<span class="input-group-addon" >$</span>
	    		<input type="text" name="valor" maxlength="6" class="form-control" value="<?php echo $plan["valor"]?>" placeholder="Valor" >
	    	</div>
	    </div>			   
	</div>

	<div class="form-group">
		<label class="col-md-2 label-control">Durac. <i class="fa fa-asterisk text-primary"></i> </label>
		<div class="col-md-2">
	    	<input type="text" maxlength="3" name="duracion" class="form-control" value="<?php echo $plan["duracion"]?>" placeholder="Duracion en dias del plan" >
	    </div>
	    <div class="col-md-8">
	    	<p class="label label-primary">Dias</p>
	    </div>		   
	</div>

	<div class="form-group">
		<label class="col-md-2 label-control">Estado</label>
		<div class="col-md-10">
			<div class="checkbox">
				<label>
				<input type="checkbox" name="estado" value="1" <?php echo ($plan['estado'])?'checked':'';?> > Activo / Inactivo
				</label>
			</div>
		</div>
	</div>
	
</form>