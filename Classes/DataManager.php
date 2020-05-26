<?php

class DataManager
{
    private $_data, $_count, $_dbh, $_query;
    public function __construct()
    {
        $this->_dbh = DataBaseHandler::getInstance();
        $sql = "SELECT users.member_number, members.first_name, members.last_name
                                    FROM users
                                    INNER JOIN members ON users.member_number = members.member_number";
        $this->_query = $this->_dbh->getPDO()->query($sql);
        $this->_query->setFetchMode(PDO::FETCH_ASSOC);
        $this->_data = $this->_query->fetch();
    }

    public function get()
    {
    }

    public function fetchData()
    {
        return $this->_data;
    }
}
