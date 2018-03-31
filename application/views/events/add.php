 <!--CONTENT CONTAINER-->
 <!--===================================================-->
 <div id="content-container">

 	<!--Page Title-->
 	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
 	<div id="page-title">
 		<h1 class="page-header text-overflow">New Event</h1>
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
 		<li class="active">Events</li>
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
 						<h3 class="panel-title">Event Information</h3>
 					</div>
 					<!--Block Styled Form -->
 					<!--===================================================-->
 					<?php echo form_open_multipart('events/add_now'); ?>
 					<div class="panel-body">
 						<div class="row">
 							<div class="form-group">
 								<label class="control-label">Name</label>
 								<input type="text" class="form-control" name="Event_Name" value="<?php echo set_value('Event_Name'); ?>" placeholder="Enter Event Name">
 								<small class="text-danger"><?php echo form_error('Event_Name'); ?></small>
 							</div>
 						</div>
 						<div class="row">
 							<div class="col-sm-6">
 								<div class="form-group">
 									<label class="control-label">Start Date</label>
 									<input type="text" class="form-control" name="Event_Start" value="<?php echo set_value('Event_Start'); ?>" placeholder="Enter Start Date" onclick="this.type='datetime-local'" onblur="this.type='text'" min="<?php echo date('Y-m-d'); ?>">
 									<small class="text-danger"><?php echo form_error('Event_Start'); ?></small>
 								</div>
 							</div>

 							<div class="col-sm-6">
 								<div class="form-group">
 									<label class="control-label">End Date</label>
 									<input type="text" class="form-control" name="Event_End" value="<?php echo set_value('Event_End'); ?>" placeholder="Enter End Date" onclick="this.type='datetime-local'" onblur="this.type='text'" min="<?php echo date('Y-m-d'); ?>">
 									<small class="text-danger"><?php echo form_error('Event_End'); ?></small>
 								</div>
 							</div>
 						</div>
 						<div class="row">
 							<div class="col-sm-9">
	 							<div class="form-group">
	 								<label class="control-label">Location</label>
	 								<input type="text" class="form-control" name="Event_Location" value="<?php echo set_value('Event_Location'); ?>" placeholder="Enter Event Location">
	 								<small class="text-danger"><?php echo form_error('Event_Location'); ?></small>
	 							</div>
 							</div>
 							<div class="col-sm-3">
 								<div class="form-group">
 									<label class="control-label">Barangay</label>
 									<select name="Event_Barangay_ID" class="selectpicker form-control">
 										<?php if(is_array($barangay)): ?>
 											<?php foreach($barangay as $row): ?>
 												<option value="<?php echo $row->Barangay_ID; ?>"><?php echo $row->Barangay_Name; ?></option>
 											<?php endforeach; ?>
 										<?php endif; ?>
 									</select>
 									<small class="text-danger"><?php echo form_error('Event_Barangay_ID'); ?></small>
 								</div>
 							</div>
 						</div>
 						<div class="row">
 							<textarea placeholder="Event Description" name="Event_Description" rows="10" class="form-control"></textarea>
 						</div>
 						<div class="row">
 							<div class="form-group">
	 								<label class="control-label">Image Attachment (Optional)</label>
	 								<input type="file" class="form-control" name="userfile" placeholder="Upload Image">
	 								<?php if($this->session->flashdata('upload_error')): ?>
	 								<small class="text-danger"><?php echo $this->session->flashdata('upload_error'); ?></small>
	 							<?php endif; ?>
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
 </div>
 <!--===================================================-->
 <!--End page content-->
</div>
<!--===================================================-->
            <!--END CONTENT CONTAINER-->