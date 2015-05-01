<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

	<?php foreach ($meta as $key => $value): ?>
		<meta name="<?php echo $key; ?>" content="<?php echo $value; ?>">
	<?php endforeach; ?>
	
	<base href="<?php echo $base_url; ?>" />
	<title><?php echo $title;?></title>

	<?php foreach ($scripts['head'] as $file): ?>
		<script src="<?php echo $file; ?>"></script>
	<?php endforeach; ?>

	<?php
		// Grocery CRUD scripts
		if ( !empty($crud_data) )
		{
			foreach ($crud_data->css_files as $file)
				echo "<link href='$file' rel='stylesheet'>".PHP_EOL;

			foreach ($crud_data->js_files as $file)
				echo "<script src='$file'></script>".PHP_EOL;
		}
	?>
	
	<?php foreach ($stylesheets as $file): ?>
		<link href="<?php echo $file; ?>" rel="stylesheet">
	<?php endforeach; ?>

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	
</head>

<body class="<?php if ( !empty($body_class) ) echo $body_class; ?>">
