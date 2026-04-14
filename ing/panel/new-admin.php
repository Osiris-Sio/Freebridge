<?php
    include_once 'inc/app.php';
    $error = ($_GET['error'] == 1) ? 'is-invalid' : '';
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

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="data.php"><b>PANEL</b></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mt-auto">
                <li class="nav-item">
                    <a class="nav-link" href="data.php">Login</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="login mt100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <?php
                    if( $_GET['success'] == 1 ) {
                        ?><div class="alert alert-success" role="alert">Created successfully</div><?php
                    } else if( $_GET['error'] == 1 ) {
                        ?><div class="alert alert-danger" role="alert">Error : Something wrong</div><?php
                    }
                    ?>
                    <form method="post" action="inc/users/new_admin.php">
                        <legend class="text-center mb-4">
                            <h3>Create New Admin</h3>
                        </legend>
                        <div class="form-group">
                            <input type="text" name="username" id="username" class="<?php echo $error; ?> form-control form-control-lg" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" id="password" class="<?php echo $error; ?> form-control form-control-lg" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-block btn-primary btn-lg">Create</button>
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