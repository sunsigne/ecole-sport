<?php

class EnseignerManager {
 
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

    public function get_sport_in_enseigner_from_ecole_id($id_ecole, $id_sport = '') {
        if(empty($id_sport)) {
            $sql = "SELECT E.id_sport, S.nom_sport
            FROM enseigner E
            INNER JOIN sport S
               ON E.id_sport = S.id_sport
            WHERE id_ecole = :id_ecole";
           $stmt = $this -> _db -> prepare($sql);
           $stmt -> bindParam(':id_ecole', $id_ecole);
        }

        elseif (is_numeric($id_sport)) {
            $sql = "SELECT E.id_sport, S.nom_sport
            FROM enseigner E
            INNER JOIN sport S
               ON E.id_sport = S.id_sport
            WHERE id_ecole = :id_ecole
            AND E.id_sport = :id_sport";
           $stmt = $this -> _db -> prepare($sql);
           $stmt -> bindParam(':id_ecole', $id_ecole);
           $stmt -> bindParam(':id_sport', $id_sport);
        }

        $stmt -> execute();
        $result = null;
        
        while ($row = $stmt -> fetch(PDO::FETCH_ASSOC)) {
            $result[] = $row;
        }
        return $result;
    }

    public function getSizeByEcole($id) {
        $sql = "SELECT COUNT(id_sport) as size FROM enseigner WHERE id_ecole = :id";
        $stmt = $this -> _db -> prepare($sql);
        $stmt -> bindParam(':id', $id);

        $stmt -> execute();
        return $stmt -> fetch(PDO::FETCH_ASSOC)['size'];
    }

}