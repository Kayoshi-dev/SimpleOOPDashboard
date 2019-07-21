<?php


class Database
{
    private static $instance = null;

    public static function getPdo(): PDO {
        if(self::$instance === null) {
            $data = parse_ini_file('keys.ini');
            try {
                $dsn = 'mysql:dbname=' . $data['dbname'] . ';host=' . $data['host'];
                $user = $data['user'];
                $password = $data['password'];
                self::$instance = new PDO($dsn, $user, $password);
            } catch (PDOException $exception) {
                echo $exception->getMessage();
            }
        }
        return self::$instance;
    }
}