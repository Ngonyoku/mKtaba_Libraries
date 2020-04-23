<?php

require_once 'Core/init.php';

$user = new Auth();
if ($user->isLoggedIn()) {
    Redirect::to("home.php");
} else {
    Redirect::to("index.html");
}
