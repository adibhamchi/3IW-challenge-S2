<?php
require __DIR__ . "/../library/get-database-connection.php";

class installation
{

    public static function createConfig($config)
    {
        $configFile = __DIR__ . "/../../cms-config/config.json";
        file_put_contents($configFile, json_encode($config));
    }

    public static function createDBuser(array $data): void
    {
        $connection = getDatabaseConnection();

        if (!isset($data['dbUser'], $data['dbUser']['username'], $data['dbUser']['password'])) {
            throw new InvalidArgumentException('Invalid dbUser data');
        }

        $dbUser = $data['dbUser'];

        // Sanitize for posgre
        if (!preg_match('/^\w+$/', $dbUser['username'])) {
            throw new InvalidArgumentException('Invalid username');
        }

        $sql = "SELECT * FROM pg_user WHERE usename = :username";
        $stmt = $connection->prepare($sql);
        $stmt->execute([':username' => $dbUser['username']]);

        if ($stmt->rowCount() == 0) {
            // Sanitize password with ''
            $password = $connection->quote($dbUser['password']);
            $sql = "CREATE USER " . $dbUser['username'] . " WITH PASSWORD " . $password;
            $stmt = $connection->prepare($sql);
            $stmt->execute();
        }
    }







    public static function createAdmin($admin)
    {
        $connection = getDatabaseConnection();
        var_dump($admin); // Debug: check the values

        $createAdminQuery = $connection->prepare("INSERT INTO esgi_user(firstname, lastname, email, pwd, country, status) VALUES(:firstname, :lastname, :email, :pwd, :country, 2);");

        // Validate that the admin array contains all the required keys
        if (!isset($admin['firstname'], $admin['lastname'], $admin['email'], $admin['pwd'], $admin['country'])) {
            throw new InvalidArgumentException('Invalid admin data');
        }

        $adminData = [
            ':firstname' => $admin['firstname'],
            ':lastname' => $admin['lastname'],
            ':email' => $admin['email'],
            ':pwd' => $admin['pwd'],
            ':country' => $admin['country'],
        ];

        $createAdminQuery->execute($adminData);
    }


}