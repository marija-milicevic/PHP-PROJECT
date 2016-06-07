<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo $title; ?></title>
<meta charset="UTF-8">
<link href="<?php echo base_url(); ?>public/js/jqueryUI2/css/custom-theme/jquery-ui-1.9.2.custom.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>public/js/jqueryUI2/js/jquery-1.8.3.js"></script>
<script src="<?php echo base_url(); ?>public/js/jqueryUI2/js/jquery-ui-1.9.2.custom.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/main.css" type="text/css" />
</head>
<body>
	<div id="wrapper">
		<div id="header">
			<div class="login_wrrap">
				<?php
				$is_logeed = $this->session->userdata('logeed');

				if(!isset($is_logeed) || $is_logeed != true){ ?>
					<a href="<?php echo base_url(); ?>index.php/login">Login</a>
				<?php } else {?>
					<a href="<?php echo base_url(); ?>index.php/admin/post/logout">Logout</a>
				<?php }
				?>
				<br/>
				<?php echo getCapability() ?>
			</div>
		</div>



