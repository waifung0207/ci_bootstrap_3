<div class="container">

	<?php $this->load->view('frontend/partials/navbar'); ?>

	<!--<div class="content-header"></div>-->

	<section class="content">
		<?php $this->load->view('common/breadcrumb'); ?>
		<?php $this->load->view($inner_view); ?>
	</section>
	
</div>

<?php $this->load->view('frontend/partials/footer'); ?>