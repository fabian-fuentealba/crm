<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="robots" content="noindex">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<title><?php echo $this->site?> | CRM</title>

		<!-- Bootstrap -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.1/animate.min.css">
		<link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href='http://fonts.googleapis.com/css?family=Titillium+Web:400,700' type='text/css'>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/2.1.19/daterangepicker.min.css">
		<!--<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css">-->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/0.7.1/css/flag-icon.min.css">
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/yellow/pace-theme-minimal.css">
		<?php
		foreach($css as $file){
	        echo "\n\t\t";
	        ?><link rel="stylesheet" href="<?php echo $file; ?>" type="text/css" /><?php
	    } echo "\n\t";
	    ?>		
	</head>

	<body>		

		<?php echo $this->load->get_section('menu');?>

		<div class="container">
			<div class="row">
				<div class="col-md-offset-1 col-md-10">
					<div class="<?php echo( in_array( $this->uri->segment(1) , array('login','activate') ) )? '' : 'layout' ;?>">
						<?php echo $output;?>
					</div>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-md-12 text-center">
					<p>Todos los derechos reservados <?php echo date('Y')?></p> 
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 text-center text-primary">
					<span class="label label-default"><?php echo $this->site?></span> 
				</div>
			</div>
			<br>
		</div>		

		<input type="hidden" id="site" value="<?php echo site_url()?>">
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/2.1.19/moment.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/2.1.19/daterangepicker.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js"></script><?php
		foreach($js as $file){
	        echo "\n\t\t";
	        ?><script src="<?php echo $file; ?>" type="text/javascript" /></script><?php
	    } echo "\n\t";
	    ?>
	</body>
</html>
