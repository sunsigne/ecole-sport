<?php

class PratiquerManager {
 
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

    public function get_sport_in_pratiquer_from_eleve_id($id_eleve, $id_sport = '') {
        if(empty($id_sport)) {
            $sql = "SELECT P.id_sport, S.nom_sport
            FROM pratiquer P
            INNER JOIN sport S
                ON P.id_sport = S.id_sport
            WHERE id_eleve = :id_eleve";
            $stmt = $this -> _db -> prepare($sql);
            $stmt -> bindParam(':id_eleve', $id_eleve);
        }

        elseif (is_numeric($id_sport)) {
            $sql = "SELECT P.id_sport, S.nom_sport
            FROM pratiquer P
            INNER JOIN sport S
                ON P.id_sport = S.id_sport
            WHERE id_eleve = :id_eleve
            AND P.id_sport = :id_sport";
            $stmt = $this -> _db -> prepare($sql);
            $stmt -> bindParam(':id_eleve', $id_eleve);
            $stmt -> bindParam(':id_sport', $id_sport);
        }

        $stmt -> execute();
        $result = null;
        
        while ($row = $stmt -> fetch(PDO::FETCH_ASSOC)) {
            $result[] = $row;
        }
        return $result;
    }

    public function getSizeByEleve($id) {
        $sql = "SELECT COUNT(id_sport) as size FROM pratiquer WHERE id_eleve = :id";
        $stmt = $this -> _db -> prepare($sql);
        $stmt -> bindParam(':id', $id);

        $stmt -> execute();
        return $stmt -> fetch(PDO::FETCH_ASSOC)['size'];
    }

}