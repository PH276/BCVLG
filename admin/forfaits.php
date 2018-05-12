<?php
include ('inc/init.inc.php');
$dateSaison = time() - 243 * 24 * 3600;
$saison = date('Y', $dateSaison);
$mois = date('n');

$requete =
"SELECT a.id id, nom, prenom
FROM joueurs as j
INNER JOIN adherents as a ON a.id_joueur=j.id
INNER JOIN forfaits as f ON a.id=f.id_adherent AND mois = $mois
WHERE saison = $saison
ORDER BY nom, prenom";

$req = $pdo -> query ($requete);
$forfaits = $req -> fetchAll(PDO::FETCH_ASSOC);
$nb_forfaites = $req -> rowCount();

$requete =
"SELECT a.id id, nom, prenom, f.id forfait
FROM joueurs as j
INNER JOIN adherents as a ON a.id_joueur=j.id
LEFT JOIN forfaits as f ON a.id=f.id_adherent AND mois = $mois
WHERE saison = $saison
ORDER BY f.id DESC, nom, prenom";

$req = $pdo -> query ($requete);
$adherents = $req -> fetchAll(PDO::FETCH_ASSOC);


// initilistion de message d'erreur
$erreurforfait = '';
$page = "forfaits - ";

include ('inc/head.inc.php');
?>
<main class="container">
    <h1 class="text-center">Liste des <?= $nb_forfaites  ?> forfaités du mois</h1>
    <div class="row">

    <?php foreach($forfaits as $forfait) : ?>
        <p class="col-md-3"><?= $forfait['prenom'] . ' ' . $forfait['nom'] ?></p>
    <?php endforeach; ?>
</div>

    <h2 class="text-center">Liste des adhérents</h2>
    <div id="forfaits" class="row">
        <?php foreach ($adherents as $adherent) : ?>
            <div class="col-md-1 text-center">
                <p>
                    <?= $adherent['prenom'] . '<br>' . $adherent['nom'] ?>
                    <br>
                    <input id="<?= ($adherent['id']) ?>" type="checkbox" <?= ($adherent['forfait'])?" checked":"" ?>>
                </p>
            </div>
        <?php endforeach; ?>

    </div>

    <!-- Affichage de la Liste des adhérents -->



</main>

<?php
include ('inc/footer.inc.php');
?>
