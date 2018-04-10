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
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									Best Seller
								</div>
								<div class="card-table table-responsive">
									<table class="table table-hover align-middle">
										<thead class="thead-light">
											<tr>
												<th>Member</th>
												<th>Email</th>
												<th class="text-center">Status</th>
												<th>Created</th>
												<th class="text-right">Action</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>
													<div class="media">
														<div class="profile-picture bg-gradient bg-primary has-message float-right d-flex mr-3">
															<img src="assets/img/profile-pic.jpg" width="44" height="44">
														</div>
														<div class="media-body">
															<div class="heading mt-1">
																Johanna Quinn
															</div>
															<div class="subtext">jquinn897</div>
														</div>
													</div>
												</td>
												<td>
													<a href="#">johanna.quinn@gmail.com</a>
												</td>
												<td class="text-center">
													<span class="badge badge-primary">Approved</span>
												</td>
												<td>23rd Feb 2017</td>
												<td class="text-right">
													<a class="btn btn-primary">
														<i class="batch-icon batch-icon-eye"></i>
													</a>
													<a class="btn btn-success">
														<i class="batch-icon batch-icon-quill"></i>
													</a>
												</td>
											</tr>
											
											
											
											
											
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
