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

    public function doCommand(int $id) {
        if($id == 1) {
            $sql = "SELECT COUNT(*) FROM membres";
            $result = $this->pdo->query($sql);
            $data = $result->fetch();
            return $data[0] . ' membres inscrit sur le site depuis son lancement!';
        }

        else if($id == 2) {
            $sql = "SELECT pseudo FROM membres WHERE id = (SELECT MAX(id) FROM membres)";
            $result = $this->pdo->query($sql);
            $data = $result->fetch();
            return 'Le dernier membre inscrit est : <b>' . $data[0] . '</b> !';
        }

        else if($id == 3) {
            return 'Nous sommes le : ' . date('d-m-Y');
        }

        else if($id == 4) {
            // Paris
            $meteoUrl = 'http://api.openweathermap.org/data/2.5/forecast?id=6455259&APPID=a1147b452588539716686964de740e07';
            $meteoJson = file_get_contents($meteoUrl);
            $meteoArray = json_decode($meteoJson, 'True');
            $city = $meteoArray['city']['name'];
            $meteo = $meteoArray['list'][0]['weather'][0]['main'];
            $temp = $meteoArray['list'][0]['main']['temp'] - 273.15;
            $data = [
                'Ville' => $city,
                'Meteo' => $meteo,
                'Temperature' => $temp
            ];
            return 'Ville de : ' . $data['Ville'] . '<br>' . 'Il fait du : ' . $data['Meteo'] . '<br>' . 'Il fait : ' . $data['Temperature'] . ' degrés';
        }

        else if ($id == 5) {
            return
                '
                <form action="" id="formLinkShtr" method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="url" placeholder="Insérer un lien" aria-label="Recipient\'s username" aria-describedby="button-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit" id="sendUrl">✔️</button>
                        </div>
                    </div>
                </form>
                <p>Votre lien raccourci : <span id="linkShtr"></span></p>
                ';
        } else if ($id == 6) {
            if($_SERVER['REMOTE_ADDR'] == '::1') {
                $ip = long2ip(rand(0, "4294967295"));
            } else {
                $ip = $_SERVER['REMOTE_ADDR'];
            }
            $locUrl = 'http://ip-api.com/json/' . $ip;
            $locJson = file_get_contents($locUrl);
            $locArray = json_decode($locJson, 'True');
            if(isset($locArray['city']) && isset($locArray['regionName']) && isset($locArray['country'])) {
                $city = $locArray['city'];
                $regionName = $locArray['regionName'];
                $pays = $locArray['country'];
                $data = [
                    'Ville' => $city,
                    'Region' => $regionName,
                    'Pays' => $pays
                ];

                return 'Localisation : ' . $data['Ville'] . '<br>'
                    . 'dans la région de : ' . $data['Region'] . '<br>'
                    . ' en ' . $data['Pays'];
            } else {
                return 'Erreur dans la génération de l\'IP';
            }
        }
    }
}