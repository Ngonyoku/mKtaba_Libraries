<?php

class User
{
    protected $_dbh,
        $_data,
        $_sessionName,
        $_cookieName,
        $_isLoggedIn;

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

    //it returns the data stored in the database.
    public function data()
    {
        return $this->_data;
    }

    //Returns the current User state(i.e if he/she is Logged In or Not)
    public function isLoggedIn()
    {
        return $this->_isLoggedIn;
    }
}
