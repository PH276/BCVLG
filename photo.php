<!DOCTYPE html>
<html lang="fr">
<?php
$titrePage = "";
include ('inc/head.inc.php');
?>
<body>
    <?php include ('inc/nav.inc.php'); ?>
    <div id="corps" class="container">
        <?php
        $texte_header = "header_photo.html";
        include ('inc/header.inc.php'); ?>
        <div class="container-fluid">
            <div class="row">
                <aside class="col-3">  <!--  aside -->
                    <div class="row">
                        <div class="col-4">
                            <img style="width:100%" src="img/video-icon.jpg" alt="">
                        </div>
                        <div class="col-8">
                            <p>
                                Nouveau !!!<br>
                                Vidéo en ligne !
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <h3>A vos appareils</h3>
                            <p>Pensez à immortaliser vos rencontres et partagez les avec nous tous.</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <h3>Attention !</h3>
                            <p>Si vous souhaitez que l'on retire une photo faites le savoir. Merci</p>
                        </div>
                    </div>
                </aside>
                <main class="col-9">
                    <section>
                        <h2>Aidez-nous</h2>
                        <hr color="#99CC00" size="5">
                        <p>Vous disposez de photos prises lors de vos matchs, adressez-les par mail a bureaug@billardclubvlg.org</p>
                    </section>
                    <section>
                        <h2>Une séance photo en soirée</h2>
                        <hr color="#99CC00" size="5">
                        <p>Photographies prises en 2012.</p>
                        <div class="row">

                            <div class="col-6">
                                <img src="img/Alain.jpg" alt="">
                            </div>
                            <div class="col-6">
                                <img src="img/José.jpg" alt="">
                            </div>
                        </div>
                        <div class="row justify-content-around">
                            <div class="col-4">
                                <img src="img/Marckus.jpg" alt="">
                            </div>
                            <div class="col-auto">
                            </div>
                            <div class="col-4">
                                <img src="img/Sully.jpg" alt="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <img src="img/Marcel.jpg" alt="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <img src="img/Paulo.jpg" alt="">
                            </div>
                        </div>
                    </section>
                </main>
            </div>
        </div>


        <?php include ('inc/footer.inc.php'); ?>
    </div>


</body>
</html>
