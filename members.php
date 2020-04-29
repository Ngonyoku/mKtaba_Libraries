<?php
require_once 'Core/init.php';
if (Session::exists('Home')) {
    echo '<p>' . Session::flash('Home') . '</p>';
}
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
        if (Input::exists()) {
            if (Token::check(Input::get('token'))) {
                $valid = new Validation();
                $valid->validate($_POST, array(
                    'member_number' => array('required' => true),
                    'first_name' => array('required' => true),
                    'last_name' => array('required' => true),
                    'phone' => array('required' => true),
                    'emailAddress' => array('required' => true, 'min' => 5, 'max' => 80),
                    'group' => array('required' => true),
                    'gender' => array('required' => true)
                ));
            }
        }
        ?>
        <div class="container">
            <div class="row">
                <!-- User Image -->
                <div class="conatiner col-sm-6">
                    <div class="container">
                        <div class="img-fluid" style="width: 500px">
                            <img src="Images/UserAvatars/noUserImage.png" class="card-img-top" width="100%" alt="user">
                        </div>
                    </div>
                </div>
                <!-- End of User Image -->

                <!-- Add User Form -->
                <div class="container col-sm-6">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="member_number">Identification Number</label>
                            <input type="text" class="form-control" name="member_number" id="member_number" value="<?php echo escape(Input::get('member_number')); ?>" placeholder="Employee/Registration Number" required>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="first_name">First Name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="emailAddress">Email Address</label>
                            <input type="email" class="form-control" name="emailAddress" id="emailAddress" placeholder="Enter Your Personal Email Address" required>
                            <small class="text-muted">Minimum of 5 characters and not more than 80</small>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-sm-4">
                                <label for="phone">Phone Number</label>
                                <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone Number">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="group">Group</label>
                                <select name="group" id="group" class="custom-select">
                                    <option value="None">---</option>
                                    <option value="Student">Student</option>
                                    <option value="Staff">Staff</option>
                                    <option value="Staff">Admin</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="gender">Gender</label>
                                <select name="gender" id="gender" class="custom-select">
                                    <option value="None">---</option>
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
                <!-- End Of Add User Form -->
            </div>
        </div>
    </div>
    <script src="Scripts/hide.js"></script>
    <script src="Bootstrap/js/bootstrap.js"></script>
    <script src="Bootstrap/js/jquery.js"></script>

    </html>

<?php
}
