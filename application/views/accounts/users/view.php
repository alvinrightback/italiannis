 <!--CONTENT CONTAINER-->
 <!--===================================================-->
 <div id="content-container">

 	<!--Page Title-->
 	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
 	<div id="page-title">
 		<h1 class="page-header text-overflow">Users</h1>
 	</div>
 	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
 	<!--End page title-->


 	<!--Breadcrumb-->
 	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
 	<ol class="breadcrumb">
 		<li><a href="#">Home</a></li>
 		<li class="active">User Information</li>
 	</ol>
 	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
 	<!--End breadcrumb-->
 	<?php
	if($success){
		echo "<div class='alert alert-success'>" . $success . "</div>";
	}
	if($failed){
		echo "<div class='alert alert-danger'>" . $failed . "</div>";
	}
	?>



 	<!--Page content-->
 	<!--===================================================-->
 	<div id="page-content">
 		<!-- Row selection (single row) -->
 		<!--===================================================-->
 		<div class="row">
 			<div class="col-md-6">
 				<div class="panel">
 					<div class="panel-heading">
 						<h3 class="panel-title">User Information <a href="<?php echo base_url('users/edit/'.$user_data[0]->User_ID); ?>" style="margin-top: 1%;" class="btn btn-link pull-right"><i class="fa fa-edit"></i> Edit</a></h3>
 					</div>
 					<div class="panel-body">
 						<table class="table table-bordered table-hover">
 							<tbody>
 								<?php if(is_array($user_data)): ?>
 									<tr>
 										<td class="col-md-4"><b>User Role</b></td>
 										<td><?php echo $user_data[0]->User_Role_Name; ?></td>
 									</tr>
 									<tr>
 										<td class="col-md-4"><b>User Name</b></td>
 										<td><?php echo $user_data[0]->User_Name; ?></td>
 									</tr>
 									<tr>
 										<td class="col-md-4"><b>Full Name</b></td>
 										<td><?php echo  $user_data[0]->User_LastName.', '.$user_data[0]->User_FirstName.' '.  $user_data[0]->User_MiddleName; ?></td>
 									</tr>
 									<tr>
 										<td class="col-md-4"><b>Email Address</b></td>
 										<td><?php echo $user_data[0]->User_Email; ?></td>
 									</tr>
 									<tr>
 										<td class="col-md-4"><b>Barangay</b></td>
 										<td><?php echo $user_data[0]->Barangay_Name; ?></td>
 									</tr>
 									<tr>
 										<td class="col-md-4"><b>Account Status</b></td>
 										<td><span class="label label-<?php echo $user_data[0]->User_Status == 1 ? 'success' : 'danger'; ?>"><?php echo $user_data[0]->User_Status == 1 ? 'Active' : 'Inactive'; ?></td>
 									</tr>

 								<?php endif; ?>
 							</tbody>
 						</table>
 					</div>
 				</div>
 			</div>

 			<div class="col-md-3">
 				
 				<div class="panel">
 					<div class="panel-heading">
 					<h3 class="panel-title">Actions</h3>
 					</div>
 					<div class="panel-body">

 						<!--Link Items-->
 						<!--===================================================-->
 						<div class="list-group">
 							<a class="list-group-item bootbox-confirm" href="<?php echo base_url('users/reset_password/'.$user_data[0]->User_ID); ?>">Reset Password</a>
 							<a class="list-group-item bootbox-confirm" href="<?php echo base_url('users/change_status/'.$user_data[0]->User_ID); ?>"><?php echo $user_data[0]->User_Status == 1 ? 'Lock' : 'Unlock'; ?> Account</a>
 						</div>
 						<!--===================================================-->

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