<?php
require_once("DBConfig.php");
class Validation{
    public $db;
    public static  $signUpName = "",
            $signUpEmail    = "",
            $signUpPassword = "",
            $loginEmail = "",
            $loginPassword = "",
            $userID = "",
            $signUpErrors = array(),
            $loginErrors = array();

    function __construct(){
        if(!empty($_POST)){
            self::validateForm();
        };
    }

    public function DBConnection(){
        $this->db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
 
         if(mysqli_connect_errno()) {
             exit;
         }
     }

    public function sanitize(){
        self::DBConnection();
        self::$signUpName = mysqli_real_escape_string($this->db, self::$signUpName);
        self::$signUpEmail = mysqli_real_escape_string($this->db, self::$signUpEmail);
        self::$signUpPassword = mysqli_real_escape_string($this->db, self::$signUpPassword);
    }

    //Register user
    public function registering(){
        $password = md5(self::$signUpPassword);//encrypt the password before saving in the database

        $query = $this->db->prepare("INSERT INTO users (name, email, password) VALUES(?, ?, ?)");
        $query->bind_param("sss", self::$signUpName, self::$signUpEmail, $password);
        $query->execute();
        $_SESSION['name'] = self::$signUpName;
        $_SESSION['email'] = self::$signUpEmail;
        $_SESSION['loggedin'] = true;
        header('location: index.php');
        $thread = $this->db->thread_id;
        $this->db->kill($thread);
        $this->db->close();
    }

    //Attempt to log in
    public function tryLogIn(){
        if(count(Validation::$loginErrors) === 0){
            $password = md5(self::$loginPassword);
            $query = $this->db->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
            $query->bind_param("ss", self::$loginEmail, $password);
            $query->execute();
            $user = mysqli_fetch_assoc( $query->get_result());
            if($user){
                $_SESSION['name'] = $user['name'];
                $_SESSION['email'] = self::$loginEmail;
                $_SESSION['loggedin'] = true;
                $_SESSION['success'] = "You are now logged in";
                header('location: index.php');
            }else{
                Validation::addError("login", "Incorrect credentials!");
            }
        }
        $thread = $this->db->thread_id;
        $this->db->kill($thread);
        $this->db->close();
    }

    public function register(){
        $this->registering();
    }

    public function login(){
        $this->tryLogIn();
    }

    public function checkIfAvailable(){
        // first check the database to make sure 
        // a user does not already exist with the same username and/or email
        $user_check_query = $this->db->prepare("SELECT * FROM users WHERE name = ? OR email = ?");
        $user_check_query->bind_param("ss", self::$signUpName, self::$signUpEmail);
        $user_check_query->execute();
        $users = $user_check_query->get_result()->fetch_assoc();
        $user_check_query->close();
        $nameError = false;
        $emailError = false;
        if (isset($users)) { // if user exists
            foreach($users as $key=>$value) {
                if (strtolower($users['name']) === strtolower(self::$signUpName) && !$nameError) {
                    self::addError("signUp", "Name already exists.");
                    $nameError = true;
                };
                if ($users['email'] === self::$signUpEmail && !$emailError) {
                    self::addError("signUp", "Email already exists.");
                    $emailError = true;
                };
            }
        } else if(count(self::$signUpErrors) === 0){
            self::register();
            return true;
        }
    }

    public function registrationForm(){
        self::$signUpName = $_POST['signup-name'];
        self::$signUpEmail = $_POST['signup-email'];
        self::$signUpPassword = $_POST['signup-password'];

        self::sanitize();
        if(self::checkIfAvailable()){
            self::$signUpName ="";
            self::$signUpEmail = "";
            self::$signUpPassword = "";
        }
    }

    public function loginForm(){
        self::$loginEmail = $_POST['login-email'];
        self::$loginPassword = $_POST['login-password'];
        
        self::sanitize();
        self::login();
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

    //Display login and signUp errors
    public static function errors($type){
        if($type === "signUp"){
            $errors = self::$signUpErrors;
        } else {
            $errors = self::$loginErrors;
        }
        if (count($errors) > 0) :?>
            <div class="row justify-content-center">
                <div class="error">
                    <?php foreach ($errors as $error) : ?>
                    <p><?php echo $error ?> </p>
                    <?php endforeach ?>
                </div>
            </div>
        <?php  endif;
    }
};

?>