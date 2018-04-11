<main class="main-content p-5" role="main">
					<div class="row">
						<div class="col-md-6 col-lg-6 col-xl-4 mb-5">
							<div class="card card-tile card-xs bg-secondary bg-gradient text-center">
								<div class="card-body p-4">
									<div class="tile-left">
										<i class="batch-icon batch-icon-tag-alt-2 batch-icon-xxl"></i>
									</div>
									<div class="tile-right">
										<div class="tile-number">₱ <?php echo $today_sales != NULL ? $today_sales: '0'; ?></div>
										<div class="tile-description">Today's Sales</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-lg-6 col-xl-4 mb-5">
							<div class="card card-tile card-xs bg-primary bg-gradient text-center">
								<div class="card-body p-4">
									<div class="tile-left">
										<i class="batch-icon batch-icon-list batch-icon-xxl"></i>
									</div>
									<div class="tile-right">
										<div class="tile-number"><?php echo $occupied_tables != NULL ? $occupied_tables: '0'; ?></div>
										<div class="tile-description">Tables Occupied</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-lg-6 col-xl-4 mb-5">
							<div class="card card-tile card-xs bg-secondary bg-gradient text-center">
								<div class="card-body p-4">
									<div class="tile-left">
										<i class="batch-icon batch-icon-star batch-icon-xxl"></i>
									</div>
									<div class="tile-right">
										<div class="tile-number"><?php echo $pending_orders != NULL ? $pending_orders: '0'; ?></div>
										<div class="tile-description">Pending Orders</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row mb-5">
						<div class="col-md-6">
							<div class="card">
								<div class="card-header">
									Best Seller: <?php echo date('Y');?>
								</div>
								<div class="card-table table-responsive">
								<?php if(is_array($best_sellers)): ?>
									<table class="table table-hover align-middle">
										<thead class="thead-light">
											<tr>
												<th>Name</th>
												<th>Sales Quantity</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($best_sellers as $row):?>
											
											<tr>
												<td>
													<?php echo $row->name;  ?>
												</td>
												<td>
													<?php echo $row->total_quantity; ?>
												</td>
												
											</tr>
										<?php endforeach; ?>
									
										</tbody>
									</table>
								<?php endif;?>
								</div>
							</div>
						</div>
					</div>
