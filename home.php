<?php
require_once 'Core/init.php';
$user = new Auth();
if (!$user->isLoggedIn()) {
    Redirect::to("index.html");
} else {

    $_dbh = DataBaseHandler::getInstance();
    $getName = $_dbh->selectAll('members', array('member_number', '=', $user->data()->member_number));
    $firstName = $getName->first()->first_name;
    $lastName = $getName->first()->last_name;
    include 'Header.php';
    include 'sidebar.php';
?>
    <div class="content">
        <?php include 'navbar.php'; ?>
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
                            <h1 class="display-4">100</h1>
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
<?php
 require 'Footer.php';
}
