<main class="main-content p-5" role="main">
	<div class="row">
		<div class="col-md-12">
			<h1>Account Password</h1>
		</div>
	</div>
	<?php
	if($success){
		echo "<div class='alert alert-success'>" . $success . "</div>";
	}
	if($failed){
		echo "<div class='alert alert-danger'>" . $failed . "</div>";
	}
	?>


	<div class="row">
		<div class="col-md-6 col-lg-6 col-xl-8 mb-5">
			<div class="card">
				<div class="card-header">
					Change Password
				</div>
				<div class="card-body">

					<div class="row">
						<div class="col-md-6 col-lg-6 col-xl-6 mb-5">
							<?php echo form_open('user/password_update'); ?>
								<div class="form-group">
										<label>Old Password</label>
										<input type="password" class="form-control" name="oldPassword" placeholder="Enter Old Password" required autofocus>
										<small class="text-danger"><?php echo form_error('oldPassword'); ?></small>
									</div>
								<div class="form-group">
										<label>New Password</label>
										<input type="password" class="form-control" name="newPassword" 
										pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$" 
										placeholder="Enter New Password" required>
										<small class="text-danger"><?php echo form_error('newPassword'); ?></small>
									</div>
								<div class="form-group">
										<label>Confirm New Password</label>
										<input type="password" class="form-control" name="newPasswordConfirm" placeholder="Enter Confirm New Password" required>
										<small class="text-danger"><?php echo form_error('newPasswordConfirm'); ?></small>
									</div>
							</div>
							<div class="col-md-6 col-lg-6 col-xl-6 mb-5">
								<ul>
							<li>One(1) Uppercase Letter</li>
							<li>One(1) Lowercase Letter</li>
							<li>One(1) Number</li>
						</ul>
							</div>
						</div>

						<div class="form-group">
							<button type="submit" class="btn btn-primary">Update</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

