<?php

/**
 *  Written By @Ngonyoku
 *___________________________________________________________________________________________________________________
 *          Validation Class
 * This Class is Used to Perform Basic form validation Operations.
 * ------------------------------------------------------------------------------------------------------------------
 *      Regular Expressions
 *  1.  "/^[a-zA-Z\s\.\d]+$/" - Only lowercase, uppercase, whitespaces, numbers and period(.)
 *  2.  "/^[a-zA-Z\d\._]+@[a-zA-Z\d\._]+\.[a-zA-Z\d\.]{2,}+$/" - Email Address
 *  3.  "/^(\+254|0)\d{9}$/" - Kenyan Phone Number
 *  4.  "/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i" - Website
 *  5.  "/^[a-zA-Z ]*$/" - letters and whitespace
 *___________________________________________________________________________________________________________________
 * */

class Validation
{
    private $_passed = false,
        $_dbh = null,
        $_error = array();

    public function __construct()
    {
        $this->_dbh = DataBaseHandler::getInstance();
    }

    public function validate($source, $items = array())
    {
        foreach ($items as $item => $rule) {
            foreach ($rule as $rule => $rule_value) {

                $value = trim($source[$item]);

                if ($rule === 'required' && empty($value)) {
                    $this->addError('empty', "{$item} Cannot Be Empty");
                } elseif (!empty($value)) {

                    switch ($rule) {
                        case 'min':
                            #Checks if input is below the Minimum value specified.
                            if (strlen($value) < $rule_value) {
                                $this->addError("minError", "{$item} must have at least {$rule_value} characters");
                            }
                            break;
                        case 'max':
                            #Checks if input is above the Maximum value specified.
                            if (strlen($value) > $rule_value) {
                                $this->addError("maxError", "{$item} must not exeed {$rule_value} characters");
                            }
                            break;
                        case 'matches':
                            #Checks if input value matches the specified value.
                            if ($value != $source[$rule_value]) {
                                $this->addError('matchError', "{$item} must Match {$rule_value}");
                            }
                            break;
                        case 'unique':
                            #Checks if input value is Unique in database.
                            $check = $this->_dbh->selectAll($rule_value, array($item, '=', $value));
                            if ($check->count()) {
                                $this->addError('existError', "{$item} Exists!");
                            }
                    }
                }
            }
        }

        #If the $_error variable is empty(meaning no errors were registered), then Validation has been passed.
        if (empty($this->_error)) {
            $this->_passed = true;
        }

        return $this;
    }

    //The method is Used to Sanitize and Validate Email Addresses.
    public function validEmail($email)
    {
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        if (empty($email)) {
            $this->addError("emailError", " Email is Required ");
        } elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $this->addError("emailError", " Invalid Email Address ");
        } elseif (empty($this->_error)) {
            return $this->_passed = true;
        }
        return $this;
    }

    //The method stores errors Encountered
    private function addError($errorName, $errorValue)
    {
        return $this->_error[$errorName] = $errorValue;
    }

    //This method returns errors Encountered
    public function error()
    {
        return $this->_error;
    }

    //This method returns the state of the validation
    public function passed()
    {
        return $this->_passed;
    }
}