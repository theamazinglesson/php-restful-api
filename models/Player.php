<?php
class Player{
//    DATABASE CONNECTIONS
    private $dbh;
    private $table = "players";


    //    PLAYER INFORMATION'S
    public $id;
    public $name;
    public $club;
    public $m_value;



    /**
     * @param mixed $conn
     */
    public function __construct($dbh, $id, $name, $club, $m_value){
        $this->id = $id;
        $this->name = $name;
        $this->club = $club;
        $this->m_value = $m_value;
        $this->dbh = $dbh;
    }


//    CREATE PLAYER
    public function create_player(){
//        $this->name = $name;
//        $this->id = $id;
//        $this->club = $club;
//        $this->m_value= $m_value;

        //INSERT INTO `players`(`id`, `name`, `club`, `m_value`) VALUES ([value-1],[value-2],[value-3],[value-4])
        $sql = "INSERT INTO " . $this->table . "(name, club, m_value) VALUES (?, ?, ?)";
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindParam(1, $this->name);
        $stmt->bindParam(2, $this->club);
        $stmt->bindParam(3, $this->m_value);
        if($stmt->execute()){
            return true;
        }
        //PRINT ERROR IF SOMETHING GOES WRONG
        printf("Error: %s. \n", $stmt->error);
        return false;
    }


























//    READ  ALL PLAYER INFORMATION
    public function read_player(){
        $sql = "SELECT * FROM " . $this->table;
        $this->dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $stmt = $this->dbh->prepare($sql);

//        $stmt->bindParam(1, $this->id);


        $stmt->execute();
        $result = $stmt->fetchAll();
//        print_r($result);

        //PRINT ERROR IF SOMETHING GOES WRONG
//        printf("Error: %s. \n", $stmt->error);
        return $result;
    }




























//GETTING SINGLE PLAYER
    public function read_single(){
//        $this->id = $id;
        $this->dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $sql = "SELECT * FROM " . $this->table . " WHERE id=?";
//        $this->dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
//        print_r("ID: " . $this->id);

//        print_r($stmt);
        $result = $stmt->fetch();
//        print_r($result);

        return $result;
    }






























//    UPDATE PLAYER
    public function update_player(){
//        UPDATE `players` SET `id`=[value-1],`name`=[value-2],`club`=[value-3],`m_value`=[value-4] WHERE 1
        $sql = "UPDATE " . $this->table . " SET id=:id, name=:name, club=:club, m_value=:m_value WHERE id=:id";
        $stmt = $this->dbh->prepare($sql);



        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':club', $this->club);
        $stmt->bindParam(':m_value', $this->m_value);
        $stmt->execute();
        print_r($sql);



        // EXECUTE QUERY
        if ($stmt->execute()) {
            return true;
        }
        //PRINT ERROR IF SOMETHING GOES WRONG
        printf("Error: %s. \n", $stmt->error);
//
        return false;
    }






























//    DELETE PLAYER
    public function delete_player(){
        $sql = "DELETE FROM " . $this->table . " WHERE id=:id";
        $stmt =$this->dbh->prepare($sql);
        $stmt->bindParam(':id', $this->id);
        if($stmt->execute()){
            return true;
        }
        printf("Error: %s. \n", $stmt->error);
        return false;
    }
}

?>
