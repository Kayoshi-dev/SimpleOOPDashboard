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
            $req = $this->pdo->prepare('INSERT INTO membres(pseudo, pass, email, date_inscription) VALUES (:prenom, :pass, :email, CURDATE())');
            $req->execute(array(':prenom' => $pseudo, ':pass' => $pass, ':email' => $email));
            return $etat = true;
        } catch(PDOException $e) {
            echo $e->getMessage();
            return $etat = false;
        }
    }
}