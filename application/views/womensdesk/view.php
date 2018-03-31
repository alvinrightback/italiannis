 <!--CONTENT CONTAINER-->
 <!--===================================================-->
 <div id="content-container">

 	<!--Page Title-->
 	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
 	<div id="page-title">
 		<h1 class="page-header text-overflow">Apprehension Information</h1>
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




 	<!--Page content-->
 	<!--===================================================-->
 	<div id="page-content">
 		<!-- Row selection (single row) -->
 		<!--===================================================-->
 		<div class="row">
 			<div class="col-md-6">
 				<div class="panel">
 					<div class="panel-heading">
 						<h3 class="panel-title">Information <a href="<?php echo base_url('womensdesk/edit/'.$apprehension_data[0]->WD_ID); ?>" style="margin-top: 1%;" class="btn btn-link pull-right"><i class="fa fa-edit"></i> Edit</a></h3>
 					</div>
 					<div class="panel-body">
 						<table class="table table-bordered table-hover">
 							<tbody>
 								<?php if(is_array($apprehension_data)): ?>
 									<tr>
 										<td class="col-md-4"><b>Apprehension ID</b></td>
 										<td><?php echo $apprehension_data[0]->Apprehension_ID; ?></td>
 									</tr>
 									<tr>
 										<td class="col-md-4"><b>Full Name</b></td>
 										<td><?php echo $apprehension_data[0]->Citizen_Title.'. '.$apprehension_data[0]->Citizen_LastName.', '.$apprehension_data[0]->Citizen_FirstName.' '.$apprehension_data[0]->Citizen_MiddleName; ?> <?php echo $apprehension_data[0]->Citizen_Suffix == 'NA'? '':$apprehension_data[0]->Citizen_Suffix; ?></td>
 									</tr>
 									<tr>
 										<td class="col-md-4"><b><?php echo $guardian_data[0]->Aux_Value; ?></b></td>
 										<td><?php echo $guardian_data[0]->Citizen_Title.'. '.$guardian_data[0]->Citizen_LastName.', '.$guardian_data[0]->Citizen_FirstName.' '.$guardian_data[0]->Citizen_MiddleName; ?> <?php echo $guardian_data[0]->Citizen_Suffix == 'NA'? '':$guardian_data[0]->Citizen_Suffix; ?></td>
 									</tr>
 									<tr>
 										<td class="col-md-4"><b>Apprehension Location</b></td>
 										<td><?php echo $apprehension_data[0]->Apprehension_Location; ?></td>
 									</tr>
 									<tr>
 										<td class="col-md-4"><b>OIC Full Name</b></td>
 										<td><?php echo $apprehension_data[0]->OIC_FullName; ?></td>
 									</tr>
 									<tr>
 										<td class="col-md-4"><b>Remarks</b></td>
 										<td><?php echo $apprehension_data[0]->Apprehension_Remarks; ?></td>
 									</tr>
 									<tr>
 										<td class="col-md-4"><b>Date Created</b></td>
 										<td><?php echo $apprehension_data[0]->DateCreated; ?></td>
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
 						<h3 class="panel-title">Narrative</h3>
 					</div>
 					<div class="panel-body">
 						<p><?php echo $apprehension_data[0]->Apprehension_Narrative; ?></p>
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