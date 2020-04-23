<?php

require_once 'Core/init.php';
$user = new Auth();
$user->logOut();
Redirect::to("index.php");
