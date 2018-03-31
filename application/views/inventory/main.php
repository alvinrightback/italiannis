<script type="text/javascript">
	
	function getItemDetails(id){
		$('#table_item_history').DataTable().destroy();
		$('#Item_Details').css('display', 'block');
		$.ajax({
			'url' : '<?php  echo base_url('inventory/get_item_details/'); ?>',
			'type' : 'POST', 
			'data' : {'id' : id},
			'dataType' : 'json',
			'cache' : false,
			'success' : function(data){ 
 					//$('#viewCitizen').modal('toggle');
 					$('#Item_Name').val(data['item_details'][0]['name']);
 					$('#Item_Quantity').val(data['item_details'][0]['quantity']);
 					$('#Item_Details_Inventory_ID').val(data['item_details'][0]['inventory_id']);

 					var myTable = $('#table_item_history').DataTable({
 						"paging": true,
 						"lengthChange": false,
 						"searching": true,
 						"ordering": true,
 						"info": true,
 						"autoWidth": true,
 						"columns": [{
 							"title": "Quantity",
 							"data": "quantity"
 						}, {
 							"title": "Date Added",
 							"data": "date_created"

 						}]
 					});

 					myTable.clear();
 					$.each(data['item_history'], function(index, value) {
 						myTable.row.add(value);
 					});
 					myTable.draw();
 				}
 			});
	}

</script>
<main class="main-content p-5" role="main">
	<div class="row">
		<div class="col-md-12">
			<h1>Inventory</h1>
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
					<h5 class="modal-title" id="exampleModalLongTitle">Add New Item</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<?php echo form_open('inventory/add_now'); ?>
					<div class="form-group">
						<label for="exampleFormControlInput1">Item Name</label>
						<input type="text" class="form-control" id="itemName" name="Item_Name" placeholder="e.g. garlic, tomatoes, beans etc. " required>
					</div>
					<div class="form-group">
						<label for="exampleFormControlInput1">Quantity</label>
						<input type="number" class="form-control" id="quantity" name="Quantity" placeholder="Quantity" required>
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


<div class="row">
	<div class="col-md-6 col-lg-6 col-xl-8 mb-5">
		<div class="card">
			<div class="card-header">
				Ingredients
				<div class="header-btn-block">
					<button type="button" data-toggle="modal" data-target="#exampleModalToolTip" class="btn btn-primary">
						<i class="batch-icon batch-icon-add"></i> 
						New Item
					</button>
				</div>
			</div>
			<div class="card-body">

				<?php if(is_array($inventory)): ?>
					<div class="table-responsive">
						<table id="datatable-1" class="table table-datatable table-bordered table-hover">
							<thead class="thead-dark">
								<tr>
									<th>Item Name</th>
									<th>Quantity</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($inventory as $row): ?>
									<tr style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="View Item" onclick="javascript:getItemDetails(<?php echo $row->inventory_id; ?>)">
										<td><?php echo $row->name; ?></td>
										<td><?php echo $row->quantity;	 ?></td>
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
	<div id="Item_Details" style="display: none;" class="col-md-6 col-lg-6 col-xl-4 mb-5">
		<div class="card">
			<div class="card-header">
				Edit Item
			</div>
			<div class="card-body">
				<?php echo form_open('inventory/edit_now'); ?>
				<div class="form-row">
					<div class="col-md-9 mb-3">
						<label>Item Name</label>
						<input id="Item_Name" type="text" class="form-control" name="Item_Details_Name" required>
					</div>
					<div class="col-md-3 mb-3">
						<label>Quantity</label>
						<input id="Item_Quantity" type="number" class="form-control" name="Item_Details_Quantity" required>
						<input id="Item_Details_Inventory_ID" type="hidden" name="Item_Details_Inventory_ID">
					</div>
				</div>
				<div class="form-row">
					<button type="submit" class="btn btn-primary">Update</button>
				</div>
				</form>

				<hr>
				<h2>History</h2>
				<div class="table-responsive">
					<table id="table_item_history" class="table table-sm table-bordered table-hover">
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

