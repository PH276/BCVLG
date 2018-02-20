<?php
include ('inc/init.inc.php');
$dateSaison = time() - 243 * 24 * 3600;
$saison = date('Y', $dateSaison);

$requete = "SELECT j.id id, nom, prenom, date_naissance, adresse, code_postal, ville, tel_mobile, tel_fixe, email, a.id id_adherent FROM joueurs as j INNER JOIN adherents as a ON a.id_joueur=j.id WHERE saison = $saison ORDER BY nom, prenom";

$req = $pdo -> query ($requete);
$adherents = $req -> fetchAll(PDO::FETCH_ASSOC);
$nb = $req -> rowCount();

// initilistion de message d'erreur
$erreuradherent = '';
$page = "adherents - ";

// traitement d'une demande de suppresion ou de modification
if (isset($_GET['action']) && isset($_GET['id'])) {

    // cas d'une suppresion
    if ($_GET['action'] == "suppr"){
        $req = $pdo -> prepare ("DELETE FROM adherents WHERE id = :id");
        $req -> bindParam(':id', $_GET['id'], PDO::PARAM_INT);
        $req -> execute();
        header('location: adherents.php');
    }

    // cas de la modification d'un adherent
    // if ($_GET['action'] == "modif"){
    //     $req = $pdo -> prepare ("SELECT * FROM adherents as a INNER JOIN joueurs ON a.id_joueur=joueurs.id WHERE a.id = :id");
    //     $req -> bindParam(':id', $_GET['id'], PDO::PARAM_INT);
    //     $req -> execute();
    //     $adherent_a_modifier = $req -> fetch(PDO::FETCH_ASSOC);
    // }
}

// traitement du formulaire
if (!empty($_POST)) {

    // cas d'un ajout
    if (empty($_POST['id'])){

        if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['adresse']) && !empty($_POST['codepostal']) && !empty($_POST['ville']) ){

            // $req = $pdo -> prepare ("INSERT INTO profil(nom, email, prenom, adresse, codePostal, ville, telephone, portable, site, photo, role, pays)
            //                                     VALUES (:nom, :email, :prenom, :adresse, :codePostal, :ville, :telephone, :portable, :site, :photo, 0, :pays)");
            $req = $pdo -> prepare ("INSERT INTO joueurs(nom, prenom, date_naissance, adresse, code_postal, ville, tel_mobile, tel_fixe, email)
            VALUES (:nom, :prenom, :date_naissance, :adresse, :code_postal, :ville, :tel_mobile, :tel_fixe, :email)");
            $req -> bindParam(':nom', $_POST['nom'], PDO::PARAM_STR);
            $req -> bindParam(':prenom', $_POST['prenom'], PDO::PARAM_STR);
            $req -> bindParam(':date_naissance', $_POST['date_naissance'], PDO::PARAM_STR);
            $req -> bindParam(':adresse', $_POST['adresse'], PDO::PARAM_STR);
            $req -> bindParam(':code_postal', $_POST['code_postal'], PDO::PARAM_STR);
            $req -> bindParam(':ville', $_POST['ville'], PDO::PARAM_STR);
            $req -> bindParam(':tel_mobile', $_POST['tel_fixe'], PDO::PARAM_INT);
            $req -> bindParam(':tel_fixe', $_POST['tel_fixe'], PDO::PARAM_INT);
            $req -> bindParam(':email', $_POST['email'], PDO::PARAM_INT);
            $req -> execute();

            $deplacement= (!empty($_POST['deplacement']))?1:0;



            $req = $pdo -> prepare ("INSERT INTO adherents(saison, id_joueur, cotisation) VALUES (:saison, :id_joueur, :cotisation)");
            $req -> bindParam(':saison', $eleveur, PDO::PARAM_INT);
            $req -> bindParam(':id_joueur', $id, PDO::PARAM_INT);
            $req -> bindParam(':cotisation', $dresseur, PDO::PARAM_STR);
            $req -> execute();

            // header('location: adherent.php');

        } else {
            $erreuradherent = (empty($_POST['adherent'])) ? 'Saisir tous les champs requis' : null;
        }
    }
    // cas d'une modification
    else {
        if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['adresse']) && !empty($_POST['codepostal']) && !empty($_POST['ville']) ){

            $req = $pdo -> prepare ("UPDATE joueurs SET nom = :nom, prenom = :prenom, date_naissance = :date_naissance, adresse = :adresse, code_postal = :code_postal, ville = :ville, tel_mobile = :tel_mobile, tel_fixe = :tel_fixe, email = :email WHERE id = :id");
            $req -> bindParam(':id', $_POST['id'], PDO::PARAM_INT);
            $req -> bindParam(':nom', $_POST['nom'], PDO::PARAM_STR);
            $req -> bindParam(':prenom', $_POST['prenom'], PDO::PARAM_STR);
            $req -> bindParam(':date_naissance', $_POST['date_naissance'], PDO::PARAM_STR);
            $req -> bindParam(':adresse', $_POST['adresse'], PDO::PARAM_STR);
            $req -> bindParam(':code_postal', $_POST['code_postal'], PDO::PARAM_STR);
            $req -> bindParam(':ville', $_POST['ville'], PDO::PARAM_STR);
            $req -> bindParam(':tel_mobile', $_POST['tel_fixe'], PDO::PARAM_INT);
            $req -> bindParam(':tel_fixe', $_POST['tel_fixe'], PDO::PARAM_INT);
            $req -> bindParam(':email', $_POST['email'], PDO::PARAM_INT);
            $req -> execute();

            $deplacement= (!empty($_POST['deplacement']))?1:0;

            $req = $pdo -> prepare ("UPDATE adherents SET saison = :saison, id_joueur = :id_joueur, cotisation = :cotisation WHERE id_joueur = :id_joueur");
            $req -> bindParam(':saison', $eleveur, PDO::PARAM_INT);
            $req -> bindParam(':id_joueur', $id, PDO::PARAM_INT);
            $req -> bindParam(':cotisation', $dresseur, PDO::PARAM_STR);
            $req -> execute();
            header('location: adherents.php');

        } else {
            $erreuradherent = (empty($_POST['adherent'])) ? 'Indiquez un adherent' : null;
        }
    }

}

include ('inc/head.inc.php');
?>
<main class="container-fluid">
    <div class="imprimer">
        <a class="btn btn-info" href="#nom">Ajouter un adhérent</a>
        <button class="btn btn-info" type="button" name="liste">Liste complète / réduite</button>
        <button class="btn btn-info" type="button" name="imprimer">Préparer pour une impression</button>
    </div>

    <h1 class="text-center">Liste des <?= $nb ?> adhérents de la saison <?= $saison . '/' . ($saison+1) ?></h1>

    <!-- Affichage de la Liste des adhérents -->
    <table class="table table-striped">
        <tr>
            <th class="imprimer">id</th>
            <!-- <th>Photo</th> -->
            <th>Nom</th>
            <th>Prénom</th>
            <th>Date de naissance</th>
            <th class="reduit">Adresse</th>
            <th class="reduit">Code postal</th>
            <th class="reduit">Ville</th>
            <th class="reduit" colspan="2" class="text-center">Téléphones</th>
            <th class="reduit">Email</th>
            <th class="reduit">Paiement</th>
            <!-- <th class="text-center imprimer">Modification</th> -->
            <th class="text-center imprimer">Suppression</th>
        </tr>

        <?php foreach ($adherents as $adherent) : ?>
            <tr>
                <td class="imprimer"><?= $adherent['id_adherent'] ?></td>

                <td><?= $adherent['nom'] ?></td>
                <td><?= $adherent['prenom'] ?></td>
                <td><?= $adherent['date_naissance'] ?></td>
                <td class="reduit"><?= $adherent['adresse'] ?></td>
                <td class="reduit"><?= $adherent['code_postal'] ?></td>
                <td class="reduit"><?= $adherent['ville'] ?></td>
                <td class="reduit"><?= $adherent['tel_mobile'] ?></td>
                <td class="reduit"><?= $adherent['tel_fixe'] ?></td>
                <td class="reduit"><?= $adherent['email'] ?></td>
                <td class="reduit">
                    <form action="#" method="post" class="form-inline imprimer">
                        <input type="hidden" name="id" value="<?= (isset($adherent_a_modifier['id']))?$adherent_a_modifier['id']:0 ?>">
                        <label class="radio-inline">
                            <input type="radio" id="cotisation" name="cotisation" value="chq" <?= (isset($adherent_a_modifier) && $adherent_a_modifier['cotisation'] =="chq")?" checked ":"" ?>>Chèque
                        </label>
                        <label class="radio-inline">
                            <input type="radio" id="cotisation" name="cotisation" value="chq" <?= (isset($adherent_a_modifier) && $adherent_a_modifier['cotisation'] =="esp")?" checked ":"" ?>>Espèce
                        </label>

                    </form>
                </td>
                <!-- <td class="text-center imprimer">
                <a href="adherents.php?action=modif&id=<?= $adherent['id_adherent'] ?>#nom">
                <button type="button" class="btn btn-info">
                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
            </button>
        </a>
    </td> -->
    <td class="text-center imprimer">
        <a href="?action=suppr&id=<?= $adherent['id_adherent'] ?>">
            <button  class="btn btn-danger">
                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
            </button>
        </a>
    </td>
</tr>
<?php endforeach; ?>

</table>

<!-- formulaire de saisie pour un ajout  -->
<form action="#" method="post" class="form-inline imprimer">
    <input type="hidden" name="id" value="<?= (isset($adherent_a_modifier['id']))?$adherent_a_modifier['id']:0 ?>">
    <label class="radio-inline">
        <input type="radio" id="cotisation" name="cotisation" value="chq" <?= (isset($adherent_a_modifier) && $adherent_a_modifier['cotisation'] =="chq")?" checked ":"" ?>>Chèque
    </label>
    <label class="radio-inline">
        <input type="radio" id="cotisation" name="cotisation" value="chq" <?= (isset($adherent_a_modifier) && $adherent_a_modifier['cotisation'] =="esp")?" checked ":"" ?>>Espèce
    </label>

</form>
</main>

<?php
include ('inc/footer.inc.php');
?>
