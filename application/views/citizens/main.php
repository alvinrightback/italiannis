<!--CONTENT CONTAINER-->
			<!--===================================================-->
			<div id="content-container">
				
				<!--Page Title-->
				<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
				<div id="page-title">
					<h1 class="page-header text-overflow">Citizens</h1>
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
					<div class="panel">
						<div class="panel-body">
							<div class="pad-btm form-inline">
								<div class="row">
									<div class="col-sm-6 table-toolbar-left">
										<a href="<?php echo base_url('citizens/add') ?>" class="btn btn-success btn-labeled fa fa-plus">Add New Citizen</a>
									</div>
								</div>
							</div>
							<?php if(is_array($citizens)): ?>
							<table id="dt-selection" class="table table-responsive table-hover" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th></th>
										<th>First Name</th>
										<th>Middle Name</th>
										<th>Last Name</th>
										<th>Suffix</th>
										<th>Barangay</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($citizens as $row): ?>
									<tr>
										<?php echo "<td class='text-center'>" . anchor(base_url().'citizens/view/'. $row->Citizen_ID, '<button class="btn btn-default" title="View User"><i class="fa fa-search"></i></button>'). "</td>";
										?>
										<td><?php echo $row->Citizen_FirstName; ?></td>
										<td><?php echo $row->Citizen_MiddleName; ?></td>
										<td><?php echo $row->Citizen_LastName; ?></td>
										<td><?php echo $row->Citizen_Suffix; ?></td>
										<td><?php echo $row->Barangay_Name; ?></td>
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