<?php

class Request
{
    private const API_KEY = "your-hardcoded-api-key";

    public static function validateAPIKey()    {
        $providedApiKey = self::getHeader('Authorization');

        if ($providedApiKey !== self::API_KEY) {
            header('HTTP/1.0 403 Forbidden');
            echo json_encode(["error" => "Invalid API key"]);
            exit;
        }
    }


    public static function getJsonBody()
    {
        /**
         * Récupérer le body de la requête HTTP
         *
         * @see https://www.php.net/manual/en/function.file-get-contents.php
         * @see https://www.php.net/manual/en/wrappers.php.php
         */

        self::validateAPIKey();
        $rawInput = file_get_contents("php://input");

        /**
         * Déserialiser une chaîne de caractères en structure de données PHP
         *
         * @see https://www.php.net/manual/en/function.json-decode.php
         */
        $json = json_decode($rawInput, true);

        return $json;
    }

    public static function getHeaders()
    {
        return getallheaders();
    }

    public static function getHeader($name, $fallback = "notfound")
    {
        $headers = Request::getHeaders();

        if (!isset($headers[$name])) {
            return $fallback;
        }

        return $headers[$name];
    }
}
