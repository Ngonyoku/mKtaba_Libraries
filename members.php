<?php
require_once 'Core/init.php';
// if (Session::exists('Home')) {
//     echo '<p>' . Session::flash('Home') . '</p>';
// }
$user = new Auth();
if (!$user->isLoggedIn()) {
    Redirect::to("index.html");
} else {
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="Bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="Custom.css">
    <link rel="stylesheet" href="Bootstrap/fonts/css/all.css">
    <link rel="stylesheet" href="Styles/sidebar.css">
    <link rel="stylesheet" href="Styles/index.css">

</head>
</body>
<!-- Side Bar File -->
<?php include 'sidebar.php'; ?>


<div class="content">
    <!--header File -->
    <?php include 'Header.php'; ?>

    <?php
        $exceptionError = $errName = $errValue = $groupErr = $genderErr = "";
        if (Input::exists()) {
            if (Token::check(Input::get('token'))) {
                $valid = new Validation();
                $valid->validate($_POST, array(
                    'member_number' => array('required' => true, 'min' => 12, 'max' => 15),
                    'first_name' => array('required' => true),
                    'last_name' => array('required' => true),
                    'phone' => array('required' => true),
                    'emailAddress' => array('required' => true, 'min' => 5, 'max' => 80),
                    'group' => array('required' => true),
                    'gender' => array('required' => true)
                ));

                if ($valid->passed()) {
                    $member = new Members();
                    if (!empty(Input::get('gender'))) {
                        $gender = Input::get('gender');
                    }
                    if (!empty(Input::get('group'))) {
                        $group = Input::get('group');
                    }
                    if ($valid->validEmail(Input::get('emailAddress'))) {
                        $email = Input::get('emailAddress');
                    }
                    
                    try {
                        $member->add(array(
                            'member_number' => Input::get('member_number'),
                            'first_name' => Input::get('first_name'),
                            'last_name' => Input::get('last_name'),
                            'groups' => $group,
                            // 'photo_url' => Input::get('group'),
                            'phone_number' => Input::get('phone'),
                            'email' => $email,
                            'gender' => $gender
                        ));
                    } catch (Exception $e) {
                        $exceptionError = $e;
                    }
                } else {
                    foreach ($valid->error() as $key => $value) {
                        $errName = $key;
                        $errValue = $value;
                    }
                }
            }
        }
        ?>
    <div class="container">
        <div class="row">
            <!-- User Member -->
            <div class="conatiner col-sm-6 col-md-6">
                <div class="container">
                    <div class="img-fluid" style="width: 500px">
                        <img src="Images/UserAvatars/noUserImage.png" class="card-img-top" width="100%" alt="user">
                    </div>
                </div>
            </div>
            <!-- End of Member Image -->

            <!-- Add Member Form -->
            <div class="container col-sm-6 col-md-6">
                <form action="" method="post">
                    <?php
                        if ($exceptionError) {
                        ?>
                    <div class="alert alert-danger alert-dismissible">
                        <button class="close" type="button" data-dismiss="alert">&times;</button>
                        <?php echo $exceptionError; ?>
                    </div>
                    <?php
                        } elseif (!empty($errValue)) {
                        ?>
                    <div class="alert alert-danger alert-dismissible">
                        <button class="close" type="button" data-dismiss="alert">&times;</button>
                        <?php echo $errValue; ?>
                    </div>
                    <?php
                        } elseif (!empty($errValue)) {
                        ?>
                    <div class="alert alert-danger alert-dismissible">
                        <button class="close" type="button" data-dismiss="alert">&times;</button>
                        <?php echo $errValue; ?>
                    </div>
                    <?php
                        }
                        ?>
                    <div class="form-group">
                        <label for="member_number">Identification Number</label>
                        <input type="text" class="form-control" name="member_number" id="member_number"
                            placeholder="Employee/Registration Number" value="<?php echo Input::get('member_number');?>"
                            required>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name"
                                placeholder="First Name" value="<?php echo Input::get('first_name')?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name"
                                placeholder="Last Name" value="<?php echo Input::get('first_name')?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="emailAddress">Email Address</label>
                        <input type="email" class="form-control" name="emailAddress" id="emailAddress"
                            placeholder="Enter Your Personal Email Address"
                            value="<?php echo Input::get('emailAddress')?>" required>
                        <small class="text-muted">Minimum of 5 characters and not more than 80</small>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="phone">Phone Number</label>
                            <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone Number"
                                value="<?php echo Input::get('phone')?>" required>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="group">Group</label>
                            <select name="group" id="group" class="custom-select" required>
                                <option value="">---</option>
                                <option value="Student">Student</option>
                                <option value="Staff">Staff</option>
                                <option value="Staff">Admin</option>
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="gender">Gender</label>
                            <select name="gender" id="gender" class="custom-select" required>
                                <option value="">---</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                        <input type="submit" class="btn btn-success form-control" value="SUBMIT">
                    </div>
                </form>
            </div>
            <!-- End Of Add Member Form -->
        </div>
    </div>

    <!-- Member Table -->
    <div class="container table-responsive">
        <table class="table table-bordered table-hover ">
            <tr class="table-success text-success">
                <td>ID</td>
                <td>Identification Number</td>
                <td>First Name</td>
                <td>Last Name</td>
                <td>Group Type</td>
                <td>Email</td>
                <td>Contact</td>
                <td>Gender</td>
            </tr>
            <?php 
            $dbh = DataBaseHandler::getInstance();
            $sql = "SELECT * FROM members";
            $query = $dbh->getPDO()->query($sql);
            $query->setFetchMode(PDO::FETCH_ASSOC);

            while ($result = $query->fetch()) {
            ?>
            <tr class="text-muted">
                <td><?php echo $result["member_id"];?></td>
                <td><?php echo $result["member_number"];?></td>
                <td><?php echo $result["first_name"];?></td>
                <td><?php echo $result["last_name"];?></td>
                <td><?php echo $result["groups"];?></td>
                <td><?php echo $result["email"];?></td>
                <td><?php echo $result["phone_number"];?></td>
                <td><?php echo $result["gender"];?></td>
            </tr>
            <?php
            }
            ?>

        </table>
    </div>
    <!-- End of Member Table -->
</div>
<script src="Scripts/hide.js"></script>
<script src="Bootstrap/js/bootstrap.js"></script>
<script src="Bootstrap/js/jquery.js"></script>

</html>

<?php
}