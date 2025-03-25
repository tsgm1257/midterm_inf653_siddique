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

if (empty($data->category)) {
    echo json_encode(array("message" => "Missing Required Parameters")); // Corrected Message
    exit;
}

$category->category = $data->category;
if ($category->create()) {
    echo json_encode(array("id" => $category->id, "category" => $category->category));
} else {
    echo json_encode(array("message" => "Unable to create category."));
}
?>