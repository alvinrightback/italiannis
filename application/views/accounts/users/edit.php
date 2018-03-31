 <!--CONTENT CONTAINER-->
 <!--===================================================-->
 <div id="content-container">

 	<!--Page Title-->
 	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
 	<div id="page-title">
 		<h1 class="page-header text-overflow">Edit User</h1>
 	</div>
 	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
 	<!--End page title-->


 	<!--Breadcrumb-->
 	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
 	<ol class="breadcrumb">
 		<li><a href="#">Home</a></li>
 		<li class="active">Edit User</li>
 	</ol>
 	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
 	<!--End breadcrumb-->




 	<!--Page content-->
 	<!--===================================================-->
 	<div id="page-content">

 		<div class="row">
 			<div class="col-sm-6">
 				<?php echo form_open('users/edit_now'); ?>
 				<div class="panel">

 					<div class="panel-body">
 						<div class="row">
 							<div class="col-sm-6">
 								<div class="form-group">
 									<label class="control-label">Barangay</label>
 									<select name="Barangay_ID" class="selectpicker form-control" required>
 										<?php if(is_array($barangay)): ?>
 											<?php foreach($barangay as $row): ?>
 												<option value="<?php echo $row->Barangay_ID; ?>"<?php echo $row->Barangay_ID == $user_data[0]->Barangay_ID ? ' selected':'' ?> ><?php echo $row->Barangay_Name; ?></option>
 											<?php endforeach; ?>
 										<?php endif; ?>
 									</select>
 									<small class="text-danger"><?php echo form_error('Barangay_ID'); ?></small>
 								</div>
 							</div>
 							<div class="col-sm-6">
 								<div class="form-group">
 									<label class="control-label">User Role</label>
 									<select name="User_Role_ID" class="selectpicker form-control" required>
 										<?php if(is_array($roles)): ?>
 											<?php foreach($roles as $row): ?>
 												<option value="<?php echo $row->User_Role_ID; ?>"<?php echo $row->User_Role_ID == $user_data[0]->User_Role_ID ? ' selected':'' ?> ><?php echo $row->User_Role_Name; ?></option>
 											<?php endforeach; ?>
 										<?php endif; ?>
 									</select>
 									<small class="text-danger"><?php echo form_error('User_Role_ID'); ?></small>
 								</div>
 							</div>
 						</div>
 					</div>
 				</div>

 				<div class="panel">
 					<div class="panel-heading">
 						<h3 class="panel-title">Account Credentials</h3>
 					</div>

 					<!--Block Styled Form -->
 					<!--===================================================-->
 					<div class="panel-body">
 						<div class="row">
 							<div class="col-sm-6">
 								<div class="form-group">
 									<label class="control-label">Username</label>
 									<input type="text" class="form-control" name="User_Name" value="<?php echo $user_data[0]->User_Name; ?>" placeholder="Enter Username" required>
 									<input type="hidden" name="User_ID" value="<?php echo $user_data[0]->User_ID; ?>">
 									<small class="text-danger"><?php echo form_error('User_Name'); ?></small>
 								</div>
 							</div>
 							<div class="col-sm-6">
 								<div class="form-group">
 									<label class="control-label">Email Address</label>
 									<input type="email" class="form-control" name="User_Email" value="<?php echo $user_data[0]->User_Email; ?>" placeholder="Enter Email Address" required>
 									<small class="text-danger"><?php echo form_error('User_Email'); ?></small>
 								</div>
 							</div>
 						</div>
 						<div class="row">
 							<div class="col-sm-4">
 								<div class="form-group">
 									<label class="control-label">Last Name</label>
 									<input type="text" class="form-control" name="User_LastName" value="<?php echo $user_data[0]->User_LastName; ?>" placeholder="Enter Last Name" required>
 									<small class="text-danger"><?php echo form_error('User_LastName'); ?></small>
 								</div>
 							</div>
 							<div class="col-sm-4">
 								<div class="form-group">
 									<label class="control-label">First Name</label>
 									<input type="text" class="form-control" name="User_FirstName" value="<?php echo $user_data[0]->User_FirstName;?>" placeholder="Enter First Name" required>
 									<small class="text-danger"><?php echo form_error('User_FirstName'); ?></small>
 								</div>
 							</div>
 							<div class="col-sm-4">
 								<div class="form-group">
 									<label class="control-label">Middle Name</label>
 									<input type="text" class="form-control" name="User_MiddleName" value="<?php echo $user_data[0]->User_MiddleName; ?>" placeholder="Enter Middle Name" required>
 									<small class="text-danger"><?php echo form_error('User_MiddleName'); ?></small>
 								</div>
 							</div>
 						</div>
 					</div>
 				</div>
 			</form>
 			<!--===================================================-->
 			<!--End Block Styled Form -->

 		</div>
 	</div>
 </div>



</div>
<!--===================================================-->
<!--End page content-->


</div>
<!--===================================================-->
            <!--END CONTENT CONTAINER-->