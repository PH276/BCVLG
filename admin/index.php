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
            <h1>Nouveau membre :</h1>
            <div class="row">
                <div class="col-12">

                    <pre>
                        <?= realpath('./').'<br>'; ?>
                        <?= realpath('/').'<br>'; ?>


                        <?php //var_dump($_SERVER); ?>
                    </pre>
                </div>
            </div>
        </div>


        <?php include ('../inc/footer.inc.php'); ?>
    </div>


</body>
</html>
