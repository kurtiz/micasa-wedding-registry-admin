<?= $this->extend("layouts/base"); ?>
    <!-- NOTE This keeps this page in the "content" placeholder in the layouts/base.php file  -->
<?= $this->section("content"); ?>
    <!doctype html>
    <html class="no-js" lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Edit Role | Our Pos</title>
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
                                    <i class="ik ik-link bg-blue"></i>
                                    <div class="d-inline">
                                        <h5>Edit User Role</h5>
                                        <span>Edit user roles in your shop</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <nav class="breadcrumb-container" aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="<?= base_url(); ?>"><i class="ik ik-home"></i></a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>/roles">Roles</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Edit User Role</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header"><h3>Add User Role</h3></div>
                                <div class="card-body">
                                    <form method="post">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Role Name</label>
                                                    <input type="text" name="role_name" class="form-control" value = "<?=$role[0]['role_name']?>" placeholder="eg. Administrator">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Description</label>
                                                    <textarea type="text" name="description" placeholder="eg. Has access to all privileges" class="form-control"><?=$role[0]['description']?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <button type="button" id="select_all" class="btn btn-success">Select All</button>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <button type="button" id="deselect_all" class="btn btn-warning">Deselect All</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <?php if (is_array($role_permissions)): ?>
                                                <?php for($i=0; $i < count($role_permissions); $i++): ?>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="checkbox-fade fade-in-primary">
                                                                <label>
                                                                    <input class="perms" type="checkbox" id="perm_id_<?=$role_permissions[$i]['perm_id']?>"
                                                                           onClick="setCheckedValue('#perm_id_text_<?=$role_permissions[$i]['perm_id']?>','#perm_id_<?=$role_permissions[$i]['perm_id']?>')"
                                                                           name="" <?=$user_role_permissions[$i]['state'] == "true"? "checked" : "" ?>>

                                                                    <span class="cr">
                                                                        <i class="cr-icon ik ik-check txt-primary"></i>
                                                                        <input hidden type="text" value="<?=$user_role_permissions[$i]['state']?>" class="permsOut"
                                                                               id="perm_id_text_<?=$role_permissions[$i]['perm_id']?>"
                                                                               name="permission[]">
                                                                    </span>
                                                                    <span>
                                                                        <?= $role_permissions[$i]['perm_mod'] ?> : <?= $role_permissions[$i]['perm_desc'] ?>
                                                                    </span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endfor;?>
                                            <?php endif;?>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <button type="submit" id="subm" class="btn btn-primary">
                                                        Submit
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
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
        function setCheckedValue(id_1, id_2){
            $(id_1).val($(id_2).prop("checked"))
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

        // select all button function
        $("#select_all").on("click", function () {
            let boxes = $(".perms")
            let permsOut = $(".permsOut")
            for (let i = 0; i < boxes.length; i++){
                if (permsOut[i].value === null){
                    boxes[i].click()
                }else if (permsOut[i].value === "false"){
                    boxes[i].click()
                }
            }
        })

        // deselect all button function
        $("#deselect_all").on("click", function () {
            let boxes = $(".perms")
            let permsOut = $(".permsOut")
            for (let i = 0; i < boxes.length; i++){
                if (permsOut[i].value === "true"){
                    boxes[i].click()
                }
            }
        })



    </script>
    </body>

    </html>
<?= $this->endSection(); ?>