<?php
require_once 'Core/init.php';
$user = new Auth();
if ($user->isLoggedIn()) {
    Redirect::to("home.php");
} else {
?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        
        <link rel="stylesheet" href="Bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="Custom.css">
        <link rel="stylesheet" href="Bootstrap/fonts/css/all.css">
        <link rel="stylesheet" href="Styles/index.css">
    </head>

    <body>
        <div class="wallpaper">
            <div class="container">
                <a class="navbar-brand text-success shade-dark" href="index.php">mKtaba Libraries</a>
            </div>
            <?php
            $exceptionError = $errName = $errValue = "";
            if (Input::exists()) {
                if (Token::check(Input::get('token'))) {
                    $valid = new Validation();
                    $valid->validate($_POST, array(
                        'member_number' => array('required' => true),
                        'password' => array('required' => true)
                    ));

                    if ($valid->passed()) {
                        $user = new Auth();
                        $remember = (Input::get('remember') === 'on') ? true : false;
                        $memberNumber = Input::get('member_number');
                        $password = Input::get('password');
                        try {
                            $user->logIn($memberNumber, $password, $remember);
                            Redirect::to("index.php");
                        } catch (Exception $e) {
                            $exceptionError = $e->getMessage();
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
                <div class="row justify-content-md-center">
                    <div class="col-md-auto">
                        <div class="border">
                                <!-- Login Form -->
                            <form action="" method="POST">
                                <h5 class="text-success"><?php echo LOGO; ?></h5>
                                <h2>LOG IN</h2>
                                <?php
                                if ($exceptionError) { # If Error is Encountered, display the Error.
                                ?>
                                    <div class='alert alert-danger alert-dismissible'>
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        <?php echo $exceptionError; ?>
                                    </div>
                                <?php
                                }
                                ?>
                                <hr>
                                <div class="form-group">
                                    <label for="member_number">Identification Number</label>
                                    <input type="text" class="form-control" name="member_number" id="member_number" value="<?php echo escape(Input::get('member_number')); ?>" placeholder="Employee/Registration Number" required>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter Your Password" required>
                                    <small class="text-muted"><?php echo PASSWORD_LIMIT; ?></small>
                                </div>
                                <div class="form-group">
                                    <label for="remeber">
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                                <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                                <input type="submit" class="btn btn-success" name="submit" value="SUBMIT">
                                <br><br>
                                <small><a href="#">FORGOT PASSWORD?</a></small>
                                <br><br>
                                <small><a href="register.php" class="text-success"> Create Account </a>If You don't Already have one.</small>
                                <br>
                                <small><span class="text-muted">You are only Elidgible To Create an Account If you are Registered as a Member of the Library</span></small>
                            </form>
                                <!-- End Of Login Form -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <script src="Bootstrap/js/bootstrap.js"></script>
        <script src="Bootstrap/js/jquery.js"></script>
    </body>

    </html>

<?php
}
