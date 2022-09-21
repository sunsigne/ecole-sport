<?php

$db = new PDO('mysql:host=localhost;dbname=php_expert_1', 'root', '');
$manager = new SportManager($db);
$sports = $manager -> getSport();
$size = $manager -> getSize();
$db = null;

?>

<p class="text-center"><strong>Sport (<?php echo $size ?>) : </strong>

    <?php 
    foreach($sports as $sport) {
        echo $sport['nom_sport'] . " / ";
    }
    ?>

</p>