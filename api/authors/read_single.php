<?php
// authors/read_single.php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../../config/Database.php';
include_once '../../models/Author.php';

$database = new Database();
$db = $database->getConnection();

$author = new Author($db);
$author->id = isset($_GET['id']) ? $_GET['id'] : die();

$author->readSingle();

if ($author->author != null) {
    $author_arr = array(
        "id" => $author->id,
        "author" => $author->author
    );
    http_response_code(200);
    echo json_encode($author_arr);
} else {
    http_response_code(404);
    echo json_encode(array("message" => "Author not found."));
}
?>