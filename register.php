<?php
require_once 'Core/init.php';
include 'Includes/Header.php';
if (Input::exists()) {
    if (Token::check(Input::get('token'))) {
        $valid = new Validation();
        $valid->validate($_POST, array(
            'member_number' => array('required' => true, 'min' => 12, 'max' => 15, 'unique' => 'users'),
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
                die($e->getMessage());
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
        <h2>Create Password</h2>
        <legend>
            <div>
                <label for="member_number">Identification Number</label>
                <input type="text" name="member_number" id="member_number" value="<?php echo escape(Input::get('member_number')); ?>">
            </div>
            <br>
            <div>
                <label for="password">Password</label>
                <input type="password" name="password" id="password">
            </div>
            <br>
            <div>
                <label for="confirmPassword">Confirm Password</label>
                <input type="password" name="confirmPassword" id="confirmPassword">
            </div>
            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
            <input type="submit" name="submit" value="SUBMIT">
        </legend>
    </form>
</div>
<?php
include 'Includes/Footer.php';
?>