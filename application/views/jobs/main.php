<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">

	<!--Page Title-->
	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
	<div id="page-title">
	<h1 class="page-header text-overflow">List of Job Openings</h1>
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
									<a href="<?php echo base_url('jobs/add') ?>" class="btn btn-success btn-labeled fa fa-plus">Add New Job Opening</a>
								</div>
							</div>
						</div>
						<?php if(is_array($jobs)): ?>
							<table id="dt-selection" class="table table-responsive table-hover" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th></th>
										<th>Job Name</th>
										<th>Employment Type</th>
										<th>Barangay</th>
										<th>Date Posted</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($jobs as $row): ?>
										<tr>
											<?php echo "<td class='text-center'>" . anchor(base_url().'jobs/view/'. $row->Job_ID, '<button class="btn btn-default" title="View Job Information"><i class="fa fa-search"></i></button>'). "</td>";
											?>
											<td><?php echo $row->Job_Name; ?></td>
											<td><?php echo $row->Aux_Value; ?></td>
											<td><?php echo $row->Barangay_Name; ?></td>
											<td><?php echo $row->Job_Date_Posted; ?></td>
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