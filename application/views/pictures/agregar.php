<?php echo form_open_multipart(NULL, array('class'=> 'form-horizontal',"id"=>"form1"))?>

	<?php echo ($this->upload->display_errors())?'<div class="alert alert-warning"><ul>'.$this->upload->display_errors('<li>','</li>').'</ul></div>':''; ?>
	<?php echo (validation_errors())?'<div class="alert alert-warning"><ul>'.validation_errors('<li>','</li>').'</ul></div>':''; ?>
	<?php echo ($this->image_lib->display_errors())?'<div class="alert alert-warning"><ul>'.$this->image_lib->display_errors('<li>','</li>').'</ul></div>':''; ?>
	<?php echo $this->session->flashdata("message")?>

	<div class="form-group">
		<label class="col-md-2 label-control">FOTO <i class="fa fa-asterisk text-primary"></i> </label>
		<div class="col-md-10">
	    	<input type="file" class="form-control" id="userfile" name="userfile" >
	    </div>	    
	</div>

	<div class="form-group">
		<label class="col-md-2 label-control">SITIO <i class="fa fa-asterisk text-primary"></i> </label>
		<div class="col-md-10">
	    	<select class="form-control" name="sitio">
	    		<option value=""></option>
		    	<optgroup label="Sitios"><?php
		    	foreach ($sitios as $key => $value) {
		    		?>
		    		<option value="<?php echo $value['id_sitio']?>" <?php echo set_select('sitio',$value['id_sitio'])?> ><?php echo $value['nombre']?></option><?php
		    	}?>				    		
		    	</optgroup>
	    	</select>
	    </div>
	</div>

	<div class="form-group">
		<label class="col-md-2 label-control">¿ PERFIL ?</label>
		<div class="col-md-10">
			<div class="checkbox">
				<label>
				<input type="checkbox" name="perfil" value="1"> Si / No
				</label>
			</div>
		</div>
	</div>		

</form>