<?php
class DBConnection{
    public $db;
    public function Connect(){
        $this->db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
 
         if(mysqli_connect_errno()) {
             exit;
         }
    }

    public function closeConnection(){
        $thread = $this->db->thread_id;
        $this->db->kill($thread);
        $this->db->close();
    }
}