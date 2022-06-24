<?= $this->extend("layouts/base"); ?>
<!-- NOTE This keeps this page in the "content" placeholder in the layouts/base.php file  -->
<?= $this->section("content"); ?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Dashboard | Our Pos</title>
    <meta property="og:image" content="<?= base_url(); ?>/public/src/img/brand-white.png" />
    <meta name="description" content="View recent activities and sales. Get an overview on the performance of your store.">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="<?=base_url(); ?>/public/favicon.ico" type="image/x-icon" />

    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800" rel="stylesheet">

    <link rel="manifest" href="<?=base_url(); ?>/public/manifest.json">
    <link rel="apple-touch-icon"href="<?php base_url(); ?>public/favicon.ico" type="image/x-icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#404E67"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Hello World">
    <meta name="msapplication-TileImage" content="<?php base_url(); ?>public/favicon.ico">
    <meta name="msapplication-TileColor" content="#FFFFFF">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="<?=base_url(); ?>/public/plugins/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=base_url(); ?>/public/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?=base_url(); ?>/public/plugins/ionicons/dist/css/ionicons.min.css">
    <link rel="stylesheet" href="<?=base_url(); ?>/public/plugins/icon-kit/dist/css/iconkit.min.css">
    <link rel="stylesheet" href="<?=base_url(); ?>/public/plugins/perfect-scrollbar/css/perfect-scrollbar.css">
    <link rel="stylesheet" href="<?=base_url(); ?>/public/plugins/weather-icons/css/weather-icons.min.css">
    <link rel="stylesheet" href="<?=base_url(); ?>/public/plugins/owl.carousel/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="<?=base_url(); ?>/public/plugins/owl.carousel/dist/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="<?=base_url(); ?>/public/plugins/chartist/dist/chartist.min.css">
    <link rel="stylesheet" href="<?=base_url(); ?>/public/dist/css/theme.min.css">
    <link rel="stylesheet" href="<?=base_url(); ?>/public/plugins/jquery-toast-plugin/dist/jquery.toast.min.css">
    <script src="<?=base_url(); ?>/public/src/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <div id="overlay">
        <div class='lds-ripple'>
            <div></div>
            <div></div>
        </div>
    </div>
    <div class="wrapper">

        <!-- // NOTE THE TOP BAR IS SUPPOSED TO BE HERE  -->


        <?= $this->include("widgets/topbar"); ?>

        <div class="page-wrap">
        <!-- NOTE THE LEFT-SIDE BAR IS SUPPOSED TO HERE -->
        <?= $this->include("widgets/left-sidebar"); ?>

            <div class="main-content">
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row align-items-end">
                            <div class="col-lg-8">
                                <div class="page-header-title">
                                    <i class="ik ik-bar-chart-2 bg-blue"></i>
                                    <div class="d-inline">
                                        <h5>Dashboard</h5>
                                        <span>Shop's Statistic Overview</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <nav class="breadcrumb-container" aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="<?php base_url(); ?>public/index.html"><i class="ik ik-home"></i></a>
                                        </li>
                                        <li class="breadcrumb-item">
                                            <a href="#">Dashboard</a>
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- General Cash info start -->
                        <div class="col-xl-3 col-md-6">
                            <div class="card prod-p-card card-red">
                                <div class="card-body">
                                    <div class="row align-items-center mb-30">
                                        <div class="col">
                                            <h6 class="mb-5 text-white">
                                                <small>
                                                   Sales Today
                                                </small>
                                            </h6>
                                        <?php if (!empty($allSales)):?>
                                            <h3 class="mb-0 fw-700 text-white">
                                                <small style="font-size: 15px">₵</small>
                                                <span class="comma">
                                                <?=$allSales["today_amount"]?>
                                                </span>
                                            </h3>
                                        <?php else:?>
                                            <h3 class="mb-0 fw-700 text-white">GHc. 0</h3>
                                        <?php endif;?>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa fa-money-bill-alt text-red f-18"></i>
                                        </div>
                                    </div>
<!--                                    <p class="mb-0 text-white"><span class="label label-danger mr-10">+11%</span>From Previous Month</p>-->
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card prod-p-card card-blue">
                                <div class="card-body">
                                    <div class="row align-items-center mb-30">
                                        <div class="col">
                                            <h6 class="mb-5 text-white">
                                                <small>
                                                    Sales This Month
                                                </small>
                                            </h6>
                                            <?php if (!empty($allSales)):?>
                                            <h3 class="mb-0 fw-700 text-white">
                                                <small style="font-size: 15px">₵</small>
                                                <span class="comma">
                                                    <?=$allSales['month_amount']?>
                                                </span>
                                            </h3>
                                            <?php else:?>
                                            <h3 class="mb-0 fw-700 text-white">15,830</h3>
                                            <?php endif;?>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-database text-blue f-18"></i>
                                        </div>
                                    </div>
<!--                                    <p class="mb-0 text-white"><span class="label label-primary mr-10">+12%</span>From Previous Month</p>-->
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card prod-p-card card-green">
                                <div class="card-body">
                                    <div class="row align-items-center mb-30">
                                        <div class="col">
                                            <h6 class="mb-5 text-white">
                                                <small>
                                                    Sold Today
                                                </small>
                                            </h6>
                                            <?php if (!empty($allSales)):?>
                                                <h3 class="mb-0 fw-700 text-white">
                                                    <span class="comma">
                                                        <?=$allSales["today_quantity"]?>
                                                    </span>
                                                </h3>
                                            <?php else:?>
                                                <h3 class="mb-0 fw-700 text-white">0</h3>
                                            <?php endif;?>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign text-green f-18"></i>
                                        </div>
                                    </div>
<!--                                    <p class="mb-0 text-white"><span class="label label-success mr-10">+52%</span>From Previous Month</p>-->
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card prod-p-card card-yellow">
                                <div class="card-body">
                                    <div class="row align-items-center mb-30">
                                        <div class="col">
                                            <h6 class="mb-5 text-white">
                                                <small>
                                                    Sold This Month
                                                </small>
                                            </h6>
                                            <?php if (!empty($allSales)):?>
                                                <h3 class="mb-0 fw-700 text-white"><?=$allSales["month_quantity"]?></h3>
                                            <?php else:?>
                                                <h3 class="mb-0 fw-700 text-white">0</h3>
                                            <?php endif;?>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-tags text-warning f-18"></i>
                                        </div>
                                    </div>
<!--                                    <p class="mb-0 text-white"><span class="label label-warning mr-10">+52%</span>From Previous Month</p>-->
                                </div>
                            </div>
                        </div>
                        <!-- End of General Cash info -->

                        <!-- SECTION New Customers and Top 5 Products-->
                        <!-- SECTION NEW CUSTOMERS -->
                       <!-- <div class="col-xl-4 col-md-6">
                                <div class="card new-cust-card">
                                    <div class="card-header">
                                        <h3>New Customers</h3>
                                        <div class="card-header-right">
                                            <ul class="list-unstyled card-option">
                                                <li><i class="ik ik-chevron-left action-toggle"></i></li>
                                                <li><i class="ik ik-minus minimize-card"></i></li>
                                                <li><i class="ik ik-x close-card"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="card-block">
                                        <div class="align-middle mb-25">
                                            <img src="<?php base_url(); ?>public/img/users/1.jpg" alt="user image" class="rounded-circle img-40 align-top mr-15">
                                            <div class="d-inline-block">
                                                <a href="#!">
                                                    <h6>Alex Thompson</h6>
                                                </a>
                                                <p class="text-muted mb-0">Cheers!</p>
                                                <span class="status active"></span>
                                            </div>
                                        </div>
                                        <div class="align-middle mb-25">
                                            <img src="<?php base_url(); ?>public/img/users/2.jpg" alt="user image" class="rounded-circle img-40 align-top mr-15">
                                            <div class="d-inline-block">
                                                <a href="#!">
                                                    <h6>John Doue</h6>
                                                </a>
                                                <p class="text-muted mb-0">stay hungry stay foolish!</p>
                                                <span class="status active"></span>
                                            </div>
                                        </div>
                                        <div class="align-middle mb-25">
                                            <img src="<?php base_url(); ?>public/img/users/3.jpg" alt="user image" class="rounded-circle img-40 align-top mr-15">
                                            <div class="d-inline-block">
                                                <a href="#!">
                                                    <h6>Alex Thompson</h6>
                                                </a>
                                                <p class="text-muted mb-0">Cheers!</p>
                                                <span class="status deactive text-mute"><i class="far fa-clock mr-10"></i>30 min ago</span>
                                            </div>
                                        </div>
                                        <div class="align-middle mb-25">
                                            <img src="<?php base_url(); ?>public/img/users/4.jpg" alt="user image" class="rounded-circle img-40 align-top mr-15">
                                            <div class="d-inline-block">
                                                <a href="#!">
                                                    <h6>John Doue</h6>
                                                </a>
                                                <p class="text-muted mb-0">Cheers!</p>
                                                <span class="status deactive text-mute"><i class="far fa-clock mr-10"></i>10 min ago</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <!-- !SECTION -->
                            <!-- SECTION -->
                            <div class="col-xl-12 col-md-6">
                                <div class="card table-card">
                                    <div class="card-header">
                                        <h3>Top 5 Products</h3>
                                        <div class="card-header-right">
                                            <ul class="list-unstyled card-option">
                                                <li><i class="ik ik-chevron-left action-toggle"></i></li>
                                                <li><i class="ik ik-minus minimize-card"></i></li>
                                                <li><i class="ik ik-x close-card"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="card-block">
                                        <div class="table-responsive">
                                            <?php if (is_array($productPerformance)): ?>
                                            <table class="table table-hover mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>Product Name</th>
<!--                                                        <th>Image</th>-->
                                                        <th>Status</th>
                                                        <th>Total (GHc)</th>
                                                        <th>Total (Qty)</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php foreach ($productPerformance as $row): ?>
                                                    <tr>
                                                        <td><?=$row->product?></td>
<!--                                                        <td><img src="--><?php //base_url(); ?><!--public/img/widget/p1.jpg" alt="" class="img-fluid img-20"></td>-->
                                                        <td>
                                                            <div class="p-status bg-green"></div>
                                                        </td>
                                                        <td><?=$row->amount?></td>
                                                        <td><?=$row->quantity?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                            <?php else:?>
                                            <table class="table table-hover mb-0">
                                                <tbody>
                                                <tr>
                                                    <td class="text-center">Products not rated yet</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <?php endif; ?>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- !SECTION -->
                            <!-- !SECTION New Customers and Top 5 Products-->

                            <!-- Recent Activities for admin only
                            <div class="col-md-12">
                                <div class="card table-card">
                                    <div class="card-header">
                                        <h3>Recent Activities</h3>
                                        <div class="card-header-right">
                                            <ul class="list-unstyled card-option">
                                                <li><i class="ik ik-chevron-left action-toggle"></i></li>
                                                <li><i class="ik ik-minus minimize-card"></i></li>
                                                <li><i class="ik ik-x close-card"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="card-block">
                                        <div class="table-responsive">
                                            <table class="table table-hover mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>Customer</th>
                                                        <th>Company</th>
                                                        <th>Lead Score</th>
                                                        <th>Date</th>
                                                        <th>Tags</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="d-inline-block align-middle">
                                                                <img src="<?php base_url(); ?>public/img/users/4.jpg" alt="user image" class="rounded-circle img-40 align-top mr-15">
                                                                <div class="d-inline-block">
                                                                    <h6>Shirley Hoe</h6>
                                                                    <p class="text-muted mb-0">Sales executive , NY</p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>Pinterest</td>
                                                        <td>223</td>
                                                        <td>19-11-2018</td>
                                                        <td>
                                                            <label class="badge badge-primary">Sketch</label>
                                                            <label class="badge badge-primary">Ui</label>
                                                        </td>
                                                        <td><a href="#!"><i class="ik ik-edit f-16 mr-15 text-green"></i></a><a href="#!"><i class="ik ik-trash-2 f-16 text-red"></i></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="d-inline-block align-middle">
                                                                <img src="<?php base_url(); ?>public/img/users/2.jpg" alt="user image" class="rounded-circle img-40 align-top mr-15">
                                                                <div class="d-inline-block">
                                                                    <h6>James Alexander</h6>
                                                                    <p class="text-muted mb-0">Sales executive , EL</p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>Facebook</td>
                                                        <td>268</td>
                                                        <td>19-11-2018</td>
                                                        <td>
                                                            <label class="badge badge-primary">Ux</label>
                                                            <label class="badge badge-danger">Ui</label>
                                                            <label class="badge badge-danger">php</label>
                                                        </td>
                                                        <td><a href="#!"><i class="ik ik-edit f-16 mr-15 text-green"></i></a><a href="#!"><i class="ik ik-trash-2 f-16 text-red"></i></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="d-inline-block align-middle">
                                                                <img src="<?php base_url(); ?>public/img/users/4.jpg" alt="user image" class="rounded-circle img-40 align-top mr-15">
                                                                <div class="d-inline-block">
                                                                    <h6>Shirley Hoe</h6>
                                                                    <p class="text-muted mb-0">Sales executive , NY</p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>Twitter</td>
                                                        <td>293</td>
                                                        <td>16-03-2018</td>
                                                        <td>
                                                            <label class="badge badge-danger">Sketch</label>
                                                            <label class="badge badge-primary">Ui</label>
                                                        </td>
                                                        <td><a href="#!"><i class="ik ik-edit f-16 mr-15 text-green"></i></a><a href="#!"><i class="ik ik-trash-2 f-16 text-red"></i></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="d-inline-block align-middle">
                                                                <img src="<?php base_url(); ?>public/img/users/4.jpg" alt="user image" class="rounded-circle img-40 align-top mr-15">
                                                                <div class="d-inline-block">
                                                                    <h6>Shirley Hoe</h6>
                                                                    <p class="text-muted mb-0">Sales executive , NY</p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>Pinterest</td>
                                                        <td>223</td>
                                                        <td>19-11-2018</td>
                                                        <td>
                                                            <label class="badge badge-primary">Ux</label>
                                                            <label class="badge badge-success">Ui</label>
                                                            <label class="badge badge-warning">php</label>
                                                        </td>
                                                        <td><a href="#!"><i class="ik ik-edit f-16 mr-15 text-green"></i></a><a href="#!"><i class="ik ik-trash-2 f-16 text-red"></i></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="d-inline-block align-middle">
                                                                <img src="<?php base_url(); ?>public/img/users/2.jpg" alt="user image" class="rounded-circle img-40 align-top mr-15">
                                                                <div class="d-inline-block">
                                                                    <h6>James Alexander</h6>
                                                                    <p class="text-muted mb-0">Sales executive , EL</p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>Facebook</td>
                                                        <td>268</td>
                                                        <td>19-11-2018</td>
                                                        <td>
                                                            <label class="badge badge-primary">Sketch</label>
                                                            <label class="badge badge-primary">Ui</label>
                                                        </td>

                                                        <td><a href="#!"><i class="ik ik-edit f-16 mr-15 text-green"></i></a><a href="#!"><i class="ik ik-trash-2 f-16 text-red"></i></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="d-inline-block align-middle">
                                                                <img src="<?php base_url(); ?>public/img/users/4.jpg" alt="user image" class="rounded-circle img-40 align-top mr-15">
                                                                <div class="d-inline-block">
                                                                    <h6>Shirley Hoe</h6>
                                                                    <p class="text-muted mb-0">Sales executive , NY</p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>Twitter</td>
                                                        <td>293</td>
                                                        <td>16-03-2018</td>
                                                        <td>
                                                            <label class="badge badge-danger">Sketch</label>
                                                            <label class="badge badge-primary">Ui</label>
                                                        </td>
                                                        <td><a href="#!"><i class="ik ik-edit f-16 mr-15 text-green"></i></a><a href="#!"><i class="ik ik-trash-2 f-16 text-red"></i></a></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            End of Recent activity -->

                    </div>
                </div>
            </div>
            <?php
                // include(APP_ROOT."/views/includes/right-sidebar.php");
                // include(APP_ROOT."/views/includes/chatpanel.php");
            ?>
            <?= $this->include("widgets/right-sidebar"); ?>
            <?= $this->include("widgets/chatpanel"); ?>
            <?= $this->include("widgets/footer"); ?>
        </div>
    </div>

    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterLabel">This is a test</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <h1>Welcome <?php //echo $user_info["name"]; ?> !</h1>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>


    <?= $this->include("widgets/user_menu"); ?>

    <script src="<?=base_url(); ?>/public/src/js/vendor/jquery-3.3.1.min.js"></script>
    <script>
    </script>
    <script src="<?=base_url(); ?>/public/plugins/popper.js/dist/umd/popper.min.js"></script>
    <script src="<?=base_url(); ?>/public/plugins/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?=base_url(); ?>/public/plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js"></script>
    <script src="<?=base_url(); ?>/public/plugins/screenfull/dist/screenfull.js"></script>
    <script src="<?=base_url(); ?>/public/plugins/owl.carousel/dist/owl.carousel.min.js"></script>
    <script src="<?=base_url(); ?>/public/plugins/chartist/dist/chartist.min.js"></script>
    <script src="<?=base_url(); ?>/public/dist/js/theme.min.js"></script>
    <script src="<?=base_url(); ?>/public/js/widget-statistic.js"></script>
    <script src="<?=base_url(); ?>/public/plugins/jquery-toast-plugin/dist/jquery.toast.min.js"></script>
    <script>
        d = document.getElementsByClassName('comma');
        for (let i = 0; i < d.length; i++) {
            d[i].innerText = parseFloat(d[i].innerText).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
         <?php 
            if (!empty(session()->getTempdata('name'))): 
         ?>
            $.toast({
                text: 'Welcome <?=session()->getTempdata('name')?>',
                showHideTransition: 'fade',
                icon: 'success',
                position: "top-right",
                bgColor: '#2dce89',
                textColor: 'white'
            })
        <?php 
            endif;
        ?>
    </script>
</body>

</html>
<?= $this->endSection(); ?>