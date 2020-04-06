<?php
class Login{
    public function tryLogIn($db, $email, $password){
        if(count(Validation::$loginErrors) === 0){
            $password = md5($password);
            $query = $db->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
            $query->bind_param("ss", $email, $password);
            $query->execute();
            $user = mysqli_fetch_assoc( $query->get_result());
            if($user){
                $_SESSION['name'] = $user['name'];
                $_SESSION['email'] = $email;
                $_SESSION['loggedin'] = true;
                $_SESSION['success'] = "You are now logged in";
                header('location: index.php');
            }else{
                Validation::addError("login", "Incorrect credentials!");
            }
        }
        $thread = $db->thread_id;
        $db->kill($thread);
        $db->close();
    }
}