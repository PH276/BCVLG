<?php include ('../inc/init.inc.php'); ?>

<!DOCTYPE html>
<html lang="fr">
<?php
$titrePage = "";
include ('../inc/head.inc.php');
?>
<body>
    <?php include ('../inc/nav.inc.php'); ?>
    <div id="corps" class="container">
        <div class="container-fluid">
            <?php $dossier = opendir('./'); ?>
            <?php while(false !== ($fichier = readdir($dossier))) : ?>
                <a style="color:white" href="<?= $fichier ?>"><?= $fichier ?></a><br>
            <?php endwhile; ?>
            <h1>Nouveau membre :</h1>
            <div class="row">
                <div class="col-12">

                    <pre>


                        <?php //var_dump($_SERVER); ?>
                    </pre>
                </div>
            </div>
        </div>


        <?php include ('../inc/footer.inc.php'); ?>
    </div>


</body>
</html>
