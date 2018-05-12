<?php
include('inc/parametres.php');
$pdo = new PDO("mysql:host=" . HOST . ";dbname=" . BDD, USER , PASS, array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
));
$dateSaison = time() - 243 * 24 * 3600;
$saison = date('Y', $dateSaison);
$mois = date('n');

if ($_POST['action'] == 'suppr'){
    $req = $pdo -> prepare ("DELETE FROM forfaits WHERE id_adherent = :id AND mois = $mois");
    $req -> bindParam(':id', $_POST['id'], PDO::PARAM_INT);
    $req -> execute();
}

// cas d'un ajout
if ($_POST['action'] == 'new'){
    $req = $pdo -> prepare ("INSERT INTO forfaits(mois, id_adherent)
    VALUES (:mois, :id)");
    $req -> bindParam(':mois', date('n'), PDO::PARAM_INT);
    $req -> bindParam(':id', $_POST['id'], PDO::PARAM_INT);
    $req -> execute();


}
// cas d'une modification
