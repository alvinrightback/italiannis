<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">

	<!--Page Title-->
	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
	<div id="page-title">
	<h1 class="page-header text-overflow">List of Events</h1>
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

	<!--Page content-->
	<!--===================================================-->
	<div id="page-content">


		<!-- Row selection (single row) -->
		<!--===================================================-->
		<div class="row">
				<div class="panel">
					<div class="panel-body">
						<div class="pad-btm form-inline">
							<div class="row">
								<div class="col-sm-6 table-toolbar-left">
									<a href="<?php echo base_url('events/add') ?>" class="btn btn-success btn-labeled fa fa-plus">Add New Event</a>
								</div>
							</div>
						</div>
						<?php if(is_array($events)): ?>
							<table id="demo-dt-selection" class="table table-responsive table-hover" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th></th>
										<th>Event Name</th>
										<th>Location</th>
										<th>Barangay</th>
										<th>Date Created</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($events as $row): ?>
										<tr>
											<?php echo "<td class='text-center'>" . anchor(base_url().'events/view/'. $row->Event_ID, '<button class="btn btn-default" title="View Event"><i class="fa fa-search"></i></button>'). "</td>";
											?>
											<td><?php echo $row->Event_Name; ?></td>
											<td><?php echo $row->Event_Location; ?></td>
											<td><?php echo $row->Barangay_Name; ?></td>
											<td><?php echo $row->DateCreated; ?></td>
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
		<!--===================================================-->
		<!-- End Row selection (single row) -->
	</div>
	<!--===================================================-->
	<!--End page content-->


</div>
<!--===================================================-->
			<!--END CONTENT CONTAINER-->