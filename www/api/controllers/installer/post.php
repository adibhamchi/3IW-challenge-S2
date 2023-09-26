<?php
header("Access-Control-Allow-Origin: http://localhost:667");

header("Access-Control-Allow-Headers: Content-Type, Authorization");

require __DIR__ . "/../../library/json-response.php";
require __DIR__ . "/../../library/request.php";
require __DIR__ . "/../../models/installation.php";

try {
    $json = Request::getJsonBody();

    installation::createConfig($json);
    installation::createDBuser($json);
    installation::createAdmin($json['admin']);
    Response::json(201, [], ["success" => true]);
} catch (PDOException $exception) {
    Response::json(500, [], ["success" => false, "error" => $exception->getMessage()]);
}