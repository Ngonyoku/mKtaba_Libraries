<?php 
include 'Includes/Header.php';
?>
<div>
    <form action="" method="POST">
        <h2>Create Password</h2>
        <legend>
            <div>
                <label for="memberNumber">Identification Number</label>
                <input type="text" name="memberNumber" id="memberNumber">
            </div>
            <br>
            <div>
                <label for="password">Password</label>
                <input type="password" name="password" id="password">
            </div>
            <br>
            <input type="submit" name="submit" value="SUBMIT">
        </legend>
    </form>
</div>
<?php
include 'Includes/Footer.php';
?>