<?php
// authors/create.php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/Database.php';
include_once '../../models/Author.php';

$database = new Database();
$db = $database->getConnection();

$author = new Author($db);
$data = json_decode(file_get_contents("php://input"));

if (!empty($data->author)) {
    $author->author = $data->author;
    if ($author->create()) {
        http_response_code(201);
        echo json_encode(array("message" => "Author was created.", "id" => $author->id, "author" => $author->author)); //added id and author
    } else {
        http_response_code(503);
        echo json_encode(array("message" => "Unable to create author."));
    }
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Unable to create author. Data is incomplete."));
}
?>