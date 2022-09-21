<?php

$db = new PDO('mysql:host=localhost;dbname=php_expert_1', 'root', '');

$manager = new EcoleManager($db);
$ecoles = $manager -> getEcole();

$manager = new ClassementManager($db);
$db = null;

?>

<p class="text-center">

    <?php 
    foreach($ecoles as $ecole) {
        echo "<strong> " . $ecole['nom_ecole'] . " : " . "</strong> ";
        $sports = $manager -> get_sport_classement_from_ecole_id($ecole['id_ecole']);

        if($sports != null)
            foreach($sports as $sport) {
                echo $sport['nom'] . " (" . $sport['size'] . ") ".  " / ";
            }
        echo "<br>";
    }
    ?>

</p>