<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Test</title>
    </head>

    <body>
    <?php
try
{
        $bdd = new PDO('mysql:host=db669193230.db.1and1.com;dbname=db669193230', 'dbo669193230', 'Lbe1ACO&m');

}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}
$reponse = $bdd->query('SELECT * FROM competitions');
$donnees = $reponse->fetch();
echo $donnees['titre'];
?>    </body>
</html>