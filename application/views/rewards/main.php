<script type="text/javascript">
	
	function getCardDetails(id){
		$('#table_card_history').DataTable().destroy();
		$('#Card_Details, #Card_Details_Progress').css('display', 'block');
		$('#Card_Details_Body').css('display', 'none');
		$.ajax({
			'url' : '<?php  echo base_url('rewards/get_card_details/'); ?>',
			'type' : 'POST', 
			'data' : {'id' : id},
			'dataType' : 'json',
			'cache' : false,
			'success' : function(data){ 
 					$('#Card_String').text(data['card_details'][0]['card_string']);

 					var myTable = $('#table_card_history').DataTable({
 						"paging": true,
 						"lengthChange": false,
 						"searching": true,
 						"ordering": true,
 						"info": false,
 						"autoWidth": true,
 						"columns": [{
 							"title": "Points",
 							"data": "points"
 						}, {
 							"title": "Date",
 							"data": "date_created"

 						}]
					 });
				
 					myTable.clear();
 					$.each(data['card_history'], function(index, value) {
 						myTable.row.add(value);
 					});
 					myTable.draw();
 				},
			'complete' : function(){
				$('#Card_Details_Progress').css('display', 'none');
				$('#Card_Details_Body').css('display', 'block');
			}
 			});
	}


</script>
<main class="main-content p-5" role="main">
	<div class="row">
		<div class="col-md-12">
			<h1>Rewards</h1>
		</div>
	</div>
	<?php
	if($success){
		echo "<div class='alert alert-success'>" . $success . "</div>";
	}
	if($failed){
		echo "<div class='alert alert-danger'>" . $failed . "</div>";
	}
	?>

	<div class="modal fade" id="exampleModalToolTip" tabindex="-1" role="dialog" aria-labelledby="exampleModalToolTip" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Add New Reward Card</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<?php echo form_open('rewards/add_now'); ?>
					<div class="form-group">
						<label for="inputCardString">Card ID</label>
						<input type="text" class="form-control" id="card_string" name="Card_String" placeholder="Card String" required>
					</div>
					<div class="form-group">
						<label for="inputInitialValue">Initial Value</label>
						<input type="number" class="form-control" id="initial_value" min="0" value="0" name="Initial_Value" placeholder="Initial Value" required>
					</div>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
				</form>
		    </div>
		</div>
	</div>

	<div class="modal fade" id="changeDiscountModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalToolTip" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Change Discount Percentage</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<?php echo form_open('rewards/change_discount_percentage'); ?>
						<div class="form-group">
							<label for="exampleFormControlInput1">Current Discount Percentage</label>
							<input type="number" class="form-control" value="<?php echo $current_discount; ?>" min="0" max="100" id="inputDiscountPercentage" name="inputDiscountPercentage" placeholder="Current Discount Percentage" required>
						</div>

						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Update</button>
						</div>
					</form>
		    	</div>
			</div>
	</div>


<div class="row">
	<div class="col-md-6 col-lg-6 col-xl-8 mb-5">
		<div class="card">
			<div class="card-header">
				Rewards Card Discount: <span id="discountPercentage"><u><?php echo (int)$current_discount; ?></span>%</u> <button type="button" data-target="#changeDiscountModal" data-toggle="modal" class="btn btn-sm btn-primary">Change</button>
				<div class="header-btn-block">
					<button type="button" data-toggle="modal" data-target="#exampleModalToolTip" class="btn btn-primary">
						<i class="batch-icon batch-icon-add"></i> 
						New Reward Card
					</button>
				</div>
			</div>
			<div class="card-body">

				<?php if(is_array($cards)): ?>
					<div class="table-responsive">
						<table id="datatable-1" class="table table-datatable table-bordered table-hover">
							<thead class="thead-dark">
								<tr>
									<th>Card String</th>
									<th>Points</th>
									<th>Date Created</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($cards as $row): ?>
									<tr style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="View Card Details" onclick="javascript:getCardDetails(<?php echo $row->card_id; ?>)">
										<td><?php echo $row->card_string; ?></td>
										<td><?php echo $row->points;	 ?></td>
										<td><?php echo date('Y-m-d', strtotime($row->date_created));	 ?></td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				<?php else: ?>
					<p>No data found.</p>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<div id="Card_Details" style="display: none;" class="col-md-6 col-lg-6 col-xl-4 mb-5">
		<div class="card">
			<div class="card-header">
				Card History
			</div>
			<div class="card-body">
				<div id="Card_Details_Progress" style="display: none;" class="progress">
					<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
				</div>

				<div id="Card_Details_Body" style="display: none;">
					<h2 id="Card_String">Card String</h2>
					
					<div class="table-responsive">
						<table id="table_card_history" class="table table-sm table-bordered table-hover">
							<thead class="thead-light">
								<tr>
									<th>Quantity</th>
									<th>Date Updated</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

