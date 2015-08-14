<?php $this->layout('layouts::email'); ?>

<p>Please reset your password by clicking on <a href="<?php echo site_url($url).'/?code='.$code; ?>">this link</a>.</p>