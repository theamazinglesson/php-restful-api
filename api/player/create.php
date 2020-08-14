<?php

// HEADERS
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');



include_once "../../config/Database.php";
include_once "../../models/Player.php";


$database = new Database();
$dbh = $database->connect();


$data = json_decode(file_get_contents("php://input"));
//htmlspecialchars(strip_tags($this->title));
//$id = htmlspecialchars(strip_tags( $data->id));
$name = htmlspecialchars(strip_tags( $data->name));
$club = htmlspecialchars(strip_tags( $data->club));
$m_value = htmlspecialchars(strip_tags( $data->m_value));

//$player = null;
//if($id || $id != null){
$player = new Player($dbh, null, $name, $club,$m_value);
//}else{
//    $player = new Player($dbh, null, "Kilyon Mbappe", "PSG",255);
//}



if($player->create_player()){
    echo json_encode(
        array(
            'message' => "player created",
            "Player Info" => array(
                "ID" => $player->id,
                "Name" => $player->name,
                "Club" => $player->club,
                "Market Value" => $player->m_value
            )
        )
    );
}else{
    echo json_encode(
        array('message' => "player not created")
    );
}

?>
