 <!--CONTENT CONTAINER-->
 <!--===================================================-->
 <div id="content-container">

 	<!--Page Title-->
 	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
 	<div id="page-title">
 		<h1 class="page-header text-overflow">Job</h1>
 	</div>
 	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
 	<!--End page title-->


 	<!--Breadcrumb-->
 	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
 	<ol class="breadcrumb">
 		<li><a href="#">Home</a></li>
 		<li class="active">Job Information</li>
 	</ol>
 	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
 	<!--End breadcrumb-->




 	<!--Page content-->
 	<!--===================================================-->
 	<div id="page-content">
 		<!-- Row selection (single row) -->
 		<!--===================================================-->
 		<div class="row">
 		<div class="col-md-6">
 		<div class="panel">
 			<div class="panel-heading">
 				<h3 class="panel-title">Job Information <a href="<?php echo base_url('jobs/edit/'.$job_data[0]->Job_ID); ?>" style="margin-top: 1%;" class="btn btn-link pull-right"><i class="fa fa-edit"></i> Edit</a></h3>
 			</div>
 			<div class="panel-body">
 				<table class="table table-responsive table-bordered">
 					<tbody>
 					<?php if(is_array($job_data)): ?>
 							<tr>
 								<td class="col-md-4"><b>Job Name</b></td>
 								<td><?php echo $job_data[0]->Job_Name; ?></td>
 							</tr>
 							<tr>
 								<td class="col-md-4"><b>Employment Type</b></td>
 								<td><?php echo $job_data[0]->Aux_Value; ?></td>
 							</tr>
 							<tr>
 								<td class="col-md-4"><b>Location</b></td>
 								<td><?php echo $job_data[0]->Job_Location; ?></td>
 							</tr>
 							<tr>
 								<td class="col-md-4"><b>Barangay</b></td>
 								<td><?php echo $job_data[0]->Barangay_Name; ?></td>
 							</tr>
 							<tr>
 								<td class="col-md-4"><b>Working Hours</b></td>
 								<td><?php echo $job_data[0]->Job_Working_Hours; ?></td>
 							</tr>
 							<tr>
 								<td class="col-md-4"><b>Benefits</b></td>
 								<td><?php echo $job_data[0]->Job_Benefits; ?></td>
 							</tr>
 							<tr>
 								<td class="col-md-4"><b>Dress Code</b></td>
 								<td><?php echo $job_data[0]->Job_Dress_Code; ?></td>
 							</tr>
 							<tr>
 								<td class="col-md-4"><b>Minimum Years of Experience</b></td>
 								<td><?php echo $job_data[0]->Job_Minimum_Year_Exp; ?></td>
 							</tr>
 							<tr>
 								<td class="col-md-4"><b>Salary Rate Range</b></td>
 								<td><?php echo $job_data[0]->Job_Salary_Rate_Range; ?></td>
 							</tr>
 							<tr>
 								<td class="col-md-4"><b>Date Posted</b></td>
 								<td><?php echo $job_data[0]->Job_Date_Posted; ?></td>
 							</tr>
 							<tr>
 								<td class="col-md-4"><b>Closing Date</b></td>
 								<td><?php echo $job_data[0]->Job_Date_Closed; ?></td>
 							</tr>
 					<?php endif; ?>
 						</tbody>
 					</table>
 				</div>
 			</div>
 			</div>
 			<div class="col-md-6">
 				<div class="panel">
 					<div class="panel-heading">
 					<h3 class="panel-title">Description</h3>
 					</div>
 					<div class="panel-body">
 						<pre style="background: none; border: none;"><?php echo $job_data[0]->Job_Description; ?></pre>
 					</div>
 				</div>

 				<div class="panel">
 					<div class="panel-heading">
 					<h3 class="panel-title">Qualification</h3>
 					</div>
 					<div class="panel-body">
 						<pre style="background: none; border: none;"><?php echo $job_data[0]->Job_Qualification; ?></pre>
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