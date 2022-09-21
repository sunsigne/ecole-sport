<?php

$db = new PDO('mysql:host=localhost;dbname=php_expert_1', 'root', '');

$manager = new EcoleManager($db);
$ecoles = $manager -> getEcole();

$manager = new EleveManager($db);
$db = null;

?>

<p class="text-center">

    <?php 
    foreach($ecoles as $ecole) {

        $size = $manager -> getSizeByEcole($ecole['id_ecole']);
        echo "<strong> " . $ecole['nom_ecole'] . " (" . $size . ")" . " : " . "</strong> ";

        $eleves = $manager -> get_eleve_from_ecole_id($ecole['id_ecole']);

        if($eleves != null)
            foreach($eleves as $eleve) {
                echo $eleve['nom_eleve'] . " / ";
            }
        echo "<br>";
    }
    ?>

</p>