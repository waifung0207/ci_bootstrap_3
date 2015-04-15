<ul class="sidebar-menu">

	<li class="header">MAIN NAVIGATION</li>
	<?php foreach ($menu as $parent): ?>
		<?php if (empty($parent['children'])): ?>
		<li>
			<a href='<?php echo $parent['url']; ?>'>
				<i class='<?php echo $parent['icon']; ?>'></i> <?php echo $parent['name']; ?>
			</a>
		</li>
		<?php else: ?>
		<li class='treeview'>
			<a href='#'>
				<i class='<?php echo $parent['icon']; ?>'></i> <?php echo $parent['name']; ?> <i class='fa fa-angle-left pull-right'></i>
			</a>
			<ul class='treeview-menu'>
				<?php foreach ($parent['children'] as $name => $url): ?>
					<li><a href='<?php echo $url; ?>'><i class='fa fa-circle-o'></i> <?php echo $name; ?></a></li>
				<?php endforeach; ?>
			</ul>
		</li>
		<?php endif; ?>
	<?php endforeach; ?>

	<li class="header">USEFUL LINKS</li>
	<li>
		<a href="<?php echo base_url(); ?>" target='_blank'><i class="fa fa-circle-o text-info"></i> Frontend Site</a>
	</li>

</ul>