<?php echo form_open(NULL)?>

	<?php echo (validation_errors())?'<div class="alert alert-warning"><ul>'.validation_errors('<li>','</li>').'</ul></div>':''; ?>
	<?php echo $this->session->flashdata("message")?>
	<input type="hidden" name="send" value="1">
	<ul class="list-group" style="margin-bottom:0;"><?php
	foreach ($sitios as $key => $value) {
		?>
		<li class="list-group-item" style="padding-top:8px;padding-bottom:8px">		    			
			<input type="checkbox" name="sitio[]" value="<?php echo $value['id_sitio']?>" <?php echo (in_array($value['id_sitio'],$rel_fotos))?'checked':'';?> > <?php echo $value['nombre']?>							
		</li><?php
	}?>				
	</ul>
</form>