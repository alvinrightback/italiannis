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

	var inventory_id = '<?php echo $product_details[0]->inventory_id; ?>'.split(',');
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


	<div class="row">
		<div class="col-md-6 col-lg-6 col-xl-8 mb-5">
			<div class="card">
				<div class="card-header">
					Product Details
					<div class="header-btn-block">
					<span class="badge badge-<?php echo $product_details[0]->status == 1? 'success':'danger'; ?>"><?php echo $product_details[0]->status == 1? 'Available':'Unavailable'; ?></span>
				</div>
				</div>
				<div class="card-body">

					<div class="row">
						<div class="col-md-6 col-lg-6 col-xl-6 mb-5">
							<?php echo form_open_multipart('product/edit_now'); ?>
							<div class="form-group">
								<label for="status">Status</label>
								<select name="Product_Status" class="form-control">
										<option value="1" <?php echo $product_details[0]->status == 1 ? ' selected':'' ?>>Available</option>
										<option value="0" <?php echo $product_details[0]->status == 0 ? ' selected':'' ?>>Unvailable</option>
									</select>
							</div>
							<div class="form-group">
								<label for="productName">Product Category</label>
								<select name="Product_Category" class="form-control">
									<?php foreach($product_category as $row): ?>
										<option value="<?php echo $row->aux_id; ?>" 
											<?php echo $row->aux_id == $product_details[0]->product_category_id ? ' selected':'' ?>><?php echo $row->aux_value; ?></option>
										<?php endforeach; ?>
									</select>
								</div>
								<div class="form-group">
									<label for="productName">Product Code</label>
									<input type="text" class="form-control" id="productCode" name="Product_Code" value="<?php echo $product_details[0]->product_code; ?>" placeholder="Enter product code" required>
								</div>
								<div class="form-group">
									<label for="productName">Product Name</label>
									<input type="text" class="form-control" id="productName" name="Product_Name" value="<?php echo $product_details[0]->name; ?>" placeholder="Enter product name" required>
								</div>
								<textarea class="form-control" rows="3" name="Product_Description" placeholder="Enter product description"><?php echo $product_details[0]->description; ?></textarea>
								<div class="form-group">
									<label for="productPrice">Price</label>
									<input type="number" class="form-control" value="<?php echo $product_details[0]->price; ?>" id="productPrice" name="Product_Price" placeholder="Price" required>
								</div>
								<div class="form-group">
									<label for="productPrice">Image</label>
									<input type="file" class="form-control" id="productImage" name="userfile" placeholder="Image" >
									<small id="passwordHelpBlock" class="form-text text-muted">
										Reupload image again to change the current image.
									</small>
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
										<tbody>
											<?php if(is_array($product_details_inventory)): ?>
												<?php foreach($product_details_inventory as $row): ?>
													<tr id="<?php echo $row->inventory_id; ?>" style="cursor: pointer;" title="Remove ingredient" onclick="javascript:removeItem('<?php echo $row->inventory_id; ?>')"><td><?php echo $row->name; ?></td></tr>
												<?php endforeach; ?>
											<?php endif; ?>
										</tbody>
									</table>
								</div>

								<input type="hidden" value="<?php echo $product_details[0]->inventory_id; ?>" id="inventory_id" name="inventory_id">
								<input type="hidden" name="product_id" value="<?php echo $product_details[0]->product_id; ?>">
								<input type="hidden" name="image_name" value="<?php echo $product_details[0]->image_name; ?>">
							</div>
						</div>

						<div class="form-group">
							<button type="submit" class="btn btn-primary">Update</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div id="Item_Details" class="col-md-6 col-lg-6 col-xl-4 mb-5">
			<div class="card-deck">
			<div class="card">
				<img id="Product_Details_Image" class="card-img" src="<?php echo base_url('resources/images/product_photo/'.$product_details[0]->image_name.'.jpeg'); ?>" alt="Card Image">
			</div>
			</div>
		</div>
	</div>

