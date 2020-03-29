<?php


class Validation{
    public static  $signUpName = "",
            $signUpEmail    = "",
            $signUpPassword = "",
            $loginEmail = "",
            $loginPassword = "",
            $signUpErrors   = array(),
            $loginErrors = array();

    //Check if form is filled correctly
    public function registrationForm(){
        self::$signUpName = $_POST['signup-name'];
        self::$signUpEmail = $_POST['signup-email'];
        self::$signUpPassword = $_POST['signup-password'];

        if (empty(self::$signUpName)){
            $this->addError("signUp","Name is required.");
        } else if (strlen (self::$signUpName) < 3){
            $this->addError("signUp","Name is too short.");
        } else if(strlen (self::$signUpName) > 50){
            $this->addError("signUp","Name is too long.");
        }

        if (empty(self::$signUpEmail)){
            $this->addError("signUp","Email is required.");
        }

        if (empty(self::$signUpPassword)){
            $this->addError("signUp","Password is required.");
        } else if (strlen (self::$signUpPassword) < 6){
            $this->addError("signUp","Password is too short.");
        } else if(strlen (self::$signUpPassword) > 64){
            $this->addError("signUp","Password is too long.");
        }

        if(count(self::$signUpErrors) === 0){
            $registration = new DB();
            $registration->sanitize(self::$signUpName, self::$signUpEmail, self::$signUpPassword);
            if($registration->checkIfAvailable()){
                self::$signUpName ="";
                self::$signUpEmail = "";
                self::$signUpPassword = "";
            }
        }
    }

    public function loginForm(){
        self::$loginEmail = $_POST['login-email'];
        self::$loginPassword = $_POST['login-password'];

        if (empty(self::$loginEmail)){
            $this->addError("login","Email is required.");
        }

        if (empty(self::$loginPassword)){
            $this->addError("login","Password is required.");
        }

        if(count(self::$loginErrors) === 0){
            $login = new DB();
            $login->sanitize("", self::$loginEmail, self::$loginPassword);
            $login->login();
        }
    }

    public function validateForm(){
            
        // receive all input values from the form and add errors
        if (isset($_POST['sign-up'])) {
            self::registrationForm();
        };

        if(isset($_POST['login-form'])){
            self::loginForm();
        }
    }

    public static function addError($type,$error){
        if($type === "signUp"){
            array_push(self::$signUpErrors, $error);
        }else{
            array_push(self::$loginErrors, $error);
        }
    }

    public static function errors($type){
        if($type === "signUp"){
            return self::$signUpErrors;
        } else {
            return self::$loginErrors;
        }
    }
};

$validation = new Validation();

if(!empty($_POST)){
    $validation->validateForm();
};

?>