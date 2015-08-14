<?php $this->layout('layouts::email'); ?>

<p>Please activate your account by clicking on <a href="<?php echo site_url($url).'/?code='.$code; ?>">this link</a>.</p>