<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	
	<base href="<?php echo $base_url; ?>" />
	<title><?php echo $title;?></title>

	<?php foreach ($meta as $key => $value): ?>
		<meta name="<?php echo $key; ?>" content="<?php echo $value; ?>">
	<?php endforeach; ?>

	<?php
		// Embed CSS files
		foreach ($stylesheets as $file)
		{
			$file = (starts_with($file, 'http') || starts_with($file, '//')) ? $file : base_url($file);
			echo "<link href='$file' rel='stylesheet'>".PHP_EOL;
		}

		// Embed JS files
		foreach ($scripts['head'] as $file)
		{
			$file = (starts_with($file, 'http') || starts_with($file, '//')) ? $file : base_url($file);
			echo "<script src='$file'></script>".PHP_EOL;
		}
	?>

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

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	
</head>

<body<?php if ( !empty($body_class) ) echo " class='$body_class'"; ?>>
