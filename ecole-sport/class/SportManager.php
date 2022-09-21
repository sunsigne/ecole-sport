<?php

class SportManager {
 
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

    public function getSport($id = '') {
        if(empty($id)) {
            $sql = "SELECT id_sport, nom_sport FROM sport";
            $stmt = $this -> _db -> prepare($sql);
        }
        elseif (is_numeric($id)) {
            $sql = "SELECT id_sport, nom_sport FROM sport WHERE id_sport = :id";
            $stmt = $this -> _db -> prepare($sql);
            $stmt -> bindParam(':id', $id);
        }
        $stmt -> execute();
        while ($row = $stmt -> fetch(PDO::FETCH_ASSOC)) {
            $result[] = $row;
        }
        return $result;
    }

    private $_size;

    public function getSize() {
        if(isset($this -> _size))
            return $this -> _size;

        $sql = "SELECT COUNT(id_sport) as size FROM sport";
        $stmt = $this -> _db -> prepare($sql);
        $stmt -> execute();
        $this -> _size = $stmt -> fetch(PDO::FETCH_ASSOC)['size'];
        return $this -> _size;
    }

}