 <!--CONTENT CONTAINER-->
 <!--===================================================-->
 <div id="content-container">

 	<!--Page Title-->
 	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
 	<div id="page-title">
 		<h1 class="page-header text-overflow">New Blotter</h1>
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
 		<li class="active">Add New Blotter</li>
 	</ol>
 	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
 	<!--End breadcrumb-->

 	<!--Page content-->
 	<!--===================================================-->
 	<div id="page-content">
 			<div class="row">
 			</div>
 			<div class="row">
 				<div class="col-md-8">
 					<div class="panel">
 						<div class="panel-heading">
 							<h3 class="panel-title">Blotter Information</h3>
 						</div>

 						<!--Block Styled Form -->
 						<!--===================================================-->
 						<div class="panel-body">
 							<div class="row">
 								<div class="col-sm-4">
 								<?php echo form_open_multipart('blotter/add_now'); ?>
 									<div class="form-group">
 										<label class="control-label">Incident Start Date</label>
 										<input type="text" class="form-control" name="Incident_Date_From" value="<?php echo set_value('Incident_Date_From'); ?>" placeholder="Enter Incident Start Date" onclick="this.type='date'" onblur="this.type='text'">
 										<small class="text-danger"><?php echo form_error('Incident_Date_From'); ?></small>
 									</div>
 								</div>
 								<div class="col-sm-4">

 									<div class="form-group">
 										<label class="control-label">Incident End Date</label>
 										<input type="text" class="form-control" name="Incident_Date_To" value="<?php echo set_value('Incident_Date_To'); ?>" placeholder="Enter Incident End Date" onclick="this.type='date'" onblur="this.type='text'">
 										<small class="text-danger"><?php echo form_error('Incident_Date_To'); ?></small>
 									</div>
 								</div>
 								<div class="col-sm-4">
 									<div class="form-group">
 										<label class="control-label">Complaint Status</label>
 										<select name="Complaint_Status_ID" class="selectpicker form-control">
 											<?php if(is_array($complaint_status_type)): ?>
 												<?php foreach($complaint_status_type as $row): ?>
 													<option value="<?php echo $row->Aux_ID; ?>"><?php echo $row->Aux_Value; ?></option>
 												<?php endforeach; ?>
 											<?php endif; ?>
 										</select>
 										<small class="text-danger"><?php echo form_error('Complaint_Status_ID'); ?></small>
 									</div>
 								</div>
 							</div>
 							<div class="row">
 								<div class="form-group">
 									<label class="control-label">Nature of Complaint</label>
 									<textarea placeholder="Nature of Complaint" name="Nature_Of_Complaint" rows="11" class="form-control"></textarea>
 								</div>
 							</div>
 							<div class="row">
 								<div class="form-group">
 									<label class="control-label">Remarks</label>
 									<textarea placeholder="Remarks" name="Remarks" rows="4" class="form-control"></textarea>
 								</div>
 							</div>
 						</div>
 						<div class="panel-footer text-right">
 						<button class="btn btn-success" type="submit">Submit</button>
 						</div>
 						<!--===================================================-->
 						<!--End Block Styled Form -->
 					</div>
 				</div>
 			</div>
 			</form>
 		</div>
 		<!--===================================================-->
 		<!--End page content-->
 	</div>
 	<!--===================================================-->
            <!--END CONTENT CONTAINER-->