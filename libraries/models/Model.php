<?php


namespace Models;

require('libraries/Database.php');

use PDOException;

abstract class Model
{
    protected $pdo;
    protected $table;

    public function __construct()
    {
        $this->pdo = \Database::getPdo();
    }

    public function show(?string $order = ""): array {
        $sql = "SELECT * FROM {$this->table}";

        if($order) {
            $sql .= " ORDER BY " . $order;
        }

        $result = $this->pdo->query($sql, \PDO::FETCH_OBJ);
//        foreach ($result as $resultat) {
//            echo json_encode($resultat, JSON_PRETTY_PRINT) . '<br>';
//        }

        $data = $result->fetchAll();

//        var_dump($data);
        return $data;
    }

    public function findById(int $id) {
        try {
            $result = $this->pdo->query("SELECT * FROM {$this->table} WHERE id = :id");
            $result->bindParam(':id', $id);
            $data = $result->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        return $data;
    }

    public function delete(int $id) {
        try {
            $req = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = :id");
            $req->bindValue(':id', $id, \PDO::PARAM_INT);
            $req->execute();
            return $etat = true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return $etat = false;
        }
    }
}