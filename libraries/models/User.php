<?php

namespace Models;

require_once ('Model.php');

use PDOException;

class User extends Model {

    protected $table = "membres";

    public function add(string $pseudo, string $pass, string $email): bool {
        try {
            $req = $this->pdo->prepare('INSERT INTO membres(pseudo, pass, email, date_inscription) VALUES (:prenom, :pass, :email, CURDATE())');
            $req->execute(array(':prenom' => $pseudo, ':pass' => $pass, ':email' => $email));
            return true;
        } catch(PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}