<?php echo form_open(NULL, array('class'=> 'form-horizontal'))?>

	<?php echo (validation_errors())?'<div class="alert alert-warning"><ul>'.validation_errors('<li>','</li>').'</ul></div>':''; ?>
	<?php echo $this->session->flashdata("message")?>			
	
	<div class="form-group">
		<label class="col-md-2 label-control">Comuna</label>
		<div class="col-md-10">
	    	<input type="text" class="form-control" name="comuna" value="<?php echo $comuna['comuna']?>" autocomplete="off" placeholder="SANTIAGO">
	    </div>
	</div>			

	<div class="form-group">
		<label class="col-md-2 label-control">Estado</label>
		<div class="col-md-10">
			<div class="checkbox">
				<label>
					<input type="checkbox" name="estado" value="1" <?php echo ($comuna['estado'])?'checked':'';?> > Activo / Inactivo 
				</label>
			</div>
		</div>
	</div>

</form>
