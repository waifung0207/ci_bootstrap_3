<?php $this->layout('layouts::default') ?>

<?php if ( !empty($crud_note) ) echo "<p>$crud_note</p>"; ?>

<?php if ( !empty($crud_data) ) echo $crud_data->output; ?>