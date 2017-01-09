<?php
foreach($listado as $value){
	?>
	<option value="<?php echo $value['id_region']?>" <?php echo ($value['id_region'] == $selec )?'selected':'';?> ><?php echo $value['region']?></option><?php
}?>