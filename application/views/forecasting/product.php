<main class="main-content p-5" role="main">
					
					<div class="row">
						<div class="col-md-6 col-lg-6 col-xl-6 mb-5">
							<div class="card">
								<div class="card-header">
									Sales Overview
									<div class="header-btn-block">
										<span class="data-range dropdown">
											<a href="#" class="btn btn-primary dropdown-toggle" id="navbar-dropdown-sales-overview-header-button" data-toggle="dropdown" data-flip="false" aria-haspopup="true" aria-expanded="false">
												<i class="batch-icon batch-icon-calendar"></i>
											</a>
											<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbar-dropdown-sales-overview-header-button">
												<a class="dropdown-item" href="today">Today</a>
												<a class="dropdown-item" href="week">This Week</a>
												<a class="dropdown-item" href="month">This Month</a>
												<a class="dropdown-item active" href="year">This Year</a>
											</div>
										</span>
									</div>
								<div class="card-body">
									
								<?php if(is_array($products)): ?>
									<div class="table-responsive">
										<table id="datatable-1" data-page-length='2' class="table table-datatable-simple table-bordered table-hover">
											<thead class="thead-dark">
												<tr>
													<th>Product Name</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($products as $row): ?>
													<tr style="cursor: pointer;" >
														<td><a class="forecast_product_id" href="<?php echo $row->product_id; ?>"><?php echo $row->name; ?></a></td>
													</tr>
												<?php endforeach; ?>
											</tbody>
										</table>
									</div>
								<?php else: ?>
									<p>No data found.</p>
								<?php endif; ?>
									</div>
									<div class="card-chart" data-chart-color-1="#07a7e3" data-chart-legend-1="Sales">
										<canvas id="product-sales-overview"></canvas>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-lg-6 col-xl-6 mb-5">
							<div class="card card-md">
								<div class="card-header">
									Sales Forecast(2018)
									<div class="header-btn-block">
										<span class="data-range dropdown">
											<a href="#" class="btn btn-primary dropdown-toggle" id="navbar-dropdown-sales-overview-header-button" data-toggle="dropdown" data-flip="false" aria-haspopup="true" aria-expanded="false">
												<i class="batch-icon batch-icon-calendar"></i>
											</a>
											<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbar-dropdown-sales-overview-header-button">
												<a class="dropdown-item" href="today">Today</a>
												<a class="dropdown-item" href="week">This Week</a>
												<a class="dropdown-item" href="month">This Month</a>
												<a class="dropdown-item active" href="year">This Year</a>
											</div>
										</span>
									</div>
								</div>
								<div class="card-body">
									<div class="card-chart" data-chart-color-1="#07a7e3" data-chart-legend-1="Sales">
										<canvas id="sales-forecast"></canvas>
									</div>
								</div>
							</div>
						</div>
					</div>