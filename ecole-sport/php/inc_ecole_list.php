<?php

$db = new PDO('mysql:host=localhost;dbname=php_expert_1', 'root', '');
$manager = new EcoleManager($db);
$ecoles = $manager -> getEcole();
$size = $manager -> getSize();
$db = null;

?>

<p class="text-center"><strong>Ecole (<?php echo $size ?>) : </strong>

    <?php 
    foreach($ecoles as $ecole) {
        echo $ecole['nom_ecole'] . " / ";
    }
    ?>

</p>