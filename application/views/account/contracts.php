<div class="page-header">
	<h1> <i class="fa fa-home"></i> Bienvenido(a) <small> <?php echo $this->session->userdata("nombre")?> <?php echo $this->session->userdata("apellido")?> </small></h1>
</div>


<div class="table-responsive">
	<table class="table table-striped table-hover">
	<thead>
		<tr>
			
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
			
			<td><?php echo $value['plan']?></td>
			<td><?php echo $value['desde']?></td>
			<td><?php echo $value['hasta']?></td>
			<td><?php echo $value['quedan']?></td>
			<td><?php echo $value['valor']?></td>
			<td ><a data-url="<?php echo site_url('account/contractsshow/' . $value['id_contrato'])?>" class="btn btn-default btn-xs" data-toggle="modal" data-target="#myModal2" data-title="Contratos <small>ver</small>" > <i class="fa fa-eye"></i> </a></td>
			
		</tr><?php
	}?>
	</table>
</div>
