<table class="table table-bordered">
		<tbody>
				<tr>
						<th>NUMERO CONTRATO</th>
						<td><?php echo str_pad($contrato['id_contrato'],8,0,STR_PAD_LEFT)?></td>
				</tr>
				<tr>
						<th>VENDEDOR</th>
						<td><?php echo $contrato['usuario']?></td>
				</tr>
				<tr>
						<th>CREADO</th>
						<td><?php echo $contrato['creado']?></td>
				</tr>
				<tr>
						<th>PLAN</th>
						<td><?php echo $contrato['plan']?></td>
				</tr>
				<tr>
						<th>DURACIÓN</th>
						<td><?php echo $contrato['duracion']?> dias</td>
				</tr>
				<tr>
						<th>DESDE</th>
						<td><?php echo $contrato['desde']?></td>
				</tr>
				<tr>
						<th>HASTA</th>
						<td><?php echo $contrato['hasta']?></td>
				</tr>
				<tr>
						<th>MONTO <span class="pull-right">$</span></th>
						<td align="right"><?php echo $contrato['valor']?></td>
				</tr>
		</tbody>
</table>

<div class="panel panel-default">
		<div class="panel-heading" style="padding-left:8px"><b>DETALLE PAGO</b></div>
		<table class="table table-hover">
				<tbody><?php
						$suma = 0 ;
						foreach($formas_pago as $key => $value){
								?>
								<tr>
										<th><?php echo $value['forma']?> - <?php echo $value['detalle']?> <span class="pull-right">$</span></th>
										<td width="25%" align="right" ><?php echo $value['monto']?></td>
								</tr><?php
								$suma += $value['monto'];
						}?>
						<tr class="danger">
								<th>TOTAL ABONADO <span class="pull-right">$</span></th>
								<td align="right" ><b><?php echo $suma?></b></td>
						</tr>
				</tbody>
		</table>
</div>
