<?php
// authors/read.php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../../config/Database.php';
include_once '../../models/Author.php';

$database = new Database();
$db = $database->getConnection();

$author = new Author($db);

$stmt = $author->read();
$num = $stmt->rowCount();

if ($num > 0) {
    $authors_arr = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $author_item = array(
            "id" => $id,
            "author" => $author
        );
        array_push($authors_arr, $author_item); //changed to push directly to the array
    }
    http_response_code(200);
    echo json_encode($authors_arr); //removed records index
} else {
    http_response_code(404);
    echo json_encode(array("message" => "No authors found."));
}
?>