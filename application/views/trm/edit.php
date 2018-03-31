 <!--CONTENT CONTAINER-->
 <!--===================================================-->
 <div id="content-container">

 	<!--Page Title-->
 	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
 	<div id="page-title">
 		<h1 class="page-header text-overflow">Treatment and Rehabilitation Monitoring</h1>
 	</div>
 	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
 	<!--End page title-->


 	<!--Breadcrumb-->
 	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
 	<ol class="breadcrumb">
 		<li><a href="#">Home</a></li>
 		<li class="active">Treatment and Rehabilitation Monitoring Form</li>
 	</ol>
 	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
 	<!--End breadcrumb-->

 	<div id="addDrug" class="modal fade">
 		<div class="modal-dialog">

 			<!-- Modal content-->
 			<div class="modal-content">
 				<div class="modal-header">
 					<button type="button" class="close" data-dismiss="modal">&times;</button>
 					<h3 class="modal-title">Add Drug Information</h3>
 				</div>
 					<div class="modal-body">
 						<?php echo form_open('trm/add_trm_drug'); ?>
 						<div class="form-group">
 							<label class="control-label">Drugs Currently Used</label>
 							<select name="TRM_DrugsCurrentlyUsed" data-live-search="true" class="selectpicker form-control" >
 								<?php if(is_array($drugs)): ?>
 									<?php foreach($drugs as $row): ?>
 										<option value="<?php echo $row->Drug_ID; ?>"><?php echo $row->Drug_Name; ?></option>
 									<?php endforeach; ?>
 								<?php endif; ?>
 							</select>
 							<input type="hidden" name="Citizen_ID" value="<?php echo $citizen_data[0]->Citizen_ID; ?>">
 							<input type="hidden" name="TRM_ID" value="<?php echo isset($trm_data[0]->TRM_ID) ? $trm_data[0]->TRM_ID: "" ; ?>">
 							<small class="text-danger"><?php echo form_error('TRM_DrugsCurrentlyUsed'); ?></small>
 						</div>
 						<div class="form-group">
 							<label class="control-label">Source of Drugs</label>
 							<select name="TRM_SourceOfDrugs" class="selectpicker form-control">
 								<?php if(is_array($sourceOfDrugs)): ?>
 									<?php foreach($sourceOfDrugs as $row): ?>
 										<option value="<?php echo $row->SOD_ID; ?>"><?php echo $row->SOD_Value; ?></option>
 									<?php endforeach; ?>
 								<?php endif; ?>
 							</select>
 							<small class="text-danger"><?php echo form_error('TRM_SourceOfDrugs'); ?></small>
 						</div>
 						<div class="form-group">
 							<label class="control-label">Frequency of Use</label>
 							<select name="TRM_FrequencyOfUse" class="selectpicker form-control">
 								<?php if(is_array($frequencyOfUse)): ?>
 									<?php foreach($frequencyOfUse as $row): ?>
 										<option value="<?php echo $row->FOU_ID; ?>"><?php echo $row->FOU_Value; ?></option>
 									<?php endforeach; ?>
 								<?php endif; ?>
 							</select>
 							<small class="text-danger"><?php echo form_error('TRM_FrequencyOfUse'); ?></small>
 						</div>
 						<div class="form-group">
 							<label class="control-label">Mode of Drug Use</label>
 							<select name="TRM_ModeOfDrugUse" class="selectpicker form-control">
 								<?php if(is_array($modeOfDrugUse)): ?>
 									<?php foreach($modeOfDrugUse as $row): ?>
 										<option value="<?php echo $row->MODU_ID; ?>"><?php echo $row->MODU_Value; ?></option>
 									<?php endforeach; ?>
 								<?php endif; ?>
 							</select>
 							<small class="text-danger"><?php echo form_error('TRM_ModeOfDrugUse'); ?></small>
 						</div>
 						<div class="form-group">
 							<label class="control-label">Amount Spent Per Drug Intake</label>
 							<input type="text" class="form-control" name="TRM_AmountSpentPerDrugIntake" value="<?php echo set_value('TRM_AmountSpentPerDrugIntake'); ?>" required>
 							<small class="text-danger"><?php echo form_error('TRM_AmountSpentPerDrugIntake'); ?></small>
 						</div>
 					</div>
 					<div class="modal-footer">
 						<button type="submit" class="btn btn-success">Submit</button>
 					</div>
 				</form>
 			</div>
 		</div>
 	</div>
 	<!--Page content-->
 	<!--===================================================-->
 	<div id="page-content">

 		<div class="row">
 			<div class="col-sm-12">
 				<div class="panel">
 					<div class="panel-heading">
 						<h3 class="panel-title"><?php echo $citizen_data[0]->Citizen_Title.'. '.$citizen_data[0]->Citizen_LastName.', '.$citizen_data[0]->Citizen_FirstName.' '.$citizen_data[0]->Citizen_MiddleName; ?></h3>
 					</div>

 					<!--Block Styled Form -->
 					<!--===================================================-->
 					<?php
 					echo form_open('trm/edit_now');
 					?>
 					<div class="panel-body">
 						<div class="row">
 							<div class="col-sm-3">
 								<div class="form-group">
 									<label class="control-label">Date Surrendered</label>
 									<input type="text" class="form-control" onClick="this.type='date'" onBlur="this.type='text'" name="TRM_DateSurrendered" 
 									value="<?php echo isset($trm_data[0]) ? $trm_data[0]->TRM_DateSurrendered : set_value('TRM_DateSurrendered'); ?>" 
 									placeholder="Enter Date Surrendered">
 									<input type="hidden" name="Citizen_ID" value="<?php echo $citizen_data[0]->Citizen_ID; ?>">
 									<input type="hidden" name="TRM_ID" value="<?php echo isset($trm_data[0]->TRM_ID) ? $trm_data[0]->TRM_ID: "" ; ?>">
 									<small class="text-danger"><?php echo form_error('TRM_DateSurrendered'); ?></small>
 								</div>
 							</div>
 							<div class="col-sm-3">
 								<div class="form-group">
 									<label class="control-label">Age of First Drug Use</label>
 									<select name="TRM_AgeOfFirstDrugUse" class="selectpicker" data-width="100%">
 										<?php if(is_array($ageOfFirstDrugUse)): ?>
 											<?php if($checkTRM == 1): ?>
 												<?php foreach($ageOfFirstDrugUse as $row): ?>
 													<option value="<?php echo $row->AOFDU_ID ?>" 
 														<?php echo $trm_data[0]->TRM_AgeOfFirstDrugUse == $row->AOFDU_ID ? 'selected':'' ?>
 														><?php echo $row->AOFDU_Value; ?></option>
 													<?php endforeach; ?>
 												<?php else: ?>
 													<?php foreach($ageOfFirstDrugUse as $row): ?>
 														<option value="<?php echo $row->AOFDU_ID ?>"><?php echo $row->AOFDU_Value; ?></option>
 													<?php endforeach; ?>
 												<?php endif; ?>
 											<?php endif; ?>
 										</select>
 										<small class="text-danger"><?php echo form_error('TRM_AgeOfFirstDrugUse'); ?></small>
 									</div>
 								</div>
 								<div class="col-sm-3">
 									<div class="form-group">
 										<label class="control-label">Drug first tried</label>
 										<select name="TRM_DrugFirstTried" class="selectpicker" data-live-search="true" data-width="100%">
 											<?php if(is_array($drugs)): ?>
 												<?php if($checkTRM == 1): ?>
 													<?php foreach($drugs as $row): ?>
 														<option value="<?php echo $row->Drug_ID ?>" 
 															<?php echo $trm_data[0]->TRM_DrugFirstTried == $row->Drug_ID ? 'selected':'' ?>
 															><?php echo $row->Drug_Name; ?></option>
 														<?php endforeach; ?>
 													<?php else: ?>
 														<?php foreach($drugs as $row): ?>
 															<option value="<?php echo $row->Drug_ID ?>"><?php echo $row->Drug_Name; ?></option>
 														<?php endforeach; ?>
 													<?php endif; ?>
 												<?php endif; ?>
 											</select>
 											<small class="text-danger"><?php echo form_error('TRM_DrugFirstTried'); ?></small>
 										</div>
 									</div> 
 								</div>
 							</div> <!-- End of Panel Body -->   
 				</div> <!-- End of Panel  -->  
 				<div class="panel">
 								<div class="panel-heading">
 									<h3 class="panel-title">Drug Use Information<a href="#addDrug" data-toggle="modal" style="margin-top: 2%;" class="btn btn-link pull-right"><i class="fa fa-plus"></i> Add</a></h3>
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
 														<th></th>
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
 															<td class="text-center"><a href="<?php echo base_url('trm/delete_trm_drug/'.$row->TRM_DU_ID.'/'.$citizen_data[0]->Citizen_ID.'/'. $trm_data[0]->TRM_ID) ?>" class="btn btn-link bootbox-confirm"><i class="fa fa-trash"></i></a></td>										
 														</tr>
 													<?php endforeach; ?>
 												</tbody>
 											</table>
 										</div>
 									<?php endif; ?>
 								</div>
 							</div>
 				<div class="panel">
 					<div class="panel-heading">
 						<h3 class="panel-title">Data Ralative To Availment of Community-Based Program</h3>
 					</div>
 					<div class="panel-body">
 						<div class="row">
 						<script type="text/javascript">
 							window.addEventListener("load", function(){
 								if(<?php echo $trm_data[0]->TRM_ScreeningResult_ID; ?> == 2){
 									document.getElementById('MoreResult').style.display = 'block';
 								}

 								if(<?php echo $trm_data[0]->TRM_Intervention_Avail_ID; ?> == 6){
 									document.getElementById('MoreIntervention').style.display = 'block';
 								}

 								if(<?php echo $trm_data[0]->TRM_Treatment_Avail_ID; ?> == 2){
 									document.getElementById('MoreTreatment').style.display = 'block';
 								}

 								if(<?php echo $trm_data[0]->TRM_Status_ID; ?> == 2){
 									document.getElementById('MoreStatus').style.display = 'block';
 								}


 							}, false);

 						</script>
 							<div class="col-md-3">
 								<div class="form-group">
 									<label class="control-label">Screening Result (Please refer to ASSIST)</label>
 									<select name="TRM_ScreeningResult_ID" 
 									onchange="
 									if(this.value == 2){
 										document.getElementById('MoreResult').style.display = 'block';
 									}
 									else{
 										document.getElementById('MoreResult').style.display = 'none';
 									}" 
 									class="selectpicker form-control">
 									<option disabled>Select</option>
 									<option value="1" <?php echo $trm_data[0]->TRM_ScreeningResult_ID == '1'? 'selected':'' ?>>Low to Mild</option>
 									<option value="2" <?php echo $trm_data[0]->TRM_ScreeningResult_ID == '2'? 'selected':'' ?>>Moderate to Severe</option>
 								</select>
 							</div>
 						</div>
 						<div id="MoreResult" style="display: none" class="col-md-3">
 							<div class="form-group">
 								<label class="control-label">Referred To:</label>
 								<input id="screeningResult" type="text" class="form-control" name="TRM_ScreeningResultReferredTo" value="<?php echo $trm_data[0]->TRM_ScreeningResultReferredTo; ?>">
 								<small class="text-danger"><?php echo form_error('TRM_ScreeningResultReferredTo'); ?></small>
 							</div>
 						</div>
 					</div>
 					<div class="row">
 						<label class="control-label">If Behavioral Problem, please answer the following:</label>
 					</div>
 					<div class="row">
 						<div class="col-md-3">
 							<div class="form-group">
 								<label class="control-label">Intervention Availed</label>
 								<select name="TRM_Intervention_Avail_ID" 
 								onchange="
 								if(this.value == 6){
 									document.getElementById('MoreIntervention').style.display = 'block';
 								}
 								else{
 									document.getElementById('MoreIntervention').style.display = 'none';
 								}" 
 								class="selectpicker form-control">
 								<option disabled selected>Select</option>
 								<?php if(is_array($intervention)): ?>
 									<?php foreach($intervention as $row): ?>
 										<option value="<?php echo $row->Intervention_Avail_ID ?>" 
 										<?php echo $trm_data[0]->TRM_Intervention_Avail_ID == $row->Intervention_Avail_ID ? 'selected':'' ?>
 										><?php echo $row->Intervention_Avail_Name; ?></option>
 									<?php endforeach; ?>
 								<?php endif; ?>
 							</select>
 						</div>
 					</div>
 					<div id="MoreIntervention" style="display: none">
 						<div class="col-md-3">
 							<div class="form-group">
 								<label class="control-label">Please Specify</label>
 								<input id="interventionSpecify" type="text" class="form-control" name="TRM_Intervention_Avail_Others" value="<?php echo $trm_data[0]->TRM_Intervention_Avail_Others; ?>">
 								<small class="text-danger"><?php echo form_error('TRM_Intervention_Avail_Others'); ?></small>
 							</div>
 						</div>
 						<div class="col-md-3">
 							<div class="form-group">
 								<label class="control-label">Date of Entry in the Program:</label>
 								<input id="interventionDateEntry" type="date" class="form-control" name="TRM_Intervention_Avail_DateOfentry" value="<?php echo $trm_data[0]->TRM_Intervention_Avail_DateOfentry; ?>">
 								<small class="text-danger"><?php echo form_error('TRM_Intervention_Avail_DateOfentry'); ?></small>
 							</div>
 						</div>
 						<div class="col-md-3">
 							<div class="form-group">
 								<label class="control-label">Date Finished the Program:</label>
 								<input id="interventionDateFinished" type="date" class="form-control" name="TRM_Intervention_Avail_DateFinished" value="<?php echo $trm_data[0]->TRM_Intervention_Avail_DateFinished; ?>">
 								<small class="text-danger"><?php echo form_error('TRM_Intervention_Avail_DateFinished'); ?></small>
 							</div>
 						</div>
 					</div>
 				</div>
 				<div class="row">
 					<label class="control-label">If Substance Abuse Disorder, please answer the following:</label>
 				</div>
 				<div class="row">
 					<div class="col-md-3">
 						<div class="form-group">
 							<label class="control-label">Treatment Program Availed</label>
 							<select name="TRM_Treatment_Avail_ID" 
 							onchange="
 							if(this.value == 2){
 								document.getElementById('MoreTreatment').style.display = 'block';
 							}
 							else{
 								document.getElementById('MoreTreatment').style.display = 'none';
 							}" 
 							class="selectpicker form-control">
 							<option disabled selected>Select</option>
 							<?php if(is_array($treatment)): ?>
 								<?php foreach($treatment as $row): ?>
 									<option value="<?php echo $row->Treatment_Avail_ID ?>"
 									<?php echo $trm_data[0]->TRM_Treatment_Avail_ID == $row->Treatment_Avail_ID ? 'selected':'' ?>
 									><?php echo $row->Treatment_Avail_Name; ?></option>
 								<?php endforeach; ?>
 							<?php endif; ?>
 						</select>
 					</div>
 				</div>
 				<div id="MoreTreatment" style="display: none">
 					<div class="col-md-3">
 						<div class="form-group">
 							<label class="control-label">Date of Entry in the Program</label>
 							<input id="treatmentDateEntry" type="date" class="form-control" name="TRM_Treatment_Avail_CommunityBased_EntryDate" value="<?php echo $trm_data[0]->TRM_Treatment_Avail_CommunityBased_EntryDate; ?>">
 							<small class="text-danger"><?php echo form_error('TRM_Treatment_Avail_CommunityBased_EntryDate'); ?></small>
 						</div>
 					</div>
 					<div class="col-md-3">
 						<div class="form-group">
 							<label class="control-label">Services Provided</label>
 							<input id="treatmentDateServicesProvided" type="text" class="form-control" name="TRM_Treatment_Avail_CommunityBased_ServicesProvided" value="<?php echo $trm_data[0]->TRM_Treatment_Avail_CommunityBased_ServicesProvided; ?>">
 							<small class="text-danger"><?php echo form_error('TRM_Treatment_Avail_CommunityBased_ServicesProvided'); ?></small>
 						</div>
 					</div>
 					<div class="col-md-3">
 						<div class="form-group">
 							<label class="control-label">Date Finished the Program</label>
 							<input id="treatmentDateFinished" type="date" class="form-control" name="TRM_Treatment_Avail_CommunityBased_DateFinished" value="<?php echo $trm_data[0]->TRM_Treatment_Avail_CommunityBased_DateFinished; ?>">
 							<small class="text-danger"><?php echo form_error('TRM_Treatment_Avail_CommunityBased_DateFinished'); ?></small>
 						</div>
 					</div>
 				</div>
 			</div>
 			<div class="row">
 				<div class="col-md-3">
 					<div class="form-group">
 						<label class="control-label">Status/Remarks</label>
 						<select name="TRM_Status_ID" 
 									onchange="
 									if(this.value == 2){
 										document.getElementById('MoreStatus').style.display = 'block';
 									}
 									else{
 										document.getElementById('MoreStatus').style.display = 'none';
 										document.getElementById('statusSpecify').value='';
 									}" 
 									class="selectpicker form-control">
 							<option disabled selected>Select</option>
 							<option value="1" <?php echo $trm_data[0]->TRM_Status_ID == 1 ? 'selected':'' ?>>Completed</option>
 							<option value="2" <?php echo $trm_data[0]->TRM_Status_ID == 2 ? 'selected':'' ?>>Not Completed</option>
 						</select>
 					</div>
 				</div>
 				<div id="MoreStatus" style="display: none">
 				<div class="col-md-3">
 					<div class="form-group">
 						<label class="control-label">Specify reason of non-completion</label>
 						<input id="statusSpecify" type="text" class="form-control" name="TRM_SpecifyReason" value="<?php echo $trm_data[0]->TRM_SpecifyReason; ?>">
 						<small class="text-danger"><?php echo form_error('TRM_SpecifyReason'); ?></small>
 					</div>
 				</div>
 				</div>
 			</div>
 		</div>

 		<div class="panel-footer text-right">
 			<button class="btn btn-success" type="submit">Submit</button>
 		</div>
 	</div>
 </div>
</form>
<!--===================================================-->
<!--End Block Styled Form -->
</div> 	
</div>
<!--===================================================-->
<!--End page content-->
</div>
<!--===================================================-->
            <!--END CONTENT CONTAINER-->