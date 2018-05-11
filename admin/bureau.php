<?php
include ('inc/init.inc.php');
$dateSaison = time() - 243 * 24 * 3600;
$saison = date('Y', $dateSaison);

// traitement du formulaire
if (!empty($_POST)) {

    // cas d'une modification
    $vicepresidents = implode(', ', $_POST['vicepresident']);
    $autres = implode(', ', $_POST['autre']);
    $req = $pdo -> prepare ("UPDATE bureau SET president = :president, vicepresident = :vicepresident, secretaire = :secretaire, tresorier = :tresorier, autre = :autre");
    $req -> bindParam(':president', $_POST['president'], PDO::PARAM_INT);
    $req -> bindParam(':vicepresident', $vicepresidents, PDO::PARAM_STR);
    $req -> bindParam(':secretaire', $_POST['secretaire'], PDO::PARAM_INT);
    $req -> bindParam(':tresorier', $_POST['tresorier'], PDO::PARAM_INT);
    $req -> bindParam(':autre', $autres, PDO::PARAM_STR);
    $req -> execute();

    header('location: bureau.php');
}

$requete =
"SELECT a.id, nom, prenom FROM adherents as a
LEFT JOIN joueurs as j ON a.id_joueur=j.id AND saison=$saison
ORDER BY nom, prenom";

$req = $pdo -> query ($requete);
$adherents = $req -> fetchAll(PDO::FETCH_ASSOC);
$nb = $req -> rowCount();

$requete = "SELECT * FROM bureau";

$req = $pdo -> query ($requete);
$bureau = $req -> fetch(PDO::FETCH_ASSOC);
$vicepresidents = explode(', ', $bureau['vicepresident']);
$autres = explode(', ', $bureau['autre']);

// initilistion de message d'erreur
$erreurbureau = '';
$page = "bureau - ";

include ('inc/head.inc.php');
?>
<main class="container-fluid">

    <form action="bureau.php" method="post">
        <div class="row">

            <div class="form-group col-md-2">
                <label>Président</label>
                <select class="form-control" name="president">
                    <option></option>
                    <?php foreach($adherents as $adherent) : ?>
                        <option value="<?= $adherent['id'] ?>" <?= ($adherent['id'] == $bureau['president'])?" selected":"" ?>>
                            <?= $adherent['prenom'] . " " . $adherent['nom'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group col-md-2">
                <label>Vice-président(s)</label>
                <select class="form-control" multiple name="vicepresident[]">
                    <?php foreach($vicepresidents as $vicepresident) : ?>
                        <option value="<?= $vicepresident ?>" selected>
                            <?php $key = array_search($vicepresident, array_column($adherents, 'id')) ?>
                            <?= $adherents[$key]['prenom'] . " " . $adherents[$key]['nom'] ?>
                        </option>
                    <?php endforeach; ?>
                    <?php foreach($adherents as $adherent) : ?>
                        <option value="<?= $adherent['id'] ?>">
                            <?= $adherent['prenom'] . " " . $adherent['nom'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group col-md-2">
                <label>Secrétaire</label>
                <select class="form-control" name="secretaire">
                    <option></option>
                    <?php foreach($adherents as $adherent) : ?>
                        <option value="<?= $adherent['id'] ?>" <?= ($adherent['id'] == $bureau['secretaire'])?" selected":"" ?>>
                            <?= $adherent['prenom'] . " " . $adherent['nom'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group col-md-2">
                <label>Trésorier</label>
                <select class="form-control" name="tresorier">
                    <option></option>
                    <?php foreach($adherents as $adherent) : ?>
                        <option value="<?= $adherent['id'] ?>" <?= ($adherent['id'] == $bureau['tresorier'])?" selected":"" ?>>
                            <?= $adherent['prenom'] . " " . $adherent['nom'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group col-md-2">
                <label>Autre(s) membre(s)</label>
                <select class="form-control" multiple name="autre[]">
                    <?php foreach($autres as $autre) : ?>
                        <option value="<?= $autre ?>" selected>
                            <?php $key = array_search($autre, array_column($adherents, 'id')) ?>
                            <?= $adherents[$key]['prenom'] . " " . $adherents[$key]['nom'] ?>
                        </option>
                    <?php endforeach; ?>
                    <?php foreach($adherents as $adherent) : ?>
                        <option value="<?= $adherent['id'] ?>">
                            <?= $adherent['prenom'] . " " . $adherent['nom'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <input type="submit" class="btn btn-success" value="Enregistrer">
        <!-- <button type="" ></button> -->
    </form>
</main>

<?php
include ('inc/footer.inc.php');
?>
