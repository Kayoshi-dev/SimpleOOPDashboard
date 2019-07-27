<?php


namespace Models;


use PDOException;

class Widget extends Model {

    protected $table = "widget";

    /**
     * Return an array containing all the available widgets
     * @return array
     */
    public function getWidget() {
        $sql = "SELECT * FROM {$this->table}";
        $result = $this->pdo->query($sql, \PDO::FETCH_OBJ);
        $data = $result->fetchAll();
        return $data;
    }

    /**
     * Update the active state of a widget
     * @param int $appid
     * @param int $updateEtat
     */
    public function updateWidget(int $appid, int $updateEtat):void {
        if($updateEtat == 1){
            $updateEtat = 0;
        } else {
            $updateEtat = 1;
        }
        $sql = "UPDATE {$this->table} SET active = :active WHERE id = :id";
        $val = array(':active' => $updateEtat, ':id' => $appid);
        $req = $this->pdo->prepare($sql);
        $req->execute($val);
    }

    /**
     * Return an array with all the widget with an active value of 1
     * @return array
     */
    public function showActiveWidget() {
        $sql = "SELECT * FROM {$this->table} WHERE active = 1";
        $result = $this->pdo->query($sql, \PDO::FETCH_OBJ);
        $data = $result->fetchAll();
        return $data;
    }
}