<?php

define("LOGO", "mKtaba Libraries.");
define("PASSWORD_LIMIT", "Must have at least 6 Characters and at most 30 characters.");
define("ID_LIMIT", "Identification Number Must have at least 12 Characters.");
$pageName = "";
switch (basename($_SERVER['PHP_SELF'])) {
    case 'home.php':
        $pageName = "Dashboard";
        break;
    case 'books.php';
        $pageName = "Books";
        break;
    case 'members.php';
        $pageName = "Add Members";
        break;
    case 'users.php';
        $pageName = "Manage Users";
        break;
}
