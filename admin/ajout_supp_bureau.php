<?php
require('../inc/init.inc.php');
$id = $_POST['id'];
$insert = $_POST['bureau'];
if ($insert == 1){
    $pdo->exec("INSERT INTO bureau (id_joueur) VALUES ($id) ");
}else {
    $pdo->exec("DELETE FROM adherent WHERE id_joueur=$id");
}
