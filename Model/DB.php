<?php
require_once("DBConfig.php");
class DB{
    public $db;
    private $_name,
            $_email,
            $_password;

    public function __construct(){
       $this->db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

        if(mysqli_connect_errno()) {
            exit;
        }
    }

    public function sanitize($name, $email, $password){
        $this->_name = mysqli_real_escape_string($this->db, $name);
        $this->_email = mysqli_real_escape_string($this->db, $email);
        $this->_password = mysqli_real_escape_string($this->db, $password);

    }

    public function checkIfAvailable(){
        // first check the database to make sure 
        // a user does not already exist with the same username and/or email
        $user_check_query = $this->db->prepare("SELECT * FROM users WHERE name = ? OR email = ?");
        $user_check_query->bind_param("ss", $this->_name, $this->_email);
        $user_check_query->execute();
        $users =  $user_check_query->get_result()->fetch_assoc();
        $user_check_query->close();
        if (isset($users)) { // if user exists
            while($user = $users) {
                if (strtolower($user['name']) === strtolower($this->_name)) {
                    Validation::addError("signUp", "Name already exists.");
                };
                if ($user['email'] === $this->_email) {
                    Validation::addError("signUp", "Email already exists.");
                };
            }
        } else if(count(Validation::$signUpErrors) === 0){
            self::register();
            return true;
        }
    }

    public function register(){
        $registration = new Register();
        $registration->registering($this->db, $this->_name, $this->_email, $this->_password);
    }

    public function login(){
        $loggingIn = new Login();
        $loggingIn->tryLogIn($this->db, $this->_email, $this->_password);
    }
}