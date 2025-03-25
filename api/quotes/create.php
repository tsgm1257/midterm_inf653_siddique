<?php
// quotes/create.php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/Database.php';
include_once '../../models/Quote.php';

$database = new Database();
$db = $database->getConnection();

$quote = new Quote($db);
$data = json_decode(file_get_contents("php://input"));

if (!empty($data->quote) && !empty($data->author_id) && !empty($data->category_id)) {
    $quote->quote = $data->quote;
    $quote->author_id = $data->author_id;
    $quote->category_id = $data->category_id;
    if ($quote->create()) {
        http_response_code(201);
        echo json_encode(array("message" => "Quote was created."));
    } else {
        http_response_code(503);
        echo json_encode(array("message" => "Unable to create quote."));
    }
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Unable to create quote. Data is incomplete."));
}
?>