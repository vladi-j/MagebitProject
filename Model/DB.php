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

        if ($user) { // if user exists
            if ($user['name'] === $this->_name) {
                Validation::addError("Name already exists.");
            }

            if ($user['email'] === $this->_email) {
                Validation::addError("Email already exists.");
            }
        } else {
            echo "free";
        }
    }

    public function register(){
        
    }
}
?>