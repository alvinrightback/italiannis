 <!--CONTENT CONTAINER-->
 <!--===================================================-->
 <div id="content-container">

 	<!--Page Title-->
 	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
 	<div id="page-title">
 		<h1 class="page-header text-overflow">Citizen Information</h1>
 	</div>
 	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
 	<!--End page title-->


 	<!--Breadcrumb-->
 	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
 	<ol class="breadcrumb">
 		<li><a href="#">Home</a></li>
 		<li class="active">View Citizen Information</li>
 	</ol>
 	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
 	<!--End breadcrumb-->
 	<?php
 	if($success){
 		echo "<div class='alert alert-success'>" . $success . "</div>";
 	}
 	if($failed){
 		echo "<div class='alert alert-danger'>" . $failed . "</div>";
 	}
 	?>

 	<!--Page content-->
 	<!--===================================================-->
 	<div id="page-content">
 		<div class="row">
 			<div class="col-sm-9">
 				<div class="panel">
 					<div class="panel-heading">
 						<h3 class="panel-title">Personal Information <a href="<?php echo base_url('citizens/edit/'.$citizen_data[0]->Citizen_ID); ?>" style="margin-top: 1%;" class="btn btn-link pull-right"><i class="fa fa-edit"></i> Edit</a></h3>
 					</div>

 					<!--Bordered Table-->
 					<!--===================================================-->
 					<div class="panel-body">
 						<div class="table-responsive">
 							<table class="table table-bordered table-hover">
 								<tbody>
 									<?php if(is_array($citizen_data)): ?>
 										<tr>
 											<td class="col-md-2"><b>Title</b></td>
 											<td><?php echo $citizen_data[0]->Citizen_Title; ?></td>
 										</tr>
 										<tr>
 											<td class="col-md-2"><b>Last Name</b></td>
 											<td><?php echo $citizen_data[0]->Citizen_LastName; ?></td>
 										</tr>
 										<tr>
 											<td class="col-md-2"><b>First Name</b></td>
 											<td><?php echo $citizen_data[0]->Citizen_FirstName; ?></td>
 										</tr>
 										<tr>
 											<td class="col-md-2"><b>Middle Name</b></td>
 											<td><?php echo $citizen_data[0]->Citizen_MiddleName; ?></td>
 										</tr>
 										<tr>
 											<td class="col-md-2"><b>Name Suffix</b></td>
 											<td><?php echo $citizen_data[0]->Citizen_Suffix; ?></td>
 										</tr>
 										<tr>
 											<td class="col-md-2"><b>Nickname</b></td>
 											<td><?php echo $citizen_data[0]->Citizen_NickName; ?></td>
 										</tr>
 										<tr>
 											<td class="col-md-2"><b>Barangay</b></td>
 											<td><?php echo $barangay[0]->Barangay_Name; ?></td>
 										</tr>
 										<tr>
 											<td class="col-md-2"><b>Gender</b></td>
 											<td><?php echo $citizen_data[0]->Citizen_Gender; ?></td>
 										</tr>
 										<tr>
 											<td class="col-md-2"><b>Birth Date</b></td>
 											<td><?php echo date('m/d/Y', strtotime($citizen_data[0]->Citizen_BirthDate)); ?></td>
 										</tr>
 										<tr>
 											<td class="col-md-2"><b>Birth Place</b></td>
 											<td><?php echo $citizen_data[0]->Citizen_BirthPlace; ?></td>
 										</tr>
 										<tr>
 											<td class="col-md-2"><b>Highest Educational Attainment</b></td>
 											<td><?php echo $citizen_data[0]->Citizen_HighestEducationAttainment; ?></td>
 										</tr>
 										<tr>
 											<td class="col-md-2"><b>Civil Status</b></td>
 											<td><?php echo $citizen_data[0]->Citizen_CivilStatus; ?></td>
 										</tr>
 										<tr>
 											<td class="col-md-2"><b>Nationality</b></td>
 											<td><?php echo $nationality[0]->Nationality_Name; ?></td>
 										</tr>	
 										<tr>
 											<td class="col-md-2"><b>Mobile Number</b></td>
 											<td><?php echo $citizen_data[0]->Citizen_Mobile; ?></td>
 										</tr>
 										<tr>
 											<td class="col-md-2"><b>Telephone Number</b></td>
 											<td><?php echo $citizen_data[0]->Citizen_Telephone; ?></td>
 										</tr>
 										<tr>
 											<td class="col-md-2"><b>Email Address</b></td>
 											<td><?php echo $citizen_data[0]->Citizen_Email; ?></td>
 										</tr>
 										<tr>
 											<td class="col-md-2"><b>Name of Father</b></td>
 											<td><?php echo $citizen_data[0]->Citizen_NameOfFather; ?></td>
 										</tr>
 										<tr>
 											<td class="col-md-2"><b>Name of Mother</b></td>
 											<td><?php echo $citizen_data[0]->Citizen_NameOfMother; ?></td>
 										</tr>
 										<tr>
 											<td class="col-md-2"><b>Name of Spouse</b></td>
 											<td><?php echo $citizen_data[0]->Citizen_NameOfSpouse; ?></td>
 										</tr>
 									<?php endif; ?>
 								</tbody>
 							</table>
 						</div>
 					</div>
 					<!--===================================================-->
 					<!--End Bordered Table-->
 				</div>
 				<div class="panel">
 					
 					<div class="panel-heading">
 						<h3 class="panel-title">Address<a href="<?php echo base_url('citizens/address/'.$citizen_data[0]->Citizen_ID); ?>" style="margin-top: 2%;" class="btn btn-link pull-right"><i class="fa fa-edit"></i> Edit</a></h3>
 					</div>

 					<div class="panel-body">

 						<div class="table-responsive">

 							<table class="table table-bordered table-hover">
 								<tbody>

 									<tr>
 										<td class="col-md-2"><b>Current Address</b></td>
 										<td><?php echo $currentAddress[0]->Address_Name; ?>
 											<?php if(isset($currentAddress[0]->Barangay_ID)): ?>
 												<?php if($currentAddress[0]->Barangay_Name): ?>
	 												<?php echo ', ';?>
	 												<?php echo $currentAddress[0]->Barangay_ID != 'N' ? $currentAddress[0]->Barangay_Name: ''; ?>
	 											<?php endif; ?>
 											<?php endif; ?>
 										</td>
 										<th>From</th>
 										<td><?php echo Date('F Y', strtotime($currentAddress[0]->Stay_From_Date)); ?></td>
 										<th>To</th>
 										<td><?php echo $currentAddress[0]->Stay_To_Date == 'Present' ? 'Present': Date('F Y', strtotime($currentAddress[0]->Stay_To_Date)); ?></td>
 									</tr>
 									<tr style="display: none;">
 										<td class="col-md-2"><b>Permanent Address</b></td>
 										<td><?php echo $permanentAddress[0]->Address_Name; ?>
 											<?php if(isset($permanentAddress[0]->Barangay_ID)): ?>
 												<?php if($permanentAddress[0]->Barangay_Name != 'Others'): ?>
 													<?php echo ', ';?>
 													<?php echo $permanentAddress[0]->Barangay_ID != 'N' ? $permanentAddress[0]->Barangay_Name: ''; ?>
 												<?php endif; ?>
 											<?php endif; ?>
 										</td>
 										<th>From</th>
 										<td><?php echo Date('F Y', strtotime($permanentAddress[0]->Stay_From_Date)); ?></td>
 										<th>To</th>
 										<td><?php echo $permanentAddress[0]->Stay_To_Date == 'Present' ? 'Present': Date('F Y', strtotime($permanentAddress[0]->Stay_To_Date)); ?></td>
 									</tr>
 								</tbody>
 							</table>
 						</div>
 					</div>
 				</div>
 			</div>
 			<div class="col-md-3">

 				<div class="panel">
 					<div class="panel-heading">
 						<h3 class="panel-title">Display Photo<a href="<?php echo base_url('citizens/photo/'.$citizen_data[0]->Citizen_ID); ?>" style="margin-top: 2%;" class="btn btn-link pull-right"><i class="fa fa-edit"></i> Edit</a></h3>
 					</div>
 					<div class="panel-body">
 						<?php if(@getimagesize(base_url('resources/images/citizen_photo/'.$citizen_data[0]->Citizen_ID.'.jpeg'))): ?>
 							<img src="<?php echo base_url('resources/images/citizen_photo/'.$citizen_data[0]->Citizen_ID)?>.jpeg" class="img-responsive">
 						<?php else: ?>
 							<img src="<?php echo base_url('resources/images/citizen_photo/placeholder.jpeg')?>" class="img-responsive">
 						<?php endif; ?>
 					</div>
 				</div>
 				

 			</div>
 		</div>

 		<div class="row">
 			<div class="col-md-9">
 				<div class="panel">
 					<div class="panel-heading">
 						<h3 class="panel-title">Property</h3>
 					</div>


 					<div class="panel-body">
 						<?php if(is_array($properties)): ?>
 								<table class="table table-responsive table-hover table-bordered" cellspacing="0" width="100%">
 									<thead>
 										<tr>
 											<th></th>
 											<th>Name</th>
 											<th>Submission Date</th>
 										</tr>
 									</thead>
 									<tbody>
 										<?php foreach($properties as $row): ?>
 											<tr>
	 											<?php echo "<td class='text-center'>" . anchor(base_url().'property/view/'.$row->REP_ID, '<button class="btn btn-default" title="View Property"><i class="fa fa-search"></i></button>'). "</td>";
	 											?>
 												<td><?php echo $row->REP_Name; ?></td>
 												<td><?php echo date('F Y', strtotime($row->REP_Submission_Date)) ?></td>
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

 		<div class="row">
 			<div class="col-md-9">
 				<div class="panel">
 					<div class="panel-heading">
 						<h3 class="panel-title">History</h3>
 					</div>
 				</div>
 			</div>
 		</div>
 		<div class="row">
 			<div class="col-md-9">
 				<div class="tab-base">

 					<!--Nav Tabs-->
 					<ul class="nav nav-tabs">
 						<li class="active">
 							<a data-toggle="tab" href="#trm">TRM</a>
 						</li>
 						<li>
 							<a data-toggle="tab" href="#address">Address</a>
 						</li>
 					</ul>

 					<!--Tabs Content-->
 					<div class="tab-content">
 						<div id="trm" class="tab-pane fade active in">
 							<?php if(is_array($trm_data)): ?>
 								<table class="table table-striped table-bordered" cellspacing="0" width="100%">
 									<thead>
 										<tr>
 											<th></th>
 											<th>Date Surrendered</th>
 										</tr>
 									</thead>
 									<tbody>
 										<?php foreach($trm_data as $row): ?>
 											<tr>
 												<?php echo "<td class='text-center'>" . anchor(base_url().'trm/view/'.$row->Citizen_ID.'/'.$row->TRM_ID, '<button class="btn btn-default" title="View TRM"><i class="fa fa-search"></i></button>'). "</td>";
 												?>
 												<td><?php echo $row->TRM_DateSurrendered; ?></td>
 											</tr>
 										<?php endforeach; ?>
 									</tbody>
 								</table>
 							<?php else: ?>
 								<p>No Data Found.</p>
 							<?php endif; ?>
 						</div>
 						<div id="address" class="tab-pane fade">
 							<?php if(is_array($history_address)): ?>
 								<table class="table table-striped table-bordered" cellspacing="0" width="100%">
 									<thead>
 										<tr>
 											<th>Address</th>
 											<th>From</th>
 											<th>To</th>
 										</tr>
 									</thead>
 									<tbody>
 										<?php foreach($history_address as $row): ?>
 											<tr>
 												<td><?php echo $row->Address_Name; ?>
 													<?php if(isset($row->Barangay_ID)): ?>
 														<?php if($row->Barangay_Name != 'Others'): ?>
	 														<?php echo ', ';?>
	 														<?php echo $row->Barangay_ID != 'N' ? $row->Barangay_Name: ''; ?>
 														<?php endif; ?>
 													<?php endif; ?>
 												</td>
 												<td><?php echo date('F Y', strtotime($row->Stay_From_Date)) ?></td>
 												<td><?php echo $row->Stay_To_Date == 'Present' ? 'Present' : date('F Y', strtotime($row->Stay_To_Date)) ?></td>
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
 		</div>



 	</div>
 	<!--===================================================-->
 	<!--End page content-->


 </div>
 <!--===================================================-->
            <!--END CONTENT CONTAINER-->