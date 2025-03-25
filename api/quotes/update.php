<?php
// quotes/update.php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/Database.php';
include_once '../../models/Quote.php';

$database = new Database();
$db = $database->getConnection();

$quote = new Quote($db);

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->id) && !empty($data->quote) && !empty($data->author_id) && !empty($data->category_id)) {
    $quote->id = $data->id;
    $quote->quote = $data->quote;
    $quote->author_id = $data->author_id;
    $quote->category_id = $data->category_id;

    if ($quote->update()) {
        http_response_code(200);
        echo json_encode(array("message" => "Quote was updated.", "id" => $quote->id, "quote" => $quote->quote, "author_id" => $quote->author_id, "category_id" => $quote->category_id));
    } else {
        http_response_code(500);
        echo json_encode(array("message" => "Unable to update quote."));
    }
} elseif (!empty($data->id) && empty($quote->readOne($data->id)->rowCount())) {
    http_response_code(404);
    echo json_encode(array("message" => "No Quotes Found"));
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Missing Required Parameters"));
}
?>