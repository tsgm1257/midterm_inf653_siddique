<?php
// quotes/read_single.php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../../config/Database.php';
include_once '../../models/Quote.php';

$database = new Database();
$db = $database->getConnection();

$quote = new Quote($db);
$quote->id = isset($_GET['id']) ? $_GET['id'] : die();

$quote->readSingle();

if ($quote->quote != null) {
    $quote_arr = array(
        "id" => $quote->id,
        "quote" => $quote->quote,
        "author" => $quote->author,
        "category" => $quote->category
    );
    echo json_encode($quote_arr);
} else {
    echo json_encode(array("message" => "Quote not found."));
}
?>