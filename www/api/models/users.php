<?php

require __DIR__ . "/../library/get-database-connection.php";

class UserModel
{
//    public static function getAll()
//    {
//        $connection = getDatabaseConnection();
//
//        $getUsersQuery = $connection->query("SELECT * FROM users");
//
//        $users = $getUsersQuery->fetchAll();
//
//        return $users;
//    }
//
//    public static function create($user)
//    {
//        $connection = getDatabaseConnection();
//        $createUserQuery = $connection->prepare("INSERT INTO users(name, username, email, phone, website) VALUES(:name, :username, :email, :phone, :website);");
//        $createUserQuery->execute($user);
//    }
//
    public static function getById($id)
    {
        $connection = getDatabaseConnection();
        $getUserByIdQuery = $connection->prepare("SELECT * FROM esgi_user WHERE id = :id;");

        $getUserByIdQuery->execute(
            [
            "id" => $id
            ]
        );

        return $getUserByIdQuery->fetch();
    }
//
//    public static function getByEmail($email)
//    {
//        $connection = getDatabaseConnection();
//        $getUserByIdQuery = $connection->prepare("SELECT * FROM users WHERE email = :email;");
//        $getUserByIdQuery->execute(["email" => $email]);
//
//        return $getUserByIdQuery->fetch();
//    }
//
//    public static function getByToken($token)
//    {
//        $connection = getDatabaseConnection();
//        $getUserByIdQuery = $connection->prepare("SELECT * FROM users WHERE token = :token;");
//        $getUserByIdQuery->execute(["token" => $token]);
//
//        return $getUserByIdQuery->fetch();
//    }
//
    public static function deleteById($user)
    {
        $connection = getDatabaseConnection();
        $deleteByIdQuery = $connection->prepare("DELETE FROM esgi_user WHERE id = :id;");
        $deleteByIdQuery->execute($user);
    }

    public static function updateById($json)
    {
        $allowedColumns = ["firstname", "lastname", "email", "pwd", "country", "status", "token"];
        $columns = array_keys($json);
        $set = [];

        foreach ($columns as $column) {
            if (!in_array($column, $allowedColumns)) {
                continue;
            }

            $set[] = "$column = :$column";
        }

        $set = implode(", ", $set);
        $sql = "UPDATE esgi_user SET $set WHERE id = :id";
        $connection = getDatabaseConnection();
        $query = $connection->prepare($sql);
        $query->execute($json);
    }
}
