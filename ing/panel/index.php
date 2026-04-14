<?php
    include_once 'inc/app.php';
    $error = ($_GET['error'] == 1) ? 'is-invalid' : '';
    if( user_logged_in() ) {
        header("location: data.php");
        exit();
    }
?>

<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    

    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/helpers.css">
    <link rel="stylesheet" href="assets/css/main.css">

    <title>Login</title>
</head>
<body>

    <div class="login mt100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <form method="post" action="inc/users/login.php">
                        <legend class="text-center mb-4">
                            <h3>Welcome Again</h3>
                        </legend>
                        <div class="form-group">
                            <input type="text" name="username" id="username" class="<?php echo $error; ?> form-control form-control-lg" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" id="password" class="<?php echo $error; ?> form-control form-control-lg" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-block btn-primary btn-lg">Enter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>