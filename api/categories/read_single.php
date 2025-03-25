<?php
// categories/read_single.php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../../config/Database.php';
include_once '../../models/Category.php';

$database = new Database();
$db = $database->getConnection();

$category = new Category($db);
$category->id = isset($_GET['id']) ? $_GET['id'] : die();

$category->readSingle();

if ($category->category != null) {
    $category_arr = array(
        "id" => $category->id,
        "category" => $category->category
    );
    echo json_encode($category_arr);
} else {
    echo json_encode(array("message" => "category_id Not Found")); // changed message
}
?>