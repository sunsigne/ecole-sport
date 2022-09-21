<?php

    ////////// GENERATION ////////////

    // creation de la BDD si elle n'existe pas
    $conn = new mysqli('localhost', 'root', '');
    if ($conn->connect_error)
        die("Connection failed: " . $conn->connect_error);
    $sql = "CREATE DATABASE IF NOT EXISTS php_expert_1";
    if ($conn->query($sql) === FALSE) {
        echo "Error creating database: " . $conn->error;
        $conn->close();
        exit();        
    }
    $conn->close();

    // reset de la BDD
    $db = new PDO('mysql:host=localhost;dbname=php_expert_1', 'root', '');
    $sql = file_get_contents('sql/reset.sql');
    $db->exec($sql);


    // récupération de données pour la génération
    $manager = new EcoleManager($db);
    $ecoles = $manager -> getEcole();
    $manager = new SportManager($db);
    $sport_size = $manager -> getSize();

    foreach($ecoles as $ecole) {
        
        // création de sports aléatoire dans la table "enseigner"

        // créer entre 0 à max sports par école
        $rad_sport_num = rand(0, $sport_size);

        if($rad_sport_num != 0)
            for ($x = 0; $x < $rad_sport_num; $x++) {
                // créer rad_num sports pour l'école
                generate_random_nb_of_sport($db, $ecole['id_ecole'], $sport_size);
            }
        
        // création aléatoire d'élève

        // créer entre 0 à 6 élèves par école
        $rad_eleve_num = rand(0, 6);
        if($rad_eleve_num != 0)
            for ($x = 0; $x < $rad_eleve_num; $x++) {
                // créer rad_num élèves pour l'école
                generate_random_nb_of_eleve($db, $ecole['id_ecole']);
            }

        // attribution aléatoire de 0 à 3 sports par élève (par école)

        // récupération des élèves de l'école
        $manager = new EleveManager($db);
        $eleves = $manager -> get_eleve_from_ecole_id($ecole['id_ecole']);
        if($eleves != null)
        foreach($eleves as $eleve) {
            // création entre 0 à 3 sports pratiqués par école (ou nombre max de sports disponibles si < à 3)
            $rad_pratiquer_num = rand(0, min(3, $rad_sport_num));
            if($rad_pratiquer_num != 0)
            for ($x = 0; $x < $rad_pratiquer_num; $x++) {
                // injecte à "pratiquer" rad_num sports aléatoire pour l'élèves, parmis ceux enseignés par l'école
                generate_random_nb_of_sport_pratiquer($db, $ecole['id_ecole'], $eleve['id_eleve'], $rad_sport_num);
            }
        }
    }

    $db = null;




    ////////// FUNCTION ////////////

    function generate_random_nb_of_sport($db, $id_ecole, $sport_size) {

        // créer un sport d'index 1 à 5 n'étant pas déjà enseigné
        do {
            $rad_id = rand(1, $sport_size);
            $manager = new SportManager($db);
            $sport = $manager -> getSport($rad_id);
            $manager = new EnseignerManager($db);
            $dbb_sport = $manager -> get_sport_in_enseigner_from_ecole_id($id_ecole, $sport[0]['id_sport']);
        } while ($dbb_sport != null);        

        $sql = "INSERT INTO enseigner (id_ecole, id_sport) VALUES (:id_ecole, :id_sport)";
        $stmt = $db -> prepare($sql);
        $stmt -> bindParam(':id_ecole', $id_ecole);
        $stmt -> bindParam(':id_sport', $rad_id);
        $stmt -> execute();
    }

    function generate_random_nb_of_eleve($db, $id_ecole) {
        $sql = "INSERT INTO eleve (nom_eleve, id_ecole) VALUES (:nom_eleve, :id_ecole)";
        $stmt = $db -> prepare($sql);
        $stmt -> bindParam(':id_ecole', $id_ecole);

        $rad_name = get_rad_eleve_name();
        $stmt -> bindParam(':nom_eleve', $rad_name);
        $stmt -> execute();
    }

    function generate_random_nb_of_sport_pratiquer($db, $id_ecole, $id_eleve, $sport_size) {

        // sélectionne un sport aléatoire parmi ceux présent dans "enseigner", et que l'élève ne pratique pas déjà
        do {
            $manager = new EnseignerManager($db);
            $sports = $manager -> get_sport_in_enseigner_from_ecole_id($id_ecole);
            $rad_sport = rand(1, $sport_size);
            $sport = $sports[$rad_sport - 1];

            $manager = new PratiquerManager($db);
            $dbb_pratiquer = $manager -> get_sport_in_pratiquer_from_eleve_id($id_eleve, $sport['id_sport']);
        } while ($dbb_pratiquer != null);        

        $sql = "INSERT INTO pratiquer (id_eleve, id_sport) VALUES (:id_eleve, :id_sport)";
        $stmt = $db -> prepare($sql);
        $stmt -> bindParam(':id_eleve', $id_eleve);
        $stmt -> bindParam(':id_sport', $sport['id_sport']);
        $stmt -> execute();
    }

    // retourne un nom aléatoire parmi ceux disponibles
    function get_rad_eleve_name() {
        $name[] = "Paul";
        $name[] = "Laura";
        $name[] = "Jean";
        $name[] = "Marc";
        $name[] = "Suzanne";
        $name[] = "Jasmine";
        $name[] = "Loïc";
        $name[] = "Esteban";
        $name[] = "Julio";
        $name[] = "Mohamed";
        $name[] = "Abdoul";
        $name[] = "Etienne";
        $name[] = "Tibaud";
        $name[] = "Isabelle";
        $name[] = "Frederique";
        $name[] = "Carelle";
        $name[] = "Florence";
        $name[] = "Débora";
        $name[] = "Cindy";
        $name[] = "Francis";
        $name[] = "Benjamin";
        $name[] = "Alexandre";
        $name[] = "James";
        $name[] = "Jessy";
        $name[] = "Tom";
        $name[] = "Aaron";
        $name[] = "Georges";
        $name[] = "Tania";
        $rad = rand(0, count($name) - 1);

        return $name[$rad];
    }