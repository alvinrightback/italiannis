<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">

	<!--Page Title-->
	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
	<div id="page-title">
		<h1 class="page-header text-overflow">Migrants</h1>
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
	<!--Modal Search Citizen -->
	<div id="myModalSearch" class="modal fade" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Property List</h4>
				</div>
				<div class="modal-body">
					<?php if(is_array($property)): ?>
						<table id="dt-selection" class="table table-responsive table-hover" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>Owner</th>
									<th>Address</th>
									<th class="text-center">Select</th>										
								</tr>
							</thead>
							<tbody>
								<?php foreach($property as $row): ?>
									<tr>
										<td><?php echo $row->Citizen_LastName.', '.$row->Citizen_FirstName.' '.$row->Citizen_MiddleName; ?></td>
										<td><?php echo $row->Address_Name; ?>
										<?php if(isset($row->Barangay_ID)): ?>
											<?php if($row->Barangay_Name): ?>
												<?php echo ', ';?>
												<?php echo $row->Barangay_ID != 'N' ? $row->Barangay_Name: ''; ?>
											<?php endif; ?>
										<?php endif; ?>
									</td>
										<td style="text-align: center; vertical-align: middle;">
											<a href="<?php echo base_url('property/view/'.$row->REP_ID) ?>" class="btn btn-primary">Select</a>
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
							<button type="button" data-toggle="modal" data-target="#myModalSearch" class="btn btn-success btn-labeled fa fa-plus">New Migrant</button>
						</div>
					</div>
				</div>
				<?php if(is_array($migrants)): ?>
					<table id="dt-selection" class="table table-responsive" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>Name</th>
								<th>Property Name</th>
								<th>Renter Type</th>
								<th>Arrival Date</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($migrants as $row): ?>
								<tr>
									<td><?php echo anchor(base_url().'citizens/view/'. $row->Citizen_ID, '<button class="btn btn-link" title="View Citizen">'. $row->Citizen_LastName.', '.$row->Citizen_FirstName.' '.$row->Citizen_MiddleName.'</button>'); ?></td>
									<td><?php echo anchor(base_url().'property/view/'. $row->REP_ID, '<button class="btn btn-link" title="View Property">'.$row->REP_Name.'</button>'); ?></td>
									<td><?php echo $row->Aux_Value; ?></td>
									<td><?php echo $row->Arrival_Date; ?></td>
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