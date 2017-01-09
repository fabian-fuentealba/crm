<div class="page-header">
	<h1> <i class="fa fa-home"></i> Bienvenido <small> <?php echo $this->session->userdata("nombre")?> <?php echo $this->session->userdata("apellido")?> </small></h1>
</div>

<div  class="row">
	<div class="col-md-8">
		<div class="panel panel-default">
			<div class="panel-heading"><b><i class="fa fa-users"></i> VISITAS POR PERFIL</b> | AL <?php echo date('Y-m-d')?></div>
			<div class="panel-body">
				<canvas id="myChart"></canvas>
			</div>
		</div>		
	</div>
	<div class="col-md-4">

		<ul class="list-group">
			<li class="list-group-item list-group-item-default" style="background-color:#f4f4f4"><b> <i class="fa fa-users"></i> CANTIDAD POR CATEGORIA</b></li><?php
			foreach ($categorias as $key => $value) {
				?>
				<li class="list-group-item">
					<span class="badge"><?php echo $value['cantidad']?></span>
					<?php echo $value['categoria']?>
				</li><?php
			}?>			
		</ul>

	</div>
</div>

<?php

$color = array('#F7464A','#46BFBD','#FDB45C','#F7464A','#46BFBD','#FDB45C' ,'#F7464A','#46BFBD','#FDB45C','#F7464A','#46BFBD','#FDB45C');
$highlight = array('#FF5A5E','#5AD3D1','#FFC870','#FF5A5E','#5AD3D1','#FFC870','#FF5A5E','#5AD3D1','#FFC870','#FF5A5E','#5AD3D1','#FFC870');
foreach ($visitas as $key => $value) {
	$data[] = '{ "value": ' . $value['visitas'] . ' , "color": "' . $color[$key] .'" , "highlight": "' . $highlight[$key] .'" , "label": "'. $value['alias'] . ' ( ' . strtolower($value['categoria']) .' )" }' ;
				
}?>		
<input type="hidden" id="data" value='<?php echo implode(',',$data)?>'>
