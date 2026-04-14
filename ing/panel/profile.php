<?php
    include_once 'inc/app.php';
    if( !user_logged_in() ) {
        header("location: index.php");
        exit();
    }
    $db = new MysqliDb ($db_infos['host'], $db_infos['db_user'], $db_infos['db_pass'], $db_infos['database_name']);
    $db->where ("id", $_SESSION['user_id']);
    $user = $db->getOne ("admins");
    if( !$user ) {
        header("location: index.php");
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

    <title>Edit Profile</title>
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
                    <a class="nav-link" href="data.php">Home</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="profile.php">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="inc/users/logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <main id="main" class="mt50">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <?php
                    if( $_GET['success'] == 1 ) {
                        ?><div class="alert alert-success" role="alert">Updated successfully</div><?php
                    } else if( $_GET['error'] == 1 ) {
                        ?><div class="alert alert-danger" role="alert">Error : Something wrong</div><?php
                    }
                    ?>
                    <form method="post" action="inc/users/edit.php?id=<?php echo $user['id']; ?>">
                        <legend class="text-center mb-4">
                            <h3>Edit Profile</h3>
                        </legend>
                        <div class="form-group">
                            <input type="text" name="username" id="username" class="<?php echo $error; ?> form-control form-control-lg" placeholder="Username" value="<?php echo $user['username']; ?>">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" id="password" class="<?php echo $error; ?> form-control form-control-lg" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-block btn-primary btn-lg">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>