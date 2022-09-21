<?php

class ClassementManager {
 
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


    private function get_sport_size_from_sport_id_and_ecole_id($id_sport, $id_ecole) {
        $sql = "SELECT EL.id_ecole, COUNT(P.id_sport) AS size 
        FROM pratiquer P
        INNER JOIN eleve EL
           ON P.id_eleve = EL.id_eleve
        WHERE P.id_sport = :id_sport
        AND id_ecole = :id_ecole";
        $stmt = $this -> _db -> prepare($sql);
        $stmt -> bindParam(':id_ecole', $id_ecole);
        $stmt -> bindParam(':id_sport', $id_sport);

        $stmt -> execute();
        $result = null;
        
        while ($row = $stmt -> fetch(PDO::FETCH_ASSOC)) {
            $result[] = $row;
        }
        
        if($result == null)
            return 0;
        return $result[0]['size'];
    }


    public function get_sport_classement_from_ecole_id($id) {
        $manager = new EnseignerManager($this -> _db);
        $sports = $manager -> get_sport_in_enseigner_from_ecole_id($id);

        $result = null;
        if($sports == null)
            return null;

        foreach($sports as $sport) {
            $result[$sport['id_sport']]['id'] = $sport['id_sport'];
            $result[$sport['id_sport']]['nom'] = $sport['nom_sport'];
            $result[$sport['id_sport']]['size'] = $this -> get_sport_size_from_sport_id_and_ecole_id($sport['id_sport'], $id);
        }

        $helper = new ArrayHelper();
        return $helper -> array_sort($result, 'size', SORT_ASC);
    }

}