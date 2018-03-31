<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">

	<!--Page Title-->
	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
	<div id="page-title">
		<h1 class="page-header text-overflow">Surrenderers</h1>
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
								<a href="<?php echo base_url('citizens/add/trm/add'); ?>" class="btn btn-success btn-labeled fa fa-plus">New Citizen</a>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-body">
					<?php if(is_array($citizens)): ?>
						<table id="dt-selection" class="table table-responsive" cellspacing="0" width="100%">
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
											<a href="<?php echo base_url('trm/add/'.$row->Citizen_ID) ?>" class="btn btn-primary">Select</a>
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


		<!-- Row selection (single row) -->
		<!--===================================================-->
		<div class="panel">
			<div class="panel-body">
				<div class="pad-btm form-inline">
					<div class="row">
						<div class="col-sm-6 table-toolbar-left">
							<button type="button" data-toggle="modal" data-target="#myModalSearch" class="btn btn-success btn-labeled fa fa-plus">New Surrenderer</button>
						</div>
					</div>
				</div>
				<?php if(is_array($surrenderers)): ?>
					<table class="table table-responsive table-hover dt-basic" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th></th>
								<th>First Name</th>
								<th>Middle Name</th>
								<th>Last Name</th>
								<th>Suffix</th>
								<th>Barangay</th>
								<th>Date Surrendered</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($surrenderers as $row): ?>
								<tr>
									<?php echo "<td class='text-center'>" . anchor(base_url().'trm/view/'.$row->Citizen_ID.'/'.$row->TRM_ID, '<button class="btn btn-default" title="View TRM"><i class="fa fa-search"></i></button>'). "</td>";
									?>
									<td><?php echo $row->Citizen_FirstName; ?></td>
									<td><?php echo $row->Citizen_MiddleName; ?></td>
									<td><?php echo $row->Citizen_LastName; ?></td>
									<td><?php echo $row->Citizen_Suffix; ?></td>
									<td><?php echo $row->Barangay_Name; ?></td>
									<td><?php echo date('m/d/y', strtotime($row->TRM_DateSurrendered)); ?></td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				<?php else: ?>
					<p>No Data Found.</p>
				<?php endif; ?>
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

