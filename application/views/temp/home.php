<?php $this->layout('temp/layout_default', ['title' => 'home']) ?>

<?php $this->start('head_extra') ?>
<meta name="description" content="CI Bootstrap 3">
<?php $this->stop() ?>

<?php echo $base_url; ?>
temp/home.php

<?=$this->e(time(), 'date');?>

<?php $this->start('foot_extra') ?>
<script src="sfdf" ></script>
<?php $this->stop() ?>