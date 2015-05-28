	<?php foreach ($scripts['foot'] as $file): ?>
		<script src="<?php echo $file; ?>"></script>
	<?php endforeach; ?>

	<?php $this->load->view('_partials/ga'); ?>

</body>
</html>