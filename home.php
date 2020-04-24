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
    <!-- <h1>Hello <a href="#"><?php echo escape($user->data()->member_number); ?></a></h1>
    <ul>
        <li><a href="logout.php">Logout</a></li>
    </ul> -->

    <div class="sidebar">
        <div class="logo">
            <span class="text-success"><a href="#"><?php echo LOGO;?></a></span>
        </div>
       <a href="home.php">Dashboard</a>
       <a href="#">Books</a>
       <a href="#">Borrowers</a>
       <a href="#">Groups</a>
       <a href="#">Members</a>
       <a href="#">Users</a>
    </div>
    <script src="Bootstrap/js/bootstrap.js"></script>
    <script src="Bootstrap/js/jquery.js"></script>
</body>

</html>