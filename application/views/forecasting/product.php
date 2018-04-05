<script>
	function setProduct(id, name){
		var dropdown = $('#product-sales-overview').closest('.card').find('.header-btn-block .data-range.dropdown .dropdown-menu.dropdown-menu-right a');
		dropdown.each(function(){
			var temp = $(this).attr('href').split('/');
			temp[7] = id;
			$(this).attr('href', temp.join('/'));
		});		
		$('#selectProductModal').modal('toggle');
		$('#productSalesHeader').text(name);
		$('#productSalesForecastChart').show();
		$('#selectProductBtn').removeClass('btn-primary').addClass('btn-success');
	}

</script>
<main class="main-content p-5" role="main">

			<div class="modal fade" id="selectProductModal" tabindex="-1" role="dialog" aria-labelledby="selectProductModal" aria-hidden="true">
				<div class="modal-dialog modal-md" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Select Product</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
									<?php if(is_array($products)): ?>
										<div class="table-responsive">
											<table id="datatable-1" data-page-length='5' class="table table-datatable-simple table-bordered table-hover">
												<thead class="thead-dark">
													<tr>
														<th>Product Name</th>
													</tr>
												</thead>
												<tbody>
													<?php foreach($products as $row): ?>
														<tr style="cursor: pointer;" onclick="javascript:setProduct('<?php echo $row->product_id; ?>','<?php echo $row->name; ?>')">
															<td><?php echo $row->name; ?></td>
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
			</div>
					
			<div class="row">
				<div class="col-md-6 col-lg-6 col-xl-6 mb-5">
							<div class="card">
								<div class="card-header">
									<div id="productSalesHeader">Product Sales Overview</div>
									<div class="header-btn-block">
										<button id="selectProductBtn" data-toggle="modal" data-target="#selectProductModal" class="btn btn-primary">
											<i class="batch-icon batch-icon-search"></i> 
											Select Product
										</button>

										<span class="data-range dropdown">
											<a href="#" class="btn btn-primary dropdown-toggle" id="navbar-dropdown-sales-overview-header-button" data-toggle="dropdown" data-flip="false" aria-haspopup="true" aria-expanded="false">
												<i class="batch-icon batch-icon-calendar"></i>
											</a>
											<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbar-dropdown-sales-overview-header-button">
												<a class="dropdown-item" href="<?php echo base_url('forecasting/get_product_yearly_sales/2016/');?>">2016</a>
												<a class="dropdown-item" href="<?php echo base_url('forecasting/get_product_yearly_sales/2017/');?>">2017</a>
												<a class="dropdown-item active" href="<?php echo base_url('forecasting/get_product_yearly_sales/2018/');?>">2018</a>
											</div>

										</span>
									</div>
								</div>
								<div class="card-body">
									<div class="card-chart" data-chart-color-1="#07a7e3" data-chart-legend-1="Sales Quantity">
										<canvas id="product-sales-overview"></canvas>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-lg-6 col-xl-6 mb-5">
						<div class="card card-md">
								<div class="card-header">
									Sales Forecast: 2018
								</div>
								<div class="card-body">
									<div class="card-chart" data-chart-color-1="#07a7e3" data-chart-legend-1="Sales">
										<canvas id="product-sales-forecast-overview"></canvas>
									</div>
								</div>
							</div>
						</div>
			</div>