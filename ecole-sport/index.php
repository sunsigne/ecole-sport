<?php require('config.php') ?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="authors" content="Florian Murcia">

        <!-- force Internet Explorer to use Microsoft Edge -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- the mobile display becomes responsive -->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        
        <title>Ecole & Sport</title>
    </head>
    <body class="bg-light">

        <!-- header -->

        <?php require('php/inc_header.php') ?>

        <!-- nav -->

        <nav class="my-3 navbar navbar-expand-sm bg-dark navbar-dark">
            <div class="container-fluid">
                <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="index">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">Page 1</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">Page 2</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">Page 3</a>
                </li>
                </ul>
            </div>
        </nav>

        <!-- main -->

        <?php require('process/random_bdd_generator.php') ?>

        <main class="container text-center p-3">
            <div class="row">
                <div class="col-sm-12 col-lg-5 p-3 mb-5 bg-dark text-light">
                    <h3 class="h5 mb-4">Contenu immuable de la BDD : </h3>
                    <?php require('php/inc_ecole_list.php') ?>
                    <?php require('php/inc_sport_list.php') ?>
                </div>

                <div class="col-lg-2"></div>

                <div class="col-sm-12 col-lg-5 p-3 mb-5 bg-dark text-light">
                    <h3 class="h5 mb-4">Sports enseignés dans chaque école : </h3>
                    <?php require('php/inc_enseigner_list.php') ?>
                </div>
            </div>    

            <div class="p-3 mb-5 bg-dark text-light">
                <h3 class="h5 mb-4">Élèves étudiants dans chaque école : </h3>
                <?php require('php/inc_eleve_list.php') ?>
            </div>

            <div class="row">
                <div class="col-sm-12 col-lg-5 p-3 mb-5 bg-dark text-light">
                    <h3 class="h5 mb-4">Sports pratiqué par chaque élève : </h3>
                    <?php require('php/inc_pratiquer_list.php') ?>
                </div>

                <div class="col-lg-2"></div>

                <div class="col-sm-12 col-lg-5 p-3 mb-5 bg-dark text-light">
                <h3 class="h5 mb-4">Nombres d'élèves pratiquant au moins un sport : </h3>
                <?php require('php/inc_stat_sport_number.php') ?>
                
                <h3 class="h5 my-4">Classement croissant des sports pratiqués : </h3>
                <?php require('php/inc_stat_sport_classement.php') ?>
                </div>
            </div> 
            <p class="h5">Réactualisez la page pour regénérer la BDD</p> 
        </main>

        <!-- footer -->

        <?php require('php/inc_footer.php') ?>

        <!-- Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>