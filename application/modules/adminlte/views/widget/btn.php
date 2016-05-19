<?php if ( $url==='#' ): ?>
	<button class='btn btn-flat <?php echo $style.' '.$size; ?>'><?php echo $icon.' '.$label; ?></button>
<?php else: ?>
	<a class='btn btn-flat <?php echo $style.' '.$size; ?>' href='<?php echo $url; ?>'><?php echo $icon.' '.$label; ?></a>
<?php endif; ?>