<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">

		<script type="text/javascript" src="<?php echo Router::url('/', true);?>app/webroot/js/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo Router::url('/', true);?>app/webroot/jquery-ui/jquery-ui.min.js"></script>
		<script type="text/javascript" src="<?php echo Router::url('/', true);?>app/webroot/js/datepicker-pt-BR.js"></script>
		<script type="text/javascript" src="<?php echo Router::url('/', true);?>app/webroot/bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?php echo Router::url('/', true);?>app/webroot/js/main.js"></script>
		
		<link rel="stylesheet" href="<?php echo Router::url('/', true);?>app/webroot/jquery-ui/jquery-ui.min.css" />
		<link rel="stylesheet" href="<?php echo Router::url('/', true);?>app/webroot/bootstrap/css/bootstrap.min.css" />
		<link rel="stylesheet" href="<?php echo Router::url('/', true);?>app/webroot/css/main.css" />

		<script type="text/javascript">
			var router_url = "<?php echo Router::url('/', true);?>";
		</script>
	</head>

	<body>
		<?php echo $this->fetch('content'); ?>

		<?php //echo $this->element('sql_dump'); ?>
	</body>

</html>
