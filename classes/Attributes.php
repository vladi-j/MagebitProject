<?php
require_once("DBConfig.php");
class Attributes{
    public static   $connection,
                    $attributes = array();

    function __construct(){
        if(!empty($_POST)){
            self::saveAttributes();
        };
    }

    public static function attributeNames(){
        
        self::$connection = new DBConnection;
        self::$connection->Connect();

        //Save names of Attributes(DB column titles)
        $attributes_query = self::$connection->db->query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'magebit' AND TABLE_NAME = 'attributes'");
        
        self::$attributes = array();
        while($attributesFromDB = $attributes_query->fetch_assoc()){
            self::$attributes[] = $attributesFromDB;
        }
    }

    public function requestAttributes($userEmail){
        self::attributeNames();
        //Place in input what user already has in DB
        $user_check_query = self::$connection->db->prepare("SELECT * FROM attributes WHERE user_email = ?");
        $user_check_query->bind_param("s", $userEmail);
        $user_check_query->execute();
        $attribute = $user_check_query->get_result()->fetch_assoc();
        ?>
        <form id="attribute-form" action="saveAttributes" method="post">
            <?php
            for ($i = 2; $i < count(self::$attributes); $i++) { 
                $attributeName = self::$attributes[$i]['COLUMN_NAME']; ?>   
                <h4 class="attributeName">
                    <?php echo $attributeName; ?>
                </h4>
                <input type="text" name="attributeValue[]"  value="<?php echo $attribute[$attributeName]; ?>">
            <?php };
            ?>
            <div class="row justify-content-center">
                <button type="submit" class="btn btn-lg profile-button" name="saveAttributes">Save</button>
            </div>
        </form>
        <?php

        self::$connection->closeConnection();
    }

    public static function saveAttributes(){
        //Check if user already has entries in DB table
        self::attributeNames();
        $entriesExist = false;
        $entry_query = "SELECT * FROM `attributes` WHERE `user_email` ='".$_SESSION['email']."'";
        $entry_query_result = mysqli_query(self::$connection->db, $entry_query);
        if($entry_query_result){
            if($entry_query_result->num_rows > 0){
                $entriesExist = true;
            }
        }

        //All values from inputs of the form
        $attributeArray = $_POST["attributeValue"];           
        $userEmail = strval($_SESSION['email']);

        //Deleting attribute id from array received
        array_shift(self::$attributes);
        array_shift(self::$attributes);

        //Check if entries already exist for this user
        if(!$entriesExist){
            $attributeName = "";
            $attributeValue = "";
            //Making string for query
            $attributeName .= "`user_email`,";
            $attributeValue .= "'".$userEmail."',";
            foreach($attributeArray as $key=>$value){
                $attributeName .= "`".self::$attributes[$key]['COLUMN_NAME']."`,";
                $attributeValue .= "'".self::$connection->db->real_escape_string($value)."',";
            }

            //Removing last comma
            $attributeName = substr($attributeName, 0, -1);
            $attributeValue = substr($attributeValue, 0, -1);
            $sql = "INSERT INTO `attributes` (".$attributeName.") VALUES (".$attributeValue.")";
            mysqli_query(self::$connection->db, $sql);
        }

        foreach($attributeArray as $key=>$value){
            $attributeName = self::$attributes[$key]['COLUMN_NAME'];
            $attributeValue = self::$connection->db->real_escape_string($value);
            $sql = "UPDATE `attributes` SET `".$attributeName ."` = '".$attributeValue."' WHERE `user_email` = '". $userEmail."'";

            mysqli_query(self::$connection->db, $sql);
        }

        self::$connection->closeConnection();
    }


}
?>