<?php
require_once 'Core/init.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <link rel="stylesheet" href="Bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="Custom.css">
    <link rel="stylesheet" href="Bootstrap/fonts/css/all.css">

    <style>
        body,
        html {
            height: 100%;
            margin: 0;
        }

        .wallpaper {
            /* The image used */
            background-image: url("Images/Wallpapers/img3.wallpaper.jpg");

            /* Full height */
            height: 50%;

            /* Center and scale the image nicely */
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            padding-top: 10px;
        }

        form {
            background: #ffffff;
            padding: 10%;
            box-shadow: 2px 0px 10px #000000;
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <div class="wallpaper">
        <?php
        $exceptionError = $errName = $errValue = "";
        if (Input::exists()) {
            if (Token::check(Input::get('token'))) {
                $valid = new Validation();
                $valid->validate($_POST, array(
                    'member_number' => array('required' => true, 'min' => 12, 'max' => 15),
                    'password' => array('required' => true, 'min' => 6, 'max' => 30),
                    'confirmPassword' => array('required' => true, 'matches' => 'password')
                ));

                if ($valid->passed()) {
                    $user = new Auth();
                    try {
                        $user->register(array(
                            'member_number' => Input::get('member_number'),
                            'password' => password_hash(Input::get('password'), PASSWORD_DEFAULT),
                            'date_joined' => date("Y-m-d h:m:a")
                        ));
                        Session::flash('Home', "Registration Was Successful");
                        Redirect::to('index.php');
                    } catch (Exception $e) {
                        $exceptionError = $e->getMessage();
                    }
                } else {
                    foreach ($valid->error() as $key => $value) {
                        // echo $errName . " : " . $errValue . "<br>";
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
                        <form action="" method="POST">
                            <h5 class="text-success">mKtaba Libraraies</h5>
                            <h2>Create Account</h2>
                            <small class="text-success">You are only Elidgible To Create an Account If you are Registered as a Member of the Library</small>
                            <br>
                            <?php
                            if ($exceptionError) {
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
                                <small class="text-muted">Identification Number Must have at least 12 Characters.</small>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Enter Your Password" required>
                                <small class="text-muted">Password Must have at least 6 Characters.</small>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="confirmPassword">Confirm Password</label>
                                <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" placeholder="Re-Enter Your Password" required>
                                <?php
                                if ($errName === 'empty' && $errValue === "confirmPassword Cannot Be Empty") {
                                ?>
                                    <small class="text-danger">You Need To Confirm Your Password</small>
                                <?php
                                } elseif ($errName === 'matchError' && $errValue === "confirmPassword must Match password") {
                                ?>
                                    <small class="text-danger">Passwords Don't Match!</small>
                                <?php
                                }
                                ?>
                            </div>
                            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                            <input type="submit" class="btn btn-success" name="submit" value="SUBMIT">
                            <br>
                            <small>Already have an Account? <a href="login.php" class="text-success"> LogIn </a></small>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="Bootstrap/js/bootstrap.js"></script>
    <script src="Bootstrap/js/jquery.js"></script>
</body>

</html>