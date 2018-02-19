<?php
$pdo = new PDO("mysql:host=localhost;dbname=bcvlg", 'root' , '', array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
));
$dateSaison = time() - 243 * 24 * 3600;
$saison = date('Y', $dateSaison);

// $id = $_GET['id_joueur'];
$id = $_POST['id_joueur'];
$req = $pdo -> prepare ("INSERT INTO adherents(id_joueur, saison) VALUES (:id_joueur, :saison)");
$req -> bindParam(':id_joueur', $id, PDO::PARAM_INT);
$req -> bindParam(':saison', $saison, PDO::PARAM_INT);
$req -> execute();
