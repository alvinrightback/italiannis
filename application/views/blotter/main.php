<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">

	<!--Page Title-->
	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
	<div id="page-title">
	<h1 class="page-header text-overflow">List of Blotters</h1>
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
									<a href="<?php echo base_url('blotter/add') ?>" class="btn btn-success btn-labeled fa fa-plus">Add New Blotter</a>
								</div>
							</div>
						</div>
						<?php if(is_array($blotters)): ?>
							<table id="dt-selection" class="table table-responsive table-hover" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th></th>
										<th>Complained Date</th>
										<th>Complainant</th>
										<th>Status</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($blotters as $row): ?>
										<tr>
											<?php echo "<td class='text-center'>" . anchor(base_url().'blotter/view/'. $row->Blotter_ID, '<button class="btn btn-default" title="View Job Information"><i class="fa fa-search"></i></button>'). "</td>";
											?>
											<td><?php echo $row->Complained_Date; ?></td>
											<?php if($row->Blotter_Complainant_ID): ?>
											<td><?php echo $row->Com_Last_Name.', '.$row->Com_First_Name.' '.$row->Com_Middle_Name; ?></td>
											<?php else: ?>
											<td>No Complainant</td>
											<?php endif ?>
											<td><?php echo $row->Aux_Value; ?></td>
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