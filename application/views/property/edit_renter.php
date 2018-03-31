<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">

	<!--Page Title-->
	<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
	<div id="page-title">
		<h1 class="page-header text-overflow">Property</h1>
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
			<div class="col-md-4">
				<div class="panel">
					<div class="panel-heading">
						<h3 class="panel-title">Edit Renter Information</h3>
					</div>
					<div class="panel-body">
						<?php echo form_open('property/property_edit_renter_now'); ?>
						<div class="form-group">
							<label class="control-label">Renter Type</label>
							<select name="Renter_Type_ID" name="Renter_Type_ID" class="selectpicker form-control">
								<?php if(is_array($rentertype)): ?>
									<?php foreach($rentertype as $row): ?>
										<option value="<?php echo $row->Aux_ID; ?>"<?php echo $row->Aux_ID == $renter_data[0]->Renter_Type_ID ? ' selected':'' ?> ><?php echo $row->Aux_Value; ?></option>
									<?php endforeach; ?>
								<?php endif; ?>
							</select>
							<input type="hidden" name="REP_ID" value="<?php echo $renter_data[0]->REP_ID; ?>">
							<input type="hidden" name="REP_Renter_ID" value="<?php echo $renter_data[0]->REP_Renter_ID; ?>">
							<small class="text-danger"><?php echo form_error('Renter_Type_ID'); ?></small>
						</div>
						<label class="control-label">Date of Arrival</label>
						<input type="text" class="form-control" max="<?php echo Date('Y-m-d'); ?>" name="Arrival_Date" onclick="this.type='date'" onblur="this.type='text'" value="<?php echo $renter_data[0]->Arrival_Date; ?>" placeholder="Enter Arrival Date"> 
						<small class="text-danger"><?php echo form_error('Arrival_Date'); ?></small>

					</div>
					<div class="panel-footer text-right">
						<button type="submit" class="btn btn-success">Submit</button>
					</div>
				</form> 
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