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
                    //Logout
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
        if (!$this->_dbh->insert('users', $fields)) {
            throw new Exception(" Unable To create Account");
        }
    }

    public function logIn($memberNumber = null, $password = null, $remember = false)
    {
        #if the parameters have not been set(meaning user is already Logged In), we start our session.
        if (!$memberNumber && !$password && $this->exists()) {
            Session::set($this->_sessionName, $this->data()->user_id);
        } else {
            #...otherwise we Log The user In
            $user = $this->find($memberNumber); #Confirm that the user exists in the database(users table).

            if ($user) {
                // $db = $this->_dbh->getPDO()->prepare("SELECT password FROM users WHERE member_number = ?");
                // $db->bindValue(1, $memberNumber);
                // $db->execute();
                // $result = $db->fetch(PDO::FETCH_ASSOC); #Fetch the results from the database.
                $result = $this->_dbh->selectAll('users', array('member_number', '=', $this->data()->member_number));
                if ($result->count()) {

                    if (password_verify($password, $result->first()->password)) {
                        Session::set($this->_sessionName, $this->data()->user_id); #We set the session Variable.

                        if ($remember) { #if the User has asked to be remebered by the System..

                            $hash = Hash::unique(); #Generate a hash value to ensure that User is recorded in the "user_session" table.
                            $hashCheck = $this->_dbh->selectAll('users_session', array('user_id', '=', $this->data()->user_id));

                            #if the session has not been Recorded into the database(i.e "users_session" table), we record the session.
                            if (!$hashCheck->count()) {
                                $this->_dbh->insert(
                                    'users_session',
                                    array(
                                        'user_id' => $this->data()->user_id,
                                        'hash' => $hash
                                    )
                                );
                            } else { #...otherwise, the $hash value will be set to the Current value in the database. 
                                $hash = $hashCheck->first()->hash;
                            }
                            #We generate a Cookie to mark the User.
                            Cookie::set($this->_cookieName, $hash, Config::get('remember/cookie_expire'));
                        }
                        return true;
                    }
                }
            }
        }

        return false;
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
