<?php $this->layout('layouts::default') ?>

<?php $this->start('scripts_crud') ?>
<?php
	// append scripts to <head>
	if ( !empty($crud_data) )
	{
		foreach ($crud_data->css_files as $file)
			echo "<link href='$file' rel='stylesheet'>".PHP_EOL;

		foreach ($crud_data->js_files as $file)
			echo "<script src='$file'></script>".PHP_EOL;
	}
?>
<?php $this->stop() ?>

<?php if ( !empty($crud_note) ) echo "<p>$crud_note</p>"; ?>

<?php if ( !empty($crud_data) ) echo $crud_data->output; ?>