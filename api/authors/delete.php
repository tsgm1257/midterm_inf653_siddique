<?php
// authors/delete.php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/Database.php';
include_once '../../models/Author.php';

$database = new Database();
$db = $database->getConnection();

$author = new Author($db);
$data = json_decode(file_get_contents("php://input"));

$author->id = $data->id;

if ($author->delete()) {
    echo json_encode(array("id" => $author->id));
} else {
    echo json_encode(array("message" => "Unable to delete author."));
}
?>