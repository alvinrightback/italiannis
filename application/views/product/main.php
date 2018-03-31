<script type="text/javascript">
	
	function getProductDetails(id){
		$('#Item_Details').css('display', 'block');
		$.ajax({
			'url' : '<?php  echo base_url('product/get_product_details/'); ?>',
			'type' : 'POST', 
			'data' : {'id' : id},
			'dataType' : 'json',
			'cache' : false,
			'success' : function(data){ 
				$('#Product_Details_ID').attr('href', '<?php echo base_url('product/edit/'); ?>'+data['product_details'][0]['product_id']);
				$('#Product_Details_Name').text(data['product_details'][0]['name']);
				$('#Product_Details_Description').text(data['product_details'][0]['description']);
				$('#Product_Details_Price').text('₱'+data['product_details'][0]['price']);
				$('#Product_Details_Image').attr('src', '<?php echo base_url('resources/images/product_photo/'); ?>'+data['product_details'][0]['image_name']+'.jpeg');
				var ingredient = "";
				$.each(data['product_details_inventory'], function(index, value){
					ingredient+=value.name+', ';
				});
				$('#Product_Details_Inventory').text('Ingredients: '+ingredient.replace(/, +$/, ''));
			}
		});
	}

	var inventory_id = [];
	function addItem(id, name){
		bootbox.confirm("Are you sure?", function(result) {
			if (result) {
				$('#ingredients_table').append('<tr id='+id+' style="cursor: pointer;" title="Remove ingredient" onclick="javascript:removeItem('+id+')"><td>'+name+'</td></tr>');
				inventory_id.push(id);
				$('#inventory_id').val(inventory_id);
			}
		});
	}

	function removeItem(id){
		bootbox.confirm("Are you sure?", function(result) {
			if (result) {
				$('#' + id).remove();
				const index = inventory_id.indexOf(id.toString());
				if (index !== -1) {
					inventory_id.splice(index, 1);
					$('#inventory_id').val(inventory_id);
				}
			}
		});
	}

</script>
<main class="main-content p-5" role="main">
	<div class="row">
		<div class="col-md-12">
			<h1>Product</h1>
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
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Add New Product</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6 col-lg-6 col-xl-6 mb-5">
							<?php echo form_open_multipart('product/add_now'); ?>
							<div class="form-group">
								<label for="productName">Product Category</label>
								<select name="Product_Category" class="form-control">
									<?php foreach($product_category as $row): ?>
										<option value="<?php echo $row->aux_id; ?>"><?php echo $row->aux_value; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="form-group">
								<label for="productName">Product Code</label>
								<input type="text" class="form-control" id="productCode" name="Product_Code" placeholder="Enter product code" required>
							</div>
							<div class="form-group">
								<label for="productName">Product Name</label>
								<input type="text" class="form-control" id="productName" name="Product_Name" placeholder="Enter product name" required>
							</div>
							<textarea class="form-control" rows="3" name="Product_Description" placeholder="Enter product description"></textarea>
							<div class="form-group">
								<label for="productPrice">Price</label>
								<input type="number" class="form-control" id="productPrice" name="Product_Price" placeholder="Price" required>
							</div>
							<div class="form-group">
								<label for="productPrice">Image</label>
								<input type="file" class="form-control" id="productImage" name="userfile" placeholder="Image" required>
								<?php if($this->session->flashdata('upload_error')): ?>
									<small class="text-danger"><?php echo $this->session->flashdata('upload_error'); ?></small>
								<?php endif; ?>
							</div>
						</div>

						<div class="col-md-6 col-lg-6 col-xl-6 mb-5">
							<?php if(is_array($inventory)): ?>
								<label>Select Ingredients</label>
								<div class="table-responsive">
									<table id="datatable-1" class="table table-datatable-simple table-sm table-bordered table-hover" data-page-length='2'>
										<thead class="thead-dark">
											<tr>
												<th>Item Name</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($inventory as $row): ?>
												<tr style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="Add ingredient" onclick="javascript:addItem('<?php echo $row->inventory_id; ?>', '<?php echo $row->name; ?>')">
													<td><?php echo $row->name; ?></td>
												</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
								</div>
							<?php else: ?>
								<p>No data found.</p>
							<?php endif; ?>

							<hr>

							<div class="table-responsive">
								<table id="ingredients_table" class="table table-sm table-bordered">
									<thead class="thead-dark">
										<tr>
											<th>Ingredients</th>
										</tr>
									</thead>
								</table>
							</div>

							<input type="hidden" id="inventory_id" name="inventory_id">
						</div>
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
				Beverages & Ingredients
				<div class="header-btn-block">
					<button type="button" data-toggle="modal" data-target="#exampleModalToolTip" class="btn btn-primary">
						<i class="batch-icon batch-icon-add"></i> 
						New Item
					</button>
				</div>
			</div>
			<div class="card-body">

				<?php if(is_array($products)): ?>
					<div class="table-responsive">
						<table id="datatable-1" class="table table-datatable table-bordered table-hover">
							<thead class="thead-dark">
								<tr>
									<th>Name</th>
									<th>Category</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($products as $row): ?>
									<tr onclick="javascript:getProductDetails('<?php echo $row->product_id; ?>')">
										<td><?php echo $row->name; ?></td>
										<td><?php echo $row->aux_value;	 ?></td>
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
			<img id="Product_Details_Image" class="card-img-top" src="assets/img/bg-image-1.jpg" alt="Card Image">
			<div class="card-body">
				<h4 id="Product_Details_Name" class="card-title">Card title</h4>
				<p id="Product_Details_Description" class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
				<p id="Product_Details_Inventory" class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
				<a id="Product_Details_ID" class="btn btn-primary btn-sm pull-right">Edit</a>
				<div id="Product_Details_Price" class="price-new">$275</div>
			</div>
		</div>

	</div>
</div>

