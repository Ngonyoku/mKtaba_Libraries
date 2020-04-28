<?php
require_once 'Core/init.php';
if (Session::exists('Home')) {
    echo '<p>' . Session::flash('Home') . '</p>';
}
$user = new Auth();
if (!$user->isLoggedIn()) {
    Redirect::to("index.html");
} else {
?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home</title>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="Bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="Custom.css">
        <link rel="stylesheet" href="Bootstrap/fonts/css/all.css">
        <link rel="stylesheet" href="Styles/sidebar.css">
        <link rel="stylesheet" href="Styles/index.css">

    </head>
    </body>

    <?php include 'sidebar.php'; ?>
    <div class="content">
        <?php include 'Header.php'; ?>
        <div class="container">
            <div class="container">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="member_number">Identification Number</label>
                        <input type="text" class="form-control" name="member_number" id="member_number" value="<?php echo escape(Input::get('member_number')); ?>" placeholder="Employee/Registration Number" required>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="group">Group</label>
                            <select name="group" id="group" class="custom-select">
                                <option value="Student">Student</option>
                                <option value="Staff">Staff</option>
                                <option value="Staff">Admin</option>
                            </select>
                        </div>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="Scripts/hide.js"></script>
    <script src="Bootstrap/js/bootstrap.js"></script>
    <script src="Bootstrap/js/jquery.js"></script>

    </html>

<?php
}
