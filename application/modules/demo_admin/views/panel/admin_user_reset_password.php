<?php echo $form->messages(); ?>

<div class="row">

	<div class="col-md-6">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Reset Password for Admin User: </h3>
			</div>
			<div class="box-body">
				<?php echo $form->open(); ?>
					<table class="table table-bordered">
						<tr>
							<th style="width:120px">Username: </th>
							<td><?php echo $target->username; ?></td>
						</tr>
						<tr>
							<th>First Name: </th>
							<td><?php echo $target->first_name; ?></td>
						</tr>
						<tr>
							<th>Last Name: </th>
							<td><?php echo $target->last_name; ?></td>
						</tr>
						<tr>
							<th>Email: </th>
							<td><?php echo $target->email; ?></td>
						</tr>
					</table>
					<?php echo $form->bs3_password('New Password', 'new_password'); ?>
					<?php echo $form->bs3_password('Retype Password', 'retype_password'); ?>
					<?php echo $form->bs3_submit(); ?>
				<?php echo $form->close(); ?>
			</div>
		</div>
	</div>
	
</div>