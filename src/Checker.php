<?php

namespace RTPorfirio;

class Checker
{

    private array $erros;

    private $field;

    public function __construct()
    {
        $this->erros = [];
    }

    public function field($field,$contents) :Checker
    {
        $this->field = $field;
        $this->contents = $contents;
        return $this;
    }

    //Check if is a not valid string using regex.
    public function isString(string $message='This is a not string.') :Checker
    {
        if (!preg_match('/^[a-zA-Z]+$/', $this->contents)) {
            $this->erros['invalid-string-'.$this->field] = $message;
        }
        return $this;
    }

    //Check if is a not valid alphanumeric.
    public function isAlphanumeric(string $message='This is a not alphanumeric string') :Checker
    {
        if (!preg_match('/^[a-zA-Z0-9]+$/', $this->contents)) {
            $this->erros['invalid-alphanumeric-'.$this->field] = $message;
        }
        return $this;
    }

    //Check if a string is not valid.
    public function isEmpty(String $message = "String empty.") :Checker
    {
        if (empty($this->contents)) {
            $this->erros['empty-field-'.$this->field] = $message;
        }
        return $this;
    }

    //check is a number is not valid.
    public function isNumber(String $message = "Invalid number.") :Checker
    {
        if (!is_numeric($this->contents)) {
            $this->erros['invalid-number-'.$this->field] = $message;
        }
        return $this;
    }

    //check a min caracters in a string.
    public function min(int $min, String $message = "Min caracters.") :Checker
    {
        if (strlen($this->contents) < $min) {
            $this->erros['invalid-min-amount-'.$this->field] = $message;
        }
        return $this;
    }

    //check a max caracters in a string.
    public function max(int $max, String $message = "Max caracters.") :Checker
    {
        if (strlen($this->contents) > $max) {
            $this->erros['invalid-max-amount'.$this->field] = $message;
        }
        return $this;
    }

    //check a email is not valid.
    public function isEmail(String $message = "Invalid email.") :Checker
    {
        if (!filter_var($this->contents, FILTER_VALIDATE_EMAIL)) {
            $this->erros['invalid-email-'.$this->field] = $message;
        }
        return $this;
    }

    //Check is a url is not valid.
    public function isUrl(String $message = "Invalid url.") :Checker
    {
        if (!filter_var($this->contents, FILTER_VALIDATE_URL)) {
            $this->erros['invalid-url-'.$this->field] = $message;
        }
        return $this;
    }
    
    //Check is a not valid date.
    public function isDate(String $message = "Invalid date.") :Checker
    {
        if (!preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/', $this->contents)) {
            $this->erros['invalid-date-'.$this->field] = $message;
        }
        return $this;
    }
    
    //Check is a custom error
    public function custom(string $regex,String $message) :Checker
    {
        if (!preg_match($regex, $this->contents)) {
            $this->erros['custom-'.$this->field] = $message;
        }
        return $this;
    }

    //Has errors
    public function hasErrors()
    {
        return !empty($this->erros);
    }

    //Get errors.
    public function getErrors() :array
    {
        return $this->erros;
    }

}