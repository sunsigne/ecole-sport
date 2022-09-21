<?php

// établissement des constantes
define("WEB_DIR_NAME", "ecole-sport");
define("WEB_DIR_PATH", $_SERVER['DOCUMENT_ROOT'] . "/" . WEB_DIR_NAME  . "/");
define("WEB_DIR_URL", "http://" . $_SERVER['HTTP_HOST'] . "/" . WEB_DIR_NAME . "/");

// gestion des erreurs
define("DISPLAY_PHP_ERROR", str_contains(WEB_DIR_URL, "localhost"));
// les erreurs PHP ne s'affiche sur la page que lorsque le serveur est un "localhost"
ini_set('display_errors', DISPLAY_PHP_ERROR);
ini_set('log_errors', 1);
ini_set('error_log', WEB_DIR_PATH . 'error.txt');

require('class/ArrayHelper.php');
require('class/EcoleManager.php');
require('class/SportManager.php');
require('class/EleveManager.php');
require('class/EnseignerManager.php');
require('class/PratiquerManager.php');
require('class/ClassementManager.php');

?>