<?php
require_once 'Core/init.php';

$user = new Auth();
$dbh = DataBaseHandler::getInstance();
if (!$user->isLoggedIn()) {
    Redirect::to("index.html");
} else {
    require 'Layouts/Header.php';
    require 'Layouts/sidebar.php'
?>
    <div class="content">
        <?php include 'Layouts/navbar.php'; ?>
        <div class="conatiner">
            <div class="row">
                <div class="col-sm-8">
                    <div class="container table-responsive">
                        <table class="table table-bordered table-hover ">
                            <tr class="table-success text-success">
                                <td>Identification Number</td>
                                <td>First Name</td>
                                <td>Last Name</td>
                            </tr>
                            <?php
                            $sql = "SELECT users.member_number, members.first_name, members.last_name
                                    FROM users
                                    INNER JOIN members ON users.member_number = members.member_number";
                            $query = $dbh->getPDO()->query($sql);
                            $query->setFetchMode(PDO::FETCH_ASSOC);

                            while ($results = $query->fetch()) {
                            ?>
                                <tr class="text-muted">
                                    <td><?php echo $results["member_number"]; ?></td>
                                    <td><?php echo $results["first_name"]; ?></td>
                                    <td><?php echo $results["last_name"]; ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>
<?php
    require_once 'Layouts/Footer.php';
}
