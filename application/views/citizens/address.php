CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">

	<!--Page Title-->
	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
	<div id="page-title">
		<h1 class="page-header text-overflow">Edit Address</h1>
	</div>
	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
	<!--End page title-->
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
 					onclick="document.getElementById(window.address).value = document.getElementById('New_Address').value;			
 							 var e = document.getElementById('barangayID');
							 var selectedValue = e.options[e.selectedIndex].value;
							 var selectedText = e.options[e.selectedIndex].text;
 							 if(window.address == 'address1'){
 								document.getElementById('Barangay_ID').value = selectedValue;
 								document.getElementById('Barangay_ID_Name').value = selectedText;
 							 }
 							 if(window.address == 'address2'){
 								document.getElementById('Barangay_ID_Permanent').value = selectedValue;
 								document.getElementById('Barangay_ID_Permanent_Name').value = selectedText;
 							 } 
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
 											document.getElementById(window.address).value = document.getElementById('<?php echo $row->Address_ID; ?>').innerText;
 											
 											if(window.address == 'address1'){
 												document.getElementById('Citizen_CurrentAddress').value = <?php echo $row->Address_ID; ?>;
 												document.getElementById('Barangay_ID').value = <?php echo $row->Barangay_ID; ?>;
 												document.getElementById('Barangay_ID_Name').value = document.getElementById('<?php echo 'B'.$row->Address_ID; ?>').innerText;
 											}
 											if(window.address == 'address2'){
 												document.getElementById('Citizen_PermanentAddress').value = <?php echo $row->Address_ID; ?>;
 												document.getElementById('Barangay_ID_Permanent').value = <?php echo $row->Barangay_ID; ?>;
 												document.getElementById('Barangay_ID_Permanent_Name').value = document.getElementById('<?php echo 'B'.$row->Address_ID; ?>').innerText;
 											} 
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
		<script type="text/javascript">
			var address = "";
		</script>
		<div id="page-content">

			<!-- Row selection (single row) -->
			<!--===================================================-->
			<div class="row">
				<div class="panel">

					<div class="panel-heading">
						<h3 class="panel-title"><?php echo $citizen_data[0]->Citizen_Title.'. '.$citizen_data[0]->Citizen_LastName.', '.$citizen_data[0]->Citizen_FirstName.' '.$citizen_data[0]->Citizen_MiddleName; ?></h3>
					</div>
					<div class="panel-body">
						<div class="row">
						<div class="col-sm-6">
							<?php echo form_open('citizens/address_change'); ?>		
							<form>
							<div class="form-group">
								<label class="control-label">Current Address</label>
								<div class="input-group mar-btm">
									<input id="address1" type="text" class="form-control input-sm" name="address1" value="<?php echo $address1[0]->Address_Name; ?>" placeholder="Enter Current Address" required readonly>
									<span class="input-group-btn">
										<button class="btn btn-success btn-sm" type="button" data-toggle="modal" data-target="#myModalSearch" onclick="window.address = 'address1';">+</button>
									</span>
								</div>
								<input type="hidden" name="Citizen_ID" value="<?php echo $citizen_data[0]->Citizen_ID; ?>">
								<input type="hidden" name="Barangay_ID" id="Barangay_ID"  value="<?php echo $address1[0]->Barangay_ID; ?>">
								<input type="hidden" name="Citizen_CurrentAddress" id="Citizen_CurrentAddress">
								<input type="hidden" name="History_ID1" value="<?php echo $address1[0]->History_ID; ?>">
								<small class="text-danger"><?php echo form_error('Citizen_CurrentAddress'); ?></small>
								<small class="text-danger"><?php echo form_error('Barangay_ID'); ?></small>
								<small class="text-danger"><?php echo form_error('History_ID1'); ?></small>
							</div>
							</div>
							<div class="col-sm-2">
 								<div class="form-group">
 									<label class="control-label">Barangay</label>
 									<input type="text" class="form-control input-sm" id="Barangay_ID_Name" name="Barangay_ID_Name" value="<?php echo $address1[0]->Barangay_Name; ?>" readonly required>
 									<small class="text-danger"><?php echo form_error('Barangay_ID_Name'); ?></small>
 								</div>
 							</div>
							<div class="col-sm-2">
 								<div class="form-group">
 									<label class="control-label">From</label>
 									<input id="currentAddressFrom" type="text" class="form-control input-sm" onclick="this.type='month'" onblur="this.type='text'" name="currentAddressFrom" value="<?php echo $address1[0]->Stay_From_Date == 'Present' ? 'Present': Date('Y-m', strtotime($address1[0]->Stay_From_Date)); ?>">
 									<small class="text-danger"><?php echo form_error('currentAddressFrom'); ?></small>
 								</div>
 							</div>
 							<div class="col-sm-2">
 								<div class="form-group">
 									<label class="control-label">To</label>
 									<div class="input-group mar-btm">
					                        <input id="currentAddressTo" type="text" class="form-control input-sm" onclick="this.type='month'" onblur="this.type='text'" name="currentAddressTo" value="<?php echo $address1[0]->Stay_To_Date == 'Present' ? 'Present': Date('Y-m', strtotime($address1[0]->Stay_To_Date)); ?>">
					                        <span class="input-group-btn">
					                          <button class="btn btn-success btn-sm" type="button" 
					                          onclick="document.getElementById('currentAddressTo').readOnly = true;
					                          			document.getElementById('currentAddressTo').value = 'Present';
					                          ">Present</button>
					                        </span>
					                    </div>
 									<small class="text-danger"><?php echo form_error('currentAddressTo'); ?></small>
 								</div>
 							</div>
 						</div>
 							<div class="row" style="display: none;">
 							<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Permanent Address</label>
								<div class="input-group mar-btm">
									<input id="address2" type="text" class="form-control input-sm" name="address2" value="<?php echo $address2[0]->Address_Name; ?>" placeholder="Enter Permanent Address" required readonly>
									<span class="input-group-btn">
										<button class="btn btn-success btn-sm" type="button" data-toggle="modal" data-target="#myModalSearch" onclick="window.address = 'address2';">+</button>
									</span>
								</div>
								<input type="hidden" id="Citizen_PermanentAddress" name="Citizen_PermanentAddress">
								<input type="hidden" id="Barangay_ID_Permanent"  name="Barangay_ID_Permanent" value="<?php echo $address2[0]->Barangay_ID; ?>">
								<input type="hidden" name="History_ID2" value="<?php echo $address2[0]->History_ID; ?>">
								<small class="text-danger"><?php echo form_error('Citizen_PermanentAddress'); ?></small>
								<small class="text-danger"><?php echo form_error('Barangay_ID_Permanent'); ?></small>
								<small class="text-danger"><?php echo form_error('History_ID2'); ?></small>
							</div>
							</div>
							<div class="col-sm-2">
 								<div class="form-group">
 									<label class="control-label">Barangay</label>
 									<input type="text" class="form-control" id="Barangay_ID_Permanent_Name" name="Barangay_ID_Permanent_Name" value="<?php echo $address2[0]->Barangay_Name; ?>" readonly required>
 									<small class="text-danger"><?php echo form_error('Barangay_ID_Permanent_Name'); ?></small>
 								</div>
 							</div>
							<div class="col-sm-2">
 								<div class="form-group">
 									<label class="control-label">From</label>
 									<input id="permanentAddressFrom" type="text" class="form-control input-sm" onclick="this.type='month'" onblur="this.type='text'" name="permanentAddressFrom" value="<?php echo $address2[0]->Stay_From_Date == 'Present' ? 'Present': Date('Y-m', strtotime($address2[0]->Stay_From_Date)); ?>">
 									<small class="text-danger"><?php echo form_error('permanentAddressFrom'); ?></small>
 								</div>
 							</div>
 							<div class="col-sm-2">
 								<div class="form-group">
 									<label class="control-label">To</label>
 									<div class="input-group mar-btm">
					                        <input id="permanentAddressTo" type="text" class="form-control input-sm" onclick="this.type='month'" onblur="this.type='text'" name="permanentAddressTo" value="<?php echo $address2[0]->Stay_To_Date == 'Present' ? 'Present': Date('Y-m', strtotime($address2[0]->Stay_To_Date)); ?>">
					                        <span class="input-group-btn">
					                            <button class="btn btn-success btn-sm" type="button" 
					                            onclick="document.getElementById('permanentAddressTo').readOnly = true;	
					                            		document.getElementById('permanentAddressTo').value = 'Present';	
					                            ">Present</button>
					                        </span>
					                    </div>
 									<small class="text-danger"><?php echo form_error('permanentAddressTo'); ?></small>
 								</div>
 							</div>
							</div>
					</div>
				<div class="panel-footer">
					<button class="btn btn-success">Submit</button>
				</div>
				</form>
			</div>
		</div>
		<!--===================================================-->
		<!-- End Row selection (single row) -->
	</div>
	<!--===================================================-->
	<!--End page content-->
</div>
<!--===================================================-->
			<!--END CONTENT CONTAINER