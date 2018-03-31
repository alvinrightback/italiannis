 <!--CONTENT CONTAINER-->
 <!--===================================================-->
 <div id="content-container">

 	<!--Page Title-->
 	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
 	<div id="page-title">
 		<h1 class="page-header text-overflow">New</h1>
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
 		<li class="active">Women's Desk</li>
 	</ol>
 	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
 	<!--End breadcrumb-->
 	<script type="text/javascript">
 		function getCitizen(id){
 			$.ajax({
 				'url' : '<?php  echo base_url('getter/get_citizen/'); ?>'+id,
 				'type' : 'POST', 
 				'data' : {'id' : id},
 				'dataType' : 'json',
 				'cache' : false,
 				'success' : function(data){ 
 					$('#viewCitizen').modal('toggle');
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
 		}
 	</script>

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
 								<a href="<?php echo base_url('citizens/add/womensdesk/add/'.$this->uri->segment(3)); ?>" class="btn btn-success btn-labeled fa fa-plus">New Citizen</a>
 							</div>
 						</div>
 					</div>
 				</div>
 				<div class="modal-body">
 					<?php if(is_array($citizens)): ?>
 						<table id="demo-dt-selection" class="table table-responsive" cellspacing="0" width="100%">
 							<thead>
 								<tr>
 									<th></th>
 									<th>Name</th>
 									<th class="text-center">Select</th>										
 								</tr>
 							</thead>
 							<tbody>
 								<?php foreach($citizens as $row): ?>
 									<tr>
 										<td><button type="button" class="btn btn-link btn-primary" onclick="javascript:getCitizen(<?php echo $row->Citizen_ID; ?>);"><i class="fa fa-search"></i></button></td>
 										<td id="B<?php echo $row->Citizen_ID; ?>"><?php echo $row->Citizen_LastName.', '.$row->Citizen_FirstName.' '.$row->Citizen_MiddleName; ?></td>
 										<td style="text-align: center; vertical-align: middle;">
 											<button class="btn btn-primary" 
 											onclick="
 											$('#Guardian_Citizen_ID').val(<?php echo $row->Citizen_ID; ?>);
 											$('#Guardian_Citizen_ID_Name').val('<?php echo $row->Citizen_Title.'. '.$row->Citizen_LastName.', '.$row->Citizen_FirstName.' '.$row->Citizen_MiddleName; ?> <?php echo $row->Citizen_Suffix == 'NA'? '':$row->Citizen_Suffix; ?>');
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
 			</div>
 		</div>
 	</div>
 	<!--Page content-->
 	<!--===================================================-->
 	<div id="page-content">
 		<div class="row">
 		</div>
 		<div class="row">
 			<div class="panel">
 				<div class="panel-heading">
 					<h3 class="panel-title"><?php echo $apprehension_data[0]->Citizen_Title.'. '.$apprehension_data[0]->Citizen_LastName.', '.$apprehension_data[0]->Citizen_FirstName.' '.$apprehension_data[0]->Citizen_MiddleName; ?> <?php echo $apprehension_data[0]->Citizen_Suffix == 'NA'? '':$apprehension_data[0]->Citizen_Suffix; ?></h3>
 				</div>

 				<!--Block Styled Form -->
 				<!--===================================================-->
 				<div class="panel-body">
 					<?php echo form_open('womensdesk/edit_now'); ?>
 					<div class="row">
 						<div class="col-md-3">
 							<div class="form-group">
 								<label class="control-label">Guardian/Parents</label>
 								<select name="Guardian_Type_ID" class="selectpicker form-control">
 									<?php if(is_array($guardian_type)): ?>
 										<?php foreach($guardian_type as $row): ?>
 											<option value="<?php echo $row->Aux_ID; ?>"<?php echo $row->Aux_ID == $guardian_data[0]->Guardian_Type_ID ? ' selected':'' ?> ><?php echo $row->Aux_Value; ?></option>
 										<?php endforeach; ?>
 									<?php endif; ?>
 								</select>
 								<small class="text-danger"><?php echo form_error('Guardian_Type_ID'); ?></small>
 							</div>
 						</div>
 						<div class="col-md-3">
 							<div class="form-group">
 								<label class="control-label">Name</label>
 								<div class="input-group mar-btm">
 									<input id="Guardian_Citizen_ID_Name" type="text" class="form-control" name="Guardian_Citizen_ID_Name" value="<?php echo $guardian_data[0]->Citizen_Title.'. '.$guardian_data[0]->Citizen_LastName.', '.$guardian_data[0]->Citizen_FirstName.' '.$guardian_data[0]->Citizen_MiddleName; ?> <?php echo $guardian_data[0]->Citizen_Suffix == 'NA'? '':$guardian_data[0]->Citizen_Suffix; ?>" placeholder="Enter Guardian/Parents Name" required readonly>
 									<input id="Guardian_Citizen_ID" type="hidden" name="Guardian_Citizen_ID" value="<?php echo $apprehension_data[0]->Guardian_Citizen_ID; ?>">
 									<span class="input-group-btn">
 										<button class="btn btn-success" type="button" data-toggle="modal" data-target="#myModalSearch">+</button>
 									</span>
 								</div>
 								<small class="text-danger"><?php echo form_error('Guardian_Citizen_ID'); ?></small>
 							</div>
 						</div>
 					</div>
 					<div class="row">
 						<div class="col-sm-3">
 							<div class="form-group">
 								<label class="control-label">Date & Time</label>
 								<input type="text" class="form-control" name="Apprehension_DateTime" value="<?php echo $apprehension_data[0]->Apprehension_DateTime; ?>" placeholder="Enter Date and Time" onclick="this.type='datetime-local'" onblur="this.type='text'">
 								<input type="hidden" name="Citizen_ID" value="<?php echo $apprehension_data[0]->Citizen_ID; ?>">
 								<small class="text-danger"><?php echo form_error('Apprehension_DateTime'); ?></small>
 							</div>
 						</div>
 						<div class="col-sm-9">
 							<div class="form-group">
 								<label class="control-label">Location</label>
 								<input type="text" class="form-control" name="Apprehension_Location" value="<?php echo $apprehension_data[0]->Apprehension_Location; ?>" placeholder="Enter Location">
 								<small class="text-danger"><?php echo form_error('Apprehension_Location'); ?></small>
 							</div>
 						</div>
 					</div>
 					<div class="row">
 						<div class="form-group">
 							<label class="control-label">Narrative</label>
 							<textarea placeholder="Apprehension Narrative" name="Apprehension_Narrative" rows="11" class="form-control"><?php echo $apprehension_data[0]->Apprehension_Narrative; ?></textarea>
 						</div>
 					</div>
 					<div class="row">
 						<div class="form-group">
 							<label class="control-label">Remarks</label>
 							<textarea placeholder="Remarks" name="Apprehension_Remarks" rows="4" class="form-control"><?php echo $apprehension_data[0]->Apprehension_Remarks; ?></textarea>
 						</div>
 					</div>
 					<div class="row">
 						<div class="col-md-3">
 							<div class="form-group">
 								<label class="control-label">OIC Full Name</label>
 								<input type="text" class="form-control" name="OIC_FullName" value="<?php echo $apprehension_data[0]->OIC_FullName; ?>" placeholder="Enter OIC Full Name">
 								<small class="text-danger"><?php echo form_error('OIC_FullName'); ?></small>
 							</div>
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
 	</form>
 </div>
 <!--===================================================-->
 <!--End page content-->
</div>
<!--===================================================-->
            <!--END CONTENT CONTAINER-->