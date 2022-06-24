<?= $this->extend("layouts/base"); ?>
    <!-- NOTE This keeps this page in the "content" placeholder in the layouts/base.php file  -->
<?= $this->section("content"); ?>
    <!doctype html>
    <html class="no-js" lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Settings | Our Pos</title>
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
        <link rel="stylesheet"
              href="<?= base_url(); ?>/public/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
        <link rel="stylesheet" href="<?= base_url(); ?>/public/dist/css/theme.min.css">
        <link rel="stylesheet" href="<?= base_url(); ?>/public/plugins/jquery-toast-plugin/dist/jquery.toast.min.css">
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
                                    <i class="ik ik-inbox bg-blue"></i>
                                    <div class="d-inline">
                                        <h5>Settings</h5>
                                        <span>Configure settings of your store</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <nav class="breadcrumb-container" aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a loading="true" href="<?= base_url(); ?>"><i class="ik ik-home"></i></a>
                                        </li>
                                        <li class="breadcrumb-item active">Settings</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header"><h3>Settings</h3></div>
                                <div class="card-body">
                                    <form method="post" id="settings-form">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Store Name</label>
                                                    <input disabled type="text" data-toggle="tooltip" data-placement="top"
                                                           title="Name of the store" class="form-control"
                                                           placeholder="Omega Super Market" id="store_name"
                                                           name="storeName"
                                                           value="<?= $storedata->store_name ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Address</label>
                                                    <textarea data-toggle="tooltip" data-placement="top"
                                                              title="Address or the location of the store"
                                                              class="form-control" disabled name="storeAddress"
                                                              placeholder=""><?= $storedata->address ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Phone</label>
                                                    <input data-toggle="tooltip" data-placement="top" id="store_mobile"
                                                           title="Phone contact number for the store" disabled type="text"
                                                           class="form-control" placeholder="024 587 1456" name="storeMobile"
                                                           value="<?= $storedata->mobile ?>">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Fax</label>
                                                    <input disabled type="text" data-toggle="tooltip" data-placement="top"
                                                           title="Fax number for the store" class="form-control" name="storeFax"
                                                           placeholder="" value="<?= $storedata->fax ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input disabled type="text" data-toggle="tooltip" data-placement="top"
                                                           title="Email contact of the store" class="form-control"
                                                           id="store_email" name="storeEmail"
                                                           placeholder="" value="<?= $storedata->email ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Receipt Prefix</label>
                                                    <input disabled type="text" data-toggle="tooltip" data-placement="top"
                                                           title="This is the phrase or keyword added to the receipt number to uniquely identify you shop's receipt numbers"
                                                           class="form-control form-control-uppercase" placeholder="RCP" id="rc_prefix" name="storePrefix"
                                                           value="<?= $storedata->receipt_prefix ?>">
                                                </div>

                                            </div>

                                            <div class="col-md-6 <?=($storedata->vat_status == "on")? "" : "hidden" ?>" id="vat_percentage" >
                                                <div class="form-group">
                                                    <label>Vat %</label>
                                                    <input disabled type="number" data-toggle="tooltip" data-placement="top"
                                                           title="VAT percentage applied to the sales"
                                                           class="form-control" placeholder="10" name="storeVatPercentage"
                                                           value="<?= $storedata->vat ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">

                                            <div class="col-md-3">
                                                <div data-toggle="tooltip" data-placement="top"
                                                     title="Toggle to enable Discounts when making sales"
                                                     class="form-group">
                                                    <label for="js-success">Discount</label>
                                                    <input type="checkbox" id="discount" class="js-success" name="storeDiscount"
                                                        <?= $storedata->discount == "on" ? "checked" : "" ?>/>
                                                </div>
                                            </div>


                                            <div class="col-md-3">
                                                <div data-toggle="tooltip" data-placement="top"
                                                     title="Toggle to enable search with barcode scanner when making sales"
                                                     class="form-group">
                                                    <label for="js-success">Barcode Search</label>
                                                    <input type="checkbox" id="bc_search" class="js-success" name="storeBarcode"
                                                        <?= $storedata->barcode == "on" ? "checked" : "" ?>/>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div data-toggle="tooltip" data-placement="top"
                                                     title="Toggle to enable VAT when making sales"
                                                     class="form-group">
                                                    <label for="js-success">Vat</label>
                                                    <input type="checkbox" id="vat" name="storeVat"
                                                           class="js-success" <?= $storedata->vat_status == "on" ? "checked" : "" ?>/>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div data-toggle="tooltip" data-placement="top"
                                                     title="Toggle to enable sales counts printed on receipts"
                                                     class="form-group">
                                                    <label for="js-success">Sales Count</label>
                                                    <input type="checkbox" id="salesCount" name="storeSalesCount"
                                                           class="js-success" <?= $storedata->salesCount == "on" ? "checked" : "" ?>/>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="col-md-3">
                                                <div data-toggle="tooltip" data-placement="top"
                                                     title="Toggle to enable Logo to show on receipt"
                                                     class="form-group">
                                                    <label for="js-success">Logo On Receipt</label>
                                                    <input type="checkbox" id="logoDisplay" class="js-success" name="storeLogoDisplay"
                                                        <?= $storedata->logoDisplay == "on" ? "checked" : "" ?>/>

                                        </div>
                                    </form>

                                    <button id="editBtn" type="button" class="btn btn-success">Edit</button>
                                    <button id="submitBtn" type="button" style="display: none" class="btn btn-success">Submit</button>

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
    <script>
        let form = $("#settings-form")
        form.on("submit", function (){
            loading_overlay(1)
        })

        //instantiating plugins {switchery: for the switch button}
        $(document).ready(function () {
            //*** switchery instantiating ***//
            let x = Array("#vat", "#discount", "#bc_search", "#salesCount", "#logoDisplay");
            for (let i = 0; i < x.length; i++) {
                var elemprimary = document.querySelector(x[i]);
                var switchery = new Switchery(elemprimary, {
                    color: '#2ed8b6',
                    jackColor: '#fff'
                });
            }
            //*** End switchery instantiating ***//
        });

        $('#vat').on("change", function () {
                //checking the value of the switch button
                if ($(this).prop("checked") === false) {
                    $("#vat_percentage").slideUp(
                        function () {
                            $("#vat_percentage").hide()
                        }
                    )

                }else if($(this).prop("checked") === true){
                    // $("#vat_percentage").show()
                    let classes = $("#vat_percentage").prop("class")
                    $("#vat_percentage").prop("class", classes.replace("hidden", ""))
                    $("#vat_percentage").slideDown()
                }
            }
        )


        let editBtn = $("#editBtn")
        let inputText = $("#settings-form input")
        let inputTextArea = $("#settings-form textarea")
        let submitBtn = $("#submitBtn")
        let storeName = $("#store_name")
        let storeMobile = $("#store_mobile")
        let storeEmail = $("#store_email")
        let storeVat = $("#rc_prefix")

        editBtn.on("click", function(){
            if (editBtn.text() === "Edit") {
                editBtn.removeClass("btn-success");
                editBtn.addClass("btn-danger");
                editBtn.text("Cancel");
                submitBtn.show();

                inputText.prop("disabled", false)
                inputTextArea.prop("disabled", false)
            }else {
                editBtn.removeClass("btn-danger");
                editBtn.addClass("btn-success");
                editBtn.text("Edit");
                submitBtn.hide();

                inputText.prop("disabled", true)
                inputTextArea.prop("disabled", true)
            }

        })

        submitBtn.on("click", function() {
            if (storeName.val() === "") {
                $.toast({
                    text: 'Store name must not be empty!',
                    showHideTransition: 'fade',
                    icon: 'error',
                    position: "top-right",
                    bgColor: '#f5365c',
                    textColor: 'white'
                })

                if(storeName.hasClass("form-control-success")){
                    storeName.removeClass("form-control-success")
                    storeName.addClass("form-control-danger")
                }

                storeName.addClass("form-control-danger")
                storeName.focus()

            } else if(storeName.hasClass('form-control-danger')) {

                storeName.removeClass("form-control-danger")
                storeName.addClass("form-control-success")

            }

            if (storeMobile.val() === ""){
                $.toast({
                    text: 'Phone must not be empty!',
                    showHideTransition: 'fade',
                    icon: 'error',
                    position: "top-right",
                    bgColor: '#f5365c',
                    textColor: 'white'
                })

                if(storeMobile.hasClass("form-control-success")){
                    storeMobile.removeClass("form-control-success")
                    storeMobile.addClass("form-control-danger")
                }

                storeMobile.addClass("form-control-danger")

                if (!storeName.hasClass('form-control-danger')) {
                    storeMobile.focus()
                }
            } else if(storeMobile.hasClass('form-control-danger')) {

                storeMobile.removeClass("form-control-danger")
                storeMobile.addClass("form-control-success")

            }

            if (storeEmail.val() === ""){
                $.toast({
                    text: 'Email must not be empty!',
                    showHideTransition: 'fade',
                    icon: 'error',
                    position: "top-right",
                    bgColor: '#f5365c',
                    textColor: 'white'
                })

                if(storeEmail.hasClass("form-control-success")){
                    storeEmail.removeClass("form-control-success")
                    storeEmail.addClass("form-control-danger")
                }

                storeEmail.addClass("form-control-danger")

                if(!storeMobile.hasClass('form-control-danger')){
                    storeEmail.focus()
                }

            } else if(storeEmail.hasClass('form-control-danger')) {

                storeEmail.removeClass("form-control-danger")
                storeEmail.addClass("form-control-success")

            }

            if(storeName !== "" && storeMobile !== "" && storeEmail !== ""){
                loading_overlay(1)
                form.submit()
            }

        })

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