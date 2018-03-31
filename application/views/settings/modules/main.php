<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">

	<!--Page Title-->
	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
	<div id="page-title">
		<h1 class="page-header text-overflow">Modules</h1>
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
					<div class="panel-heading">
						<h3 class="panel-title">Add New Module</h3>
					</div>
					<?php echo form_open('settings/module_add', array('class'=>'form-inline')); ?>
					<div class="panel-body">
						<div class="form-group">
							<label for="Module_Name" class="sr-only">Module Name</label>
							<input type="text" placeholder="Enter Module Name" name="Module_Name" value="<?php echo set_value('Module_Name'); ?>" class="form-control">
							<small class="text-danger"><?php echo form_error('Module_Name'); ?></small>
						</div>
						<button class="btn btn-success" type="Submit">Submit</button>
					</div>
				</form>

			</div>

			<div class="panel">

				<div class="panel-heading">
					<h3 class="panel-title">List of Module</h3>
				</div>
				<div class="panel-body">
					<?php if(is_array($modules)): ?>
						<table id="dt-selection" class="table table-responsive table-hover" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th></th>
									<th>Module</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($modules as $row): ?>
									<tr>
										<?php echo "<td class='text-center'>" . anchor(base_url().'settings/module_edit/'. $row->Module_ID, '<button class="btn btn-default" title="Edit Module"><i class="fa fa-search"></i></button>'). "</td>";
										?>
										<td><?php echo $row->Module_Name; ?></td>
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