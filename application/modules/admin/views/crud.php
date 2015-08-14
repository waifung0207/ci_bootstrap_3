<?php $this->layout('layouts::default') ?>

<?php if ( !empty($crud_note) ) echo $crud_note; ?>

<?php if ( !empty($crud_data) ) echo $crud_data->output; ?>
