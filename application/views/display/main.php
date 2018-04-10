<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Italianni's Restaurant">
    <meta name="author" content="Italianni's Restaurant">
    <link rel="shortcut icon" href="<?php echo base_url('favicon.ico');?>">
    <title><?php echo $title; ?> | Italianni's Restaurant</title>


    <!--STYLESHEET-->
    <!--=================================================-->

    <!-- Fonts -->
    <link href="../../../../../fonts.googleapis.com/cssc85d.css?family=Montserrat:300,400,500,700&amp;subset=latin-ext" rel="stylesheet">

    <!-- CSS - REQUIRED - START -->
    <!-- Batch Icons -->
    <link rel="stylesheet" href="<?php echo base_url('assets/fonts/batch-icons/css/batch-icons.css'); ?>">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap/bootstrap.min.css'); ?> ">
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
    <!-- Toastr -->
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/toastr/toastr.min.css'); ?>">

    <!-- CSS - OPTIONAL - END -->

    <!-- QuillPro Styles -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/quillpro/quillpro.css'); ?>">
    <script type="text/javascript">
   
   setInterval(function(){ location.reload(); }, 5000);

    </script>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
                <nav class="navbar-sidebar-horizontal navbar navbar-expand-lg navbar-light bg-white">
                    <a class="navbar-brand" href="<?php echo base_url(); ?>">
                        <img src="<?php echo base_url('assets/img/logo.png'); ?>" width="185" height="42.3" alt="QuillPro">
                    </a>

                        <div class="collapse navbar-collapse" id="navbar-header-content">
                            <ul class="navbar-nav navbar-language-translation mr-auto">

                            </ul>

                            <ul class="navbar-nav ml-5 navbar-profile">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" id="navbar-dropdown-navbar-profile" data-toggle="dropdown" data-flip="false" aria-haspopup="true" aria-expanded="false">
                                        <div class="profile-name">
                                            Administrator <div id="spam"></div>
                                        </div>
                                        <div class="profile-picture bg-gradient bg-primary has-message float-right">
                                            <img src="<?php echo base_url('assets/img/profile-pic.jpg'); ?>" width="44" height="44">
                                        </div>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbar-dropdown-navbar-profile">
                                        <li><a class="dropdown-item" href="<?php echo base_url('user/change_password'); ?>">Change Password</a></li>
                                        <li><a class="dropdown-item" href="<?php echo base_url('logout'); ?>">Logout</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                </nav>
                <div class="right-column">
                    <main class="main-content p-5" role="main">
                            <div class="row my-5 pt-5 clearfix">
                                <div class="col-md-12">
                                    <div class="price-list-type-2 clearfix">
                                        <?php if(is_array($orders)): ?>
                                            <?php foreach($orders as $row): ?>
                                            <?php if(isset($row->orders)): ?>
                                                <div class="plan">
                                                    <h3 class="plan-title">
                                                        <?php echo $row->table_number; ?>
                                                    </h3>
                                                    <div class="plan-cost"><span class="plan-type">
                                                    <?php if($row->remark !== NULL): ?>
                                                    <li class="list-group-item list-group-item-warning"><label class="badge badge-warning"></label> <?php echo $row->remark?></li>                                                    
                                                    <?php endif; ?> 
                                                    </span></div>
                                                    <ul class="plan-features">
                                                        
                                                        <?php foreach ($row->orders as $key => $value): ?>
                                                            <li class="list-group-item list-group-item-success"><?php echo $value->quantity.'-'.$value->name; ?></li>
                                                        <?php endforeach ?>
                                                        
                                                    </ul>
                                                </div>
                                            <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <hr>
                                            <h2>No orders yet</h2>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>


                            <div class="row mb-5">
                                <div class="col-md-12">
                                    <footer>
                                        &#0169; 2018 Italliani's Restaurant
                                    </footer>
                                </div>
                            </div>
                    </main>
                </div>
        </div>
    </div>




    <!--JAVASCRIPT-->
    <!--=================================================-->
    <!-- SCRIPTS - REQUIRED START -->
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
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/custom-scrollbar/jquery.mCustomScrollbar.concat.min.js '); ?>"></script>
    <!-- jQuery Visible -->
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery_visible/jquery.visible.min.js'); ?>"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script type="text/javascript" src="<?php echo base_url('assets/js/misc/ie10-viewport-bug-workaround.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/bootbox/bootbox.min.js'); ?>"></script>
    <!-- SCRIPTS - REQUIRED END -->

    <!-- SCRIPTS - OPTIONAL START -->
    <!-- ChartJS -->
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/chartjs/chart.bundle.min.js'); ?>"></script>
    <!-- Image Placeholder -->
    <script type="text/javascript" src="<?php echo base_url('assets/js/misc/holder.min.js'); ?>"></script>
    <!-- jQuery Easing -->
    <script type="text/javascript" src="<?php echo base_url('assets/js/misc/jquery.easing.1.3.js'); ?>"></script>
    <!-- Toastr -->
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/toastr/toastr.min.js'); ?>"></script>
    <!-- SCRIPTS - OPTIONAL END -->

    <!-- Toastr -->
    <script type="text/javascript" src="<?php echo base_url('assets/demo/js/ui-notifications.js'); ?>"></script>

    <!-- SCRIPTS - OPTIONAL END -->

    <!-- QuillPro Scripts -->
    <script type="text/javascript" src="<?php echo base_url('assets/js/scripts.js'); ?>"></script>

</body>
</html>

