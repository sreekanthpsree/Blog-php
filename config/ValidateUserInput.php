<?php

class ValidateInputField
{
    private $inputValue;
    private $redirectUrl;
    function __construct($array, $redirectUrl)
    {
        $this->inputValue = $array;
        $this->redirectUrl = $redirectUrl;
    }

    function validateInput()
    {
        global $errorArray;
        global $valueArray;
        foreach ($this->inputValue as $keys => $values) {
            global $errorArray;
            global $valueArray;
            if (empty($values) || $values === 0 || $values === "Select") {
                $errorArray[$keys] = $keys;
            }
            if (!empty($values) || $values !== 0 || $values === "Select") {
                $valueArray[$keys] = $values;
                $_SESSION['valueArray'] = $valueArray;
            }
        }
        if (isset($errorArray)) {

            $_SESSION['errorArray'] = $errorArray;
            header("Location:$this->redirectUrl");
            exit();
        }
        if (!isset($errorArray)) {
            unset($_SESSION['errorArray']);
        }
        if (!isset($valueArray)) {
            unset($_SESSION['valueArray']);
        }
    }


}



?>