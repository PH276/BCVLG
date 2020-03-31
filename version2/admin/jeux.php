<?php
include ('inc/init.inc.php');
$dateSaison = time() - 243 * 24 * 3600;
$saison = date('Y', $dateSaison);

$requete = "SELECT * FROM jeux";

$req = $pdo -> query ($requete);
$jeux = $req -> fetchAll(PDO::FETCH_ASSOC);
$nb = $req -> rowCount();

// initilistion de message d'erreur
$erreurjeu = '';
$page = "jeux - ";

// traitement d'une demande de suppresion ou de modification
if (isset($_GET['action']) && isset($_GET['id'])) {

    // cas d'une suppresion
    if ($_GET['action'] == "suppr"){
        $req = $pdo -> prepare ("DELETE FROM jeux WHERE id = :id");
        $req -> bindParam(':id', $_GET['id'], PDO::PARAM_INT);
        $req -> execute();
        header('location: jeux.php');
    }

    // cas de la modification d'un joueur
    if ($_GET['action'] == "modif"){
        $req = $pdo -> prepare ("SELECT * FROM jeux WHERE id = :id");
        $req -> bindParam(':id', $_GET['id'], PDO::PARAM_INT);
        $req -> execute();
        $jeu_a_modifier = $req -> fetch(PDO::FETCH_ASSOC);
    }
}

// traitement du formulaire
if (!empty($_POST)) {

    // cas d'un ajout
    if (empty($_POST['id'])){

        if (!empty($_POST['code']) && !empty($_POST['titre'])){

            $req = $pdo -> prepare ("INSERT INTO jeux(code, titre)
            VALUES (:code, :titre)");
            $req -> bindParam(':code', $_POST['code'], PDO::PARAM_STR);
            $req -> bindParam(':titre', $_POST['titre'], PDO::PARAM_STR);
            $req -> execute();

            header('location: jeux.php');

        } else {
            // $erreurjeu = (empty($_POST['joueur'])) ? 'Saisir tous les champs requis' : null;
            $erreurjeu = 'Saisir tous les champs requis';
        }
    }
    // cas d'une modification

    else {
        if (!empty($_POST['code']) && !empty($_POST['titre'])){

            $req = $pdo -> prepare ("UPDATE jeux SET code = :code, titre = :titre WHERE id = :id");
            $req -> bindParam(':id', $_POST['id'], PDO::PARAM_INT);
            $req -> bindParam(':code', $_POST['code'], PDO::PARAM_STR);
            $req -> bindParam(':titre', $_POST['titre'], PDO::PARAM_STR);
            $req -> execute();

            header('location: jeux.php');

        } else {
            // $erreurjoueur = (empty($_POST['joueur'])) ? 'Indiquez un joueur' : null;
            $erreurjoueur = 'Indiquez un mode de jeu';
        }
    }

}

include ('inc/head.inc.php');
?>
<main class="container-fluid">
    <h1 class="text-center">Liste des <?= $nb ?> modes de jeu</h1>

    <!-- Affichage de la Liste des joueurs -->
    <table class="table table-striped">
        <tr>
            <th>id</th>
            <th>Code</th>
            <th>Titre</th>
            <th class="text-center">Modification</th>
            <th class="text-center">Suppression</th>
        </tr>

        <?php foreach ($jeux as $jeu) : ?>
            <tr>
                <td><?= $jeu['id'] ?></td>

                <td><?= $jeu['code'] ?></td>
                <td><?= $jeu['titre'] ?></td>
                <td class="text-center">
                    <a href="?action=modif&id=<?= $jeu['id'] ?>">
                        <button  class="btn btn-info">
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                        </button>
                    </a>
                </td>
                <td class="text-center">
                    <a href="?action=suppr&id=<?= $jeu['id'] ?>">
                        <button  class="btn btn-danger">
                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                        </button>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>

    </table>

    <!-- formulaire de saisie pour un ajout  -->
    <h2>Nouveau mode de jeu :</h2>
    <form action="#" method="post" class="form-inline">
        <input type="hidden" name="id" value="<?= (isset($jeu_a_modifier['id']))?$jeu_a_modifier['id']:0 ?>">
        <div class="form-group">
            <?php if (!empty($erreurcode)) : ?>
                <p class="alert alert-danger"><?= $erreurcode ?></p>
            <?php endif; ?>
            <label for="code">code :</label>
            <input type="text" name="code" class="form-control" id="code" value="<?= (isset($jeu_a_modifier['code']))?$jeu_a_modifier['code']:'' ?>">
        </div>

        <div class="form-group">
            <?php if (!empty($erreurprenom)) : ?>
                <p class="alert alert-danger"><?= $erreurprenom ?></p>
            <?php endif; ?>
            <label for="titre">Titre :</label>
            <input type="text" name="titre" class="form-control" id="titre" value="<?= (isset($jeu_a_modifier['titre']))?$jeu_a_modifier['titre']:'' ?>">
        </div>


        <?php
        $action=(isset($jeu_a_modifier['id'])?"Modifier le ":"Ajouter un ");
        $nameValid = (isset($jeu_a_modifier['id'])?"modifier":"ajouter");
        ?>
        <button type="submit" name="<?= $nameValid ?>" class="btn btn-primary"><?= $action ?>mode de jeu</button>
    </form>

</main>

<?php
include ('inc/footer.inc.php');
?>
