<?php
require_once 'Core/init.php';
include 'Includes/Header.php';
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
            $user->logIn($memberNumber, $password, $remember);

            if ($user) {
                Redirect::to("index.php");
            }
        } else {
            foreach ($valid->error() as $errName => $errValue) {
                echo $errName . " : " . $errValue . "<br>";
            }
        }
    }
}
?>
<div>
    <form action="" method="POST">
        <h2>Login</h2>
        <div>
            <label for="member_number">Identification Number</label>
            <input type="text" name="member_number" id="member_number" value="<?php echo escape(Input::get('member_number')); ?>">
        </div>
        <br>
        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
        </div>
        <div>
            <label for="remember">
                <input type="checkbox" name="remember" id="remember"> Remember Me
            </label>
        </div>
        <br>
        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
        <input type="submit" name="submit" value="SUBMIT">
    </form>
</div>
<?php include 'Includes/Footer.php'; ?>