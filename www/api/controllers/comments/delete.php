<?php

require_once __DIR__ . "/../../library/json-response.php";
require_once __DIR__ . "/../../library/request.php";
require_once __DIR__ . "/../../models/comments.php";

try {
    $id = $_GET['id'];
    CommentModel::deleteById($id);
    Response::json(200, [], [ "success" => true ]);
} catch (PDOException $exception) {
    Response::json(500, [], ["success" => false, "error" => $exception->getMessage()]);
}
