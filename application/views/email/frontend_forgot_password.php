<?php $this->load->view('email/_header'); ?>

<p>Please reset your password by clicking on <a href="<?php echo site_url($url).'/?code='.$code; ?>">this link</a>.</p>

<?php $this->load->view('email/_footer'); ?>