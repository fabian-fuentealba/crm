<div class="page-header">
	<h1> <i class="fa fa-comments" aria-hidden="true"></i> Contactos <small> listado general</small></h1>
</div>

<a href="<?php echo site_url(uri_string())?>" class="btn btn-default btn-sm"> <i class="fa fa-retweet"></i> </a>
<br><br>

<div class="table-responsive">
  	<table class="table table-hover table-striped">
  	<thead>
  		<tr>
  			<th>#</th>
  			<th>NOMBRES</th>
  			<th>TELÉFONO</th>
  			<th>DETALLE</th>
  			<th class="hidden-xs" >CREADO</th>
  		</tr>
  	</thead><?php
  	foreach ($contactos as $key => $value) {
    		?>
    		<tr>
      			<td align="center"><b><?php echo $key + 1 ?></b></td>
      			<td><?php echo $value['nombre']?></td>
      			<td><?php echo $value['telefono']?></td>
      			<td ><a data-url="<?php echo site_url('contacts/show/' . $value['id_contacto'])?>" class="btn btn-default btn-xs" data-toggle="modal" data-target="#myModal" data-title="Contactos <small>ver</small>" > <i class="fa fa-pencil-square-o"></i> </a></td>
      			<td class="hidden-xs"><?php echo $value['creado']?></td>
    		</tr><?php
  	}?>
  	</table>
</div>
