<?php

function displayError($errors = array())
{
    if ($errors) {
        foreach ($errors as $error => $errValue) {
            echo $error . ' : ' . $errValue;
        }
    }
}