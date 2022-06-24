<?= $this->extend("layouts/base"); ?>
<!-- NOTE This keeps this page in the "content" placeholder in the layouts/base.php file  -->
<?= $this->section("content"); ?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Edit Product | Our Pos</title>
    <meta property="og:image" content="<?= base_url(); ?>/public/src/img/brand-white.png" />
    <meta name="description" content="Edit this product to update it's content on the database">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="<?=base_url(); ?>/public/favicon.ico" type="image/x-icon" />

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
    <link rel="stylesheet" href="<?=base_url(); ?>/public/plugins/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=base_url(); ?>/public/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?=base_url(); ?>/public/plugins/ionicons/dist/css/ionicons.min.css">
    <link rel="stylesheet" href="<?=base_url(); ?>/public/plugins/icon-kit/dist/css/iconkit.min.css">
    <link rel="stylesheet" href="<?=base_url(); ?>/public/plugins/perfect-scrollbar/css/perfect-scrollbar.css">
    <link rel="stylesheet" href="<?=base_url(); ?>/public/plugins/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="<?=base_url(); ?>/public/plugins/mohithg-switchery/dist/switchery.min.css">
    <link rel="stylesheet" href="<?=base_url(); ?>/public/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
    <link rel="stylesheet" href="<?=base_url(); ?>/public/plugins/sweetalerts2/dist/sweetalert2.css">
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
                                    <h5>Edit Product</h5>
                                    <span>Edit Product Details</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <nav class="breadcrumb-container" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a loading="true" href="<?= base_url(); ?>"><i class="ik ik-home"></i></a>
                                    </li>
                                    <li class="breadcrumb-item"><a loading="true" href="<?= base_url(); ?>/products">Products</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Edit Product</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header"><h3>Product Details</h3></div>
                            <div class="card-body">
                                <?=form_open_multipart(base_url()."/products/edit/".$product[0]['product_id'],
                                ['id'=>"item-form", 'class'=>"forms-sample", 'method'=>'post'])?>
                                <div class="form-group">
                                    <label for="productname">Name</label>
                                    <input type="text" class="form-control" required id="productname" name="productname" value="<?=$product[0]['product_name']?>" placeholder="eg. Coke - 300ml">
                                </div>
                                <div class="form-group">
                                    <label for="specs">Specification</label>
                                    <textarea class="form-control" id="specs" name="description" placeholder="zero sugar, 300ml, "><?=$product[0]['description']?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="sellingprice">Selling Price</label>
                                    <input type="number" step="0.01" class="form-control" required  id="sellingprice" name="sellingprice" value="<?=$product[0]['selling_price']?>" placeholder="Selling Price">
                                </div>
                                <div class="form-group">
                                    <label for="costprice">Cost Price</label>
                                    <input type="number" step="0.01" class="form-control" required id="costprice" value="<?=$product[0]['cost_price']?>" name="costprice" placeholder="Cost Price">
                                </div>
                                <div class="form-group">
                                    <label for="category">Category</label>
                                        <?php if(is_array($categories)): ?>
                                            <select id="category" name="category" class="form-control select2">
                                                <option value="">select category</option>
                                                <?php foreach ($categories as $row):?>
                                                    <option
                                                        <?php
                                                        if ($product[0]['cat_id'].$product[0]['cat_name'] == $row['cat_id'].$row['cat_name']) {
                                                            echo "selected";
                                                        }
                                                        ?> value="<?=$row['cat_id'].":".$row['cat_name']?>"><?=$row['cat_name']?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        <?php else: ?>
                                            <select id="category" name="category" class="form-control select2">
                                            </select>
                                        <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" name="img" id="imgupload" accept=".png, .jpg, jpeg, .gif, .webp, .bmp" class="file-upload-default">
                                    <div class="input-group col-xs-12">
                                        <input type="text" class="form-control file-upload-info" disabled id="imagename" value="<?=$product[0]['image']?>" placeholder="Upload Image">
                                        <span class="input-group-append">
                                            <button class="file-upload-browse btn btn-primary" id="upbtn" type="button">Select</button>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="quantity">Quantity</label>
                                    <input type="number" step="0.01" class="form-control" value="<?=$product[0]['quantity']?>" id="quantity" name="quantity" >
                                </div>
                                <div class="form-group">
                                    <label for="refill">Refill Alert Level</label>
                                    <input type="number" step="0.01" class="form-control" value="<?=$product[0]['refill']?>" id="refill" name="refill">
                                </div>
                                <div class="form-group">
                                    <label for="product_status">Product Status</label>
                                    <input type="checkbox" id="product_status" class="form control js-success"
                                        <?php if ($product[0]["status"] == "active"): ?>
                                            checked
                                        <?php endif;?>
                                    />
                                    <span>
                                        <input hidden type="text" id="status_txt" name="product_status" class="form-control" readonly value="active">
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="barcode_no">Barcode</label>
                                    <input type="text" class="form-control" id="barcode_no" name="barcode_no" value="<?=$product[0]['barcode']?>" placeholder="eg. 8404613064946">
                                </div>
                                <button type="button" id="deleteBtn" class="btn btn-danger mr-2">Delete</button>
                                <button type="button" id="updateBtn" class="btn btn-success mr-2">Update</button>

                                <?=form_close()?>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card" style="min-height: 484px;">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <?php
                                        if($product[0]['image'] == ""):
                                            ?>
                                            <img id="blah" class="img-fluid rounded" src="<?=base_url()?>/public/img/uploads/products/product-default-image.png" alt="">
                                        <?php
                                        else:
                                            ?>
                                            <img id="blah" class="img-fluid rounded" src="<?=$product[0]['image']?>" alt="">
                                        <?php
                                        endif;
                                        ?>
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

<script src="<?=base_url(); ?>/public/plugins/popper.js/dist/umd/popper.min.js"></script>
<script src="<?=base_url(); ?>/public/plugins/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?=base_url(); ?>/public/plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js"></script>
<script src="<?=base_url(); ?>/public/plugins/screenfull/dist/screenfull.js"></script>
<script src="<?=base_url(); ?>/public/dist/js/theme.min.js"></script>
<script src="<?= base_url(); ?>/public/plugins/mohithg-switchery/dist/switchery.min.js"></script>
<script src="<?=base_url(); ?>/public/plugins/select2/dist/js/select2.min.js"></script>
<script src="<?=base_url(); ?>/public/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
<script src="<?=base_url(); ?>/public/plugins/jquery-toast-plugin/dist/jquery.toast.min.js"></script>
<script src="<?=base_url(); ?>/public/plugins/sweetalerts2/dist/sweetalert2.all.js"></script>
<script src="<?=base_url(); ?>/public/js/form-advanced.js"></script>
<script src="<?=base_url(); ?>/public/js/products.js"></script>
<script>
    // reads the url of the image uploaded and target it
    // to preview card
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#blah').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }

    // opens the select image window
    $("#upbtn").on("click",function(){

        $("#imgupload").click();

        $("#imgupload").change(function (e) {
            var x = e.target.files[0].name;
            $("#imagename").val(x);
            readURL(this);
        });
    });

    // Instantiating of select button
    $('#category').select2();

    // Update Button
    $("#updateBtn").on("click", function(){
        //  Shows Pop Up to confirm edit event
        Swal.fire({
            title: 'Update Product Info',
            text: 'Are you sure you want to submit these changes?',
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
                $("#item-form").submit();
            } else if (result.isDenied) { // when the denied button (no) is clicked
                // Denial message pop up
                Swal.fire('Changes not submitted', '', 'info')
            }
        });

    })

    //*** Switchery instantiating ***//
    var elemprimary = document.querySelector('#product_status');
    var switchery = new Switchery(elemprimary, {
        color: '#2ed8b6',
        jackColor: '#fff'
    });

    the_switch = $("#product_status");
    the_status = $("#status_txt");
    the_switch.on("click", function(){
        if (the_switch.prop("checked") === true){
            the_status.val("active")
        }else {
            the_status.val("inactive")
        }
    });

    the_switch_icon = $(".switchery-default").eq(0);
    the_switch_icon.on("click", function(){
        if (the_switch.prop("checked") === true){
            the_status.val("active")
        }else {
            the_status.val("inactive")
        }
    });

    //*** End Switchery instantiating ***//

</script>

</body>

</html>
<?= $this->endSection(); ?>