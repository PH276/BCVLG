<?php
require('../inc/init.inc.php');
$id = $_POST['id'];
$insert = $_POST['adherent'];
if ($insert == 1){
    $pdo->exec("INSERT INTO adherent (id, saison, id_joueur, cotisation) VALUES ($id, 2017, $id, 'chq') ");
}else {
    $pdo->exec("DELETE FROM adherent WHERE id=$id");
}
