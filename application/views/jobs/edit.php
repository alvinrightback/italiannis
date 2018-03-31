 <!--CONTENT CONTAINER-->
 <!--===================================================-->
 <div id="content-container">

 	<!--Page Title-->
 	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
 	<div id="page-title">
 		<h1 class="page-header text-overflow">New Job</h1>
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
 		<li class="active">Add New Job</li>
 	</ol>
 	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
 	<!--End breadcrumb-->




 	<!--Page content-->
 	<!--===================================================-->
 	<div id="page-content">

 		<div class="row">
 			<div class="panel">
 				<div class="panel-heading">
 					<h3 class="panel-title">Job Information</h3>
 				</div>

 				<!--Block Styled Form -->
 				<!--===================================================-->
 				<?php echo form_open_multipart('jobs/edit_now'); ?>
 				<form>
 					<div class="panel-body">
 						<div class="row">
 							<div class="col-sm-9">
 								<div class="form-group">
 									<label class="control-label">Title</label>
 									<input type="text" class="form-control" name="Job_Name" value="<?php echo $job_data[0]->Job_Name; ?>" placeholder="Enter Job Name">
 									<small class="text-danger"><?php echo form_error('Job_Name'); ?></small>
 									<input type="hidden" name="Job_ID" value="<?php echo $job_data[0]->Job_ID; ?>">
 								</div>
 							</div>
 							<div class="col-sm-3">
 								<div class="form-group">
 									<label class="control-label">Employment Type</label>
 									<select name="Job_Employment_Type_ID" class="selectpicker form-control">
 										<?php if(is_array($employment_type)): ?>
 											<?php foreach($employment_type as $row): ?>
 												<option value="<?php echo $row->Aux_ID; ?>"<?php echo $row->Aux_ID == $job_data[0]->Job_Employment_Type_ID ? ' selected':'' ?> ><?php echo $row->Aux_Value; ?></option>
 											<?php endforeach; ?>
 										<?php endif; ?>
 									</select>
 									<small class="text-danger"><?php echo form_error('Job_Employment_Type_ID'); ?></small>
 								</div>
 							</div>
 						</div>
 						<div class="row">
 							<div class="col-sm-9">
 								<div class="form-group">
 									<label class="control-label">Location</label>
 									<input type="text" class="form-control" name="Job_Location" value="<?php echo $job_data[0]->Job_Location; ?>" placeholder="Enter Job Location">
 									<small class="text-danger"><?php echo form_error('Job_Location'); ?></small>
 								</div>
 							</div>
 							<div class="col-sm-3">
 								<div class="form-group">
 									<label class="control-label">Barangay</label>
 									<select name="Job_Barangay_ID" class="selectpicker form-control" required>
 										<?php if(is_array($barangay)): ?>
 											<?php foreach($barangay as $row): ?>
 												<option value="<?php echo $row->Barangay_ID; ?>"<?php echo $row->Barangay_ID == $job_data[0]->Job_Barangay_ID ? ' selected':'' ?> ><?php echo $row->Barangay_Name; ?></option>
 											<?php endforeach; ?>
 										<?php endif; ?>
 									</select>
 								</div>
 								<small class="text-danger"><?php echo form_error('Job_Barangay_ID'); ?></small>
 							</div>
 						</div>
 						<div class="row">
 							<div class="col-sm-4">
 								<div class="form-group">
 									<label class="control-label">Benefits</label>
 									<input type="text" class="form-control" name="Job_Benefits" value="<?php echo $job_data[0]->Job_Benefits ?>" placeholder="Enter Benefits">
 									<small class="text-danger"><?php echo form_error('Job_Benefits'); ?></small>
 								</div>
 							</div>

 							<div class="col-sm-4">
 								<div class="form-group">
 									<label class="control-label">Dress Code</label>
 									<input type="text" class="form-control" name="Job_Dress_Code" value="<?php echo $job_data[0]->Job_Dress_Code; ?>" placeholder="Enter Dress Code">
 									<small class="text-danger"><?php echo form_error('Job_Dress_Code'); ?></small>
 								</div>
 							</div>

 							<div class="col-sm-4">
 								<div class="form-group">
 									<label class="control-label">Working Hours</label>
 									<input type="text" class="form-control" name="Job_Working_Hours" value="<?php echo $job_data[0]->Job_Working_Hours; ?>" placeholder="Enter Working Hours">
 									<small class="text-danger"><?php echo form_error('Job_Working_Hours'); ?></small>
 								</div>
 							</div>
 						</div>

 						<div class="row">
 							<div class="col-sm-4">
 								<div class="form-group">
 									<label class="control-label">Minimum Working Experience</label>
 									<input type="text" class="form-control" name="Job_Minimum_Year_Exp" value="<?php echo $job_data[0]->Job_Minimum_Year_Exp; ?>" placeholder="Enter Minimum Working Experience">
 									<small class="text-danger"><?php echo form_error('Job_Minimum_Year_Exp'); ?></small>
 								</div>
 							</div>

 							<div class="col-sm-4">
 								<div class="form-group">
 									<label class="control-label">Salary Rate Range</label>
 									<input type="text" class="form-control" name="Job_Salary_Rate_Range" value="<?php echo $job_data[0]->Job_Salary_Rate_Range; ?>" placeholder="Enter Salary Rate Range">
 									<small class="text-danger"><?php echo form_error('Job_Salary_Rate_Range'); ?></small>
 								</div>
 							</div>

 							
 							<div class="col-sm-4">
 								<div class="form-group">
 									<label class="control-label">Closing Date</label>
 									<input type="text" class="form-control" name="Job_Date_Closed" value="<?php echo $job_data[0]->Job_Date_Closed; ?>" placeholder="Enter Closing Date" onclick="this.type='date'" onblur="this.type='text'">
 									<small class="text-danger"><?php echo form_error('Job_Date_Closed'); ?></small>
 								</div>
 							</div>
 						</div>

 						<div class="row">
 							<div class="col-sm-6">
 								<div class="form-group">
 									<label class="control-label">Job Description</label>
 									<textarea placeholder="Job Description" name="Job_Description" rows="10" class="form-control"><?php echo $job_data[0]->Job_Description; ?></textarea>
 								</div>
 							</div>

 							<div class="col-sm-6">
 								<div class="form-group">
 									<label class="control-label">Qualifications</label>
 									<textarea placeholder="Job Qualification" name="Job_Qualification" rows="10" class="form-control"><?php echo $job_data[0]->Job_Qualification; ?></textarea>
 								</div>
 							</div>
 						</div>
 					</div>
 					<div class="panel-footer text-right">
 						<button class="btn btn-success" type="submit">Submit</button>
 					</div>
 				</form>
 				<!--===================================================-->
 				<!--End Block Styled Form -->

 			</div>
 		</div>
 	</div>
 	<!--===================================================-->
 	<!--End page content-->
 </div>
 <!--===================================================-->
            <!--END CONTENT CONTAINER-->