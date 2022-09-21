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

        $size = $manager -> getSportiveSizeByEcole($ecole['id_ecole']);        
        echo "<strong> " . $ecole['nom_ecole'] . " : " . "</strong> " . $size;

        echo "<br>";
    }
    ?>

</p>