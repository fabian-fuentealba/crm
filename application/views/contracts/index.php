<div class="page-header">
	<h1> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Contratos  <small> listado general</small></h1>
</div>

<a href="<?php echo site_url('users')?>" class="btn btn-default btn-sm"> <i class="fa fa-arrow-left"></i> SALIR</a>
<a href="<?php echo site_url(uri_string())?>" class="btn btn-default btn-sm"> <i class="fa fa-retweet"></i> </a>
<a href="<?php echo site_url("contracts/agregar/" . $this->uri->Segment(3) )?>" class="btn btn-default btn-sm" > <i class="fa fa-plus-square"></i> AGREGAR CONTRATO </a>

<br><br>
<div class="table-responsive">
	<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th>#</th>
			<th>PLAN </th>
			<th>DESDE </th>
			<th>HASTA</th>
			<th>QUEDAN</th>
			<th>VALOR</th>
			<th>VER</th>		
		</tr>
	</thead><?php
	foreach ($listado as $key => $value) {
		?>
		<tr>
			<td><b><?php echo ( $key + 1 )?></b></td>
			<td><?php echo $value['plan']?></td>
			<td><?php echo $value['desde']?></td>
			<td><?php echo $value['hasta']?></td>
			<td><?php echo $value['quedan']?></td>
			<td><?php echo $value['valor']?></td>
			<td ><a data-url="<?php echo site_url('contracts/ver/' . $value['id_contrato'])?>" class="btn btn-default btn-xs" data-toggle="modal" data-target="#myModal2" data-title="Contratos <small>ver</small>" > <i class="fa fa-eye"></i> </a></td>
			
		</tr><?php
	}?>
	</table>
</div>
