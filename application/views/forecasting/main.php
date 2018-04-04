<main class="main-content p-5" role="main">
					
<div class="row">
						<div class="col-md-6 col-lg-6 col-xl-6 mb-5">
							<div class="card card-md">
								<div id="overallHeader" class="card-header">
									Yearly Sales Overview
									<div class="header-btn-block">
										<span class="data-range dropdown">
											<a href="#" class="btn btn-primary dropdown-toggle" id="navbar-dropdown-sales-overview-header-button" data-toggle="dropdown" data-flip="false" aria-haspopup="true" aria-expanded="false">
												<i class="batch-icon batch-icon-calendar"></i>
											</a>
											<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbar-dropdown-sales-overview-header-button">
												<a class="dropdown-item" href="<?php echo base_url('forecasting/get_yearly_sales/2016');?>">2016</a>
												<a class="dropdown-item" href="<?php echo base_url('forecasting/get_yearly_sales/2017');?>">2017</a>
												<a class="dropdown-item active" href="<?php echo base_url('forecasting/get_yearly_sales/2018');?>">2018</a>
											</div>

										</span>
									</div>
								</div>
								<div class="card-body">
									<div class="card-chart" data-chart-color-1="#07a7e3" data-chart-legend-1="Sales">
										<canvas id="overall-sales-overview"></canvas>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-lg-6 col-xl-6 mb-5">
						<div class="card card-md">
								<div class="card-header">
									Sales Forecast: 2018
									<div class="header-btn-block" style="display: none;">
										<span class="data-range dropdown">
											<a href="#" class="btn btn-primary dropdown-toggle" id="navbar-dropdown-sales-overview-header-button" data-toggle="dropdown" data-flip="false" aria-haspopup="true" aria-expanded="false">
												<i class="batch-icon batch-icon-calendar"></i>
											</a>
											<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbar-dropdown-sales-overview-header-button">
												<a class="dropdown-item active" href="<?php echo base_url('forecasting/get_yearly_sales_forecast/2018');?>">2018</a>
											</div>

										</span>
									</div>
								</div>
								<div class="card-body">
									<div class="card-chart" data-chart-color-1="#07a7e3" data-chart-legend-1="Sales">
										<canvas id="overall-sales-forecast"></canvas>
									</div>
								</div>
							</div>
						</div>
					</div>