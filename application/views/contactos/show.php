<?php echo form_open()?>
    <table class="table table-bordered">
      	<tbody>
        		<tr>
          			<th>CREADO</th>
          			<td><?php echo $contacto['creado']?></td>
        		</tr>
        		<tr>
          			<th>SITIO</th>
          			<td><?php echo $contacto['sitio']?></td>
        		</tr>
        		<tr>
          			<th>CATEGORIA</th>
          			<td><?php echo $contacto['categoria']?></td>
        		</tr>
        		<tr>
          			<th>NOMBRE</th>
          			<td><?php echo $contacto['nombre']?></td>
        		</tr>
        		<tr>
          			<th>TELEFONO</th>
          			<td><?php echo $contacto['telefono']?></td>
        		</tr>
        		<tr>
          			<th>CORREO</th>
          			<td><?php echo $contacto['correo']?></td>
        		</tr>
        		<tr>
          			<th>MENSAJE</th>
          			<td ><?php echo nl2br($contacto['mensaje'])?></td>
        		</tr>
      	</tbody>
    </table>
</form>
