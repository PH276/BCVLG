<?php

// SESSION
session_start();
//
$saison_annee_un = date ('Y', time() - 20991600);

// CONNEXION BDD
// en local
$pdo = new PDO('mysql:host=localhost;dbname=BCVLG', 'root', '1111', array(
	PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
	PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
));

// en ligne
// $pdo = new PDO('mysql:host=db669193230.db.1and1.com;dbname=db669193230', 'dbo669193230', 'Lbf&ae1A', array(
// 	PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
// 	PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
// ));

// VARIABLES
$msg =''; // $msg permet de communiquer avec l'utilisateur
$page = ''; // contiendra le nom de la page en cours de visite (menu surbrillance + title de la page).
$contenu = ''; // $contenu  permettra ponctuellement de stocker du contenu a afficher.


// CHEMINS
define('RACINE_SITE', '/BCVLG/'); // local
// define('RACINE_SITE', '/'); // internet

// AUTRES INCLUSIONS
require('fonctions.inc.php');
