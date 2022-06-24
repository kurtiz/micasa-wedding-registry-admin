<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Login | MiCasa cPanel</title>
        <meta property="og:image" content="<?= base_url(); ?>/public/src/img/brand-white.png" />
        <meta name="description" content="Login to your store to unlock the incredible features that awaits you.">
        <meta name="keywords" content="">
<!--        <link rel="manifest" href="--><?//=base_url(); ?><!--/public/manifest.json">-->
        <link rel="apple-touch-icon"href="<?php base_url(); ?>public/favicon.ico" type="image/x-icon" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="theme-color" content="#404E67"/>
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="apple-mobile-web-app-title" content="Hello World">
        <meta name="msapplication-TileImage" content="<?php base_url(); ?>public/favicon.ico">
        <meta name="msapplication-TileColor" content="#FFFFFF">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="icon" href="<?php base_url(); ?>public/favicon.ico" type="image/x-icon" />

        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800" rel="stylesheet">
        
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
                            <h3>Sign In</h3>
                            <p>Happy to see you again!</p>
                            <?= form_open(current_url(), ['id' => 'login_form'])?>
                                <div class="form-group">
                                    <input type="text" autofocus id="username" name="username" class="form-control form-control-lowercase" placeholder="username" >
                                    <i class="ik ik-user"></i>
                                </div>
                                <div class="form-group">
                                    <input type="password" id="password" name="password" class="form-control"
                                           data-toggle="tooltip" data-placement="top"
                                           title="Tap on icon to toggle password visibility" placeholder="password">
                                    <i class="ik ik-lock" id="passLock"></i>
                                </div>
                                <div class="row">
                                    <div class="col text-left">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="item_checkbox" name="item_checkbox" value="option1">
                                            <span hidden class="custom-control-label">&nbsp;Remember Me</span> 
                                        </label>
                                    </div>
                                    <div class="col text-right">
                                        <a href="<?=base_url()?>/forgotpassword">Forgot Password ?</a>
                                    </div>
                                </div>
                                <div class="sign-btn text-center">
                                    <button class="btn btn-theme" id="sign_in" type="button">Sign In</button>
                                </div>
                            <?= form_close();?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="<?php base_url(); ?>/sw.js"></script>
        <script src="<?php base_url(); ?>public/src/js/vendor/jquery-3.3.1.min.js"></script>
        <script src="<?php base_url(); ?>public/plugins/popper.js/dist/umd/popper.min.js"></script>
        <script src="<?php base_url(); ?>public/plugins/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="<?php base_url(); ?>public/dist/js/theme.min.js"></script>
        <script src="<?php base_url(); ?>public/plugins/jquery-toast-plugin/dist/jquery.toast.min.js"></script>
        <script src="<?php base_url(); ?>public/js/jquery.tabbale.js"></script>
        <script>

            let username = $("#username")
            let password = $("#password")
            // NOTE trying to validate provided credentials before sending the post request
            // SECTION [username_validate] validates username 
            username.keypress(function(event) {
                
                // ANCHOR CHECKS IF THE KEYSTROKE PRESSED IS THE "enter" KEY
                if (event.keyCode === 13) { 
                    

                    if (username.val() === ""){
                        
                        $.toast({
                            heading: 'Error',
                            text: 'You must enter username!',
                            showHideTransition: 'fade',
                            icon: 'error',
                            color: '#f5365c',
                            position: "top-right"
                        })

                    }else{

                        jQuery.tabNext();
                    
                    }
                } 
            });
            // !SECTION

            // SECTION [password_validate] validates password 
            password.keypress(function (event){
                
                // ANCHOR CHECKS IF THE KEYSTROKE PRESSED IS THE "enter" KEY
                if (event.keyCode === 13) { 


                    if (password.val() === ""){
                        
                        $.toast({
                            heading: 'Error',
                            text: 'You must enter password!',
                            showHideTransition: 'fade',
                            icon: 'error',
                            color: '#f5365c',
                            position: "top-right"
                        })

                    }else{
                        loading_overlay(1)
                        $("#login_form").submit()
                    }   
                } 
            });
            // !SECTION
            
            // SECTION [sign_in_validate] validates both password and username
            $("#sign_in").on("click", function (event){


                    if (username.val() === ""){
                        
                        $.toast({
                            heading: 'Error',
                            text: 'You must enter username!',
                            showHideTransition: 'fade',
                            icon: 'error',
                            color: '#f5365c',
                            position: "top-right"
                        })
                    }else {
                         
                        if (password.val() === ""){
                        
                        $.toast({
                            heading: 'Error',
                            text: 'You must enter password!',
                            showHideTransition: 'fade',
                            icon: 'error',
                            color: '#f5365c',
                            position: "top-right"
                        });

                    }else{
                        loading_overlay(1)
                        $("#login_form").submit();
                    }
                }
            });
            // !SECTION

            $("#passLock").on("click", function(){
                if (password.prop("type") === "password"){
                    password.prop("type", "text")
                } else if (password.prop("type") === "text"){
                    password.prop("type", "password")
                }
            })

            <?php 
                if (!empty(session()->getTempdata('error'))): 
            ?>
                $.toast({
                    heading: 'Error',
                    text: "<?=session()->getTempdata('error')?>",
                    showHideTransition: 'fade',
                    icon: 'error',
                    colo: '#f5365c',
                    position: "top-right",
                    hideAfter: 5000,
                })
            <?php
                endif;
            ?>
            
            // TODO HAVE TO UNCOMMENT THIS SECTION BELOW BEFORE PRODUCTION
            // NOTE clears the console
            // setTimeout(function (){
            //     console.clear()
            // }, 300)
        </script>
        
        
        
    </body>
</html>