<body>
<div class="container-fluid">
        <div class="row">
            <nav class="navbar-sidebar-horizontal navbar navbar-expand-lg navbar-light bg-white">
                <a class="navbar-brand" href="<?php echo base_url(); ?>">
                    <img src="<?php echo base_url('assets/img/logo.png'); ?>" width="185" height="42.3" alt="QuillPro">
                </a>
                

                <!--  DEPRECATED CODE:
                    <div class="navbar-collapse" id="navbarSupportedContent">
                -->
                <!-- USE THIS CODE Instead of the Commented Code Above -->
                <!-- .collapse added to the element -->
                <div class="collapse navbar-collapse" id="navbar-header-content">
                    <ul class="navbar-nav navbar-language-translation mr-auto">
                        
                    </ul>
                    
                    <ul class="navbar-nav ml-5 navbar-profile">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbar-dropdown-navbar-profile" data-toggle="dropdown" data-flip="false" aria-haspopup="true" aria-expanded="false">
                                <div class="profile-name">
                                    Administrator
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