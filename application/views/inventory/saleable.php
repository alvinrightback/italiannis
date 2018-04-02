<script type="text/javascript">
	
	function getProductDetails(id){
		$('#table_product_ingredients').DataTable().destroy();
		$('#Product_Details, #Product_Details_Progress').css('display', 'block');
		$('#Product_Details_Body').css('display', 'none');
		$.ajax({
			'url' : '<?php  echo base_url('product/get_product_details/'); ?>',
			'type' : 'POST', 
			'data' : {'id' : id},
			'dataType' : 'json',
			'cache' : false,
			'success' : function(data){ 
 					$('#Product_Name').text(data['product_details'][0]['name']);
 					$('#Product_ID').val(data['product_details'][0]['product_id']);
 					$('#Product_Inventory_ID').val(data['product_details'][0]['inventory_id']);
 					var myTable = $('#table_product_ingredients').DataTable({
 						"paging": true,
 						"lengthChange": false,
 						"searching": true,
 						"ordering": true,
 						"info": true,
 						"autoWidth": true,
 						"columns": [{
 							"title": "Item Name",
 							"data": "name"
 						}]
 					});

 					myTable.clear();
 					$.each(data['product_details_inventory'], function(index, value) {
 						myTable.row.add(value);
 					});
 					myTable.draw();
 				},
			'complete' : function(){
				$('#Product_Details_Progress').css('display', 'none');
				$('#Product_Details_Body').css('display', 'block');
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
				Food & Beverages
				<div class="header-btn-block">
					<button type="button" data-toggle="modal" data-target="#exampleModalToolTip" class="btn btn-primary">
						<i class="batch-icon batch-icon-add"></i> 
						New Item
					</button>
				</div>
			</div>
			<div class="card-body">

				<?php if(is_array($saleable)): ?>
					<div class="table-responsive">
						<table id="datatable-1" class="table table-datatable table-bordered table-hover">
							<thead class="thead-dark">
								<tr>
									<th>Product Name</th>
									<th>Available</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($saleable as $row): ?>
									<tr class="<?php echo isset($row->insufficient_inventory)? 'table-danger': '' ?>" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="View Product" onclick="javascript:getProductDetails(<?php echo $row->product_id; ?>)">
										<td><?php echo $row->name; ?></td>
										<td><?php echo isset($row->available_serving) ? $row->available_serving: '0';	?></td>
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
	<div id="Product_Details" style="display: none;" class="col-md-6 col-lg-6 col-xl-4 mb-5">
		<div class="card">
			<div id="Product_Name" class="card-header">
				Edit Item
			</div>
			<div class="card-body">
				<div id="Product_Details_Progress" style="display: none;" class="progress">
					<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
				</div>
				<div id="Product_Details_Body" style="display: none;">
					<?php echo form_open('inventory/edit_product_quantity'); ?>
						<label for="inputGroupFile04">Add Quantity</label>
						<div class="input-group mb-3">
							<input type="text" class="form-control" name="Add_Quantity" placeholder="Enter quantity to add" aria-label="Add quantity" aria-describedby="basic-addon2" required>
							<input id="Product_ID" type="hidden" name="product_id">
							<input id="Product_Inventory_ID" type="hidden" name="inventory_id">
							<div class="input-group-append">
								<button class="btn btn-primary" type="submit">Add</button>
							</div>
						</div>
					</form>

					<hr>
					<label>Ingredients</label>
					<div class="table-responsive">
						<table id="table_product_ingredients" class="table table-sm table-bordered table-hover">
							<thead class="thead-dark">
								<tr>
									<th>Item Name</th>
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

