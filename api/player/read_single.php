<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');


include_once "../../config/Database.php";
include_once "../../models/Player.php";


$db = new Database();
$dbh = $db->connect();

$read_single_player = new Player($dbh, 10, null, null, null);


$player_result = $read_single_player->read_single();
//print_r($player_result);


$player_arr = json_encode(
    array(
        "Name" => $player_result->name,
        "Club" => $player_result->club,
        "Market Value" => $player_result->m_value,
    )
);

print_r($player_arr);



?>
