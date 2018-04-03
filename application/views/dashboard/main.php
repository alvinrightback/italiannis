<main class="main-content p-5" role="main">
					<div class="row">
						<div class="col-md-6 col-lg-6 col-xl-4 mb-5">
							<div class="card card-tile card-xs bg-secondary bg-gradient text-center">
								<div class="card-body p-4">
									<div class="tile-left">
										<i class="batch-icon batch-icon-tag-alt-2 batch-icon-xxl"></i>
									</div>
									<div class="tile-right">
										<div class="tile-number">$7,349.90</div>
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
										<div class="tile-number">5</div>
										<div class="tile-description">Open Tables</div>
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
										<div class="tile-number">476</div>
										<div class="tile-description">Pending Orders</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 col-lg-6 col-xl-8 mb-5">
							<div class="card card-md">
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
								</div>
								<div class="card-body">
									<div class="card-chart" data-chart-color-1="#07a7e3" data-chart-color-2="#32dac3" data-chart-legend-1="Sales ($)" data-chart-legend-2="Orders">
										<canvas id="sales-overview"></canvas>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-lg-6 col-xl-4 mb-5">
							<div class="card card-md">
								<div class="card-header">
									Sales Overview
									<div class="header-btn-block">
										<span class="data-range dropdown">
											<a href="#" class="btn btn-primary dropdown-toggle" id="navbar-dropdown-traffic-sources-header-button" data-toggle="dropdown" data-flip="false" aria-haspopup="true" aria-expanded="false">
												<i class="batch-icon batch-icon-calendar"></i>
											</a>
											<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbar-dropdown-traffic-sources-header-button">
												<a class="dropdown-item" href="today.html">Today</a>
												<a class="dropdown-item" href="week.html">This Week</a>
												<a class="dropdown-item" href="month.html">This Month</a>
												<a class="dropdown-item active" href="year.html">This Year</a>
											</div>
										</span>
									</div>
								</div>
								<div class="card-body text-center">
									<p class="text-left">Your top 5 menu category</p>
									<div class="card-chart" data-chart-color-1="#07a7e3" data-chart-color-2="#32dac3" data-chart-color-3="#4f5b60" data-chart-color-4="#FCCF31" data-chart-color-5="#f43a59">
										<canvas id="traffic-source"></canvas>
									</div>
								</div>
							</div>
						</div>
					</div>