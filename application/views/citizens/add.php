 <!--CONTENT CONTAINER-->
 <!--===================================================-->
 <div id="content-container">

 	<!--Page Title-->
 	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
 	<div id="page-title">
 		<h1 class="page-header text-overflow">New Citizen Registration</h1>
 	</div>
 	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
 	<!--End page title-->


 	<!--Breadcrumb-->
 	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
 	<ol class="breadcrumb">
 		<li><a href="#">Home</a></li>
 		<li class="active">Register New Citizen</li>
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
 					onclick="document.getElementById(window.address).value = document.getElementById('New_Address').value;			
 							 var e = document.getElementById('barangayID');
							 var selectedValue = e.options[e.selectedIndex].value;
							 var selectedText = e.options[e.selectedIndex].text;
 							 if(window.address == 'address1'){
 								document.getElementById('Barangay_ID').value = selectedValue;
 								document.getElementById('Barangay_ID_Name').value = selectedText;

 								document.getElementById('Barangay_ID_Permanent').value = selectedValue;
 								document.getElementById('Barangay_ID_Permanent_Name').value = selectedText;
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

 												document.getElementById('Citizen_PermanentAddress').value = <?php echo $row->Address_ID; ?>;
 												document.getElementById('Barangay_ID_Permanent').value = <?php echo $row->Barangay_ID; ?>;
 												document.getElementById('Barangay_ID_Permanent_Name').value = document.getElementById('<?php echo 'B'.$row->Address_ID; ?>').innerText;
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

 	<div id="page-content">
 		<script type="text/javascript">
 			var address = "";
 		</script>
 		<?php echo validation_errors(); ?>
 		<div class="row">
 			<div class="col-sm-12">
 				<div class="panel">
 					<div class="panel-heading">
 						<h3 class="panel-title">Citizen Registration Form</h3>
 					</div>

 					<!--Block Styled Form -->
 					<!--===================================================-->
 					<?php echo form_open('citizens/add_now'); ?>
 					<div class="panel-body">
 						<div class="row">
 							<div class="col-sm-1">
 								<div class="form-group">
 									<label class="control-label">Title</label>
 									<select name="Citizen_Title" class="selectpicker form-control">
 										<option value="Mr" selected>Mr</option>
 										<option value="Ms">Ms</option>
 										<option value="Mrs">Mrs</option>
 									</select>
 								</div>
 							</div>
 							<div class="col-sm-3">
 								<div class="form-group">
 									<label class="control-label">Last Name</label>
 									<input type="text" class="form-control" name="Citizen_LastName" value="<?php echo set_value('Citizen_LastName'); ?>" placeholder="Enter Last Name" required>
 									<small class="text-danger"><?php echo form_error('Citizen_LastName'); ?></small>
 								</div>
 							</div>
 							<div class="col-sm-3">
 								<div class="form-group">
 									<label class="control-label">First Name</label>
 									<input type="text" class="form-control" name="Citizen_FirstName" value="<?php echo set_value('Citizen_FirstName'); ?>" placeholder="Enter First Name" required>
 									<small class="text-danger"><?php echo form_error('Citizen_FirstName'); ?></small>
 								</div>
 							</div>
 							<div class="col-sm-3">
 								<div class="form-group">
 									<label class="control-label">Middle Name</label>
 									<input type="text" class="form-control" name="Citizen_MiddleName" value="<?php echo set_value('Citizen_MiddleName'); ?>" placeholder="Enter Middle Name">
 									<small class="text-danger"><?php echo form_error('Citizen_MiddleName'); ?></small>
 								</div>
 							</div>
 							<div class="col-sm-2">
 								<div class="form-group">
 									<label class="control-label">Name Suffix</label>
 									<input type="text" class="form-control" name="Citizen_Suffix" value="<?php echo set_value('Citizen_Suffix'); ?>" placeholder="Enter Name Suffix">
 									<small class="text-danger"><?php echo form_error('Citizen_Suffix'); ?></small>
 								</div>
 							</div>
 						</div>
 						<div class="row">
 							<div class="col-sm-4">
 								<div class="form-group">
 									<label class="control-label">Nickname</label>
 									<input type="text" class="form-control" name="Citizen_NickName" value="<?php echo set_value('Citizen_NickName'); ?>" placeholder="Enter Nick Name">
 									<small class="text-danger"><?php echo form_error('Citizen_NickName'); ?></small>
 								</div>
 							</div>
 						</div>
 						<div class="row">
 							<div class="col-sm-6">
 								<div class="form-group">
 									<label class="control-label">Present Address</label>
 									<div class="input-group mar-btm">
 										<input id="address1" type="text" class="form-control" name="address1" value="<?php echo set_value('address1'); ?>" placeholder="Enter Present Address" required readonly>
 										<span class="input-group-btn">
 											<button class="btn btn-success" type="button" data-toggle="modal" data-target="#myModalSearch" 
 											onclick="window.address = 'address1';">+</button>
 										</span>
 									</div>
 									<input id="Citizen_CurrentAddress" type="hidden" name="Citizen_CurrentAddress" value="<?php echo set_value('Citizen_CurrentAddress'); ?>">
 									<input id="Barangay_ID" type="hidden" name="Barangay_ID" value="<?php echo set_value('Barangay_ID'); ?>">
 									<small class="text-danger"><?php echo form_error('Citizen_CurrentAddress'); ?></small>
 									<small class="text-danger"><?php echo form_error('address1'); ?></small>
 								</div>
 							</div>
 							<div class="col-sm-2">
 								<div class="form-group">
 									<label class="control-label">Barangay</label>
 									<input type="text" class="form-control" id="Barangay_ID_Name" name="Barangay_ID_Name" value="<?php echo set_value('Barangay_ID_Name'); ?>" readonly required>
 									<small class="text-danger"><?php echo form_error('Barangay_ID_Name'); ?></small>
 								</div>
 							</div>
 							<div class="col-sm-2">
 								<div class="form-group">
 									<label class="control-label">From</label>
 									<input type="text" class="form-control" onclick="this.type='month'" onblur="this.type='text'" name="currentAddressFrom" value="<?php echo set_value('currentAddressFrom'); ?>">
 									<small class="text-danger"><?php echo form_error('currentAddressFrom'); ?></small>
 								</div>
 							</div>
 							<div class="col-sm-2">
 								<div class="form-group">
 									<label class="control-label">To</label>
 									<div class="input-group mar-btm">
 										<input id="currentAddressTo" type="text" class="form-control" onclick="this.type='month'" onblur="this.type='text'" name="currentAddressTo" value="<?php echo set_value('currentAddressTo'); ?>">
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
 							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Permanent Address</label>
									<div class="input-group mar-btm">
										<input id="address2" type="text" class="form-control" name="address2" value="<?php echo set_value('address2'); ?>" placeholder="Enter Permanent Address" readonly>
										<span class="input-group-btn">
											<button class="btn btn-success" type="button" data-toggle="modal" data-target="#myModalSearch" 
											onclick="window.address = 'address2';">+</button>
 										</span>
 									</div>
 									<input id="Citizen_PermanentAddress" type="hidden" name="Citizen_PermanentAddress" value="<?php echo set_value('Citizen_PermanentAddress'); ?>">
 									<input id="Barangay_ID_Permanent" type="hidden" name="Barangay_ID_Permanent" value="<?php echo set_value('Barangay_ID_Permanent'); ?>">
 									<small class="text-danger"><?php echo form_error('Citizen_PermanentAddress'); ?></small>
 									<small class="text-danger"><?php echo form_error('address2'); ?></small>
 								</div>
 							</div>
 							<div class="col-sm-2">
 								<div class="form-group">
 									<label class="control-label">Barangay</label>
 									<input type="text" class="form-control" id="Barangay_ID_Permanent_Name" name="Barangay_ID_Permanent_Name" value="<?php echo set_value('Barangay_ID_Permanent_Name'); ?>" readonly>
 									<small class="text-danger"><?php echo form_error('Barangay_ID_Permanent_Name'); ?></small>
 								</div>
 							</div>
 							<div class="col-md-2">
 								<div class="form-group">
 									<label class="control-label">From</label>
 									<input type="text" class="form-control" onclick="this.type='month'" onblur="this.type='text'" name="permanentAddressFrom" value="<?php echo set_value('permanentAddressFrom'); ?>">
 									<small class="text-danger"><?php echo form_error('permanentAddressFrom'); ?></small>
 								</div>
 							</div>
 							
 							<div class="col-sm-2">
 								<div class="form-group">
 									<label class="control-label">To</label>
 									<div class="input-group mar-btm">
 										<input id="permanentAddressTo" type="text" class="form-control" onclick="this.type='month'" onblur="this.type='text'" name="permanentAddressTo" value="<?php echo set_value('permanentAddressTo'); ?>">
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
 						<div class="row">
 							<div class="col-sm-4">
 								<div class="form-group">
 									<label class="control-label">Gender</label>
 									<select name="Citizen_Gender" class="selectpicker form-control">
 										<option value="Male" selected>Male</option>
 										<option value="Female">Female</option>
 									</select>
 								</div>
 							</div>

 							<div class="col-sm-4">
 								<div class="form-group">
 									<label class="control-label">Nationality</label>
 									<select name="Nationality_ID" class="selectpicker form-control" required>
 										<?php if(is_array($nationality)): ?>
 											<?php foreach($nationality as $row): ?>
 												<option value="<?php echo $row->Nationality_ID; ?>" selected><?php echo $row->Nationality_Name; ?></option>
 											<?php endforeach; ?>
 										<?php endif; ?>
 									</select>
 									<small class="text-danger"><?php echo form_error('Citizen_Nationality'); ?></small>
 								</div>
 							</div>
 							<div class="col-sm-4">
 								<div class="form-group">
 									<label class="control-label">Civil Status</label>
 									<select name="Citizen_CivilStatus" class="selectpicker form-control" required>
 										<option value="Single">Single</option>
 										<option value="Married">Married</option>
 										<option value="Divorced">Divorced</option>
 										<option value="Widowed">Widowed</option>
 										<option value="Separated">Separated</option>
 										<option value="Livein">Live-in</option>
 									</select>
 								</div>
 							</div>
 						</div>
 						<div class="row">
 							<div class="col-sm-4">
 								<div class="form-group">
 									<label class="control-label">Birth Date</label>
 									<input class="form-control" type="text" onclick="this.type='date'" onblur="this.type='text'" max="<?php echo Date('Y-m-d'); ?>" name="Citizen_BirthDate" value="<?php echo set_value('Citizen_BirthDate'); ?>" placeholder="Enter Birth Date" required>
 									<small class="text-danger"><?php echo form_error('Citizen_BirthDate'); ?></small>
 								</div>
 							</div>
 							<div class="col-sm-4">
 								<div class="form-group">
 									<label class="control-label">Birth Place</label>
 									<input type="text" class="form-control" name="Citizen_BirthPlace" value="<?php echo set_value('Citizen_BirthPlace'); ?>" placeholder="Enter Middle Name">
 									<small class="text-danger"><?php echo form_error('Citizen_BirthPlace'); ?></small>
 								</div>
 							</div>
 							<div class="col-sm-4">
 								<div class="form-group">
 									<label class="control-label">Highest Educational Attainment</label>
 									<select name="Citizen_HighestEducationAttainment" class="selectpicker form-control">
 										<option value="Elementary" selected>Elementary</option>
 										<option value="Highschool">Highschool</option>
 										<option value="College">College</option>
 									</select>
 									<small class="text-danger"><?php echo form_error('Citizen_HighestEducationAttainment'); ?></small>
 								</div>
 							</div>
 						</div>
 						<div class="row">
 							<div class="col-sm-4">
 								<div class="form-group">
 									<label class="control-label">Mobile Number</label>
 									<input type="number" class="form-control" name="Citizen_Mobile" value="<?php echo set_value('Citizen_Mobile'); ?>" placeholder="Enter Mobile Number">
 									<small class="text-danger"><?php echo form_error('Citizen_Mobile'); ?></small>
 								</div>
 							</div>
 							<div class="col-sm-4">
 								<div class="form-group">
 									<label class="control-label">Telephone Number</label>
 									<input type="number" class="form-control" name="Citizen_Telephone" value="<?php echo set_value('Citizen_Telephone'); ?>" placeholder="Enter Telephone Number">
 									<small class="text-danger"><?php echo form_error('Citizen_Telephone'); ?></small>
 								</div>
 							</div>
 							<div class="col-sm-4">
 								<div class="form-group">
 									<label class="control-label">Email Address</label>
 									<input type="email" class="form-control" name="Citizen_Email" value="<?php echo set_value('Citizen_Email'); ?>" placeholder="Enter Email Address">
 									<small class="text-danger"><?php echo form_error('Citizen_Email'); ?></small>
 								</div>
 							</div>
 						</div>
 						<div class="row">
 							<div class="col-sm-4">
 								<div class="form-group">
 									<label class="control-label">Name of Father</label>
 									<input type="text" class="form-control" name="Citizen_NameOfFather" value="<?php echo set_value('Citizen_NameOfFather'); ?>" placeholder="Enter Father's Name">
 									<small class="text-danger"><?php echo form_error('Citizen_NameOfFather'); ?></small>
 								</div>
 							</div>
 							<div class="col-sm-4">
 								<div class="form-group">
 									<label class="control-label">Name of Mother</label>
 									<input type="text" class="form-control" name="Citizen_NameOfMother" value="<?php echo set_value('Citizen_NameOfMother'); ?>" placeholder="Enter Mother's Name">
 									<small class="text-danger"><?php echo form_error('Citizen_NameOfMother'); ?></small>
 								</div>
 							</div>
 							<div class="col-sm-4">
 								<div class="form-group">
 									<label class="control-label">Name of Spouse (If Married)</label>
 									<input type="text" class="form-control" name="Citizen_NameOfSpouse" value="<?php echo set_value('Citizen_NameOfSpouse'); ?>" placeholder="Enter Spouse's Name">
 									<small class="text-danger"><?php echo form_error('Citizen_NameOfSpouse'); ?></small>
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