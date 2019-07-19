<?php


namespace Models;

require('libraries/Database.php');

use PDOException;

abstract class Model
{
    protected $pdo;
    protected $table;

    /**
     * Model constructor.
     */
    public function __construct()
    {
        $this->pdo = \Database::getPdo();
    }

    /**
     * Renvoi un tableau contenant les infos de tout les utilisateurs
     *
     * @param string|null $order
     * @return array
     */
    public function show(?string $order = null): array {
        $sql = "SELECT * FROM {$this->table}";
        if($order) {
            $sql .= " ORDER BY " . $order;
        }
        $result = $this->pdo->query($sql, \PDO::FETCH_OBJ);
        $data = $result->fetchAll();
        return $data;
    }

    /**
     * Renvoi un tableau contenant les informations d'un utilisateur en particulier
     *
     * @param int $id
     * @return array
     */
    public function findById(int $id) {
        try {
            $sql = "SELECT * FROM {$this->table} WHERE id = :id";
            $req = $this->pdo->prepare($sql);
            $req->bindValue(':id', $id, \PDO::PARAM_INT);
            $req->execute();
            $data = $req->fetch(\PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $data;
    }

    /**
     * Supprime l'utilisateur possédant l'ID correspondant
     *
     * @param int $id
     * @return bool
     */
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