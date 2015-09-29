<?php $this->layout('layouts::base') ?>

<div class="wrapper">

	<?php $this->insert('partials::navbar'); ?>

	<?php // Left side column. contains the logo and sidebar ?>
	<aside class="main-sidebar">
		<section class="sidebar">
			<div class="user-panel" style="height:65px">
				<div class="pull-left info" style="left:5px">
					<p><?php echo $user->full_name; ?></p>
					<a href="account"><i class="fa fa-circle text-success"></i> Online</a>
				</div>
			</div>
			<?php // (Optional) Add Search box here ?>
			<?php //$this->insert('partials::sidemenu_search'); ?>
			<?php $this->insert('partials::sidemenu'); ?>
		</section>
	</aside>

	<?php // Right side column. Contains the navbar and content of the page ?>
	<div class="content-wrapper">
		<section class="content-header">
			<h1><?php echo $title; ?></h1>
			<?php $this->insert('partials::breadcrumb'); ?>
		</section>
		<section class="content">
			<?=$this->section('content')?>
			<?php $this->insert('partials::back_btn'); ?>
		</section>
	</div>

	<?php // Footer ?>
	<footer class="main-footer">
		<?php if (ENVIRONMENT=='development'): ?>
			<div class="pull-right hidden-xs">
				CI Version: <strong><?php echo CI_VERSION; ?></strong>, 
				Elapsed Time: <strong>{elapsed_time}</strong> seconds, 
				Memory Usage: <strong>{memory_usage}</strong>
			</div>
		<?php endif; ?>
		<strong>&copy; 2015 <a href="#"><?php //echo COMPANY_NAME; ?></a></strong> All rights reserved.
	</footer>

</div>