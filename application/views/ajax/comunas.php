<?php
foreach($listado as $value){
	?>
	<option value="<?php echo $value['id_comuna']?>" <?php echo ($value['id_comuna'] == $selec )?'selected':'';?> ><?php echo $value['comuna']?></option><?php
}?>