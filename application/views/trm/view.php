 <!--CONTENT CONTAINER-->
 <!--===================================================-->
 <div id="content-container">

 	<!--Page Title-->
 	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
 	<div id="page-title">
 		<h1 class="page-header text-overflow">TRM Information</h1>
 	</div>
 	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
 	<!--End page title-->


 	<!--Breadcrumb-->
 	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
 	<ol class="breadcrumb">
 		<li><a href="#">Home</a></li>
 		<li class="active">View TRM Information</li>
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
 						<h3 class="panel-title"><?php echo $citizen_data[0]->Citizen_Title.'. '.$citizen_data[0]->Citizen_LastName.', '.$citizen_data[0]->Citizen_FirstName.' '.$citizen_data[0]->Citizen_MiddleName; ?><a href="<?php echo base_url('trm/edit/'.$trm_data[0]->Citizen_ID.'/'.$trm_data[0]->TRM_ID); ?>" style="margin-top: 2%;" class="btn btn-link pull-right"><i class="fa fa-edit"></i> Edit</a></h3>
 					</div>


 					<!--Bordered Table-->
 					<!--===================================================-->
 					<div class="panel-body">
 						<div class="table-responsive">
 							<table class="table table-bordered table-hover">
 								<tbody>
 									<?php if(is_array($trm_data)): ?>
 										<tr>
 											<td class="col-md-2"><b>Date Surrendered</b></td>
 											<td><?php echo date('m/d/Y', strtotime($trm_data[0]->TRM_DateSurrendered)); ?></td>
 										</tr>
 										<tr>
 											<td class="col-md-2"><b>Age of First Drug Use</b></td>
 											<td><?php echo $trm_data[0]->AOFDU_Value; ?></td>
 										</tr>
 										<tr>
 											<td class="col-md-2"><b>Drug first tried</b></td>
 											<td><?php echo $trm_data[0]->Drug_Name; ?></td>
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
 						<h3 class="panel-title">Drugs Currently Used</h3>
 					</div>
 					<div class="panel-body">
 						<?php if(isset($drug_used)): ?>
 							<div class="table-responsive">
 								<table class="table table-bordered">
 									<thead>
 										<tr>
 											<th>Drugs Currently Used</th>
 											<th>Source</th>
 											<th>Frequency Of Use</th>
 											<th>Mode of Drug Use</th>
 											<th>Amount Spent Per Drug Intake</th>
 										</tr>
 									</thead>
 									<tbody>

 										<?php foreach($drug_used as $row): ?>
 											<tr>
 												<td><?php echo $row->Drug_Name; ?></td>
 												<td><?php echo $row->SOD_Value; ?></td>
 												<td><?php echo $row->FOU_Value; ?></td>
 												<td><?php echo $row->MODU_Value; ?></td>
 												<td><?php echo $row->TRM_AmountSpentPerDrugIntake; ?></td>										
 											</tr>
 										<?php endforeach; ?>
 									</tbody>
 								</table>
 							</div>
 						<?php endif; ?>
 					</div>
 				</div>
 			</div>

 			<div class="col-md-3">

 				<div class="panel">
 					<div class="panel-heading">
 						<h3 class="panel-title">Display Photo</h3>
 					</div>
 					<div class="panel-body">
 						<?php if(@getimagesize(base_url('resources/images/citizen_photo/'.$citizen_data[0]->Citizen_ID.'.jpeg'))): ?>
 							<img src="<?php echo base_url('resources/images/citizen_photo/'.$citizen_data[0]->Citizen_ID)?>.jpeg" class="img-responsive">
 						<?php else: ?>
 							<img src="<?php echo base_url('resources/images/citizen_photo/placeholder.jpeg')?>" class="img-responsive hov"
 							style="hov:hover{opacity: 0.5;}"
 							>
 						<?php endif; ?>
 					</div>
 				</div>
 			</div>
 		</div>

 		<div class="row">
 			<div class="col-md-9">
 				<div class="panel">
 					<div class="panel-heading">
 						<h3 class="panel-title">Data Ralative To Availment of Community-Based Program</h3>
 					</div>
 					<div class="panel-body">
 						<table class="table table-hover">
 							<tbody>
 								<?php if(is_array($trm_data)): ?>

 									<?php if($trm_data[0]->TRM_ScreeningResult_ID == 1): ?>
 										<tr>
 											<td class="col-md-2"><b>Screening Result</b></td>
 											<td>Low to Mild</td>
 										</tr>
 									<?php elseif($trm_data[0]->TRM_ScreeningResult_ID == 2): ?>
 										<tr>
 											<td class="col-md-2"><b>Screening Result</b></td>
 											<td>Moderate to Severe</td>
 											<td></td>
 										</tr>
 										<tr>
 											<td></td>
 											<td class="col-md-2"><b>Referred To</b></td>
 											<td><?php echo $trm_data[0]->TRM_ScreeningResultReferredTo; ?></td>
 										</tr>		 										
 									<?php endif; ?>

 									<!-- Intervention -->
 									
 									<tr>
 										<td class="col-md-2"><b>Intervention Availed</b></td>
 										<?php switch($trm_data[0]->TRM_Intervention_Avail_ID): 
 										case 1: 
 										?>
 										<td>Brief Intervention</td>
 										<?php break; ?>
 										<?php case 2: ?>
 										<td>Psychoeducation</td>
 										<?php break; ?>
 										<?php case 3: ?>
 										<td>Social Support</td>
 										<?php break; ?>
 										<?php case 4: ?>
 										<td>Referral for Program Intervention - Community Service</td>
 										<?php break; ?>
 										<?php case 5: ?>
 										<td>Referral for Program Intervention - Skills Development Training</td>
 										<?php break; ?>
 										<?php case 6: ?>
 										<td>Referral for Program Intervention - Others</td>
 										<?php break; ?>
 										<?php endswitch; ?>
 									</tr>
 									<?php if($trm_data[0]->TRM_Intervention_Avail_ID == 6): ?>
 										<tr>
 											<td></td>
 											<td class="col-md-2"><b>Specific Reason</b></td>
 											<td><?php echo $trm_data[0]->TRM_Intervention_Avail_Others;?></td>
 										</tr>
 										<tr>
 											<td></td>
 											<td class="col-md-2"><b>Date of Entry in the Program</b></td>
 											<td><?php echo $trm_data[0]->TRM_Intervention_Avail_DateOfentry;?></td>
 										</tr>
 										<tr>
 											<td></td>
 											<td class="col-md-2"><b>Date Finished the Program</b></td>
 											<td><?php echo $trm_data[0]->TRM_Intervention_Avail_DateFinished;?></td>
 										</tr>	

 									<?php endif; ?>


 									<!-- Treatment -->
 									<tr>
 										<td class="col-md-2"><b>Intervention Availed</b></td>
 										<?php switch($trm_data[0]->TRM_Treatment_Avail_ID): 
 										case 1: 
 										?>
 										<td>Out-patient Service</td>
 										<?php break; ?>
 										<?php case 2: ?>
 										<td>Community Based</td>
 										<?php break; ?>
 										<?php case 3: ?>
 										<td>Residential Treatment</td>
 										<?php endswitch; ?>
 									</tr>
 									<?php if($trm_data[0]->TRM_Treatment_Avail_ID == 2): ?>
 										<tr>
 											<td></td>
 											<td class="col-md-2"><b>Date of Entry in the Program</b></td>
 											<td><?php echo $trm_data[0]->TRM_Treatment_Avail_CommunityBased_EntryDate;?></td>
 										</tr>
 										<tr>
 											<td></td>
 											<td class="col-md-2"><b>Services Provided</b></td>
 											<td><?php echo $trm_data[0]->TRM_Treatment_Avail_CommunityBased_ServicesProvided;?></td>
 										</tr>
 										<tr>
 											<td></td>
 											<td class="col-md-2"><b>Date Finished the Program</b></td>
 											<td><?php echo $trm_data[0]->TRM_Treatment_Avail_CommunityBased_DateFinished;?></td>
 										</tr>	

 									<?php endif; ?>

 									<!-- Status -->

 									<?php if($trm_data[0]->TRM_Status_ID == 1): ?>
 										<tr>
 											<td class="col-md-2"><b>Status/Remarks</b></td>
 											<td>Completed</td>
 										</tr>
 									<?php elseif($trm_data[0]->TRM_Status_ID == 2): ?>
 										<tr>
 											<td class="col-md-2"><b>Status/Remarks</b></td>
 											<td>Not Completed</td>
 											<td></td>
 										</tr>
 										<tr>
 											<td></td>
 											<td class="col-md-2"><b>Specific Reason of non-completion</b></td>
 											<td><?php echo $trm_data[0]->TRM_SpecifyReason; ?></td>
 										</tr>		 										
 									<?php endif; ?>

 								<?php endif; ?>
 							</tbody>
 						</table>

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