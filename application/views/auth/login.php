<div class="col-md-offset-3 col-md-6">

      <?php echo form_open("/auth/login_process");?>
      <?php echo $form->messages(); ?>
      <?php echo $form->bs3_text('Email', 'username', ''); ?>
      <?php echo $form->bs3_password('Password', 'password', ''); ?>
      <div class="row">
        <div class="col-xs-4">
          <?php echo $form->bs3_submit('Sign In', 'btn btn-primary btn-block btn-flat'); ?>
        </div>
      </div>
    <?php echo $form->close(); ?>
<p><a href="auth/forgot_password"><?php echo lang('login_forgot_password');?></a></p>


</div>