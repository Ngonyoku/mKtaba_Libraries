<?php

require_once 'Core/init.php';
$db = DataBaseHandler::getInstance();

$name = Input::get('name');
$create = (empty(Input::get('create'))) ? "0" : "1";
$view = (empty(Input::get('view'))) ? "0" : "1";
$update = (empty(Input::get('update'))) ? "0" : "1";
$delete = (empty(Input::get('delete'))) ? "0" : "1";

$arr[$name] = array(
    'create' => $create,
    'view' => $update,
    'update' => $update,
    'delete' => $delete
);

$permissions = json_encode($arr);

if (Input::exists()) {
    if (Token::check(Input::get('token'))) {
        $Enter = $db->insert('groups', array('group_name' => $name, $permissions));

        if ($Enter) {
            echo "Success";
        } else {
            echo "Failed <br>";
            echo $permissions;
        }
    }
}
?>
<form action="" method="POST" autocomplete="off">
    <div>
        <label for="name">Group Name</label>
        <input type="text" name="name" id="name">
    </div>
    <div>
        <label for="create">
            <input type="checkbox" name="create" id="create"> Create
        </label>
    </div>
    <div>
        <label for="view">
            <input type="checkbox" name="view" id="view"> View
        </label>
    </div>
    <div>
        <label for="update">
            <input type="checkbox" name="update" id="update"> Update
        </label>
    </div>
    <div>
        <label for="delete">
            <input type="checkbox" name="delete" id="delete"> Delete
        </label>
    </div>
    <br>
    <div>
        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
        <input type="submit" name="submit">
    </div>

</form>