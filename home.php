<?php
require_once 'Core/init.php';
if (Session::exists('Home')) {
    echo '<p>' . Session::flash('Home') . '</p>';
}
$user = new Auth();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="Bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="Custom.css">
    <link rel="stylesheet" href="Bootstrap/fonts/css/all.css">
</head>

<body>
    <h1>Hello <a href="#"><?php echo escape($user->data()->member_number); ?></a></h1>
    <ul>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</body>

</html>