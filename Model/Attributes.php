<?php
require_once("DBConfig.php");
class Attributes{
    public $db;

    public function dbConnection(){
        $this->db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

        if(mysqli_connect_errno()) {
            exit;
        }
    }
    
    public function requestAttributes($userEmail){
        new SaveAttributes();
        $this->dbConnection();
        $attributes_query = $this->db->query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'magebit' AND TABLE_NAME = 'attributes'");
        while($attributesFromDB = $attributes_query->fetch_assoc()){
            $attributes[] = $attributesFromDB;
        }
        $user_check_query = $this->db->prepare("SELECT * FROM attributes WHERE user_email = ?");
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
        $thread = $this->db->thread_id;
        $this->db->kill($thread);
        $this->db->close();
    }
}
?>