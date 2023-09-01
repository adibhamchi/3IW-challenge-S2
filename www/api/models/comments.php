<?php

require __DIR__ . "/../library/get-database-connection.php";

class CommentModel
{
    public static function getAll()
    {
        $connection = getDatabaseConnection();
        $query = $connection->query("SELECT * FROM esgi_comment;");
        return $query->fetchAll();
    }

    public static function create($json)
    {
        $connection = getDatabaseConnection();
        $query = $connection->prepare("INSERT INTO esgi_comment(film_id, user_id, content) VALUES(:film_id, :user_id, :content);");
        $query->bindValue(':film_id', $json['film_id']);
        $query->bindValue(':user_id', $json['user_id']);
        $query->bindValue(':content', $json['content']);
        $query->execute();
    }

    public static function updateById($json)
    {
        $allowedColumns = ["postId", "name", "email"];
        $columns = array_keys($json);
        $set = [];

        foreach ($columns as $column) {
            if (!in_array($column, $allowedColumns)) {
                continue;
            }

            $set[] = "$column = :$column";
        }

        $set = implode(", ", $set);
        $sql = "UPDATE comments SET $set WHERE id = :id";
        $connection = getDatabaseConnection();
        $query = $connection->prepare($sql);
        $query->execute($json);
    }

    public static function deleteById($json)
    {
        $connection = getDatabaseConnection();
        $query = $connection->prepare("DELETE FROM esgi_comment WHERE id = $json;");
        $query->execute();
    }
}
