<?php
$pdo = new PDO("mysql:host=localhost;dbname=bcvlg", 'root' , '', array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
));

// $id = $_GET['id_joueur'];
$id = $_POST['id'];
$req = $pdo -> prepare ("UPDATE adherents SET cotisation = :cotisation WHERE id = :id");
$req -> bindParam(':cotisation', $_POST['cotisation'], PDO::PARAM_STR);
$req -> bindParam(':id', $id, PDO::PARAM_INT);
$req -> execute();
