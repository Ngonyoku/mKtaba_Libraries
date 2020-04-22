<?php

/**
 *  Written By @Ngonyoku
 *
 * PHP Version 7
 * MySql database
 *___________________________________________________________________________________________________________________
 *          DataBaseHandler Class
 * This Class Handles basic DB Operations i.e CRUD operations. Database Access Method employed is PDO (PHP Data
 * Objects)
 * ------------------------------------------------------------------------------------------------------------------
 *          PDO functions employed
 *  1. PDO::prepare() — Prepares a statement for execution and returns a statement object
 *  2. PDOStatement::execute() — Executes a prepared statement.
 *  3. PDOStatement::bindValue() — Binds a value to a parameter
 *  4. PDOStatement::fetchAll() — Returns an array containing all of the result set rows, An empty array is returned if
 *      there are zero results to fetch, or FALSE on failure.
 *  5. PDOStatement::rowCount() — Returns the number of rows affected by the last SQL statement excecuted by the
 *      corresponding PDOStatement object.
 *___________________________________________________________________________________________________________________
 * */

class DataBaseHandler
{
    private static $_instance = null;
    private $_pdo, #is the Instance of the PDO class
        $_query,
        $_error = 0,
        $_results,
        $_count = 0;

    private function __construct()
    {
        try {
            $this->_pdo = new PDO(
                'mysql:host=' . Config::get('mysql/host') .
                    ';dbname=' . Config::get('mysql/db'),
                Config::get('mysql/username'),
                Config::get('mysql/password')
            );
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    //We create an Instance of this Class if it doesn't already Exist.
    public static function getInstance()
    {
        if (!isset(self::$_instance)) {
            self::$_instance = new DataBaseHandler();
        }

        return self::$_instance;
    }

    //This method excecutes Sql query Functions
    public function query($sql, $params = array())
    {
        $this->_error = false;
        if ($this->_query = $this->_pdo->prepare($sql)) { #Check if the sql statement is prepared for excecution 
            $x = 1;
            if (count($params)) {
                foreach ($params as $param) {
                    $this->_query->bindValue($x, $param); #Bind the values of the array to the prepared statements.
                    $x++;
                }
            }
        }

        if ($this->_query->execute()) { #If the query has been successfully Excecuted, then..
            $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ); #we store the result as an Object
            $this->_count = $this->_query->rowCount(); #we store the number of rows returned after excecution
        } else {
            $this->_error = true;
        }

        return $this;
    }

    //This method completes the actions required by the CRUDE operations (i.e get(),delete())
    public function action($sql, $table, $where = array())
    {
        if (count($where) === 3) { #Check if the values entered are excactly 3.
            $operators = array('<', '>', '=', '<=', '>='); #We limit the type of Operators entered in the $where array
            $field = $where[0];
            $operator = $where[1];
            $value = $where[2];

            if (in_array($operator, $operators)) { #We check if the operator entered is valid.
                $sql = "{$sql} FROM {$table} WHERE {$field} {$operator} ?";
                if (!$this->query($sql, array($value))->error()) {
                    return $this;
                }
            }
        }
        return false;
    }

    //This method handles the Insert Functionality of an sql query.
    public function insert($table, $fields = array())
    {
        $keys = array_keys($fields);
        $value = "";
        $x = 1;

        foreach ($fields as $field) {
            $value .= "?";
            if ($x < count($fields)) {
                $value .= ", ";
            }

            $x++;
        }

        $sql = "INSERT INTO {$table}(`" . implode('`, `', $keys) . "`) VALUES({$value})";

        if (!$this->query($sql, $fields)->error()) {
            return true;
        }

        return false;
    }

    //This method handles the Update Functionality of an sql query.
    public function update($table, $attribute, $id, $fields = array())
    {
        $parameters = "";
        $x = 1;

        foreach ($fields as $name => $value) {
            $parameters .= "{$name} = ?";
            if ($x < count($fields)) {
                $parameters .= ",";
            }
            $x++;
        }

        $sql = "UPDATE {$table} SET {$parameters} WHERE {$attribute} = {$id}";

        if (!$this->query($sql, $fields)->error()) {
            return true;
        }

        return false;
    }

    //Selects Everything from the specified relation.
    public function selectAll($table, $fields)
    {
        return $this->action("SELECT * ", $table, $fields);
    }

    public function delete($table, $fields)
    {
        return $this->action("DELETE ", $table, $fields);
    }

    //This method returns the errors encountered during compilation.
    public function error()
    {
        return $this->_error;
    }

    //Returns an Instance of the PDO class created
    public function getPDO()
    {
        return $this->_pdo;
    }

    //Returns the results of the database queries.
    public function results()
    {
        return $this->_results;
    }

    //returns the first tuple of all the results from the database.
    public function first()
    {
        return $this->results()[0];
    }

    public function count()
    {
        return $this->_count;
    }
}
