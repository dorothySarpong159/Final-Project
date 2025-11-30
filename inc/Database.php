<?php
//defined class called Database
class Database{
    //Database information
    private $host = "172.31.22.43";
    private $db_name = "Dorothy200624161";
    private $db_user = "Dorothy200624161";
    private $password = "0ixjEtPZKD";
    private $conn;

    //Database connection
    public function getConnection(){
         $this->conn = null;
        try{
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->db_user,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>
