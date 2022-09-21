<?php

$db = new PDO('mysql:host=localhost;dbname=php_expert_1', 'root', '');

$manager = new EcoleManager($db);
$ecoles = $manager -> getEcole();

$manager = new EnseignerManager($db);
$db = null;

?>

<p class="text-center">

    <?php 
    foreach($ecoles as $ecole) {

        $size = $manager -> getSizeByEcole($ecole['id_ecole']);
        echo "<strong> " . $ecole['nom_ecole'] . " (" . $size . ")" . " : " . "</strong> ";

        $sports = $manager -> get_sport_in_enseigner_from_ecole_id($ecole['id_ecole']);

        if($sports != null)
            foreach($sports as $sport) {
                echo $sport['nom_sport'] . " / ";
            }
        echo "<br>";
    }
    ?>

</p>