<?php

class Members
{
    private $_dbh,
        $_data;
    public function __construct()
    {
        $this->_dbh = DataBaseHandler::getInstance();
    }

    //The Method Checks if a member Exists in the database.
    public function find($id)
    {
        if ($id) {
            $check = $this->_dbh->selectAll('members', array('member_number', '=', $id));

            if ($check->count()) {
                $this->_data = $check->first();
                return true;
            }
        }

        return false;
    }

    //The Method Inserts Members Into the Database.
    public function add($fields = array())
    {
        foreach ($fields as $attribute => $value) {
            if ($attribute == "member_number") {
                $checkMemberExistence = $this->find($value); #Check if Member Already Exists.
                if (!$checkMemberExistence) {
                    if (!$this->_dbh->insert('members', $fields)) {
                        throw new Exception("AN ERROR OCCURRED, PLEASE TRY AGAIN LATER");
                    }
                } else {
                    throw new Exception("MEMBER ALREADY EXISTS!");
                }
            }
        }
    }

    //The Method Permanently deletes Members From the database.
    public function delete()
    {
    }

    public function data()
    {
        return $this->_data;
    }
}
