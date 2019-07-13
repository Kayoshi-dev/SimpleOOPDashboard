<?php


class Database
{
    public static function getPdo(): PDO {
        $data = parse_ini_file('keys.ini');
        try {
            $dsn = 'mysql:dbname=' . $data['dbname'] . ';host=' . $data['host'];
            $user = $data['user'];
            $password = $data['password'];
            $pdo = new PDO($dsn, $user, $password);
        } catch (PDOException $exception) {
            echo $exception->getMessage();
        }
        return $pdo;
    }
}