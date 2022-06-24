<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Forgot Password | Our Pos</title>
        <meta property="og:image" content="<?= base_url(); ?>/public/src/img/brand-white.png" />
        <meta name="description" content="Login to your store to unlock the incredible features that awaits you.">
        <meta name="keywords" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="icon" href="<?php base_url(); ?>public/favicon.ico" type="image/x-icon" />

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

        <link rel="stylesheet" href="<?php base_url(); ?>public/plugins/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php base_url(); ?>public/plugins/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="<?php base_url(); ?>public/plugins/ionicons/dist/css/ionicons.min.css">
        <link rel="stylesheet" href="<?php base_url(); ?>public/plugins/icon-kit/dist/css/iconkit.min.css">
        <link rel="stylesheet" href="<?php base_url(); ?>public/dist/css/theme.min.css">
        <link rel="stylesheet" href="<?php base_url(); ?>public/plugins/jquery-toast-plugin/dist/jquery.toast.min.css">
        <script src="<?php base_url(); ?>public/src/js/vendor/modernizr-2.8.3.min.js"></script>
    </head>

    <body>
        <div id="overlay">
            <div class='lds-ripple'>
                <div></div>
                <div></div>
            </div>
        </div>
        <div class="auth-wrapper">
            <div class="container-fluid h-100">
                <div class="row flex-row h-100 bg-white">
                    <div class="col-xl-8 col-lg-6 col-md-5 p-0 d-md-block d-lg-block d-sm-none d-none">
                        <div class="lavalite-bg" id="bgimg" style="background-image: url('<?php base_url(); ?>public/img/auth/image.jpg')">
                            <div class="lavalite-overlay"></div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-7 my-auto p-0">
                        <div class="authentication-form mx-auto">
<!--                            <div class="alert alert-primary" role="alert">-->
<!--                                A simple primary alert—check it out!-->
<!--                            </div>-->
                            <h3>Forgot Password</h3>
                            <p>Enter your username to reset your password!</p>
                            <?= form_open(current_url(), ['id' => 'forgot_password'])?>
                                <div class="form-group">
                                    <input type="text" autofocus id="username" name="username" class="form-control" required placeholder="username" >
                                    <i class="ik ik-user"></i>
                                </div>

                                <div class="row">
                                    <div class="col text-right">
                                        <a href="<?=base_url()?>">Sign In</a>
                                    </div>
                                </div>

                                <div class="sign-btn text-center">
                                    <button class="btn btn-theme" id="sendEmail" type="button">Submit</button>
                                </div>
                            <?= form_close();?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <script src="<?php base_url(); ?>public/src/js/vendor/jquery-3.3.1.min.js"></script>
        <script src="<?php base_url(); ?>public/plugins/popper.js/dist/umd/popper.min.js"></script>
        <script src="<?php base_url(); ?>public/plugins/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="<?php base_url(); ?>public/dist/js/theme.js"></script>
        <script src="<?php base_url(); ?>public/plugins/jquery-toast-plugin/dist/jquery.toast.min.js"></script>
        <script src="<?php base_url(); ?>public/js/jquery.tabbale.js"></script>

    </body>
</html>