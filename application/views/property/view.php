 <!--CONTENT CONTAINER-->
 <!--===================================================-->
 <div id="content-container">

 	<!--Page Title-->
 	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
 	<div id="page-title">
 		<h1 class="page-header text-overflow">Property</h1>
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


 	<!--Breadcrumb-->
 	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
 	<ol class="breadcrumb">
 		<li><a href="#">Home</a></li>
 		<li class="active">Property Information</li>
 	</ol>
 	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
 	<!--End breadcrumb-->


 	<!--Modal Leave Renter -->
 	<div id="myModalLeave" class="modal fade" role="dialog">
 		<div class="modal-dialog">

 			<!-- Modal content-->
 			<div class="modal-content">
 				<div class="modal-header">
 					<button type="button" class="close" data-dismiss="modal">&times;</button>
 					<h4 class="modal-title">Enter Departure Date</h4>
 				</div>
 				<div class="modal-body">
 					<?php echo form_open('property/property_leave_now'); ?>
 					<div class="form-group">
 						<label class="control-label">Departure Date</label>
 						<input type="text" class="form-control" name="Departure_Date" onclick="this.type='date'" onblur="this.type='text'" max="<?php echo date('Y-m-d'); ?>" value="<?php echo date('Y-m-d'); ?>" placeholder="Enter Departure Date" required>
 						<input type="hidden" id="REP_Renter_ID" name="REP_Renter_ID">
 						<input type="hidden" name="REP_ID" value="<?php echo $property_data[0]->REP_ID; ?>">
 						<small class="text-danger"><?php echo form_error('Departure_Date'); ?></small>
 					</div>
 				</div>
 				<div class="modal-footer">
 					<button type="submit" class="btn btn-success">Submit</button>
 				</div>
 			</form>
 		</div>

 	</div>
 </div>

 <!--Modal Search Citizen -->
 <div id="myModalSearch" class="modal fade" role="dialog">
 	<div class="modal-dialog">

 		<!-- Modal content-->
 		<div class="modal-content">
 			<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<div class="pad-btm form-inline">
						<div class="row">
							<div class="col-sm-6 table-toolbar-left">
								<a href="<?php echo base_url('citizens/add/property/view/'.$property_data[0]->REP_ID); ?>" class="btn btn-success btn-labeled fa fa-plus">New Citizen</a>
							</div>
						</div>
					</div>
				</div>
 			<div class="modal-body">
 				<?php if(is_array($citizens)): ?>
 					<table id="dt-selection" class="table table-responsive table-hover" cellspacing="0" width="100%">
 						<thead>
 							<tr>
 								<th>Name</th>
 								<th class="text-center">Select</th>										
 							</tr>
 						</thead>
 						<tbody>
 							<?php foreach($citizens as $row): ?>
 								<?php if(!isset($existingRenters)){
 									$existingRenters = array();
 								}    
 								?>
 								<?php if (!in_array($row->Citizen_ID, $existingRenters)): ?>
 									<tr>
 										<td id="B<?php echo $row->Citizen_ID; ?>"><?php echo $row->Citizen_LastName.', '.$row->Citizen_FirstName.' '.$row->Citizen_MiddleName; ?></td>
 										<td style="text-align: center; vertical-align: middle;">
 											<button class="btn btn-primary" 
 											onclick="
 											document.getElementById('citizen_name').value = document.getElementById('<?php echo 'B'.$row->Citizen_ID; ?>').innerText;
 											document.getElementById('Citizen_ID').value = <?php echo $row->Citizen_ID; ?>;
 											" data-dismiss="modal">Select</button>
 										</td>										
 									</tr>
 								<?php endif; ?>
 							<?php endforeach; ?>
 						</tbody>
 					</table>

 				<?php else: ?>
 					<p>No Data Found.</p>
 				<?php endif; ?>

 			</div>
 		</div>

 	</div>
 </div>



 <!--Page content-->
 <!--===================================================-->
 <div id="page-content">
 	<!-- Row selection (single row) -->
 	<!--===================================================-->
 	<div class="row">
 		<div class="col-md-8">
 			<div class="panel">
 				<div class="panel-heading">
 					<h3 class="panel-title">Property Information <a href="<?php echo base_url('property/edit/'.$property_data[0]->REP_ID); ?>" style="margin-top: 1%;" class="btn btn-link pull-right"><i class="fa fa-edit"></i> Edit</a></h3>
 				</div>
 				<div class="panel-body">
 					<table class="table table-bordered table-hover">
 						<tbody>
 							<?php if(is_array($property_data)): ?>
 								<tr>
 									<td class="col-md-4"><b>Propety Name</b></td>
 									<td><?php echo $property_data[0]->REP_Name; ?></td>
 								</tr>
 								<tr>
 									<td class="col-md-4"><b>Propety Owner</b></td>
 									<td><?php echo $property_data[0]->Citizen_LastName.', '.$property_data[0]->Citizen_FirstName.' '.$property_data[0]->Citizen_MiddleName; ?></td>
 								</tr>
 								<tr>
 									<td class="col-md-4"><b>Property Address</b></td>
 									<td>
 										<?php echo $property_data[0]->Address_Name; ?>
 										<?php if(isset($property_data[0]->Barangay_ID)): ?>
 											<?php if($property_data[0]->Barangay_Name): ?>
 												<?php echo ', ';?>
 												<?php echo $property_data[0]->Barangay_ID != 'N' ? $property_data[0]->Barangay_Name: ''; ?>
 											<?php endif; ?>
 										<?php endif; ?>
 									</td>
 								</tr>
 								<tr>
 									<td class="col-md-4"><b>Number of Units</b></td>
 									<td><?php echo $property_data[0]->REP_No_Of_Units; ?></td>
 								</tr>
 								<tr>
 									<td class="col-md-4"><b>Unit type</b></td>
 									<td><?php echo $property_data[0]->Aux_Value; ?></td>
 								</tr>
 							<?php endif; ?>
 						</tbody>
 					</table>
 				</div>
 			</div>

 			<div class="panel" id="addRenter" style="display: none;">
 				<div class="panel-heading">
 					<h3 class="panel-title">Add Renter 	
 						<button id="close" type="button" onclick="document.getElementById('addRenter').style.display='none';
 						document.getElementById('add').style.display='block';
 						this.style.display='none';
 						" style="margin-top: 1%; display: none;" class="btn btn-link pull-right"><i class="fa fa-close"></i> Close</button></h3>
 					</div>
 					<div class="panel-body">
 						<?php echo form_open('property/property_add_renter_now'); ?>
 						<div class="row">
 							<div class="form-group">
 								<label class="control-label">Citizen</label>
 								<div class="input-group mar-btm">
 									<input id="citizen_name" type="text" class="form-control" name="citizen_name"  placeholder="Search Citizen" required readonly>
 									<input id="Citizen_ID" type="hidden" name="Citizen_ID">
 									<input type="hidden" name="REP_ID" value="<?php echo $this->uri->segment(3); ?>">
 									<input type="hidden" name="Address_ID" value="<?php echo $property_data[0]->Address_ID; ?>">
 									<span class="input-group-btn">
 										<button class="btn btn-success" data-toggle="modal" data-target="#myModalSearch" type="button">+</button>
 									</span>
 								</div>
 							</div>

 							<div class="col-sm-6">
 								<div class="form-group">
 									<label class="control-label">Renter Type</label>
 									<select id="Renter_Type_ID" name="Renter_Type_ID" class="selectpicker form-control">
 										<?php if(is_array($rentertype)): ?>
 											<?php foreach($rentertype as $row): ?>
 												<option value="<?php echo $row->Aux_ID; ?>"><?php echo $row->Aux_Value; ?></option>
 											<?php endforeach; ?>
 										<?php endif; ?>
 									</select>
 									<small class="text-danger"><?php echo form_error('Renter_Type_ID'); ?></small>
 								</div>
 							</div>
 							<div class="col-sm-6">
 								<label class="control-label">Date of Arrival</label>
 								<input type="text" class="form-control" max="<?php echo Date('Y-m-d'); ?>" name="Arrival_Date" onclick="this.type='date'" onblur="this.type='text'" value="" placeholder="Enter Arrival Date"> 
 								<small class="text-danger"><?php echo form_error('Arrival_Date'); ?></small>
 							</div>
 						</div>
 					</div>
 					<div class="panel-footer text-right">
 						<button type="submit" class="btn btn-success">Submit</button>
 					</div>
				</form> 				
 			</div>

 			<div class="panel">
 				<div class="panel-heading">
 					<h3 class="panel-title">Current Renters
 						<?php if(count($current_renters) < $property_data[0]->REP_No_Of_Units): ?>
 							<button id="add" type="button" onclick=" document.getElementById('addRenter').style.display='block';
 							document.getElementById('close').style.display='block';
 							this.style.display='none';
 							" style="margin-top: 1%;" class="btn btn-link pull-right"><i class="fa fa-plus"></i> Add</button>
 						<?php endif; ?>
 					</h3>
 				</div>
 				<div class="panel-body">


 					<?php if(is_array($current_renters)): ?>
 						<table id="dt-selection" class="table table-responsive" cellspacing="0" width="100%">
 							<thead>
 								<tr>
 									<th></th>
 									<th>Name</th>
 									<th>Renter Type</th>
 									<th>Arrival Date</th>
 									<th></th> 									
 								</tr>
 							</thead>
 							<tbody>
 								<?php foreach($current_renters as $row): ?>
 									<tr>
 										<?php echo "<td class='text-center'>" . anchor(base_url().'property/edit_renter/'. $row->REP_Renter_ID, '<button class="btn btn-default" title="View User"><i class="fa fa-edit"></i></button>'). "</td>";
 										?>
 										<td><?php echo anchor(base_url().'citizens/view/'. $row->Citizen_ID, '<button class="btn btn-link" title="View Citizen">'. $row->Citizen_LastName.', '.$row->Citizen_FirstName.' '.$row->Citizen_MiddleName.'</button>'); ?></td>
 										<td><?php echo $row->Aux_Value; ?></td>
 										<td><?php echo Date('F d, Y', strtotime($row->Arrival_Date)); ?></td>
 										<td class='text-center'><button type="button" data-toggle="modal" data-target="#myModalLeave" onclick="document.getElementById('REP_Renter_ID').value = <?php echo $row->REP_Renter_ID; ?>" class="btn btn-danger" title="Leave Property"><i class="fa fa-close"></i> Leave</button></td>
 									</tr>
 								<?php endforeach; ?>
 							</tbody>
 						</table>
 					<?php else: ?>
 						<p>No Data Found.</p>
 					<?php endif; ?>
 				</div>
 			</div>

 			<div class="panel">
 				<div class="panel-heading">
 					<h3 class="panel-title">Renter History</h3>
 				</div>
 				<div class="panel-body">


 					<?php if(is_array($renter_history)): ?>
 						<table id="dt-selection" class="table table-responsive" cellspacing="0" width="100%">
 							<thead>
 								<tr>
 									<th></th>
 									<th>Name</th>
 									<th>Renter Type</th>
 									<th>Arrival Date</th>
 									<th>Departure Date</th> 									
 								</tr>
 							</thead>
 							<tbody>
 								<?php foreach($renter_history as $row): ?>
 									<tr>
 										<?php echo "<td class='text-center'>" . anchor(base_url().'citizens/view/'. $row->Citizen_ID, '<button class="btn btn-default" title="View User"><i class="fa fa-search"></i></button>'). "</td>";
 										?>
 										<td><?php echo $row->Citizen_LastName.', '.$row->Citizen_FirstName.' '.$row->Citizen_MiddleName; ?></td>
 										<td><?php echo $row->Aux_Value; ?></td>
 										<td><?php echo Date('F d, Y', strtotime($row->Arrival_Date)); ?></td>
 										<td><?php echo Date('F d, Y', strtotime($row->Departure_Date)); ?></td>
 									</tr>
 								<?php endforeach; ?>
 							</tbody>
 						</table>
 					<?php else: ?>
 						<p>No Data Found.</p>
 					<?php endif; ?>
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