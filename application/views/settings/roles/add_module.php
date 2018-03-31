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
 						<h3 class="panel-title"><?php echo $user_role[0]->User_Role_Name; ?> </h3>
 					</div>
 					<div class="panel-body">
 						<?php if(is_array($user_modules)): ?>
 							<table class="table table-responsive table-hover" cellspacing="0" width="100%">
 								<thead>
 									<tr>
 										<th></th>
 										<th>Module</th>
 										<th>View</th>
 										<th>Insert</th>
 										<th>Update</th>
 										<th>Delete</th>
 									</tr>
 								</thead>
 								<tbody>
 									<?php foreach($user_modules as $row): ?>
 										<tr>
 											<?php echo "<td class='text-center'>" . anchor(base_url().'settings/role_edit_privilege/'. $row->Transaction_ID .'/'.$user_role[0]->User_Role_ID, '<button class="btn btn-default btn-sm" title="Edit Privilege"><i class="fa fa-edit"></i></button>'). "</td>";
 											?>
 											<td><?php echo $row->Module_Name; ?></td>
 											<td><span class="label label-<?php echo $row->Transaction_View == 'Y'? 'success':'danger'; ?>"><?php echo $row->Transaction_View; ?></span></td>
 											<td><span class="label label-<?php echo $row->Transaction_Insert == 'Y'? 'success':'danger'; ?>"><?php echo $row->Transaction_Insert; ?></span></td>
 											<td><span class="label label-<?php echo $row->Transaction_Update == 'Y'? 'success':'danger'; ?>"><?php echo $row->Transaction_Update; ?></span></td>
 											<td><span class="label label-<?php echo $row->Transaction_Delete == 'Y'? 'success':'danger'; ?>"><?php echo $row->Transaction_Delete; ?></span></td>
 										</tr>
 									<?php endforeach; ?>
 								</tbody>
 							</table>
 						<?php else: ?>
 							<p>No Data Found.</p>
 						<?php endif; ?>

 					</div>

 				</div>
 				<?php if(!isset($existingModules)) { $existingModules = array(); }?>
 				<?php if(is_array($modules)): ?>
 					<?php $check = 0; ?>
 					<?php foreach($modules as $row): ?>
 						<?php if (!in_array($row->Module_ID, $existingModules)): ?>
 							<?php $check = 1; ?>
 						<?php endif; ?>
 					<?php endforeach; ?>
 				<?php endif; ?>

 				<?php if($check == 1):  ?>
 				<?php echo form_open('settings/role_add_module_now', array('form-horizontal')); ?>
 				<div class="panel">
 					<div class="panel-heading">
 						<h3 class="panel-title">Add Module</h3>
 					</div>
 					<div class="panel-body">
 						<div class="form-group">
 							<label class="control-label">Module</label>
 							<select name="Module_ID" class="selectpicker form-control">
 									<?php foreach($modules as $row): ?>
 										<?php if (!in_array($row->Module_ID, $existingModules)): ?>
 											<option value="<?php echo $row->Module_ID; ?>"><?php echo $row->Module_Name; ?></option>
 										<?php endif; ?>
 									<?php endforeach; ?>
 							</select>
 							<input type="hidden" name="User_Role_ID" value="<?php echo $user_role[0]->User_Role_ID; ?>">
 							<small class="text-danger"><?php echo form_error('User_Role_Name'); ?></small>
 						</div>
 						<div class="form-group">
 							<label class="control-label">Privileges</label>
 						</div>

 						<div class="form-group pad-ver">
					                    <div class="col-md-9">
					                        <div class="checkbox">
					
					                            <!-- Inline Checkboxes -->
					                           <input type="checkbox" id="demo-form-checkbox-1" name="Transaction_Insert"  class="magic-checkbox">
 												<label for="demo-form-checkbox-1">Insert</label>
					
					                           <input type="checkbox" id="demo-form-checkbox-2" name="Transaction_Update" value="Y" class="magic-checkbox">
 												<label for="demo-form-checkbox-2">Update</label>
					
					                            <input type="checkbox"id="demo-form-checkbox-3" name="Transaction_Delete" value="Y" class="magic-checkbox">
 												<label for="demo-form-checkbox-3">Delete</label>
					
					                        </div>
					                    </div>
					                </div>
 					</div>
 					<div class="panel-footer text-right">
 						<button class="btn btn-success" type="submit">Submit</button>
 					</div>
 				</div>
 			</form>
 		<?php endif; ?>
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


