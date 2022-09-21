<?php

class EleveManager {
 
    public function __construct($db) {
        $this -> setDb($db);
    }

	////////// DEBUG ////////////

    public function displayProperties() {
        var_dump(get_object_vars($this));
    }

    public function displayMethods() {
        var_dump(get_class_methods($this));
    }

    ////////// FUNCTION ////////////

    private $_db;

    public function setDb(PDO $dbh) {
        $this -> _db = $dbh;
    }

    public function get_eleve_from_ecole_id($id) {
        $sql = "SELECT id_eleve, nom_eleve FROM eleve WHERE id_ecole = :id";
        $stmt = $this -> _db -> prepare($sql);
        $stmt -> bindParam(':id', $id);

        $stmt -> execute();
        $result = null;
        
        while ($row = $stmt -> fetch(PDO::FETCH_ASSOC)) {
            $result[] = $row;
        }
        return $result;
    }

    public function getEleve($id = '') {
        if(empty($id)) {
            $sql = "SELECT id_eleve, nom_eleve FROM eleve";
            $stmt = $this -> _db -> prepare($sql);
        }
        elseif (is_numeric($id)) {
            $sql = "SELECT id_eleve, nom_eleve FROM eleve WHERE id_eleve = :id";
            $stmt = $this -> _db -> prepare($sql);
            $stmt -> bindParam(':id', $id);
        }
        $stmt -> execute();
        $result = null;
        while ($row = $stmt -> fetch(PDO::FETCH_ASSOC)) {
            $result[] = $row;
        }
        return $result;
    }

    public function getSizeByEcole($id) {
        $sql = "SELECT COUNT(id_eleve) as size FROM eleve WHERE id_ecole = :id";
        $stmt = $this -> _db -> prepare($sql);
        $stmt -> bindParam(':id', $id);

        $stmt -> execute();
        return $stmt -> fetch(PDO::FETCH_ASSOC)['size'];
    }

    public function getSportiveSizeByEcole($id) {
        $sql = "SELECT COUNT(E.id_eleve) as size
         FROM eleve E
         INNER JOIN pratiquer P
            ON P.id_eleve = E.id_eleve
         WHERE id_ecole = :id
         GROUP BY E.id_eleve";
        $stmt = $this -> _db -> prepare($sql);
        $stmt -> bindParam(':id', $id);

        $stmt -> execute();
        $result = null;
        while ($row = $stmt -> fetch(PDO::FETCH_ASSOC)) {
            $result[] = $row;
        }

        // occurs when no student practice a sport
        if($result == false)
            return 0;

        return count($result);
    }

}