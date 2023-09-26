<?php

require_once __DIR__ . "/../../library/json-response.php";
require_once __DIR__ . "/../../library/request.php";
require_once __DIR__ . "/../../models/users.php";
try {
    $json = Request::getJsonBody();
    UserModel::updateById($json);
    Response::json(200, [], ["success" => true, "json" => $json]);
} catch (PDOException $exception) {
    Response::json(500, [], ["success" => false, "error" => $exception->getMessage()]);
}