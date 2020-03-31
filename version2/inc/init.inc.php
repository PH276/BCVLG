<?php
// SESSION
session_start();
require('parametres.inc.php');


$saison_annee_un = date ('Y', time() - 20991600);
// $debut_saison = date ('Y', time() - 20991600);

$pdo = new PDO('mysql:host='.HOST.';dbname='.DBNAME, USER, PASSWORD, array(
	PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
	PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
));

// VARIABLES
$msg =''; // $msg permet de communiquer avec l'utilisateur
$page = ''; // contiendra le nom de la page en cours de visite (menu surbrillance + title de la page).
$contenu = ''; // $contenu  permettra ponctuellement de stocker du contenu a afficher.

// AUTRES INCLUSIONS
require('fonctions.inc.php');
