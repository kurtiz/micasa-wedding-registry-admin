<?= $this->extend("layouts/base"); ?>
<!-- NOTE This keeps this page in the "content" placeholder in the layouts/base.php file  -->
<?= $this->section("content"); ?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Store Front | Our Pos</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="<?= base_url(); ?>/public/favicon.ico" type="image/x-icon"/>

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
    <link rel="stylesheet" href="<?= base_url(); ?>/public/plugins/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/public/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/public/plugins/ionicons/dist/css/ionicons.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/public/plugins/icon-kit/dist/css/iconkit.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/public/plugins/perfect-scrollbar/css/perfect-scrollbar.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/public/plugins/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/public/plugins/mohithg-switchery/dist/switchery.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/public/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/public/dist/css/theme.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/public/plugins/jquery-toast-plugin/dist/jquery.toast.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/public/plugins/sweetalerts2/dist/sweetalert2.css">
    <script src="<?= base_url(); ?>/public/src/js/vendor/modernizr-2.8.3.min.js"></script>
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
                                <i class="ik ik-inbox credit bg-blue" id="cart_toggle" onclick="toggle_sale_mode()" style="cursor: pointer"></i>
                                <div class="d-inline">
                                    <h5>Store Front</h5>
                                    <span>Make sale from this panel</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <nav class="breadcrumb-container" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="<?= base_url(); ?>"><i class="ik ik-home"></i></a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>/products">Store</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Store Front</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div id="main-card" class="card">
                            <div class="card-header">

                                <div class="col-md-6">
                                    <h3>
                                        <button id="clearCartBtn" class="btn btn-danger">
                                            <i class="ik ik-trash-2"></i>
                                            Clear Cart
                                        </button>
                                    </h3>
                                </div>
                                <div class="col-md-6 text-right">
                                    <label for="js-success">Vat</label>
                                    <input type="checkbox" id="js-success" class="js-success" <?=
                                    ($store_data->vat_status=="on")? "checked":"" ?>/>
                                </div>

                            </div>
                            <div id="sales_card" class="card-body" style="padding: 10px 30px 10px 30px !important">
                                <form action="<?= base_url() ?>/store" method="post" id="item-form" class="form-sample">
                                    <div class="row">
                                        <div class="table-responsive">
                                            <table class="col-md-12" id="cart-table"
                                                   style="border-bottom: 1px solid grey">
                                                <thead>
                                                <tr style="border-bottom: 1px solid grey">
                                                    <th width="30%">Item</th>
                                                    <th>Price</th>
                                                    <th>Quantity</th>
                                                    <th>Amount</th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <br>
                                    <hr>
                                    <div class="row body clearfix">
                                        <table class="col-md-12">
                                            <tbody>
                                            <tr>
                                                <td width="50%"><b>Total -</b></td>
                                                <td style="text-align: right;"><b>GH<small>₵ </small></b><b
                                                            id="tableTotal">0.00</b></td>

                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row">
                                        <div>
                                            <input type="text" id="totalAmount" readonly="readonly" name="total_amount" hidden/>
                                            <input type="text" hidden name="cus_id" readonly="readonly" id="cus_id"/>
                                            <input type="text" hidden name="cus_name" readonly="readonly" id="cus_name"/>
                                            <input type="text" hidden name="vat_percentage" readonly="readonly" value="<?=$store_data->vat?>" id="vat_percentage"/>
                                            <input type="text" hidden name="vat_amount" readonly="readonly" id="vat_amount"/>
                                            <input type="text" hidden name="discount_type" readonly="readonly" id="discount_type"/>
                                            <input type="text" hidden name="discount_amount" readonly="readonly" id="discount_amount"/>
                                            <input type="text" hidden name="promo" readonly="readonly" id="promo"/>
                                            <input type="text" hidden name="sale_type" readonly="readonly" value="direct" id="sale_type"/>
                                        </div>
                                        <table class="col-md-12">
                                            <tr id="disappear">
                                                <td width="10%">Paid <small>₵</small</td>
                                                <td width="">
                                                    <input class="form-control col-md-9"
                                                           onchange="overallSuM('subtotals')" name="paid" value="0" min="0"
                                                                    id="paid" type="number">
                                                </td>
                                                <td width="15%">
                                                    Change <small>₵</small</td>
                                                <td width="">
                                                    <input class="form-control col-md-9" name="change" id="chang" value="0"
                                                                    min="0" readonly="readonly" type="number">
                                                </td>
                                                <td width="">
                                                    <input class="form-control col-md-9" id="chang2" value="0"
                                                                    min="0" hidden readonly="readonly" type="number">
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <br>
                                    <?php if ($store_data->discount=="on"):?>
                                    <div class="col-md-12">
                                        <p>
                                            <button type="button" id="discountBtn" class="btn btn-success col-md-12" data-toggle="modal" data-target="#discountModal">
                                                Discount
                                            </button>
                                        </p>
                                    </div>
                                    <?php endif;?>
                                    <div class="col-md-12">
                                        <p>
                                            <button type="button" id="savem" class="btn btn-warning col-md-12">
                                                Save
                                            </button>
                                        </p>
                                    </div>
                                    <div class="col-md-12">
                                        <p>
                                            <button type="button" id="subm" class="btn btn-primary col-md-12">
                                                Submit
                                            </button>
                                        </p>
                                    </div>

                                </form>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card ">
                            <div class="card-body">
                                <div class="form-group">
                                    <input type="text" name="" id="barcode_no" placeholder="Scan barcode here" class="form-control">
                                </div>
                                <form class="forms-sample">

                                    <div class="row">
                                        <!-- Customers list-->
                                        <div class="form-group col-md-12">
                                            <?php
                                            /**
                                             * @var array $customers
                                             */
                                            if (is_array($customers)): ?>
                                                <select id="customer_select" class="form-control select2">
                                                    <option value="">select customer</option>
                                                    <?php foreach ($customers as $row): ?>
                                                        <option value="<?= $row['customer_id'] ?>,<?= $row['customer_name'] ?>">
                                                            <span><?= $row['customer_name'] ?></span> :
                                                            <span><?= $row['mobile'] ?></span>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            <?php else: ?>
                                                <select id="category" name="category" class="form-control select2">
                                                    <option value="">No Customers</option>
                                                </select>
                                            <?php endif; ?>
                                        </div>
                                        <!-- End Customers List-->


                                        <div class="form-group col-md-12">
                                            <?php
                                            /**
                                             * @var array $products
                                             */
                                            if (is_array($products)): ?>
                                                <select id="product_select" class="form-control select2">
                                                    <option value="">select products</option>
                                                    <?php foreach ($products as $row): ?>
                                                        <?php if ((float)$row['quantity'] > 0 && $row['status'] == "active"): ?>
                                                            <option value="<?= $row['product_id'] ?>,
                                                            <?= $row['barcode'] ?>, <?= $row['quantity'] ?>,
                                                            <?= $row['selling_price'] ?>">
                                                                <span><?= $row['product_name'] ?></span> :
                                                                <span><?= $row['selling_price'] ?></span>
                                                            </option>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </select>
                                            <?php else: ?>
                                                <select id="category" name="category" class="form-control select2">
                                                    <option value="">No Products In Inventory</option>
                                                </select>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </form>
                                <div class="row" style="max-height: 484px; overflow-y: scroll; ">
                                    <?php if (is_array($products)): ?>
                                        <?php foreach ($products as $row): ?>
                                            <?php if ((float)$row['quantity'] > 0 && $row['status'] == "active"): ?>

                                            <div class="col-md-4 it-card">
                                                <?php if (!empty($row['image'])): ?>

                                                    <a class="card-img">
                                                        <img id="img<?= $row['barcode'] ?>" src="<?= $row['image'] ?>" alt=""
                                                             style="height: 119px; width: 119px" class="img-thumbnail" data-toggle="tooltip" data-placement="top"
                                                             title="<?=$row['quantity']?> left">
                                                    </a>
                                                <?php else: ?>
                                                    <a class="card-img">
                                                        <img id="img<?= $row['barcode'] ?>" src="<?=base_url()?>/public/img/uploads/products/product-default-image.png" alt=""
                                                             style="height: 119px; width: 119px" class="img-thumbnail" data-toggle="tooltip" data-placement="top"
                                                             title="<?=$row['quantity']?> left">
                                                    </a>
                                                <?php endif; ?>

                                                <p id="<?= $row['barcode'] ?>" class="text-center">
                                                    <span></span><span><?= $row['product_name'] ?></span><br>
                                                    <span>GH¢</span> <span><?= $row['selling_price'] ?></span><br>
                                                    <a href="#" id="btn<?= $row['barcode'] ?>" hidden
                                                       class="info add_product btn btn-info"><i
                                                                class="ik ik-shopping-cart"></i></a>
                                                    <span id="stk<?= $row['barcode'] ?>"
                                                          hidden><?= $row['quantity'] ?></span>
                                                    <span id="categoryInfo<?=$row['barcode']?>" hidden>
                                                        <?php if (empty($row['cat_name'])):?>
                                                            null,No Category
                                                        <?php else:?>
                                                            <?=$row['cat_id']?>,<?=$row['cat_name'] ?>
                                                        <?php endif;?>
                                                    </span>
                                                    <span hidden id="item_id<?=$row['barcode']?>">
                                                        <?=$row['product_id']?>
                                                    </span>
                                                </p>
                                            </div>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <div class="col-md-12 text-center">
                                            <p>
                                                <h3>No Products In Inventory</h3>
                                            </p>
                                        </div>
                                    <?php endif; ?>
                                    <input hidden id="track_number" type="number" value="1">
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
<div class="modal fade" id="discountModal" tabindex="-1" role="dialog" aria-labelledby="discountModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterLabel">Discount</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
             <div class="modal-body">

                <div id="discountForm">

                    <div class="form-group">
                        <input type="text" id="discount_text" name="discount" class="form-control" placeholder="amount (30.00) / percentage (%) / promo code (DVTY67)">
                    </div>

                    <div class="radio radio-inline">
                        <label>
                            <input type="radio" id="noDiscount" name="radio">
                            No Discount
                        </label>
                    </div>

                    <div class="radio radio-inline">
                        <label>
                            <input type="radio" id="discountAmount" name="radio">
                            Amount
                        </label>
                    </div>

                    <div class="radio radio-inline">
                        <label>
                            <input type="radio" id="discountPercentage" name="radio">
                            Percentage
                        </label>
                    </div>

                    <div class="radio radio-inline">
                        <label>
                            <input type="radio" id="discountPromo" name="radio">
                            Promo/Discount code
                        </label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="applyDiscountBtn">Apply</button>
            </div>
        </div>
    </div>
</div>
<?= $this->include("widgets/user_menu"); ?>
<style>
</style>

<script src="<?= base_url(); ?>/public/src/js/vendor/jquery-3.3.1.min.js"></script>
<script src="<?= base_url(); ?>/public/plugins/popper.js/dist/umd/popper.min.js"></script>
<script src="<?= base_url(); ?>/public/plugins/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?= base_url(); ?>/public/plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js"></script>
<script src="<?= base_url(); ?>/public/plugins/screenfull/dist/screenfull.js"></script>
<script src="<?= base_url(); ?>/public/dist/js/theme.min.js"></script>
<script src="<?= base_url(); ?>/public/plugins/select2/dist/js/select2.min.js"></script>
<script src="<?= base_url(); ?>/public/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
<script src="<?= base_url(); ?>/public/plugins/jquery-toast-plugin/dist/jquery.toast.min.js"></script>
<script src="<?= base_url(); ?>/public/plugins/mohithg-switchery/dist/switchery.min.js"></script>
<script src="<?= base_url(); ?>/public/js/store-cart.js"></script>
<script src="<?= base_url(); ?>/public/plugins/sweetalerts2/dist/sweetalert2.js"></script>
<script>

    $("#item-form").on("submit", function(){
        loading_overlay(1)
    })
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
</script>
</body>

</html>
<?= $this->endSection(); ?>
