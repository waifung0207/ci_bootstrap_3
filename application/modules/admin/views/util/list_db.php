
<div class="box">
	<div class="box-header">
		<h3 class="box-title">Database Versions</h3>
	</div>
	<div class="box-body">
		<?php /* Backup button */ ?>
		<p>
			<a href="util/backup_db" class="btn btn-primary">Backup Current Database</a>
			<a href="util/backup_db?save_latest=1" class="btn btn-primary">Backup Current Database (and save to Latest)</a>
		</p>

		<?php /* List out stored versions */ ?>
		<table class="table table-striped table-hover table-bordered">
			<tbody>
				<tr>
					<th>Version</th>
					<th>File Path</th>
					<th>Action</th>
				</tr>
				<tr>
					<td><b>Latest</b></td>
					<td><?php echo FCPATH.'sql/latest.sql'; ?></td>
					<td><a href="util/restore_db/latest" class="btn btn-primary">Restore</a></td>
				</tr>
				<?php foreach ($backup_sql_files as $file): ?>
				<tr>
					<td>
						<?php
							$datetime = explode('_', str_replace('.sql', '', $file));
							echo '<b>'.$datetime[0].'</b> '.str_replace('-', ':', $datetime[1]);
						?>
					</td>
					<td><?php echo FCPATH.'sql/backup/'.$file; ?></td>
					<td>
						<a href="util/restore_db/<?php echo $file; ?>" class="btn btn-primary">Restore</a>
						<a href="util/remove_db/<?php echo $file; ?>" class="btn btn-danger">Delete</a>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>