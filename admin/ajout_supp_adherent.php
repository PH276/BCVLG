<?php
require('../inc/init.inc.php');
$id = $_POST['id'];
$insert = $_POST['adherent'];
if ($insert == 1){
    $pdo->exec("INSERT INTO adherent (saison, id_joueur) VALUES ($saison_annee_un, $id) ");
}else {
    $pdo->exec("DELETE FROM adherent WHERE id_joueur=$id AND saison=$saison_annee_un");
}
