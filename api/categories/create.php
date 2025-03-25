<?php
// categories/create.php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/Database.php';
include_once '../../models/Category.php';

$database = new Database();
$db = $database->getConnection();

$category = new Category($db);
$data = json_decode(file_get_contents("php://input"));

if (!empty($data->category)) {
    $category->category = $data->category;
    if ($category->create()) {
        http_response_code(201);
        echo json_encode(array("message" => "Category was created.", "id" => $category->id, "category" => $category->category)); //added id and category
    } else {
        http_response_code(503);
        echo json_encode(array("message" => "Unable to create category."));
    }
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Unable to create category. Data is incomplete."));
}
?>