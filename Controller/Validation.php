<?php


class Validation{
    public static  $name = "",
            $email    = "",
            $password = "",
            $errors   = array();

    //Check if form is filled correctly
    public function validateSignUp(){
            
        // receive all input values from the form and add errors
        if (isset($_POST['sign-up'])) {
            self::$name = $_POST['signup-name'];
            self::$email = $_POST['signup-email'];
            self::$password = $_POST['signup-password'];

            if (empty(self::$name)){
                $this->addError("Name is required.");
            } else if (strlen (self::$name) < 3){
                $this->addError("Name is too short.");
            } else if(strlen (self::$name) > 50){
                $this->addError("Name is too long.");
            }

            if (empty(self::$email)){
                $this->addError("Email is required.");
            }

            if (empty(self::$password)){
                $this->addError("Password is required.");
            } else if (strlen (self::$password) < 6){
                $this->addError("Password is too short.");
            } else if(strlen (self::$password) > 64){
                $this->addError("Password is too long.");
            }

            if(count(self::$errors) === 0){
                $registration = new DB();
                $registration->sanitize(self::$name, self::$email, self::$password);
                $registration->checkIfAvailable();
            }
        };
    }

    public static function addError($error){
        array_push(self::$errors, $error);
    }

    public static function errors(){
        return self::$errors;
    }
};

$validation = new Validation();

if(!empty($_POST)){
    $validation->validateSignUp();
};

?>