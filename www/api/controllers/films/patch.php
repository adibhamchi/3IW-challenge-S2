<?php

require __DIR__ . "/../../library/json-response.php";
require __DIR__ . "/../../library/request.php";
require __DIR__ . "/../../models/films.php";
try {
    $json = Request::getJsonBody();
    FilmModel::updateById($json);
    Response::json(200, [], ["success" => true, "json" => $json]);
} catch (PDOException $exception) {
    Response::json(500, [], ["success" => false, "error" => $exception->getMessage()]);
}