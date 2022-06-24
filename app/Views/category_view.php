<?= $this->extend("layouts/base"); ?>
<!-- NOTE This keeps this page in the "content" placeholder in the layouts/base.php file  -->
<?= $this->section("content"); ?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Add Category | Our Pos</title>
    <meta property="og:image" content="<?= base_url(); ?>/public/src/img/brand-white.png" />
    <meta name="description" content="Add new categories to your store">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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

    <link rel="icon" href="<?=base_url(); ?>/public/favicon.ico" type="image/x-icon" />

    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800" rel="stylesheet">
    <link rel="stylesheet" href="<?=base_url(); ?>/public/plugins/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=base_url(); ?>/public/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?=base_url(); ?>/public/plugins/ionicons/dist/css/ionicons.min.css">
    <link rel="stylesheet" href="<?=base_url(); ?>/public/plugins/icon-kit/dist/css/iconkit.min.css">
    <link rel="stylesheet" href="<?=base_url(); ?>/public/plugins/perfect-scrollbar/css/perfect-scrollbar.css">
    <link rel="stylesheet" href="<?=base_url(); ?>/public/plugins/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="<?=base_url(); ?>/public/plugins/mohithg-switchery/dist/switchery.min.css">
    <link rel="stylesheet" href="<?=base_url(); ?>/public/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
    <link rel="stylesheet" href="<?=base_url(); ?>/public/plugins/jquery-minicolors/jquery.minicolors.css">
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
                                <i class="ik ik-inbox bg-blue"></i>
                                <div class="d-inline">
                                    <h5>View Category</h5>
                                    <span>View categories in your inventory</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <nav class="breadcrumb-container" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="<?= base_url(); ?>"><i class="ik ik-home"></i></a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>/products/category">Category</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">View Category</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header"><h3>Category Details</h3></div>
                            <div class="card-body">
                                <?=form_open_multipart("",['id'=>"item-form", 'class'=>"forms-sample"])?>
                                <div class="form-group">
                                    <label for="catname">Name</label>
                                    <input type="text" class="form-control" disabled required id="catname" name="catname" placeholder="eg. Coke - 300ml">
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" disabled id="description" name="description" placeholder="zero sugar, 300ml, "></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="default-value">Color</label>
                                    <input type="text" disabled id="default-value" class="form-control col-sm-12" name="color"  value="#ff6600">
                                </div>

                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" disabled name="img" id="imgupload" class="file-upload-default">
                                    <div class="input-group col-xs-12">
                                        <input type="text" class="form-control disabled file-upload-info" disabled id="imagename" placeholder="Upload Image">
                                        <span class="input-group-append">
                                                        <button class="file-upload-browse btn btn-primary" disabled id="upbtn" type="button">Select</button>
                                                    </span>
                                    </div>
                                </div>
                                <a href="<?=base_url()?>/products/category/edit/1" class="btn btn-primary mr-2">Edit</a>
                                <?=form_close()?>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card" style="min-height: 484px;">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <img id="blah" class="img-fluid rounded" src="<?=base_url()?>/public/img/uploads/products/product-default-image.png" alt="">
                                    </div>
                                </div>
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
</div>

<?= $this->include("widgets/user_menu"); ?>

<script src="<?=base_url(); ?>/public/src/js/vendor/jquery-3.3.1.min.js"></script>
<script>
</script>
<script src="<?=base_url(); ?>/public/plugins/popper.js/dist/umd/popper.min.js"></script>
<script src="<?=base_url(); ?>/public/plugins/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?=base_url(); ?>/public/plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js"></script>
<script src="<?=base_url(); ?>/public/plugins/screenfull/dist/screenfull.js"></script>
<script src="<?=base_url(); ?>/public/dist/js/theme.min.js"></script>
<script src="<?=base_url(); ?>/public/plugins/select2/dist/js/select2.min.js"></script>
<script src="<?=base_url(); ?>/public/plugins/jquery-minicolors/jquery.minicolors.min.js"></script>
<script src="<?=base_url(); ?>/public/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
<script src="<?=base_url(); ?>/public/plugins/jquery-toast-plugin/dist/jquery.toast.min.js"></script>
<script src="<?=base_url(); ?>/public/js/form-advanced.js"></script>
<script src="<?=base_url(); ?>/public/js/form-picker.js"></script>
<script>

    $(document).ready(function() {
        $('#category').select2();
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#blah').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }

    $("#imgupload").change(function() {
        readURL(this);
    });


    $('#default-value').minicolors();

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

    <?php
    if (!empty(session()->getTempdata('success'))):
    ?>
    $.toast({
        text: '<?=session()->getTempdata('success')?>',
        showHideTransition: 'fade',
        icon: 'success',
        position: "top-right",
        bgColor: '#2dce89',
        textColor: 'white'
    })

    <?php
    elseif(!empty(session()->getTempdata('error'))):
    ?>
    $.toast({
        text: '<?=session()->getTempdata('error')?>',
        showHideTransition: 'fade',
        icon: 'error',
        position: "top-right",
        bgColor: '#f5365c',
        textColor: 'white'
    })

    <?php
    endif;
    ?>


    $("#upbtn").click(function(){
        $("#imgupload").click();

        $("#imgupload").change(function (e) {
            var x = e.target.files[0].name;
            $("#imagename").val(x);
        });
    });
</script>
</body>

</html>
<?= $this->endSection(); ?>
