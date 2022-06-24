<?= $this->extend("layouts/base"); ?>
<!-- NOTE This keeps this page in the "content" placeholder in the layouts/base.php file  -->
<?= $this->section("content"); ?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Customers | Our Pos</title>
    <meta property="og:image" content="<?= base_url(); ?>/public/src/img/brand-white.png" />
    <meta name="description" content="View and manage all the customers in your store">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="<?= base_url() ?>/public/favicon.ico" type="image/x-icon"/>

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

    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800" rel="stylesheet">

    <link rel="stylesheet" href="<?= base_url() ?>/public/plugins/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/public/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/public/plugins/ionicons/dist/css/ionicons.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/public/plugins/icon-kit/dist/css/iconkit.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/public/plugins/perfect-scrollbar/css/perfect-scrollbar.css">
    <link rel="stylesheet" href="<?= base_url() ?>/public/dist/css/theme.min.css">
    <link rel="stylesheet" href="<?=base_url(); ?>/public/plugins/datatables/css/responsive.bootstrap.css">
    <link rel="stylesheet" href="<?=base_url(); ?>/public/plugins/datatables/css/responsive.dataTables.css">
    <link rel="stylesheet" href="<?=base_url(); ?>/public/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?=base_url(); ?>/public/plugins/datatables/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="<?=base_url(); ?>/public/plugins/datatables/css/select.dataTables.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/public/plugins/jquery-toast-plugin/dist/jquery.toast.min.css">
    <script src="<?= base_url() ?>/public/src/js/vendor/modernizr-2.8.3.min.js"></script>
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
                                    <h5>Customers</h5>
                                    <span>View Customers Info and Insights</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <nav class="breadcrumb-container" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a id="domain" href="<?= base_url() ?>"><i class="ik ik-home"></i></a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="#">Customers</a>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="col-md-12 table-responsive">
                            <table class="nowrap customer_table table-hover mb-0 table ">
                                <thead>
                                <tr>
                                    <th>Customer</th>
                                    <th>Phone Number</th>
                                    <th>Email Address</th>
                                    <th>D.O.B</th>
                                    <th>Gender</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if (is_array($customers)):
                                    foreach ($customers as $row):  ?>
                                <tr>
                                    <td>
                                        <div class="d-inline-block align-middle">
                                            <?php if ($row['image'] == ""):?>
                                                <img src="<?=base_url()?>/public/img/uploads/customers/default_customer_avatar.gif" alt="user image" class="rounded-circle img-50 align-top mr-15">
                                            <?php else:?>
                                                <img src="<?=$row['image']?>" alt="user image" class="rounded-circle img-50 align-top mr-15">
                                            <?php endif;?>
                                            <div class="d-inline-block">
                                                <h6><?=$row['customer_name']?></h6>
<!--                                                <p class="text-muted mb-0">Sales executive , NY</p>-->
                                            </div>
                                        </div>
                                    </td>
                                    <td><?=str_replace(",","<br>",$row['mobile'])?></td>
                                    <td><?=$row['email']?></td>
                                    <td><?=$row['dob']?></td>
                                    <td>
                                        <?=$row['gender']?>
                                    </td>
                                    <td>
                                        <a href="#!">
                                            <i class="ik ik-edit f-16 mr-15 text-green"></i>
                                        </a>
                                        <a href="#!">
                                            <i class="ik ik-trash-2 f-16 text-red"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php
                                    endforeach;
                                    else:
                                ?>
                                    <tr>
                                        No Customer Data
                                    </tr>
                                <?php endif;?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
<!--================================================-->
            </div>
        </div>

            <?= $this->include("widgets/right-sidebar"); ?>
            <?= $this->include("widgets/chatpanel"); ?>
            <?= $this->include("widgets/footer"); ?>
        </div>
    </div>


    <?= $this->include("widgets/user_menu"); ?>

    <script src="<?= base_url(); ?>/public/src/js/vendor/jquery-3.3.1.min.js"></script>
    <script src="<?= base_url(); ?>/public/plugins/popper.js/dist/umd/popper.min.js"></script>
    <script src="<?= base_url(); ?>/public/plugins/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>/public/plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js"></script>
    <script src="<?= base_url(); ?>/public/plugins/screenfull/dist/screenfull.js"></script>
    <script src="<?= base_url(); ?>/public/plugins/jquery.repeater/jquery.repeater.min.js"></script>
    <script src="<?= base_url(); ?>/public/dist/js/theme.min.js"></script>
    <script src="<?= base_url(); ?>/public/js/profile.js"></script>
    <script src="<?= base_url(); ?>/public/plugins/jquery-toast-plugin/dist/jquery.toast.min.js"></script>

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
    <script src="<?=base_url(); ?>/public/plugins/datatables/js/dataTables.select.min.js"></script>
    <script src="<?=base_url(); ?>/public/js/print.js"></script>
    <link rel="stylesheet" href="<?=base_url(); ?>/public/plugins/datatables/css/buttons.dataTables.min.css">

<script>
    let table =  $('.customer_table').DataTable({
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
        }], select: {
            style:  'os',
        },
        // order: [[ 1, 'asc' ]]

    });
    $(document).ready(function(){

        $("#copy_btn").removeClass("dt-button buttons-copy buttons-html5");
        $("#xcel_btn").removeClass("dt-button buttons-excel buttons-html5");
        $("#csv_btn").removeClass("dt-button buttons-excel buttons-html5");
        $("#pdf_btn").removeClass("dt-button buttons-excel buttons-html5");
        $("#print_btn").removeClass("dt-button buttons-excel buttons-html5");

    });

    $(document).on("keydown", function (e) {
        if (e.which === 46){
            console.log("You have pressed the delete key")
        }
    });

</script>
</body>
</html>
<?= $this->endSection(); ?>