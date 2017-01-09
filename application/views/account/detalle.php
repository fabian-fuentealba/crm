<div class="page-header">
  <h1> <i class="fa fa-users"></i> Detalles <small> listado </small></h1>
</div>

	

<?php echo form_open(NULL, array('class'=> 'form-horizontal'))?>

	<?php echo (validation_errors())?'<div class="alert alert-warning"><ul>'.validation_errors('<li>','</li>').'</ul></div>':''; ?>
	<?php echo $this->session->flashdata("message")?>

	

	<input type="hidden" name="pais" id="pais" value="1" >

	<div class="form-group">
		<label class="col-md-2 label-control">REGION <i class="fa fa-asterisk text-primary"></i> </label>
		<div class="col-md-10">
	    	<select class="form-control" name="region" id="region" data-selected="<?php echo $usuario['id_region']?>">
	    		<option value=""></option>
		    	<optgroup label="Regiones">

		    	</optgroup>
	    	</select>
	    </div>
	</div>

	<div class="form-group">
		<label class="col-md-2 label-control">COMUNA <i class="fa fa-asterisk text-primary"></i> </label>
		<div class="col-md-10">
	    	<select class="form-control" name="comuna" id="comuna" data-selected="<?php echo $usuario['id_comuna']?>">
	    		<option value=""></option>
		    	<optgroup label="Comunas">

		    	</optgroup>
	    	</select>
	    </div>
	</div>

	<div class="form-group">
		<label class="col-md-2 label-control">CATEGORIA </label>
		<div class="col-md-10">
			<p class="form-control-static"> <b><?php echo $usuario['categoria']?></b></p>	    	
	    </div>
	</div>	

	<div class="form-group">
		<label class="col-md-2 label-control">PAIS ORIGEN <i class="fa fa-asterisk text-primary"></i> </label>
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
	</div>

	<div class="form-group">
		<label class="col-md-2 label-control">ALIAS <i class="fa fa-asterisk text-primary"></i> </label>
		<div class="col-md-10">
	    	<input type="text" class="form-control" name="alias" value="<?php echo $usuario['alias']?>" placeholder="Alias">
	    </div>
	</div>

	<div class="form-group">
		<label class="col-md-2 label-control">TELEFONO FIJO</label>
		<div class="col-md-10">
	    	<input type="text" class="form-control" name="fijo" value="<?php echo $usuario['fijo']?>" data-mask="+(99) 9 9999 99 99" placeholder="+(56) 9 6556 66 66">
	    </div>
	</div>

	<div class="form-group">
		<label class="col-md-2 label-control">TELEFONO CELULAR </label>
		<div class="col-md-10">
	    	<input type="text" class="form-control" name="celular" value="<?php echo $usuario['celular']?>" data-mask="+(99) 9 9999 99 99" placeholder="+(56) 9 6556 66 66">
	    </div>
	</div>

	<div class="form-group">
		<label class="col-md-2 label-control">CONTEXTURAS <i class="fa fa-asterisk text-primary"></i> </label>
		<div class="col-md-10">
	    	<select class="form-control" name="contextura" id="pais">
	    		<option value=""></option>
		    	<optgroup label="Contexturas"><?php
		    	foreach ($contexturas as $key => $value) {
		    		?>
		    		<option value="<?php echo $value['id_contextura']?>" <?php echo ($usuario['id_contextura'] == $value['id_contextura'])?'selected':'';?> ><?php echo $value['contextura']?></option><?php
		    	}?>				    		
		    	</optgroup>
	    	</select>
	    </div>
	</div>

	<div class="form-group">
		<label class="col-md-2 label-control">CABELLO <i class="fa fa-asterisk text-primary"></i> </label>
		<div class="col-md-10">
	    	<select class="form-control" name="cabello" id="pais">
	    		<option value=""></option>
		    	<optgroup label="Cabellos"><?php
		    	foreach ($cabellos as $key => $value) {
		    		?>
		    		<option value="<?php echo $value['id_cabello']?>" <?php echo ($usuario['id_cabello'] == $value['id_cabello'])?'selected':'';?> ><?php echo $value['cabello']?></option><?php
		    	}?>				    		
		    	</optgroup>
	    	</select>
	    </div>
	</div>

	<div class="form-group">
		<label class="col-md-2 label-control">ALTURA (MTS.) <i class="fa fa-asterisk text-primary"></i> </label>
		<div class="col-md-2">
	    	<input type="text" class="form-control" name="altura" maxlength="4" value="<?php echo $usuario['altura']?>" placeholder="1.75">
	    </div>
	    <div class="col-md-8">
	    	<span class="label label-info"> Utilize puntos como separador de decimales</span>
	    </div>
	</div>

	<div class="form-group">
		<label class="col-md-2 label-control">PESO (KG.) </label>
		<div class="col-md-2">
	    	<input type="number" min="10" max="100" class="form-control" name="peso" value="<?php echo $usuario['peso']?>" placeholder="65">
	    </div>
	</div>

	<div class="form-group">
		<label class="col-md-2 label-control">BUSTO  </label>
		<div class="col-md-2">
	    	<input type="number" min="10" max="110" class="form-control" name="busto" maxlength="2" value="<?php echo $usuario['busto']?>" placeholder="65">
	    </div>
	</div>

	<div class="form-group">
		<label class="col-md-2 label-control">CINTURA  </label>
		<div class="col-md-2">
	    	<input type="number" min="10" max="100" class="form-control" name="cintura" maxlength="2" value="<?php echo $usuario['cintura']?>" placeholder="65">
	    </div>
	</div>

	<div class="form-group">
		<label class="col-md-2 label-control">CADERA  </label>
		<div class="col-md-2">
	    	<input type="number" min="10" max="110" class="form-control" name="cadera" maxlength="2" value="<?php echo $usuario['cadera']?>" placeholder="65">
	    </div>
	</div>

	<div class="form-group">
		<label class="col-md-2 label-control">PRESENTACIÓN  </label>
		<div class="col-md-10">
			<textarea name="presentacion" rows="7" class="form-control"><?php echo $usuario['presentacion']?></textarea>			    	
	    </div>
	</div>

	<div class="form-group">				
		<div class="col-md-4 col-md-offset-2">
	    	<button class="btn btn-success">GUARDAR CAMBIOS</button>
	    </div>
	</div>

</form>