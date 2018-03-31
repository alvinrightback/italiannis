<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">

	<!--Page Title-->
	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
	<div id="page-title">
	<h1 class="page-header text-overflow">List of User Roles</h1>
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
			<div class="col-md-6">
				<div class="panel">
					<div class="panel-body">
						<div class="pad-btm form-inline">
							<div class="row">
								<div class="col-sm-6 table-toolbar-left">
									<a href="<?php echo base_url('settings/role_add_name') ?>" class="btn btn-success btn-labeled fa fa-plus">Add New Role</a>
								</div>
							</div>
						</div>
						<?php if(is_array($roles)): ?>
							<table id="dt-selection" class="table table-responsive table-hover" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th></th>
										<th>Role</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($roles as $row): ?>
										<tr>
											<?php echo "<td class='text-center'>" . anchor(base_url().'settings/role_add_module/'. $row->User_Role_ID, '<button class="btn btn-default" title="View User"><i class="fa fa-search"></i></button>'). "</td>";
											?>
											<td><?php echo $row->User_Role_Name; ?></td>
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
		<!--===================================================-->
		<!-- End Row selection (single row) -->
	</div>
	<!--===================================================-->
	<!--End page content-->


</div>
<!--===================================================-->
			<!--END CONTENT CONTAINER-->