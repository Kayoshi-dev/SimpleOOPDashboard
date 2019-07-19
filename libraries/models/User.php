<?php

namespace Models;

require_once ('Model.php');

use PDOException;

class User extends Model {

    protected $table = "membres";

    /**
     * Ajoute un utilisateur à la base de donnée et renvoie un booléen
     *
     * @param string $pseudo
     * @param string $pass
     * @param string $email
     * @return bool
     */
    public function add(string $pseudo, string $pass, string $email): bool {

        if($pseudo == null || $pass == null || $email == null) {
            die('Merci de remplir les champs indiqués');
        }

        try {
            $req = $this->pdo->prepare('INSERT INTO membres(pseudo, pass, email, date_inscription) VALUES (:pseudo, :pass, :email, CURDATE())');
            $req->execute(array(':pseudo' => $pseudo, ':pass' => $pass, ':email' => $email));
            return $etat = true;
        } catch(PDOException $e) {
            echo $e->getMessage();
            return $etat = false;
        }
    }

    public function update(string $pseudo, string $pass, string $email, int $id, ?string $profilePic = '') {
        try {
            $req = $this->pdo->prepare("UPDATE {$this->table} SET pseudo = :pseudo, pass = :pass, email = :email, profilepic = :profilePic WHERE id = :id");
            $req->execute(array(':id' => $id, ':pseudo' => $pseudo, ':pass' => $pass, ':email' => $email, ':profilePic' => $profilePic));
            return $etat = true;
        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }
}