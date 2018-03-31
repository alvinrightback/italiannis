
 <!--CONTENT CONTAINER-->
 <!--===================================================-->
 <div id="content-container">
 	<!--Page Title-->
 	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
 	<div id="page-title">
 		<h1 class="page-header text-overflow">Update Property</h1>
 	</div>
 	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
 	<!--End page title-->


 	<!--Breadcrumb-->
 	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
 	<ol class="breadcrumb">
 		<li><a href="#">Home</a></li>
 		<li class="active">Update Property</li>
 	</ol>
 	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
 	<!--End breadcrumb-->

 	<!--Modal New Address -->
 	<div id="myModalAdd" class="modal fade" role="dialog">
 		<div class="modal-dialog">

 			<!-- Modal content-->
 			<div class="modal-content">
 				<div class="modal-header">
 					<button type="button" class="close" data-dismiss="modal">&times;</button>
 					<h4 class="modal-title">New Address</h4>
 				</div>
 				<div class="modal-body">
 					<form>
 						<div class="form-group">
 							<label class="control-label">Address</label>
 							<input type="text" class="form-control" id="New_Address" placeholder="Enter Address" required>
 						</div>
 						<div class="form-group">
 							<label class="control-label">Barangay</label>
 							<select id="barangayID" class="selectpicker form-control">
 								<?php if(is_array($barangay)): ?>
 									<?php foreach($barangay as $row): ?>
 										<option value="<?php echo $row->Barangay_ID; ?>"><?php echo $row->Barangay_Name; ?></option>
 									<?php endforeach; ?>
 								<?php endif; ?>
 							</select>
 						</div>

 					</form>
 				</div>
 				<div class="modal-footer">
 					<button type="submit" class="btn btn-success" data-dismiss="modal"
 					onclick="document.getElementById('Property_Address_Name').value = document.getElementById('New_Address').value;			
 					document.getElementById('Address_ID').value = '';
 					var e = document.getElementById('barangayID');
 					document.getElementById('Barangay_ID').value = e.options[e.selectedIndex].value;
 					document.getElementById('Barangay_ID_Name').value = e.options[e.selectedIndex].text;
 					">Submit</button>
 				</div>
 			</div>

 		</div>
 	</div>

 	<!--Modal Search Address -->
 	<div id="myModalSearch" class="modal fade" role="dialog">
 		<div class="modal-dialog">

 			<!-- Modal content-->
 			<div class="modal-content">
 				<div class="modal-header">
 					<button type="button" class="close" data-dismiss="modal">&times;</button>
 					<div class="pad-btm form-inline">
 						<div class="row">
 							<div class="col-sm-6 table-toolbar-left">
 								<button type="button" class="btn btn-success btn-labeled fa fa-plus" data-dismiss="modal" data-toggle="modal" href="#myModalAdd">Add New Address</button>
 							</div>
 						</div>
 					</div>
 				</div>
 				<div class="modal-body">
 					<?php if(is_array($address)): ?>
 						<table id="dt-selection" class="table table-responsive table-hover" cellspacing="0" width="100%">
 							<thead>
 								<tr>
 									<th>Address</th>
 									<th>Barangay</th>
 									<th class="text-center">Select</th>										
 								</tr>
 							</thead>
 							<tbody>
 								<?php foreach($address as $row): ?>
 									<tr>
 										<td id="<?php echo $row->Address_ID; ?>"><?php echo $row->Address_Name; ?></td>
 										<td id="<?php echo 'B'.$row->Address_ID; ?>"><?php echo $row->Barangay_Name; ?></td>
 										<td style="text-align: center; vertical-align: middle;">
 											<button class="btn btn-primary" 
 											onclick="
 											document.getElementById('Property_Address_Name').value = document.getElementById('<?php echo $row->Address_ID; ?>').innerText;
 											document.getElementById('Address_ID').value = <?php echo $row->Address_ID; ?>;
 											document.getElementById('Barangay_ID').value = <?php echo $row->Barangay_ID; ?>;
 											document.getElementById('Barangay_ID_Name').value = document.getElementById('<?php echo 'B'.$row->Address_ID; ?>').innerText;
 											" data-dismiss="modal">Select</button>
 										</td>										
 									</tr>
 								<?php endforeach; ?>
 							</tbody>
 						</table>
 					<?php else: ?>
 						<p>No Data Found.</p>
 					<?php endif; ?>
 				</div>
 				<div class="modal-footer">
 					<button type="submit" class="btn btn-success" data-dismiss="modal">Submit</button>
 				</div>
 			</div>

 		</div>
 	</div>


 	
 	<!--Page content-->
 	<!--===================================================-->
 	<div id="page-content">
 		<script type="text/javascript">
 			var address = "";
 		</script>
 		<div class="row">
 			<div class="col-sm-6">
 				<div class="panel">
 					<div class="panel-heading">
 						<h3 class="panel-title">Property Update Form</h3>
 					</div>

 					<!--Block Styled Form -->
 					<!--===================================================-->
 					<?php echo form_open('property/property_edit_now'); ?>
 					<div class="panel-body">
 						<div class="row">
 							<div class="col-sm-6">
 								<div class="form-group">
 									<label class="control-label">Property Name</label>
 									<input type="text" class="form-control" name="REP_Name" value="<?php echo $property_data[0]->REP_Name; ?>" placeholder="Enter Property Name">
 									<small class="text-danger"><?php echo form_error('REP_Name'); ?></small>
 								</div>
 							</div>
 						</div>
 						<div class="row">
 							<div class="col-sm-9">
 								<div class="form-group">
 									<label class="control-label">Property Address</label>
 									<div class="input-group mar-btm">
 										<input id="Property_Address_Name" type="text" class="form-control" name="Property_Address_Name" value="<?php echo $property_data[0]->Address_Name; ?>" placeholder="Enter Present Address" required readonly>
 										<span class="input-group-btn">
 											<button class="btn btn-success" type="button" data-toggle="modal" data-target="#myModalSearch">+</button>
 										</span>
 									</div>
 									<input id="Address_ID" type="hidden" name="Address_ID" value="<?php echo $property_data[0]->Address_ID; ?>">
 									<input id="Barangay_ID" type="hidden" name="Barangay_ID" value="<?php echo $property_data[0]->Barangay_ID; ?>">
 									<input id="Citizen_ID" type="hidden" name="Citizen_ID" value="<?php echo $property_data[0]->Citizen_ID; ?>">
 									<input id="REP_ID" type="hidden" name="REP_ID" value="<?php echo $this->uri->segment(3); ?>">
 									<small class="text-danger"><?php echo form_error('Address_ID'); ?></small>
 									<small class="text-danger"><?php echo form_error('Citizen_ID'); ?></small>
 									<small class="text-danger"><?php echo form_error('Property_Address_Name'); ?></small>
 								</div>
 							</div>
 							<div class="col-sm-3">
 								<div class="form-group">
 									<label class="control-label">Barangay</label>
 									<input type="text" class="form-control" id="Barangay_ID_Name" name="Barangay_ID_Name" value="<?php echo $property_data[0]->Barangay_Name; ?>" readonly required>
 									<small class="text-danger"><?php echo form_error('Barangay_ID_Name'); ?></small>
 								</div>
 							</div>
 						</div>
 						<div class="row">
 							<div class="col-sm-6">
 								<div class="form-group">
 									<label class="control-label">No. of units</label>
 									<input type="number" class="form-control" name="REP_No_Of_Units" value="<?php echo $property_data[0]->REP_No_Of_Units; ?>" placeholder="Enter Number of Units">
 									<small class="text-danger"><?php echo form_error('REP_No_Of_Units'); ?></small>
 								</div>
 							</div>
 							<div class="col-sm-6">
 								<div class="form-group">
 									<label class="control-label">Unit Type</label>
 									<select id="unitType" name="REP_Unit_Type" class="selectpicker form-control" required>
					                               <?php if(is_array($unittype)): ?>
					                                	<?php foreach($unittype as $row): ?>
					                                		<option value="<?php echo $row->Aux_ID; ?>"<?php echo $row->Aux_ID == $property_data[0]->REP_Unit_Type ? ' selected':'' ?> ><?php echo $row->Aux_Value; ?></option>
					                                	<?php endforeach; ?>
					                                <?php endif; ?>
					                            </select>
 									<small class="text-danger"><?php echo form_error('REP_Unit_Type'); ?></small>
 								</div>
 							</div>
 						</div>
 						<div class="row">
 							<div class="col-sm-6">
 								<div class="form-group">
 									<label class="control-label">Submission Date</label>
 									<input type="text" class="form-control" max="<?php echo Date('Y-m-d'); ?>" name="REP_Submission_Date" onclick="this.type='date'" onblur="this.type='text'" value="<?php echo $property_data[0]->REP_Submission_Date; ?>" placeholder="Enter Submission Date">
 									<small class="text-danger"><?php echo form_error('REP_Submission_Date'); ?></small>
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