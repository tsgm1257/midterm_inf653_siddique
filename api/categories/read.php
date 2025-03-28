<?php
// categories/read.php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../../config/Database.php';
include_once '../../models/Category.php';

$database = new Database();
$db = $database->getConnection();

$category = new Category($db);

$stmt = $category->read();
$num = $stmt->rowCount();

if ($num > 0) {
    $categories_arr = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $category_item = array(
            "id" => $id,
            "category" => $category
        );
        array_push($categories_arr, $category_item); // removed records index
    }
    echo json_encode($categories_arr);
} else {
    echo json_encode(array("message" => "No categories found."));
}
?>