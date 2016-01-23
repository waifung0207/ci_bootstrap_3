<?php $this->load->view('email/_header'); ?>

<h1><?php echo sprintf(lang('email_new_password_heading'), $identity);?></h1>
<p><?php echo sprintf(lang('email_new_password_subheading'), '');?></p>

<?php $this->load->view('email/_footer'); ?>