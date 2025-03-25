<?php
// quotes/delete.php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/Database.php';
include_once '../../models/Quote.php';

$database = new Database();
$db = $database->getConnection();

$quote = new Quote($db);
$data = json_decode(file_get_contents("php://input"));

$quote->id = $data->id;

if ($quote->delete()) {
    http_response_code(200);
    echo json_encode(array("message" => "Quote was deleted."));
} else {
    http_response_code(503);
    echo json_encode(array("message" => "Unable to delete quote."));
}
?>