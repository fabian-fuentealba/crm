<?php echo form_open(NULL, array('class'=> 'form-horizontal'))?>

	<?php echo (validation_errors())?'<div class="alert alert-warning"><ul>'.validation_errors('<li>','</li>').'</ul></div>':''; ?>
	<?php echo $this->session->flashdata("message")?>

	<div class="form-group">
		<label class="col-md-3 label-control">ANTES  </label>
		<div class="col-md-9">
			<div class="input-group">
 				<span class="input-group-addon" id="basic-addon1"> <i class="fa fa-usd"></i> </span>
	    		<input type="text" name="antes" class="form-control" value="<?php echo set_value("antes")?>" placeholder="30000" >
	    	</div>
	    </div>			   
	</div>

	<div class="form-group">
		<label class="col-md-3 label-control">AHORA   <i class="fa fa-asterisk text-primary"></i> </label>
		<div class="col-md-9">
			<div class="input-group">
 				<span class="input-group-addon" id="basic-addon1"> <i class="fa fa-usd"></i> </span>
	    		<input type="text" name="ahora" class="form-control" value="<?php echo set_value("ahora")?>" placeholder="30000" >
	    	</div>
	    </div>			   
	</div>

	<div class="form-group">
		<label class="col-md-3 label-control"> SERVICIO </label>
		<div class="col-md-9">
	    	<input type="text" name="duracion" class="form-control" value="<?php echo set_value("duracion")?>" placeholder="EJEMPLO : SERVICIO NORMAL" >
	    </div>			   
	</div>
	
</form>
