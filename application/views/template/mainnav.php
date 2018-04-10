<div class="right-column">
				<nav class="sidebar-horizontal navbar navbar-expand-lg navbar-dark bg-dark">
					<div class="navbar-collapse" id="navbar-header-menu-outer">
						<ul class="navbar-nav navbar-header-menu mr-auto">
							<li class="nav-item">
								<a class="nav-link" href="<?php echo base_url('dashboard') ?>">
									<i class="batch-icon batch-icon-browser-alt"></i>
									Dashboard
								</a>
							</li>
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" data-toggle="dropdown" data-flip="false" aria-haspopup="true" aria-expanded="false">
									<i class="batch-icon batch-icon-database"></i>
									Inventory
								</a>
								<ul class="dropdown-menu" aria-labelledby="navbar-dropdown-ecommerce-link">
									<li><a class="dropdown-item" href="<?php echo base_url('inventory') ?>">Ingredients</a></li>
									<li><a class="dropdown-item" href="<?php echo base_url('inventory/saleable') ?>">Food & Beverages</a></li>
								</ul>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="<?php echo base_url('transaction') ?>">
									<i class="batch-icon batch-icon-store"></i>
									Transaction
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="<?php echo base_url('product') ?>">
									<i class="batch-icon batch-icon-book-alt-"></i>
									Product
								</a>
							</li>
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" data-toggle="dropdown" data-flip="false" aria-haspopup="true" aria-expanded="false">
									<i class="batch-icon batch-icon-database"></i>
									Forecasting and Analytics
								</a>
								<ul class="dropdown-menu" aria-labelledby="navbar-dropdown-ecommerce-link">
									<li><a class="dropdown-item" href="<?php echo base_url('forecasting') ?>">Overall Sales</a></li>
									<li><a class="dropdown-item" href="<?php echo base_url('forecasting/product_forecast') ?>">Product Sales</a></li>
								</ul>
							</li>
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" data-toggle="dropdown" data-flip="false" aria-haspopup="true" aria-expanded="false">
									<i class="batch-icon batch-icon-clipboard-alt"></i>
									Kitchen Display
								</a>
								<ul class="dropdown-menu" aria-labelledby="navbar-dropdown-ecommerce-link">
									<li><a class="dropdown-item" href="<?php echo base_url('display') ?>">Display</a></li>
									<li><a class="dropdown-item" href="<?php echo base_url('display/manage') ?>">Manage</a></li>
								</ul>
							</li>
						</ul>
					</div>
				</nav>