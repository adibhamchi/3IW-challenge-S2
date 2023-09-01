<?php


require __DIR__ . "/../library/get-database-connection.php";

class FilmModel
{
    public static function getAll()
    {
        $connection = getDatabaseConnection();
        $query = $connection->query("SELECT * FROM esgi_film;");
        return $query->fetchAll();
    }

    public static function create($json)
    {
        $connection = getDatabaseConnection();
        $query = $connection->prepare("INSERT INTO esgi_film( title, description, year, length, category) VALUES(:title, :description, :year, :length, :category);");
        $query->execute($json);
    }


    public static function deleteById($id)
    {
        $connection = getDatabaseConnection();
        $query = $connection->prepare("DELETE FROM esgi_film WHERE id = :id;");
        $query->execute(
            [
                "id" => $id
            ]
        );
    }

    public static function getById($id)
    {
        $connection = getDatabaseConnection();
        $getUserByIdQuery = $connection->prepare("SELECT * FROM esgi_film WHERE id = :id;");

        $getUserByIdQuery->execute(
            [
                "id" => $id
            ]
        );

        return $getUserByIdQuery->fetch();
    }

    public static function updateById($json)
    {
        $allowedColumns = ["title", "description", "year", "length", "category"];
        $columns = array_keys($json);
        $set = [];

        foreach ($columns as $column) {
            if (!in_array($column, $allowedColumns)) {
                continue;
            }

            $set[] = "$column = :$column";
        }

        $set = implode(", ", $set);
        $sql = "UPDATE esgi_film SET $set WHERE id = :id";
        $connection = getDatabaseConnection();
        $query = $connection->prepare($sql);
        $query->execute($json);
    }
}
