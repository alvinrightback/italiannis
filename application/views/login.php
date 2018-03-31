
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Italianni's Restaurant">
	<meta name="author" content="Italianni's Restaurant">
	<link rel="icon" href="assets/img/favicon.png">

	<title>Login Page - Italianni's Restaurant</title>

	<!-- Fonts -->
	<link href="../../../../../fonts.googleapis.com/cssc85d.css?family=Montserrat:300,400,500,700&amp;subset=latin-ext" rel="stylesheet">

	<!-- CSS - REQUIRED - START -->
	<!-- Batch Icons -->
	<link rel="stylesheet" href="<?php echo base_url('assets/fonts/batch-icons/css/batch-icons.css'); ?>">
	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap/bootstrap.min.css'); ?>">
	<!-- Material Design Bootstrap -->
	<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap/mdb.min.css'); ?>">
	<!-- Custom Scrollbar -->
	<link rel="stylesheet" href="<?php echo base_url('assets/plugins/custom-scrollbar/jquery.mCustomScrollbar.min.css'); ?>">
	<!-- Hamburger Menu -->
	<link rel="stylesheet" href="<?php echo base_url('assets/css/hamburgers/hamburgers.css'); ?>">

	<!-- CSS - REQUIRED - END -->

	<!-- CSS - OPTIONAL - START -->
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo base_url('assets/fonts/font-awesome/css/font-awesome.min.css'); ?>">

	<!-- CSS - DEMO - START -->
	<link rel="stylesheet" href="<?php echo base_url('assets/demo/css/ui-icons-batch-icons.css'); ?>">
	<!-- CSS - DEMO - END -->

	<!-- CSS - OPTIONAL - END -->

	<!-- QuillPro Styles -->
	<link rel="stylesheet" href="<?php echo base_url('assets/css/quillpro/quillpro.css'); ?>">
</head>

<body>

	<div class="container-fluid">
		<div class="row">
			<div class="right-column sisu">
				<div class="row mx-0">
					<div class="col-md-7 order-md-2 signin-right-column px-5 bg-dark" data-qp-bg-image="bg-image-3.jpg">
						<a class="signin-logo d-sm-block d-md-none" href="#">
							<img src="assets/img/logo.png" width="145" height="32.3" alt="QuillPro">
						</a>
						<h1 class="display-4">Sign In To get Started</h1>
						<p class="lead mb-5">
							Lorem ipsum dolor
						</p>
					</div>
					<div class="col-md-5 order-md-1 signin-left-column bg-white px-5">
						<a class="signin-logo d-sm-none d-md-block" href="#">
							<img src="assets/img/logo.png" class="img-responsive" width="320" height="150" alt="Italliani's">
						</a>
						<?php 
								if(isset($error)){
									echo '<div class="alert alert-danger">'.$error.'</div>';
							}  
							?>
						<?php echo form_open('login/validate_credentials'); ?>
							<div class="form-group">
								<label for="userName">Username</label>
								<input type="text" class="form-control" name="username" id="inputUsername" aria-describedby="usernameHelp" placeholder="Enter username" required autofocus>
							</div>
							<div class="form-group">
								<label for="password">Password</label>
								<input type="password" class="form-control" name="password" id="inputPassword1" placeholder="Enter Password" required>
							</div>
							<button type="submit" class="btn btn-success btn-gradient btn-block">
								<i class="batch-icon batch-icon-key"></i>
								Sign In
							</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- SCRIPTS - REQUIRED START -->
	<!-- Placed at the end of the document so the pages load faster -->
	<!-- Bootstrap core JavaScript -->
	<!-- JQuery -->
	<script type="text/javascript" src="<?php echo base_url('assets/js/jquery/jquery-3.1.1.min.js'); ?>"></script>
	<!-- Popper.js - Bootstrap tooltips -->
	<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap/popper.min.js'); ?>"></script>
	<!-- Bootstrap core JavaScript -->
	<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap/bootstrap.min.js'); ?>"></script>
	<!-- MDB core JavaScript -->
	<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap/mdb.min.js'); ?>"></script>
	<!-- Velocity -->
	<script type="text/javascript" src="<?php echo base_url('assets/plugins/velocity/velocity.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/plugins/velocity/velocity.ui.min.js'); ?>"></script>
	<!-- Custom Scrollbar -->
	<script type="text/javascript" src="<?php echo base_url('assets/plugins/custom-scrollbar/jquery.mCustomScrollbar.concat.min.js'); ?>"></script>
	<!-- jQuery Visible -->
	<script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery_visible/jquery.visible.min.js'); ?>"></script>
	<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
	<script type="text/javascript" src="<?php echo base_url('assets/js/misc/ie10-viewport-bug-workaround.js'); ?>"></script>

	<!-- SCRIPTS - REQUIRED END -->

	<!-- SCRIPTS - OPTIONAL START -->
	<!-- Image Placeholder -->
	<script type="text/javascript" src="<?php echo base_url('assets/js/misc/holder.min.js'); ?>"></script>
	<!-- SCRIPTS - OPTIONAL END -->

	<!-- QuillPro Scripts -->
	<script type="text/javascript" src="<?php echo base_url('assets/js/scripts.js'); ?>"></script>
</body>

<!-- Mirrored from base5builder.com/livedemo/quillpro/v1.4/demo_files/sisu-signin-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 10 Mar 2018 22:07:21 GMT -->
</html>
