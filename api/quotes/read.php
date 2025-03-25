<?php
// quotes/read.php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../../config/Database.php';
include_once '../../models/Quote.php';

$database = new Database();
$db = $database->getConnection();

$quote = new Quote($db);

$id = isset($_GET['id']) ? $_GET['id'] : null;
$author_id = isset($_GET['author_id']) ? $_GET['author_id'] : null;
$category_id = isset($_GET['category_id']) ? $_GET['category_id'] : null;

if ($id) {
    $stmt = $quote->readOne($id);
    $num = $stmt->rowCount();

    if ($num > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        extract($row);
        $quote_item = array(
            "id" => $id,
            "quote" => $quote,
            "author" => $author,
            "category" => $category
        );
        echo json_encode($quote_item);
    } else {
        echo json_encode(array("message" => "No Quotes Found"));
    }
} elseif ($author_id && $category_id) {
    $stmt = $quote->readByAuthorAndCategory($author_id, $category_id);
    $num = $stmt->rowCount();
    if ($num > 0) {
        $quotes_arr = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $quote_item = array(
                "id" => $id,
                "quote" => $quote,
                "author" => $author,
                "category" => $category
            );
            array_push($quotes_arr, $quote_item);
        }
        echo json_encode($quotes_arr);
    } else {
        echo json_encode(array("message" => "No Quotes Found"));
    }
} elseif ($author_id) {
    $stmt = $quote->readByAuthor($author_id);
    $num = $stmt->rowCount();
    if ($num > 0) {
        $quotes_arr = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $quote_item = array(
                "id" => $id,
                "quote" => $quote,
                "author" => $author,
                "category" => $category
            );
            array_push($quotes_arr, $quote_item);
        }
        echo json_encode($quotes_arr);
    } else {
        echo json_encode(array("message" => "No Quotes Found"));
    }
} elseif ($category_id) {
    $stmt = $quote->readByCategory($category_id);
    $num = $stmt->rowCount();
    if ($num > 0) {
        $quotes_arr = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $quote_item = array(
                "id" => $id,
                "quote" => $quote,
                "author" => $author,
                "category" => $category
            );
            array_push($quotes_arr, $quote_item);
        }
        echo json_encode($quotes_arr);
    } else {
        echo json_encode(array("message" => "No Quotes Found"));
    }
} else {
    $stmt = $quote->read();
    $num = $stmt->rowCount();

    if ($num > 0) {
        $quotes_arr = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $quote_item = array(
                "id" => $id,
                "quote" => $quote,
                "author" => $author,
                "category" => $category
            );
            array_push($quotes_arr, $quote_item);
        }
        echo json_encode($quotes_arr);
    } else {
        echo json_encode(array("message" => "No Quotes Found"));
    }
}
?>