<?php
// quotes/read.php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../../config/Database.php';
include_once '../../models/Quote.php';

$database = new Database();
$db = $database->getConnection();

$quote = new Quote($db);

$stmt = $quote->read();
$num = $stmt->rowCount();

if ($num > 0) {
    $quotes_arr = array();
    $quotes_arr["records"] = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $quote_item = array(
            "id" => $id,
            "quote" => $quote,
            "author" => $author,
            "category" => $category
        );
        array_push($quotes_arr["records"], $quote_item);
    }
    http_response_code(200);
    echo json_encode($quotes_arr);
} else {
    http_response_code(404);
    echo json_encode(array("message" => "No quotes found."));
}
?>