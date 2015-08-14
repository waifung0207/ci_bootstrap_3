<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	
	<base href="<?php echo $base_url; ?>" />
	<title><?=$this->e($title);?></title>

	<link href='assets/dist/app.min.css' rel='stylesheet'>
	<?=$this->section('head_extra')?>
</head>
<body>
	<?=$this->section('content')?>
	<script src='assets/dist/app.min.js'></script>
	<?=$this->section('foot_extra')?>
</body>
</html>