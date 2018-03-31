 <!--CONTENT CONTAINER-->
 <!--===================================================-->
 <div id="content-container">

 	<!--Page Title-->
 	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
 	<div id="page-title">
 		<h1 class="page-header text-overflow">New Role Registration</h1>
 	</div>
 	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
 	<!--End page title-->
 	<?php
	if($success){
		echo "<div class='alert alert-success'>" . $success . "</div>";
	}
	if($failed){
		echo "<div class='alert alert-danger'>" . $failed . "</div>";
	}
	?>

 	<!--Breadcrumb-->
 	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
 	<ol class="breadcrumb">
 		<li><a href="#">Home</a></li>
 		<li class="active">New Role</li>
 	</ol>
 	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
 	<!--End breadcrumb-->




 	<!--Page content-->
 	<!--===================================================-->
 	<div id="page-content">

 		<div class="row">
 			<div class="col-sm-4">
 				<?php echo form_open('settings/role_add_name_now'); ?>
 				<div class="panel">
 					<div class="panel-body">
 						<div class="row">
	 						<div class="form-group">
	 							<label class="control-label">User Role Name</label>
	 							<input type="text" class="form-control" name="User_Role_Name" placeholder="Enter User Role Name" required>
	 							<small class="text-danger"><?php echo form_error('User_Role_Name'); ?></small>
	 						</div>
 						</div>
 						<div class="row">
 							<div class="form-group">
 							<label class="control-label">User Role Affix</label>
 							<input type="text" class="form-control" name="User_Role_Affix" placeholder="Enter User Role Affix" required>
 							<small class="text-danger"><?php echo form_error('User_Role_Affix'); ?></small>
 						</div>
 						</div>
 					</div>
 					<div class="panel-footer text-right">
 						<button class="btn btn-success" type="submit">Submit</button>
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


