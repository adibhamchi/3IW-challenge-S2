<?php

require_once __DIR__ . "/../../library/json-response.php";
require_once __DIR__ . "/../../models/films.php";
require_once __DIR__ . "/../../library/request.php";

try {
    $json = Request::getJsonBody();
    $film = FilmModel::getById($json["id"]);

//    var_dump($film);

    if (!$film) {
        Response::json(404, [], ["success" => false, "error" => "Movie not found"]);
        die();
    }

    FilmModel::deleteById($json["id"]);
    Response::json(200, [], ["success" => true]);
} catch (PDOException $exception) {
    Response::json(500, [], ["success" => false, "error" => $exception->getMessage()]);
}