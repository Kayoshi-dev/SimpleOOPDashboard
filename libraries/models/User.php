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

    /**
     * @param string $pseudo
     * @param string $pass
     * @param string $email
     * @param int $id
     * @param string|null $profilePic
     * @param string|null $bannerPic
     * @return bool|string
     */
    public function update(string $pseudo, string $pass, string $email, int $id, ?string $profilePic = null, ?string $bannerPic = null) {
        try {
            $sql = "UPDATE {$this->table} SET pseudo = :pseudo, pass = :pass, email = :email";

            if($profilePic != null) {
                $sql .= ", profilepic = :profilePic";
                $req = $this->pdo->prepare($sql);
                $exec = $req->execute(array(':id' => $id, ':pseudo' => $pseudo, ':pass' => $pass, ':email' => $email, ':profilePic' => $profilePic));
                return $etat = true;
            }

            if($bannerPic != null) {
                $sql .= ", bannerpic = :bannerPic";
                $req = $this->pdo->prepare($sql);
                $exec = $req->execute(array(':id' => $id, ':pseudo' => $pseudo, ':pass' => $pass, ':email' => $email, ':bannerPic', $bannerPic));
                return $etat = true;
            }





        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }
}