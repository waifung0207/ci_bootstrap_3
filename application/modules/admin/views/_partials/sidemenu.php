<ul class="sidebar-menu">

	<li class="header">MAIN NAVIGATION</li>

	<?php foreach ($menu as $parent => $parent_params): ?>

		<?php if (empty($parent_params['children'])): ?>

			<?php $active = ($current_uri==$parent_params['url'] || $ctrler==$parent); ?>
			<li class='<?php if ($active) echo 'active'; ?>'>
				<a href='<?php echo $parent_params['url']; ?>'>
					<i class='<?php echo $parent_params['icon']; ?>'></i> <?php echo $parent_params['name']; ?>
				</a>
			</li>

		<?php else: ?>

			<?php $parent_active = ($ctrler==$parent); ?>
			<li class='treeview <?php if ($parent_active) echo 'active'; ?>'>
				<a href='#'>
					<i class='<?php echo $parent_params['icon']; ?>'></i> <?php echo $parent_params['name']; ?> <i class='fa fa-angle-left pull-right'></i>
				</a>
				<ul class='treeview-menu'>
					<?php foreach ($parent_params['children'] as $name => $url): ?>
						<?php $child_active = ($current_uri==$url); ?>
						<li <?php if ($child_active) echo 'class="active"'; ?>>
							<a href='<?php echo $url; ?>'><i class='fa fa-circle-o'></i> <?php echo $name; ?></a>
						</li>
					<?php endforeach; ?>
				</ul>
			</li>

		<?php endif; ?>

	<?php endforeach; ?>

	<li class="header">USEFUL LINKS</li>
	<li>
		<a href="<?php echo base_url(); ?>" target='_blank'><i class="fa fa-circle-o text-aqua"></i> Frontend Site</a>
	</li>
	<li>
		<a href="<?php echo base_url('api'); ?>" target='_blank'><i class="fa fa-circle-o text-orange"></i> API Site</a>
	</li>

</ul>