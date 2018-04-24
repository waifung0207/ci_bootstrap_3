<div class="col-md-offset-3 col-md-6">

      <?php echo form_open("/auth/login_process");?>
      <?php echo $form->messages(); ?>
      <?php echo $form->bs3_text('Email', 'username', ENVIRONMENT==='development' ? 'mhamzasite@gmail.com' : ''); ?>
      <?php echo $form->bs3_password('Password', 'password', ENVIRONMENT==='development' ? '3267559' : ''); ?>
      <div class="row">
        <div class="col-xs-4">
          <?php echo $form->bs3_submit('Sign In', 'btn btn-primary btn-block btn-flat'); ?>
        </div>
      </div>
    <?php echo $form->close(); ?>
<p><a href="auth/forgot_password"><?php echo lang('login_forgot_password');?></a></p>


</div>