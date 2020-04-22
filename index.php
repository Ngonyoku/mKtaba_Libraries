<?php

require_once 'Core/init.php';

if (Session::exists('Home')) {
    echo '<p>' . Session::flash('Home') . '</p>';
}