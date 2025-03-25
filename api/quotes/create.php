<?php
// quotes/create.php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/Database.php';
include_once '../../models/Quote.php';
include_once '../../models/Author.php';
include_once '../../models/Category.php';

$database = new Database();
$db = $database->getConnection();

$quote = new Quote($db);
$author_check = new Author($db);
$category_check = new Category($db);
$data = json_decode(file_get_contents("php://input"));

if (empty($data->quote) || empty($data->author_id) || empty($data->category_id)) {
    http_response_code(400);
    echo json_encode(array("message" => "Missing Required Parameters"));
    exit;
}

$author_check->id = $data->author_id;
$author_check->readSingle();

if($author_check->author == null){
    http_response_code(404);
    echo json_encode(array("message" => "author_id Not Found"));
    exit;
}

$category_check->id = $data->category_id;
$category_check->readSingle();

if($category_check->category == null){
    http_response_code(404);
    echo json_encode(array("message" => "category_id Not Found"));
    exit;
}

$quote->quote = $data->quote;
$quote->author_id = $data->author_id;
$quote->category_id = $data->category_id;

if ($quote->create()) {
    http_response_code(201);
    echo json_encode(array("id" => $quote->id, "quote" => $quote->quote, "author_id" => $quote->author_id, "category_id" => $quote->category_id)); //removed message.
} else {
    http_response_code(503);
    echo json_encode(array("message" => "Unable to create quote."));
}

?>