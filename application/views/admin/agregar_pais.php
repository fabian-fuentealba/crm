<?php echo form_open(NULL, array('class'=> 'form-horizontal'))?>

	<?php echo (validation_errors())?'<div class="alert alert-warning"><ul>'.validation_errors('<li>','</li>').'</ul></div>':''; ?>
	<?php echo $this->session->flashdata("message")?>			
	
	<div class="form-group">
		<label class="col-md-2 label-control">Pais</label>
		<div class="col-md-10">
	    	<input type="text" class="form-control" name="pais" autocomplete="off" value="<?php echo set_value('pais')?>" placeholder="CHILE">
	    </div>
	</div>

	<div class="form-group">
		<label class="col-md-2 label-control">Nic</label>
		<div class="col-md-10">
	    	<input type="text" class="form-control" name="nic" autocomplete="off" value="<?php echo set_value('nic')?>" placeholder="cl">
	    </div>
	</div>

	<div class="form-group">
		<label class="col-md-2 label-control">Estado</label>
		<div class="col-md-10">
			<div class="checkbox">
				<label>
				<input type="checkbox" name="estado" value="1"> Activo / Inactivo
				</label>
			</div>
		</div>
	</div>

</form>