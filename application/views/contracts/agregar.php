<div class="page-header">
  <h1> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Contratos <small> agregar </small></h1>
</div>

<a href="<?php echo site_url('contracts/index/'.$this->uri->segment(3))?>" class="btn btn-default btn-sm"> <i class="fa fa-arrow-left"></i> SALIR</a>
<br><br>

<?php echo form_open(NULL, array('class'=> 'form-horizontal'))?>

	<?php echo (validation_errors())?'<div class="alert alert-warning"><ul>'.validation_errors('<li>','</li>').'</ul></div>':''; ?>
	<?php echo $this->session->flashdata("message")?>		
	
	<div class="form-group">
		<label class="col-md-2 label-control"> PLAN <i class="fa fa-asterisk text-primary"></i> </label>
		<div class="col-md-10">
	    	<select class="form-control" name="plan" id="plan">
	    		<option value=""></option>
		    	<optgroup label="Planes"><?php
		    	foreach ($planes as $key => $value) {
		    		?>
		    		<option value="<?php echo $value['id_plan']?>" <?php echo set_select('plan',$value['id_plan'])?> ><?php echo $value['plan']?> / <?php echo $value['lugar']?> posición / <?php echo $value['duracion']?> dias</option><?php
		    	}?>				    		
		    	</optgroup>
	    	</select>
	    </div>
	</div>

	<div class="form-group">
		<label class="col-md-2 label-control">DESDE <i class="fa fa-asterisk text-primary"></i> </label>
		<div class="col-md-2">
	    	<input type="text" class="form-control date" name="desde" value="<?php echo set_value('desde', date('Y-m-d'))?>" placeholder="9999-12-09" readonly>
	    </div>
	</div>

	<div class="form-group">
		<label class="col-md-2 label-control">HASTA <i class="fa fa-asterisk text-primary"></i> </label>
		<div class="col-md-2">
	    	<input type="text" class="form-control date" name="hasta" value="<?php echo set_value('hasta')?>" placeholder="9999-12-09" readonly>
	    </div>
	</div>

	<div class="form-group">
		<label class="col-md-2 label-control"> A PAGAR </label>
		<div class="col-md-10">
			<div class="input-group">
  				<span class="input-group-addon" id="sizing-addon1">$</span>
	    		<input type="text" class="form-control text-right" id="a_pagar" name="a_pagar" readonly value="<?php echo set_value('a_pagar')?>" placeholder="">
	    	</div>
	    </div>
	</div>

	<div class="form-group">		
		<div class="col-md-offset-2 col-md-8">
	    	<select class="form-control" name="forma" id="forma">
	    		<option value="">FORMAS DE PAGO</option>
		    	<optgroup label="Planes"><?php
		    	foreach ($formas_pago as $key => $value) {
		    		?>
		    		<option value="<?php echo $value['id_forma_pago']?>" ><?php echo $value['forma']?></option><?php
		    	}?>				    		
		    	</optgroup>
	    	</select>
	    </div>
	    <div class="col-md-2">
	    <button type="button" class="btn btn-primary btn-block" id="add_forma"> <i class="fa fa-plus-square"></i> AGREGAR</button>
	    </div>
	</div>
	
	<div class="form-group">				
		<div class="col-md-offset-2 col-md-10">
			<div class="panel panel-default">
		  
		  		<div class="panel-heading" style="padding-left:8px"><b>DETALLE PAGO</b></div>
				<table class="table table-hover" id="formas">
					
					<tbody><?php
					$suma = 0 ;
					if(count($pagos) > 0 ){
						foreach($pagos as $key => $value){
							?>
							<tr>
								<td><input type="hidden" name="id_pago[]" value="<?php echo $value?>"> <input type="text" class="form-control input-sm" name="detalle_pago[]" value="<?php echo $detalles[$key]?>"> </td>
								<td width="25%" ><input type="text" class="form-control monto_pago text-right input-sm" autocomplete="off" name="monto_pago[]" value="<?php echo $monto_pago[$key]?>" maxlength="6" ></td>
								<td width="5%" align="center"><button type="button" class="btn btn-danger btn-xs delete_pago"><i class="fa fa-minus-square"></i></button></td>
							</tr><?php
							$suma += $monto_pago[$key];
						}
					}?>				
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<div class="form-group">
		<label class="col-md-2 label-control"> ABONADO</label>
		<div class="col-md-10">
			<div class="input-group">
  				<span class="input-group-addon" id="sizing-addon1">$</span>
	    		<input type="text" class="form-control text-right" id="abonado" name="abonado" value="<?php echo $suma?>" readonly >
	    	</div>
	    </div>
	</div>

	<div class="form-group">				
		<div class="col-md-4 col-md-offset-2">
	    	<button class="btn btn-success">GENERAR CONTRATO</button>
	    </div>
	</div>


</form>