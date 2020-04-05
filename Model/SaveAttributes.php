<?php
require_once("DBConfig.php");

class SaveAttributes{
    public $db;
    function __construct(){
        if(!empty($_POST)){
            self::saveAttributes();
        };
    }

    public function dbConnection(){
        $this->db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

        if(mysqli_connect_errno()) {
            exit;
        }
    }

    public function saveAttributes(){
        //Check if user already has entries in DB table
        $entriesExist = false;
        $this->dbConnection();
        $entry_query = "SELECT * FROM `attributes` WHERE `user_email` ='".$_SESSION['email']."'";
        $entry_query_result = mysqli_query($this->db, $entry_query);
        if($entry_query_result){
            if($entry_query_result->num_rows > 0){
                $entriesExist = true;
            }
        }
        //Ask DB for all attributes (name of attributes)
        $attributes_query = $this->db->query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'magebit' AND TABLE_NAME = 'attributes'");
        while($attributesFromDB = $attributes_query->fetch_assoc()){
            $attributes[] = $attributesFromDB;
        }

        //All values from inputs of the form
        $attributeArray = $_POST["attributeValue"];           
        $userEmail = strval($_SESSION['email']);

        //Deleting attribute id from array received
        array_shift($attributes);
        array_shift($attributes);

        //Check if enries already exist for this user
        if(!$entriesExist){
            $attributeName = "";
            $attributeValue = "";
            //Making string for query
            $attributeName .= "`user_email`,";
            $attributeValue .= "'".$userEmail."',";
            foreach($attributeArray as $key=>$value){
                $attributeName .= "`".$attributes[$key]['COLUMN_NAME']."`,";
                $attributeValue .= "'".$this->db->real_escape_string($value)."',";
            }

            //Removing last comma
            $attributeName = substr($attributeName, 0, -1);
            $attributeValue = substr($attributeValue, 0, -1);
            $sql = "INSERT INTO `attributes` (".$attributeName.") VALUES (".$attributeValue.")";
            mysqli_query($this->db, $sql);
        }



        foreach($attributeArray as $key=>$value){
            $attributeName = $attributes[$key]['COLUMN_NAME'];
            $attributeValue = $this->db->real_escape_string($value);
            $sql = "UPDATE `attributes` SET `".$attributeName ."` = '".$attributeValue."' WHERE `user_email` = '". $userEmail."'";

            mysqli_query($this->db, $sql);
        }

        
        $thread = $this->db->thread_id;
        $this->db->kill($thread);
        $this->db->close();
    }    
}