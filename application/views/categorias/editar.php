<?php echo form_open(NULL, array('class'=> 'form-horizontal'))?>

	<?php echo (validation_errors())?'<div class="alert alert-warning"><ul>'.validation_errors('<li>','</li>').'</ul></div>':''; ?>
	<?php echo $this->session->flashdata("message")?>			
	
	<div class="form-group">
		<label class="col-md-2 label-control">Categoria</label>
		<div class="col-md-10">
	    	<input type="text" class="form-control" name="categoria" autocomplete="off" value="<?php echo $categoria['categoria']?>" >
	    </div>
	</div>

	<div class="form-group">
		<label class="col-md-2 label-control">Controllador</label>
		<div class="col-md-10">
	    	<input type="text" class="form-control" name="controlador" autocomplete="off" value="<?php echo $categoria['controlador']?>" >
	    </div>
	</div>

	<div class="form-group">
		<label class="col-md-2 label-control">Estado</label>
		<div class="col-md-10">
			<div class="checkbox">
				<label>
				<input type="checkbox" name="estado" value="1" <?php echo ($categoria['estado'])?'checked':'';?> > Activo / Inactivo
				</label>
			</div>
		</div>
	</div>
</form>