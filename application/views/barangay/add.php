 <!--CONTENT CONTAINER-->
 <!--===================================================-->
 <div id="content-container">

 	<!--Page Title-->
 	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
 	<div id="page-title">
 		<h1 class="page-header text-overflow">New Barangay</h1>
 	</div>
 	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
 	<!--End page title-->


 	<!--Breadcrumb-->
 	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
 	<ol class="breadcrumb">
 		<li><a href="#">Home</a></li>
 		<li class="active">Add New Barangay</li>
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
 						<h3 class="panel-title">Barangay Information</h3>
 					</div>

 					<!--Block Styled Form -->
 					<!--===================================================-->
 					<?php echo form_open('barangay/add_now'); ?>
 						<div class="panel-body">
 							<div class="row">
 								<div class="col-sm-6">
 									<div class="form-group">
 										<label class="control-label">Barangay</label>
 										<input type="text" class="form-control" name="Barangay_Name" value="<?php echo set_value('Barangay_Name'); ?>" placeholder="Enter Barangay Name" required>
 										<small class="text-danger"><?php echo form_error('Barangay_Name'); ?></small>
 									</div>
 								</div>
 								<div class="col-sm-6">
 									<div class="form-group">
 										<label class="control-label">Chairman</label>
 										<input type="text" class="form-control" name="Barangay_Chairman" value="<?php echo set_value('Barangay_Chairman'); ?>" placeholder="Enter Barangay Chairman">
 										<small class="text-danger"><?php echo form_error('Barangay_Chairman'); ?></small>
 									</div>
 								</div>
 							</div>
 							<div class="row">
 								<div class="col-sm-6">
 									<div class="form-group">
 										<label class="control-label">Telephone Number</label>
 										<input type="number" class="form-control" name="Barangay_Telephone" value="<?php echo set_value('Barangay_Telephone'); ?>" placeholder="Enter Telephone Number">
 										<small class="text-danger"><?php echo form_error('Barangay_Telephone'); ?></small>
 									</div>
 								</div>
 								<div class="col-sm-6">
 									<div class="form-group">
 										<label class="control-label">Zip Code</label>
 										<input type="number" class="form-control" name="Barangay_Zipcode" value="<?php echo set_value('Barangay_Zipcode'); ?>" placeholder="Enter Zip Code">
 										<small class="text-danger"><?php echo form_error('Barangay_Zipcode'); ?></small>
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



 	</div>
 	<!--===================================================-->
 	<!--End page content-->


 </div>
 <!--===================================================-->
            <!--END CONTENT CONTAINER-->