<!DOCTYPE html>
<html>
<head>
	<title>API Documentation</title>
	<link rel="icon" type="image/png" href="<?php echo asset_url('api/images/favicon-32x32.png'); ?>" sizes="32x32" />
	<link rel="icon" type="image/png" href="<?php echo asset_url('api/images/favicon-16x16.png'); ?>" sizes="16x16" />
	<link href='<?php echo asset_url('api/css/typography.css'); ?>' media='screen' rel='stylesheet' type='text/css'/>
	<link href='<?php echo asset_url('api/css/reset.css'); ?>' media='screen' rel='stylesheet' type='text/css'/>
	<link href='<?php echo asset_url('api/css/screen.css'); ?>' media='screen' rel='stylesheet' type='text/css'/>
	<link href='<?php echo asset_url('api/css/reset.css'); ?>' media='print' rel='stylesheet' type='text/css'/>
	<link href='<?php echo asset_url('api/css/print.css'); ?>' media='print' rel='stylesheet' type='text/css'/>
	<script src='<?php echo asset_url('api/lib/jquery-1.8.0.min.js'); ?>' type='text/javascript'></script>
	<script src='<?php echo asset_url('api/lib/jquery.slideto.min.js'); ?>' type='text/javascript'></script>
	<script src='<?php echo asset_url('api/lib/jquery.wiggle.min.js'); ?>' type='text/javascript'></script>
	<script src='<?php echo asset_url('api/lib/jquery.ba-bbq.min.js'); ?>' type='text/javascript'></script>
	<script src='<?php echo asset_url('api/lib/handlebars-2.0.0.js'); ?>' type='text/javascript'></script>
	<script src='<?php echo asset_url('api/lib/underscore-min.js'); ?>' type='text/javascript'></script>
	<script src='<?php echo asset_url('api/lib/backbone-min.js'); ?>' type='text/javascript'></script>
	<script src='<?php echo asset_url('api/swagger-ui.js'); ?>' type='text/javascript'></script>
	<script src='<?php echo asset_url('api/lib/highlight.7.3.pack.js'); ?>' type='text/javascript'></script>
	<script src='<?php echo asset_url('api/lib/marked.js'); ?>' type='text/javascript'></script>
	<script src='<?php echo asset_url('api/lib/swagger-oauth.js'); ?>' type='text/javascript'></script>

	<?php // Scripts at page start ?>
	<?=$this->section('scripts_head')?>
</head>

<body class="swagger-section">
	<?=$this->section('content')?>
</body>
</html>
