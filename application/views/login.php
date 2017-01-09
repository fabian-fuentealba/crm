<div class="row" >
	<div class="col-md-offset-4 col-md-4">
		<div style="padding-left:40px;padding-right:40px;">
			<?php echo form_open()?>			

				<div class="page-header text-center">
					<h1> <i class="fa fa-sign-in"></i> Login <small> CRM </small></h1>
				</div>

				<?php echo (validation_errors())?'<div class="alert alert-warning"><ul>'.validation_errors('<li>','</li>').'</ul></div>':''; ?>
				<?php echo $this->session->flashdata("message")?>

				<div class="form-group">
					<label for="exampleInputEmail1">USUARIO</label>
					<input type="text" name="usuario" class="form-control" value="<?php echo set_value("usuario")?>" autocomplete="off" placeholder="USUARIO" autofocus>
				</div>
				<div class="form-group">
					<label for="exampleInputPassword1">PASSWORD</label>
					<input type="password" name="password" class="form-control" autocomplete="off" placeholder="PASSWORD">
				</div>
				<br>
				<button type="submit" class="btn btn-success btn-block">INGRESAR</button>
			</form>
		</div>
	</div>
</div>