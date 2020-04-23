<?php

class Auth extends User
{
    private $_dbh,
        $_data,
        $_sessionName,
        $_cookieName,
        $_isLoggedIn;

    public function __construct($user = null)
    {
        $this->_dbh = DataBaseHandler::getInstance();
        $this->_sessionName = Config::get('session/session_name');
        $this->_cookieName = Config::get('remember/cookie_name');

        if (!$user) {
            if (Session::exists($this->_sessionName)) {
                $user = Session::get($this->_sessionName);

                if ($this->find($user)) {
                    $this->_isLoggedIn = true;
                } else {
                    $this->logOut();
                }
            }
        } else {
            $this->find($user);
        }
    }

    //This method checks if the user is existent in the database
    public function find($user = null)
    {
        #If parameter is a number then we Check Id column Otherwise we Check the username column in Database
        if ($user) {
            $field = (is_numeric($user)) ? 'user_id' : 'member_number';
            $data = $this->_dbh->selectAll('users', array($field, '=', $user));

            if ($data->count()) {
                $this->_data = $data->first(); #the $_data variable holds the first record returned from the database.
                return true;
            }
        }

        return false;
    }

    //The methods is used to update User Details.
    public function update($fields = array(), $user_id = null)
    {
        if (!$user_id && $this->isLoggedIn()) {
            $user_id = $this->data()->user_id;
        }

        if (!$this->_dbh->update('users', $user_id, $fields)) {
            throw new Exception("Failed To Update Details");
        }
    }

    //The Method registers Users into the System.
    public function register($fields = array())
    {
        foreach ($fields as $key => $value) {
            if ($key === "member_number") {
                #We check if the MemberNumber is registered in the members table .
                $checkMemberExistence = $this->_dbh->selectAll('members', array('member_number', '=', $value));
                if ($checkMemberExistence->count()) {
                    #..we then check if MemberNumber is registered as a User in the users table.
                    $checkUserExistence = $this->_dbh->selectAll('users', array('member_number', '=', $value));
                    if ($checkUserExistence->count()) {
                        throw new Exception("User Already Exists");
                    } else {
                        if (!$this->_dbh->insert('users', $fields)) { #..we Register the User
                            throw new Exception(" Unable To create Account");
                        }
                    }
                } else {
                    throw new Exception("Sorry But You are NOT REGISTERED as a MEMBER.");
                }
            }
        }
    }

    public function logIn($memberNumber = null, $password = null, $remember = false)
    {
        $user = $this->find($memberNumber);
        if ($user) {
            if (password_verify($password, $this->data()->password)) {
                Session::set($this->_sessionName, $this->data()->user_id); #Start the session
                if ($remember) {
                    #Generate a hash key and Confirm if the user has been recorded in the "users_session" table
                    $hash = Hash::unique();
                    $hashCheck = $this->_dbh->selectAll('users_session', array('user_id', '=', $this->data()->user_id));

                    #if session has not been recorded in Database(i.e in the "users_session" table), we record the session.
                    if (!$hashCheck->count()) {
                        $this->_dbh->insert('users_session', array(
                            'user_id' => $this->data()->user_id,
                            'hash' => $hash
                        ));
                    } else {
                        #...else if the session is recorded, the value of the hash is set to the existent hash in the database.
                        $hash = $hashCheck->first()->hash;
                    }
                    #We generate a cookie to mark the user.
                    Cookie::set($this->_cookieName, $hash, Cookie::get('remember/cookie_expire'));
                }
            } else {
                echo "Invalid Password";
            }
        }
    }

    public function logOut()
    {
        #We permanently delete both the Session and the Cookie from the database and the Users Computer.
        $this->_dbh->delete('users_session', array('user_id', '=', $this->data()->user_id));
        Cookie::delete($this->_cookieName);
        Session::delete($this->_sessionName);
    }

    //This method 
    public function hasPermissions($key)
    {
        $memberData = $this->_dbh->selectAll('members', array('member_number', '=', $this->data()->member_number));
        if ($memberData->count()) {
            // $this->_memberData = $memberData->first();
            $group = $this->_dbh->selectAll('groups', array('group_name', '=', $memberData->first()->groups));
            if ($group->count()) {
                $permissions = json_decode($group->first()->permissions, true);

                if ($permissions[$key] == true) {
                    return true;
                }
            }
        }

        return false;
    }

    //it returns the data stored in the database.
    public function data()
    {
        return $this->_data;
    }

    //The method checks if there is any data which has been returned from the database.
    public function exists()
    {
        return (empty($this->data())) ? false : true;
    }

    //Returns the current User state(i.e if he/she is Logged In or Not)
    public function isLoggedIn()
    {
        return $this->_isLoggedIn;
    }
}
