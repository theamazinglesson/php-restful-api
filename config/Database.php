<?php

class Database {
//$dbh = new PDO('mysql:host=localhost;dbname=test', $user, $pass);



    private $host = "localhost";
    private $dbname = "player_crud";
    private $user = "shayon";
    private $password = "Shayon1234";
//    private $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->dbname;
//    private $dsn = "mysql:host=localhost;dbname=player_crud";


    private $dbh;



    public function connect(){
        $this->dsn = "mysql:host=" . $this->host . ";dbname=" . $this->dbname;
        $this->dbh = null;


        try {
            $this->dbh = new PDO($this->dsn, $this->user, $this->password);
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            ?>
            json_encode("db connected")
            <?php
        }catch (PDOException $e){
            echo 'Connection failed: ' . $e->getMessage();
        }
        return $this->dbh;
    }

}


//$db = new Database();
//$db->connect();

?>