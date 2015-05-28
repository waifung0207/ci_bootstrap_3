<div class="container">

	<?php $this->load->view('_partials/navbar'); ?>

	<!--<div class="content-header"></div>-->

	<section class="content">
		<?php $this->load->view('_partials/breadcrumb'); ?>
		<?php $this->load->view($inner_view); ?>
	</section>
	
</div>

<?php $this->load->view('_partials/footer'); ?>