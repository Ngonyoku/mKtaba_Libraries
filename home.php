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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="Custom.css">
    <link rel="stylesheet" href="Bootstrap/fonts/css/all.css">
    <link rel="stylesheet" href="Styles/sidebar.css">
</head>

<body>
    <div class="sidebar">
        <div class="logo">
            <span class="text-success"><a href="#"><?php echo LOGO; ?></a></span>
        </div>
        <a href="home.php" class="active"><i class="fas fa-home"></i>Dashboard</a>
        <a href="#"><i class="fas fa-book"></i> Books</a>
        <a href="#"><i class="fas fa-parachute-box"></i> Suppliers</a>
        <a href="#"><i class="fas fa-users"></i>Members</a>
        <a href="#"><i class="fas fa-cog"></i> Settings</a>
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>

    <div class="content">
        <h1>Hello <a href="#"><?php echo escape($user->data()->member_number); ?></a></h1>
    </div>
    <script src="Bootstrap/js/bootstrap.js"></script>
    <script src="Bootstrap/js/jquery.js"></script>
</body>

</html>