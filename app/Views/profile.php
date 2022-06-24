<?= $this->extend("layouts/base"); ?>
<!-- NOTE This keeps this page in the "content" placeholder in the layouts/base.php file  -->
<?= $this->section("content"); ?>
<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Profile | Our Pos</title>
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="icon" href="<?=base_url()?>/public/favicon.ico" type="image/x-icon" />

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
        <link rel="stylesheet" href="<?=base_url(); ?>/public/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="<?=base_url(); ?>/public/plugins/datatables/css/buttons.dataTables.min.css">
        <link rel="stylesheet" href="<?=base_url(); ?>/public/dist/css/theme.min.css">
        <link rel="stylesheet" href="<?=base_url(); ?>/public/plugins/jquery-toast-plugin/dist/jquery.toast.min.css">
        <link rel="stylesheet" href="<?= base_url(); ?>/public/plugins/sweetalerts2/dist/sweetalert2.css">
        <link rel="stylesheet" href="<?=base_url(); ?>/public/plugins/datatables/css/responsive.bootstrap.css">
        <link rel="stylesheet" href="<?=base_url(); ?>/public/plugins/datatables/css/responsive.dataTables.css">
        <script src="<?=base_url(); ?>/public/src/js/vendor/modernizr-2.8.3.min.js"></script>
        <link rel="stylesheet" href="<?=base_url(); ?>/public/plugins/jquery-toast-plugin/dist/jquery.toast.min.css">


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
                                        <i class="ik ik-file-text bg-blue"></i>
                                        <div class="d-inline">
                                            <h5>Profile</h5>
                                            <span>View Your Profile Info and Insights</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a id="domain" loading="true" href="<?=base_url()?>"><i class="ik ik-home"></i></a>
                                            </li>
                                            <li class="breadcrumb-item">
                                                <a href="#">Profile</a>
                                            </li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 col-md-5">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="text-center">
                                        <?php if ($userdata->profile_pic):?> 
                                            <img src="<?=$userdata->profile_pic?>" class="rounded-circle" width="150" />
                                        <?php else: ?>
                                            <img src="<?=base_url()?>/public/img/portfolio-8.jpg" class="rounded-circle" width="150" />
                                        <?php endif;?>
                                            <h4 id="card_name" class="card-title mt-10"><?=$userdata->name?></h4>
                                            <p class="card-subtitle"><?=$userdata->position?></p>
                                            <div class="row text-center justify-content-md-center">
                                                <div class="col-4"><a href="javascript:void(0)" class="link"><i class="fas fa-money-bill-alt"></i> <font class="font-medium">254</font></a></div>
                                                <div class="col-4"><a href="javascript:void(0)" class="link"><i class="ik ik-shopping-cart"></i> <font class="font-medium">54</font></a></div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="mb-0"> 
<!--                                    <div class="card-body"> -->
<!--                                        <small class="text-muted d-block">Email address </small>-->
<!--                                        <h6 id="card_email" ><?//=$userdata->email?></h6>-->
<!--                                        <small class="text-muted d-block pt-10">Phone</small>-->
<!--                                        <h6 id="card_mobile"><?//=$userdata->mobile?></h6>-->
<!--                                        <small class="text-muted d-block pt-10">Address</small>-->
<!--                                        <h6 id="address"><?//=$userdata->address?></h6>-->
<!--                                        <small class="text-muted d-block pt-30">Social Profile</small>-->
<!--                                        <br/>-->
<!--                                        <button class="btn btn-icon btn-facebook"><i class="fab fa-facebook-f"></i></button>-->
<!--                                        <button class="btn btn-icon btn-twitter"><i class="fab fa-twitter"></i></button>-->
<!--                                        <button class="btn btn-icon btn-instagram"><i class="fab fa-instagram"></i></button>-->
<!--                                    </div> -->
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-7">
                                <div class="card">
                                    <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
<!--                                        <li class="nav-item">-->
<!--                                            <a class="nav-link " id="pills-timeline-tab" data-toggle="pill" href="#current-month" role="tab" aria-controls="pills-timeline" aria-selected="true">Timeline</a>-->
<!--                                        </li>-->
                                        <li class="nav-item">
                                            <a class="nav-link active" id="pills-profile-tab" data-toggle="pill" href="#last-month" role="tab" aria-controls="pills-profile" aria-selected="false">Profile</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="pills-setting-tab" data-toggle="pill" href="#previous-month" role="tab" aria-controls="pills-setting" aria-selected="false">Setting</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade " id="current-month" role="tabpanel" aria-labelledby="pills-timeline-tab">
                                            <div class="card-body">
                                                <div class="profiletimeline mt-0">
                                                    <div class="sl-item">
                                                        <div class="sl-left"> <img src="<?=base_url()?>/public/img/users/1.jpg" alt="user" class="rounded-circle" /> </div>
                                                        <div class="sl-right">
                                                            <div><a href="javascript:void(0)" class="link">John Doe</a> <span class="sl-date">5 minutes ago</span>
                                                                <p>assign a new task <a href="javascript:void(0)"> Design weblayout</a></p>
                                                                <div class="row">
                                                                    <div class="col-lg-3 col-md-6 mb-20"><img src="<?=base_url()?>/public/img/big/img2.jpg" class="img-fluid rounded" /></div>
                                                                    <div class="col-lg-3 col-md-6 mb-20"><img src="<?=base_url()?>/public/img/big/img3.jpg" class="img-fluid rounded" /></div>
                                                                    <div class="col-lg-3 col-md-6 mb-20"><img src="<?=base_url()?>/public/img/big/img4.jpg" class="img-fluid rounded" /></div>
                                                                    <div class="col-lg-3 col-md-6 mb-20"><img src="<?=base_url()?>/public/img/big/img5.jpg" class="img-fluid rounded" /></div>
                                                                </div>
                                                                <div class="like-comm">
                                                                    <a href="javascript:void(0)" class="link mr-10">2 comment</a>
                                                                    <a href="javascript:void(0)" class="link mr-10"><i class="fa fa-heart text-danger"></i> 5 Love</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="sl-item">
                                                        <div class="sl-left"> <img src="<?=base_url()?>/public/img/users/2.jpg" alt="user" class="rounded-circle" /> </div>
                                                        <div class="sl-right">
                                                            <div> <a href="javascript:void(0)" class="link">John Doe</a> <span class="sl-date">5 minutes ago</span>
                                                                <div class="mt-20 row">
                                                                    <div class="col-md-3 col-xs-12"><img src="<?=base_url()?>/public/img/big/img6.jpg" alt="user" class="img-fluid rounded" /></div>
                                                                    <div class="col-md-9 col-xs-12">
                                                                        <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. </p> <a href="javascript:void(0)" class="btn btn-success"> Design weblayout</a>
                                                                    </div>
                                                                </div>
                                                                <div class="like-comm mt-20">
                                                                    <a href="javascript:void(0)" class="link mr-10">2 comment</a>
                                                                    <a href="javascript:void(0)" class="link mr-10"><i class="fa fa-heart text-danger"></i> 5 Love</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="sl-item">
                                                        <div class="sl-left"> <img src="<?=base_url()?>/public/img/users/3.jpg" alt="user" class="rounded-circle" /> </div>
                                                        <div class="sl-right">
                                                            <div>
                                                                <a href="javascript:void(0)" class="link">John Doe</a> <span class="sl-date">5 minutes ago</span>
                                                                <p class="mt-10"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper </p>
                                                            </div>
                                                            <div class="like-comm mt-20">
                                                                <a href="javascript:void(0)" class="link mr-10">2 comment</a>
                                                                <a href="javascript:void(0)" class="link mr-10"><i class="fa fa-heart text-danger"></i> 5 Love</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="sl-item">
                                                        <div class="sl-left"> <img src="<?=base_url()?>/public/img/users/4.jpg" alt="user" class="rounded-circle" /> </div>
                                                        <div class="sl-right">
                                                            <div><a href="javascript:void(0)" class="link">John Doe</a> <span class="sl-date">5 minutes ago</span>
                                                                <blockquote class="mt-10">
                                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt
                                                                </blockquote>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade show active" id="last-month" role="tabpanel" aria-labelledby="pills-profile-tab">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-3 col-6"> <strong>Full Name</strong>
                                                        <br>
                                                        <p id="card-name" class="text-muted"><?=$userdata->name?></p>
                                                    </div>
                                                    <div class="col-md-3 col-6"> <strong>Mobile</strong>
                                                        <br>
                                                        <p id="card-mobile" class="text-muted">
                                                            <?php
                                                                if (empty($userdata->mobile)){
                                                                    echo "Not Set";
                                                                }else{
                                                                    echo $userdata->mobile;
                                                                }
                                                            ?>
                                                        </p>
                                                    </div>
                                                    <div class="col-md-3 col-6"> <strong>Email</strong>
                                                        <br>
                                                        <p id="card-email" class="text-muted">
                                                            <?php
                                                            if (empty($userdata->email)){
                                                                echo "Not Set";
                                                            }else{
                                                                echo $userdata->email;
                                                            }
                                                            ?>
                                                        </p>
                                                    </div>
                                                    <div class="col-md-3 col-6"> <strong>Address</strong>
                                                        <br>
                                                        <p id="card-address" class="text-muted">
                                                            <?php
                                                            if (empty($userdata->address)){
                                                                echo "Not Set";
                                                            }else{
                                                                echo $userdata->address;
                                                            }
                                                            ?>
                                                        </p>
                                                    </div>
                                                </div>
                                                <hr>

                                                <p class="mt-30">
                                                <div class="col-md-12 col-6"> <strong>About me</strong>
                                                    <p id="card-description">
                                                    <?php
                                                    if (empty($userdata->description)){
                                                        echo "Not Set";
                                                    }else{
                                                        echo $userdata->description;
                                                    }
                                                    ?>
                                                    </p>
                                                </div>

                                                </p>

                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="previous-month" role="tabpanel" aria-labelledby="pills-setting-tab">
                                            <div class="card-body">
                                                <form class="form-horizontal">
                                                    <div class="form-group">
                                                        <label for="example-name">Full Name</label>
                                                        <input type="text" disabled placeholder="Johnathan Doe" class="form-control" value="<?=$userdata->name?>" name="fullname" id="fullname">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email">Email</label>
                                                        <input type="email" disabled placeholder="johnathan@admin.com" class="form-control" value="<?=$userdata->email?>" name="email" id="email">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="mobile">Phone Number</label>
                                                        <input type="text" disabled placeholder="244 856 7890" id="mobile" value="<?=$userdata->mobile?>" name="example-phone" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="description">Description</label>
                                                        <textarea disabled id="description" name="description" rows="5" class="form-control"><?=$userdata->description?></textarea>
                                                    </div>

                                                    <button id="editBtn" class="btn btn-success" type="button">Edit</button>
                                                    <button id="updateBtn" class="btn btn-success" style="display: none" type="button">Update Profile</button>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card table-card">
                                <div class="card-header d-block">
                                    <h3>Sales Made By Me</h3>
                                </div>
                                <div class="card-body">
                                    <div class="col-md-12 table-responsive">
                                        <table id="sales_data_table" class="sales_table nowrap table">
                                            <?php if (is_array($sales)): ?>
                                                <thead>
                                                <tr>
                                                    <th>Date / Time</th>
                                                    <th>Receipt No.</th>
                                                    <th>Sale Rep</th>
                                                    <th>Customer</th>
                                                    <th>Total Amount(GH¢)</th>
                                                    <th class="nosort">&nbsp;</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                <?php foreach($sales as $row): ?>
                                                    <tr id="sale<?=$row["sales_id"]?>">
                                                        <td id=""><?= $row['date_sold'] . " " . $row['time_sold'] ?></td>
                                                        <td><?= $row['receipt_num'] ?></td>
                                                        <td>
                                                            <a loading="true" href="<?= base_url() ?>/users/<?= $row['user_id'] ?>" style="color: #0f38ff"><?= $row['user_name'] ?></a>
                                                        </td>
                                                        <?php if (!empty($row['customer_name'])): ?>
                                                            <td>
                                                                <a loading="true" href="<?= base_url() ?>/customers/<?= $row['customer_id'] ?>" style="color: #0f38ff">
                                                                    <?= ucwords($row['customer_name']) ?>
                                                                </a>
                                                            </td>
                                                        <?php else: ?>
                                                            <td>No Linked Customer</td>
                                                        <?php endif; ?>
                                                        <td><?= $row['total_amount'] ?></td>
                                                        <td>
                                                            <div class="table-actions">
                                                                <a href="<?= base_url(); ?>/store/sales/view/<?= $row['sales_id'] ?>"><i
                                                                            data-toggle="tooltip" data-placement="top"
                                                                            title="View" onclick="loading_overlay(1)"
                                                                            class="ik ik-eye text-blue"></i></a>
                                                                <a href="javascript:sendPrint(<?= $row['sales_id'] ?>)"><i
                                                                            data-toggle="tooltip" data-placement="top"
                                                                            title="Print"
                                                                            class="ik ik-printer text-yellow"></i></a>
                                                                <a href="javascript:delete_sale(<?= $row['sales_id'] ?>)"><i
                                                                            data-toggle="tooltip" data-placement="top"
                                                                            title="Delete"
                                                                            class="ik ik-trash-2 text-red"></i></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                </tbody>
                                            <?php else: ?>
                                                <tbody>
                                                <tr>
                                                    <td class="text-center" ><h3>No Sales Records</h3></td>
                                                </tr>
                                                </tbody>
                                            <?php endif;?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        </div>

            <?= $this->include("widgets/right-sidebar"); ?>
            <?= $this->include("widgets/chatpanel"); ?>
            <?= $this->include("widgets/footer"); ?>
                </div>
            

        <?= $this->include("widgets/user_menu"); ?>

    <script src="<?=base_url(); ?>/public/src/js/vendor/jquery-3.3.1.min.js"></script>
    <script src="<?=base_url(); ?>/public/plugins/popper.js/dist/umd/popper.min.js"></script>
    <script src="<?=base_url(); ?>/public/plugins/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?=base_url(); ?>/public/plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js"></script>
    <script src="<?=base_url(); ?>/public/plugins/screenfull/dist/screenfull.js"></script>
    <script src="<?=base_url(); ?>/public/dist/js/theme.min.js"></script>
    <script src="<?= base_url(); ?>/public/plugins/sweetalerts2/dist/sweetalert2.js"></script>
    <script src="<?= base_url(); ?>/public/plugins/jquery.repeater/jquery.repeater.min.js"></script>
    <script src="<?=base_url(); ?>/public/plugins/jquery-toast-plugin/dist/jquery.toast.min.js"></script>

    <script src="<?=base_url(); ?>/public/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?=base_url(); ?>/public/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?=base_url(); ?>/public/js/datatables.js"></script>
    <script src="<?=base_url(); ?>/public/plugins/datatables/js/dataTables.buttons.min.js"></script>
    <script src="<?=base_url(); ?>/public/plugins/datatables/js/buttons.flash.min.js"></script>
    <script src="<?=base_url(); ?>/public/plugins/datatables/js/jszip.min.js"></script>
    <script src="<?=base_url(); ?>/public/plugins/datatables/js/pdfmake.min.js"></script>
    <script src="<?=base_url(); ?>/public/plugins/datatables/js/vfs_fonts.js"></script>
    <script src="<?=base_url(); ?>/public/plugins/datatables/js/buttons.html5.min.js"></script>
    <script src="<?=base_url(); ?>/public/plugins/datatables/js/dataTables.responsive.min.js"></script>
    <script src="<?=base_url(); ?>/public/plugins/datatables/js/responsive.bootstrap.js"></script>
    <script src="<?=base_url(); ?>/public/plugins/datatables/js/responsive.dataTables.js"></script>
    <script src="<?=base_url(); ?>/public/js/print.js"></script>
    <link rel="stylesheet" href="<?=base_url(); ?>/public/plugins/datatables/css/buttons.dataTables.min.css">

    <script src="<?=base_url(); ?>/public/js/profile.js"></script>
    <script>
        let table =  $('.sales_table').DataTable({
            responsive: true,
            dom: 'Bflrtip',
            buttons: [
                // 'copy', 'csv', 'excel', 'pdf',
                {
                    extend: 'copyHtml5',
                    text:'<i class="fa fa-files-o"></i>Copy',
                    titleAttr: 'Copy',
                    className: 'btn btn-secondary',
                    attr: {
                        id: 'copy_btn'
                    }
                }, {
                    extend: 'excelHtml5',
                    text: '<i class="fa fa-file-excel-o"></i>Excel',
                    titleAttr: 'Excel',
                    className: 'btn btn-success',
                    attr: {
                        id: 'xcel_btn'
                    }
                }, {
                    extend: 'csvHtml5',
                    text: '<i class="fa fa-file-text-o"></i>CSV',
                    titleAttr: 'CSV',
                    className: 'btn btn-info',
                    attr: {
                        id: 'csv_btn'
                    }
                }, {
                    extend: 'pdfHtml5',
                    text: '<i class="fa fa-file-pdf-o"></i>PDF',
                    titleAttr: 'PDF',
                    className: 'btn btn-primary',
                    attr: {
                        id: 'pdf_btn'
                    }
                }, {
                    extend: 'print',
                    text: '<i class="ik ik-printer"></i>Print',
                    titleAttr: 'Print',
                    className: 'btn btn-dark',
                    attr: {
                        id: 'print_btn'
                    },
                    repeatingHead: {
                        <?php if (isset($store_data->logo)):?>
                        logo: '<?=$store_data->logo?>',
                        <?php else:?>
                        logo: '<?=base_url()?>/public/favicon.ico',
                        <?php endif;?>
                        logoPosition: 'right',
                        logoStyle: '',
                        title: '<h3><?=$store_data->store_name?></h3>'
                    },
                },
            ],

            'aoColumnDefs': [{
                'bSortable': false,
                'aTargets': ['nosort'],

            }]

        });
        $(document).ready(function(){

            $("#copy_btn").removeClass("dt-button buttons-copy buttons-html5");
            $("#xcel_btn").removeClass("dt-button buttons-excel buttons-html5");
            $("#csv_btn").removeClass("dt-button buttons-excel buttons-html5");
            $("#pdf_btn").removeClass("dt-button buttons-excel buttons-html5");
            $("#print_btn").removeClass("dt-button buttons-excel buttons-html5");

        });

        /**
         *
         * @param {string | int | any} id
         */
        function edit(id){
            let domain = $("#domain").prop("href");

            //  Shows Pop Up to confirm edit event
            Swal.fire({
                title: 'Are you sure you want to edit this product?',
                imageUrl: img,
                imageHeight: 100,
                text: name,
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: `Yes`,
                denyButtonText: `No`,
            }).then((result) => {
                //  when confirm button (yes) is clicked
                if (result.isConfirmed) {
                    // shows a loading screen overlay
                    loading_overlay(1)
                    // redirects to the edit page
                    window.location.assign(domain + "/store/sales/edit/"+id)
                } else if (result.isDenied) { // when the denied button (no) is clicked
                    // Denial message pop up
                    Swal.fire('Edit Discarded', '', 'info');
                }
            });
        }

        function sendPrint(id){
            let domain = $("#domain").prop("href");

            //  Shows Pop Up to confirm edit event
            Swal.fire({
                title: 'Are you sure you want to print this receipt?',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: `Yes`,
                denyButtonText: `No`,
            }).then((result) => {
                //  when confirm button (yes) is clicked
                if (result.isConfirmed) {
                    // shows a loading screen overlay
                    loading_overlay(1)
                    // redirects to the edit page
                    window.location.assign(domain + "/store/print/receipt/"+id)
                } else if (result.isDenied) { // when the denied button (no) is clicked
                    // Denial message pop up
                    Swal.fire('Print Discarded', '', 'info');
                }
            });
        }

        /**
         * sends a post request to delete a product for the list
         * @param {string | int | any} id the id of the product to be deleted
         */
        function delete_sale(id) {
            let domain = $("#domain").prop("href");
            url = (domain + "/store/sales/delete/" + id);

            //  Shows Pop Up to confirm edit event
            Swal.fire({
                title: 'Are you sure you want to delete this sales record?',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: `Yes`,
                denyButtonText: `No`,
            }).then((result) => {
                //  when confirm button (yes) is clicked
                if (result.isConfirmed) {
                    // post request to delete product
                    $.post( url, function( data ) {
                        data = JSON.parse(data);
                        if (data.msg === "success"){

                            let table = $("#sales_data_table");
                            let data_table = table.dataTable();
                            let index = findRecordRow(table, id);
                            data_table.fnDeleteRow(index);

                            $.toast({
                                text: "Record has been successfully deleted",
                                showHideTransition: 'fade',
                                icon: 'success',
                                position: "top-right",
                                bgColor: '#2dce89',
                                textColor: 'white'
                            });

                        }else{
                            $.toast({
                                text: "Record could not be deleted",
                                showHideTransition: 'fade',
                                icon: 'success',
                                position: "top-right",
                                bgColor: '#f5365c',
                                textColor: 'white'
                            });
                        }
                    })

                } else if (result.isDenied) { // when the denied button (no) is clicked
                    // Denial message pop up
                    Swal.fire('Deletion Discarded', '', 'info')
                }
            });
        }

        /**
         *
         * @param element {object | any} the element
         * @param id the id of the product to be deleted
         * @returns {number} returns the index of the row of the product to be deleted
         */
        function findRecordRow(element, id){
            table = element.dataTable();
            table = table.fnGetData();
            let index;
            for (i = 0; i < table.length; i++) {
                console.log(table[i].DT_RowId)
                if (table[i].DT_RowId === "sale" + id) {
                    index = i;
                    break;
                }
            }
            return index;
        }

    </script>
    </body>
</html>
<?= $this->endSection(); ?>