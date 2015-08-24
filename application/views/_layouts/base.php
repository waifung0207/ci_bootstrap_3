<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">	
	<base href="<?php echo $base_url; ?>" />
	
	<?php // Meta data ?>
	<title><?=$this->e($title)?></title>
	<meta name='author' content='Michael Chan (https://github.com/waifung0207)'>
	<meta name='description' content='CI Bootstrap 3'>
	<?=$this->section('meta')?>

	<?php // Stylesheets ?>
	<link href='<?php echo dist_url('app.min.css'); ?>' rel='stylesheet'>
	<?=$this->section('styles')?>

	<?php // Scripts at page start ?>
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<?=$this->section('scripts_head')?>
</head>
<body>
	<?php // Main content (from inner view, or nested layout) ?>
	<?=$this->section('content')?>

	<?php // Scripts at page end ?>
	<script src='<?php echo dist_url('app.min.js'); ?>'></script>
	<?=$this->section('scripts_foot')?>

	<?php // (optional) Google Analytics ?>
	<?php //$this->insert('partials::ga') ?>
</body>
</html>