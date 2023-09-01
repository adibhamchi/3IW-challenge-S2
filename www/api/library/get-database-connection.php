<?php

function getDatabaseConnection() {
    $driver = "pgsql";

    $databaseName = "esgi";

    $hostName = "localhost";

    $dataSourceName = "$driver:dbname=$databaseName;host=$hostName;port=5432";

    $userName = "esgi";

    $password = "Test1234";

    $options = [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];

    /**
     * Récupérer une connection à une base de données
     * @see https://www.php.net/manual/en/pdo.construct.php
     */
    $connection = new PDO("pgsql:host=database;dbname=esgi;port=5432", "esgi", "Test1234", $options);

    return $connection;
}
