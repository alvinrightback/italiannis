 <!--CONTENT CONTAINER-->
 <!--===================================================-->
 <div id="content-container">

 	<!--Page Title-->
 	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
 	<div id="page-title">
 		<h1 class="page-header text-overflow">Event Information</h1>
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
 		<li class="active">Events</li>
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
 						<h3 class="panel-title">Event Information <a href="<?php echo base_url('events/edit/'.$event_data[0]->Event_ID); ?>" style="margin-top: 1%;" class="btn btn-link pull-right"><i class="fa fa-edit"></i> Edit</a></h3>
 					</div>
 					<div class="panel-body">
 						<table class="table table-bordered table-hover">
 							<tbody>
 								<?php if(is_array($event_data)): ?>
 									<tr>
 										<td class="col-md-4"><b>Event Name</b></td>
 										<td><?php echo $event_data[0]->Event_Name; ?></td>
 									</tr>
 									<tr>
 										<td class="col-md-4"><b>Start Date</b></td>
 										<td><?php echo $event_data[0]->Event_Start; ?></td>
 									</tr>
 									<tr>
 										<td class="col-md-4"><b>End Date</b></td>
 										<td><?php echo $event_data[0]->Event_End; ?></td>
 									</tr>
 									<tr>
 										<td class="col-md-4"><b>Description</b></td>
 										<td><?php echo $event_data[0]->Event_Description; ?></td>
 									</tr>
 								<?php endif; ?>
 							</tbody>
 						</table>
 					</div>
 				</div>
 			</div>

 			<div class="col-md-6">
 				<div class="panel">
 					<div class="panel-body">
 					<img src="<?php echo base_url('resources/images/events_photo/'.$event_data[0]->Event_Photo.'.jpeg'); ?>" class="img-responsive">
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