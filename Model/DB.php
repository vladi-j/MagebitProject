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
            echo "Error: Could not connect to the database.";
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
        $user_check_query = $this->db->prepare("SELECT * FROM users WHERE name = ? OR email = ? LIMIT 1");
        $user_check_query->bind_param("ss", $this->_name, $this->_email);
        $user_check_query->execute();
        $user = mysqli_fetch_assoc( $user_check_query->get_result());
        $user_check_query->close();
        if ($user) { // if user exists
            if ($user['name'] === $this->_name) {
                Validation::addError("signUp", "Name already exists.");
            }

            if ($user['email'] === $this->_email) {
                Validation::addError("signUp", "Email already exists.");
            }
        } else if(count(Validation::$signUpErrors) === 0){
            echo "Success";
            self::register();
            return true;
        }
    }

    public function register(){
        $this->_password = md5($this->_password);//encrypt the password before saving in the database

        $query = $this->db->prepare("INSERT INTO users (name, email, password) VALUES(?, ?, ?)");
        $query->bind_param("sss", $this->_name, $this->_email, $this->_password);
        $query->execute();
        $_SESSION['name'] = $this->_name;
        $_SESSION['success'] = "You are now logged in";
        $query->close();
    }

    public function login(){
        if(count(Validation::$loginErrors) === 0){
            $this->_password = md5($this->_password);
            $query = $this->db->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
            $query->bind_param("ss", $this->_email, $this->_password);
            $query->execute();
            $user = mysqli_fetch_assoc( $query->get_result());
            $query->close();
            if($user){
                $_SESSION['name'] = $this->_name;
                $_SESSION['success'] = "You are now logged in";
            }else{
                Validation::addError("login", "Incorrect credentials!");
            }
        }
    }
}
?>