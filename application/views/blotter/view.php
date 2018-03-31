 <!--CONTENT CONTAINER-->
 <!--===================================================-->
 <div id="content-container">

 	<!--Page Title-->
 	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
 	<div id="page-title">
 		<h1 class="page-header text-overflow">Blotter</h1>
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
 		<li class="active">Blotter Information</li>
 	</ol>
 	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
 	<!--End breadcrumb-->

 	<script type="text/javascript">
 		var ajaxData;
 		var selectedForm;

 		function getCitizen(id){
 			$.ajax({
 				'url' : '<?php  echo base_url('getter/get_citizen/'); ?>'+id,
 				'type' : 'POST', 
 				'data' : {'id' : id},
 				'dataType' : 'json',
 				'cache' : false,
 				'success' : function(data){ 
 					$('#viewCitizen').modal('toggle');
 					ajaxData = data;
 					var suffix = data['info'][0]['Citizen_Suffix'] !== null ? data['info'][0]['Citizen_Suffix'] : '';
 					var currentBarangay = data['currentAddress'][0]['Barangay_Name'] != 'Others' ? ', '+data['currentAddress'][0]['Barangay_Name'] : '';
 					var permanentBarangay = data['permanentAddress'][0]['Barangay_Name'] != 'Others' ? ', '+data['permanentAddress'][0]['Barangay_Name'] : '';

 					$('#fullname').text(data['info'][0]['Citizen_Title']+' '+data['info'][0]['Citizen_LastName']+', '+data['info'][0]['Citizen_FirstName']+' '+data['info'][0]['Citizen_MiddleName']+' '+suffix);
 					$('#currentAddress').text(data['currentAddress'][0]['Address_Name']+currentBarangay);
 					$('#permanentAddress').text(data['permanentAddress'][0]['Address_Name']+permanentBarangay);
 					$('#gender').text(data['info'][0]['Citizen_Gender']);
 					$('#birthDate').text(data['info'][0]['Citizen_BirthDate']);
 					$('#birthPlace').text(data['info'][0]['Citizen_BirthPlace']);
 					$('#civilStatus').text(data['info'][0]['Citizen_CivilStatus']);
 					$('#nationality').text(data['info'][0]['Nationality_Name']);
 					$('#mobile').text(data['info'][0]['Citizen_Mobile']);
 					$('#telephone').text(data['info'][0]['Citizen_Telephone']);
 					$('#email').text(data['info'][0]['Citizen_Email']);
 					$('#nameOfFather').text(data['info'][0]['Citizen_NameOfFather']);
 					$('#nameOfMother').text(data['info'][0]['Citizen_NameOfMother']);
 					$('#nameOfSpouse').text(data['info'][0]['Citizen_NameOfSpouse']);

						//Image
						var url = '<?php echo base_url('resources/images/citizen_photo/'); ?>'+id+'.jpeg';
						$('#photo').attr('src', url);

					}
				});
 		};

 		function selectCitizen(){
 			$('#ID').val(ajaxData['info'][0]['Citizen_ID']);
 			$('#First_Name').val(ajaxData['info'][0]['Citizen_FirstName']);
 			$('#Last_Name').val(ajaxData['info'][0]['Citizen_LastName']);
 			$('#Middle_Name').val(ajaxData['info'][0]['Citizen_MiddleName']);
 			$('#Contact_Number').val(ajaxData['info'][0]['Citizen_Mobile']);
 			$('#Complete_Address').val(ajaxData['currentAddress'][0]['Address_Name']+', '+ajaxData['currentAddress'][0]['Barangay_Name']);
 			$('#Nationality_ID').val(ajaxData['info'][0]['Nationality_ID']).change();
 			$('#complainantDetails :input').attr("readonly", true);
 			$('#viewCitizen').modal('toggle');
 			$('#myModalSearch').modal('toggle');
 		};


 		function getPerson(type, id){
 			var prefix;
 			if(type == 'complainant'){
 				prefix = 'Com_';
 			}
 			if(type == 'respondent'){
 				prefix = 'Res_';
 			}
 			$.ajax({
 				'url' : '<?php  echo base_url('getter/get_person/'); ?>',
 				'type' : 'POST', 
 				'data' : {'id' : id, 'type': type},
 				'dataType' : 'json',
 				'cache' : false,
 				'success' : function(data){ 
 					console.log(data);
 					$('#viewPerson').modal('toggle');

 					$('#personFullName').text(data['info'][0][prefix+'Last_Name']+', '+data['info'][0][prefix+'First_Name']+' '+data['info'][0][prefix+'Middle_Name']);
 					$('#personNationality').text(data['info'][0]['Nationality_Name']);
 					$('#personContactNumber').text(data['info'][0][prefix+'Contact_Number']);
 					$('#personCompleteAddress').text(data['info'][0][prefix+'Complete_Address']);
 					$('#personDateAdded').text(data['info'][0]['DateCreated']);
					}
				});
 		};
 	</script>

 	<!--Modal Search Citizen -->
 	<div id="myModalSearch" class="modal fade" role="dialog">
 		<div class="modal-dialog">

 			<!-- Modal content-->
 			<div class="modal-content">
 				<div class="modal-header">
 					<button type="button" class="close" data-dismiss="modal">&times;</button>
 					<h3 class="modal-title">Citizen List</h3>
 				</div>
 				<div class="modal-body">
 					<?php if(is_array($citizens)): ?>
 						<table id="dt-selection" class="table table-responsive" cellspacing="0" width="100%">
 							<thead>
 								<tr>
 									<th>Name</th>
 									<th>View</th>								
 								</tr>
 							</thead>
 							<tbody>
 								<?php foreach($citizens as $row): ?>
 									<tr>
 										<td id="B<?php echo $row->Citizen_ID; ?>"><?php echo $row->Citizen_LastName.', '.$row->Citizen_FirstName.' '.$row->Citizen_MiddleName; ?></td>						
 										<td><button type="button" class="btn btn-link btn-primary" onclick="javascript:getCitizen(<?php echo $row->Citizen_ID; ?>);"><i class="fa fa-search"></i></button></td>		
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


 	<!-- Inner Modal -->

 	<div id="viewCitizen" class="modal fade">
 		<div class="modal-dialog">

 			<!-- Modal content-->
 			<div class="modal-content">
 				<div class="modal-header">
 					<button type="button" class="close" data-dismiss="modal">&times;</button>
 					<h3 id="fullname" class="modal-title">Name</h3>
 				</div>
 				<div class="modal-body">

 					<div class="row">
 						<div class="col-md-3">
 							<img id="photo" onerror="this.src = '<?php echo base_url('resources/images/citizen_photo/placeholder.jpeg')?>' " class="img-responsive">
 						</div>
 						<div class="col-md-9">
 							<div class="table-responsive">
 								<table class="table table-bordered table-hover">
 									<tbody>
 										<tr>
 											<td class="col-md-3"><b>Current Address</b></td>
 											<td id="currentAddress"></td>
 										</tr>
 										<tr>
 											<td class="col-md-3"><b>Permanent Address</b></td>
 											<td id="permanentAddress"></td>
 										</tr>
 										<tr>
 											<td class="col-md-3"><b>Gender</b></td>
 											<td id="gender"></td>
 										</tr>
 										<tr>
 											<td class="col-md-3"><b>Birth Date</b></td>
 											<td id="birthDate"></td>
 										</tr>
 										<tr>
 											<td class="col-md-3"><b>Birth Place</b></td>
 											<td id="birthPlace"></td>
 										</tr>
 										<tr>
 											<td class="col-md-3"><b>Civil Status</b></td>
 											<td id="civilStatus"></td>
 										</tr>
 										<tr>
 											<td class="col-md-3"><b>Nationality</b></td>
 											<td id="nationality"></td>
 										</tr>	
 										<tr>
 											<td class="col-md-3"><b>Mobile Number</b></td>
 											<td id="mobile"></td>
 										</tr>
 										<tr>
 											<td class="col-md-3"><b>Telephone Number</b></td>
 											<td id="telephone"></td>
 										</tr>
 										<tr>
 											<td class="col-md-3"><b>Email Address</b></td>
 											<td id="email"></td>
 										</tr>
 										<tr>
 											<td class="col-md-3"><b>Name of Father</b></td>
 											<td id="nameOfFather"></td>
 										</tr>
 										<tr>
 											<td class="col-md-3"><b>Name of Mother</b></td>
 											<td id="nameOfMother"></td>
 										</tr>
 										<tr>
 											<td class="col-md-3"><b>Name of Spouse</b></td>
 											<td id="nameOfSpouse"></td>
 										</tr>
 									</tbody>
 								</table>

 							</div>
 						</div>
 					</div>
 				</div>
 				<div class="modal-footer">
 					<button class="btn btn-default" data-dismiss="modal" type="button">Close</button>
 					<button onclick="javascript:selectCitizen();" class="btn btn-primary" type="button">Select</button>
 				</div>
 			</div>
 		</div>
 	</div>


 	<!-- View Person Modal -->

 	<div id="viewPerson" class="modal fade">
 		<div class="modal-dialog">

 			<!-- Modal content-->
 			<div class="modal-content">
 				<div class="modal-header">
 					<button type="button" class="close" data-dismiss="modal">&times;</button>
 					<h3 id="personFullName" class="modal-title"></h3>
 				</div>
 				<div class="modal-body">

 					<div class="row">
 							<div class="table-responsive">
 								<table class="table table-bordered table-hover">
 									<tbody>
 										<tr>
 											<td class="col-md-3"><b>Nationality</b></td>
 											<td id="personNationality"></td>
 										</tr>
 										<tr>
 											<td class="col-md-3"><b>Contact Number</b></td>
 											<td id="personContactNumber"></td>
 										</tr>
 										<tr>
 											<td class="col-md-3"><b>Complete Address</b></td>
 											<td id="personCompleteAddress"></td>
 										</tr>
 										<tr>
 											<td class="col-md-3"><b>Date Added</b></td>
 											<td id="personDateAdded"></td>
 										</tr>	
 									</tbody>
 								</table>
 							</div>
 					</div>
 				</div>
 				<div class="modal-footer">
 					<button class="btn btn-default" data-dismiss="modal" type="button">Close</button>
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
 			<div class="col-md-6">
 				<div class="panel">
 					<div class="panel-heading">
 						<h3 class="panel-title">Blotter Information <a href="<?php echo base_url('blotter/edit/'.$blotter_data[0]->Blotter_ID); ?>" style="margin-top: 1%;" class="btn btn-link pull-right"><i class="fa fa-edit"></i> Edit</a></h3>
 					</div>
 					<div class="panel-body">
 						<table class="table table-responsive table-bordered">
 							<tbody>
 								<?php if(is_array($blotter_data)): ?>
 									<tr>
 										<td class="col-md-4"><b>Incident Date From</b></td>
 										<td><?php echo $blotter_data[0]->Incident_Date_From; ?></td>
 									</tr>
 									<tr>
 										<td class="col-md-4"><b>Incident Date To</b></td>
 										<td><?php echo $blotter_data[0]->Incident_Date_To; ?></td>
 									</tr>
 									<tr>
 										<td class="col-md-4"><b>Complained Date</b></td>
 										<td><?php echo $blotter_data[0]->Complained_Date; ?></td>
 									</tr>
 									<tr>
 										<td class="col-md-4"><b>Complaint Status</b></td>
 										<td><?php echo $blotter_data[0]->Aux_Value; ?></td>
 									</tr>
 								<?php endif; ?>
 							</tbody>
 						</table>
 						<p>Nature Of Complaint</p>
 						<pre><?php echo $blotter_data[0]->Nature_Of_Complaint; ?></pre>
 					</div>
 				</div>
 			</div>
 			<div class="col-md-6">
 				<div class="panel" id="addPanel">
 					<div class="panel-footer text-right">
 						<button class="btn btn-link" id="add" onclick="$('#addPeople').show(); $('#add, #addPanel').hide();" type="button"><i class="fa fa-plus"></i> Add People</button>
 					</div>
 				</div>
 				<div class="panel" id="addPeople" style="display: none;">
 					<div class="panel-heading">
 						<h3 class="panel-title">Add People <button type="button" data-toggle="modal" data-target="#myModalSearch" style="margin-top: 1%;" class="btn btn-link pull-right"><i class="fa fa-plus"></i> Citizen</a></h3>
 					</div>
 					<div class="panel-body">
 						<?php echo form_open('blotter/add_people_now'); ?>

 						<div class="form-group">
 							<label class="control-label">Type</label>
 							<div class="radio">
 								<input id="demo-inline-form-radio" class="magic-radio" type="radio" value="Com_" name="Type" checked>
 								<label for="demo-inline-form-radio">Complainant</label>
 								<input id="demo-inline-form-radio-2" class="magic-radio" type="radio" value="Res_" name="Type">
 								<label for="demo-inline-form-radio-2">Respondent</label>
 							</div>
 						</div>

 						<div class="form-group">
 							<label class="control-label">Last Name</label>
 							<input id="Last_Name" type="text" class="form-control" name="Last_Name" value="<?php echo set_value('Last_Name'); ?>" placeholder="Enter Last Name" required>
 							<input type="hidden" id="ID" name="ID" value="0">
 							<input type="hidden" value="<?php echo $this->uri->segment(3); ?>" name="Blotter_ID">
 							<small class="text-danger"><?php echo form_error('Last_Name'); ?></small>
 						</div>

 						<div class="form-group">
 							<label class="control-label">First Name</label>
 							<input id="First_Name" type="text" class="form-control" name="First_Name" value="<?php echo set_value('First_Name'); ?>" placeholder="Enter First Name" required>
 							<small class="text-danger"><?php echo form_error('First_Name'); ?></small>
 						</div>

 						<div class="form-group">
 							<label class="control-label">Middle Name</label>
 							<input id="Middle_Name" type="text" class="form-control" name="Middle_Name" value="<?php echo set_value('Middle_Name'); ?>" placeholder="Enter Middle Name">
 							<small class="text-danger"><?php echo form_error('Middle_Name'); ?></small>
 						</div>

 						<div class="form-group">
 							<label class="control-label">Contact Number</label>
 							<input id="Contact_Number" type="number" class="form-control" name="Contact_Number" value="<?php echo set_value('Contact_Number'); ?>" placeholder="Enter Contact Number">
 							<small class="text-danger"><?php echo form_error('Contact_Number'); ?></small>
 						</div>

 						<div class="form-group">
 							<label class="control-label">Nationality</label>
 							<select id="Nationality_ID" name="Nationality_ID" class="selectpicker form-control" required>
 								<?php if(is_array($nationality)): ?>
 									<?php foreach($nationality as $row): ?>
 										<option value="<?php echo $row->Nationality_ID; ?>"><?php echo $row->Nationality_Name; ?></option>
 									<?php endforeach; ?>
 								<?php endif; ?>
 							</select>
 							<small class="text-danger"><?php echo form_error('Nationality_ID'); ?></small>
 						</div>

 						<div class="form-group">
 							<label class="control-label">Complete Address</label>
 							<textarea id="Complete_Address" class="form-control" name="Complete_Address"></textarea>
 							<small class="text-danger"><?php echo form_error('Complete_Address'); ?></small>
 						</div>
 					</div>
 					<div class="panel-footer text-right">
 						<button class="btn btn-default" onclick="$('#add, #addPanel').show(); $('#addPeople').hide();" type="button">Close</button>
 						<button class="btn btn-success" type="submit">Submit</button>
 					</div>

 				</form>
 			</div>

 			<div class="panel">
 				<div class="panel-heading">
 					<h3 class="panel-title">Complainants</h3>
 				</div>
 				<div class="panel-body">
 				<?php if(is_array($complainants)): ?>
 						<table class="table table-responsive" cellspacing="0" width="100%">
 							<thead>
 								<tr>
 									<th>Full Name</th>
 									<th>Actions</th>
 								</tr>
 							</thead>
 							<tbody>
 								<?php foreach($complainants as $row): ?>
 									<tr>
 										<td><?php echo $row->Com_Last_Name.', '.$row->Com_First_Name.' '.$row->Com_Middle_Name; ?></td>
 										<td>
 										<button type="button" class="btn btn-link btn-primary" onclick="javascript:getPerson('complainant',<?php echo $row->Blotter_Complainant_ID; ?>);"><i class="fa fa-search"></i></button>
 										<a href="<?php echo base_url('blotter/delete_people_now/complainant/'.$row->Blotter_Complainant_ID.'/'.$this->uri->segment(3)); ?>" class="btn btn-link btn-danger bootbox-confirm"><i class="fa fa-trash"></i></a>
 										</td>			
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
 					<h3 class="panel-title">Respondents</h3>
 				</div>
 				<div class="panel-body">
 					<?php if(is_array($respondents)): ?>
 						<table class="table table-responsive" cellspacing="0" width="100%">
 							<thead>
 								<tr>
 									<th>Full Name</th>
 									<th>Actions</th>
 								</tr>
 							</thead>
 							<tbody>
 								<?php foreach($respondents as $row): ?>
 									<tr>
 										<td><?php echo $row->Res_Last_Name.', '.$row->Res_First_Name.' '.$row->Res_Middle_Name; ?></td>	
 										<td>
 										<button type="button" class="btn btn-link btn-primary" onclick="javascript:getPerson('respondent',<?php echo $row->Blotter_Respondent_ID; ?>);"><i class="fa fa-search"></i></button>
 										<a href="<?php echo base_url('blotter/delete_people_now/respondent/'.$row->Blotter_Respondent_ID.'/'.$this->uri->segment(3)); ?>" class="btn btn-link btn-danger bootbox-confirm"><i class="fa fa-trash"></i></a>
 										</td>		
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