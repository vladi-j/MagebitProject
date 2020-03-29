<?php
class Register{
    public function registering($db, $name, $email, $password){
        $password = md5($password);//encrypt the password before saving in the database

        $query = $db->prepare("INSERT INTO users (name, email, password) VALUES(?, ?, ?)");
        $query->bind_param("sss", $name,  $email, $password);
        $query->execute();
        $_SESSION['name'] = $name;
        $_SESSION['success'] = "You are now logged in";
        header('location: index.php');
        $query->close();
    }
    
}