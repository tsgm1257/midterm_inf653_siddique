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

if (empty($data->author)) {
    echo json_encode(array("message" => "Missing Required Parameters"));
    exit;
}

$author->author = $data->author;
if ($author->create()) {
    echo json_encode(array("id" => $author->id, "author" => $author->author));
} else {
    echo json_encode(array("message" => "Unable to create author."));
}
?>