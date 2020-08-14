<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');


include_once "../../config/Database.php";
include_once "../../models/Player.php";


$db = new Database();
$dbh = $db->connect();


$data = json_decode( file_get_contents("php://input"));
$id = htmlspecialchars(strip_tags($data->id));

$player = new Player($dbh, $id, null, null, null);

if($player->delete_player()){
    $player_arr = json_encode(
        array(
            "Message" => "Deleted player",
            array(
                "Name" => $player->name,
                "ID" => $player->id
            )
        )
    );
    print_r($player_arr);
}else{
    echo json_encode(
        array('message' => "player not created")
    );
}
