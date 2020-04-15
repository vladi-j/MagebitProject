<?php
require_once("DBConfig.php");
class Attributes{
    public static $connection;
    public function requestAttributes($userEmail){
        new SaveAttributes();
        self::$connection = new DBConnection;
        self::$connection->Connect();
        //Save names of Attributes(DB column titles)
        $attributes_query = self::$connection->db->query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'magebit' AND TABLE_NAME = 'attributes'");
        while($attributesFromDB = $attributes_query->fetch_assoc()){
            $attributes[] = $attributesFromDB;
        }
        //Place in input what user already has in DB
        $user_check_query = self::$connection->db->prepare("SELECT * FROM attributes WHERE user_email = ?");
        $user_check_query->bind_param("s", $userEmail);
        $user_check_query->execute();
        $attribute = $user_check_query->get_result()->fetch_assoc();
        ?>
        <form id="attribute-form" action="index.php" method="post">
            <?php
            for ($i = 2; $i < count($attributes); $i++) { 
                $attributeName = $attributes[$i]['COLUMN_NAME']; ?>   
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
}
?>