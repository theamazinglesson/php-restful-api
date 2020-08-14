<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');


include_once "../../config/Database.php";
include_once "../../models/Player.php";


$db = new Database();
$dbh = $db->connect();
$player = new Player($dbh, null, null, null, null);

$player_result = $player->read_player();


$count = count($player_result);
print_r("COUNT: " . $count);


$i = 0;
while($i < $count){
    $player_arr = json_encode(
        array(
            "name" => $player_result[$i]->name,
            "id" => $player_result[$i]->id,
            "club" => $player_result[$i]->club,
            "m_value" => $player_result[$i]->m_value
        )
    );
    print_r($player_arr);
    $i++;
}






?>
