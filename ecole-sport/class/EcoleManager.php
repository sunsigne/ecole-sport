<?php

class EcoleManager {
 
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

    public function getEcole($id = '') {
        if(empty($id)) {
            $sql = "SELECT id_ecole, nom_ecole FROM ecole";
            $stmt = $this -> _db -> prepare($sql);
        }
        elseif (is_numeric($id)) {
            $sql = "SELECT id_ecole, nom_ecole FROM ecole WHERE id_ecole = :id";
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

        $sql = "SELECT COUNT(id_ecole) as size FROM ecole";
        $stmt = $this -> _db -> prepare($sql);
        $stmt -> execute();
        $this -> _size = $stmt -> fetch(PDO::FETCH_ASSOC)['size'];
        return $this -> _size;
    }

}