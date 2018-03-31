<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
	
	<!--Page Title-->
	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
	<div id="page-title">
		<h1 class="page-header text-overflow">Default Password</h1>
	</div>
	<?php
	if($success){
		echo "<div class='alert alert-success'>" . $success . "</div>";
	}
	if($failed){
		echo "<div class='alert alert-danger'>" . $failed . "</div>";
	}
	?>
	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
	<!--End page title-->

	<!--Page content-->
	<!--===================================================-->
	<div id="page-content">
		
		
		<!-- Row selection (single row) -->
		<!--===================================================-->
		
		<div class="row">
			<div class="col-md-6">
				<div class="panel">
					<div class="panel-heading">
						<h3 class="panel-title">Set Account Default Password</h3>
					</div>
					<?php echo form_open('settings/password_update'); ?>
					<form>
						<div class="panel-body">
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label class="control-label">Old Password</label>
										<input type="password" class="form-control" name="oldPassword" placeholder="Enter Old Password" required>
										<small class="text-danger"><?php echo form_error('oldPassword'); ?></small>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label class="control-label">New Password</label>
										<input type="password" class="form-control" name="newPassword" 
										pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$" 
										placeholder="Enter New Password" required>
										<small class="text-danger"><?php echo form_error('newPassword'); ?></small>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label class="control-label">Confirm New Password</label>
										<input type="password" class="form-control" name="newPasswordConfirm" placeholder="Enter Confirm New Password" required>
										<small class="text-danger"><?php echo form_error('newPasswordConfirm'); ?></small>
									</div>
								</div>
							</div>
						</div>
						<div class="panel-footer text-right">
							<button class="btn btn-success" type="submit">Submit</button>
						</div>
					</form>
				</div>
			</div>
			<div class="col-md-3">
				<div class="panel">
					<div class="panel-heading">
						<h3 class="panel-title">Password Format</h3>
					</div>
					<div class="panel-body">
						<ul>
							<li>One(1) Uppercase Letter</li>
							<li>One(1) Lowercase Letter</li>
							<li>One(1) Number</li>
						</ul>
					</div>

				</div>
			</div>
		</div>
		<!--===================================================-->
		<!-- End Row selection (single row) -->
	</div>
	<!--===================================================-->
	<!--End page content-->


</div>
<!--===================================================-->
			<!--END CONTENT CONTAINER-->