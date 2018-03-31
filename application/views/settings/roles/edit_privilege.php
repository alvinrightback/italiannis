 <!--CONTENT CONTAINER-->
 <!--===================================================-->
 <div id="content-container">

 	<!--Page Title-->
 	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
 	<div id="page-title">
 		<h1 class="page-header text-overflow">User Privilege</h1>
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
 		<li class="active">User Privilege</li>
 	</ol>
 	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
 	<!--End breadcrumb-->




 	<!--Page content-->
 	<!--===================================================-->
 	<div id="page-content">
 		<div class="row">
 			<div class="col-sm-6">


 				<div class="panel">
 					<div class="panel-heading">
 						<h3 class="panel-title">Module Information </h3>
 					</div>
 					<div class="panel-body">
 						<table class="table table-bordered table-hover">
 						<tbody>
 									<tr>
 										<td class="col-md-4"><b>Module Name</b></td>
 										<td><?php echo $module_privilege[0]->Module_Name; ?></td>
 									</tr>
 									<tr>
 										<td class="col-md-4"><b>Created By</b></td>
 										<td><?php echo $module_privilege[0]->User_Name; ?></td>
 									</tr>
 									<tr>
 										<td class="col-md-4"><b>Date</b></td>
 										<td><?php echo $module_privilege[0]->DateCreated; ?></td>
 									</tr>
 							</tbody>
 						</table>

 					</div>
 					
 				</div>

 				<div class="panel">
 					<div class="panel-heading">
 						<h3 class="panel-title">Access Privilege</h3>
 					</div>
 					<div class="panel-body">
 						<?php echo form_open('settings/role_edit_privilege_now'); ?>
 						<div class="form-group">
 						<input type="hidden" name="Module_ID" value="<?php echo $module_privilege[0]->Module_ID; ?>">
 						<input type="hidden" name="Transaction_ID" value="<?php echo $module_privilege[0]->Transaction_ID; ?>">
 						<input type="hidden" name="User_Role_ID" value="<?php echo $this->uri->segment(4); ?>">
 							<label class="control-label">Privileges</label>
 							<table class="table table-responsive table-bordered" cellspacing="0" width="100%">
 								<tbody>
 									<tr class="text-center">
 										<td>
 											<div class="checkbox">
 												<input id="demo-form-checkbox-<?php echo $module_privilege[0]->Module_ID; ?>i" name="Transaction_Insert" value="Y" class="magic-checkbox" type="checkbox" <?php echo $module_privilege[0]->Transaction_Insert == 'Y' ? 'checked':''; ?>>
 												<label for="demo-form-checkbox-<?php echo $module_privilege[0]->Module_ID; ?>i">Insert</label>
 											</div>
 										</td>
 										<td>
 											<div class="checkbox">
 												<input id="demo-form-checkbox-<?php echo $module_privilege[0]->Module_ID; ?>u" name="Transaction_Update" value="Y" class="magic-checkbox" type="checkbox" <?php echo $module_privilege[0]->Transaction_Update == 'Y' ? 'checked':''; ?> >
 												<label for="demo-form-checkbox-<?php echo $module_privilege[0]->Module_ID; ?>u">Update</label>
 											</div>
 										</td>
 										<td>
 											<div class="checkbox">
 												<input id="demo-form-checkbox-<?php echo $module_privilege[0]->Module_ID; ?>d" name="Transaction_Delete" value="Y" class="magic-checkbox" type="checkbox" <?php echo $module_privilege[0]->Transaction_Delete == 'Y' ? 'checked':''; ?>>
 												<label for="demo-form-checkbox-<?php echo $module_privilege[0]->Module_ID; ?>d">Delete</label>
 											</div>
 										</td>
 									</tr>
 								</tbody>
 							</table>
 							<small class="text-danger"><?php echo form_error('Privileges'); ?></small>
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


