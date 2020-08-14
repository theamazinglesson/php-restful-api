<?php
//https://www.php.net/manual/en/function.file-get-contents.php
//$data = json_decode(file_get_contents("php://input"));
//file_get_contents() is the preferred way to read the contents of a file into a string.
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');


include_once "../../config/Database.php";
include_once "../../models/Player.php";


$db = new Database();
$dbh = $db->connect();

$data = json_decode(file_get_contents("php://input"));
$id = htmlspecialchars(strip_tags( $data->id));
$name = htmlspecialchars(strip_tags( $data->name));
$club = htmlspecialchars(strip_tags( $data->club));
$m_value = htmlspecialchars(strip_tags( $data->m_value));

print_r(array($id, $name, $club, $m_value));

$player  = new Player($dbh, $id, $name, $club, $m_value);



$player_arr  =
    array(
        "ID" => $player->id,
        "Name" => $player->name,
        "Club" => $player->club,
        "Market Value" => $player->m_value
    );



// UPDATE POST
if ($player->update_player()) {
    echo json_encode(
        array(
            'message' => "post updated",
            $player_arr
            )
    );
} else {
    echo json_encode(
        array('message' => "post not updated")
    );
}


//print_r($player_arr);