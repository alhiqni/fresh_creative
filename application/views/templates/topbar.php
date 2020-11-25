<body>
    <!-- header-start -->
    <header>
        <!-- Query menu  -->
        <?php
        $role_id = $this->session->userdata('role_id');
        $queryMenu = "SELECT user_menu.id , menu FROM user_menu JOIN user_access_menu ON user_menu.id = menu_id WHERE user_access_menu.role_id = $role_id ORDER BY menu_id ASC";
        $menu = $this->db->query($queryMenu)->result_array();
        ?>
        <div class="header-area ">
            <div id="sticky-header" class="main-header-area">
                <div class="container-fluid ">
                    <div class="header_bottom_border">
                        <div class="row align-items-center">
                            <div class="col-xl-3 col-lg-2">
                                <div class="logo">
                                    <a href="#">
                                        <img src="<?= base_url('assets/free/'); ?>img/logo.png" alt="" style="max-height: 50px;">
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-7">
                                <div class="main-menu  d-none d-lg-block">
                                    <nav>
                                        <ul id="navigation">
                                            <?php foreach ($menu as $m) : ?>
                                                <li><a><?= $m['menu'] ?> <i class="ti-angle-down"></i></a>
                                                    <?php
                                                    $querySubMenu = "SELECT * FROM user_sub_menu JOIN user_menu ON user_menu.id = user_sub_menu.menu_id WHERE user_sub_menu.menu_id = '$m[id]' AND user_sub_menu.is_active = 1 ORDER BY menu_id ASC";
                                                    $subMenu = $this->db->query($querySubMenu)->result_array();
                                                    ?>
                                                    <ul class="submenu">
                                                        <?php foreach ($subMenu as $sm) : ?>
                                                            <li><a href="<?= base_url() . $sm['url'] ?>"><?= $sm['title'] ?></a></li>
                                                        <?php endforeach ?>
                                                    </ul>
                                                </li>
                                            <?php endforeach ?>
                                            <li class="nav-item">
                                                <a class="nav-link" href="<?= base_url('auth/logout') ?>" onclick="return confirm('Are you ready to logout?')">
                                                    <span>Logout</span>
                                                    <i class="fa fa-fw fa-sign-out"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 d-none d-lg-block">
                                <a href="<?= base_url('user') ?>">
                                    <div class="Appointment">
                                        <div class="phone_num d-none d-xl-block">
                                            <span class="mr-2 d-none d-lg-inline text-white small"><?= $user['name'] ?></span>
                                        </div>
                                        <div class="d-none d-lg-block">
                                           <div class="img rounded-circle img-thumbnail mx-auto" style="background: url(' <?= base_url('assets/img/profile/') . $user['image'] ?>');width: 55px;height: 55px;background-position: center;background-size: cover;">
                </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-12">
                                <div class="mobile_menu d-block d-lg-none"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </header>
    <!-- header-end -->
    <!-- jumbroton -->
    <div class="slider_area">
        <div class="single_slider  d-flex align-items-center slider_bg_1">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7 col-md-6">
                        <div class="slider_text">
                            <h3 class="wow fadeInLeft" id="greeting" data-wow-duration="1s" data-wow-delay=".3s">
                                <?= greeting() ?>
                            </h3>
                            <h5 class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".2s"><?= $user['name'] ?> </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ilstration_img wow fadeInRight d-none d-lg-block text-right" data-wow-duration="1s" data-wow-delay=".2s">
            <img src="<?= base_url('assets/free/'); ?>img/banner/illustration.png" alt="">
        </div>
    </div>
    <!-- jumbroton end -->