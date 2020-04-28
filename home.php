<?php
require_once 'Core/init.php';
if (Session::exists('Home')) {
    echo '<p>' . Session::flash('Home') . '</p>';
}
$user = new Auth();
if (!$user->isLoggedIn()) {
    Redirect::to("index.html");
} else {
    
$_dbh = DataBaseHandler::getInstance();
$getName = $_dbh->selectAll('members', array('member_number', '=', $user->data()->member_number));
$firstName = $getName->first()->first_name;
$lastName = $getName->first()->last_name;
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="Custom.css">
    <link rel="stylesheet" href="Bootstrap/fonts/css/all.css">
    <link rel="stylesheet" href="Styles/sidebar.css">

    <style>
    </style>
</head>

<body>
    <?php include 'sidebar.php'; ?>
    <div class="content">
        <?php include 'Header.php'; ?>
        <div class="container-fluid">
            <h1>Hello <a href="#" class="text-success"><?php echo escape($firstName . " " . $lastName); ?></a></h1>
        </div>

        <div class="container-fluid">
            <div class="row mb-3">

                <div class="col-xl-3 col-sm-6 py-2">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="rotate">
                                <i class="fa fa-handshake-o fa-4x"></i>
                            </div>
                            <h1 class="display-4">135</h1>
                            <h6 class="text-uppercase">Borrowed</h6>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6 py-2">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="rotate">
                                <i class="fas fa-users fa-4x"></i>
                            </div>
                            <h1 class="display-4">1058</h1>
                            <h6 class="text-uppercase">MEMBERS</h6>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6 py-2">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="rotate">
                                <i class="fas fa-book fa-4x"></i>
                            </div>
                            <h4 class="display-4">1546</h4>
                            <h6 class="text-uppercase">TOTAL BOOKS</h6>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6 py-2">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="rotate">
                                <i class="fas fa-book fa-4x"></i>
                            </div>
                            <h4 class="display-4">1546</h4>
                            <h6 class="text-uppercase">TOTAL BOOKS</h6>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="Scripts/hide.js"></script>
    <script src="Bootstrap/js/bootstrap.js"></script>
    <script src="Bootstrap/js/jquery.js"></script>
</body>

</html>

<?php
}