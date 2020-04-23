<?php

require_once 'Core/init.php';
include 'Includes/Header.php';

if (Session::exists('Home')) {
    echo '<p>' . Session::flash('Home') . '</p>';
}

$user = new Auth();
$_db = DataBaseHandler::getInstance();
if ($user->isLoggedIn()) {
?>
    <h1>Hello <a href="#"><?php echo escape($user->data()->member_number); ?></a></h1>
    <ul>
        <li><a href="logout.php">Logout</a></li>
    </ul>
<?php } else { ?>
    <p>Please <a href="login.php">Log In</a> or <a href="register.php">Sign Up.</a></p>
<?php
}
include 'Includes/Footer.php';

?>