<div class="wrapper">

	<?php $this->load->view('_partials/admin_navbar'); ?>

	<?php // Left side column. contains the logo and sidebar ?>
	<aside class="main-sidebar">
		<section class="sidebar">
			<div class="user-panel">
				<div class="pull-left info">
					<p>Administrator</p>
					<a href="account"><i class="fa fa-circle text-success"></i> Online</a>
				</div>
			</div>
			<?php $this->load->view('_partials/admin_menu'); ?>
		</section>
	</aside>

	<?php // Right side column. Contains the navbar and content of the page ?>
	<div class="content-wrapper">

		<section class="content-header">
			<h1><?php echo $title; ?></h1>
			<?php //$this->load->view('_partials/breadcrumb'); ?>
		</section>

		<section class="content">
			<?php $this->load->view($inner_view); ?>
			<?php //$this->load->view('_partials/back'); ?>
		</section>

	</div>

	<?php $this->load->view('_partials/admin_footer'); ?>

</div>