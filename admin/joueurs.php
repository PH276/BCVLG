<?php
include ('inc/init.inc.php');
$dateSaison = time() - 243 * 24 * 3600;
$saison = date('Y', $dateSaison);
echo $saison;
$requete = "SELECT j.id id, nom, prenom, date_naissance, adresse, code_postal, ville, tel_mobile, tel_fixe, email, id_joueur FROM joueurs as j LEFT JOIN adherents ON adherents.id_joueur=j.id AND saison=$saison ORDER BY nom, prenom";

$req = $pdo -> query ($requete);
$joueurs = $req -> fetchAll(PDO::FETCH_ASSOC);
$nb = $req -> rowCount();

// initilistion de message d'erreur
$erreurjoueur = '';
$page = "joueurs - ";

// traitement d'une demande de suppresion ou de modification
if (isset($_GET['action']) && isset($_GET['id'])) {

    // cas d'une suppresion
    if ($_GET['action'] == "suppr"){
        $req = $pdo -> prepare ("DELETE FROM joueurs WHERE id = :id");
        $req -> bindParam(':id', $_GET['id'], PDO::PARAM_INT);
        $req -> execute();
        header('location: joueurs.php');
    }

    // cas de la modification d'un joueur
    if ($_GET['action'] == "modif"){
        $req = $pdo -> prepare ("SELECT * FROM joueurs INNER JOIN joueurs ON joueurs.id_joueur=joueurs.id WHERE joueurs.id_joueur = :id");
        $req -> bindParam(':id', $_GET['id'], PDO::PARAM_INT);
        $req -> execute();
        $joueur_a_modifier = $req -> fetch(PDO::FETCH_ASSOC);
    }
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



            $req = $pdo -> prepare ("INSERT INTO joueurs(saison, id_joueur, cotisation) VALUES (:saison, :id_joueur, :cotisation)");
            $req -> bindParam(':saison', $eleveur, PDO::PARAM_INT);
            $req -> bindParam(':id_joueur', $id, PDO::PARAM_INT);
            $req -> bindParam(':cotisation', $dresseur, PDO::PARAM_STR);
            $req -> execute();

            // header('location: joueur.php');

        } else {
            $erreurjoueur = (empty($_POST['joueur'])) ? 'Saisir tous les champs requis' : null;
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

            $req = $pdo -> prepare ("UPDATE joueurs SET saison = :saison, id_joueur = :id_joueur, cotisation = :cotisation WHERE id_joueur = :id_joueur");
            $req -> bindParam(':saison', $eleveur, PDO::PARAM_INT);
            $req -> bindParam(':id_joueur', $id, PDO::PARAM_INT);
            $req -> bindParam(':cotisation', $dresseur, PDO::PARAM_STR);
            $req -> execute();
            header('location: joueurs.php');

        } else {
            $erreurjoueur = (empty($_POST['joueur'])) ? 'Indiquez un joueur' : null;
        }
    }

}

include ('inc/head.inc.php');
?>
<main class="container-fluid">
    <div>
        <a class="btn btn-info" href="#nom">Ajouter un joueur</a>
        <button class="btn btn-info" type="button" name="liste">Liste complète / réduite</button>
    </div>
    <h1 class="text-center">Liste des <?= $nb ?> joueurs</h1>

    <!-- Affichage de la Liste des joueurs -->
    <table class="table table-striped">
        <tr>
            <th>id</th>
            <!-- <th>Photo</th> -->
            <th>Nom</th>
            <th>Prénom</th>
            <th>Date de naissance</th>
            <th class="reduit">Adresse</th>
            <th class="reduit">Code postal</th>
            <th class="reduit">Ville</th>
            <th class="reduit" colspan="2" class="text-center">Téléphones</th>
            <th class="reduit">Email</th>
            <th class="text-center">Adhérent</th>
            <th class="text-center">Suppression</th>
        </tr>

        <?php foreach ($joueurs as $joueur) : ?>
            <tr>
                <td><?= $joueur['id'] ?></td>

                <td><?= $joueur['nom'] ?></td>
                <td><?= $joueur['prenom'] ?></td>
                <td><?= date_format(date_create($joueur['date_naissance']), 'd/m/Y' ) ?></td>
                <td class="reduit"><?= $joueur['adresse'] ?></td>
                <td class="reduit"><?= $joueur['code_postal'] ?></td>
                <td class="reduit"><?= $joueur['ville'] ?></td>
                <td class="reduit"><?= $joueur['tel_mobile'] ?></td>
                <td class="reduit"><?= $joueur['tel_fixe'] ?></td>
                <td class="reduit"><?= $joueur['email'] ?></td>
                <td class="text-center">

                    <form class="form-inline" id="<?= $joueur['id'] ?>">
                        <?php if ($joueur['id_joueur'] == NULL) : ?>
                            <input type="checkbox" name="adherent">
                        <?php else : ?>
                            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                        <?php endif; ?>
                    </form>
                </td>
                <td class="text-center">
                    <a href="?action=suppr&id=<?= $joueur['id'] ?>">
                        <button  class="btn btn-danger">
                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                        </button>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>

    </table>

</main>

<?php
include ('inc/footer.inc.php');
?>
