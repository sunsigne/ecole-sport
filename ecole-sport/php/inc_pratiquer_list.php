<?php

$db = new PDO('mysql:host=localhost;dbname=php_expert_1', 'root', '');

$manager = new EleveManager($db);
$eleves = $manager -> getEleve();

$manager = new PratiquerManager($db);
$db = null;

?>

<p class="text-center">

    <?php 
    if($eleves != null)
    foreach($eleves as $eleve) {

        $size = $manager -> getSizeByEleve($eleve['id_eleve']);
        echo "<strong> " . $eleve['nom_eleve'] . " (" . $size . ")" . " : " . "</strong> ";

        $sports = $manager -> get_sport_in_pratiquer_from_eleve_id($eleve['id_eleve']);

        if($sports != null)
            foreach($sports as $sport) {
                echo $sport['nom_sport'] . " / ";
            }
        echo "<br>";
    }
    else
        echo "L'aléatoire a décidé : aucun élève. <br> Il y avait une chance sur 216 !";
    ?>

</p>